<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateLicLicitadorRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        $method = $this->method();

        if ($method == 'PUT') {
            return [
                'nome_licitador' => ['required','string'],
                'cnpj_licitador' => ['required','string','size:18'],
            ];
        } 
        return [];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'nomeLicitador' => $this->nome_licitador,
            'cnpjLicitador' => $this->cnpj_licitador,
        ]);
    }

}
