<?php

namespace Vanguard\Helpers;
use Auth;
use Vanguard\Models\Categories;
use Vanguard\Models\UserQuestionAnwser;
use Vanguard\Models\Questions;

class Helper
{
	public static function examLevel($categoryId, $i = '') {
		
		$questions = Questions::where('level', $categoryId)->count();
		$userQuestionAnwser = UserQuestionAnwser::where('category_id', $categoryId)->where('user_id', Auth::user()->id)->count();
		
		
		if ($userQuestionAnwser <= 0 && $i == 0) {
			return '2';
		}
		
		//dump($questions);
		//dump($userQuestionAnwser);exit;
		
		if ($questions != $userQuestionAnwser && $userQuestionAnwser !='0') {
			return 3;	
		} elseif($questions == $userQuestionAnwser) {
			return 4;
		} elseif(($questions - $userQuestionAnwser) == $questions && $userQuestionAnwser =='0') {
			return 2;	
		}elseif ($userQuestionAnwser =='0') {
			return 5;
		}
	}	
	
}
 