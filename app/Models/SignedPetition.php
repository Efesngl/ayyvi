<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SignedPetition extends Model
{
    use HasFactory;
    protected $fillable=["id","user_id","petition_id","likes","reason","will_shown"];

    public function petition():BelongsTo{
        return $this->belongsTo(Petition::class,"id","petition_id");
    }
    public function user():BelongsTo{
        return $this->belongsTo(User::class,"user_id","id");
    }
}
