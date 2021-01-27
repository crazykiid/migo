function login(u,p){
	var payload = {'_u':u, '_p':p, '_t':'ajax'};
	var headers = {'X-CSRF-TOKEN': $('meta[name="csrf"]').attr('content')};
	$('.res').empty().removeClass('callout alert success');
	$.ajax({
		headers: headers,
        type: 'POST',
        url: '/login',
		dataType: 'json',
		data: payload,
		success:function(res){
			if(res['type'] == 'success'){
				$('.res').append(res['title']+' redirecting...').addClass('callout success');
				window.location.replace('/');
			}
			else{
				$('.res').append(res['message']).addClass('callout alert');
			}
		},
		error: function(res){
			$('.res').append(res['message']).addClass('callout alert');
		}
	});
}
function resetAdd(){
	$('.pick').addClass('hollow').removeClass('success alert').html('Add to Cart').blur();
}
function add(pid,q){
	var payload = {'_pid':pid, '_q':q};
	var headers = {'X-CSRF-TOKEN': $('meta[name="csrf"]').attr('content')};
	$.ajax({
		headers: headers,
        type: 'POST',
        url: '/cart/pick',
		dataType: 'json',
		data: payload,
		success:function(res){
			if(res['msg'] == 'Success.'){
				$('.cart').empty().append(res['data']['_cart'].length);
				$('.pick').removeClass('hollow').addClass('success').html('Added!');
				window.setTimeout(resetAdd,2000);
			}
			else{
				$('.pick').removeClass('hollow').addClass('alert').html(res['msg']);
				window.setTimeout(resetAdd,3000);
			}
		},
		error: function(res){
			$('.pick').removeClass('hollow').addClass('alert').html('Try again!');
			window.setTimeout(resetAdd,3000);
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
		var user = $("#-user").val().trim();
		var pass = $("#-pass").val().trim();
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