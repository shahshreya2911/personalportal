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
	protected $fillable = ['parent_category_id', 'level', 'sentence', 'active'];
	
	public function answer() {
		return $this->hasMany(QuestionChoices::class, 'fk_question_id', 'id');
	}
	
}
