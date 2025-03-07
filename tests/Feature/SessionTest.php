<?php

namespace Tests\Feature;

use App\Models\User;
use Tests\TestCase;

class SessionTest extends TestCase
{
	protected $user;

	public function setUp(): void
	{
		parent::setUp();
		$this->user = User::factory()->create();
	}

	public function test_see_if_landing_page_is_also_login_page()
	{
		$response = $this->get('/');
		$response->assertSee('Please enter your details');
	}

	public function test_if_wrong_username_is_entered_then_error_is_shown()
	{
		$response = $this->post('/login', [
			'username' => 'asdasd@asad',
			'password' => 'asdasd',
		]);

		$response->assertRedirect('/');
		$response->assertSessionHasErrors('username');
	}

	public function test_if_wrong_password_is_entered_then_error_is_shown()
	{
		$response = $this->post('/login', [
			'username' => $this->user->username,
			'password' => 'asdasd',
		]);
		$response->assertRedirect('/');
		$response->assertSessionHasErrors('password');
	}

	public function test_if_validation_is_successful_then_user_is_logged_in()
	{
		$response = $this->post('/login', [
			'username' => $this->user->username,
			'password' => 'password',
		]);
		$response->assertRedirect('/home');
	}

	public function test_if_logout_button_is_clicked_user_should_be_logged_out()
	{
		$response = $this->post('/login', [
			'username' => $this->user->username,
			'password' => 'password',
		]);
		$response->assertRedirect('/home');
		$response = $this->post('/logout');
	}

	public function test_when_loged_in_dashboard_should_be_shown()
	{
		$response = $this->actingAs($this->user)->get('/home');
		$response->assertSee('Dashboard');
	}

	public function test_when_loged_in_countries_stats_should_be_visitable()
	{
		$response = $this->actingAs($this->user)->get('/countries');
		$response->assertSee('Country Statistics');
	}
}
