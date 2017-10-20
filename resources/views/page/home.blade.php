<div class="home container card" ng-controller="HomeController">
	<h1>最新动态</h1>
	<div class="hr"></div>
	<div class="item-set ">
		{{-- ng-repeat = foreach --}}
		{{-- item start --}}
		<div class="feed item clearfix" ng-repeat="item in Timeline.data">
			<div class="vote" ng-if="item.question_id">
				<div class="up" 
				ng-click="Timeline.vote({id: item.id ,vote:1})">赞 [: item.upvote_count :]</div>
				<div class="down" 
				ng-click="Timeline.vote({id: item.id ,vote:2})">踩 [: item.downvote_count :]</div>
			</div>
			<div class="feed-item-content">
				<div class="content-act" ng-if="item.question_id">[:item.user.username:] 添加了回答</div>
				<div class="content-act" ng-if="!item.question_id">[:item.user.username:] 添加了提问</div>
				<div class="title">[: item.title :]</div>
				<div class="content-owner">[:item.user.username:] <span class="desc"> Swift, Objective-C 和网页开发者。</span></div>
				<div class="content-main">
					[: item.content :]
				</div>
				<div class="action-set">
					<div class="comment">评论</div>
				</div>
				<div class="comment-block" style="display: none;">
					<div class="hr"></div>
					<div class="comment-item-set">
						{{-- 评论 --}}
						<div class="comment-item clearfix">
							<div class="user">随旧岁</div>
							<div class="comment-content">
								这个剧长存笔记本，看了n多遍这个剧长存笔记本，看了n多遍这个剧长存笔记本，看了n多遍这个剧长存笔记本，看了n多遍这个剧长存笔记本，看了n多遍这个剧长存笔记本，看了n多遍这个剧长存笔记本，看了n多遍这个剧长存笔记本，看了n多遍这个剧长存笔记本，看了n多遍
							</div>
						</div>
						{{-- 评论 --}}
					</div>
				</div>
			</div>
			<div class="hr"></div>
		</div>{{-- item end --}}
		
	</div> {{-- item-set end --}}
	<div class="tac" ng-if="Timeline.pending">加载中……</div>
	<div class="tac" ng-if="Timeline.no_more_data">没有更多数据</div>
</div>