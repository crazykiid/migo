@extends('layout.master', ['page_title' => 'Create account'])


@section('page')
@include('layout.header')

@stop

@section('extra')
<script type="text/javascript">
function login(u,p){
	var payload = {'_u':u, '_p':p, '_token':'{{csrf_token()}}'};
	$('.res').empty().removeClass('er,sg');
	$.ajax({
        type:'POST',
        url:'/login',
		dataType: 'json',
		data: payload,
		success:function(res){
			if(res['msg'] == 'login success'){
				$('.res').append(res['msg']+', redirecting...').addClass('sg');
				window.location.replace('/');
			}
			else{
				$('.res').append(res['msg']).addClass('er');
			}
		},
		error: function(res){
			$('.res').append(res['msg']).addClass('er');
		}
	});
}
$(document).ready(function(){
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

});
</script>
@stop