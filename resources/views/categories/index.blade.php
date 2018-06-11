
@if(count($errors))

 <ul>
     @foreach($errors->all() as $error)
         <li>{{$error}}</li>
         @endforeach
 </ul>
@endif

<table>
    <tr>
        <th>ID</th>
        <th>Category name</th>
        <th>Category date</th>
        <th>Update date</th>
        <th>Number of albums</th>
    </tr>

    @forelse($categories as $category)
        <tr>
            <td>{{$category->id}}</td>
            <td>{{$category->category_name}}</td>
            <td>{{$category->created_at}}</td>
            <td>{{$category->updated_at}}</td>
            <td>{{$category->albums_count}}</td>

        </tr>
        @empty
        <tr><td colspan="5">No categories</td></tr>
        @endforelse
</table>

Add new category
<form action="{{route('categories.store')}}" method="post">
    <input type="text" name="category_name">
    <input type="submit" value="Add">
    {{csrf_field()}}

</form>