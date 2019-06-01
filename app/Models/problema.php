<?php

namespace equipac\models;

use Illuminate\Database\Eloquent\Model;
use equipac\models\Usuario;

class Problema extends Model
{
    protected $table = 'problema';
    protected $primarykey = 'id';
    public $timestamps = false;
    protected $fillable = ['descricao', 'criacao', 'usuario_id'];

<<<<<<< HEAD

=======
>>>>>>> origin/iteracao3
    public function chamado()
    {
        return $this->hasOne('equipac\models\Chamados', 'problema_id', 'id');
    }

    public function usuario()
    {
        return $this->belongsTo('equipac\models\Usuario');
    }
}
