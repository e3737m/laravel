@extends("layouts.template")
 @section("content")
 
  @foreach($albums as $album)
  <div class ="imgbox">
   <a href="{{route("gallery.images", $album->id)}}"><div class="text">{{$album->album_name}}<br></div></a>
   <img src="{{asset($album->path)}}" width="100"><br>
   Categories:
   @foreach($album->categories as $cat)
   <a href="{{route('gallery.album.category', $cat->id)}}">{{$cat->category_name}}</a>,
    @endforeach
  </div>
    
        
        @endforeach
    

 @stop