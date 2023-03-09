<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EnderecoTipos extends Model
{
    protected $fillable = [
        'id',
        'descricao',
    ];
}
