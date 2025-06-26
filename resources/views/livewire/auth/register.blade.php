<div class="min-h-screen bg-base-200 flex items-center justify-center p-4">
    <!-- Register Card -->
    <div class="card w-full max-w-md bg-base-100 shadow-xl">
        <div class="card-body p-8">
            <!-- Logo/Brand Section -->
            <div class="text-center mb-8">
                <div class="avatar placeholder mb-4">
                    <div class="bg-neutral text-neutral-content rounded-full w-16">
                        <i class="fas fa-user-plus text-2xl"></i>
                    </div>
                </div>
                <h1 class="text-2xl font-bold mb-2">Create Account</h1>
                <p class="text-base-content/70">Please fill in your information to register</p>
            </div>

            <!-- Register Form -->
            <form wire:submit.prevent="register" class="space-y-5">
                <!-- Name Field -->
                <div class="form-control">
                    <label class="label">
                        <span class="label-text font-medium">Full Name</span>
                    </label>
                    <input
                        type="text"
                        wire:model="name"
                        placeholder="Enter your full name"
                        class="input input-bordered w-full focus:input-primary"
                        required
                    />
                    @error('name')
                        <label class="label">
                            <span class="label-text-alt text-error">{{ $message }}</span>
                        </label>
                    @enderror
                </div>

                <!-- Email Field -->
                <div class="form-control">
                    <label class="label">
                        <span class="label-text font-medium">Email Address</span>
                    </label>
                    <input
                        type="email"
                        wire:model="email"
                        placeholder="Enter your email"
                        class="input input-bordered w-full focus:input-primary"
                        required
                    />
                    @error('email')
                        <label class="label">
                            <span class="label-text-alt text-error">{{ $message }}</span>
                        </label>
                    @enderror
                </div>

                <!-- Phone Field -->
                <div class="form-control">
                    <label class="label">
                        <span class="label-text font-medium">Phone Number</span>
                    </label>
                    <input
                        type="tel"
                        wire:model="phone"
                        placeholder="Enter your phone number"
                        class="input input-bordered w-full focus:input-primary"
                        required
                    />
                    @error('phone')
                        <label class="label">
                            <span class="label-text-alt text-error">{{ $message }}</span>
                        </label>
                    @enderror
                </div>

                <!-- Password Field -->
                <div class="form-control">
                    <label class="label">
                        <span class="label-text font-medium">Password</span>
                    </label>
                    <div class="relative">
                        <input
                            type="password"
                            wire:model="password"
                            placeholder="Enter your password"
                            class="input input-bordered w-full focus:input-primary pr-12"
                            required
                        />
                        <button type="button" class="password-toggle absolute right-3 top-1/2 transform -translate-y-1/2 text-base-content/60 hover:text-base-content transition-colors">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                    @error('password')
                        <label class="label">
                            <span class="label-text-alt text-error">{{ $message }}</span>
                        </label>
                    @enderror
                </div>

                <!-- Confirm Password Field -->
                <div class="form-control">
                    <label class="label">
                        <span class="label-text font-medium">Confirm Password</span>
                    </label>
                    <div class="relative">
                        <input
                            type="password"
                            wire:model="password_confirmation"
                            placeholder="Confirm your password"
                            class="input input-bordered w-full focus:input-primary pr-12"
                            required
                        />
                        <button type="button" class="password-toggle absolute right-3 top-1/2 transform -translate-y-1/2 text-base-content/60 hover:text-base-content transition-colors">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                    @error('password_confirmation')
                        <label class="label">
                            <span class="label-text-alt text-error">{{ $message }}</span>
                        </label>
                    @enderror
                </div>

                <!-- Register Button -->
                <div class="form-control mt-6">
                    <button
                        type="submit"
                        class="btn btn-primary btn-lg w-full"
                        wire:loading.attr="disabled"
                    >
                        <span wire:loading.remove>
                            <i class="fas fa-user-plus mr-2"></i>
                            Create Account
                        </span>
                        <span wire:loading class="loading loading-spinner loading-sm"></span>
                        <span wire:loading>Creating Account...</span>
                    </button>
                </div>

                <!-- Social Register Divider -->
                <div class="divider">or register with</div>

                <!-- Social Register Buttons -->
                <div class="grid grid-cols-2 gap-4">
                    <button type="button" class="btn btn-outline">
                        <i class="fab fa-google"></i>
                        Google
                    </button>
                    <button type="button" class="btn btn-outline">
                        <i class="fab fa-facebook-f"></i>
                        Facebook
                    </button>
                </div>
            </form>

            <!-- Sign In Link -->
            <div class="text-center mt-6 pt-6 border-t border-base-300">
                <p class="text-base-content/70">
                    Already have an account?
                    <a href="/login" class="link link-primary font-medium">Sign in here</a>
                </p>
            </div>
        </div>
    </div>

</div>


