<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use App\Models\Scopes\Searchable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasRoles;
    use Notifiable;
    use HasFactory;
    use Searchable;
    use HasApiTokens;

    protected $fillable = ['name', 'email', 'password', 'area_id'];

    protected $searchableFields = ['*'];

    protected $hidden = ['password', 'remember_token'];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function files()
    {
        return $this->hasMany(File::class);
    }

    public function area()
    {
        return $this->belongsTo(Area::class);
    }

    public function isAdmin()
    {
        return $this->hasRole('Administrador');
    }

    public function isJefeArea()
    {
        return $this->hasRole('Jefe de Área');
    }

    public function adminlte_image()
    {
        return asset('images/my-user.png');
    }

    public function adminlte_profile_url()
    {
        return asset('user/profile');
    }
}
