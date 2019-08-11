<?php
/**
 * Model generated using LaraAdmin
 * Help: http://laraadmin.com
 */

namespace Vanguard\Models;

use Illuminate\Database\Eloquent\Model;
//use Illuminate\Database\Eloquent\SoftDeletes;

class UserQuestionAnwser extends Model
{
  //  use SoftDeletes;
	
	protected $table = 'user_question_anwser';
	
	public function category()
    {
        return $this->belongsTo(Categories::class, 'category_id', 'id');
    }
}
