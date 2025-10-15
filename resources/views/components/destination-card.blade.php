@props(['d'])

@php
    // Prepare image source, checking if it's an external URL or a local file
    $img = $d->cover_image;
    $isUrl = Str::startsWith($img, ['http://', 'https://']);
    $imgSrc = $isUrl ? $img : asset('storage/' . $img);

    // Eager load relationships for the current user to avoid N+1 problem
    $user = Auth::user();
    if ($user) {
        $user->loadMissing(['favoriteDestinations', 'savedDestinations']);
    }
@endphp

<div class="destination-card">
    {{-- Action buttons are only shown to logged-in users --}}
    @auth
        <div class="card-actions">
            {{-- Favorite Button --}}
            <button class="favorite-btn action-btn" data-slug="{{ $d->slug }}" title="Yêu thích">
                <svg width="24" height="24" viewBox="0 0 24 24"
                    fill="{{ $user->favoriteDestinations->contains('slug', $d->slug) ? 'currentColor' : 'none' }}"
                    stroke="currentColor" class="icon-heart" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path>
                </svg>
            </button>
            {{-- Save Button --}}
            <button class="save-btn action-btn" data-slug="{{ $d->slug }}" title="Lưu">
                <svg width="24" height="24" viewBox="0 0 24 24"
                    fill="{{ $user->savedDestinations->contains('slug', $d->slug) ? 'currentColor' : 'none' }}"
                    stroke="currentColor" class="icon-save" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M19 21l-7-5-7 5V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2z"></path>
                </svg>
            </button>
        </div>
    @endauth

    {{-- Main card link and content --}}
    <a href="{{ route('destinations.show', $d) }}" class="card-link">
        <img src="{{ $imgSrc }}" class="destination-card-img" alt="{{ $d->title }}">
        <div class="destination-card-content">
            <h3>{{ $d->title }}</h3>
            <p class="destination-card-excerpt">{{ Str::limit($d->excerpt, 100) }}</p>
            @if ($d->province)
                <p class="destination-card-province">📍 {{ $d->province }}</p>
            @endif
        </div>
    </a>
</div>

<style>
.destination-card {
    position: relative;
    display: flex;
    flex-direction: column;
    text-decoration: none;
    color: inherit;
    border: 1px solid var(--border-light, #e2e8f0);
    border-radius: 12px;
    overflow: hidden;
    background: #fff;
    transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
}
.destination-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 15px -3px rgba(0,0,0,0.1), 0 4px 6px -4px rgba(0,0,0,0.1);
}
.card-actions {
    position: absolute;
    top: 12px;
    right: 12px;
    z-index: 2;
    display: flex;
    gap: 8px;
    background-color: rgba(255, 255, 255, 0.8);
    padding: 6px;
    border-radius: 8px;
    backdrop-filter: blur(4px);
    box-shadow: 0 1px 3px rgba(0,0,0,0.1);
}
.action-btn {
    background: none;
    border: none;
    cursor: pointer;
    padding: 4px;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: transform 0.2s;
}
.action-btn:hover {
    transform: scale(1.1);
}
.action-btn svg {
    transition: fill 0.2s;
}
.icon-heart { color: #ef4444; }
.icon-save { color: #3b82f6; }

.card-link {
    display: flex;
    flex-direction: column;
    height: 100%;
    text-decoration: none;
    color: inherit;
}
.destination-card-img {
    width: 100%;
    height: 200px;
    object-fit: cover;
    background-color: #f1f5f9;
}
.destination-card-content {
    padding: 16px;
    flex-grow: 1;
}
.destination-card-content h3 {
    font-size: 1.1rem;
    font-weight: 700;
    margin: 0 0 8px;
    color: #1a202c;
}
.destination-card-excerpt {
    color: #4a5568;
    font-size: 0.9rem;
    line-height: 1.5;
    margin: 0;
}
.destination-card-province {
    font-size: 0.85rem;
    color: #718096;
    margin-top: 12px;
}
</style>

