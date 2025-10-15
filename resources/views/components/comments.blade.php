@php
// $model là Article hoặc Destination được truyền vào
$actionRoute = $model instanceof \App\Models\Article
? route('comments.store.article', $model)
: route('comments.store.destination', $model);
@endphp

<section class="mt-12">
    {{-- Tiêu đề khối --}}
    <div class="mb-6 flex items-center gap-3">
        <div class="w-10 h-10 rounded-2xl bg-gradient-to-br from-blue-500 to-indigo-500 shadow-md"></div>
        <h2 class="text-2xl font-bold">Bình luận</h2>
    </div>

    {{-- Danh sách bình luận --}}
    <div class="space-y-4">
        @forelse($model->comments as $c)
        <div class="p-4 rounded-xl border border-slate-200/70 bg-white shadow-sm hover:shadow transition">
            <div class="flex items-start gap-3">
                <div
                    class="w-10 h-10 rounded-full bg-slate-200 flex items-center justify-center uppercase font-semibold">
                    {{ mb_substr($c->user->name ?? 'U', 0, 1) }}
                </div>
                <div class="flex-1">
                    <div class="text-sm text-slate-600">
                        <span class="font-medium text-slate-900">{{ $c->user->name ?? 'Người dùng' }}</span>
                        <span class="mx-1">•</span>
                        <time datetime="{{ $c->created_at }}">{{ $c->created_at->diffForHumans() }}</time>
                    </div>
                    <p class="mt-2 leading-relaxed text-slate-800">{{ $c->body }}</p>

                    @auth
                    @if($c->user_id === auth()->id())
                    <form action="{{ route('comments.destroy', $c) }}" method="POST" class="mt-2">
                        @csrf @method('DELETE')
                        <button class="text-xs text-red-600 hover:underline">Xoá</button>
                    </form>
                    @endif
                    @endauth
                </div>
            </div>
        </div>
        @empty
        <div class="p-6 rounded-xl border border-dashed border-slate-300 text-slate-500">
            Chưa có bình luận nào. Hãy là người đầu tiên!
        </div>
        @endforelse
    </div>

    {{-- Form gửi bình luận --}}
    <div class="mt-6">
        @auth
        <form action="{{ $actionRoute }}" method="POST" id="comment-form" class="group">
            @csrf
            <label class="block mb-2 font-medium text-slate-700">Viết bình luận</label>
            <textarea name="body" rows="3"
                class="w-full rounded-xl border-slate-300 focus:border-indigo-500 focus:ring-indigo-500 transition"
                placeholder="Chia sẻ cảm nhận của bạn..." required></textarea>
            @error('body')
            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror

            <div class="mt-3 flex items-center gap-3">
                <button
                    class="px-4 py-2 rounded-xl bg-gradient-to-r from-indigo-500 to-blue-500 text-white font-semibold shadow hover:shadow-md active:scale-[.99] transition">
                    Gửi bình luận
                </button>
                @if(session('success'))
                <span class="text-sm text-green-600">{{ session('success') }}</span>
                @endif
            </div>
        </form>
        @else
        <div class="p-5 rounded-xl border border-amber-300 bg-amber-50 text-amber-800">
            <div class="font-semibold">Bạn cần đăng nhập để bình luận</div>
            <div class="mt-2 text-sm">
                <a href="{{ route('login') }}"
                    class="inline-block px-3 py-1.5 rounded-lg bg-amber-600 text-white hover:bg-amber-700 transition">
                    Đăng nhập ngay
                </a>
            </div>
        </div>

        {{-- Nếu khách cố bấm gửi (ví dụ tự mở DevTools), vẫn chặn ở backend vì route POST đã có middleware auth --}}
        @endauth
    </div>

    {{-- Style nhỏ gọn (nếu bạn không dùng Tailwind, có thể copy sang CSS riêng) --}}
    <style>
    .rounded-2xl {
        border-radius: 1rem
    }

    .rounded-xl {
        border-radius: .75rem
    }

    .shadow {
        box-shadow: 0 6px 18px rgba(0, 0, 0, .06)
    }

    .shadow-sm {
        box-shadow: 0 4px 14px rgba(0, 0, 0, .05)
    }

    .hover\:shadow:hover {
        box-shadow: 0 8px 22px rgba(0, 0, 0, .08)
    }

    .hover\:shadow-md:hover {
        box-shadow: 0 10px 28px rgba(0, 0, 0, .12)
    }

    .transition {
        transition: all .2s ease
    }
    </style>
</section>