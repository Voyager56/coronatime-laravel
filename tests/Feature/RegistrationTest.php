<?php

namespace Tests\Feature;

use App\Models\User;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
	public function test_if_registration_form_is_shown()
	{
		$response = $this->get('/signup');
		$response->assertSee('Please enter required info to sign up');
	}

	public function test_if_registration_form_is_validated()
	{
		$response = $this->post('/signup', [
			'username'              => '',
			'email'                 => '',
			'password'              => '',
			'password_confirmation' => '',
		]);
		$response->assertSessionHasErrors('username');
		$response->assertSessionHasErrors('email');
		$response->assertSessionHasErrors('password');
	}

	public function test_if_registration_is_successful()
	{
		$userData = User::factory()->make();

		$response = $this->post('/signup', [
			'username'              => $userData->username,
			'email'                 => $userData->email,
			'password'              => $userData->password,
			'password_confirmation' => $userData->password,
		]);

		$response->assertSee('We have sent you a confirmation email');

		$this->assertDatabaseHas('users', [
			'username' => $userData->username,
			'email'    => $userData->email,
		]);
	}
}
