<?php
/**
 * Model generated using LaraAdmin
 * Help: http://laraadmin.com
 */

namespace Vanguard\Models;

use Illuminate\Database\Eloquent\Model;
//use Illuminate\Database\Eloquent\SoftDeletes;

class Jobs extends Model
{
  //  use SoftDeletes;
	
	protected $table = 'jobs';
		protected $fillable = ['name', 'jobnum','starting_date','end_date', 'location', 'description', 'note'];
	

}
