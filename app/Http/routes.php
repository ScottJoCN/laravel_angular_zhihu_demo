<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
function rq($key = null,$default = null){
	if(!$key) return Request::all();
	return Request::get($key,$default);
}
function user_ins(){
	return new App\User;
}
function question_ins(){
	return new App\Question;
}
function answer_ins(){
	return new App\Answer;
}
function comment_ins(){
	return new App\Comment;
}
function paginate($page=1,$limit=15){
	$limit = $limit ?: 15;
	$skip = (($page ?:1) -1) * $limit;
	return [$limit,$skip];
}
function err($msg = null ){
	return ['status' =>0 , 'msg' =>$msg];
}
function suc($data_to_merge = []){
	$data = ['status' =>1 ,'data' =>[] ];
	if($data_to_merge)
		$data['data'] = array_merge($data['data'],$data_to_merge);
	return $data;
}
function is_logged_in(){
    // 如果session中存在user_id就返回user_id，否则返回false
    // dd(session()->all());
    return session('user_id') ? : false;
}
// -----------------------------------------
Route::get('/', function () {
    return view('index');
})->middleware('web2');

Route::any('api',function(){
	return 'abc';
	return ['version' => 0.1];
});

Route::any('api/signup',function(){
	// $user = new App\User;
	return user_ins()->signup();
});
Route::any('api/login',function(){
	// $user = new App\User;
	return user_ins()->login();
})->middleware('web2');
Route::any('api/logout',function(){
	// $user = new App\User;
	return user_ins()->logout();
})->middleware('web2');


Route::any('api/user/change_password',function(){
	// $user = new App\User;
	return user_ins()->change_password();
})->middleware('web2');
Route::any('api/user/reset_password',function(){
	// $user = new App\User;
	return user_ins()->reset_password();
})->middleware('web2');

Route::any('api/user/validate_reset_psw',function(){
	// $user = new App\User;
	return user_ins()->validate_reset_psw();
})->middleware('web2');
Route::any('api/user/read',function(){
	// $user = new App\User;
	return user_ins()->read();
})->middleware('web2');
Route::any('api/user/exists',function(){
	// $user = new App\User;
	return user_ins()->exists();
});

// -----------------------------------------
Route::any('test',function(){
	dd(user_ins()->is_logged_in());
})->middleware('web');



// -----------------------------------------
Route::any('api/question/add',function(){
	// $user = new App\User;
	return question_ins()->add();
})->middleware('web2');

Route::any('api/question/change',function(){
	// $user = new App\User;
	return question_ins()->change();
})->middleware('web2');

Route::any('api/question/read',function(){
	// $user = new App\User;
	return question_ins()->read();
})->middleware('web2');
Route::any('api/question/del',function(){
	// $user = new App\User;
	return question_ins()->del();
})->middleware('web2');

// -----------------------------------------
Route::any('api/answer/add',function(){
	// $user = new App\User;
	return answer_ins()->add();
})->middleware('web2');
Route::any('api/answer/change',function(){
	// $user = new App\User;
	return answer_ins()->change();
})->middleware('web2');
Route::any('api/answer/read',function(){
	// $user = new App\User;
	return answer_ins()->read();
})->middleware('web2');
Route::any('api/answer/vote',function(){
	// $user = new App\User;
	return answer_ins()->vote();
})->middleware('web2');
// -----------------------------------------
Route::any('api/comment/add',function(){
	// $user = new App\User;
	return comment_ins()->add();
})->middleware('web2');
Route::any('api/comment/read',function(){
	// $user = new App\User;
	return comment_ins()->read();
})->middleware('web2');

Route::any('api/comment/del',function(){
	// $user = new App\User;
	return comment_ins()->del();
})->middleware('web2');
// -----------------------------------------
Route::any('api/timeline','CommonController@timeline')->middleware('web');
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function () {
    //
});
