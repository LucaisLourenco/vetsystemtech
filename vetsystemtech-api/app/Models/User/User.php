<?php

namespace App\Models\User;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'name',
        'username',
        'cpf',
        'role_id',
        'gender_id',
        'email',
        'birth',
        'password',
        'active'
    ];

    public function role() {
        return $this->belongsTo('App\Models\Papel\Role')->withTrashed();
    }

    public function gender() {
        return $this->belongsTo('App\Models\Genero\Gender')->withTrashed();
    }

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    public function findForPassport($username)
    {
        return $this->where('username', $username)->first();
    }

    public function getAuthPassword()
    {
        return $this->password;
    }
}
