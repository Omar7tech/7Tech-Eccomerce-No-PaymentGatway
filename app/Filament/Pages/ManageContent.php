<?php

namespace App\Filament\Pages;

use App\Settings\ContentSettings;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Pages\SettingsPage;
use Illuminate\Support\Facades\Storage;

class ManageContent extends SettingsPage
{
    protected static ?string $navigationIcon = 'heroicon-o-adjustments-horizontal';
    protected static ?string $navigationGroup = 'Settings';
    protected static string $settings = ContentSettings::class;
    protected static ?string $title = 'Content Management';
    protected static ?string $navigationLabel = 'Content Settings';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Tabs::make('Content Configuration')
                    ->tabs([
                        Forms\Components\Tabs\Tab::make('Site Appearance')
                            ->icon('heroicon-o-paint-brush')
                            ->schema([
                                Forms\Components\Section::make('Theme Configuration')
                                    ->description('Customize the visual appearance and theme of your website')
                                    ->icon('heroicon-o-swatch')
                                    ->schema([
                                        Forms\Components\Select::make('theme_mode')
                                            ->label('Website Theme')
                                            ->native(false)
                                            ->searchable()
                                            ->options([
                                                'light' => '🌞 Light – Clean and bright',
                                                'cupcake' => '🧁 Cupcake – Sweet and pastel',
                                                'bumblebee' => '🐝 Bumblebee – Bold yellow and black',
                                                'emerald' => '💚 Emerald – Rich green elegance',
                                                'corporate' => '🏢 Corporate – Professional and clean',
                                                'garden' => '🌿 Garden – Natural and fresh greens',
                                                'pastel' => '🖍️ Pastel – Soft and smooth tones',
                                                'fantasy' => '🦄 Fantasy – Magical and vibrant',
                                                'wireframe' => '📐 Wireframe – Minimal outlines',
                                                'lemonade' => '🍋 Lemonade – Zesty and refreshing',
                                                'winter' => '❄️ Winter – Icy blues and white',
                                                'OmarLightTheme' => '🌤️ Light Customized Theme',

                                                // Dark Themes
                                                'dark' => '🌙 Dark – Elegant and easy on eyes',
                                                'synthwave' => '🌆 Synthwave – Neon retro vibes',
                                                'retro' => '📼 Retro – Classic 70s colors',
                                                'cyberpunk' => '🤖 Cyberpunk – Futuristic and flashy',
                                                'valentine' => '💘 Valentine – Romantic pink-red',
                                                'halloween' => '🎃 Halloween – Spooky orange-black',
                                                'forest' => '🌲 Forest – Deep earthy tones',
                                                'aqua' => '💧 Aqua – Ocean blues and calm',
                                                'lofi' => '🎧 Lofi – Chill muted colors',
                                                'black' => '🖤 Black – Sleek all-black',
                                                'luxury' => '👑 Luxury – Gold and black luxury',
                                                'dracula' => '🧛 Dracula – Gothic purple and dark',
                                                'night' => '🌌 Night – Deep blues and cool tones',
                                                'coffee' => '☕ Coffee – Cozy browns',
                                                'dim' => '🔅 Dim – Subtle and soft',
                                                'nord' => '🧊 Nord – Arctic cold palette',
                                                'sunset' => '🌇 Sunset – Warm gradient hues',
                                                'abyss' => '🌊 Abyss – Deep sea darkness',
                                                'OmarTheme' => '🖌️ Dark Customized Theme',
                                                'midnightpro' => '🌃 Midnight Pro – Premium dark experience',
                                                'eclipse' => '🌘 Eclipse – Luxurious purple and gold',

                                                // Special Themes
                                                'cmyk' => '🖨️ CMYK – Printer-style colors',
                                                'autumn' => '🍂 Autumn – Warm fall palette',
                                                'business' => '💼 Business – Flat and formal',
                                                'acid' => '☢️ Acid – Neon toxic green',
                                                'caramellatte' => '🍮 Caramellatte – Sweet and soft beige',
                                                'silk' => '🪡 Silk – Smooth soft whites',
                                            ])
                                            ->default('light')
                                            ->helperText('Choose a theme that matches your brand and user preferences')
                                            ->columnSpanFull(),
                                    ]),

                                Forms\Components\Section::make('Site Features')
                                    ->description('Enable or disable site-wide features and functionality')
                                    ->icon('heroicon-o-cog-6-tooth')
                                    ->schema([
                                        Forms\Components\Toggle::make('allow_google_translate')
                                            ->label('Enable Google Translate')
                                            ->helperText('Allow visitors to translate your website content using Google Translate widget')
                                            ->inline(false)
                                            ->columnSpanFull(),
                                    ]),


                            ]),

                        Forms\Components\Tabs\Tab::make('Announcements')
                            ->icon('heroicon-o-megaphone')
                            ->schema([
                                Forms\Components\Section::make('Announcement Banner')
                                    ->description('Display important announcements at the top of your site')
                                    ->icon('heroicon-o-megaphone')
                                    ->schema([
                                        Forms\Components\Grid::make(3)
                                            ->schema([
                                                Forms\Components\Toggle::make('announcement_active')
                                                    ->label('Enable Announcement')
                                                    ->helperText('Show/hide the announcement banner')
                                                    ->inline(false)
                                                    ->columnSpan(1),

                                                Forms\Components\TextInput::make('announcement_link')
                                                    ->label('Announcement Link')
                                                    ->url()
                                                    ->prefixIcon('heroicon-o-link')
                                                    ->placeholder('https://example.com/announcement')
                                                    ->helperText('Optional link for the announcement')
                                                    ->columnSpan(2),
                                            ]),

                                        Forms\Components\Textarea::make('announcement_content')
                                            ->label('Announcement Content')
                                            ->required()
                                            ->placeholder('Enter your announcement message...')
                                            ->rows(3)
                                            ->maxLength(500)
                                            ->helperText('Write your announcement message (plain text only)')
                                            ->columnSpanFull(),
                                    ]),
                            ]),

                        Forms\Components\Tabs\Tab::make('Hero Section')
                            ->icon('heroicon-o-photo')
                            ->schema([
                                Forms\Components\Section::make('Hero Banner')
                                    ->description('Main banner area that welcomes visitors to your site')
                                    ->icon('heroicon-o-photo')
                                    ->schema([
                                        Forms\Components\Toggle::make('hero_enabled')
                                            ->label('Enable Hero Section')
                                            ->helperText('Show/hide the main hero banner')
                                            ->inline(false)
                                            ->columnSpanFull(),

                                        Forms\Components\FileUpload::make('hero_image')
                                            ->label('Hero Background Image')
                                            ->image()
                                            ->imageEditor()
                                            ->imageEditorAspectRatios([
                                                '16:9',
                                                '21:9',
                                                '3:1',
                                            ])
                                            ->deleteUploadedFileUsing(function ($file) {
                                                Storage::disk('public')->delete($file);
                                            })
                                            ->directory('hero')
                                            ->maxSize(5120)
                                            ->acceptedFileTypes(['image/png', 'image/jpeg', 'image/webp'])
                                            ->helperText('High-resolution image for hero background (recommended: 1920x1080px)')
                                            ->columnSpanFull(),

                                        Forms\Components\Grid::make(2)
                                            ->schema([
                                                Forms\Components\TextInput::make('hero_title')
                                                    ->label('Hero Title')
                                                    ->placeholder('Welcome to Our Store')
                                                    ->maxLength(100)
                                                    ->helperText('Main headline for your hero section'),

                                                Forms\Components\TextInput::make('hero_link_text')
                                                    ->label('Button Text')
                                                    ->placeholder('Shop Now')
                                                    ->maxLength(50)
                                                    ->helperText('Text for the call-to-action button'),
                                            ]),

                                        Forms\Components\Textarea::make('hero_description')
                                            ->label('Hero Description')
                                            ->placeholder('Discover amazing products and unbeatable deals...')
                                            ->maxLength(250)
                                            ->rows(3)
                                            ->helperText('Brief description under the title')
                                            ->columnSpanFull(),

                                        Forms\Components\TextInput::make('hero_link')
                                            ->label('Hero Button Link')
                                            ->url()
                                            ->prefixIcon('heroicon-o-link')
                                            ->placeholder('https://example.com/shop')
                                            ->helperText('Leave empty to scroll to content automatically')
                                            ->columnSpanFull(),
                                    ]),
                            ]),

                        Forms\Components\Tabs\Tab::make('Promotional Banners')
                            ->icon('heroicon-o-gift')
                            ->schema([
                                Forms\Components\Section::make('Promotional Banner')
                                    ->description('Additional banner for promotions and special offers')
                                    ->icon('heroicon-o-gift')
                                    ->schema([
                                        Forms\Components\Grid::make(2)
                                            ->schema([
                                                Forms\Components\Toggle::make('banner_active')
                                                    ->label('Enable Banner')
                                                    ->helperText('Show promotional banner')
                                                    ->inline(false),

                                                Forms\Components\Select::make('banner_mode')
                                                    ->label('Banner Style')
                                                    ->options([
                                                        1 => 'Style 1 - Full Width',
                                                        2 => 'Style 2 - Centered',
                                                    ])
                                                    ->default(1)
                                                    ->native(false)
                                                    ->helperText('Choose banner layout style'),
                                            ]),
                                    ]),
                            ]),

                        Forms\Components\Tabs\Tab::make('Homepage Content')
                            ->icon('heroicon-o-home')
                            ->schema([
                                Forms\Components\Section::make('Homepage Categories')
                                    ->description('Choose which categories to showcase on your homepage with their products')
                                    ->icon('heroicon-o-squares-2x2')
                                    ->schema([
                                        Forms\Components\Toggle::make('category_home_enabled')
                                            ->label('Enable Categories Section on Homepage')
                                            ->helperText('Show/hide the entire categories section on homepage')
                                            ->inline(false)
                                            ->columnSpanFull(),

                                        Forms\Components\Repeater::make('homepage_showcase_items')
                                            ->label('Homepage Showcase Items')
                                            ->helperText('Add categories or tags to display on the homepage. You can drag and drop to reorder.')
                                            ->columnSpanFull()
                                            ->schema([
                                                Forms\Components\Select::make('type')
                                                    ->options([
                                                        'category' => 'Category',
                                                        'tag' => 'Tag',
                                                    ])->native(false)
                                                    ->live()
                                                    ->required(),
                                                Forms\Components\Select::make('id')
                                                    ->label(fn(Forms\Get $get) => ucfirst($get('type')))
                                                    ->options(function (Forms\Get $get) {
                                                        $type = $get('type');
                                                        if ($type === 'category') {
                                                            return \App\Models\Category::pluck('name', 'id');
                                                        } elseif ($type === 'tag') {
                                                            return \App\Models\Tag::pluck('name', 'id');
                                                        }
                                                        return [];
                                                    })
                                                    ->native(false)
                                                    ->hidden(fn(Forms\Get $get) => !$get('type'))
                                                    ->live()
                                                    ->required()
                                                    ->getSearchResultsUsing(function (string $search, Forms\Get $get) {
                                                        $type = $get('type');
                                                        if ($type === 'category') {
                                                            return \App\Models\Category::where('name', 'like', "%{$search}%")->pluck('name', 'id');
                                                        } elseif ($type === 'tag') {
                                                            return \App\Models\Tag::where('name', 'like', "%{$search}%")->pluck('name', 'id');
                                                        }
                                                        return [];
                                                    })
                                                    ->getOptionLabelUsing(function ($value, Forms\Get $get) {
                                                        $type = $get('type');
                                                        if ($type === 'category') {
                                                            return \App\Models\Category::find($value)?->name;
                                                        } elseif ($type === 'tag') {
                                                            return \App\Models\Tag::find($value)?->name;
                                                        }
                                                        return null;
                                                    })
                                                    ->searchable()
                                                    ->preload(),
                                            ])->reorderable(),

                                    ]),

                                Forms\Components\Section::make('Homepage Product Sections')
                                    ->description('Manage visibility, order, and position of product sections on the homepage.')
                                    ->icon('heroicon-o-squares-plus')
                                    ->schema([
                                        Forms\Components\Grid::make(3)
                                            ->schema([
                                                Forms\Components\Toggle::make('new_products_enabled')
                                                    ->label('New Products')
                                                    ->default(true)
                                                    ->inline(false),
                                                Forms\Components\Toggle::make('featured_products_enabled')
                                                    ->label('Featured Products')
                                                    ->default(true)
                                                    ->inline(false),
                                                Forms\Components\Toggle::make('sale_products_enabled')
                                                    ->label('Sale Products')
                                                    ->default(true)
                                                    ->inline(false),
                                            ]),

                                        Forms\Components\Select::make('product_sections_position')
                                            ->label('Position of Product Sections')
                                            ->options([
                                                'after_showcase' => 'After Showcase Items',
                                                'before_showcase' => 'Before Showcase Items',
                                            ])
                                            ->default('after_showcase')
                                            ->native(false)
                                            ->helperText('Choose where to display the product sections relative to the showcase items.'),

                                        Forms\Components\Repeater::make('product_sections_order')
                                            ->label('Order of Product Sections')
                                            ->helperText('Drag and drop to reorder the sections. Only enabled sections will be shown.')
                                            ->schema([
                                                Forms\Components\Select::make('section')
                                                    ->label('Section')
                                                    ->options([
                                                        'new' => 'New Products',
                                                        'featured' => 'Featured Products',
                                                        'sale' => 'Sale Products',
                                                    ])
                                                    ->native(false)
                                                    ->required()
                                                    ->distinct()
                                                    ->disableOptionsWhenSelectedInSiblingRepeaterItems(),
                                            ])
                                            ->default([
                                                ['section' => 'new'],
                                                ['section' => 'featured'],
                                                ['section' => 'sale'],
                                            ])
                                            ->reorderable()
                                            ->columnSpanFull()
                                            ->maxItems(3)
                                            ->minItems(1),
                                    ]),

                                Forms\Components\Section::make('Category Card Appearance')
                                    ->description('Configure the appearance of category cards on the homepage')
                                    ->icon('heroicon-o-squares-2x2')
                                    ->schema([
                                        // Add category card appearance settings here
                                    ]),
                            ]),

                        Forms\Components\Tabs\Tab::make('Testimonials')
                            ->icon('heroicon-o-chat-bubble-left-right')
                            ->schema([
                                Forms\Components\Section::make('Testimonials Section')
                                    ->description('Control the visibility of the testimonials section on the home page')
                                    ->icon('heroicon-o-chat-bubble-left-right')
                                    ->schema([
                                        Forms\Components\Toggle::make('testimonial_active')
                                            ->label('Show Testimonials Section')
                                            ->helperText('Enable or disable the testimonials section on the home page')
                                            ->default(true)
                                            ->columnSpanFull(),
                                        Forms\Components\TextInput::make('testimonial_title')
                                            ->label('Testimonials Title')
                                            ->default('What Our Customers Say')
                                            ->maxLength(100)
                                            ->columnSpanFull(),
                                        Forms\Components\Textarea::make('testimonial_description')
                                            ->label('Testimonials Description')
                                            ->default("Don't just take our word for it - hear from our amazing customers")
                                            ->maxLength(255)
                                            ->rows(2)
                                            ->columnSpanFull(),
                                        Forms\Components\Select::make('testimonial_design')
                                            ->label('Testimonial Design')
                                            ->options([
                                                1 => 'Design 1 - Carousel with Navigation',
                                                2 => 'Design 2 - Infinite Scroll',
                                            ])
                                            ->default(1)
                                            ->native(false)
                                            ->helperText('Choose between carousel navigation or smooth infinite scrolling design')
                                            ->columnSpanFull(),
                                    ]),
                            ]),

                        Forms\Components\Tabs\Tab::make('Category Display')
                            ->icon('heroicon-o-tag')
                            ->schema([
                                Forms\Components\Section::make('Category Display Settings')
                                    ->description('Configure how the selected categories are visually displayed')
                                    ->icon('heroicon-o-tag')
                                    ->schema([
                                        Forms\Components\Select::make('category_mode')
                                            ->label('Category Layout Style')
                                            ->options([
                                                1 => 'Layout 1 - Grid View',
                                                2 => 'Layout 2 - List View',
                                                3 => 'Layout 3 - Card View',
                                                4 => 'Layout 4 - Compact View'
                                            ])
                                            ->default(1)
                                            ->native(false)
                                            ->helperText('Choose how the selected categories are displayed')
                                            ->columnSpanFull(),

                                        Forms\Components\Fieldset::make('Category Display Elements')
                                            ->schema([
                                                Forms\Components\Grid::make(3)
                                                    ->schema([
                                                        Forms\Components\Toggle::make('category_display_image')
                                                            ->label('Show Category Images')
                                                            ->helperText('Display images for each category')
                                                            ->inline(false),

                                                        Forms\Components\Toggle::make('category_display_description')
                                                            ->label('Show Category Descriptions')
                                                            ->helperText('Display descriptions for each category')
                                                            ->inline(false),

                                                        Forms\Components\Toggle::make('category_show_product_count')
                                                            ->label('Show Product Count')
                                                            ->helperText('Display number of products in each category')
                                                            ->inline(false),
                                                    ]),
                                            ]),
                                    ]),
                            ]),
                        Forms\Components\Tabs\Tab::make('Navigation Bar')
                            ->icon('heroicon-o-bars-4')
                            ->schema([
                                Forms\Components\Section::make('Navigation Bar Settings')
                                    ->description('Customize the appearance and functionality of the navigation bar')
                                    ->icon('heroicon-o-bars-4')
                                    ->schema([

                                        Forms\Components\Select::make('nav_mode')
                                            ->label('Navigation Bar Style')
                                            ->options([
                                                1 => 'Simple - Minimalist',
                                                2 => 'Advanced - Feature-rich',
                                                3 => 'Better - Enhanced',
                                            ])
                                            ->default(1)
                                            ->native(false)
                                            ->helperText('Choose the overall style of the navigation bar')
                                            ->columnSpanFull(),
                                        Forms\Components\Select::make('nav_category_menu_mode')
                                            ->label('Category Menu Style')
                                            ->options([
                                                1 => 'Option 1',
                                                2 => 'Option 2',
                                                3 => 'Option 3',
                                                4 => 'Option 4',
                                            ])
                                            ->default(1)
                                            ->native(false)
                                            ->helperText('Choose how categories are displayed in the navigation bar')
                                            ->columnSpanFull(),
                                    ]),
                            ]),
                    ])
                    ->columnSpanFull()
                    ->persistTabInQueryString(),
            ]);
    }

    public function getTitle(): string
    {
        return 'Content Management';
    }

    protected function getHeaderActions(): array
    {
        return [
            // Add any header actions if needed
        ];
    }
}
