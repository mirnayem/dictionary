@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-4">
          @include('inc.adminSidebar')

        </div>

        <div class="col-8">
            <h1 class="text-center"> {{Str::title(str_replace('-', ' ', $category_name))}} </h1>
            <table class="table">
                <thead>
                  <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Name</th>
                    <th scope="col">Edit</th>
                    <th scope="col">Created</th>
                    <th scope="col">Updated</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($words as $word)
                    <tr>
                        <th scope="row">{{$word->id}}</th>
                        <td>{{$word->name}}</td>
                        <td><a class="text-secondary" data-toggle="tooltip" data-placement="top" title="Edit {{$word->name}}" href=" {{route('words.edit',$word->id)}} ">Update </a></td>
                        <td>{{$word->created_at->diffForHumans()}}</td>
                        <td>{{$word->updated_at->diffForHumans()}}</td>
                        
                      </tr>
                    @endforeach
               
                 
              
                </tbody>
              </table>
        </div>
    </div>
@endsection