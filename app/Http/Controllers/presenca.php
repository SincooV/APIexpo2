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

    /**l
     * Display the specified resource.
     */
    public function show($id)
    {
   
  

   

    $posts = DB::table('presencazs')
    ->join('users', 'presencazs.user_id', '=', 'users.id')
    ->select('presencazs.*', 'users.name as user_name')
    
    ->get();



    
      
        $posts = Presentes_model::with('user')->get();
        $posts2 = Turma_model::with('turma')->get();

      
        return response()->json([
            'presencazs' => $posts->map(function ($post, $posts2) {
                return [
                    'id_turma' => $post->user->turma_id,
                    'user_name' => $post->user->name,
                 
                    'user_table' => (new \App\Models\User())->getTable() // nome da tabela do usuário
                ];
            })]);



    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
     

     
        $turma = Turma_model::findOrFail($id);

        // Atualização dos campos do registro apenas se estiverem presentes
        $turma->update($validatedData);

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
