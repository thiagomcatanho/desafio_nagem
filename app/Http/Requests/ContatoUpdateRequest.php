<?php

namespace App\Http\Requests;

use Illuminate\Database\Query\Builder;
use Illuminate\Validation\Rule;

class ContatoUpdateRequest extends ContatoStoreRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return array_merge(parent::rules(), [
            'email_contato' => [
                'required',
                'email',
                Rule::unique('contatos', 'email_contato')
                    ->where('cliente_id', $this->cliente_id)
                    ->whereNull('deleted_at')
                    ->ignore($this->contato_id, 'id'),
            ],
            'cpf' => [
                'required',
                'digits:11',
                Rule::unique('contatos', 'cpf')
                    ->where('cliente_id', $this->cliente_id)
                    ->whereNull('deleted_at')
                    ->ignore($this->contato_id, 'id'),
            ]
        ]);
    }
}
