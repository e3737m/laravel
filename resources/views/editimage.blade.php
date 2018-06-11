
 @if(count($errors))
  <ul>
  @foreach($errors->all() as $error)
   <li>{{$error}}</li>
   @endforeach
  </ul>
  @endif

@if($photo->id)
<form action="{{route('photos.update', $photo->id)}}" method="POST" enctype="multipart/form-data">
	{{csrf_field()}}
		
 <input type="hidden" name="_method" value="PATCH">
 @else <form action="{{route('photos.store')}}" method="POST" enctype="multipart/form-data">

  {{csrf_field()}}
   @endif
  <input type="text" name="name" value="{{$photo->name}}"><br>
 <input type="hidden" name="album_id" value="{{$photo->album_id ? $photo->album_id : $album->id}}"
@include("partials.imagefileupload");
 
 <br>
 Description <input type="text" style="margin-top: 20px;" name="description" value="{{$photo->description}}"><br>
 <input type="submit" value="OK">
</form>
 