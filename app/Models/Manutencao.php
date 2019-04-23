<?php

namespace equipac\models;

use Illuminate\Database\Eloquent\Model;

class Manutencao extends Model
{
    protected $table = 'Manutencao';
    protected $primarykey = 'id';
    public $timestamps = false;
    protected $fillable = ['dataAtribuida', 'status','solucao'];


    public function equipamento()
    {
        return $this->belongsToMany('equipac\models\Equipamento','equipamento_has_manutencao', 'manutencao_id', 'equipamento_id')->withPivot(['equipamento_usuario_id']);;
    }
    
}
