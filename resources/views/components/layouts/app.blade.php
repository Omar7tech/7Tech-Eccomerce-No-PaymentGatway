<!DOCTYPE html>
<html lang="en" data-theme="{{ $content->theme_mode ?: 'light' }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/js/app.js', 'resources/css/app.css'])
    @if ($settings->site_favicon)
        <link rel="icon" type="image/x-icon" href="{{ Storage::url($settings->site_favicon) }}">
    @else
        <link rel="icon" type="image/x-icon" href="{{ asset('icons/favicon/cart.png') }}">
    @endif


    <title>{{ $title ?? 'Page Title' }}</title>
</head>
@if ($settings->site_active)

    <body class="{{ Route::is('home') ? 'fade-in' : '' }} overflow-x-hidden">
        <div class="relative h-full w-full">

            @if ($content->announcement_active)
                <x-announcement-bar.main content="{{ $content->announcement_content }}"
                    link="{{ $content->announcement_link }}" />
            @endif

            @if ($content->nav_mode == 1)
                <x-nav.main1 :$settings :$aboutPageSettings :$content :categories=$categoriesGlobal />
            @elseif ($content->nav_mode == 2)
                <x-nav.main2 :$settings :$aboutPageSettings :$content :categories=$categoriesGlobal />
            @elseif ($content->nav_mode == 3)
                <x-nav.main3 :$settings :$aboutPageSettings :$content :categories=$categoriesGlobal />
            @else
                <x-nav.main1 :$settings :$aboutPageSettings :$content :categories=$categoriesGlobal />
            @endif

            {{ $slot }}

            @if ($footer->footer_enabled)
                @switch($footer->footer_style)
                    @case(2)
                        <x-footer.main2 :settings="$settings" :footer="$footer" />
                    @break

                    @case(3)
                        <x-footer.main3 :settings="$settings" :footer="$footer" />
                    @break

                    @default
                        <x-footer.main1 :settings="$settings" :footer="$footer" />
                @endswitch
            @endif


            <!-- Floating Chat Button -->
            @if ($customerService->active && $customerService->directChatLink)
                <x-CutomerService.chat />
            @endif


            @if ($contact->contact_enabled)
                @switch($contact->contact_design)
                    @case(2)
                        <x-contactInfo.main2 :$contact />
                    @break

                    @case(3)
                        <x-contactInfo.main3 :$contact />
                    @break

                    @default
                        <x-contactInfo.main1 :$contact />
                @endswitch
            @endif

            @if ($customerService->active && $customerService->widgetCode)
                {!! $customerService->widgetCode !!}
            @endif


            @if ($content->allow_google_translate)
                <x-GoogleTranslation.script />
            @endif


            @stack('scripts')
    </body>
@else
    <x-maintenance.main :$footer :$settings />
@endif

</html>
