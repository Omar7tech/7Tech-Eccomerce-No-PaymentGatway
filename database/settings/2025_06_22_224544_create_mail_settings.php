<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

class CreateMailSettings extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('mail.mail_mailer', 'smtp');
        $this->migrator->add('mail.mail_host', 'localhost');
        $this->migrator->add('mail.mail_port', 2525);
        $this->migrator->add('mail.mail_username', null);
        $this->migrator->add('mail.mail_password', null);
        $this->migrator->add('mail.mail_encryption', 'tls');
        $this->migrator->add('mail.mail_from_address', 'hello@example.com');
        $this->migrator->add('mail.mail_from_name', 'Example');
    }
}