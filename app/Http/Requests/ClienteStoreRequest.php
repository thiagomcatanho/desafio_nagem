<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;

class ClienteStoreRequest extends BaseRequest
{
    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation(): void
    {
        $this->merge([
            'cnpj' => preg_replace('/\D/', '', $this->cnpj),
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
            'nome' => 'required',
            'endereco' => 'required|max:100',
            'cnpj' => ['required', 'digits:14', Rule::unique('clientes')->whereNull('deleted_at')],
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
            'cnpj.digits' => 'O campo CNPJ deve ter 14 dígitos.',
            'cnpj.unique' => 'Esse CNPJ já esta cadastrado no sistema.',
        ];
    }
}
