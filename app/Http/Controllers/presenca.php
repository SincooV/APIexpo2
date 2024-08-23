<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Presentes_model;
use Response;

class Presenca extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Presentes_model::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {  $valid = $request -> validate([
           
    ]);}
   
    catch(ValidationException $e){
        return Response::json(['error' => $e]);
    }
    $register = Presenca3::create($valid);
  
    return Response::json(['register' => $register]);

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
