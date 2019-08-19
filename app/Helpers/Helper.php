<?php

namespace Vanguard\Helpers;

use Vanguard\Models\Categories;
use Vanguard\Models\UserQuestionAnwser;
use Vanguard\Models\Questions;
use Auth;
use Vanguard\Models\ParentCategory;

class Helper
{
	public static function examLevel($categoryId, $i = '') {
		
		$questions = Questions::where('parent_category_id', $categoryId)->count();
		$userQuestionAnwser = UserQuestionAnwser::where('parent_category_id', $categoryId)->where('user_id', Auth::user()->id)->count();
		
		
		//dump($questions);
		//dump($userQuestionAnwser);exit;
			
		if ($userQuestionAnwser <= 0 && $i == 0) {
			return '2';
		}
		
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
	
	public static function userAllScore() {
		
		$parentCategory = ParentCategory::get();
		
		$questionsCount = 0;
		foreach ($parentCategory as $pCategory) {
			
			$questionsCount += UserQuestionAnwser::where('parent_category_id', $pCategory->id)
			->where('user_id', Auth::user()->id)
			->where('status', '1')
			->count();
		}

		return $questionsCount;	
	}
	
	public static function userCategoryScore($categoryId) {
		
		
			
			return UserQuestionAnwser::where('parent_category_id', $categoryId)
			->where('user_id', Auth::user()->id)
			->where('status', '1')
			->count();
		
	}
	
	public static function allQuestions() {
		
		$parentCategory = ParentCategory::get();
		
		$questionsCount = 0;
		foreach ($parentCategory as $pCategory) {
			
			$questionsCount += Questions::where('parent_category_id', $pCategory->id)->count();
		}

		return $questionsCount;	
	}
	
	public static function correctAnswer($categoryId, $i = ''){
		$usertrueAnwser = UserQuestionAnwser::where('parent_category_id', $categoryId)->where('user_id', Auth::user()->id)->where('status', 1)->count();
		return $usertrueAnwser;
	}
}
