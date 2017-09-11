var appPath = '__APP__';
$(document).ready(function(){
	var url = $('#url').val();
	console.log(url);

	$('.tb-taglist-li').on('click',function(){
		var pingjia = $(this).attr('data');
		$.ajax({
			url:url+'/ajaxComment/pingjia/'+pingjia,
			type:'get',
			dataType:'json',
			success:function(result){
				if(result.code == 200){
					var comment = result.result;
					console.log(comment);
					showComment(comment);
				}
			}
		});
	});
});


function showComment(comment){
	var str='';
	$('.am-comments-list').html('数据加载中...');
	comment.forEach(function(v,k){
		str += '<li class="am-comment">';
			str += '<a href="#">';
				if(v.avator){
					avator = v.avator;
				}
				else{
					avator = '/Public/Home/images/hwbn40x40.jpg';
				}
			// str += '<img class="am-comment-avatar" src="'appPath'+'/'+'+avator+'">';
			str += '</a>';

			str += '<div class="am-comment-main">';
				str += '<header class="am-comment-hd">';
					str += '<div class="am-comment-meta">';
						str += '<a href="#link-to-user" class="am-comment-author"> ';
							str += v.user
						str += '(匿名)</a>';
		
						str += '评论于'+'<time datetime="">'+v.add_time+'</time>';
					str += '</div>';

				str += '</header>';
			str += '<div class="am-comment-bd">';
			str += '<div class="tb-rev-item " data-id="255776406962">';
				str += '<div class="J_TbcRate_ReviewContent tb-tbcr-content ">';
					str += v.comment
				str += '</div>';
			str += '</div>';
		str += '</div>';

		str += '</div>';
		str += '</li>';
	});
	$('.am-comments-list').html(str);
}