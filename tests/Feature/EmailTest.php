<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Support\Facades\URL;
use Tests\TestCase;

class EmailTest extends TestCase
{
	protected $user;

	public function setUp(): void
	{
		parent::setUp();
		$this->user = User::factory()->create([
			'email_verified_at' => null,
		]);
	}

	public function test_email_verification_view()
	{
		$response = $this->actingAs($this->user)->get('/email/verify');
		$response->assertStatus(200);
	}

	public function test_email_verification_verify()
	{
		$verificationUrl = URL::temporarySignedRoute(
			'verification.verify',
			now()->addMinutes(60),
			['id' => $this->user->id, 'hash' => sha1($this->user->email)]
		);
		$response = $this->actingAs($this->user)->get($verificationUrl);
		$response->assertStatus(200);
	}

	public function test_sends_verification_message()
	{
		$response = $this->actingAs($this->user)->post('/email/verification-notification');
		$response->assertRedirect('/');
		$response->assertSessionHas('message', 'Verification link sent!');
	}
}
