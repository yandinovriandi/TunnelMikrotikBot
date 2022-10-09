<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tunnel extends Model
{
    use HasFactory;
    public function getRouteKeyName()
    {
        return 'username';
    }
    protected $fillable = [
        'user_id', 'username', 'password', 'ip_server', 'server', 'local-addrss', 'ip_tunnel', 'url', 'web', 'api', 'winbox', 'expired',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
