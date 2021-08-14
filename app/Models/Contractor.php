<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Contractor extends Model
{	
    protected $connection = 'mysql2';
	protected $fillable = [	    
   		'user_id','company_id','site_id','created_at','updated_at'
	];
}