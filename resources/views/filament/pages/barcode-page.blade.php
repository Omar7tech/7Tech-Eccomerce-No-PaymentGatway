@php
    $homepageUrl = url('/');
@endphp

<x-filament::page x-data="{ activeTab: 'tab1' }">
    <x-filament::section>
        <div class="w-full">
            <!-- Header Section -->
            <div class="text-center mb-8">
                <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-3">
                    Homepage QR Code
                </h1>
                <p class="text-gray-600 dark:text-gray-400 max-w-2xl mx-auto">
                    Generate and download a QR code for quick access to your website's homepage. Perfect for
                    business
                    cards, marketing materials, or easy sharing.
                </p>
            </div>

            <div class="grid grid-cols-1 xl:grid-cols-3 gap-8">
                <!-- QR Code Section -->
                <div class="xl:col-span-1 space-y-6">
                    <x-filament::section>
                        <x-slot name="heading">
                            QR Code
                        </x-slot>

                        <div class="flex flex-col items-center space-y-4">
                            <!-- QR Code Display -->
                            <div class="bg-white p-6 rounded-lg border border-gray-200 dark:border-gray-700">
                                {!! QrCode::size(200)->margin(2)->generate($homepageUrl) !!}
                            </div>

                            <!-- URL Display -->
                            <div class="w-full">
                                <x-filament::input.wrapper>
                                    <x-filament::input type="text" value="{{ $homepageUrl }}" readonly
                                        class="font-mono text-sm" />
                                </x-filament::input.wrapper>
                            </div>

                            <!-- Download Button -->
                            <div class="w-full">
                                <x-filament::button tag="a"
                                    href="https://api.qrserver.com/v1/create-qr-code/?size=400x400&data={{ urlencode($homepageUrl) }}"
                                    download="homepage-qr.png" icon="heroicon-o-arrow-down-tray"
                                    class="w-full justify-center">
                                    Download QR Code
                                </x-filament::button>
                            </div>
                        </div>
                    </x-filament::section>
                </div>

                <!-- Information Section -->
                <div class="xl:col-span-2 space-y-6">
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                        <x-filament::section>
                            <x-slot name="heading">
                                How to Use
                            </x-slot>

                            <div class="space-y-4">
                                <div class="flex items-start space-x-3">
                                    <div
                                        class="flex-shrink-0 w-6 h-6 bg-primary-100 dark:bg-primary-900 rounded-full flex items-center justify-center">
                                        <span
                                            class="text-xs font-semibold text-primary-600 dark:text-primary-400">1</span>
                                    </div>
                                    <div>
                                        <h3 class="font-medium text-gray-900 dark:text-white">Scan with Mobile
                                            Device
                                        </h3>
                                        <p class="text-sm text-gray-600 dark:text-gray-400">Open your phone's camera
                                            app
                                            and point it at the QR code to scan.</p>
                                    </div>
                                </div>

                                <div class="flex items-start space-x-3">
                                    <div
                                        class="flex-shrink-0 w-6 h-6 bg-primary-100 dark:bg-primary-900 rounded-full flex items-center justify-center">
                                        <span
                                            class="text-xs font-semibold text-primary-600 dark:text-primary-400">2</span>
                                    </div>
                                    <div>
                                        <h3 class="font-medium text-gray-900 dark:text-white">Download & Print</h3>
                                        <p class="text-sm text-gray-600 dark:text-gray-400">Download the QR code
                                            image
                                            for use in printed materials or digital sharing.</p>
                                    </div>
                                </div>

                                <div class="flex items-start space-x-3">
                                    <div
                                        class="flex-shrink-0 w-6 h-6 bg-primary-100 dark:bg-primary-900 rounded-full flex items-center justify-center">
                                        <span
                                            class="text-xs font-semibold text-primary-600 dark:text-primary-400">3</span>
                                    </div>
                                    <div>
                                        <h3 class="font-medium text-gray-900 dark:text-white">Share Easily</h3>
                                        <p class="text-sm text-gray-600 dark:text-gray-400">Include the QR code in
                                            business cards, flyers, or digital presentations.</p>
                                    </div>
                                </div>
                            </div>
                        </x-filament::section>

                        <x-filament::section>
                            <x-slot name="heading">
                                QR Code Details
                            </x-slot>

                            <div class="space-y-3">
                                <div class="flex justify-between py-2 border-b border-gray-200 dark:border-gray-700">
                                    <span class="text-sm font-medium text-gray-600 dark:text-gray-400">Target
                                        URL</span>
                                    <span
                                        class="text-sm text-gray-900 dark:text-white font-mono">{{ parse_url($homepageUrl, PHP_URL_HOST) }}</span>
                                </div>
                                <div class="flex justify-between py-2 border-b border-gray-200 dark:border-gray-700">
                                    <span class="text-sm font-medium text-gray-600 dark:text-gray-400">QR Code
                                        Size</span>
                                    <span class="text-sm text-gray-900 dark:text-white">200x200 pixels</span>
                                </div>
                                <div class="flex justify-between py-2 border-b border-gray-200 dark:border-gray-700">
                                    <span class="text-sm font-medium text-gray-600 dark:text-gray-400">Download
                                        Size</span>
                                    <span class="text-sm text-gray-900 dark:text-white">400x400 pixels</span>
                                </div>
                                <div class="flex justify-between py-2">
                                    <span class="text-sm font-medium text-gray-600 dark:text-gray-400">Format</span>
                                    <span class="text-sm text-gray-900 dark:text-white">PNG</span>
                                </div>
                            </div>
                        </x-filament::section>
                    </div>
                </div>

                <!-- Additional Actions -->
                <div class="mt-8 pt-6 border-t border-gray-200 dark:border-gray-700">
                    <div class="flex flex-col sm:flex-row gap-4">
                        <x-filament::button color="gray" outlined icon="heroicon-o-link"
                            onclick="copyToClipboard('{{ $homepageUrl }}')">
                            Copy URL
                        </x-filament::button>

                        <x-filament::button color="gray" outlined icon="heroicon-o-arrow-path"
                            onclick="window.location.reload()">
                            Regenerate QR Code
                        </x-filament::button>
                    </div>
                </div>
            </div>
        </div>

        <script>
            function copyToClipboard(text) {
                navigator.clipboard.writeText(text).then(function() {
                    // Simple feedback without animations
                    const originalText = event.target.textContent;
                    event.target.textContent = 'Copied!';
                    setTimeout(() => {
                        event.target.textContent = originalText;
                    }, 2000);
                });
            }
        </script>

    </x-filament::section>
</x-filament::page>
