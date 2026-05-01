<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends StoreUserRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules = parent::rules();
        $rules["phone"] = "nullable|string|max:20|Rule::unique(User::class)->ignore($this->user()->id)";
        $rules["password"] = "nullable|string|min:8|max:32";
        return $rules;
    }
}
