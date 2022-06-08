<?php

namespace Tests\Feature;

use Tests\TestCase;

class LanguageTest extends TestCase
{
	public function test_it_changes_the_language()
	{
		$response = $this->get('/locale/en');
		$response->assertSessionHas('lang', 'en');
	}
}
