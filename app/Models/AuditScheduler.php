<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AuditScheduler extends Model
{
    use HasFactory;
    protected $fillable = [
        'company_id', 'site_id', 'contractor_id', 'date_of_audit', 'audit_type', 'audit_from', 'audit_to', 'created_by','updated_by','status','contractor_status'
    ];

    // public function auditFiles() {
    //     return $this->hasMany(AuditFile::class, 'audit_id');
    // }
}
