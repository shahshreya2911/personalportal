<?php
/**
 * Model generated using LaraAdmin
 * Help: http://laraadmin.com
 */

namespace Vanguard\Models;

use Illuminate\Database\Eloquent\Model;
//use Illuminate\Database\Eloquent\SoftDeletes;

class Jobattributes extends Model
{
  //  use SoftDeletes;
	
	protected $table = 'jobattributes';
		protected $fillable = ['attribute', 'attr_desc','attr_remarks'];
	

}
