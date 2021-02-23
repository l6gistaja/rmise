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
	protected $fillable = ['app_code', 'name', 'type', 'sub_type', 'description'];

    public function application()
    {
        return $this->belongsTo(Application::class, 'app_code', 'app_code');
    }

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
