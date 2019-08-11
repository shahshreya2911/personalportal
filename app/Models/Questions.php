<?php
/**
 * Model generated using LaraAdmin
 * Help: http://laraadmin.com
 */

namespace Vanguard\Models;

use Illuminate\Database\Eloquent\Model;
//use Illuminate\Database\Eloquent\SoftDeletes;

class Questions extends Model
{
  //  use SoftDeletes;
	
	protected $table = 'questions';
	protected $fillable = ['level', 'sentence', 'active'];
	
}
