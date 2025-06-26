<div class="min-h-screen bg-base-200 flex items-center justify-center p-4">
    <!-- Login Card -->
    <div class="card w-full max-w-sm bg-base-100 shadow-xl">
        <div class="card-body p-6">
            <!-- Logo/Brand Section -->
            <div class="text-center mb-6">
                <div class="avatar placeholder mb-3">
                    <div class="bg-primary text-primary-content rounded-full w-12">
                        <i class="fas fa-user-circle text-xl"></i>
                    </div>
                </div>
                <h1 class="text-xl font-bold">Sign In</h1>
            </div>

            <!-- Login Form -->
            <form wire:submit.prevent="login" class="space-y-4">
                <!-- Email Field -->
                <div class="form-control">
                    <label class="label">
                        <span class="label-text font-medium">Email</span>
                    </label>
                    <input type="email" wire:model="email" placeholder="Enter your email"
                        class="input input-bordered w-full @error('email') input-error @enderror" />
                    @error('email')
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
                    <input type="password" wire:model="password" placeholder="Enter your password"
                        class="input input-bordered w-full @error('password') input-error @enderror" />
                    @error('password')
                        <label class="label">
                            <span class="label-text-alt text-error">{{ $message }}</span>
                        </label>
                    @enderror
                </div>

                <!-- Remember Me -->
                <div class="form-control">
                    <label class="label cursor-pointer justify-start">
                        <input type="checkbox" wire:model="remember" class="checkbox checkbox-primary checkbox-sm" />
                        <span class="label-text ml-2">Remember me</span>
                    </label>
                </div>

                <!-- Login Button -->
                <div class="form-control mt-6">
                    <button type="submit" class="btn btn-primary w-full" wire:loading.attr="disabled">
                        <span wire:loading.remove>
                            <i class="fas fa-sign-in-alt mr-2"></i>
                            Sign In
                        </span>
                        <span wire:loading>
                            <span class="loading loading-spinner loading-sm mr-2"></span>
                            Signing In...
                        </span>
                    </button>
                </div>

                <!-- Divider -->
                <div class="divider text-sm">or</div>

                <!-- Google Login Button -->
                <div class="form-control">
                    <a class="btn bg-white text-black border-[#e5e5e5] w-full">
                        <svg aria-label="Google logo" width="16" height="16" xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 512 512">
                            <g>
                                <path d="m0 0H512V512H0" fill="#fff"></path>
                                <path fill="#34a853" d="M153 292c30 82 118 95 171 60h62v48A192 192 0 0190 341"></path>
                                <path fill="#4285f4" d="m386 400a140 175 0 0053-179H260v74h102q-7 37-38 57"></path>
                                <path fill="#fbbc02" d="m90 341a208 200 0 010-171l63 49q-12 37 0 73"></path>
                                <path fill="#ea4335" d="m153 219c22-69 116-109 179-50l55-54c-78-75-230-72-297 55">
                                </path>
                            </g>
                        </svg>
                        Login with Google
                    </a>
                </div>
            </form>

            <!-- Sign Up Link -->
            <div class="text-center mt-4 pt-4 border-t border-base-300">
                <p class="text-sm text-base-content/70">
                    Don't have an account?
                    <a wire:navigate href="{{ route('register') }}" class="link link-primary font-medium">Sign up</a>
                </p>
            </div>
        </div>
    </div>


</div>
