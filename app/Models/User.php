<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'users';
    protected $primaryKey = 'id_user';
    public $timestamps = true;

    protected $fillable = [
        'id_role', 'id_instansi', 'name', 'username', 'email',
        'password', 'no_hp', 'nip', 'foto_profil', 'status', 'last_login',
    ];

    protected $hidden = ['password', 'remember_token'];

    protected function casts(): array
    {
        return [
            'last_login' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // --- Relasi ---
    public function role()
    {
        return $this->belongsTo(Role::class, 'id_role', 'id_role');
    }

    public function instansi()
    {
        return $this->belongsTo(Instansi::class, 'id_instansi', 'id_instansi');
    }

    public function asesor()
    {
        return $this->hasOne(Asesor::class, 'id_user', 'id_user');
    }

    // --- Helper role check (dipakai di middleware/policy) ---
    public function isAdmin(): bool
    {
        return $this->role?->nama_role === 'ADMIN';
    }

    public function isAsesor(): bool
    {
        return $this->role?->nama_role === 'ASESOR';
    }

    public function isUser(): bool
    {
        return $this->role?->nama_role === 'USER';
    }
}
