@props(['destination', 'isFavorited', 'isSaved'])

@auth
<div class="action-buttons flex items-center gap-4 my-4">
    <form action="{{ route('destinations.toggleFavorite', $destination->slug) }}" method="POST" class="toggle-favorite-form">
        @csrf
        <button type="submit" class="favorite-btn p-2 rounded-full transition-colors duration-300 flex items-center gap-2 text-sm font-semibold {{ $isFavorited ? 'bg-red-500 text-white' : 'bg-gray-200 text-gray-700 hover:bg-red-100' }}">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd" />
            </svg>
            <span class="button-text">{{ $isFavorited ? 'Đã thích' : 'Yêu thích' }}</span>
        </button>
    </form>

    <form action="{{ route('destinations.toggleSave', $destination->slug) }}" method="POST" class="toggle-save-form">
        @csrf
        <button type="submit" class="save-btn p-2 rounded-full transition-colors duration-300 flex items-center gap-2 text-sm font-semibold {{ $isSaved ? 'bg-blue-600 text-white' : 'bg-gray-200 text-gray-700 hover:bg-blue-100' }}">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                <path d="M5 4a2 2 0 012-2h6a2 2 0 012 2v14l-5-3.13L5 18V4z" />
            </svg>
            <span class="button-text">{{ $isSaved ? 'Đã lưu' : 'Lưu lại' }}</span>
        </button>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.toggle-favorite-form').forEach(form => {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            handleToggle(this, 'favorite-btn', {
                activeClass: 'bg-red-500 text-white',
                inactiveClass: 'bg-gray-200 text-gray-700 hover:bg-red-100',
                activeText: 'Đã thích',
                inactiveText: 'Yêu thích'
            });
        });
    });

    document.querySelectorAll('.toggle-save-form').forEach(form => {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            handleToggle(this, 'save-btn', {
                activeClass: 'bg-blue-600 text-white',
                inactiveClass: 'bg-gray-200 text-gray-700 hover:bg-blue-100',
                activeText: 'Đã lưu',
                inactiveText: 'Lưu lại'
            });
        });
    });

    function handleToggle(form, btnClass, styles) {
        const action = form.action;
        const token = form.querySelector('input[name="_token"]').value;
        const button = form.querySelector('.' + btnClass);
        const buttonText = button.querySelector('.button-text');

        fetch(action, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': token,
                'Accept': 'application/json',
            },
        })
        .then(response => response.json())
        .then(data => {
            const isActive = data.favorited !== undefined ? data.favorited : data.saved;

            button.className = `${btnClass} p-2 rounded-full transition-colors duration-300 flex items-center gap-2 text-sm font-semibold ${isActive ? styles.activeClass : styles.inactiveClass}`;
            buttonText.textContent = isActive ? styles.activeText : styles.inactiveText;
        })
        .catch(error => console.error('Error:', error));
    }
});
</script>
@endauth
