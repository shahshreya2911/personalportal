<?php
/**
 * Model generated using LaraAdmin
 * Help: http://laraadmin.com
 */

namespace Vanguard\Models;

use Illuminate\Database\Eloquent\Model;
//use Illuminate\Database\Eloquent\SoftDeletes;

class Categories extends Model
{
  //  use SoftDeletes;
	
	protected $table = 'categories';
	
	public function parentCategory()
    {
        return $this->belongsTo(ParentCategory::class, 'category_id', 'id');
    }
	
	
}
