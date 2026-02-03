<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Comentario extends Model {

    protected $table = 'comentario';
    protected $fillable = ['iduser', 'idvacacion', 'texto'];

    function user(): BelongsTo {
        return $this->belongsTo('App\Models\User', 'iduser');
    }

    function vacacion(): BelongsTo {
        return $this->belongsTo('App\Models\Vacacion', 'idvacacion');
    }

    function isOwner(): bool {
        return $this->iduser == \Illuminate\Support\Facades\Auth::user()->id;
    }
}