@if(count($errors))
 <ul>
  @foreach($errors->all() as $error)
   <li>{{$error}}</li>
  @endforeach
 </ul>
@endif

<form action="{{route("album_save")}}" method="post" enctype="multipart/form-data">
	{{csrf_field()}}
	
 @include("partials.fileupload");

 <input type="hidden" name="user_id" value=""><br>
 Description 
 <input type="text" style="margin-top: 20px;" name="description" value=""><br>
 <select name="categories[]" multiple>
  @foreach($categories as $category)
  <option value="{{$category->id}}">{{$category->category_name}}</option>
   @endforeach
 </select><br>
 <input type="submit" value="OK">
</form>
 