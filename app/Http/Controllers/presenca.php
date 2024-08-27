<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Presentes_model;
use Response;
use App\Models\User;
use App\Models\Turma_model;
use Illuminate\Support\Facades\DB;
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
            'user_id'=> '', 
            'turma_id'=> ''
            
    ]);}
   
    catch(ValidationException $e){
        return Response::json(['error' => $e]);
    }
    $register = Presentes_model::create($valid);
  
    return Response::json(['register' => $register]);


    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $alunos = User::where('id', 'LIKE', '%' . $id . '%')->get();

        $turmas = DB::table('presencazs')
        ->join('users', 'presencazs.user_id', '=', 'users.id')
        ->where('users.id', 'LIKE', '%' . $id . '%')
        ->select('presencazs.*')  // Seleciona todas as colunas da tabela turmas
        ->get();

        
    if ($turmas->isEmpty()) {
        return response()->json([
            'message' => 'Nenhuma turma encontrada para o aluno especificado.'
        ], 404);
    }

    return response()->json([
        'message' => 'Turmas encontradas.',
        'data' => $turmas,
       
        'aluno' => $alunos]); 
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
     

        // Encontrar o registro existente
        $turma = Turma_model::findOrFail($id);

        // Atualização dos campos do registro apenas se estiverem presentes
        $turma->update($validatedData);

        // Retorno da resposta em JSON
        return response()->json([
            'message' => 'Turma atualizada com sucesso.',
            'data' => $turma
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
