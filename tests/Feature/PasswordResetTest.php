<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class PasswordResetTest extends TestCase
{
	public function test_if_password_reset_page_is_shown()
	{
		$response = $this->get('/forgot-password');
		$response->assertSee('Reset Password');
	}

	public function test_if_wrong_email_is_entered_error_must_be_shown()
	{
		$response = $this->post(
			'/forgot-password',
			[
				'email' => 'asadasdad@asadasd', ]
		);
		$response->assertSessionHasErrors('email');
	}

	public function test_if_email_is_valid_and_user_exists_reset_link_must_be_sent()
	{
		$user = User::factory()->create();

		$response = $this->post(
			'/forgot-password',
			[
				'email' => $user->email,
			]
		);

		$this->assertDatabaseHas('password_resets', [
			'email' => $user->email,
		]);

		$response->assertSee('Please check your email to reset your password');
	}

	public function test_if_password_reset_form_is_shown()
	{
		$user = User::factory()->create();
		$response = $this->get('/reset-password/' . $user->email . '/' . $user->password_reset_token);
		$response->assertSee('Reset Password');
	}

	public function test_if_password_reset_form_is_validated()
	{
		$response = $this->post('/reset-password', [
			'password'              => '',
			'password_confirmation' => '',
		]);
		$response->assertSessionHasErrors('password');
	}

	public function test_if_password_reset_is_successful()
	{
		$user = User::factory()->create();
		$this->post('/forgot-password', [
			'email' => $user->email,
		]);
		$token = DB::table('password_resets')->where('email', $user->email)->first()->token;

		$response = $this->post('/reset-password', [
			'token'                 => $token,
			'password'              => 'newpassword',
			'password_confirmation' => 'newpassword',
		]);

		$response->assertRedirect('/');
		$this->assertTrue(auth()->attempt(['email' => $user->email, 'password' => 'newpassword']));
	}

	public function test_if_password_reset_token_is_not_valid_error_should_be_shown()
	{
		$user = User::factory()->create();
		$this->post('/forgot-password', [
			'email' => $user->email,
		]);
		$token = DB::table('password_resets')->where('email', $user->email)->first()->token;

		$response = $this->post('/reset-password', [
			'token'                 => 'asdasdasd',
			'password'              => 'newpassword',
			'password_confirmation' => 'newpassword',
		]);

		$response->assertSessionHasErrors('token');
	}
}
