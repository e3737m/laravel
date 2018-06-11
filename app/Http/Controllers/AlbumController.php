<?php

namespace App\Http\Controllers;

use App\Models\AlbumCategory;
use Illuminate\Http\Request;

use App\Models\Album;
use App\Models\Photo;
use App\User;
use App\Http\Requests\AlbumRequest; ////////
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

use DB;

class AlbumController extends Controller
{


   public function index(Request $req)
   {
		$queryBuilder = Album::orderBy("id", "DESC")->withCount('photos')->with('categories');
		$queryBuilder->where("user_id", Auth::user()->id);
		if($req->has("id"))
		{
		  $queryBuilder->where("id", "=", $req->input("id"));
		}
		$albums = $queryBuilder->get();
		return view("albums", ["albums" => $albums]);
   }
   
   public function delete(Album $album)
   {
	   //DB::table("albums")->where("id", $id)->delete();
	   $thumbNail = $album->album_thumb;
	   $disk = config('filesystems.default');
	   $res = $album->delete();
	   if($res)
	   {
		   if($thumbNail && Storage::disk($disk)->has($thumbNail))
		   {
			   Storage::disk($disk)->delete($thumbNail);
		   }
	   }
	   return redirect()->back();
   }
   
   public function edit($id)
   {
	   $album = Album::find($id);
	   $categories = AlbumCategory::get();
	   $selectedCategories = $album->categories->pluck('id')->toArray();
	   //dd(Auth::user()->id);
	   //dd($album->user->id);
   //
       //dd(Auth::user()->id);

       //dd(Gate::allow('manage_album', $album));



     /*if(Gate::denies('manage_album', $album));
       {
           abort(401, 'Unathorized');
       }*/


      // $this->authorize('edit', $album);
	   return view('editalbum')->with(['album' => $album,
                                       'categories' => $categories,
                                       'selectedCategories' => $selectedCategories]);
   }
   
   public function store($id, AlbumRequest $req)
   {
     $album = Album::find($id);
	 $album->album_name = $req->input('name');
	 $album->description = $req->input('description');
	 $album->user_id = $req->user()->id;
	  
	  /*if($req->hasFile('album_thumb'))
	  {
		  $file = $req->file('album_thumb');
		  $filename = $id.".".$file->extension();
		  $file->storeAs(env('ALBUM_THUMB_DIR'), "/".$filename);
		  $album->album_thumb = env("ALBUM_THUMB_DIR")."/".$filename;
	  }*/

	  
	  $this->processFile($album->id, $req, $album);
	  
	  $res = $album->save();

	  $album->categories()->sync($req->categories);
		  
	  $message = $res? "Album con id $id aggiornato": "Album con id $id non aggiornato";
	  session()->flash("message", $message);
	  return redirect()->route("albums");
	  
   }
   
   public function create()
   {
	   //dopo aver cliccato il pulsante crea album
	   $album = new Album;
	   $categories = AlbumCategory::get();
	   return view("createalbum", ['album' => $album,
                                   'categories' => $categories,
                                    'selectedCategories' => [],
                                  ]);
   }
   
   public function save(AlbumRequest $req)
   { 
	 
	   //salvataggio nuovo album
       
	   /*$res = Album::create([
	                  'album_name' => request()->input('name'),
					  'album_thumb' => '',
					  'description' => request()->input('description'),
					  'user_id' => 1,
					  ]);*/
	  $album = new Album;
	  $album->album_name = $req->input('name');
	  $album->album_thumb = '';
	  $album->description = $req->input('description');
	  $album->user_id = $req->user()->id;
	  $res = $album->save();
					  
	if($res)
	{
	    if($req->has('categories'))
        {
            $album->categories()->attach($req->categories);
        }
		$this->processFile($album->id, $req, $album);
		$album->save();
	}		
					  
	   $name = $req->input('name');
	   $message = $res? "Album $name creato" : "Album $name non creato";
	   session()->flash('message', $message);
	   return redirect()->route('albums');
   }
   
   public function getImages(Album $album)
   {
	 $images = Photo::where("album_id", $album->id)->paginate(env('IMG_PER_PAGE'));   //get()
	 return view('albumimages', compact('images', 'album'));
   }
   
   
   protected function processFile($id, $req, &$album)
   {
	  if(!$req->hasFile('album_thumb'))
	  {
		  return false;
	  }
	      $id = $album->id;
		  $file = $req->file('album_thumb');
		  $filename = $id.".".$file->extension();
		  $file->storeAs(env('ALBUM_THUMB_DIR'), "/".$filename);
		  $album->album_thumb = env("ALBUM_THUMB_DIR")."/".$filename;
		  return true;
   }
}
