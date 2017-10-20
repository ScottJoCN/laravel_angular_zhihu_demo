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
