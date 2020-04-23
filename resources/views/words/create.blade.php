@extends('layouts.app')


@section('css')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/css/select2.min.css" rel="stylesheet"/>
@endsection
@section('content')


 <div class="container">
    
         <h1 class="display-3">Create New Word </h1>
  

     <div class="col-md-12">
         <form action= " {{route('words.store')}} " method="post" enctype="multipart/form-data"> 
            @csrf
             <div class="form-group">
                 <label for="name">Name</label>
                 <textarea name="name" id="" cols="30" rows="2" class="form-control" class="@error('name') is-invalid @enderror"> {{old('name')}} </textarea>
                 @error('name')
                    <div class="alert alert-danger">{{ $message }}</div>
                 @enderror
             </div>
             <div class="form-group {{ $errors->has('tags') ? 'has-error' : ''}}">
                {!! Form::label('categories','Categories:') !!}
                <select class="form-control" id="addcategory"  name="category_name">
                    @foreach($categories as $category)
                    <option value="{{$category->name}}"> {{$category->name}} </option>
                    @endforeach
                </select>
                {!! $errors->first('categories', '<p class="help-block text-danger ">:message</p>') !!}
            </div>
            <div class="form-group">
                <label for="image">Image</label>
                <input type="text" name="image" id="" class="form-control" value="{{old('image')}}" class="@error('image') is-invalid @enderror">
                @error('image')
               <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            

            <div class="form-group">
                <label for="audio">Audio</label>
                <input type="text" name="audio" id="" class="form-control" value="{{old('audio')}}" class="@error('audio') is-invalid @enderror">
                @error('audio')
               <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div>
                <button type="submit" class="btn btn-success">Create Word</button>
            </div>
           
         </form>
     </div>


 </div>
 @section('js')
 <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/js/select2.min.js"></script>


 <script>
 
 $(document).ready(function() {
   $('#addcategory').select2();
   });
 </script>
 @endsection

@endsection
