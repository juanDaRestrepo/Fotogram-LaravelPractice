<?php

namespace App\Http\Controllers;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
  public function __construct()
    {
        $this->middleware('auth');
    }
    public function config(){
        return view('user.config');
    }

    public function update(Request $request){
        
        $id=$request->input('id');
        $user = User::find($id);
        $validate =$this->validate($request,[
            'name' => ['required', 'string', 'max:255'],
            'surname' => ['required', 'string', 'max:255'],
            'nick' => ['required', 'string', 'max:255', 'unique:users,nick,'.$id],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,'.$id],
        ]);

        
        $name=$request->input('name');
        $surname=$request->input('surname');
        $nick=$request->input('nick');
        $email=$request->input('email');

      //Asiganar nuevos valores al objeto de usuariois
      $user->name = $name;
      $user->surname = $surname;
      $user->nick = $nick;
      $user->email = $email;
        
      $image_path = $request->file('image_path');
      if($image_path){
        $image_path_full = time().$image_path->getClientOriginalName(); 
        Storage::disk('users')->put($image_path_full,File::get($image_path));
        $user->image = $image_path_full;
    }

      $user->save();

      return redirect()->route('config')->with(['message'=>'Usuario actualizado correctamente']);


    }


    public function getImage($filename){
      $file = Storage::disk('users')->get($filename);
      return new Response($file,200);
    }

    public function profile($id){
      $user = User::find($id);

      return view('user.profile',[
        'user'=>$user
      ]);
    }
}

