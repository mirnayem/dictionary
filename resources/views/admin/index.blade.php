@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-4">
          @include('inc.adminSidebar')

        </div>

        <div class="col-8">
            <table class="table">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Words</th>
                    <th scope="col">Edit</th>
                    <th scope="col">Created</th>
                    <th scope="col">Updated</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($allCategory as $category)
                    <tr>
                        <th scope="row">{{$category->id}}</th>
                        <td>{{$category->name}}</td>
                    <td><a href="/admin/word/{{Str::slug($category->name)}}" data-toggle="tooltip" data-placement="top" title="See All Words of {{$category->name}}">See Words</a></td>
                        <td><a class="text-secondary" data-toggle="tooltip" data-placement="top" title="Edit {{$category->name}}" href=" {{route('categories.edit',$category->id)}} ">Update</a></td>
                        <td>{{$category->created_at->diffForHumans()}}</td>
                        <td>{{$category->updated_at->diffForHumans()}}</td>
                        
                      </tr>
                    @endforeach
               
                 
              
                </tbody>
              </table>
        </div>
    </div>
@endsection