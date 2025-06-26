@props(['footer' => [], 'settings' => []])

<body class="min-h-screen bg-base-200 flex flex-col">

    <div class="flex-1 flex items-center justify-center p-4 sm:p-6 lg:p-8">
        <div class="w-full max-w-6xl grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-12 items-center">


            <div class="text-center lg:text-left space-y-6">


                <div class="flex justify-center lg:justify-start mb-8">
                    <div class="w-16 h-16 sm:w-20 sm:h-20 bg-base-300 rounded-xl flex items-center justify-center">
                        <img src="{{ $settings->site_logo ? Storage::url($settings->site_logo) : asset('icons/main.png') }}"
                            alt="Logo" class="h-24 w-auto">

                    </div>
                </div>


                <div class="space-y-4">
                    <div class="flex items-center justify-center lg:justify-start gap-3 mb-6">
                        <div class="text-4xl sm:text-5xl">🚧</div>
                        <div class="badge badge-warning badge-lg">Under Maintenance</div>
                    </div>

                    <h1 class="text-3xl sm:text-4xl lg:text-5xl xl:text-6xl font-bold text-base-content leading-tight">
                        We're Currently
                        <span class="block text-primary">Offline</span>
                    </h1>

                    <p class="text-lg sm:text-xl text-base-content opacity-80 max-w-2xl mx-auto lg:mx-0">
                        Our website is temporarily unavailable while we perform scheduled maintenance and updates to
                        improve your experience.
                    </p>
                </div>


                <div class="card bg-base-100 shadow-md border border-base-300">
                    <div class="card-body p-6">
                        <div class="flex items-center gap-3 mb-3">
                            <div class="loading loading-spinner loading-sm text-primary"></div>
                            <span class="font-semibold text-base-content">Maintenance in Progress</span>
                        </div>
                        <p class="text-base-content opacity-70 text-sm">
                            Our team is working hard to get everything back online as quickly as possible.
                        </p>
                    </div>
                </div>

            </div>


            <div class="space-y-6">


                <div class="card bg-base-100 shadow-md border border-base-300">
                    <div class="card-body p-6">
                        <h3 class="card-title text-lg mb-4">What you can do:</h3>
                        <div class="space-y-3">
                            <div class="flex items-center gap-3">
                                <div
                                    class="w-5 h-5 bg-success rounded-full flex items-center justify-center flex-shrink-0">
                                    <svg class="w-3 h-3 text-success-content" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <span class="text-base-content">Check back in a few hours</span>
                            </div>
                            <div class="flex items-center gap-3">
                                <div
                                    class="w-5 h-5 bg-success rounded-full flex items-center justify-center flex-shrink-0">
                                    <svg class="w-3 h-3 text-success-content" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <span class="text-base-content">Bookmark this page for easy access</span>
                            </div>
                            <div class="flex items-center gap-3">
                                <div
                                    class="w-5 h-5 bg-success rounded-full flex items-center justify-center flex-shrink-0">
                                    <svg class="w-3 h-3 text-success-content" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <span class="text-base-content">Follow us on social media for updates</span>
                            </div>
                        </div>
                    </div>
                </div>

                @if (!empty($footer->footer_phones))
                    <!-- Contact card -->
                    <div class="card bg-primary/10 shadow-md border border-primary/20">
                        <div class="card-body p-6">
                            <h4 class="card-title text-base-content mb-3">Need Immediate Help?</h4>
                            <p class="text-base-content opacity-70 text-sm mb-4">
                                If you have an urgent matter, please contact our support team:
                            </p>

                            <!-- Display multiple phone numbers -->
                            <div class="space-y-2">
                                @foreach ($footer->footer_phones as $phone)
                                    <a href="tel:{{ preg_replace('/[^+\d]/', '', $phone['number']) }}"
                                        class="flex items-center gap-3 bg-base-100 rounded-lg p-3 border border-primary/20 hover:bg-primary/5 transition-colors cursor-pointer">
                                        <svg class="w-5 h-5 text-primary" fill="currentColor" viewBox="0 0 20 20">
                                            <path
                                                d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z" />
                                        </svg>
                                        <span class="font-mono text-primary font-medium">{{ $phone['number'] }}</span>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Footer -->
    <div class="bg-base-100 border-t border-base-300 py-6 px-4">
        <div class="max-w-6xl mx-auto text-center">
            <div class="flex items-center justify-center gap-2 mb-2">
                <span class="text-lg font-semibold text-base-content">We'll be back soon!</span>
                <span class="text-xl">🚀</span>
            </div>
            <p class="text-sm text-base-content opacity-60">
                Thank you for your patience and understanding.
            </p>
        </div>
    </div>
</body>
