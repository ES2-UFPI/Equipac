<?php

namespace equipac\models;

use Illuminate\Database\Eloquent\Model;

class problema extends Model
{
    protected $table = 'problema';
    protected $primarykey = 'idProblema';
    public $timestamps = false;
    protected $fillable = ['descricao', 'criacao', 'usuario_id'];
}
