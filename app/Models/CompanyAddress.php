<?php
namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
class CompanyAddress extends Model
{
    protected $table = 'companies_address';
    protected $primaryKey = 'company_address_id';
    protected $connection = 'mysql2';
    protected $fillable = [
        'companies_id', 'company_office_loc_name', 'company_loc_startdate','company_loc_enddate','company_address','state_id','city_id','location_type','location_type_id','country_office','state_office','city_office','clra','company_mobile','company_mail_id','company_staff_male','company_staff_female','company_staff_apprentices','company_staff_contract','created_by','updated_by'
    ];
}