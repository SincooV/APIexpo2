<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Turma_model;
use Response;
use App\Models\User;
use Illuminate\Support\Facades\DB;
class TurmaController extends Controller
{
   
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Turma_model::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validação dos campos de entrada
        $validatedData = $request->validate([
            'turma_name' => 'required|string',
            'turma_ano' => 'required|integer',
            'ano' => 'required|integer'
        ]);

        // Soma dos campos e armazenamento no campo 'resultado_soma'
        $soma = $validatedData['turma_name'] . $validatedData['turma_ano'] . $validatedData['ano'];

        // Criação do registro na tabela
        $registro = Turma_model::create([
            'turma_name' => $validatedData['turma_name'],
            'turma_ano' => $validatedData['turma_ano'],
            'ano' => $validatedData['ano'],
            'turma' => $soma,
        ]);

        // Retorna uma resposta com o registro criado
        return response()->json($registro, 201);
    }

    

    /**
     * Display the specified resource.
     */
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

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        
    
        
    }

    /**
     * Remove the specified resource from storage.
     */
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
    public function searchByTurma(Request $request, $turma)
    {
        // Validação se o parâmetro 'turma' está presente
       
 
        // Buscar registros onde o campo 'turma' é igual ao valor fornecido
        $resultados = Turma_model::where('turma', $turma)->get();
 
        if ($resultados->isEmpty()) {
            return response()->json([
                'message' => 'Nenhuma turma encontrada com o nome especificado.'
            ], 404);
        }
 
        return response()->json([
            'message' => 'Turmas encontradas.',
            'data' => $resultados
        ]);
    }
    public function searchByAluno(Request $request, $id)
    {
        // Validação do nome do aluno
   
        // Buscar alunos                                                                                                
        $alunos = User::where('id', 'LIKE', '%' . $id . '%')->get();

        $turmas = DB::table('users')
        ->join('turmas', 'users.turma_id', '=', 'turmas.id')
        ->where('users.id', 'LIKE', '%' . $id . '%')
        ->select('turmas.*')  // Seleciona todas as colunas da tabela turmas
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
    

