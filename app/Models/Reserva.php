<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Reserva extends Model {

    protected $table = 'reserva';
    protected $fillable = ['iduser', 'idvacacion'];

    function user(): BelongsTo {
        return $this->belongsTo('App\Models\User', 'iduser');
    }

    function vacacion(): BelongsTo {
        return $this->belongsTo('App\Models\Vacacion', 'idvacacion');
    }
}