<?php

namespace App\Http\Controllers;
use App\Album;

use Illuminate\Http\Request;

class AlbumsController extends Controller
{
    public function getList()
  {
    $albums = Album::with('Photos')->get();
    return view('index')
    ->with('albums',$albums);
  }
  public function getAlbum($id)
  {
    $album = Album::with('Photos')->find($id);
    // return view::make('album')->with('album',$album);
    return view('album')->with('album',$album);
  }
  public function getForm()
  {
    // return View::make('createalbum');\
    return view('createalbum');
  }
  public function postCreate()
  {
    $rules = array(

      'cover_image'=>'required|image'

    );
    
    $validator = Validator::make(Input::all(), $rules);
    if($validator->fails()){

      return Redirect::route('create_album_form')
      ->withErrors($validator)
      ->withInput();
    }

    $file = Input::file('cover_image');
    $random_name = str_random(8);
    $destinationPath = 'albums/';
    $extension = $file->getClientOriginalExtension();
    $filename=$random_name.'_cover.'.$extension;
    $uploadSuccess = Input::file('cover_image')
    ->move($destinationPath, $filename);
    $album = Album::create(array(
      'cover_image' => $filename,
    ));

    return Redirect::route('show_album',array('id'=>$album->id));
  }

  public function getDelete($id)
  {
    $album = Album::find($id);

    $album->delete();

    return Redirect::route('index');
  }
}
