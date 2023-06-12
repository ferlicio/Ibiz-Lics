<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LicResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'nu_fase' => $this->nu_fase,
            'nu_edital' => $this->nu_edital,
            'modalidade' => $this->modalidade,
            'data_abertura' => $this->data_abertura,
            'nome_licitador' => $this->nome_licitador,
            'cnpj_licitador' => $this->cnpj_licitador,
            'prioridade' => $this->prioridade,
            'objeto' => $this->objeto,
        ];
    }
}
