<?php
namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
class Company extends Model
{
    protected $table = 'companies';
    protected $primaryKey = 'id';    
    protected $connection = 'mysql2';
    protected $fillable = [
        'company_name', 'company_group_name', 'company_short_name', 'industry_id', 'company_type_id','company_trade_union','company_turnover','company_incorporation_date','company_contract_date','company_end_date','importance_level','company_logo','created_by','updated_by'
    ];
}