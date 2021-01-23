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
		          	<a href="/product/1" class="button expanded">Buy</a>
				</div>
				<div class="cell">
					<img src="/assets/img/product/motorola-g9-power.jpeg" style="display:block;height:260px;margin:10px auto;">
					<div style="padding: 10px 0px;">
						<strong>Motorola G9 Power</strong>
		          		<span style="display: block;">$400</span>
					</div>
		          	<a href="/product/2" class="button expanded">Buy</a>
				</div>
				<div class="cell">
					<img src="/assets/img/product/poco-m2.jpeg" style="display:block;height:260px;margin:10px auto;">
					<div style="padding: 10px 0px;">
						<strong>Poco M2</strong>
		          		<span style="display: block;">$400</span>
					</div>
		          	<a href="/product/3" class="button expanded">Buy</a>
				</div>
				<div class="cell">
					<img src="/assets/img/product/realme-6i.jpeg" style="display:block;height:260px;margin:10px auto;">
					<div style="padding: 10px 0px;">
						<strong>Realme 6i</strong>
		          		<span style="display: block;">$400</span>
					</div>
		          	<a href="/product/4" class="button expanded">Buy</a>
				</div>
				<div class="cell">
					<img src="/assets/img/product/realme-narzo-20a.jpeg" style="display:block;height:260px;margin:10px auto;">
					<div style="padding: 10px 0px;">
						<strong>Realme Narzo 20a</strong>
		          		<span style="display: block;">$400</span>
					</div>
		          	<a href="/product/5" class="button expanded">Buy</a>
				</div>
				<div class="cell">
					<img src="/assets/img/product/samsung-galaxy-f41.jpeg" style="display:block;height:260px;margin:10px auto;">
					<div style="padding: 10px 0px;">
						<strong>Samsung Galaxy F41</strong>
		          		<span style="display: block;">$400</span>
					</div>
		          	<a href="/product/6" class="button expanded">Buy</a>
				</div>
			</div>

		</div>
	</div>
</section>
@stop