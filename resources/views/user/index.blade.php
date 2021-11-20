@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h2>Gente</h2>
            <form action="{{route('user.index')}}" method="get" id="buscador">
                <div class="row">
                    <div class="form-group col">
                        <input type="text" id="search" class="form-control">
                    </div>
                    <div class="form-group col btn-search">
                        <input type="submit" value="Buscar" class="bnt bnt-success">
                    </div>
                </div>
            </form>
            @include('includes.message')
            @foreach($users as $user)
                <div class="profile-user">
                    @if($user->image)   
                        <div class="container-avatar">
                            <img src="{{route('user.avatar',['filename' => $user->image])}}" class="avatar" />
                        </div>    
                    @endif
                    
                    <div class="user-info">
                        <h2>{{'@'.$user->nick}}</h2>
                        <h3>{{$user->name.' '.$user->surname}}</h3>
                        <p>{{'Se unió: '. \FormatTime::LongTimeFilter($user->created_at) }}</p>
                        <a href="{{route('profile',['id' => $user->id])}}" class="btn btn-success">Ver perfil</a>
                    </div>
                    <div class="clearfix"></div>
                    <hr>
                </div>
            @endforeach
            
            <div class="clearfix"></div>
            {{$users->links()}}
            
        </div>
        <!--paginacion-->
        
    </div>
</div>

@endsection