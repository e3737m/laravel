@extends("layouts.template")
 @section("content")
 
  @foreach($images as $image)
  <div class ="imgbox">
   <div class="text">{{$image->name}}<br></div>
   <img src="{{asset($image->img_path)}}" width="100"><br>
  
  </div>
    
        
        @endforeach
    

 @stop