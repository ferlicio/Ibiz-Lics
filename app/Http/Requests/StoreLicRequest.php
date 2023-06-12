<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreLicRequest extends FormRequest
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
        return [
            'nu_fase' => ['required', Rule::in([-1,0,1])],
            'nu_edital' => ['required','string'],
            'modalidade' => ['required','string'],
            'data_abertura' => ['required','date'],
            'nome_licitador' => ['string'],
            'cnpj_licitador' => ['string','size:18'],
            'prioridade' => ['required','integer'],
            'objeto' => ['required','string'],
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'nuFase' => $this->nu_fase,
            'nuEdital' => $this->nu_edital,
            'dataAbertura' => $this->data_abertura,
            'nomeLicitador' => $this->nome_licitador,
            'cnpjLicitador' => $this->cnpj_licitador,
        ]);
    }

}
