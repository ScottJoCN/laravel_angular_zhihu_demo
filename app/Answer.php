<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
	// 添加问题api
	public function add(){
		// 检查用户是否登录
		if(!user_ins()->is_logged_in())
			return ['status'=>0 ,'msg' => 'not yet login'];
		// return 1;
		// 检查参数中是否存在quesiton_id 和content
		if(!rq('question_id') || !rq('content'))
			return ['status'=>0 ,'msg' => 'question_id and content are required'];
		// 检查问题是否存在
		$question = question_ins()->find(rq('question_id'));
		// dd(question_ins());0
		
		if(!$question) return ['status'=>0 ,'msg' => 'question not exists'];

		// 检查是否重复回答
		$answer = $this
		->where(['question_id'=>rq('question_id'),'user_id'=>session('user_id')])
		->count();
		if($answer) return ['status'=>0 ,'msg' => 'duplicate answers'];

		$this->content = rq('content');
		$this->question_id = rq('question_id');
		$this->user_id = session('user_id');
		// 保存数据
		return $this->save() ?
			['status'=>1 ,'id' => $this->id ] :
			['status'=>0 ,'msg' => 'db insert failed'];
	}
	// 更新回答api
	public function change(){
		if(!user_ins()->is_logged_in())
			return ['status'=>0 ,'msg' => 'not yet login'];
		if(!rq('id') || !rq('content'))
			return ['status'=>0 ,'msg' => 'id and content are required'];

		$answer = $this->find(rq('id'));
		if($answer->user_id != session('user_id'))
			return ['status'=>0 ,'msg' => 'permission denied'];

		$answer->content = rq('content');
		return $answer->save() ?
			['status'=>1] :
			['status'=>0 ,'msg' => 'db insert failed'];


	}
	// 查看回答api
	public function read(){
		if(!rq('id') && !rq('question_id'))
			return ['status'=>0 ,'msg' => 'id or question_id is required'];

		if(rq('id')){
			// 单个问题回答
			$answer = $this
			->with('user')
			->with('users')
			->find(rq('id'));
			if(!$answer)
				return ['status'=>0 ,'msg' => 'answer not exists'];
			return ['status'=>1 ,'data' => $answer];
		}
		// 在查看回答前，查看问题是否存在
		if(!question_ins()->find(rq('question_id')))
			return ['status'=>0 ,'msg' => 'question not exists'];
		// 查看同一问题下所有回答
		$answers =$this->where('question_id',rq('question_id'))->get()->keyBy('id');

		return ['status'=>1 ,'data' => $answers];
	}
	// 投票api
	public function vote(){
		if(!user_ins()->is_logged_in())
			return ['status'=>0 ,'msg' => 'not yet login'];
		
		if(!rq('id') || !rq('vote'))
			return ['status'=>0 ,'msg' => 'id and vote are required'];

		$answer = $this -> find(rq('id'));
		if(!$answer)
			return ['status'=>0 ,'msg' => 'answer not exists'];

		// 1为赞同票，2反对 3清空
		// $vote = rq('vote') <= 1 ? 1:2;
		$vote = rq('vote');
		if($vote != 1&& $vote !=2 && $vote !=3){
			return ['status' =>0, 'msg'=>'invalid vote'];
		}
		// 检查此用户是否在相同问题下投过票，如果投过票，删除投票结果
		$vote_ins = $answer
		->users()
		->newPivotStatement()
		->where('user_id',session('user_id'))
		->where('answer_id',rq('id'))
		->delete();

		if($vote ==3)
			return ['status' =>1 ];
		// 在连接表中增加数据
		$answer->users()->attach(session('user_id'),['vote' => $vote]);
		return ['status'=>1];

	}
	public function user(){
		return $this->belongsTo('App\User');
	}
	public function users(){
		return $this
		->belongsToMany('App\User')
		->withPivot('vote')
		->withTimestamps();
	}
}
