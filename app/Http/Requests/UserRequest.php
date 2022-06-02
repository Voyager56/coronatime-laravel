<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize(): bool
	{
		return true;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array<string, mixed>
	 */
	public function rules(): array
	{
		return [
			'username'     => 'required|min:3',
			'email'        => 'required|email|unique:users',
			'password'     => 'required|min:6|confirmed',
		];
	}

	public function messages()
	{
		return [
			'username.required'  => __('username-required'),
			'username.min'       => __('username-min'),
			'email.required'     => __('email-required'),
			'email.email'        => __('email-invalid'),
			'email.unique'       => __('email-unique'),
			'password.required'  => __('password-required'),
			'password.min'       => __('password-min'),
			'password.confirmed' => __('password-confirmed'),
		];
	}

	public function response()
	{
		return redirect()->back()->withInput()->withErrors(
			$this->errors()
		);
	}
}
