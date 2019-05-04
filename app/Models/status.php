<?php

namespace equipac\models;

use Illuminate\Database\Eloquent\Model;

class status extends Model
{
	protected $table = 'status';
    protected $primarykey = 'id';
    public $timestamps = false;
    
    public function manutencao()
    {
        return $this->hasMany('equipac\models\manutencao');
    }
}
