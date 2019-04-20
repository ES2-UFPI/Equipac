<?php

namespace equipac\models;

use Illuminate\Database\Eloquent\Model;

class Equipamento extends Model
{
	protected $table = 'equipamento';
    protected $primarykey = 'idEquipamento';
    public $timestamps = false;
    protected $fillable = ['patrimonio', 'modelo','criacao','usuario_id'];

}
