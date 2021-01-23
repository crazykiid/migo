@extends('layout.master', ['page_title' => $data['name']])


@section('page')
@include('layout.header')

<div class="grid-container">

    <div class="grid-x grid-margin-x" style="margin: 10px 0px;">
        @if(count($data['images']) > 0)
        <div class="medium-6 cell">
            <img src="{{ $data['images'][0] }}" style="display:block;height:360px;margin:10px auto;">
            <div class="grid-x grid-padding-x small-up-4">
                @foreach($data['images'] as $img)
                <div class="cell">
                    <img src="{{ $img }}" style="height: 100px;">
                </div>
                @endforeach
            </div>
        </div>
        @else
        <div class="medium-6 cell" style="background-color: #e6e6e6;color:#fff;font-size:24px;text-align: center;padding: 150px 0px;">
            No Image Available
        </div>
        @endif

        <div class="medium-6 large-5 cell large-offset-1">
            <h3>{{ $data['name'] }}</h3>
            <p>₹ {{ $data['price'] }}</p>
            <p>{{ $data['description'] }}</p>   
            <label>Quantity
            <select>
                @for($x = 1;$x <= $data['max'];$x++)
                <option value="{{$x}}">{{$x}}</option>
                @endfor
            </select>
            </label>
            <button class="hollow button expanded">Add to Cart</button>
            <a href="#" class="button large expanded">Buy Now</a>
        </div>
    </div>
</div>


@stop