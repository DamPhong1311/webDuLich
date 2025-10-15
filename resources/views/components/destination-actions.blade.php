@props(['destination', 'isFavorited', 'isSaved'])

@auth
<div class="action-buttons-container">
    <form action="{{ route('destinations.toggleFavorite', $destination->slug) }}" method="POST" class="action-form">
        @csrf
        <button type="submit" class="action-btn favorite-btn" title="Yêu thích">
            <svg class="action-icon" width="24" height="24" viewBox="0 0 24 24"
                 fill="{{ $isFavorited ? '#ef4444' : 'none' }}"
                 stroke="{{ $isFavorited ? '#ef4444' : 'currentColor' }}"
                 stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path>
            </svg>
            <span class="action-label">{{ $isFavorited ? 'Đã thích' : 'Thích' }}</span>
        </button>
    </form>

    <form action="{{ route('destinations.toggleSave', $destination->slug) }}" method="POST" class="action-form">
        @csrf
        <button type="submit" class="action-btn save-btn" title="Lưu lại">
            <svg class="action-icon" width="24" height="24" viewBox="0 0 24 24"
                 fill="{{ $isSaved ? '#3b82f6' : 'none' }}"
                 stroke="{{ $isSaved ? '#3b82f6' : 'currentColor' }}"
                 stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M19 21l-7-5-7 5V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2z"></path>
            </svg>
            <span class="action-label">{{ $isSaved ? 'Đã lưu' : 'Lưu' }}</span>
        </button>
    </form>
</div>

<style>
.action-buttons-container {
    display: flex;
    align-items: center;
    gap: 16px;
    margin: 20px 0;
}
.action-form {
    margin: 0;
}
.action-btn {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 8px 16px;
    border-radius: 999px; /* Pill shape */
    border: 1px solid #d1d5db; /* Gray-300 */
    background-color: #ffffff;
    color: #374151; /* Gray-700 */
    font-weight: 600;
    cursor: pointer;
    transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
}
.action-btn:hover {
    background-color: #f9fafb; /* Gray-50 */
    border-color: #9ca3af; /* Gray-400 */
    transform: translateY(-1px);
    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -2px rgba(0, 0, 0, 0.1);
}
.action-icon {
    color: #6b7280; /* Gray-500 */
}

/* Styles for the active (favorited/saved) state */
.favorite-btn svg[fill*='#ef4444'],
.save-btn svg[fill*='#3b82f6'] {
    color: white; /* Make the text white when active */
}
.favorite-btn:has(svg[fill*='#ef4444']) {
    background-color: #fef2f2; /* Red-50 */
    border-color: #fca5a5; /* Red-300 */
    color: #b91c1c; /* Red-700 */
}
.save-btn:has(svg[fill*='#3b82f6']) {
    background-color: #eff6ff; /* Blue-50 */
    border-color: #93c5fd; /* Blue-300 */
    color: #1d4ed8; /* Blue-700 */
}
</style>
@endauth
