@extends('layouts.app')

@section('content')
<h1 class="text-center">All Categories</h1>
<div class="row d-flex justify-content-center">
 
            @foreach($categories as $category)
             
             <h4 class="p-2"><span class="badge p-2"> <a href="/categories/word/{{Str::slug($category->name)}}">{{Str::upper($category->name)}}</a></span></h4>
           
           @endforeach

</div>

@endsection