<?php

namespace App\Filters\Api;

use Illuminate\Http\Request;
use App\Filters\Api\ApiFilter;

class LicFilter extends ApiFilter {
    protected $safeParams = [
        'nuFase' => ['eq','neq'],
        'nuEdital' => ['like'],
        'modalidade' => ['eq','like'],
        'dataAbertura' => ['eq','like'],
        'nomeLicitador' => ['eq','like'],
        'cnpjLicitador' => ['eq','like'],
        'prioridade' => ['eq','gt','lt'],
        'objeto' => ['eq','like'],
    ];

    protected $columnMap = [
        'nuFase' => 'nu_fase',
        'nuEdital' => 'nu_edital',
        'dataAbertura' => 'data_abertura',
        'nomeLicitador' => 'nome_licitador',
        'cnpjLicitador' => 'cnpj_licitador',
    ];

}

class DeletedLicFilter extends ApiFilter {
    protected $safeParams = [
        'deletedAt' => ['eq','neq'],

    ];

    protected $columnMap = [
        'deletedAt' => 'deleted_at',
    ];

}