<?php
/**
 * Model generated using LaraAdmin
 * Help: http://laraadmin.com
 */

namespace Vanguard\Models;

use Illuminate\Database\Eloquent\Model;
//use Illuminate\Database\Eloquent\SoftDeletes;

class Stockins extends Model
{
  //  use SoftDeletes;
	
	protected $table = 'stockin';
		protected $fillable = ['stockin_date', 'job_id','reason_id','note'];
	

}
