<?php

namespace App\Http\Requests\Item;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;

class ItemUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array {
        return [
            'name' => ['sometimes', 'string', 'max:255'],
            'brand_id' => ['sometimes', 'numeric'],
            'type_id' => ['sometimes', 'numeric'],
        ];
    }


    public function getSanitized(): array {
        $sanitized = $this->validated();
        $sanitized['updated_by'] = $this->user()->id;
        return $sanitized;
    }

}
