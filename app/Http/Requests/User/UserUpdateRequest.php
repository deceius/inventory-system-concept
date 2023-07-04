<?php

namespace App\Http\Requests\User;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;

class UserUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array {
        return [
            'name' => ['string', 'max:255'],
            'access_tier' => ['numeric'],
            'branch_id' => ['numeric'],
        ];
    }

    public function getSanitized(): array {
        $sanitized = $this->validated();
        return $sanitized;
    }

}
