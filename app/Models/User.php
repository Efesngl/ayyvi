<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;

class User extends Authenticatable implements FilamentUser
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        "profile_photo",
        "is_admin"
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    public function petitions():HasMany{
        return $this->hasMany(Petition::class,"creator","id");
    }
    public function donation():HasMany{
        return $this->hasMany(Donation::class,"user_id","id");
    }
    public function signedPetition():BelongsToMany{
        return $this->belongsToMany(Petition::class,"signed_petitions","user_id","petition_id");
    }


    public function profilePhoto():Attribute{
        return Attribute::make(
            get: fn ($value) => (!is_null($value))?Storage::temporaryUrl($value,now()->addMinutes(2)):null,
        );
    }
    public function canAccessPanel(Panel $panel): bool
    {
        return ($this->is_admin==true);
    }
}
