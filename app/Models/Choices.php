<?php
/**
 * Model generated using LaraAdmin
 * Help: http://laraadmin.com
 */

namespace Vanguard\Models;

use Illuminate\Database\Eloquent\Model;
//use Illuminate\Database\Eloquent\SoftDeletes;

class Choices extends Model
{
  //  use SoftDeletes;
	
	protected $table = 'questionchoices';
	protected $fillable = ['fk_question_id', 'is_correct', 'answer','active'];
	
}
