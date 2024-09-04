<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Turma_model extends Model
{
    use HasFactory;
  
    public function User()
    {
        return $this->belongsTo(User::class);
    }
    protected $table = 'turmas';
    public $turma = 'turma_name  turma_ano';
    protected $fillable = [
        'turma_name',
        'turma_ano',
        'turma',
        'ano'
    ];
  
}
