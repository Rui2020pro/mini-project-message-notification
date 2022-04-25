<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mensagem extends Model
{
    use HasFactory;

    protected $table = 'mensagens';

    protected $fillable = [
        'user_id',
        'mensagem',
        'position',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function getPosition(int $mensagem_id){
        $max_position = Mensagem::where('user_id', auth()->user()->id)
        ->where('deleted_at', null)
        ->latest('position')->first();

        if ($max_position == 0) {
            $position = $max_position->position + 1;
        }

        return $position;

    }

    public function setPosition(int $mensagem_id, int $position = 0){
        $mensagem = Mensagem::find($mensagem_id);
        $mensagem->position = $position;
        $mensagem->save();
    }
}
