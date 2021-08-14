<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AuditFile extends Model
{
    use HasFactory;
    protected $fillable = [
        'audit_id', 'particular_id', 'particular_date', 'particular_file', 'text_content', 'clra_from', 'clra_to', 'na', 'created_by','updated_by','status'
    ];
}