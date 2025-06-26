@php
    $hasImage = $content->hero_image != null;
    $hasLink = !empty($content->hero_link);
@endphp
<div class="hero min-h-screen"
    @if ($hasImage) style="background-image: url('{{ Storage::url($content->hero_image) }}');" @endif>
    <div class="hero-overlay {{ $hasImage ? 'bg-neutral opacity-80' : 'bg-base-200' }}"></div>
    <div class="hero-content text-center {{ $hasImage ? 'text-neutral-content' : '' }}">
        <div class="max-w-md">
            <!-- Logo/Icon -->
            <div class="mb-6">
                <img src="{{ $settings->site_logo ? Storage::url($settings->site_logo) : asset('icons/main.png') }}"
                     alt="Logo" class="h-20 sm:h-24 md:h-28 lg:h-32 xl:h-36 w-auto mx-auto">
            </div>

            <h1 class="mb-5 text-5xl font-bold">{{ $content->hero_title }}</h1>
            <p class="mb-5">
                {{ $content->hero_description }}
            </p>
            @if ($hasLink)
                <a href="{{ $content->hero_link }}" class="btn btn-primary">
                    {{ $content->hero_link_text }}
                </a>
            @else
                <button onclick="scrollByScreen()" class="btn btn-primary">
                    {{ $content->hero_link_text }}
                </button>
            @endif
        </div>
    </div>
</div>
<!-- Smooth Scroll Script -->
<script>
    function scrollByScreen() {
        window.scrollBy({
            top: window.innerHeight,
            behavior: 'smooth'
        });
    }
</script>
