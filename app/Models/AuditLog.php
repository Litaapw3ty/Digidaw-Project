<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AuditLog extends Model
{
    protected $table = 'audit_log';
    protected $primaryKey = 'id_log';
    const UPDATED_AT = null;
    protected $fillable = ['id_user', 'aksi', 'tabel_target', 'id_target', 'deskripsi', 'ip_address', 'user_agent'];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }
}

