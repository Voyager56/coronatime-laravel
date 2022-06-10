<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\EmailOrUsername;
use Illuminate\Contracts\Validation\Validator;

class LoginRequest extends FormRequest
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
			'username' => ['required', new EmailOrUsername],
			'password' => 'required',
		];
	}

	public function messages()
	{
		return [
			'username.required'  => __('username_required'),
			'password.required'  => __('password_required'),
			'password.exists'    => __('password_incorrect'),
		];
	}

	public function withValidator(Validator $validator)
	{
		return redirect()->back()->withInput()->withErrors($validator->errors());
	}
}
