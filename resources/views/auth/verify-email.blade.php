<x-layouts.app>
    <div class="min-h-screen bg-gradient-to-b from-base-100 to-base-200">
        <div class="hero min-h-screen">
            <div class="hero-content text-center">
                <div class="max-w-md">
                    <!-- Professional Header -->
                    <div class="mb-12">
                        <div class="inline-flex items-center justify-center w-20 h-20 bg-primary text-primary-content rounded-2xl mb-6 shadow-lg">
                            <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" />
                            </svg>
                        </div>
                        <h1 class="text-3xl font-bold text-base-content mb-3">
                            Email Verification Required
                        </h1>
                        <p class="text-base-content/70 text-lg leading-relaxed">
                            Please verify your email address to continue
                        </p>
                    </div>

                    <!-- Success Message -->
                    @if (session('message'))
                        <div class="alert alert-success mb-8 border-l-4 border-l-success">
                            <svg class="stroke-current shrink-0 w-5 h-5" fill="none" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <span class="font-medium">{{ session('message') }}</span>
                        </div>
                    @endif

                    <!-- Main Content Card -->
                    <div class="card bg-base-100 shadow-xl border border-base-300/50">
                        <div class="card-body p-8">
                            <!-- Status Indicator -->
                            <div class="flex items-center justify-center mb-6">
                                <div class="flex items-center gap-3 px-4 py-2 bg-warning/10 border border-warning/20 rounded-lg">
                                    <div class="w-2 h-2 bg-warning rounded-full"></div>
                                    <span class="text-sm font-medium text-base-content">Verification Pending</span>
                                </div>
                            </div>

                            <!-- Instructions -->
                            <div class="space-y-4 mb-8">
                                <p class="text-base-content text-base leading-relaxed">
                                    We have sent a verification link to your email address. Please check your inbox and click the link to verify your account.
                                </p>
                                <p class="text-base-content/70 text-sm">
                                    If you don't see the email, please check your spam folder or request a new verification email.
                                </p>
                            </div>

                            <!-- Action Buttons -->
                            <div class="space-y-4">
                                <!-- Resend Button -->
                                <form method="POST" action="{{ route('verification.send') }}">
                                    @csrf
                                    <button type="submit" class="btn btn-primary btn-block">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                                        </svg>
                                        Resend Verification Email
                                    </button>
                                </form>

                                <!-- Logout Button -->
                                <form method="POST" action="{{ route('auth.logout') }}">
                                    @csrf
                                    <button type="submit" class="btn btn-outline btn-block">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                                        </svg>
                                        Sign Out
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Help Section -->
                    <div class="mt-8">
                        <div class="bg-base-100/50 border border-base-300/30 rounded-lg p-6">
                            <h3 class="font-semibold text-base-content mb-4">Need assistance?</h3>
                            <div class="space-y-3 text-sm text-base-content/70">
                                <div class="flex items-start gap-3">
                                    <svg class="w-4 h-4 mt-0.5 text-info shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                                    </svg>
                                    <span>Check your spam or junk email folder</span>
                                </div>
                                <div class="flex items-start gap-3">
                                    <svg class="w-4 h-4 mt-0.5 text-info shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"></path>
                                    </svg>
                                    <span>Email delivery may take up to 5 minutes</span>
                                </div>
                                <div class="flex items-start gap-3">
                                    <svg class="w-4 h-4 mt-0.5 text-info shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884zM18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" clip-rule="evenodd"></path>
                                    </svg>
                                    <span>Make sure to check the correct email address</span>
                                </div>
                            </div>
                            <div class="mt-4 pt-4 border-t border-base-300/30">
                                <a href="#" class="text-primary font-medium text-sm hover:underline">
                                    Contact Support Team
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>