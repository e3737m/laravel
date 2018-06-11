 Album Name
 <input type="text" style="margin-top: 20px;" name="name" value="{{$album->album_name}}"><br>
 Image
 <img src="{{asset($album->path)}}"><br>
 <input type="file" name="album_thumb">