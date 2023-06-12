<?php

namespace App\Http\Controllers\Api; //onde está o controller

use App\Models\Lic;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\LicResource;
use App\Http\Resources\Api\LicCollection;
use App\Filters\Api\LicFilter;


class DeletedLicController extends Controller
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
            return new LicCollection(Lic::onlyTrashed()->orderBy('id')->paginate(10));
        } else {
            $Lic = Lic::onlyTrashed()->where($queryItems)->orderBy('id')->paginate(10);
            return new LicCollection($Lic->appends($request->query())); //adiciona os parametros da query na paginação
        }
    }


    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $lic = Lic::onlyTrashed()->findOrFail($id);
        return new LicResource($lic);
    }

    /**
     * Update an specific resource in storage.
     */
    public function update(Request $request, $id)
    {
        return Lic::onlyTrashed()->findOrFail($id)->restore(); 
    }
    

}
