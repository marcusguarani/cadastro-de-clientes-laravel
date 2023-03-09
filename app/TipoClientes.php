<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoClientes extends Model
{
    protected $fillable = [
        'id',
        'descricao',
    ];
}
