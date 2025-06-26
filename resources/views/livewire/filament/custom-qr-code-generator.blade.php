<div class="max-w-xl mx-auto flex flex-col items-center gap-6">
    <h2 class="text-xl font-bold mb-2">Generate Custom QR Code</h2>
    <p class="text-gray-600 dark:text-gray-400 text-center mb-4">
        Enter any link below to instantly generate a QR code for it. You can download or print the QR code for sharing.
    </p>

    <div class="w-full">
        <input
            type="url"
            wire:model.debounce.500ms="customUrl"
            placeholder="https://your-link.com"
            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
        />
    </div>

    @if ($customUrl && $qrSvg)
        <div class="flex flex-col items-center gap-4 w-full">
            <div class="bg-white p-6 rounded-lg border border-gray-200 dark:border-gray-700">
                {!! $qrSvg !!}
            </div>

            <div class="w-full">
                <input
                    type="text"
                    value="{{ $customUrl }}"
                    readonly
                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm bg-gray-50 font-mono text-sm"
                />
            </div>

            <a
                href="https://api.qrserver.com/v1/create-qr-code/?size=400x400&data={{ urlencode($customUrl) }}"
                download="custom-qr.png"
                class="w-full flex justify-center items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
            >
                <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm3.293-7.707a1 1 0 011.414 0L9 10.586V3a1 1 0 112 0v7.586l1.293-1.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd" />
                </svg>
                Download QR Code
            </a>
        </div>
    @endif
</div>