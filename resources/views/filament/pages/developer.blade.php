<x-filament-panels::page>
    <x-filament::section>
        <div class="space-y-3">


        {{-- Profile Header --}}
        <div class="flex items-center gap-6 mb-8 pb-6 border-b border-gray-200 dark:border-gray-700 transition-colors duration-200">
            <div class="w-20 h-20 rounded-full overflow-hidden ring-2 ring-primary-200 dark:ring-primary-800 transition-all duration-200">
                <img src="{{ asset('icons/developer.jpg') }}" alt="Omar Abi Farraj" class="w-full h-full object-cover">
            </div>
            <div class="flex-1">
                <h1 class="text-2xl font-bold text-gray-900 dark:text-white mb-1 transition-colors duration-200">
                    Omar Abi Farraj <span class="text-primary-600 dark:text-primary-400 transition-colors duration-200">(Omar7tech)</span>
                </h1>
                <p class="text-gray-600 dark:text-gray-300 mb-2 transition-colors duration-200">Full‑Stack Web & Backend Engineer • 5 years experience</p>
                <div class="flex flex-wrap items-center gap-4 text-sm text-gray-500 dark:text-gray-400 transition-colors duration-200">
                    <span class="flex items-center gap-1">
                        <x-heroicon-o-phone class="w-4 h-4 text-gray-500 dark:text-gray-400" />
                        +961 71 387 946
                    </span>
                    <span class="flex items-center gap-1">
                        <x-heroicon-o-map-pin class="w-4 h-4 text-gray-500 dark:text-gray-400" />
                        Beirut, Lebanon
                    </span>
                    <span class="flex items-center gap-1">
                        <x-heroicon-o-star class="w-4 h-4 text-yellow-500 dark:text-yellow-400" />
                        #146 Lebanon
                    </span>
                    <span class="flex items-center gap-1">
                        <x-heroicon-o-folder class="w-4 h-4 text-gray-500 dark:text-gray-400" />
                        25 repos, 27★
                    </span>
                </div>
            </div>
        </div>

        {{-- Skills Grid --}}
        <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-8 gap-3 mb-8">
            <div class="text-center p-3 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg shadow-sm dark:shadow-gray-900/20 hover:shadow-md dark:hover:shadow-gray-900/40 transition-all duration-200">
                <x-heroicon-o-server class="w-5 h-5 text-red-600 dark:text-red-400 mx-auto mb-2 transition-colors duration-200" />
                <h3 class="font-medium text-gray-900 dark:text-white text-xs mb-1 transition-colors duration-200">Backend</h3>
                <p class="text-[10px] text-gray-600 dark:text-gray-400 transition-colors duration-200">PHP, Laravel, Go, Node.js</p>
            </div>
            <div class="text-center p-3 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg shadow-sm dark:shadow-gray-900/20 hover:shadow-md dark:hover:shadow-gray-900/40 transition-all duration-200">
                <x-heroicon-o-computer-desktop class="w-5 h-5 text-blue-600 dark:text-blue-400 mx-auto mb-2 transition-colors duration-200" />
                <h3 class="font-medium text-gray-900 dark:text-white text-xs mb-1 transition-colors duration-200">Frontend</h3>
                <p class="text-[10px] text-gray-600 dark:text-gray-400 transition-colors duration-200">Vue.js, Nuxt</p>
            </div>
            <div class="text-center p-3 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg shadow-sm dark:shadow-gray-900/20 hover:shadow-md dark:hover:shadow-gray-900/40 transition-all duration-200">
                <x-heroicon-o-circle-stack class="w-5 h-5 text-green-600 dark:text-green-400 mx-auto mb-2 transition-colors duration-200" />
                <h3 class="font-medium text-gray-900 dark:text-white text-xs mb-1 transition-colors duration-200">Database</h3>
                <p class="text-[10px] text-gray-600 dark:text-gray-400 transition-colors duration-200">MySQL, PostgreSQL</p>
            </div>
            <div class="text-center p-3 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg shadow-sm dark:shadow-gray-900/20 hover:shadow-md dark:hover:shadow-gray-900/40 transition-all duration-200">
                <x-heroicon-o-wrench-screwdriver class="w-5 h-5 text-purple-600 dark:text-purple-400 mx-auto mb-2 transition-colors duration-200" />
                <h3 class="font-medium text-gray-900 dark:text-white text-xs mb-1 transition-colors duration-200">Tools</h3>
                <p class="text-[10px] text-gray-600 dark:text-gray-400 transition-colors duration-200">Linux, Git, Vim, Bash</p>
            </div>
        </div>

        {{-- Experience & Projects --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
            <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg p-4 shadow-sm dark:shadow-gray-900/20 transition-all duration-200">
                <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-4 flex items-center gap-2 transition-colors duration-200">
                    <x-heroicon-o-briefcase class="w-5 h-5 text-gray-600 dark:text-gray-400" />
                    Experience
                </h2>
                <div class="space-y-4">
                    <div class="flex items-start gap-3 text-sm">
                        <div class="w-2 h-2 bg-primary-600 dark:bg-primary-400 rounded-full mt-2 flex-shrink-0 transition-colors duration-200"></div>
                        <div>
                            <div class="font-medium text-gray-900 dark:text-white transition-colors duration-200">Backend Engineer</div>
                            <div class="text-gray-600 dark:text-gray-400 transition-colors duration-200">at Omar7tech (2019-now)</div>
                        </div>
                    </div>
                    <div class="flex items-start gap-3 text-sm">
                        <div class="w-2 h-2 bg-blue-600 dark:bg-blue-400 rounded-full mt-2 flex-shrink-0 transition-colors duration-200"></div>
                        <div>
                            <div class="font-medium text-gray-900 dark:text-white transition-colors duration-200">Freelance Developer</div>
                            <div class="text-gray-600 dark:text-gray-400 transition-colors duration-200">(2019-now)</div>
                        </div>
                    </div>
                    <div class="flex items-start gap-3 text-sm">
                        <div class="w-2 h-2 bg-green-600 dark:bg-green-400 rounded-full mt-2 flex-shrink-0 transition-colors duration-200"></div>
                        <div>
                            <div class="font-medium text-gray-900 dark:text-white transition-colors duration-200">Computer Technician</div>
                            <div class="text-gray-600 dark:text-gray-400 transition-colors duration-200">(2017-now)</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg p-4 shadow-sm dark:shadow-gray-900/20 transition-all duration-200">
                <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-4 flex items-center gap-2 transition-colors duration-200">
                    <x-heroicon-o-folder class="w-5 h-5 text-gray-600 dark:text-gray-400" />
                    Projects
                </h2>
                <div class="space-y-3 text-sm">
                    <div class="flex items-center gap-2 text-gray-700 dark:text-gray-300 transition-colors duration-200">
                        <div class="w-1.5 h-1.5 bg-primary-500 dark:bg-primary-400 rounded-full flex-shrink-0"></div>
                        Human Resource System
                    </div>
                    <div class="flex items-center gap-2 text-gray-700 dark:text-gray-300 transition-colors duration-200">
                        <div class="w-1.5 h-1.5 bg-primary-500 dark:bg-primary-400 rounded-full flex-shrink-0"></div>
                        Fry Jay's Menu Site
                    </div>
                    <div class="flex items-center gap-2 text-gray-700 dark:text-gray-300 transition-colors duration-200">
                        <div class="w-1.5 h-1.5 bg-primary-500 dark:bg-primary-400 rounded-full flex-shrink-0"></div>
                        Laravel Queue Optimization
                    </div>
                    <div class="flex items-center gap-2 text-gray-700 dark:text-gray-300 transition-colors duration-200">
                        <div class="w-1.5 h-1.5 bg-primary-500 dark:bg-primary-400 rounded-full flex-shrink-0"></div>
                        API Collections & More
                    </div>
                </div>
            </div>
        </div>

        {{-- Contact Links --}}
        <div class="border-t border-gray-200 dark:border-gray-700 pt-6 transition-colors duration-200">
            <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-4 flex items-center gap-2 transition-colors duration-200">
                <x-heroicon-o-envelope class="w-5 h-5 text-gray-600 dark:text-gray-400" />
                Contact
            </h2>
            <div class="flex flex-wrap gap-3">
                <a href="mailto:omar.7tech@gmail.com" class="inline-flex items-center gap-2 px-4 py-2 bg-red-50 dark:bg-red-900/20 text-red-700 dark:text-red-300 border border-red-200 dark:border-red-800 rounded-lg hover:bg-red-100 dark:hover:bg-red-900/30 hover:border-red-300 dark:hover:border-red-700 transition-all duration-200 text-sm font-medium">
                    <x-heroicon-o-envelope class="w-4 h-4" />
                    Email
                </a>
                <a href="https://wa.me/96171387946" target="_blank" class="inline-flex items-center gap-2 px-4 py-2 bg-green-50 dark:bg-green-900/20 text-green-700 dark:text-green-300 border border-green-200 dark:border-green-800 rounded-lg hover:bg-green-100 dark:hover:bg-green-900/30 hover:border-green-300 dark:hover:border-green-700 transition-all duration-200 text-sm font-medium">
                    <x-heroicon-o-chat-bubble-left-ellipsis class="w-4 h-4" />
                    WhatsApp
                </a>
                <a href="tel:+96171387946" class="inline-flex items-center gap-2 px-4 py-2 bg-blue-50 dark:bg-blue-900/20 text-blue-700 dark:text-blue-300 border border-blue-200 dark:border-blue-800 rounded-lg hover:bg-blue-100 dark:hover:bg-blue-900/30 hover:border-blue-300 dark:hover:border-blue-700 transition-all duration-200 text-sm font-medium">
                    <x-heroicon-o-phone class="w-4 h-4" />
                    Call
                </a>
                <a href="https://github.com/Omar7tech" target="_blank" class="inline-flex items-center gap-2 px-4 py-2 bg-gray-50 dark:bg-gray-800 text-gray-700 dark:text-gray-300 border border-gray-200 dark:border-gray-700 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 hover:border-gray-300 dark:hover:border-gray-600 transition-all duration-200 text-sm font-medium">
                    <x-heroicon-o-code-bracket class="w-4 h-4" />
                    GitHub
                </a>
                <a href="https://linkedin.com/in/omar-abi-farraj-a24429284" target="_blank" class="inline-flex items-center gap-2 px-4 py-2 bg-blue-50 dark:bg-blue-900/20 text-blue-700 dark:text-blue-300 border border-blue-200 dark:border-blue-800 rounded-lg hover:bg-blue-100 dark:hover:bg-blue-900/30 hover:border-blue-300 dark:hover:border-blue-700 transition-all duration-200 text-sm font-medium">
                    <x-heroicon-o-user-group class="w-4 h-4" />
                    LinkedIn
                </a>
                <a href="https://instagram.com/omar.af7" target="_blank" class="inline-flex items-center gap-2 px-4 py-2 bg-pink-50 dark:bg-pink-900/20 text-pink-700 dark:text-pink-300 border border-pink-200 dark:border-pink-800 rounded-lg hover:bg-pink-100 dark:hover:bg-pink-900/30 hover:border-pink-300 dark:hover:border-pink-700 transition-all duration-200 text-sm font-medium">
                    <x-heroicon-o-camera class="w-4 h-4" />
                    Instagram
                </a>
                <a href="https://youtube.com/@Omar7tech" target="_blank" class="inline-flex items-center gap-2 px-4 py-2 bg-red-50 dark:bg-red-900/20 text-red-700 dark:text-red-300 border border-red-200 dark:border-red-800 rounded-lg hover:bg-red-100 dark:hover:bg-red-900/30 hover:border-red-300 dark:hover:border-red-700 transition-all duration-200 text-sm font-medium">
                    <x-heroicon-o-play class="w-4 h-4" />
                    YouTube
                </a>
            </div>
        </div>
    </div>
    </x-filament::section>
</x-filament-panels::page>