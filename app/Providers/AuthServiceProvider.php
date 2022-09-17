<?php

namespace App\Providers;

use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\URL;

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
                ->line(Lang::get('Link verifikasi ini akan kadaluarsa dalam :count menit.', ['count' => Config::get('auth.verification.expire', 60)]))
                ->line('Jika terdapat kendala pada tombol, silahkan copy tautan yang berada di paling akhir email ini, dan paste pada URL browser Anda.')
                ->line(__('Regards,'))
                ->salutation(config('app.name'));
        });

        ResetPassword::toMailUsing(function ($notifiable, $token) {
            return (new MailMessage)
                ->subject('Permintaan Reset Password')
                ->greeting(__('Permintaan Reset Password.'))
                ->line('Klik tombol berikut ini untuk melakukan reset password Anda.')
                ->action('Reset Password', url(URL::to('/') . route('password.reset', $token, false)))
                ->line(Lang::get('Link reset password ini akan kadaluarsa dalam :count menit.', ['count' => config('auth.passwords.' . config('auth.defaults.passwords') . '.expire')]))
                ->line('Jika terdapat kendala pada tombol, silahkan copy tautan yang berada di paling akhir email ini, dan paste pada URL browser Anda.')
                ->line(__('Regards,'))
                ->salutation(config('app.name'));
        });
    }
}
