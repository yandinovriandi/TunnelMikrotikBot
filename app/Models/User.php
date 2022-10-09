<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'username',
        'phone',
        'email',
        'password',
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
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function getRouteKeyName()
    {
        return 'phone';
    }
    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }

    public function latestOfTransactionNotConfirmed()
    {
        return $this->hasOne(Invoice::class)->latestOfMany()->whereNull('paid_at');
    }

    public function latestOfTransactionConfirmed()
    {
        return $this->hasOne(Invoice::class)->latestOfMany()->whereNotNull('paid_at');
    }

    public function latestOfTransaction()
    {
        return $this->hasOne(Invoice::class)->latestOfMany();
    }

    public function tunnels()
    {
        return $this->hasMany(Tunnel::class);
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'user_role');
    }
}
