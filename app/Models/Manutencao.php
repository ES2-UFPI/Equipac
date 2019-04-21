<?php

namespace equipac\models;

use Illuminate\Database\Eloquent\Model;

class Manutencao extends Model
{
    protected $table = 'Manutencao';
    protected $primarykey = 'id';
    public $timestamps = false;
    protected $fillable = ['patrimonio', 'modelo','criacao','usuario_id'];


    public function equipamento()
    {
        //    $this->belongsToMany('relacao', 'nome da tabela pivot', 'key ref. manutencao em pivot', 'key ref. equipamento em pivot')
        return $this->belongsToMany('equipac\models\Equipamento','equipamento_has_manutencao', 'manutencao_id', 'equipamento_id')->withPivot(['equipamento_usuario_id']);;
    }
    
}
