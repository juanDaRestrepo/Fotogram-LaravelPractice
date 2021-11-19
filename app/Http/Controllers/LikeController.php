<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\like;
class LikeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function like($image_id){
        //Recoger datos de usuario y la imagen 
        $user = Auth::user();

        //Condicion para ver si el like existe
        $isset_like = Like::where('user_id',$user->id)
                    ->where('image_id',$image_id)
                    ->count();

        if($isset_like==0){
            $like = new Like();
            $like->user_id = $user->id;
            $like->image_id = (int)$image_id;
            $like->save();
            return response()->json([
                'like' =>$like
            ]);
        }else{
            return response()->json([
                'message' =>'El like ya existe'
            ]);
        }
        var_dump($isset_like);
    }

    public function dislike($image_id){
        //Recoger datos de usuario y la imagen 
        $user = Auth::user();

        //Condicion para ver si el like existe
        $like = Like::where('user_id',$user->id)
                    ->where('image_id',$image_id)
                    ->first();

        if($like){
            
            $like->delete();
            return response()->json([
                'like' =>$like,
                'message'=>'Has dado dislike correctamente'
            ]);
        }else{
            return response()->json([
                'message' =>'El like ya existe'
            ]);
        }
       
    }

    public function likes(){
        $user = Auth::user();
        $likes = Like::where('user_id',$user->id)->orderBy('id','desc')->paginate(5);

        return view('likes.likes',[
            'likes' => $likes
        ]);
    }

}
