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
	
	
	const CATEGORY_1 = 'Basic Vocabulary';
	const CATEGORY_2 = 'Literacy Reading Comprehension';
	const CATEGORY_3 = 'Adult Numeracy';
	
	public function category()
    {
        return $this->hasMany(Categories::class, 'category_id', 'id');
    }
}
