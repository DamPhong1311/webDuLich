import './bootstrap';
import Alpine from 'alpinejs';

// ================= TEST LINE =================
console.log("✅ app.js loaded and running!");
// =============================================

window.Alpine = Alpine;
Alpine.start();

/**
 * Handles the toggle action for favoriting or saving a destination.
 * @param {HTMLButtonElement} button The button that was clicked.
 * @param {string} url The URL to send the request to.
 * @param {('favorite'|'save')} type The type of action.
 */
function handleToggleAction(button, url, type) {
    console.log(`Button clicked! Type: ${type}, Slug: ${button.dataset.slug}`); // Thêm log khi click
    const svg = button.querySelector('svg');

    fetch(url, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Accept': 'application/json',
            'Content-Type': 'application/json',
        },
    })
    .then(response => {
        if (response.status === 401) { // Not logged in, redirect to login page
            window.location.href = '/login';
            return null;
        }
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.json();
    })
    .then(data => {
        if (!data) return; // Stop if redirected

        if (type === 'favorite') {
            svg.setAttribute('fill', data.favorited ? 'red' : 'none');
        } else if (type === 'save') {
            svg.setAttribute('fill', data.saved ? '#0d6efd' : 'none');
        }
    })
    .catch(error => {
        console.error('There was a problem with the fetch operation:', error);
    });
}

// Use event delegation to handle clicks efficiently across the entire page
document.addEventListener('click', function(e) {
    const favoriteBtn = e.target.closest('.favorite-btn');
    if (favoriteBtn) {
        e.preventDefault();
        const slug = favoriteBtn.dataset.slug;
        handleToggleAction(favoriteBtn, `/destinations/${slug}/favorite`, 'favorite');
    }

    const saveBtn = e.target.closest('.save-btn');
    if (saveBtn) {
        e.preventDefault();
        const slug = saveBtn.dataset.slug;
        handleToggleAction(saveBtn, `/destinations/${slug}/save`, 'save');
    }
});
//maps:
import 'leaflet/dist/leaflet.css';
import 'leaflet.markercluster/dist/MarkerCluster.css';
import 'leaflet.markercluster/dist/MarkerCluster.Default.css';

import L from 'leaflet';
import markerIcon2x from 'leaflet/dist/images/marker-icon-2x.png';
import markerIcon from 'leaflet/dist/images/marker-icon.png';
import markerShadow from 'leaflet/dist/images/marker-shadow.png';
L.Icon.Default.mergeOptions({
  iconRetinaUrl: markerIcon2x,
  iconUrl: markerIcon,
  shadowUrl: markerShadow,
});

