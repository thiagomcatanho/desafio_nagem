<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;

class ClienteUpdateRequest extends ClienteStoreRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return array_merge(parent::rules(), [
            'cnpj' => [
                'required',
                'digits:14',
                Rule::unique('clientes',)->ignore($this->cliente_id, 'id')->whereNull('deleted_at')
            ],
        ]);
    }
}
