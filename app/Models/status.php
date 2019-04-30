<?php

namespace equipac\models;

use Illuminate\Database\Eloquent\Model;

class status extends Model
{
    public function manutencao()
    {
        return $this->hasMany('equipac\models\manutencao');
    }
}
