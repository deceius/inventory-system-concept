<?php

namespace App\Http\Requests\MasterData;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class MasterDataStoreRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array {
        return [
            'name' => ['required', 'string'],
        ];
    }

    public function getSanitized(): array {
        $sanitized = $this->validated();
        $sanitized['created_by'] = $this->user()->email;
        return $sanitized;
    }

}
