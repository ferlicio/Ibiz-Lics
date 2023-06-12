<?php

namespace App\Http\Controllers\FrontEnd;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Inertia\Inertia;
use PharIo\Manifest\Url;

class InertiaRoutesController extends Controller
{
    public function homepage(Request $request)
    {
        return Inertia::render('App', [
            'page' => ['name' => 'Ibiz Lics | Home']
        ]);
    }
    public function licitacoes(Request $request)
    {
        return Inertia::render('Licitacoes', [
            'page' => ['name' => 'Licitações']
        ]);
    }

    public function licitacao(Request $request, $id)
    {
        return Inertia::render('CreateAndEditLic', [
            'page' => ['name' => 'Nova Licitação']
        ]);
    }
}
