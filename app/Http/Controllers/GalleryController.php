<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Album;
use App\Models\Photo;
use App\Models\AlbumCategory;

class GalleryController extends Controller
{
    public function index()
    {
        $albums =  Album::latest()->withCount('categories')->get();

        return view("gallery.albums")->with("albums", $albums);
    }

    public function showAlbumByCategory(AlbumCategory $category)
    {
        return view("gallery.albums")->with("albums", $category->albums);
    }
	public function showAlbumImages(Album $album)
	{
	  return view("gallery.images")->with("images", Photo::whereAlbumId($album->id)->latest()->get());
	}
}
