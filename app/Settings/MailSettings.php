<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class MailSettings extends Settings
{
    public string $mail_mailer = 'smtp';
    public ?string $mail_host = 'smtp.mailtrap.io';
    public ?int $mail_port = 2525;
    public ?string $mail_username = null;
    public ?string $mail_password = null;
    public ?string $mail_encryption = 'tls';
    public ?string $mail_from_address = 'hello@example.com';
    public ?string $mail_from_name = 'Example';

    public static function group(): string
    {
        return 'mail';
    }
}
