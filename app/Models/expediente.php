<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class expediente extends Model
{
    protected $primaryKey = 'id_area';

    public function citas() {
        return $this->hasMany(Cita::class, 'id_area');
    }
}
