<?php

namespace App\Http\Requests\Branch;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class BranchStoreRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array {
        return [
            'name' => ['required', 'string'],
            'address' => ['required', 'string'],
            'tin' => ['required', 'string'],
        ];
    }

    public function getSanitized(): array {
        $sanitized = $this->validated();
        $sanitized['created_by'] = $this->user()->id;
        return $sanitized;
    }

}
