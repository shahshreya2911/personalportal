<?php
/**
 * Model generated using LaraAdmin
 * Help: http://laraadmin.com
 */

namespace Vanguard\Models;

use Illuminate\Database\Eloquent\Model;
//use Illuminate\Database\Eloquent\SoftDeletes;

class Stockouts extends Model
{
  //  use SoftDeletes;
	
	protected $table = 'stockout';
		protected $fillable = ['stockout_date', 'job_id','reason_id','note'];
	

}
