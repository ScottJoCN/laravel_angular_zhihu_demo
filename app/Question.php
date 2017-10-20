<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;

class Question extends Model
{
    public function add(){
    	// dd(rq());
    	// 检查用户是否登录
    	if(!user_ins()->is_logged_in())
    		return ['status'=>0 ,'msg' => 'not yet login'];
    	// 检查是否提交title
    	if(!rq('title'))
    		return ['status' => 0,'msg' => 'required title'];

    	$this->title = rq('title');
    	$this->user_id = session('user_id');
    	// 检查是否有desc，有则保存
    	if(rq('desc'))
    		$this->desc = rq('desc');
    	// 返回插入信息，保存成功返回状态1，失败返回0
    	return $this->save() ? ['status'=>1,'id'=>$this->id] : ['status'=>'0','msg'=>'db insert failed'];
    }
    public function change(){
    	// 检查是否登录
    	if(!user_ins()->is_logged_in())
    		return ['status'=>0 ,'msg' => 'not yet login'];
    	// 检查传参中是否有id
    	if(!rq('id'))
    		return ['status'=>0 ,'msg' => 'id is required'];

    	// 获取指定id的model
    	$question = $this->find(rq('id'));
    	// 判断用户是否存在
    	if(!$question)
    		return ['status'=>0 ,'msg' => 'question not found'];
    	// dd(session('user_id'));
    	// 
    	if($question->user_id != session('user_id'))
    		return ['status'=>0 ,'msg' => 'permission denied'];
    	if(rq('title'))
    		$question->title = rq('title');
    	if(rq('desc'))
    		$question->desc = rq('desc');

    	// 保存数据
    	return $question->save() ? ['status'=>1] : ['status'=>'0','msg'=>'db update failed'];

    }
    public function read(){
    	// 请求参数中是否有id 如果有id直接返回id所在行
    	if(rq('id'))
    		return ['status'=>1 ,'data' => $this->find(rq('id'))];
    	// limit条件
    	// $limit = rq('limit')?:15;
    	// 分页
    	// $skip = ((rq('page') ?:1) -1) * $limit;
    	// =
    	// $skip = (rq('page') ? rq('page') -1:0) * $limit;
    	// 构建query并返回collection数据 一个对象
    	// 
    	list($limit,$skip) = paginate(rq('page'),rq('limit'));

    	$r = $this
    	->orderBy('created_at')
    	->limit($limit)
    	->skip($skip)
    	->get(['id','title','desc','user_id','created_at','updated_at'])
    	->keyBy('id');
    	return ['status'=> 1 , 'data' =>$r];
    }
    // 删除问题api
    public function del(){
    	// 用户是否登录
    	if(!user_ins()->is_logged_in())
    		return ['status'=>0 ,'msg' => 'not yet login'];
    	// 传参中是否有id
    	if(!rq('id'))
    		return ['status'=>0 ,'msg' => 'id is required'];
    	// 获取传参id所对应的model
    	$question = $this->find(rq('id'));
    	if(!$question) return ['status'=>0 ,'msg' => 'question not exists'];
    	// 检查当前用户是否为问题所有者
    	if(session('user_id')!=$question->user_id)
    		return ['status'=>0 ,'msg' => 'permission denied'];
    	// 删除
    	return $question->delete() ? ['status'=>1]:['status'=>0 ,'msg' => 'db delete failed'];
    }
    public function user(){
        return $this->belongsTo('App\User');
    }    
}
