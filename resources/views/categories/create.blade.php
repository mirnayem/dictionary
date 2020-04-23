@extends('layouts.app')

@section('content')
<h1 class="text-center">Add Category</h1>
<div class="">
    <form action= " {{route('categories.store')}} " method="post" enctype="multipart/form-data"> 
        @csrf
        <div class="form-group">
           
            <input type="text" name="name" id="" class="form-control" class="@error('name') is-invalid @enderror" value=" {{old('name')}} " >
            @error('name')
           <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
      
        <div>
            <button type="submit" class="btn btn-success">Create Category</button>
        </div>
       
     </form>


</div>

@endsection