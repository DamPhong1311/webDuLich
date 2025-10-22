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
        @endauth
    </div>
    <style>
    :root {
        --bg: #f8fafc;

        --card: #fff;

        --muted: #64748b;

        --text: #0f172a;

        --ring: #6366f1;

        --ring-2: #3b82f6;

        --border: rgba(15, 23, 42, .08);
        --shadow-sm: 0 6px 20px rgba(2, 6, 23, .06);
        --shadow-md: 0 12px 30px rgba(2, 6, 23, .12);
        --grad-1: linear-gradient(135deg, #60a5fa 0%, #6366f1 100%);
        --grad-2: linear-gradient(90deg, #6366f1 0%, #3b82f6 100%);
    }

    @media (prefers-color-scheme: dark) {
        :root {
            --bg: #0b1220;

            --card: #0f172a;

            --muted: #94a3b8;

            --text: #e2e8f0;

            --border: rgba(226, 232, 240, .08);
            --shadow-sm: 0 6px 20px rgba(0, 0, 0, .35);
            --shadow-md: 0 14px 36px rgba(0, 0, 0, .5);
        }
    }

    .mt-12 {
        scroll-margin-top: 96px;
    }

    .mt-12>.mb-6 {
        align-items: center;
    }

    .mt-12>.mb-6 .w-10.h-10 {
        background: var(--grad-1) !important;
        box-shadow: 0 12px 30px rgba(99, 102, 241, .35);
        position: relative;
        isolation: isolate;
    }

    .mt-12>.mb-6 .w-10.h-10::after {
        content: "";
        position: absolute;
        inset: 0;
        border-radius: 1rem;
        background: radial-gradient(120px 60px at 20% 120%, rgba(255, 255, 255, .35), transparent 60%);
        mix-blend-mode: overlay;
    }

    .mt-12 h2 {
        color: var(--text);
        letter-spacing: .2px;
        display: flex;
        gap: .6rem;
        align-items: center;
    }

    .mt-12 h2::after {
        content: "";
        display: inline-block;
        width: 42px;
        height: 6px;
        border-radius: 999px;
        background: var(--grad-2);
        opacity: .25;
        transform: translateY(2px);
    }

    .space-y-4 {
        gap: 14px;
        display: grid;
    }

    @media (min-width: 720px) {
        .space-y-4 {
            gap: 16px;
        }
    }

    /* Card */
    .space-y-4>.p-4 {
        border: 1px solid var(--border) !important;
        background: var(--card) !important;
        box-shadow: var(--shadow-sm) !important;
        transition: transform .18s ease, box-shadow .18s ease, border-color .18s ease, background .18s ease;
        position: relative;
        overflow: hidden;
    }

    .space-y-4>.p-4::before {
        content: "";
        position: absolute;
        inset: -1px -1px auto -1px;
        height: 3px;
        background: var(--grad-2);
        opacity: .0;
        transition: opacity .25s ease;
    }

    .space-y-4>.p-4:hover {
        transform: translateY(-2px);
        box-shadow: var(--shadow-md) !important;
        border-color: rgba(99, 102, 241, .25) !important;
    }

    .space-y-4>.p-4:hover::before {
        opacity: .85;
    }

    /* Avatar */
    .w-10.h-10.rounded-full {
        background: linear-gradient(135deg, #e2e8f0, #cbd5e1);
        color: #0f172a;
        border: 1px solid rgba(2, 6, 23, .05);
        box-shadow: inset 0 1px 0 rgba(255, 255, 255, .7);
    }

    /* Meta line */
    .text-sm.text-slate-600 {
        color: var(--muted) !important;
        display: flex;
        flex-wrap: wrap;
        gap: .35rem .5rem;
    }

    .text-sm.text-slate-600 .font-medium {
        color: var(--text) !important;
    }

    .text-sm time {
        opacity: .9;
    }

    .leading-relaxed {
        color: var(--text) !important;
        line-height: 1.75;
        font-size: 1.02rem;
    }

    .leading-relaxed+form {
        margin-top: .55rem !important;
    }

    button.text-xs.text-red-600 {
        padding: .35rem .6rem;
        border-radius: .55rem;
        border: 1px solid rgba(239, 68, 68, .25);
        background: rgba(239, 68, 68, .06);
        font-weight: 600;
        transition: transform .15s ease, background .15s ease, border-color .15s ease;
    }

    button.text-xs.text-red-600:hover {
        background: rgba(239, 68, 68, .12);
        border-color: rgba(239, 68, 68, .35);
    }

    button.text-xs.text-red-600:active {
        transform: translateY(1px);
    }

    .border-dashed.border-slate-300 {
        border-color: var(--border) !important;
        color: var(--muted) !important;
        background: linear-gradient(180deg, rgba(99, 102, 241, .05), transparent 40%),
            var(--card);
        text-align: center;
    }

    #comment-form label {
        color: var(--text);
        display: flex;
        align-items: center;
        gap: .5rem;
    }

    #comment-form label::before {
        content: "✍️";
        font-size: 1.05rem;
        opacity: .9;
    }

    #comment-form textarea {
        background: var(--card);
        color: var(--text);
        border: 1px solid var(--border) !important;
        border-radius: .9rem !important;
        padding: .9rem 1rem;
        box-shadow: inset 0 1px 0 rgba(255, 255, 255, .25);
        transition: border-color .18s ease, box-shadow .18s ease, transform .06s ease;
        resize: vertical;
    }

    #comment-form textarea::placeholder {
        color: color-mix(in oklab, var(--muted) 78%, var(--text));
    }

    #comment-form textarea:focus {
        outline: none;
        border-color: color-mix(in srgb, var(--ring) 60%, #fff 40%) !important;
        box-shadow: 0 0 0 4px color-mix(in srgb, var(--ring) 15%, transparent), 0 0 0 1px color-mix(in srgb, var(--ring) 50%, transparent);
    }

    #comment-form .text-sm.text-red-600 {
        margin-top: .45rem;
        font-weight: 600;
    }

    #comment-form .mt-3 {
        display: flex;
        align-items: center;
        gap: .6rem;
    }

    #comment-form .px-4.py-2 {
        background: var(--grad-2) !important;
        border: 1px solid rgba(99, 102, 241, .35);
        border-radius: 0.9rem !important;
        box-shadow: 0 10px 22px rgba(59, 130, 246, .25), inset 0 1px 0 rgba(255, 255, 255, .25);
        will-change: transform, box-shadow;
    }

    #comment-form .px-4.py-2:hover {
        box-shadow: 0 14px 30px rgba(99, 102, 241, .35), inset 0 1px 0 rgba(255, 255, 255, .25);
        transform: translateY(-1px);
    }

    #comment-form .px-4.py-2:active {
        transform: translateY(0);
        box-shadow: 0 8px 18px rgba(99, 102, 241, .28);
    }

    .text-sm.text-green-600 {
        font-weight: 600;
        padding: .4rem .6rem;
        border-radius: .55rem;
        background: rgba(16, 185, 129, .08);
        border: 1px solid rgba(16, 185, 129, .25);
    }

    .border-amber-300 {
        border-radius: .9rem !important;
        border-width: 1px !important;
        background: linear-gradient(180deg, rgba(251, 191, 36, .10), transparent 55%),
            color-mix(in srgb, #fff 70%, #fde68a) !important;
        border-color: color-mix(in srgb, #f59e0b 50%, #fcd34d 50%) !important;
    }

    .border-amber-300 .font-semibold {
        color: #92400e;
    }

    .border-amber-300 .text-sm {
        color: #a16207;
    }

    .bg-amber-600 {
        border: 1px solid rgba(217, 119, 6, .4);
        box-shadow: 0 10px 22px rgba(217, 119, 6, .25), inset 0 1px 0 rgba(255, 255, 255, .35);
        border-radius: .7rem !important;
    }

    .bg-amber-600:hover {
        filter: brightness(1.05);
    }

    .bg-amber-600:active {
        transform: translateY(1px);
    }

    .rounded-2xl {
        border-radius: 1rem
    }

    .rounded-xl {
        border-radius: .9rem
    }

    .shadow {
        box-shadow: var(--shadow-md)
    }

    .shadow-sm {
        box-shadow: var(--shadow-sm)
    }

    .hover\:shadow:hover {
        box-shadow: var(--shadow-md)
    }

    .hover\:shadow-md:hover {
        box-shadow: var(--shadow-md)
    }

    .transition {
        transition: all .2s ease
    }

    .p-4.rounded-xl.border.bg-white.shadow-sm:hover .w-10.h-10.rounded-full {
        transform: translateY(-1px);
        transition: transform .18s ease;
    }

    button,
    a,
    textarea {
        -webkit-tap-highlight-color: transparent;
    }

    button:focus-visible,
    a:focus-visible {
        outline: 3px solid color-mix(in srgb, var(--ring) 60%, transparent);
        outline-offset: 3px;
        border-radius: .7rem;
    }

    /* ---- Tailwind-lite shim cho khối bình luận ---- */
    .mt-12 .flex {
        display: flex
    }

    .mt-12 .items-start {
        align-items: flex-start
    }

    .mt-12 .items-center {
        align-items: center
    }

    .mt-12 .justify-center {
        justify-content: center
    }

    .mt-12 .gap-3 {
        gap: .75rem
    }

    .mt-12 .flex-1 {
        flex: 1 1 auto
    }

    /* Kích thước avatar và bo tròn */
    .mt-12 .w-10 {
        width: 2.5rem
    }

    .mt-12 .h-10 {
        height: 2.5rem
    }

    .mt-12 .rounded-full {
        border-radius: 9999px
    }

    /* Chữ cái avatar */
    .mt-12 .uppercase {
        text-transform: uppercase
    }

    .mt-12 .font-semibold {
        font-weight: 600
    }

    /* Cỡ chữ meta */
    .mt-12 .text-sm {
        font-size: .875rem;
        line-height: 1.25rem
    }

    /* Khoảng cách dùng trong block này */
    .mt-12 .mt-2 {
        margin-top: .5rem
    }

    .mt-12 .mt-3 {
        margin-top: .75rem
    }

    .mt-12 .mb-6 {
        margin-bottom: 1.5rem
    }

    .mt-12 .p-4 {
        padding: 1rem
    }

    .mt-12 .p-5 {
        padding: 1.25rem
    }

    .mt-12 .p-6 {
        padding: 1.5rem
    }
    </style>

</section>