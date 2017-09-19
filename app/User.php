<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;
use Request;
use Hash;

class User extends Model
{
    // 注册api
    public function signup(){
        // return 'signup';
        // 将用户提交的数据打印
        // Request::has()检查用户是否有提交该数据，有返回true，没返回false
        // dd(Request::has('username'));
        // 找Request::get()检查是否有所查键，无返回null，有返回键值
        // dd(Request::get('username'));
        // dd(Request::all());
        // $username = Request::get('username');
        // $password = Request::get('psw');
        // 检查用户名和密码是否为空
        
        // if(!$username || !$password)
        $has_username_and_psw = $this->has_username_and_psw();
        if(!$has_username_and_psw)
        // if(!$this->has_username_and_psw())
            return err('username or password are not null');
            // return ['status'=>0,'msg'=>'username or password are not null'];
        $username = $has_username_and_psw[0];
        $password = $has_username_and_psw[1];
        // 检查用户名是否存在
        $user_exists = $this->where('username',$username)->exists();
        if($user_exists)
            return err('username is not exists');
            // return ['status'=>0 , 'msg'=>'username is not exists'];
        // 加密密码
        $hashed_psw = Hash::make($password);
        // =
        // $hashed_psw = bcrypt($password);
        // dd($hashed_psw);
        // 存入数据库
        $user = $this;
        $user->password = $hashed_psw;
        $user->username = $username;
        // $user->save();
        if($user->save()){
            return suc(['id'=>$user->id]);
            // return ['status'=>1, 'id'=>$user->id];
        }else{
            return err('save failed!');
            // return ['status'=>0,'msg'=>'save failed!'];
        }
    }
    // 登录api
    public function login(){
        // 检查用户名 密码是否存在
        
        $has_username_and_psw = $this->has_username_and_psw();
        if(!$has_username_and_psw)
            return err('username or password are not null');
            // return ['status'=>0,'msg'=>'username or password are not null']; 
        $username = $has_username_and_psw[0];
        $password = $has_username_and_psw[1];
        // 检查用户是否存在
        $user = $this->where('username',$username)->first();
        if(!$user)
            return err('user is not exists!');
            // return ['status'=> 0 , 'msg' => 'user is not exists!'];
        // 检查密码是否正确
        $hashed_psw = $user->password;
        if(!Hash::check($password,$hashed_psw))
            return err('password is false');
            // return ['status'=>0 , 'msg' => 'password is false'];
        // return 1;
        // session所有信息
        // 将用户信息写入session
        session()->put('username',$user->username);
        session()->put('user_id',$user->id);
        // Session::save();
        // dd(session()->all());
        // return ['status'=>1,'id'=>$user->id];
        return suc(['id'=>$user->id]);
        
    }
    // 登出api
    public function logout(){
        // session - set
        // session()->set('person.name','xiaoming');
        // session()->set('person.friend.han.age','20');
        // dd(session()->all());

        // 删除所有session
        session()->flush();
        // 或者
        // session()->forget('username');
        // session()->forget('user_id');
        // return redirect('/');
        // return ['status' => 1];
        // dd(session()->all());
    }
    // 检查用户是否登录
    public function is_logged_in(){
        // 如果session中存在user_id就返回user_id，否则返回false
        // dd(session()->all());
        // return session('user_id') ? : false;
        return is_logged_in();
    }
    public function has_username_and_psw(){
        $username = rq('username');
        $password = rq('password');
        // 检查用户名和密码是否为空
        // if(!$username || !$password)
        if($username && $password)
            return [$username,$password];
        return false;
    }
    public function answers(){
        return $this
        ->belongsToMany('App\Answer')
        ->withPivot('vote')
        ->withTimestamps();
    } 
    public function questions(){
        return $this
        ->belongsToMany('App\Question')
        ->withPivot('vote')
        ->withTimestamps();
    }         
    // 获取用户信息api
    public function read(){
        if(!rq('id'))
            return err('required id');
        $get = ['id','username','avatar_url','intro'];
        // $this->get($get); 获得全部
        $user = $this -> find(rq('id'),$get);
        $data = $user->toArray();

        // $answer_count = $user->answers()->count();
        // $question_count = $user->questions()->count();
        $answer_count = answer_ins()->where('user_id',rq('id'))->count();
        $question_count = answer_ins()->where('user_id',rq('id'))->count();
        $data['answer_count'] = $answer_count;
        $data['question_count'] = $question_count;

        return suc($data);


        dd($answer_count,$question_count);
    }
    // 修改密码api
    public function change_password(){
        if(!user_ins()->is_logged_in())
            return err('not yet login');
            // return ['status'=>0 ,'msg' => 'not yet login'];
        
        if(!rq('old_psw') || !rq('new_psw')){
            return err('old_psw or new_psw is required');
            // return ['status'=>0 ,'msg' => 'old_psw or new_psw is required'];
        }
        $user = $this->find(session('user_id'));
        
        if(!Hash::check(rq('old_psw'),$user->password)){
            return err('invalid old_psw');
            // return ['status'=>0 ,'msg' => 'invalid old_psw'];
        }

        $user->password = bcrypt(rq('new_psw'));
        // if($user->save()){

        // }
        return $user->save() ? suc() : 
        err('db updata failed');
        // ['status'=>0 ,'msg' => 'db updata failed'];
    }
    // 找回密码
    public function reset_password(){
       

        if($this->is_robot())
            return err('max frequency reached');

        if(!rq('phone'))
            return err('phone is required');

        $user = $this->where('phone',rq('phone'))->first();

        // $exists = $user->exists();

        if(!$user)
            return err('valid phone number');

        // 生成验证码
        $captcha = $this->generate_captcha();

        $this->send_sms();

        $user->phone_captcha = $captcha;

        if($user->save()){
            // 如果验证码保存成功，发送验证码短信
            $this->send_sms();
            // 为下一次机器检查做准备
            $this->updata_robot_time();
            return suc();
        }
        return error('rand number generate error');
        // return $user->save() ? suc():error('rand number generate error');
    }

    // 验证找回密码api
    public function validate_reset_psw(){
        

        if($this->is_robot(2))
            return err('max frequency reached');

        if(!rq('phone') || !rq('phone_captcha') || !rq('new_psw'))
            return err('phone ,new_psw or phone_captcha are required');

        // 检查用户是否存在
        $user = $this->where([
            'phone'=>rq('phone'),
            'phone_captcha'=>rq('phone_captcha')
            ])->first();
        if(!$user)
            return err('invalid phone or invalid phone_captcha');
        
        // 加密新密码
        $user->password = bcrypt('new_psw');
        $this->updata_robot_time();
        return $user->save()?
            suc() : err('db updata failed');
    }
    // 生成验证码
    public function generate_captcha(){
        return rand(1000,9999);
    }
    public function send_sms(){
        return true;
    }
    // 判断是否是机器人
    public function is_robot($time = 10){
        // 如果session中没有last_sms_time 说明接口从来没调用过
        if(!session('last_active_time'))
            return false;

        $current_time = time();
        $last_active_time = session('last_active_time');
        $elapsed = $current_time- $last_active_time;
        // dd($elapsed);
        return !($elapsed >$time);
                   
    }
    // 更新机器人行为时间
    public function updata_robot_time(){
        session()->set('last_active_time',time());
    }

    public function exists(){
        return suc(['count' => $this->where(rq())->count()]);
    }
}



