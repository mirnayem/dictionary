@extends('layouts.app')

@section('content')
<h1 class="text-center">Edit Category</h1>

    <form action= " {{route('categories.update',$category->id)}} " method="post" enctype="multipart/form-data"> 
        @csrf
        @method('PATCH')
        <div class="form-group">
           
            <input type="text" name="name" id="" class="form-control" class="@error('name') is-invalid @enderror" value=" {{$category->name}} " >
            @error('name')
           <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
      
        <div>
            <button type="submit" class="btn btn-success float-left">Update Category</button>
        </div>
       
     </form>



<form action= " {{route('categories.destroy',$category->id)}} " method="post" enctype="multipart/form-data"> 
    @csrf
    @method('DELETE')
    
  
    <div>
        <button type="submit" class="btn btn-danger float-right">Delete Category</button>
    </div>
   
 </form>

@endsection