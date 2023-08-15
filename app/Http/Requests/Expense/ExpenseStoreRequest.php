<?php

namespace App\Http\Requests\Expense;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;

class ExpenseStoreRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array {
        return [
            'description' => ['required', 'string', 'max:255'],
            'date' => ['required', 'date'],
            'cost' => ['required', 'numeric'],
        ];
    }


    public function getSanitized(): array {
        $sanitized = $this->validated();
        $sanitized['branch_id'] = $this->user()->branch_id;
        $sanitized['created_by'] = $this->user()->id;
        return $sanitized;
    }

}
