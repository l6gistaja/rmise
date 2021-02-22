<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Application extends Model
{
	use HasFactory;
	use Searchable;
	protected $primaryKey = 'app_code';
	protected $fillable = ['name', 'app_group', 'app_type', 'description', 'app_cost'];
	
    	public function appServices()
    	{
        	return $this->hasMany(AppService::class);
	}
	
	public function toSearchableArray()
    	{
        	return [
            		'name' => $this->name,
			'app_group' => $this->app_group,
			'app_type' => $this->app_type,
			'description' => $this->description,
			'app_cost' => $this->app_cost
        	];
    	}
}
