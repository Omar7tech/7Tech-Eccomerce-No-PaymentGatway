<div class="min-h-screen bg-base-200 py-8">
    <div class="container mx-auto px-4 max-w-2xl">
        <!-- Header -->
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold text-primary">My Profile</h1>
            <p class="text-base-content/70 mt-2">Manage your personal information</p>
        </div>

        <!-- Toast Notifications -->
        <div x-data="{ show: false, message: '', type: 'success' }"
            x-on:notify.window="show = true; message = $event.detail.message; type = $event.detail.type; setTimeout(() => show = false, 3000)"
            x-show="show"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 transform translate-y-2"
            x-transition:enter-end="opacity-100 transform translate-y-0"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100 transform translate-y-0"
            x-transition:leave-end="opacity-0 transform translate-y-2"
            class="fixed top-4 right-4 z-50"
            :class="{
                'bg-success text-success-content': type === 'success',
                'bg-error text-error-content': type === 'error'
            }"
            x-cloak>
            <div class="flex items-center gap-2 px-4 py-2 rounded-lg shadow-lg">
                <svg x-show="type === 'success'" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
                <svg x-show="type === 'error'" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
                <span x-text="message"></span>
            </div>
        </div>

        <div class="bg-base-100 rounded-xl shadow-lg overflow-hidden">
            <!-- Profile Section -->
            <div class="p-6">
                <div class="mb-8">
                    <h2 class="text-2xl font-bold">{{ Auth::user()->name }}</h2>
                    <p class="text-base-content/70">{{ Auth::user()->email }}</p>
                </div>

                <form wire:submit="updateProfile" class="space-y-6">
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text font-medium">Full Name</span>
                        </label>
                        <input type="text" wire:model="name"
                            class="input input-bordered w-full bg-base-200 focus:bg-base-100 transition-colors"
                            wire:loading.attr="disabled"
                            wire:target="updateProfile" />
                        @error('name')
                            <span class="text-error text-sm mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-control">
                        <label class="label">
                            <span class="label-text font-medium">Phone Number</span>
                        </label>
                        <input type="tel" wire:model="phone"
                            class="input input-bordered w-full bg-base-200 focus:bg-base-100 transition-colors"
                            wire:loading.attr="disabled"
                            wire:target="updateProfile" />
                        @error('phone')
                            <span class="text-error text-sm mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="flex justify-end gap-4 mt-8">
                        <button type="submit"
                            class="btn btn-primary px-8"
                            wire:loading.attr="disabled"
                            wire:target="updateProfile">
                            <span wire:loading.remove wire:target="updateProfile">Save Changes</span>
                            <span wire:loading wire:target="updateProfile" class="loading loading-spinner loading-xs"></span>
                        </button>
                        <button type="button"
                            wire:click="logout"
                            class="btn btn-outline btn-error px-8">
                            <span wire:loading.remove wire:target="logout">Logout</span>
                            <span wire:loading wire:target="logout" class="loading loading-spinner loading-xs"></span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        // Simple tab switching
        document.querySelectorAll('.tabs .tab').forEach(tab => {
            tab.addEventListener('click', (e) => {
                if (e.target.classList.contains('tab-error')) return;

                // Update active tab
                document.querySelectorAll('.tabs .tab').forEach(t => t.classList.remove('tab-active'));
                e.target.classList.add('tab-active');

                // Show corresponding content
                const target = e.target.getAttribute('href').substring(1);
                document.querySelectorAll('#profile, #security').forEach(content => {
                    content.classList.add('hidden');
                });
                document.getElementById(target).classList.remove('hidden');
            });
        });
    </script>
@endpush
