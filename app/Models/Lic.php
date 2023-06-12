<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Lic extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'nu_fase',
        'nu_edital',
        'modalidade',
        'data_abertura',
        'nome_licitador',
        'cnpj_licitador',
        'prioridade',
        'objeto',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function getDateFormat()
    {
        return 'Y-m-d H:i:s';
    }
}
