{{-- resources/views/filament/components/tawk-guide.blade.php --}}

<div class="space-y-6">
    {{-- Download Tawk App Section --}}
    <div class="fi-section-content-ctn rounded-xl bg-white shadow-sm ring-1 ring-gray-950/5 dark:bg-gray-900 dark:ring-white/10">
        <div class="fi-section-content p-6">
            <div class="flex items-center justify-between">
                <div class="flex-1">
                    <h3 class="fi-section-header-heading text-base font-semibold leading-6 text-gray-950 dark:text-white mb-2">
                        Step 1: Download Tawk.to Mobile App
                    </h3>
                    <p class="fi-section-header-description text-sm text-gray-500 dark:text-gray-400 mb-4">
                        Download the Tawk.to mobile app to manage your live chat on the go.
                        Scan the QR code below with your phone camera to get the app.
                    </p>

                    {{-- QR Code Placeholder --}}
                    <div class=" border-2 border-dashed border-gray-300 dark:border-gray-600 bg-gray-50 dark:bg-gray-800 p-4 text-center">
                        <div class="w-32 h-32 mx-auto bg-white dark:bg-gray-700 rounded-lg flex items-center justify-center mb-2 shadow-sm">

                            <img src="{{ asset('icons/tawk.png') }}" alt="Tawk.to App QR Code" class="w-full h-full object-contain rounded-lg">

                        </div>
                        <p class="text-sm text-gray-600 dark:text-gray-300">Scan to download Tawk.to mobile app</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Setup Steps --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <div class="fi-section-content-ctn rounded-xl bg-white shadow-sm ring-1 ring-gray-950/5 dark:bg-gray-900 dark:ring-white/10">
            <div class="fi-section-content p-4">
                <div class="flex items-center mb-3">
                    <div class="w-8 h-8 bg-primary-600 text-white rounded-full flex items-center justify-center text-sm font-semibold mr-3">2</div>
                    <h4 class="font-medium text-gray-950 dark:text-white">Create Account</h4>
                </div>
                <p class="text-sm text-gray-500 dark:text-gray-400">
                    Sign up at tawk.to and add your website domain to get your widget code.
                </p>
            </div>
        </div>

        <div class="fi-section-content-ctn rounded-xl bg-white shadow-sm ring-1 ring-gray-950/5 dark:bg-gray-900 dark:ring-white/10">
            <div class="fi-section-content p-4">
                <div class="flex items-center mb-3">
                    <div class="w-8 h-8 bg-primary-600 text-white rounded-full flex items-center justify-center text-sm font-semibold mr-3">3</div>
                    <h4 class="font-medium text-gray-950 dark:text-white">Copy Widget Code</h4>
                </div>
                <p class="text-sm text-gray-500 dark:text-gray-400">
                    Get your widget code from Tawk.to dashboard and paste it in the configuration below.
                </p>
            </div>
        </div>

        <div class="fi-section-content-ctn rounded-xl bg-white shadow-sm ring-1 ring-gray-950/5 dark:bg-gray-900 dark:ring-white/10">
            <div class="fi-section-content p-4">
                <div class="flex items-center mb-3">
                    <div class="w-8 h-8 bg-success-600 text-white rounded-full flex items-center justify-center text-sm font-semibold mr-3">4</div>
                    <h4 class="font-medium text-gray-950 dark:text-white">Enable & Test</h4>
                </div>
                <p class="text-sm text-gray-500 dark:text-gray-400">
                    Enable the toggle below and test the chat widget on your website.
                </p>
            </div>
        </div>
    </div>

    {{-- Quick Links --}}
    <div class="fi-section-content-ctn rounded-xl bg-white shadow-sm ring-1 ring-gray-950/5 dark:bg-gray-900 dark:ring-white/10">
        <div class="fi-section-content p-4">
            <h4 class="font-medium text-gray-950 dark:text-white mb-2">Quick Links:</h4>
            <div class="flex flex-wrap gap-2">
                <a href="https://www.tawk.to" target="_blank" class="fi-badge inline-flex items-center gap-x-1 rounded-md px-2 py-1 text-xs font-medium ring-1 ring-inset bg-primary-50 text-primary-700 ring-primary-600/10 dark:bg-primary-400/10 dark:text-primary-400 dark:ring-primary-400/30 hover:bg-primary-100 dark:hover:bg-primary-400/20">
                    🌐 Tawk.to Website
                </a>
                <a href="https://dashboard.tawk.to" target="_blank" class="fi-badge inline-flex items-center gap-x-1 rounded-md px-2 py-1 text-xs font-medium ring-1 ring-inset bg-success-50 text-success-700 ring-success-600/10 dark:bg-success-400/10 dark:text-success-400 dark:ring-success-400/30 hover:bg-success-100 dark:hover:bg-success-400/20">
                    📊 Dashboard
                </a>
            </div>
        </div>
    </div>
</div>
