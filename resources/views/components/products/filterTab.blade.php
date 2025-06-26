<div
    class="lg:sticky lg:top-16 lg:z-10 rounded-2xl bg-gradient-to-r from-base-100 via-base-100 to-base-50 p-2 mb-8 w-full overflow-x-auto shadow-2xl border border-base-300/50 backdrop-blur-sm transition-all duration-500 ease-in-out hover:shadow-3xl">
    <div role="tablist" class="tabs tabs-lifted tabs-lg relative">

        <button role="tab"
            class="tab text-sm font-medium relative overflow-hidden group transition-all duration-500 ease-out transform hover:scale-105
                       {{ $activeTab === 'all' ? 'tab-active [--tab-bg:theme(colors.primary)] [--tab-border-color:theme(colors.primary)] font-bold shadow-lg text-primary-content' : 'hover:bg-gradient-to-br hover:from-base-200 hover:to-base-300 text-base-content/80 hover:text-base-content hover:shadow-md' }}"
            wire:click="$set('activeTab', 'all')">
            <div class="flex items-center space-x-2 relative z-10">
                <div
                    class="w-2 h-2 rounded-full bg-current opacity-60 transition-all duration-300 group-hover:opacity-100 {{ $activeTab === 'all' ? 'animate-pulse' : '' }}">
                </div>
                <span>All</span>
                <span
                    class="badge badge-sm transition-all duration-300 transform group-hover:scale-110
                             {{ $activeTab === 'all' ? 'badge-primary badge-outline bg-primary-content text-primary border-primary-content' : 'badge-ghost text-base-content/70 hover:badge-primary hover:badge-outline' }}">
                    {{ $counts['all'] }}
                </span>
            </div>
            <div
                class="absolute inset-0 bg-gradient-to-r from-primary/10 to-secondary/10 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-500 origin-left">
            </div>
        </button>

        <button role="tab"
            class="tab text-sm font-medium relative overflow-hidden group transition-all duration-500 ease-out transform hover:scale-105
                       {{ $activeTab === 'featured' ? 'tab-active [--tab-bg:theme(colors.primary)] [--tab-border-color:theme(colors.primary)] font-bold shadow-lg text-primary-content' : 'hover:bg-gradient-to-br hover:from-base-200 hover:to-base-300 text-base-content/80 hover:text-base-content hover:shadow-md' }}"
            wire:click="$set('activeTab', 'featured')">
            <div class="flex items-center space-x-2 relative z-10">
                <span
                    class="text-xl transition-transform duration-300 group-hover:scale-125 group-hover:rotate-12">⭐</span>
                <span>Featured</span>
                <span
                    class="badge badge-sm transition-all duration-300 transform group-hover:scale-110
                             {{ $activeTab === 'featured' ? 'badge-primary badge-outline bg-primary-content text-primary border-primary-content' : 'badge-ghost text-base-content/70 hover:badge-warning hover:badge-outline' }}">
                    {{ $counts['featured'] }}
                </span>
            </div>
            <div
                class="absolute inset-0 bg-gradient-to-r from-warning/10 to-accent/10 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-500 origin-left">
            </div>
        </button>

        <button role="tab"
            class="tab text-sm font-medium relative overflow-hidden group transition-all duration-500 ease-out transform hover:scale-105
                       {{ $activeTab === 'new' ? 'tab-active [--tab-bg:theme(colors.primary)] [--tab-border-color:theme(colors.primary)] font-bold shadow-lg text-primary-content' : 'hover:bg-gradient-to-br hover:from-base-200 hover:to-base-300 text-base-content/80 hover:text-base-content hover:shadow-md' }}"
            wire:click="$set('activeTab', 'new')">
            <div class="flex items-center space-x-2 relative z-10">
                <span
                    class="text-xl transition-transform duration-300 group-hover:scale-125 group-hover:animate-bounce">🆕</span>
                <span>New</span>
                <span
                    class="badge badge-sm transition-all duration-300 transform group-hover:scale-110 animate-pulse
                             {{ $activeTab === 'new' ? 'badge-primary badge-outline bg-primary-content text-primary border-primary-content' : 'badge-ghost text-base-content/70 hover:badge-success hover:badge-outline' }}">
                    {{ $counts['new'] }}
                </span>
            </div>
            <div
                class="absolute inset-0 bg-gradient-to-r from-success/10 to-info/10 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-500 origin-left">
            </div>
        </button>

        <button role="tab"
            class="tab text-sm font-medium relative overflow-hidden group transition-all duration-500 ease-out transform hover:scale-105
                       {{ $activeTab === 'sale' ? 'tab-active [--tab-bg:theme(colors.primary)] [--tab-border-color:theme(colors.primary)] font-bold shadow-lg text-primary-content' : 'hover:bg-gradient-to-br hover:from-base-200 hover:to-base-300 text-base-content/80 hover:text-base-content hover:shadow-md' }}"
            wire:click="$set('activeTab', 'sale')">
            <div class="flex items-center space-x-2 relative z-10">
                <span
                    class="text-xl transition-transform duration-300 group-hover:scale-125 group-hover:animate-pulse">🔥</span>
                <span>Sale</span>
                <span
                    class="badge badge-sm transition-all duration-300 transform group-hover:scale-110 animate-pulse
                             {{ $activeTab === 'sale' ? 'badge-primary badge-outline bg-primary-content text-primary border-primary-content' : 'badge-ghost text-base-content/70 hover:badge-error hover:badge-outline' }}">
                    {{ $counts['sale'] }}
                </span>
            </div>
            <div
                class="absolute inset-0 bg-gradient-to-r from-error/10 to-warning/10 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-500 origin-left">
            </div>
        </button>

        <button role="tab"
            class="tab text-sm font-medium relative overflow-hidden group transition-all duration-500 ease-out transform hover:scale-105
                   {{ $activeTab === 'wishlist' ? 'tab-active [--tab-bg:theme(colors.primary)] [--tab-border-color:theme(colors.primary)] font-bold shadow-lg text-primary-content' : 'hover:bg-gradient-to-br hover:from-base-200 hover:to-base-300 text-base-content/80 hover:text-base-content hover:shadow-md' }}"
            wire:click="$set('activeTab', 'wishlist')">
            <div class="flex items-center space-x-2 relative z-10">
                <svg class="w-5 h-5 transition-all duration-300 group-hover:scale-125 {{ $activeTab === 'wishlist' ? 'animate-pulse' : 'group-hover:text-error' }}"
                    fill="{{ $activeTab === 'wishlist' ? 'currentColor' : 'none' }}" stroke="currentColor"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                </svg>
                <span>Wishlist</span>
                <span
                    class="badge badge-sm transition-all duration-300 transform group-hover:scale-110
                         {{ $activeTab === 'wishlist' ? 'badge-primary badge-outline bg-primary-content text-primary border-primary-content' : 'badge-ghost text-base-content/70 hover:badge-error hover:badge-outline' }}">
                    {{ $counts['wishlist'] }}
                </span>
            </div>
            <div
                class="absolute inset-0 bg-gradient-to-r from-error/10 to-secondary/10 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-500 origin-left">
            </div>
        </button>
    </div>
</div>
