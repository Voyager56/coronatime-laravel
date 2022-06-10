<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;

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
			'username.required'  => __('username_required'),
			'username.min'       => __('username_min'),
			'email.required'     => __('email_required'),
			'email.email'        => __('email_invalid'),
			'email.unique'       => __('email_unique'),
			'password.required'  => __('password_required'),
			'password.min'       => __('password_min'),
			'password.confirmed' => __('password_confirmed'),
		];
	}

	public function withValidator(Validator $validator)
	{
		return redirect()->back()->withInput()->withErrors($validator->errors());
	}
}
