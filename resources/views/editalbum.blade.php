@if(count($errors))
 <ul>
  @foreach($errors->all() as $error)
   <li>{{$error}}</li>
  @endforeach
 </ul>
@endif

<form action="{{route("albums.store", $album->id)}}" method="POST" enctype="multipart/form-data">
	{{csrf_field()}}
 <input type="hidden" name="_method" value="PATCH">
 
@include("partials.fileupload");
 
 <input type="text" style="margin-top: 20px;" name="description" value="{{$album->description}}"><br>










 <select name="categories[]" multiple>
  @foreach($categories as $category)
   <option
           @if(in_array($category->id, $selectedCategories))
           value= "{{$category->id}}" selected>{{$category->category_name}}</option>
   @else value= "{{$category->id}}">{{$category->category_name}}</option>
   @endif
  @endforeach
 </select><br>
 <input type="submit" value="OK">
</form>
 