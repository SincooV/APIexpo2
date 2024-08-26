<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\ConcatenatedFields;

class StoreDataRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'turma_name' => 'required|string',
            'turma_ano' => 'required|integer',
            'turma' => ['required', 'string', new ConcatenatedFields('turma_name', 'turma_ano')],
        ];
    }
}

