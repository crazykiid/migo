function login(u,p){
	var payload = {'_u':u, '_p':p};
	var headers = {'X-CSRF-TOKEN': $('meta[name="csrf"]').attr('content')};
	$('.res').empty().removeClass('callout alert success');
	$.ajax({
		headers: headers,
        type: 'POST',
        url: '/login',
		dataType: 'json',
		data: payload,
		success:function(res){
			if(res['msg'] == 'login success'){
				$('.res').append(res['msg']+', redirecting...').addClass('callout success');
				window.location.replace('/');
			}
			else{
				$('.res').append(res['msg']).addClass('callout alert');
			}
		},
		error: function(res){
			$('.res').append(res['msg']).addClass('callout alert');
		}
	});
}
function add(pid,q){
	var payload = {'_pid':pid, '_q':q};
	var headers = {'X-CSRF-TOKEN': $('meta[name="csrf"]').attr('content')};
	//$('.res').empty().removeClass('callout alert success');
	$.ajax({
		headers: headers,
        type: 'POST',
        url: '/cart/pick',
		dataType: 'json',
		data: payload,
		success:function(res){
			if(res['msg'] == 'success'){
				$('.cart').empty().append(res['data'].length);
			}
		},
		error: function(res){
			console.log(res);
		}
	});
}
$(document).ready(function(){
	$(".s-l").click(function(){
		$('.res').empty().removeClass('callout alert success');
		$('.u-help, .p-help').empty();
	});
	$(".logout").click(function(){
		window.location.replace('/logout');
	});
	$(".login").click(function(){
		$('.u-help, .p-help').empty();
		var user = $("#-user").val();
		var pass = $("#-pass").val();
		//var user = $("#-user").val().trim();
		//var pass = $("#-pass").val().trim();
		if(user.length > 0 && pass.length > 0){
			login(user, pass);
		}
		else{
			if(user.length == 0){
				$('.u-help').empty().append('required').addClass('er');
			}
			if(pass.length == 0){
				$('.p-help').empty().append('required').addClass('er');
			}
		}
	});
	$(".pick").click(function(){
		var pid = $('.pid').html();
		var qty = $('[name ="quantity"]').val();
		add(pid,qty);
	});
	$(".create").click(function(){
		var name = $('input[name="_name"]').val();
		var email = $('input[name="_email"]').val();
		var contact = $('input[name="_contact"]').val();
		var pass = $('input[name="_pass"]').val();
	});
});