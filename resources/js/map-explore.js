import L from 'leaflet';
import 'leaflet/dist/leaflet.css';

import 'leaflet.markercluster';
import 'leaflet.markercluster/dist/MarkerCluster.css';
import 'leaflet.markercluster/dist/MarkerCluster.Default.css';

const createCustomIcon = () => {
  return L.divIcon({
    html: `<div style="
      background: #dc2626;
      width: 12px;
      height: 12px;
      border: 2px solid white;
      border-radius: 50%;
      box-shadow: 0 2px 4px rgba(0,0,0,0.3);
    "></div>`,
    className: 'custom-marker-icon',
    iconSize: [16, 16],
    iconAnchor: [8, 8],
  });
};

const clusterIcon = (cluster) => {
  const count = cluster.getChildCount();
  let color = '#dc2626';
  
  if (count < 10) {
    color = '#059669';
  } else if (count > 50) {
    color = '#7c3aed';
  }
  
  return L.divIcon({
    html: `<div style="
      background: ${color};
      color: white;
      border: 2px solid white;
      border-radius: 50%;
      font-weight: bold;
      display: flex;
      align-items: center;
      justify-content: center;
      box-shadow: 0 2px 4px rgba(0,0,0,0.3);
      font-size: ${count > 99 ? '10px' : '12px'};
      width: ${count > 99 ? '30px' : count > 9 ? '28px' : '24px'};
      height: ${count > 99 ? '30px' : count > 9 ? '28px' : '24px'};
    ">${count}</div>`,
    className: 'cluster-marker-icon',
    iconSize: [count > 99 ? 30 : count > 9 ? 28 : 24, count > 99 ? 30 : count > 9 ? 28 : 24],
    iconAnchor: [count > 99 ? 15 : count > 9 ? 14 : 12, count > 99 ? 15 : count > 9 ? 14 : 12],
  });
};

const MAPBOX_TOKEN = import.meta.env.VITE_MAPBOX_TOKEN || '';
const MAPBOX_STYLE = 'mapbox/light-v11';

const $smartSearch = document.getElementById('smartSearch');
const $btnSearch = document.getElementById('btnSearch');
const $fDest = document.getElementById('fDest');
const $fArt = document.getElementById('fArt');
const $btnReset = document.getElementById('btnReset');
const $btnLocate = document.getElementById('btnLocate');
const $mapOverlay = document.getElementById('map-overlay');
const $loader = document.getElementById('loader-element');
const $message = document.getElementById('message-element');

const map = L.map('map', {
  zoomControl: true,
  scrollWheelZoom: true,
  attributionControl: true,
}).setView([16.0471, 108.2062], 6);

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
  L.tileLayer(
    'https://{s}.basemaps.cartocdn.com/light_all/{z}/{x}/{y}{r}.png', {
      maxZoom: 19,
      attribution: '&copy; OpenStreetMap &copy; CARTO'
    }
  ).addTo(map);
}

const clusterDest = L.markerClusterGroup({ 
  showCoverageOnHover: false,
  iconCreateFunction: clusterIcon
});
const clusterArt = L.markerClusterGroup({ 
  showCoverageOnHover: false,
  iconCreateFunction: clusterIcon
});
let ALL_DEST_MARKERS = [];
let ALL_ART_MARKERS = [];

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

function popupHtml(properties, type) {
  const cover = properties.cover_image ?
    (properties.cover_image.startsWith('http') ? properties.cover_image : `/storage/${properties.cover_image}`) :
    '';
  const url = type === 'dest' ? `/destinations/${properties.slug}` : `/articles/${properties.slug}`;
  const badge = type === 'dest' ?
    '<span class="popup-badge">Điểm đến</span>' :
    '<span class="popup-badge article">Bài viết</span>';
  const province = properties.province ? `<p>📍 ${properties.province}</p>` : '';
  
  const coordinatesInfo = properties.latitude && properties.longitude ? 
    `<p style="font-size:12px;color:#666;margin:5px 0;">
       📍 ${properties.latitude}, ${properties.longitude}
     </p>` : '';
  
  return `
    <div class="popup-card">
      ${cover ? `<img src="${cover}" alt="${properties.title}">` : `<div style="width:88px;height:72px;background:#f1f5f9;border-radius:10px;border:1px solid #e5e7eb;"></div>`}
      <div>
        ${badge}
        <h3>${properties.title}</h3>
        ${province}
        ${coordinatesInfo}
        <a href="${url}">Xem chi tiết →</a>
      </div>
    </div>`;
}

async function fetchJson(url) {
  const res = await fetch(url, { headers: { 'X-Requested-With': 'XMLHttpRequest' } });
  if (!res.ok) throw new Error(`Fetch failed ${res.status}: ${url}`);
  return res.json();
}

showOverlay('Đang tải dữ liệu bản đồ...');

Promise.all([
    fetchJson('/api/destinations'),
    fetchJson('/api/articles'),
  ])
  .then(([destinations, articles]) => {
    
    let destFeatures = [];
    if (destinations.type === 'FeatureCollection' && destinations.features) {
        destFeatures = destinations.features;
    } else if (Array.isArray(destinations)) {
        destFeatures = destinations.map(item => ({
            type: 'Feature',
            geometry: {
                type: 'Point',
                coordinates: [parseFloat(item.longitude), parseFloat(item.latitude)]
            },
            properties: item
        }));
    }
    
    ALL_DEST_MARKERS = destFeatures.map(d => {
      const props = d.properties;
      
      let lat, lng;
      if (d.geometry && d.geometry.coordinates) {
        [lng, lat] = d.geometry.coordinates;
      } else {
        return null;
      }
      
      if (!lat || !lng) return null;
      
      const m = L.marker([lat, lng], { 
        title: props.title,
        icon: createCustomIcon()
      }).bindPopup(popupHtml(props, 'dest'));
      
      m.vntData = { 
        type: 'dest', 
        title: (props.title || '').toLowerCase(), 
        province: (props.province || '').toLowerCase(),
        hasCoordinates: true
      };
      return m;
    }).filter(Boolean);

    let artFeatures = [];
    if (articles.type === 'FeatureCollection' && articles.features) {
        artFeatures = articles.features;
    } else if (Array.isArray(articles)) {
        artFeatures = articles.map(item => ({
            type: 'Feature',
            geometry: {
                type: 'Point',
                coordinates: [parseFloat(item.longitude), parseFloat(item.latitude)]
            },
            properties: item
        }));
    }
    
    ALL_ART_MARKERS = artFeatures.map(a => {
      const props = a.properties;
      
      let lat, lng;
      if (a.geometry && a.geometry.coordinates) {
        [lng, lat] = a.geometry.coordinates;
      } else {
        return null;
      }
      
      if (!lat || !lng) return null;
      
      const m = L.marker([lat, lng], { 
        title: props.title,
        icon: createCustomIcon()
      }).bindPopup(popupHtml(props, 'art'));
      
      m.vntData = { 
        type: 'art', 
        title: (props.title || '').toLowerCase(),
        hasCoordinates: true
      };
      return m;
    }).filter(Boolean);

    if (ALL_DEST_MARKERS.length === 0 && ALL_ART_MARKERS.length === 0) {
      showOverlay('Không có điểm nào có tọa độ để hiển thị', false);
    } else {
      const totalMarkers = ALL_DEST_MARKERS.length + ALL_ART_MARKERS.length;
      showOverlay(`Đang hiển thị ${totalMarkers} điểm có tọa độ...`);
    }

    map.addLayer(clusterDest);
    map.addLayer(clusterArt);
    
    applyFilter();
    
    try {
      const allMarkers = [...ALL_DEST_MARKERS, ...ALL_ART_MARKERS];
      if (allMarkers.length > 0) {
        const all = L.featureGroup(allMarkers);
        const bounds = all.getBounds();
        if (bounds.isValid()) {
          map.fitBounds(bounds, { padding: [30, 30] });
        }
      }
    } catch (e) {}

    wireEventListeners();
    setTimeout(hideOverlay, 1000);

  }).catch(err => {
    console.error('Lỗi tải dữ liệu:', err);
    showOverlay('Không thể tải dữ liệu bản đồ. Vui lòng thử lại sau.', false);
  });

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

async function handleSearch() {
    const q = ($smartSearch?.value || '').trim();
    if (!q) {
        applyFilter();
        return;
    }

    const markersFound = applyFilter();

    if (markersFound > 0) {
        try {
            const visibleMarkers = [];
            if ($fDest?.checked) visibleMarkers.push(...clusterDest.getLayers());
            if ($fArt?.checked) visibleMarkers.push(...clusterArt.getLayers());
            
            if (visibleMarkers.length > 0) {
                const visibleGroup = L.featureGroup(visibleMarkers);
                const bounds = visibleGroup.getBounds();
                if (bounds.isValid()) map.fitBounds(bounds, { padding: [50, 50], maxZoom: 14 });
            }
        } catch (e) {}
        return;
    }

    if (markersFound === 0) {
        if ($btnSearch) $btnSearch.disabled = true;
        try {
            const place = await geocodeMapbox(q);
            if (!place) {
                alert(`Không tìm thấy địa danh nào cho "${q}".`);
                return;
            }
            
            const { lat, lon, display_name } = place;
            map.flyTo([lat, lon], 13, { duration: 1.2 });
            
            L.circleMarker([lat, lon], { radius: 8, color: '#2563eb', fillColor: '#3b82f6', fillOpacity: .7 })
                .addTo(map).bindPopup(`📍 ${display_name}`).openPopup();
                
        } catch (e) {
            alert('Tìm kiếm địa danh lỗi. Vui lòng thử từ khoá khác hoặc kiểm tra lại MAPBOX_TOKEN.');
        } finally {
            if ($btnSearch) $btnSearch.disabled = false;
        }
    }
}

async function geocodeMapbox(q) {
  if (!MAPBOX_TOKEN) throw new Error('Missing MAPBOX token');
  const url = `https://api.mapbox.com/geocoding/v5/mapbox.places/${encodeURIComponent(q)}.json?limit=1&language=vi&access_token=${MAPBOX_TOKEN}`;
  const res = await fetch(url);
  if (!res.ok) throw new Error('Geocode request failed');
  const data = await res.json();
  const f = data.features?.[0];
  if (!f) return null;
  const [lng, lat] = f.center;
  return { lat, lon: lng, display_name: f.place_name };
}

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
            if (!navigator.geolocation) {
                alert('Trình duyệt không hỗ trợ định vị.');
                return;
            }
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