<?php

namespace App\Http\Requests;

use Illuminate\Database\Query\Builder;
use Illuminate\Validation\Rule;

class ContatoStoreRequest extends BaseRequest
{
    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation(): void
    {
        $this->merge([
            'cpf' => preg_replace('/\D/', '', $this->cpf),
            'fone_contato' => preg_replace('/\D/', '', $this->fone_contato),
        ]);
    }
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'cliente_id' => ['required', Rule::exists('clientes', 'id')],
            'nome_contato' => ['required'],
            'fone_contato' => ['required', 'digits:11'],
            'email_contato' => [
                'required',
                'email',
                Rule::unique('contatos', 'email_contato')
                    ->where('cliente_id', $this->cliente_id)
                    ->whereNull('deleted_at'),
            ],
            'cpf' => [
                'required',
                'digits:11',
                Rule::unique('contatos', 'cpf')
                    ->where('cliente_id', $this->cliente_id)
                    ->whereNull('deleted_at'),
            ]
        ];
    }
    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'cpf.digits' => 'O campo cpf deve ter 11 dígitos.',
            'cpf.unique' => 'Esse CPF já se encontra cadastrado neste cliente.',
            'email_contato.unique' => 'Esse email já se encontra cadastrado neste cliente.',
            'fone_contato.digits' => 'O campo fone deve ter 11 dígitos.',
        ];
    }
}
