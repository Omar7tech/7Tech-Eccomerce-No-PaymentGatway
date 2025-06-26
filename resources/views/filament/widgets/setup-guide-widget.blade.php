@php
    $generalSettings = app(\App\Settings\GeneralSettings::class);
    $contactSettings = app(\App\Settings\ContactSettings::class);
    $footerSettings = app(\App\Settings\FooterSettings::class);
    $contentSettings = app(\App\Settings\ContentSettings::class);

    $checklist = [
        'general.site_name' => [
            'title' => 'Set Your Website Name',
            'description' => 'Your site name is used in the title bar and throughout your site.',
            'status' => !empty($generalSettings->site_name),
            'link' => route('filament.admin.pages.manage-settings'),
            'icon' => 'heroicon-o-identification',
        ],
        'general.site_logo' => [
            'title' => 'Upload Your Logo',
            'description' => 'A logo helps establish your brand identity.',
            'status' => !empty($generalSettings->site_logo),
            'link' => route('filament.admin.pages.manage-settings'),
            'icon' => 'heroicon-o-photo',
        ],
        'contact.email' => [
            'title' => 'Set Your Contact Email',
            'description' => 'The email address customers can use to contact you.',
            'status' => !empty($contactSettings->email),
            'link' => route('filament.admin.pages.manage-contact'),
            'icon' => 'heroicon-o-envelope',
        ],
        'footer.social_links' => [
            'title' => 'Configure Social Media Links',
            'description' => 'Connect with your customers on social platforms.',
            'status' => !empty($footerSettings->social_links),
            'link' => route('filament.admin.pages.manage-footer'),
            'icon' => 'heroicon-o-share',
        ],
        'content.hero_title' => [
            'title' => 'Customize Homepage Hero',
            'description' => 'Update the main banner to welcome your visitors.',
            'status' => !empty($contentSettings->hero_title),
            'link' => route('filament.admin.pages.manage-content'),
            'icon' => 'heroicon-o-home',
        ],
        'categories_exist' => [
            'title' => 'Create a Product Category',
            'description' => 'Organize your products into categories for easy browsing.',
            'status' => \App\Models\Category::exists(),
            'link' => route('filament.admin.resources.categories.create'),
            'icon' => 'heroicon-o-rectangle-group',
        ],
        'products_exist' => [
            'title' => 'Add Your First Product',
            'description' => 'Start building your catalog by adding products.',
            'status' => \App\Models\Product::exists(),
            'link' => route('filament.admin.resources.products.create'),
            'icon' => 'heroicon-o-cube',
        ],
    ];

    $completionPercentage = (int) ((collect($checklist)->where('status', true)->count() / count($checklist)) * 100);
@endphp

<x-filament-widgets::widget>
    <x-filament::section>
        <div class="flex items-center gap-x-3">
            <h2 class="text-lg font-semibold leading-6 text-gray-950 dark:text-white">
                Getting Started Guide
            </h2>
        </div>

        <div class="mt-4">
            <div class="flex items-center justify-between">
                <p class="text-sm text-gray-600 dark:text-gray-400">
                    Follow these steps to get your store up and running.
                </p>
                <p class="text-sm font-medium text-primary-600 dark:text-primary-500">
                    {{ $completionPercentage }}% Complete
                </p>
            </div>
            <div class="mt-2 w-full bg-gray-200 rounded-full h-2.5 dark:bg-gray-700">
                <div class="bg-primary-600 h-2.5 rounded-full" style="width: {{ $completionPercentage }}%"></div>
            </div>
        </div>

        <div class="mt-6 space-y-4">
            @foreach ($checklist as $item)
                <div @class([
                    'p-4 rounded-lg flex items-center gap-4',
                    'bg-success-50 dark:bg-success-500/10' => $item['status'],
                    'bg-gray-50 dark:bg-white/5' => !$item['status'],
                ])>
                    <div @class([
                        'w-10 h-10 rounded-full flex-shrink-0 flex items-center justify-center',
                        'bg-success-500/10 text-success-500' => $item['status'],
                        'bg-gray-500/10 text-gray-500 dark:bg-gray-700 dark:text-gray-400' => !$item[
                            'status'
                        ],
                    ])>
                        @if ($item['status'])
                            <x-heroicon-o-check-circle class="w-6 h-6" />
                        @else
                            <x-dynamic-component :component="$item['icon']" class="w-6 h-6" />
                        @endif
                    </div>
                    <div class="flex-grow">
                        <h3 class="font-semibold text-gray-950 dark:text-white">{{ $item['title'] }}</h3>
                        <p class="text-sm text-gray-600 dark:text-gray-400">{{ $item['description'] }}</p>
                    </div>
                    @if (!$item['status'])
                        <a href="{{ $item['link'] }}"
                            class="inline-flex items-center gap-x-1.5 rounded-md bg-primary-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-primary-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary-600">
                            Let's Do It
                            <x-heroicon-m-arrow-right class="w-4 h-4" />
                        </a>
                    @endif
                </div>
            @endforeach
        </div>

    </x-filament::section>
</x-filament-widgets::widget>
