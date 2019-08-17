<?php
/**
 * Model generated using LaraAdmin
 * Help: http://laraadmin.com
 */

namespace Vanguard\Models;

use Illuminate\Database\Eloquent\Model;
//use Illuminate\Database\Eloquent\SoftDeletes;

class ParentCategory extends Model
{
  //  use SoftDeletes;
	
	protected $table = 'parent_category';
	
	
	public function category()
    {
        return $this->hasMany(Categories::class, 'category_id', 'id');
    }
}
