<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Donation extends Model
{
    use HasFactory;
    protected $fillable=["user_id","amount","created_at","updated_at"];
    public $timestamps = true;

    public function user():BelongsTo{
        return $this->belongsTo(User::class,"user_id","id");
    }
    public function createdAt():Attribute{
        return Attribute::make(
            get: fn (string $value) => date_format(new \DateTime($value),"d.m.Y H:i:s"),
        );
    }
}
