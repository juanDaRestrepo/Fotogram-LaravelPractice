@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
          <h2>Mis imagenes favoritas</h2>
          <hr>
          @foreach($likes as $like)
            @include('includes.image',['image'=>$like->image])
          @endforeach
          <div class="clearfix"></div>
                {{$likes->links()}}
        </div>
    </div>
</div>

@endsection