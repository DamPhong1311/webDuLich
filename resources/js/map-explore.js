// =============================================================
// VietNamTravel – Interactive Map (Leaflet + Mapbox + Clustering)
// LOGIC FOR THE NEW OPTIMIZED UI
// - Handles smart search (filter + geocode fallback).
// - Manages loading and error states with an overlay.
// =============================================================

import L from 'leaflet';
import 'leaflet/dist/leaflet.css';

import 'leaflet.markercluster';
import 'leaflet.markercluster/dist/MarkerCluster.css';
import 'leaflet.markercluster/dist/MarkerCluster.Default.css';

// --- Fix Leaflet default icon paths under Vite ---
import markerIcon2x from 'leaflet/dist/images/marker-icon-2x.png';
import markerIcon from 'leaflet/dist/images/marker-icon.png';
import markerShadow from 'leaflet/dist/images/marker-shadow.png';
L.Icon.Default.mergeOptions({
  iconRetinaUrl: markerIcon2x,
  iconUrl: markerIcon,
  shadowUrl: markerShadow,
});

// --- Config ---
const MAPBOX_TOKEN = import.meta.env.VITE_MAPBOX_TOKEN || '';
const MAPBOX_STYLE = 'mapbox/light-v11';

// --- Elements from the new Blade UI ---
const $smartSearch = document.getElementById('smartSearch');
const $btnSearch = document.getElementById('btnSearch');
const $fDest = document.getElementById('fDest');
const $fArt = document.getElementById('fArt');
const $btnReset = document.getElementById('btnReset');
const $btnLocate = document.getElementById('btnLocate');
const $mapOverlay = document.getElementById('map-overlay');
const $loader = document.getElementById('loader-element');
const $message = document.getElementById('message-element');

// --- Map init ---
const map = L.map('map', {
  zoomControl: true,
  scrollWheelZoom: true,
  attributionControl: true,
}).setView([16.0471, 108.2062], 6);

// Base tiles
if (MAPBOX_TOKEN) {
  L.tileLayer(
    `https://api.mapbox.com/styles/v1/${MAPBOX_STYLE}/tiles/{z}/{x}/{y}?access_token=${MAPBOX_TOKEN}`, {
      tileSize: 512,
      zoomOffset: -1,
      maxZoom: 20,
      attribution: '© <a href="https://www.openstreetmap.org/">OSM</a> © <a href="https://www.mapbox.com/">Mapbox</a>',
    }
  ).addTo(map);
} else {
  console.warn("MAPBOX_TOKEN is missing. Falling back to CARTO basemap.");
  L.tileLayer(
    'https://{s}.basemaps.cartocdn.com/light_all/{z}/{x}/{y}{r}.png', {
      maxZoom: 19,
      attribution: '&copy; OpenStreetMap &copy; CARTO'
    }
  ).addTo(map);
}

// --- Clusters & Marker Storage ---
const clusterDest = L.markerClusterGroup({ showCoverageOnHover: false });
const clusterArt = L.markerClusterGroup({ showCoverageOnHover: false });
let ALL_DEST_MARKERS = [];
let ALL_ART_MARKERS = [];

// --- NEW: Overlay Management Functions ---
function showOverlay(msg, showLoader = true) {
    if (!$mapOverlay || !$message || !$loader) return;
    $message.textContent = msg;
    $loader.style.display = showLoader ? 'inline-block' : 'none';
    $mapOverlay.classList.add('visible');
}

function hideOverlay() {
    if (!$mapOverlay) return;
    $mapOverlay.classList.remove('visible');
}


// --- Popup template & Fetch Helper (No change) ---
function popupHtml(item, type) {
  const cover = item.cover_image ?
    (item.cover_image.startsWith('http') ? item.cover_image : `/storage/${item.cover_image}`) :
    '';
  const url = type === 'dest' ? `/destinations/${item.slug}` : `/articles/${item.slug}`;
  const badge = type === 'dest' ?
    '<span class="popup-badge">Điểm đến</span>' :
    '<span class="popup-badge article">Bài viết</span>';
  const province = item.province ? `<p>📍 ${item.province}</p>` : '';
  return `
    <div class="popup-card">
      ${cover ? `<img src="${cover}" alt="${item.title}">` : `<div style="width:88px;height:72px;background:#f1f5f9;border-radius:10px;border:1px solid #e5e7eb;"></div>`}
      <div>
        ${badge}
        <h3>${item.title}</h3>
        ${province}
        <a href="${url}">Xem chi tiết →</a>
      </div>
    </div>`;
}

async function fetchJson(url) {
  const res = await fetch(url, { headers: { 'X-Requested-With': 'XMLHttpRequest' } });
  if (!res.ok) throw new Error(`Fetch failed ${res.status}: ${url}`);
  return res.json();
}

// --- Main Data Loading Logic ---
showOverlay('Đang tải dữ liệu bản đồ...');

Promise.all([
    fetchJson('/api/destinations'),
    fetchJson('/api/articles'),
  ])
  .then(([destinations, articles]) => {
    ALL_DEST_MARKERS = (destinations || []).map(d => {
      if (!d.latitude || !d.longitude) return null;
      const m = L.marker([+d.latitude, +d.longitude], { title: d.title }).bindPopup(popupHtml(d, 'dest'));
      m.vntData = { type: 'dest', title: d.title.toLowerCase(), province: (d.province || '').toLowerCase() };
      return m;
    }).filter(Boolean);

    ALL_ART_MARKERS = (articles || []).map(a => {
      if (!a.latitude || !a.longitude) return null;
      const m = L.marker([+a.latitude, +a.longitude], { title: a.title }).bindPopup(popupHtml(a, 'art'));
      m.vntData = { type: 'art', title: a.title.toLowerCase() };
      return m;
    }).filter(Boolean);

    map.addLayer(clusterDest);
    map.addLayer(clusterArt);
    
    applyFilter(); // Initial filter to show all markers
    
    try {
      const allMarkers = [...ALL_DEST_MARKERS, ...ALL_ART_MARKERS];
      if (allMarkers.length > 0) {
        const all = L.featureGroup(allMarkers);
        const bounds = all.getBounds();
        if (bounds.isValid()) map.fitBounds(bounds, { padding: [30, 30] });
      }
    } catch (e) { console.warn("Could not fit bounds.", e); }

    wireEventListeners();
    hideOverlay();

  }).catch(err => {
    console.error(err);
    showOverlay('Không thể tải dữ liệu bản đồ. Vui lòng thử lại sau.', false);
  });

// --- NEW/REWORKED: Filters & Search Logic ---

/**
 * Filters markers based on the smart search input and checkboxes.
 * @returns {number} The number of markers visible after filtering.
 */
function applyFilter() {
  const q = ($smartSearch?.value || '').toLowerCase().trim();
  const showDest = $fDest?.checked !== false;
  const showArt = $fArt?.checked !== false;

  clusterDest.clearLayers();
  clusterArt.clearLayers();

  let visibleMarkerCount = 0;

  if (showDest) {
    const visibleDests = ALL_DEST_MARKERS.filter(m => {
      if (!q) return true;
      return m.vntData.title.includes(q) || m.vntData.province.includes(q);
    });
    clusterDest.addLayers(visibleDests);
    visibleMarkerCount += visibleDests.length;
  }

  if (showArt) {
    const visibleArts = ALL_ART_MARKERS.filter(m => {
      if (!q) return true;
      return m.vntData.title.includes(q);
    });
    clusterArt.addLayers(visibleArts);
    visibleMarkerCount += visibleArts.length;
  }
  
  return visibleMarkerCount;
}

/**
 * Handles the "smart search": first filters, then tries geocoding if no results.
 */
async function handleSearch() {
    const q = ($smartSearch?.value || '').trim();
    if (!q) {
        applyFilter();
        return;
    }

    const markersFound = applyFilter();

    if (markersFound === 0) {
        if ($btnSearch) $btnSearch.innerHTML = '...';
        try {
            const place = await geocodeMapbox(q);
            if (!place) return alert(`Không tìm thấy địa danh nào cho "${q}".`);
            
            const { lat, lon, display_name } = place;
            map.flyTo([lat, lon], 13, { duration: 1.2 });
            L.circleMarker([lat, lon], { radius: 8, color: '#2563eb', fillColor: '#3b82f6', fillOpacity: .7 })
                .addTo(map).bindPopup(`📍 ${display_name}`).openPopup();
        } catch (e) {
            console.error(e);
            alert('Tìm kiếm địa danh lỗi. Vui lòng thử từ khoá khác hoặc kiểm tra lại MAPBOX_TOKEN.');
        } finally {
            if ($btnSearch) $btnSearch.innerHTML = '🔎';
        }
    }
}


// --- Geocoding Function (No change) ---
async function geocodeMapbox(q) {
  if (!MAPBOX_TOKEN) throw new Error('Missing MAPBOX token (VITE_MAPBOX_TOKEN)');
  const url = `https://api.mapbox.com/geocoding/v5/mapbox.places/${encodeURIComponent(q)}.json?limit=1&language=vi&access_token=${MAPBOX_TOKEN}`;
  const res = await fetch(url);
  if (!res.ok) throw new Error('Geocode request failed');
  const data = await res.json();
  const f = data.features?.[0];
  if (!f) return null;
  const [lng, lat] = f.center;
  return { lat, lon: lng, display_name: f.place_name };
}

// --- NEW: Event Wiring ---
function wireEventListeners() {
    if ($smartSearch) {
        $smartSearch.addEventListener('input', applyFilter);
        $smartSearch.addEventListener('keydown', (e) => {
            if (e.key === 'Enter') {
                e.preventDefault();
                handleSearch();
            }
        });
    }

    if ($btnSearch) $btnSearch.addEventListener('click', handleSearch);
    if ($fDest) $fDest.addEventListener('change', applyFilter);
    if ($fArt) $fArt.addEventListener('change', applyFilter);

    if ($btnReset) {
        $btnReset.addEventListener('click', () => {
            if ($smartSearch) $smartSearch.value = '';
            if ($fDest && !$fDest.checked) $fDest.checked = true;
            if ($fArt && !$fArt.checked) $fArt.checked = true;
            applyFilter();
            try {
                const all = L.featureGroup([...ALL_DEST_MARKERS, ...ALL_ART_MARKERS]);
                const bounds = all.getBounds();
                if (bounds.isValid()) map.fitBounds(bounds, { padding: [30, 30] });
            } catch (e) {}
        });
    }

    if ($btnLocate) {
        $btnLocate.addEventListener('click', () => {
            if (!navigator.geolocation) return alert('Trình duyệt không hỗ trợ định vị.');
            navigator.geolocation.getCurrentPosition(
                pos => {
                    const { latitude, longitude } = pos.coords;
                    map.setView([latitude, longitude], 13);
                    L.circleMarker([latitude, longitude], {
                        radius: 8, color: '#2563eb', fillColor: '#3b82f6', fillOpacity: .7
                    }).addTo(map).bindPopup('Bạn đang ở đây').openPopup();
                },
                () => alert('Không thể lấy được vị trí của bạn.'),
                { enableHighAccuracy: true, timeout: 8000 }
            );
        });
    }
}
