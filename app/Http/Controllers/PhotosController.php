<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Photo;
use App\Models\Album;
use Illuminate\Support\Facades\Storage;



class PhotosController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    protected $rules = [
        'album_id' => "required|exists:albums,id",
        'name' => "required|unique:photos",
        'description' => 'required',
        'img_path' => 'required|image'
    ];

    protected $errorMessages = [
        'name.required' => "Il nome è obbligatorio",
        'album_id.required' =>"Album non esistente"
    ];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Photo::get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $req)
    {
        //
        $id = $req->has('album_id') ? $req->input('album_id') : null;
        $album = Album::firstOrNew(['id' => $id]);

        $photo = new Photo;

        return view('editimage', compact('album','photo'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, $this->rules, $this->errorMessages );
        $photo = new Photo;
        $photo->album_id = request()->input('album_id');
        $this->ProcessFile($photo, $request);
        $photo->name = request()->input('name');
        $photo->description = request()->input('description');

        $res = $photo->save();
        //return ' '.$res;
        return redirect()->route('albums');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Photo $photo)
    {
        return $photo;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Photo $photo)
    {

        return view('editimage', compact('photo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Photo $photo)
    {
        $this->ProcessFile($photo, $request);
        $photo->name = request()->input('name');
        $photo->description = request()->input('description');
        $res = $photo->save();
        $message = $res? "photo ".$photo->name." update": "photo ".$photo->name." not update";
        session()->flash("message", $message);
        return redirect()->route("albums");
        dd($request->only(['name', 'description']));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Photo $photo)
    {    
	     //$this->processFile($photo);
		 $res = $photo->delete();
		 if($res)
		 {
			 $this->deleteFile($photo);
		 }
         return redirect()->back();
    }
	
	public function processFile(Photo $photo, Request $req = null)
	{
		if(!$req->hasFile('img_path'))
		{
			return false;
		}
		
		$file = $req->file('img_path');
		if(!$file->isValid())
		{
		  return false;
		}
		$filename = $photo->id . '.' . $file->extension();
		$file->storeAs(env('IMG_DIR').'/'.$photo->album_id, $filename);
		$photo->img_path = '/storage/'.env('IMG_DIR').'/'.$photo->album_id .'/'. $filename;
		return true;
	}
	
	public function deleteFile(Photo &$photo)
	{
		 $disk = config('filesystems.default');
		 if($photo->img_path && Storage::disk($disk)->has($photo->img_path))
		 {
			 return Storage::disk($disk)->delete($photo->img_path);
		 }else return false;
	}


}
