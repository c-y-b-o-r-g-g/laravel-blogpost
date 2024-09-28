<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Post;
use RealRashid\SweetAlert\Facades\Alert;

class HomeController extends Controller
{
    public function index()
    {
        if (Auth::id()) {

            $post = Post::where('post_status','=','active')->get();

            $user_type = Auth::user()->user_type;


            if ($user_type == 'user') {
                return view('home.homepage', compact('post'));
            } elseif ($user_type == 'admin') {
                return view('admin.index');
            } else {
                return redirect()->back();
            }
        }
    }

    public function homepage()
    {
        $post = Post::where('post_status','=','active')->get();
        return view('home.homepage', compact('post'));
    }

    public function post_details($id)
    {
        $post = Post::find($id);
        return view('home.post_details', compact('post'));
    }

    public function create_post()
    {

        return view('home.create_post');
    }

    public function user_post(Request $request)
    {
        $user = Auth::user();
        $userid = $user->id;
        $username = $user->name;
        $usertype = $user->usertype;

        $post = new Post;
        $post->title = $request->title;
        $post->description = $request->description;



        $post->user_id = $userid;
        $post->name = $username;
        $post->user_type = $usertype;

        $post->post_status = 'pending';

        $image = $request->image;

        if ($image) {

            $imagename = time() . '.' . $image->getClientOriginalExtension();
            $request->image->move(public_path('postimage'), $imagename);
            $post->image = $imagename;
        }

        $post->save();

        Alert::success('congrats', 'You have added the data succesfully');
        return redirect()->back();

        // return redirect()->back()->with('message', 'Post added successfully!');
    }

    public function my_post()
    {
        $user = Auth::user();
        $userid = $user->id;
        $data = Post::where('user_id', '=', $userid)->get();
        return view('home.my_post', compact('data'));
    }

    public function my_post_del($id)
    {
        $data = Post::find($id);
        $data->delete();
        return redirect()->back()->with('message', 'Post deleted Succesfully');
    }

    public function post_update_page($id)
    {
        $data = Post::find($id);
        return view('home.post_page', compact('data'));
    }

    public function update_post_data(Request $request, $id)
    {
        $data = Post::find($id);
        $data->title = $request->title;
        $data->description = $request->description;
        $image = $request->image;
        if ($image) {
            $imagename = time() . '.' . $image->getClientOriginalExtension();
            $request->image->move('postimage', $imagename);
            $data->image = $imagename;
        }
        $data->save();
        return redirect()->back()->with('message', 'Post Updated Successfully');
    }
}
