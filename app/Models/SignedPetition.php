<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SignedPetition extends Model
{
    use HasFactory;
    protected $fillable=["id","user_id","petition_id","likes","reason"];

    public function petition():BelongsTo{
        return $this->belongsTo(Petition::class,"id","petition_id");
    }
}
