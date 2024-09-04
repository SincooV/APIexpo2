<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Turma_model;
use Response;
use App\Models\User;
use Illuminate\Support\Facades\DB;
class TurmaController extends Controller
{
   
    
    public function index()
    {
        return Turma_model::all();
    }

   
    public function store(Request $request)
    {
        
        $validatedData = $request->validate([
            'turma_name' => 'required|string',
            'turma_ano' => 'required|integer',
            'ano' => 'required|integer'
        ]);

        $soma = $validatedData['turma_name'] . $validatedData['turma_ano'] . $validatedData['ano'];

       
        $registro = Turma_model::create([
            'turma_name' => $validatedData['turma_name'],
            'turma_ano' => $validatedData['turma_ano'],
            'ano' => $validatedData['ano'],
            'turma' => $soma,
        ]);

        return response()->json($registro, 201);
    }

    
    public function show(string $id)
    {
        $turma = Turma_model::find($id);
        if (!$turma) {
            return response()->json([
                'message' => 'turma não encontrada.'
            ], 404);
        }

        return response()->json([
            'message' => 'Detalhes da turma.',
            'data' => $turma
        ]);   
    

    }

    
    public function update(Request $request, string $id)
    {
        
    
        
    }


    public function destroy(string $id)
    {
        $turma = Turma_model::find($id);

        if (!$turma) {
            return response()->json([
                'message' => 'Turma não encontrada.'
            ], 404);
        }

        $turma->delete();

        return response()->json([
            'message' => 'Turma deletada com sucesso.'
        ]);
    }
    public function searchByTurma($id)
    {
        
        $results = DB::table('turmas')
             ->join('users', 'turmas.id', '=', 'users.turma_id')
             ->where('turmas.turma', $id)
             ->select('turmas.*', 'users.*')
             ->get();
 
             return Response::json(['alunos' => $results]);
                

                
             

    }

        
    
    public function searchByAluno(Request $request, $id)
    {
                                                                                     
        $alunos = User::where('id', 'LIKE', '%' . $id . '%')->get();

    
        $turmas = DB::table('turmas')
        ->join('users', 'users.turma_id', '=', 'turmas.id')
        ->where('turma', 'LIKE', '%' . $id . '%') 
        ->select('turmas.*')  
        ->get();
    

    if ($turmas->isEmpty()) {
        return response()->json([
            'message' => 'Nenhuma turma encontrada para o aluno especificado.'
        ], 404);
    }
    

    return response()->json([
        'message' => 'Turmas encontradas.',
        'data' => $turmas,
        'aluno' => $alunos
        
    ]);
}

}
