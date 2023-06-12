<?php

namespace App\Filters\Api;

use Illuminate\Http\Request;

class ApiFilter {
    protected $safeParams = [];

    protected $columnMap = [];

    protected $operatorMap = [
        'eq' => '=',
        'neq' => '!=',
        'gt' => '>',
        'lt' => '<',
        'like' => 'LIKE', 
    ];

    public function transform(Request $request): array
    {
        $queryItems = [];
        foreach ($this->safeParams as $param => $operators) { // $param é a chave do array $safeParams e $operators('eq','neq') é o valor
            $query = $request->query($param); // pega o valor da query da requisição se ela existir
            if (!isset($query)) { // se não existir $query,
                continue;// pula para a próxima iteração do foreach
            }
            $column = $this->columnMap[$param] ?? $param; // checa se existe $param no array $columnMap, se não existir, retorna o próprio $param
            foreach ($operators as $operator) { // nessa linha $operator é o valor do array $operators
                if (isset($query[$operator])) { // se existir $query[$operator],
                    $value = $query[$operator];
                if ($operator === 'like') {
                    $value = "%{$value}%";
                }
                $queryItems[] = [$column, $this->operatorMap[$operator], $value];
                }
            }
        }
        return $queryItems;
    }
}