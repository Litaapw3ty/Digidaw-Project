<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class AuditLog extends Model
{
    protected $table = 'audit_log';
    protected $primaryKey = 'id_log';
    const UPDATED_AT = null;
    protected $fillable = ['id_user', 'aksi', 'tabel_target', 'id_target', 'deskripsi', 'ip_address', 'user_agent'];

    public static function record(string $action, ?string $targetTable = null, $targetId = null, ?string $description = null): self
    {
        return static::create([
            'id_user' => Auth::id(),
            'aksi' => $action,
            'tabel_target' => $targetTable,
            'id_target' => $targetId,
            'deskripsi' => $description,
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
        ]);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }
}
