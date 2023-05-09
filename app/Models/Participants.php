<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Participants extends Model
{
    protected $guarded = [];
    use HasFactory;

    public function participant() {
        return $this->hasOne(Invited_Participants::class, 'user_id', 'id');
    }
}
