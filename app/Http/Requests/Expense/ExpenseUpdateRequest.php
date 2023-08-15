<?php

namespace App\Http\Requests\Expense;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;

class ExpenseUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array {
        return [
            'description' => ['sometimes', 'string', 'max:255'],
            'date' => ['sometimes', 'date'],
            'cost' => ['sometimes', 'numeric'],
        ];
    }


    public function getSanitized(): array {
        $sanitized = $this->validated();
        $sanitized['updated_by'] = $this->user()->id;
        return $sanitized;
    }

}
