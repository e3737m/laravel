@extends("layouts.app")
@section("content")

<table border="5">
 <tr><td><h3><a href="{{route("create_album")}}">Create album</a></h3></td></tr>




 @if (session()->has("message"))
    {{session()->get("message")}}
@endif
 @foreach ($albums as $album)
 <tr><td>Nome album:</td><td><b>{{$album->album_name}}</b></td><td>ID:</td><td><b>({{$album->id}})</b></td><td>Categoria:
   @foreach($album->categories as $category)
    {{$category->category_name}}
    @endforeach
  </td></tr>
  <tr><td><img src="{{asset($album->path)}}" height="120" width="120"></td><td><a href="{{route("albums_images", $album->id)}}">Vedi immagini({{$album->photos_count}})</a></td><td><a href="{{route("albums.delete", $album->id)}}">Delete</a></td><td><a href="{{route("albums.edit", $album->id)}}">Edit</a></td>
   <td><a href="{{route("photos.create")}}?album_id={{$album->id}}">Create image</a> </td></td></tr>
 @endforeach
</table>

@stop
