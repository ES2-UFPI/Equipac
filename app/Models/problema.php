<?php

namespace equipac\models;

use Illuminate\Database\Eloquent\Model;
use equipac\models\Usuario;


class Problema extends Model
{
    protected $table = 'problema';
    protected $primarykey = 'idProblema';
    public $timestamps = false;
    protected $fillable = ['descricao', 'criacao', 'usuario_id'];


    public function chamado()
    {
        return $this->hasOne('equipac\models\Chamados');
    }

    public function usuario()
    {
        return $this->belongsTo('equipac\models\Usuario');
    }
}
