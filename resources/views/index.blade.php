<!DOCTYPE html>
<html lang="zh" ng-app="xiaohu" user-id= "{{ session('user_id') }}">
<head>
	<meta charset="UTF-8">
	<title>laravel</title>
	<link rel="stylesheet" href="/node_modules/normalize-css/normalize.css">
	<link rel="stylesheet" href="/css/base.css">
	<script src='/node_modules/jquery/dist/jquery.js'></script>
	<script src='/node_modules/angular/angular.js'></script>
	<script src='/node_modules/angular-ui-router/release/angular-ui-router.js'></script>
	<script src='/js/base.js'></script>
	<script src='/js/common.js'></script>
	<script src='/js/answer.js'></script>
	<script src='/js/user.js'></script>
	<script src='/js/question.js'></script>
	
	
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
				<div class="navbar-item brand" ui-sref="home">晓乎</div>
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
{{-- <script type="text/ng-template" id="home.tpl">

	
</script>

<script type="text/ng-template" id="login.tpl">
	
</script>

<script type="text/ng-template" id="signup.tpl" >
	
</script>
<script type="text/ng-template" id="question.add.tpl">


</script> --}}
</body>
</html>