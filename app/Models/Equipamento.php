<?php

namespace equipac\models;

use Illuminate\Database\Eloquent\Model;
use equipac\models\Usuario;

class Equipamento extends Model
{
	protected $table = 'equipamento';
    protected $primarykey = 'id';
    public $timestamps = false;
    protected $fillable = ['patrimonio', 'modelo','criacao','usuario_id'];


    public function manutencao()
    {
        // $this->belongsToMany('relacao', 'nome da tabela pivot', 'key ref. equipamento em pivot', 'key ref. manutencao em pivot')
        return $this->belongsToMany('equipac\models\Manutencao','equipamento_has_manutencao', 'equipamento_id', 'manutencao_id')->withPivot(['equipamento_usuario_id']);
    }

    public function usuario()
    {
        //$this->belongsToMany('relacao', 'nome da tabela pivot', 'key ref. equipamento em pivot', 'key ref. manutencao em pivot')
        return $this->belongsTo('equipac\models\Usuario');
    }

}
