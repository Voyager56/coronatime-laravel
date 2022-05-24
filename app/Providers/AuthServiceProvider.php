<?php

namespace App\Providers;

use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Notifications\Messages\MailMessage;

class AuthServiceProvider extends ServiceProvider
{
	/**
	 * The model to policy mappings for the application.
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
			dd($url);
			return (new MailMessage)
				->subject('Verify Email Address')
				->view('mail.signup', [
					'url'          => $url,
					'msg'          => 'Confirmation Email',
					'clickMessage' => 'click this button to verify your email',
					'buttonText'   => 'VERIFY EMAIL',
				]);
		});
	}
}
