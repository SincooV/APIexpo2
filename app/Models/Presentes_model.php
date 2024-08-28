<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Presentes_model extends Model
{
    use HasFactory;

       /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'presencazs';

        // Define o relacionamento com o modelo User
        public function user()
        {
            return $this->belongsTo(User::class);
        }

    protected $fillable = [
        'user_id',
        'turma_id'
    ];

}
