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
        ]);

        // Soma dos campos e armazenamento no campo 'resultado_soma'
        $soma = $validatedData['turma_name'] . $validatedData['turma_ano'];

        // Criação do registro na tabela
        $registro = Turma_model::create([
            'turma_name' => $validatedData['turma_name'],
            'turma_ano' => $validatedData['turma_ano'],
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
         // Validação dos dados recebidos
         $validatedData = $request->validate([
            'turma_name' => 'required|string',
            'turma_ano' => 'required|string',
        ]);

        // Encontrar o registro existente
        $turma = Turma_model::where('turma_name', $validatedData['turma_name'])
        ->where('turma_ano', $validatedData['turma_ano'])
        ->first();
        // Atualização dos campos do registro
        $turma->fill($validatedData);
        $turma->save();

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
