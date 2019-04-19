<?php

namespace equipac\models;

use Illuminate\Database\Eloquent\Model;

class Chamados extends Model
{
    protected $table = 'problema';
    protected $primarykey = 'idProblema';
    public $timestamps = false;
    protected $fillable = ['descricao', 'criacao'];
}
