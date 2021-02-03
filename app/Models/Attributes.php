<?php
/**
 * Model generated using LaraAdmin
 * Help: http://laraadmin.com
 */

namespace Vanguard\Models;

use Illuminate\Database\Eloquent\Model;
//use Illuminate\Database\Eloquent\SoftDeletes;

class Attributes extends Model
{
  //  use SoftDeletes;
	
	protected $table = 'attributes';
	protected $fillable = [ 'product_id','name', 'description'];
	
	public function attributes()
    {
        return $this->belongsTo(Products::class, 'product_id', 'id');
    }
	
}
