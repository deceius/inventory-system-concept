<?php

namespace App\Http\Requests\Item;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;

class ItemStoreRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array {
        return [
            'name' => ['required', 'string', 'max:255'],
            'brand_id' => ['required', 'numeric'],
            'type_id' => ['required', 'numeric'],
        ];
    }


    public function getSanitized(): array {
        $sanitized = $this->validated();
        $sanitized['created_by'] = $this->user()->id;
        return $sanitized;
    }

}
