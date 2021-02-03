<?php
/**
 * Model generated using LaraAdmin
 * Help: http://laraadmin.com
 */

namespace Vanguard\Models;

use Illuminate\Database\Eloquent\Model;
//use Illuminate\Database\Eloquent\SoftDeletes;

class Products extends Model
{
  //  use SoftDeletes;
	
	protected $table = 'products';
		protected $fillable = ['productname', 'brandname', 'notes'];
	

}
