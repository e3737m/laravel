
<table>
  <tr>
       <th>ID</th>
	   <th>CREATED DATE</th>
	   <th>TITLE</th>
	   <th>ALBUM</th>
	   <th>THUMBNAIL</th>
	   <th>DELETE</th>
	   <th>EDIT</th>
  </tr>
 
 

  @foreach($images as $image)
     <tr>
	      <td>{{$image->id}}</td>
	      <td>{{$image->created_at}}</td>
		  <td>{{$image->name}}</td>
		  <td>{{$image->description}}</td>
		  <td><img width="120" src="{{asset($image->img_path)}}"></td>
		  <td> <form action="{{route('photos.destroy', $image->id)}}" method="post"> 
		       {{ csrf_field() }}
			   <input type="hidden" name="_method" value="DELETE">
                <button type="submit">DELETE</button> </form></td>
		  <td>
		       <form action="{{route('photos.edit', $image->id)}}" method="get"> 
			    {{ csrf_field() }}
                <button type="submit">EDIT</button> </form></td>
		  
	 </tr>


  @endforeach



  
</table>

{{$images->links()}}