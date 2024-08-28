<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Response;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return User::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {  $valid = $request -> validate([
            'name' => 'max:35|required',
            'email' => 'max:40|required',
            'password' => 'max:20|required',
            'turma_id'=> ''
            
    ]);}
   
    catch(ValidationException $e){
        return Response::json(['error' => $e]);
    }
    $register = User::create($valid);
  
    return Response::json(['register' => $register , "klebr"]);

    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $turma = User::find($id);
        if (!$turma) {
            return response()->json([
                'message' => 'turma não encontrada.'
            ], 404);
        }

        $turmas2 = DB::table('users')
        ->join('turmas', 'users.turma_id', '=', 'turmas.id')
        ->where('users.id', 'LIKE', '%' . $id . '%')
        ->select('turmas.*')  // Seleciona todas as colunas da tabela turmas
        ->get();

        return response()->json([
            'message' => 'Detalhes da turma.',
            'data' => $turma


        ]);  
         
    }
    

    
    public function update(Request $request, $id)
    {
        // Validação dos dados recebidos
        $turma = User::findOrFail($id);
         $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'turma_id'=> 'required'
         
         ]);
         

        

        // Encontrar o registro existente
      

        // Atualização dos campos do registro
        $turma->fill($validatedData);
        $turma->save();

        // Retorno da resposta em JSON
        return Response::json([
            'message' => 'atualizada com sucesso.',
            'data' => $turma
        ]);
    }


    /**
     * Update the specified resource in storage.
     */
    public function patch(Request $request, $id)
    {
        $validatedData = $request->validate([
            'turma_id' => 'sometimes|integer',
        ]);

        // Encontrar o registro existente
        $turma = User::findOrFail($id);

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
        $turma = User::find($id);

        if (!$turma) {
            return response()->json([
                'message' => 'User não encontrado.'
            ], 404);
        }

        $turma->delete();

        return response()->json([
            'message' => 'User deletado com sucesso.'
        ]);
    }
}
