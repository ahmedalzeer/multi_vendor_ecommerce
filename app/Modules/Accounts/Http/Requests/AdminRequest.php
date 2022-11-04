<?php

namespace App\Modules\Accounts\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Modules\Accounts\Http\Requests\WithHashedPassword;

class AdminRequest extends FormRequest
{
    use WithHashedPassword;

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        if ($this->isMethod('POST')) {
            return $this->createRules();
        } else {
            return $this->updateRules();
        }
    }

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
     * Get the create validation rules that apply to the request.
     *
     * @return array
     */
    public function createRules()
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:users'],
            'phone' => ['required', 'unique:users,phone'],
            'password' => ['required', 'min:8', 'confirmed'],
            'type' => ['sometimes', 'nullable', Rule::in(array_keys(trans('accounts::users.types')))],
        ];
    }

    /**
     * Get the create validation rules that apply to the request.
     *
     * @return array
     */
    public function updateRules()
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:users,email,' . $this->route('admin')->id],
            'phone' => ['required', 'unique:users,phone,' . $this->route('admin')->id],
            'password' => ['nullable', 'min:8', 'confirmed'],
            'type' => ['sometimes', 'nullable', Rule::in(array_keys(trans('accounts::users.types')))],
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
    {
        return trans('accounts::admins.attributes');
    }
}
