<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\User;
use Illuminate\Notifications\Notifiable;

class Turma extends Authenticatable
{
    use HasFactory, Notifiable;

  
    protected $fillable = [
        'turma_name',
        'turma_ano',
    ];
    public function user(){
        $this->hasMany(User::class);
    }

   

}
