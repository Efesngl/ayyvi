<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Storage;

class Petition extends Model
{
    use HasFactory;
    protected $fillable=["petition_header","petition_content","petition_banner","creator","target_sign","status_id"];

    public function user():BelongsTo{
        return $this->belongsTo(User::class,"creator","id");
    }
    public function topic():BelongsToMany{
        return $this->belongsToMany(Topic::class,"topic_petition_pivot","petition_id","topic_id");
    }
    public function reason():HasMany{
        return $this->hasMany(SignedPetition::class,"petition_id","id");
    }
    public function signedUsers():BelongsToMany{
        return $this->belongsToMany(User::class,"signed_petitions","petition_id","user_id");
    }
    public function status():BelongsTo{
        return $this->belongsTo(PetitionStatus::class,"status_id","id");
    }
    protected function petitionContent(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => substr(strip_tags($value),0,97)."...",
        );
    }
    public function createdAt():Attribute{
        return Attribute::make(
            get: fn (string $value) => date_format(new \DateTime($value),"d.m.Y H:i:s"),
        );
    }
    public function petitionBanner():Attribute{
        return Attribute::make(
            get: fn ($value) => (!is_null($value))?Storage::temporaryUrl($value,now()->addMinutes(2)):null,
        );
    }
}
