<?php

declare(strict_types=1);

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'email' => 'sometimes|required|string|email|max:255|unique:users',
            'name' => 'sometimes|required|string|max:255',
            'phone' => 'sometimes|required|string|max:20',
        ];
    }
}
