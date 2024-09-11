<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Presentes_model;
use Response;
use App\Models\User;
use App\Models\Turma_model;
use Illuminate\Support\Facades\DB;
use Log;
class Presenca extends Controller
{
   
    public function index()
    {
        return Presentes_model::all();
    }


     
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


    public function show($id)
    {
   
  
        $results = DB::table('users')
        ->join('presencas', 'users.id', '=', 'presencas.user_id')
        ->join('turmas', 'users.turma_id', '=', 'turmas.id') 
        ->where('turmas.turma', $id)
        ->select('presencas.*' , 'users.name', 'users.created_at', 'users.updated_at', 'users.email')
        ->get();
    
       

      

        return Response::json(['alunos' => $results]);
 


    
      
        $posts = Presentes_model::with('user')->get();
        $posts2 = Turma_model::with('turma')->get();

      
        return response()->json([
            'presencas' => $posts->map(function ($post, $posts2) {
                return [
                    'id_turma' => $post->user->turma_id,
                    'user_name' => $post->user->name,
                 
                    'user_table' => (new \App\Models\User())->getTable()
                ];
            })]);



    }
    
    public function update(Request $request, string $id)
    {
     

     
        $turma = Turma_model::findOrFail($id);

      
        $turma->update($validatedData);

        return response()->json([
            'message' => 'Turma atualizada com sucesso.',
            'data' => $turma
        ]);
    }


    
     
    public function destroy(string $id)
    {
        
    }


    

    
}