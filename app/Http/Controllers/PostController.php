<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Post;
Use Illuminate\Support\Facades\Session;

class PostController extends Controller
{
    public function showData(){
        
        $posts = DB::select('select * from posts');
 
        return view('show_data', ['posts' => $posts]);
    }

    public function addData(){
        return view('add_data');
    }
    
    //add data
    public function storeData(Request $request){
        $rules= [
            'name'=>'required|max:10',
            'email'=>'required|email',
        ];
        $cm=[
            'name.required'=>'Enter your name',
            'name.max'=>'Your name can not contain more than 10 character',
            'email.required'=>'Enter your name',
            'email.email'=>"Email must be a valid email",
        ];
        $this->validate($request,$rules,$cm);
        $name = $request->input('name');
        $email = $request->input('email');
        DB::insert('insert into posts (name, email) values (?, ?)',[$name,$email]);

        Session::Flash('msg','Data successfully Added');
        //return $request->all();
        return redirect('/');

        // $query=DB::table('posts')->insert([
        //     'name'=>$request->input('name'),
        //     'email'=>$request->input('email')

        // ]);
        // if($query){
        //     Session::Flash('msg','Data successfully Added');
        //     //return $request->all();
        //     return redirect('/');
        // }

    //    DB::table('posts')->insert([
    //         'name'=>$request->input('name'),
    //         'email'=>$request->input('email')

    //     ]);
      
    //         Session::Flash('msg','Data successfully Added');
    //         //return $request->all();
    //         return redirect('/');
       
       
    }

    //edit display data
    public function editData($id=null){
        $editData=Post::find($id);
        //$editData=Post::findOrFail($id);

        return view('edit_data',compact('editData'));
    }
    //update

    public function updateData(Request $request,$id){
        $rules= [
            'name'=>'required|max:10',
            'email'=>'required|email',
        ];
        $cm=[
            'name.required'=>'Enter your name',
            'name.max'=>'Your name can not contain more than 10 character',
            'email.required'=>'Enter your name',
            'email.email'=>"Email must be a valid email",
        ];
        $this->validate($request,$rules,$cm);

        $updateData=Post::find($id);
        $updateData->name=$request->name;
        $updateData->email=$request->email;
        $updateData->save();
        Session::Flash('msg','Data successfully Updated');
        return redirect('/');
    }
    //delete

    public Function deleteData($id){
        $deleteData=Post::find($id);
        $deleteData->delete();
        Session::Flash('msg','Data successfully Deleted');
        return redirect('/');
    }

}
