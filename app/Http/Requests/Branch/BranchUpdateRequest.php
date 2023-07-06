<?php

namespace App\Http\Requests\Branch;

use App\Models\Branch;
use Illuminate\Foundation\Http\FormRequest;

class BranchUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array {
        return [
            'name' => ['string'],
            'address' => ['string'],
            'tin' => ['string'],
        ];
    }

    public function getSanitized(): array {
        $sanitized = $this->validated();
        $sanitized['updated_by'] = $this->user()->id;
        return $sanitized;
    }

}
