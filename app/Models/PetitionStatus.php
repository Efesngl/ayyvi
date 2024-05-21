<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PetitionStatus extends Model
{
    use HasFactory;
    protected $fillable=["id","status"];

    public function petition():HasMany{
        return $this->hasMany(Petition::class,"id","status_id");
    }
}
