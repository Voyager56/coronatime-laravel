<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Support\Facades\URL;
use Tests\TestCase;

class EmailTest extends TestCase
{
	public function test_email_verification_view()
	{
		$user = User::factory()->create();
		$response = $this->actingAs($user)->get('/email/verify');
		$response->assertStatus(200);
	}

	public function test_email_verification_verify()
	{
		$user = User::factory()->create();
		$verificationUrl = URL::temporarySignedRoute(
			'verification.verify',
			now()->addMinutes(60),
			['id' => $user->id, 'hash' => sha1($user->email)]
		);
		$response = $this->actingAs($user)->get($verificationUrl);
		$response->assertStatus(200);
	}

	public function test_sends_verification_message()
	{
		$user = User::factory()->create([
			'email_verified_at' => null,
		]);
		$response = $this->actingAs($user)->post('/email/verification-notification');
		$response->assertRedirect('/');
		$response->assertSessionHas('message', 'Verification link sent!');
	}
}
