<?php

namespace App\Http\Requests\Link;

use Illuminate\Foundation\Http\FormRequest;

class MarkListAsReadRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'links' => [
                'required',
                'array',
            ],
            'links.*' => [
                'required',
                'int',
                'exists:links,id',
            ],
        ];
    }

    protected function prepareForValidation()
    {
        if ($this->filled('read')) {
            $payload = decrypt($this->input('read'));
            $payload = array_map('trim', explode(',', $payload));

            $this->replace([
                'links' => $payload,
            ]);
        }
    }
}
