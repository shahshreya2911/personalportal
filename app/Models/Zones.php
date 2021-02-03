<?php
/**
 * Model generated using LaraAdmin
 * Help: http://laraadmin.com
 */

namespace Vanguard\Models;

use Illuminate\Database\Eloquent\Model;
//use Illuminate\Database\Eloquent\SoftDeletes;

class Zones extends Model
{
  //  use SoftDeletes;
	
	protected $table = 'zones';
		protected $fillable = ['warehouse', 'room', 'shelf'];
	

}
