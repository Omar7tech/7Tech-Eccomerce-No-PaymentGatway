# 🛍️ 7Tech-Eccomerce

**Developed from scratch by [Omar Abi Farraj](https://github.com/omar7tech)**

- **GitHub**: [@omar7tech](https://github.com/omar7tech)

---

## 📄 Copyright

© 2025 **Omar Abi Farraj (omar7tech)**. All rights reserved.

This project is developed and maintained by Omar Abi Farraj. Unauthorized copying, distribution, or use of this software is strictly prohibited.

A modern, feature-rich e-commerce platform built with Laravel 12, Filament 3, and Livewire 3. This application provides a complete e-commerce solution with an admin dashboard, customer-facing store, and comprehensive product management system.

## ✨ Features

### 🎯 Core Features
- **Product Management**: Full CRUD operations for products with images, categories, and tags
- **Category Management**: Organize products with hierarchical categories
- **User Management**: Customer accounts with authentication and profiles
- **Shopping Cart**: Session-based cart with stock management
- **Wishlist**: Save favorite products for later
- **Order Management**: Complete order processing system
- **Payment Integration**: Support for multiple payment methods
- **Reviews & Ratings**: Customer feedback system
- **Banner Management**: Dynamic homepage banners
- **Testimonials**: Customer testimonials display

### 🎨 Frontend Features
- **Responsive Design**: Mobile-first approach with DaisyUI and Tailwind CSS
- **Livewire Components**: Dynamic, reactive user interface
- **Product Cards**: Multiple display modes (Mode 1 & Mode 2)
- **Search & Filtering**: Advanced product search and filtering
- **Pagination**: Efficient product listing
- **Toast Notifications**: User-friendly feedback messages

### ⚙️ Admin Features
- **Filament Admin Panel**: Modern, intuitive admin interface
- **Settings Management**: Comprehensive system settings
- **Product Settings**: Configurable product display options
- **Stock Management**: Real-time stock tracking and alerts
- **Content Management**: Dynamic content editing
- **Analytics Dashboard**: Sales and performance metrics
- **Barcode Generation**: Product barcode creation
- **Export/Import**: Data import/export capabilities

### 🔧 Technical Features
- **Laravel 12**: Latest Laravel framework
- **Filament 3**: Modern admin panel
- **Livewire 3**: Reactive components
- **Spatie Settings**: Dynamic configuration management
- **Database Sessions**: Scalable session management
- **Queue System**: Background job processing
- **File Storage**: Secure file uploads
- **Email Verification**: User email verification
- **CSRF Protection**: Security measures
- **SEO Optimized**: Search engine friendly

## 🚀 Quick Start

### Prerequisites

- **PHP**: 8.2 or higher
- **Composer**: Latest version
- **Node.js**: 18 or higher
- **MySQL**: 8.0 or higher
- **Web Server**: Apache/Nginx (or use Laravel's built-in server)

### Installation

1. **Clone the repository**
   ```bash
   git clone https://github.com/Omar7tech/7Tech-Eccomerce-No-PaymentGatway
   cd Eccomerce-Dashboard-API
   ```

2. **Install PHP dependencies**
   ```bash
   composer install
   ```

3. **Install Node.js dependencies**
   ```bash
   npm install
   ```

4. **Environment setup**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

5. **Configure your database**
   Edit `.env` file with your database credentials:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=your_database_name
   DB_USERNAME=your_username
   DB_PASSWORD=your_password
   ```

6. **Run migrations**
   ```bash
   php artisan migrate
   ```

7. **Seed the database**
   ```bash
   php artisan db:seed
   ```

8. **Build frontend assets**
   ```bash
   npm run build
   ```

9. **Start the development server**
   ```bash
   php artisan serve
   ```

## 📊 Database Seeding

The application comes with comprehensive seeders to populate your database with sample data:

### Available Seeders
- **UserSeeder**: Creates admin and sample users
- **CategorySeeder**: Creates product categories
- **ProductSeeder**: Creates sample products
- **TagSeeder**: Creates product tags
- **TestimonialSeeder**: Creates customer testimonials
- **CartSeeder**: Creates sample cart data
- **OrderSeeder**: Creates sample orders
- **ReviewSeeder**: Creates product reviews

### Default Admin Account
After seeding, you can log in to the admin panel with:
- **Email**: omar@gmail.com
- **Password**: omar1234

### Run Specific Seeders
```bash
# Run all seeders
php artisan db:seed

# Run specific seeder
php artisan db:seed --class=UserSeeder

# Refresh database and seed
php artisan migrate:fresh --seed
```

## 🎛️ Configuration

### Settings Management
The application uses Spatie Laravel Settings for dynamic configuration:

- **General Settings**: Site name, logo, favicon
- **Content Settings**: Homepage content, banners, themes
- **Product Settings**: Card modes, stock management
- **Cart Settings**: Delivery options, payment methods
- **Contact Settings**: Contact information, WhatsApp integration
- **Footer Settings**: Footer content and links
- **Mail Settings**: Email configuration

### Access Admin Panel
Visit `/admin` to access the Filament admin panel.

## 🛠️ Development

### Available Scripts
```bash
# Development server with queue and Vite
composer run dev

# Run tests
composer run test

# Code formatting
./vendor/bin/pint

# Clear all caches
php artisan optimize:clear
```

### File Structure
```
├── app/
│   ├── Filament/          # Admin panel resources
│   ├── Livewire/          # Livewire components
│   ├── Models/            # Eloquent models
│   ├── Settings/          # Application settings
│   └── Services/          # Business logic services
├── database/
│   ├── factories/         # Model factories
│   ├── migrations/        # Database migrations
│   ├── seeders/          # Database seeders
│   └── settings/         # Settings migrations
├── resources/
│   ├── views/            # Blade templates
│   ├── css/              # Stylesheets
│   └── js/               # JavaScript files
└── routes/
    └── web.php           # Web routes
```

## 🔧 Customization

### Product Card Modes
The application supports two product card display modes:
- **Mode 1**: Standard card layout
- **Mode 2**: Compact card layout

Configure in Admin Panel → Products Settings → Card Mode

### Stock Management
Enable stock management features:
- **Work with Stock**: Prevent adding more than available stock
- **Show Low Stock**: Display low stock warnings
- **Show Stock Number**: Display actual stock numbers

### Theme Customization
- Edit `resources/css/app.css` for custom styles
- Modify DaisyUI theme in `tailwind.config.js`
- Update components in `resources/views/`

## 🚀 Deployment

### Production Setup
1. Set `APP_ENV=production` in `.env`
2. Set `APP_DEBUG=false` in `.env`
3. Configure your web server (Apache/Nginx)
4. Set up SSL certificate
5. Configure database for production
6. Set up queue worker for background jobs

### Environment Variables
```env
APP_NAME="Your Store Name"
APP_ENV=production
APP_DEBUG=false
APP_URL=https://yourdomain.com

DB_CONNECTION=mysql
DB_HOST=your_db_host
DB_DATABASE=your_database
DB_USERNAME=your_username
DB_PASSWORD=your_password

SESSION_DRIVER=database
CACHE_STORE=database
QUEUE_CONNECTION=database
```

## 🤝 Contributing

1. Fork the repository
2. Create a feature branch (`git checkout -b feature/amazing-feature`)
3. Commit your changes (`git commit -m 'Add amazing feature'`)
4. Push to the branch (`git push origin feature/amazing-feature`)
5. Open a Pull Request

## 📝 License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

## 🆘 Support

If you encounter any issues or have questions:

1. Check the [Laravel documentation](https://laravel.com/docs)
2. Check the [Filament documentation](https://filamentphp.com/docs)
3. Create an issue in the repository
4. Contact the development team

## 🙏 Acknowledgments

- [Laravel](https://laravel.com/) - The PHP framework
- [Filament](https://filamentphp.com/) - The admin panel
- [Livewire](https://livewire.laravel.com/) - The reactive components
- [DaisyUI](https://daisyui.com/) - The UI component library
- [Tailwind CSS](https://tailwindcss.com/) - The CSS framework

---

**Made with ❤️ using Laravel, Filament, and Livewire**

---

## 👨‍💻 Developer

**Developed from scratch by [Omar Abi Farraj](https://github.com/omar7tech)**

- **GitHub**: [@omar7tech](https://github.com/omar7tech)

---

## 📄 Copyright

© 2025 **Omar Abi Farraj (omar7tech)**. All rights reserved.

This project is developed and maintained by Omar Abi Farraj. Unauthorized copying, distribution, or use of this software is strictly prohibited.

