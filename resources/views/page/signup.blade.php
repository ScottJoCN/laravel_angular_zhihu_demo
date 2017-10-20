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
