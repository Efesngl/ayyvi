<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Petition extends Model
{
    use HasFactory;
    protected $fillable=["petition_header","petition_content","petition_banner","creator","target_sign","status"];

    public function user():BelongsTo{
        return $this->belongsTo(User::class,"creator","id");
    }
}
