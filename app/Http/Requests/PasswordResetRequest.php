<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PasswordResetRequest extends FormRequest
{
	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		return true;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array<string, mixed>
	 */
	public function rules()
	{
		return [
			'token'    => 'required',
			'password' => 'required|min:3|confirmed',
		];
	}

	public function messages()
	{
		return [
			'password.required'  => __('password-required'),
			'password.min'       => __('password-min'),
			'password.confirmed' => __('password-confirmed'),
		];
	}
}
