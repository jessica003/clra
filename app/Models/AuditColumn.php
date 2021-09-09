<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AuditColumn extends Model
{
    use HasFactory;

    public function auditFiles() {
        return $this->hasMany(AuditFile::class, 'audit_id');
    }
}