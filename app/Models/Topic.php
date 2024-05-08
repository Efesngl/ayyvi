<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Topic extends Model
{
    use HasFactory;
    protected $fillable=["id","topic"];
    public function petition():BelongsToMany{
        return $this->belongsToMany(Petition::class,"topic_petition_pivot","topic_id","petition_id");
    }
}
