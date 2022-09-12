<?php

namespace App\Providers;

use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        VerifyEmail::toMailUsing(function ($notifiable, $url) {
            return (new MailMessage)
                ->subject('Verifikasi Alamat Email')
                ->greeting(__('Verifikasi Alamat Email Anda!'))
                ->line('Klik tombol berikut ini untuk melakukan verifikasi email.')
                ->action('Verifikasi Alamat Email', $url)
                ->line('Jika terdapat kendala pada tombol, silahkan copy tautan yang berada di paling akhir email ini, dan paste pada URL browser Anda.')
                ->line(__('Regards,'))
                ->salutation(config('app.name'));
        });

        ResetPassword::toMailUsing(function ($notifiable, $url) {
            return (new MailMessage)
                ->subject('Permintaan Reset Password')
                ->greeting(__('Permintaan Reset Password.'))
                ->line('Klik tombol berikut ini untuk melakukan reset password Anda.')
                ->action('Reset Password', $url)
                ->line('Jika terdapat kendala pada tombol, silahkan copy tautan yang berada di paling akhir email ini, dan paste pada URL browser Anda.')
                ->line(__('Regards,'))
                ->salutation(config('app.name'));
        });
    }
}
