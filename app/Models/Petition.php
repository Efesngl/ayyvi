<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Petition extends Model
{
    use HasFactory;
    protected $fillable=["petition_header","petition_content","petition_banner","creator","target_sign","status"];

    public function user():BelongsTo{
        return $this->belongsTo(User::class,"creator","id");
    }
    public function topic():BelongsToMany{
        return $this->belongsToMany(Topic::class,"topic_petition_pivot","petition_id","topic_id");
    }
    public function reason():HasMany{
        return $this->hasMany(SignedPetition::class,"petition_id","id");
    }

    protected function petitionContent(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => substr(strip_tags($value),0,97)."...",
        );
    }
}
