Photo name
 <input type="text" style="margin-top: 20px;" name="name" value="{{$photo->name}}"><br>
 Image
@if (isset($photo->img_path))
 <img src="{{asset($photo->img_path)}}"><br>
@else  <br>
  @endif
 <input type="file" name="img_path">