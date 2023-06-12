<?php

namespace App\Http\Controllers\Api; //onde está o controller

use App\Http\Requests\UpdateLicLicitadorRequest;
use App\Http\Requests\UpdateLicFaseRequest;
use App\Http\Resources\Api\LicCollection;
use App\Http\Requests\UpdateLicRequest;
use App\Http\Resources\Api\LicResource;
use App\Http\Requests\StoreLicRequest;
use App\Http\Controllers\Controller;
use App\Filters\Api\LicFilter;
use Illuminate\Http\Request;
use App\Models\Lic;

class LicController extends Controller
{
    /**
     * Display a listing of the resource.
     * 
     */
    public function index(Request $request)
    {
        $filter = new LicFilter();
        $queryItems = $filter->transform($request);//transforma os parametros da query em array 

        if (count($queryItems)==0) {
            return new LicCollection(Lic::orderBy('id')->paginate(10));
        } else {
            $Lic = Lic::where($queryItems)->orderBy('id')->paginate(10);
            return new LicCollection($Lic->appends($request->query())); //adiciona os parametros da query na paginação
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreLicRequest $request)
    {
        return new LicResource(Lic::create($request->all()));
    }

    /**
     * Display the specified resource.
     */
    public function show(Lic $lic)
    {
        return new LicResource($lic);
    }

    /**
     * Update an specific resource in storage.
     */
    public function update(UpdateLicRequest $request, Lic $lic)
    {
        $lic->update($request->all());
    }
    /**
     * Update the specified resource in storage.
     */
    public function updateNuFase(UpdateLicFaseRequest $request, Lic $lic)
    {
        $lic->update($request->only('nu_fase'));
    }
    public function updateLicitador(UpdateLicLicitadorRequest $request, Lic $lic)
    {
        $lic->update($request->only('nome_licitador','cnpj_licitador'));
    }
    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Lic $lic)
    {
        $lic->delete();
        return response()->json(null, 204);
    }

}
