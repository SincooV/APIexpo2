<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Turma_model;
use Response;

class TurmaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Turma::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {  $valid = $request -> validate([
            'turma_ano',
            'turma_name'

    ]);}
   
    catch(ValidationException $e){
        return Response::json(['error' => $e]);
    }
    $register = User::create($valid);
  
   
    return Response::json(['OK' => 201]);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
