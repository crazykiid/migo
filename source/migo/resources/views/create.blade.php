@extends('layout.master', ['page_title' => 'Create account'])


@section('page')
@include('layout.header')

<div class="grid-container">
	<!-- sign up form -->
	<section style="padding: 20px 0px 0px;">

		<h1 style="margin: 10px 0px;color: #44318d;font-size: 2rem;">Create Account</h1>

		@if(Session::has('res_type'))
		<!-- response -->
		<div class="callout {{ Session::get('res_type') }}">
		  <h5><i class="fi-{{ (Session::get('res_type') == 'success')? 'check' : 'alert' }}"></i> {{ Session::get('res_title') }}</h5>
		  <p>{{ Session::get('res_msg') }}</p>
		</div>
		@endif

		<div class="card" style="padding-top: 30px;">

			<div class="card-section">
				<form method="post" action="" data-abide>
				    <div class="grid-x grid-margin-x">
				        <div class="cell small-12">
				            <label>Name <span class="c-name"></span>
				            <input type="text" name="_name" required>
				            </label>
				        </div>
						<div class="cell small-12">
				            <label>Email <span class="c-email"></span>
				            <input type="email" name="_email" required>
				            </label>
				        </div>
				        <div class="cell small-12">
				            <label>Contact <span class="c-contact"></span>
				            <input type="text" name="_contact" maxlength="10" required>
				            </label>
				        </div>
				        <div class="cell small-12">
				            <label>Password <span class="c-pass"></span>
				            <input type="password" name="_pass" required>
				            </label>
				        </div>
				        <div class="cell small-12" style="padding-top:12px;">
				        	@csrf

				            <button class="button create" type="submit">Create</button>
				        </div>
				    </div>
			    </form>
			</div>
		</div>
	</section>
</div>
@stop