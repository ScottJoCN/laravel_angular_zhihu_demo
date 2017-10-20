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