<!DOCTYPE html>
<html lang="zh" ng-app="xiaohu">
<head>
	<meta charset="UTF-8">
	<title>laravel2</title>
	<link rel="stylesheet" href="/node_modules/normalize-css/normalize.css">
	<link rel="stylesheet" href="/css/base.css">
	<script src='/node_modules/jquery/dist/jquery.js'></script>
	<script src='/node_modules/angular/angular.js'></script>
	<script src='/node_modules/angular-ui-router/release/angular-ui-router.js'></script>
	<script src='/js/base.js'></script>
	
</head>
<body>
	{{-- <div ng-controller="ParentController">
		<div ng-controller="TestController">name: [: name :] age:[: age:]</div>
		<div>name: [: name :] age:[: age :]</div>
	</div> --}}
	<div class="navbar clearfix">
		<div class="container">
			{{-- <a href="" ui-sref="home">首页</a>
			<a href="" ui-sref="login">登录</a> --}}
			<div class="fl">
				<div class="navbar-item brand">晓乎</div>
				<form id="quick_ask" 
				ng-controller="QuestionAddController" 
				ng-submit="Question.go_add_question()">
					<div class="navbar-item">
						<input type="text" ng-model="Question.new_question.title">
					</div>
					<div class="navbar-item"><button type="submit">提问</button></div>
				</form>
				</div>
				{{-- <div class="navbar-item"><input type="submit" value="提问"></div> --}}
			</div>

			<div class="fr">
				<a class="navbar-item" ui-sref="home">首页</a>
				@if(is_logged_in())
					<a class="navbar-item">{{ session('username') }}</a>
					<a class="navbar-item" href="{{ url('/api/logout') }}">退出</a>
				@else
					<a class="navbar-item" ui-sref="login">登录</a>
					<a class="navbar-item" ui-sref="signup">注册</a>

				@endif
			</div>
		</div>
	</div>

	<div class="page">
		<div ui-view></div>
	</div>


	{{-- .page .home --}}
<script type="text/ng-template" id="home.tpl">
<div class="home container card" ng-controller="HomeController">
	<h1>最新动态</h1>
	<div class="hr"></div>
	<div class="item-set">

		<div class="item">
			<div class="vote"></div>
			<div class="feed-item-content">
				<div class="content-act">xxx赞同了该回答</div>
				<div class="title">如何评价 9 月 13 日发布的 iPhone X？</div>
				<div class="content-owner">尹鹿鸣 <span class="desc">Swift, Objective-C 和网页开发者。</span></div>
				<div class="content-main">
					两天前看到路透社的消息说「 iPhone 8的热度比起iPhone 6首发时的热议度相去甚远」，结果马上就打脸了，发布会当天，关键词 "iPhone" 的微博热度攀升到一年来的最高峰。两天前看到路透社的消息说「 iPhone 8的热度比起 iPhone 6首发时的热议度相去甚远」，结果马上就打脸了，发布会当天，关键词 "iPhone" 的微博热度攀升到一年来的最高峰。两天前看到路透社的消息说「 iPhone 8的热度比起iPhone 6首发时的热议度相去甚远」，结果马上就打脸了，发布会当天，关键词 "iPhone" 的微博热度攀升到一年来的最高峰。
				</div>
				<div class="action-set">
					<div class="comment">评论</div>
				</div>
				<div class="comment-block">
					<div class="hr"></div>
					<div class="comment-item-set">
						<div class="comment-item clearfix">
							<div class="user">随旧岁</div>
							<div class="comment-content">
								这个剧长存笔记本，看了n多遍这个剧长存笔记本，看了n多遍这个剧长存笔记本，看了n多遍这个剧长存笔记本，看了n多遍这个剧长存笔记本，看了n多遍这个剧长存笔记本，看了n多遍这个剧长存笔记本，看了n多遍这个剧长存笔记本，看了n多遍这个剧长存笔记本，看了n多遍
							</div>
						</div>
						
						<div class="comment-item clearfix">
							<div class="user">随旧岁</div>
							<div class="comment-content">
								这个剧长存笔记本，看了n多遍这个剧长存笔记本，看了n多遍这个剧长存笔记本，看了n多遍这个剧长存笔记本，看了n多遍这个剧长存笔记本，看了n多遍这个剧长存笔记本，看了n多遍这个剧长存笔记本，看了n多遍这个剧长存笔记本，看了n多遍这个剧长存笔记本，看了n多遍
							</div>
						</div>	
											
						<div class="comment-item clearfix">
							<div class="user">随旧岁</div>
							<div class="comment-content">
								这个剧长存笔记本，看了n多遍这个剧长存笔记本，看了n多遍这个剧长存笔记本，看了n多遍这个剧长存笔记本，看了n多遍这个剧长存笔记本，看了n多遍这个剧长存笔记本，看了n多遍这个剧长存笔记本，看了n多遍这个剧长存笔记本，看了n多遍这个剧长存笔记本，看了n多遍
							</div>
							
						</div>
											
					</div>
				</div>
			</div>
		</div>
		<div class="item"></div>
		<div class="item"></div>
	</div>
	
</div>
	{{-- <div>
		<h1>首页</h1>
		<div>首页首页首页首页首页首页首页首页</div>
	</div> --}}
</script>

<script type="text/ng-template" id="login.tpl">
	<div class="login container" ng-controller="LoginController">
	<div class="card">
			<h1>登录</h1>
			{{-- [: User.signup_data :] --}}
			<form ng-submit="User.login()" name="login_form">
			<div class="input-group">
				<label>用户名</label>
				<input 
					type="text" 
					ng-model="User.login_data.username" 
					name="username"
					{{-- ng-model-options="{updateOn:'blur'}" --}}
					ng-model-options="{debounce:500}"
					required >
					<div class="input-error-set" ng-if="signup_form.username.$touched">
					{{--  form表单下username报错，错误类型为数据为空--}}
						<div ng-if="signup_form.username.$error.required">用户名为必填项</div>
						
					</div>
			</div>
			<div class="input-group">
				<label>密码</label>
				<input 
					type="password" 
					ng-model="User.login_data.password" 
					name="password"
					required 
					>
{{-- 					<div class="input-error-set" ng-if="signup_form.password.$touched">
						
					</div>	 --}}				
			</div>
			<div class="input-error-set" ng-if="User.login_failed">
				用户名或密码不正确
			</div>
				<button type="submit" 
				ng-disabled="login_form.username.$error.required ||
				login_form.password.$error.required" 
				class="primary">登录</button>
			</form>
		</div>
</div>
</script>

<script type="text/ng-template" id="signup.tpl" >
	<div ng-controller="SignupController" class="signup container" >
		<div class="card">
			<h1>注册</h1>
			{{-- [: User.signup_data :] --}}
			<form ng-submit="User.signup()" name="signup_form">
			<div class="input-group">
				<label>用户名</label>
				<input 
					type="text" 
					ng-model="User.signup_data.username" 
					ng-minlength="4"
					ng-maxlength="24"
					name="username"
					{{-- ng-model-options="{updateOn:'blur'}" --}}
					ng-model-options="{debounce:500}"
					required >
					<div class="input-error-set" ng-if="signup_form.username.$touched">
					{{--  form表单下username报错，错误类型为数据为空--}}
						<div ng-if="signup_form.username.$error.required">用户名为必填项</div>
						<div ng-if="signup_form.username.$error.maxlength || signup_form.username.$error.minlength">用户名长度需在4-24之间</div>
						<div ng-if="User.signup_username_exists">用户名已存在</div>
					</div>
			</div>
			<div class="input-group">
				<label>密码</label>
				<input 
					type="password" 
					ng-model="User.signup_data.password" 
					ng-minlength="6"
					ng-maxlength="255"
					required 
					name="password">
					<div class="input-error-set" ng-if="signup_form.password.$touched">
						<div ng-if="signup_form.password.$error.required">密码为必填项</div>

						<div ng-if="signup_form.password.$error.maxlength || signup_form.password.$error.minlength">密码长度需大于6位</div>
					</div>					
			</div>			
				<button type="submit" ng-disabled="signup_form.$invalid" class="primary">注册</button>
			</form>
		</div>
	</div>
</script>
<script type="text/ng-template" id="question.add.tpl">

	<div ng-controller="QuestionAddController" class="question-add container">
		<div class="card">
			<form ng-submit="Question.add()" name="question_add_form">
				<div class="input-group">
					<label>问题标题</label>
					<input type="text" 
					name="title" 
					ng-model="Question.new_question.title"
					ng-minlength="5"
					ng-maxlength="255"
					required>
					</div>
				<div class="input-group">
					<label>问题描述</label>
						<textarea 
						name="desc" 
						ng-model="Question.new_question.desc">
						</textarea>
					</div>
				
				
					<button type="submit" 
					class="primary" 
					ng-disabled="question_add_form.$invalid">提问</button>
				</div>
			</form>
		</div>
	</div>
</script>
</body>
</html>