<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;


class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request)
    {
      $records = Post::where(function($query) use($request){
          if ($request->input('category_id')) {
            $query->where('category_id',$request->category_id);
          }
          if ($request->input('search_by_title_or_content')) {
            $query->where(function($query) use($request){
              $query->where('title','like','%'.$request->search_by_title_or_content.'%')->
              orWhere('content','like','%'.$request->search_by_title_or_content.'%');

            });
          }

        })->paginate(20);
      // $records = Post::with('category')->paginate(20);
      return view('posts.index' , compact('records'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      return view('posts.create' );

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $rule =[
        'title' =>'required',
        'content' =>'required',
        'image' =>'required|image',
        'category_id' =>'required',

      ];
      $messages =[
        'name.required' =>'Name is required',
        'content.required' =>'Content is required',
        'image.required' =>'Image is required',
        'category_id.required' =>'category_id is required',

      ];
      $this->validate($request ,$rule ,$messages);
      $img = $request->file('image');
      $directionPath = public_path().'/uploads/image/posts/';
      $extension = $img->getClientOriginalExtension();
      $name = rand('22222','999999'). '.' . $extension;
      $img->move($directionPath, $name);
      $record = Post::create($request->all());
      $record->image ='uploads/image/posts/'.$name;
      $record->save();
      flash('success')->success();

      return redirect(route('post.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $model = Post::findOrFail($id);

      return view('posts.edit',compact('model'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      $record = Post::findOrFail($id);
      $record->update($request->all());
      flash('Edited')->success();

      return redirect(route('post.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $record = Post::findOrFail($id);
      $record->delete();
      flash('Deleted')->error();

      return back();
    }
}
