<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AuditFile extends Model
{
    use HasFactory;
    protected $fillable = [
        'audit_id', 'particular_id', 'particular_date', 'particular_file', 'text_content', 'clra_from', 'clra_to', 'na', 'created_by','updated_by','status','remarks'
    ];
    public static function audFiles($auditId,$audDate,$audCol)
    {
        $audFiles = AuditFile::where('audit_id',$auditId)
                              ->where('particular_id',$audCol)
                              ->where('particular_date',$audDate)
                              ->first();
        // dump($audFiles);
        return $audFiles;
    }
}