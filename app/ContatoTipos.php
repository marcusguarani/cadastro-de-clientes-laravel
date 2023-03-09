<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContatoTipos extends Model
{
    protected $fillable = [
        'id',
        'descricao',
    ];
}
