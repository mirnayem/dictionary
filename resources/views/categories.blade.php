@extends('layouts.app')

@section('content')
<h1 class="text-center">All Categories</h1>
<div class="row d-flex justify-content-center">
 
            @foreach($categories->find('div.views-field.views-field-title') as $title)
   
             <h4 class="p-2"><span class="badge p-2"> <a target="_blank" href="/words/{{Str::slug($title->children(0)->children(0)->innertext)}}">{{$title->children(0)->children(0)->innertext}}</a></span></h4>
           
           @endforeach

</div>

@endsection