@extends('layout.master', ['page_title' => 'MiGO'])


@section('page')
@include('layout.header')

<section class="grid-container">
	<div class="card" style="margin: 10px 0px;">
		<div class="card-section">
			<h5 class="subheader" style="color:#44318d;">PRODUCTS</h5>
			<hr style="margin-top: 0px;">	
			@if($data['product_list'])
			<div class="grid-x grid-margin-x small-up-2 medium-up-4 large-up-6">
				@foreach($data['product_list'] as $product)
				<div class="cell">					
					<img src="{{ $product['image'] }}" style="display:block;height:260px;margin:10px auto;">
					
					<div style="padding: 10px 0px;">
						<strong>{{ $product['name'] }}</strong>
		          		<span style="display: block;">₹ {{ $product['price'] }}</span>
					</div>
		          	<a href="/product/{{ $product['pid'] }}" class="button expanded">Buy</a>
				</div>
				@endforeach
			</div>
			@else
			<div>
				<p>No Products Available Yet!</p>
			</div>
			@endif
		</div>
	</div>
</section>
@stop