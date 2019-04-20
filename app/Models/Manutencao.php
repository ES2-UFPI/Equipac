<?php

namespace equipac\models;

use Illuminate\Database\Eloquent\Model;

class Manutencao extends Model
{
    protected $table = 'Manutencao';
    protected $primarykey = 'idManutencao';
    public $timestamps = false;
    protected $fillable = ['patrimonio', 'modelo','criacao','usuario_id'];
}
