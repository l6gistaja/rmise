<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class AppService extends Model
{
	use HasFactory;
	use Searchable;

	protected $primaryKey = 'service_code';
	protected $fillable = ['name', 'type', 'sub_type', 'description'];

	public function toSearchableArray()
    	{
        	return [
            		'name' => $this->name,
            		'type' => $this->type,
			'sub_type' => $this->sub_type,
			'description' => $this->description
        	];
    	}
}
