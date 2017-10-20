;(function(){
	'use strict';
	angular.module('answer',[])
	.service('AnswerService', ['$http', function($http){
		var me = this;
		me.data = {};
		/*统计票数
		*@answers array 用于统计票数的数据
		*此数据可以是问题 也可以是回答
		*如果是问题 将会跳过统计
		 */
		me.count_vote = function(answers){
			/*迭代所有数据*/
			for(var i =0;i<answers.length;i++){
				// 封装单个数据
				var votes,item = answers[i];
				// 如果不能回答也没有users元素 说明本条不是回答 或回答没有任何票数
				if(!item['question_id'] ) 
					continue;
				me.data[item.id] = item;

				if(!item['users'])
					continue;

				// users是所有投票用户的用户信息
				votes = item['users'];
				item.upvote_count = 0;
				item.downvote_count = 0;
				// console.log('item',item);
				if(votes)
					for(var j = 0;j<votes.length;j++){
						var v = votes[j];

						// 获取pivot元素中的用户投票信息
						// 如果是1 将增加一赞同票
						// 如果是2 将增加一反对票
						if(v['pivot'].vote ===1){
							item.upvote_count++;
						}
						if(v['pivot'].vote ===2){
							item.downvote_count++;
						}
					}
			}
			return answers;
		}
		me.vote = function(conf){
			if(!conf.id || !conf.vote){
				console.log('id and vote are required');
				return;
			}
			var answer = me.data[conf.id],
			users = answer.users;
			// console.log('me.data[conf.id]',me.data[conf.id]);
			// 判断当前用户是否已经投过相同票
			for(var i=0;i<users.length;i++){
				if(users[i].id == his.id && 
					conf.vote == users[i].pivot.vote ){
					conf.vote = 3;
				}
			}
			// return;
			// if(me.data[conf.id]){

			// }

			return $http.post('/api/answer/vote',conf).then(function(r){
				if(r.data.status){
					return true;
				}
				return false;
			},function(){
				return false;
			})
		}
		// me.update_data = function(input){
		// 	if(angular.isNumberic(input))
		// 		var id = input;
		// 	if(angular.isArray(input))
		// 		var id_set = input;
		// }
		me.update_data = function(id){
			return $http.post('/api/answer/read',{id:id})
			.then(function(r){
				// console.log('r.data.data',r.data.data);
				me.data[id] = r.data.data;
			})
		}
		
	}])






})();