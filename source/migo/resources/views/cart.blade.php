@extends('layout.master', ['page_title' => 'Cart'])


@section('page')
@include('layout.header')

<div class="grid-container">
	<!-- sign up form -->
	<section style="padding: 20px 0px 0px;">

		<h1 style="margin: 10px 0px;color: #44318d;font-size: 2rem;">Cart</h1>

		<div style="padding-top: 30px;">
			@if($data['cartdata'])
			<table class="unstriped">
			  <thead>
			    <tr>
			      <th width="200"></th>
			      <th>Product</th>
			      <th width="150">Price (₹)</th>
			      <th width="150">Quantity</th>
			      <th width="150">Total (₹)</th>
			    </tr>
			  </thead>
			  <tbody>
			  	@foreach($data['cartdata'] as $item)
			  	<tr>
			      <td><img src="http://localhost:8000/assets/img/product/{{ $item['image']['a'] }}" style="height:100px;margin:0px auto;display:block;"></td>
			      <td>{{ $item['name'] }}</td>
			      <td>{{ $item['price'] }}</td>
			      <td>{{ $item['quantity'] }}</td>
			      <td>{{ sprintf("%.2f", $item['price'] * $item['quantity']) }}</td>
			    </tr>
			  	@endforeach
			  	<tr style="font-weight:bold;background-color:#f8f8f8;">
			      <td colspan="4" style="text-align:center;">Grand Total</td>
			      <td>₹ {{ $data['grandtotal'] }}</td>
			    </tr>		    
			  </tbody>
			</table>
			@else
			<div class="callout">
				<h5>Empty</h5>
			</div>
			@endif
		</div>
	</section>
</div>
@stop