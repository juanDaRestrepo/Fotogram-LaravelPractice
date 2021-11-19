@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            @include('includes.message')
            
                <div class="card pub_image pub_image_detail">
                    
                    <div class="card-header">
                        @if($image->user->image)
                            <div class="container-avatar">
                                <img src="{{route('user.avatar',['filename' => $image->user->image]);}}" class="avatar" />
                            </div> 
                            <div class="data-user">
                                {{$image->user->name.' '.$image->user->surname }}
                                <span class="nickname">
                                    {{' | @'.$image->user->nick}}
                                </span>
                                <span class="nickname date">
                                    {{ \FormatTime::LongTimeFilter($image->created_at) }}
                                </span> 
                            </div> 
                        @endif  
                    </div>

                    <div class="card-body">
                        <div class="image-container image-detail">
                            <img src="{{route('image.file',['filename' => $image->image_path]);}}" />
                        </div>

                        <div class="description"> 
                            <span class="nickname">{{'@'.$image->user->nick}}</span>  
                            <p>{{$image->description}}</p>  
                        </div>
                        <div class="likes">
                               
                            <?php $user_like=false; ?>
                            @foreach($image->likes as $like)

                                @if($like->user->id == Auth::user()->id)
                                    <?php $user_like=true; ?>
                                @endif
                            @endforeach

                            @if($user_like)
                                <img src="{{asset('img/corazonRojo.png')}}" data-id="{{$image->id}}"class="btn-dislike">
                            @else
                                <img src="{{asset('img/corazonGris.png')}}" data-id="{{$image->id}}" class="btn-like">
                            @endif
                            <span class="number_likes">{{count($image->likes)}}</span>
                        </div>
                        <div class="clearfix"></div>
                        <div class="comments">
                            <h2>Comentarios ({{count($image->comments)}})</h2>
                            <hr/>
                            <form method="POST" action="{{route('comment.save')}}">
                                @csrf
                                <input type="hidden" name="image_id" value="{{$image->id}}"/>
                                <p>
                                    <textarea class="form-control {{$errors->has('content')?'is-invalid':''}}" name="content" required></textarea>
                                    @error('content')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                    <button type="submit" class="btn btn-success mt-3">
                                        Enviar
                                    </button>
                                </p>
                            </form>
                            <hr>
                            @foreach($image->comments as $comment)
                            <div class="comment"> 
                                <span class="nickname">{{'@'.$comment->user->nick}}</span>  
                                <span class="nickname date">
                                </span> 
                                <p>{{$comment->content}}<br>
                                @if(Auth::check() && ($comment->user_id == Auth::user()->id || $comment->image->id == Auth::user()->id))
                                    <a href="{{route('comment.delete',['id'=>$comment->id])}}" class="btn btn-sm btn-danger">
                                        Eliminar
                                    </a> 
                                @endif
                                </p> 
                            </div>
                            @endforeach
                        </div>
                       
                    </div>
                </div>
            
        </div>
        <!--paginacion-->
        
    </div>
</div>

@endsection