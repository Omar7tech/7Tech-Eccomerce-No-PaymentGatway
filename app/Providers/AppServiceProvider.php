<?php

namespace App\Providers;

use App\Models\Product;
use App\Observers\ProductObserver;
use App\Settings\CustomerServiceSettings;
use App\Settings\GeneralSettings;
use App\Settings\MailSettings;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        if (app()->runningInConsole()) {
            try {
                if (!Schema::hasTable('settings')) {
                    return;
                }
            } catch (\Exception $e) {
                return;
            }
        }

        $mailSettings = app(MailSettings::class);
        if ($mailSettings->mail_host) {
            Config::set('mail.mailers.smtp', [
                'transport' => 'smtp',
                'host' => $mailSettings->mail_host,
                'port' => $mailSettings->mail_port,
                'encryption' => $mailSettings->mail_encryption,
                'username' => $mailSettings->mail_username,
                'password' => $mailSettings->mail_password,
                'timeout' => null,
                'auth_mode' => null,
            ]);
            Config::set('mail.from.address', $mailSettings->mail_from_address);
            Config::set('mail.from.name', $mailSettings->mail_from_name);
            Config::set('mail.default', $mailSettings->mail_mailer);
        }

        // Set app name for emails to use site name from settings
        $generalSettings = app(GeneralSettings::class);
        if ($generalSettings->site_name) {
            Config::set('app.name', $generalSettings->site_name);
        }

        Product::observe(ProductObserver::class);

        view()->composer(
            ['components.layouts.app', 'livewire.*'],
            function ($view) {
                $categories = \App\Models\Category::orderBy("sort", "asc")->get();
                $settings = resolve(GeneralSettings::class);

                $content = resolve(\App\Settings\ContentSettings::class);
                $footer = resolve(\App\Settings\FooterSettings::class);
                $view->with('categoriesGlobal', $categories)->with('settings', $settings)->with('content', $content)->with('footer', $footer);
            }
        );

        view()->composer(
            ['components.layouts.app'],
            function ($view) {
                $aboutPageSettings = resolve(\App\Settings\AboutPageSettings::class);
                $customerService = resolve(CustomerServiceSettings::class);
                $contact = resolve(\App\Settings\ContactSettings::class);
                $view->with('customerService', $customerService)->with('aboutPageSettings', $aboutPageSettings)->with('contact', $contact);
            }
        );

    }
}