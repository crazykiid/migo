@extends('layout.master', ['page_title' => 'MiGO'])


@section('page')
@include('layout.header')

<section class="grid-container">
	<div class="card" style="margin: 10px 0px;">
		<!-- <div class="card-divider">
	    	<h4>Latest</h4>
		</div> -->
		<div class="card-section">

			<div class="grid-x grid-margin-x small-up-2 medium-up-4 large-up-6">
				<div class="cell">
					<img src="/assets/img/product/google-pixel.jpeg" style="display:block;height:260px;margin:10px auto;">
					<div style="padding: 10px 0px;">
						<strong>Google Pixel</strong>
		          		<span style="display: block;">$400</span>
					</div>
		          	<a href="#" class="button expanded">Buy</a>
				</div>
				<div class="cell">
					<img src="/assets/img/product/motorola-g9-power.jpeg" style="display:block;height:260px;margin:10px auto;">
					<div style="padding: 10px 0px;">
						<strong>Motorola G9 Power</strong>
		          		<span style="display: block;">$400</span>
					</div>
		          	<a href="#" class="button expanded">Buy</a>
				</div>
				<div class="cell">
					<img src="/assets/img/product/poco-m2.jpeg" style="display:block;height:260px;margin:10px auto;">
					<div style="padding: 10px 0px;">
						<strong>Poco M2</strong>
		          		<span style="display: block;">$400</span>
					</div>
		          	<a href="#" class="button expanded">Buy</a>
				</div>
				<div class="cell">
					<img src="/assets/img/product/realme-6i.jpeg" style="display:block;height:260px;margin:10px auto;">
					<div style="padding: 10px 0px;">
						<strong>Realme 6i</strong>
		          		<span style="display: block;">$400</span>
					</div>
		          	<a href="#" class="button expanded">Buy</a>
				</div>
				<div class="cell">
					<img src="/assets/img/product/realme-narzo-20a.jpeg" style="display:block;height:260px;margin:10px auto;">
					<div style="padding: 10px 0px;">
						<strong>Realme Narzo 20a</strong>
		          		<span style="display: block;">$400</span>
					</div>
		          	<a href="#" class="button expanded">Buy</a>
				</div>
				<div class="cell">
					<img src="/assets/img/product/samsung-galaxy-f41.jpeg" style="display:block;height:260px;margin:10px auto;">
					<div style="padding: 10px 0px;">
						<strong>Samsung Galaxy F41</strong>
		          		<span style="display: block;">$400</span>
					</div>
		          	<a href="#" class="button expanded">Buy</a>
				</div>
			</div>

		</div>
	</div>
</section>
@stop

@section('extra')
<script type="text/javascript">
function login(u,p){
	var payload = {'_u':u, '_p':p, '_token':'{{csrf_token()}}'};
	$('.res').empty().removeClass('callout alert success');
	$.ajax({
        type:'POST',
        url:'/login',
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

});
</script>
@stop