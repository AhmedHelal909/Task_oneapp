@extends('layouts.app')

@section('content')
<div class="container">
    <a href="" class="btn btn-primary btn-sm mb-3">Add Category</a>

    <table class="table">
        <thead class="thead-dark">
          <tr>
            <th scope="col">#</th>
            <th scope="col">name</th>
            <th scope="col">operation</th>
            
          </tr>
        </thead>
        <tbody>
            @php
                $i = 0;
            @endphp
        @foreach ( $category as $cat )
            
        <tr>
            
            <td scope="row">{{++$i}}</td>
            <td scope="row">{{$cat->name}}</td>
            <td scope="row">
                <a href="" class="btn btn-info btn-sm">Edit</a>
                <a href="" class="btn btn-danger btn-sm">Danger</a>
            </td>

            
        </tr>
        @endforeach
         
        </tbody>
      </table>
      
      
</div>
@endsection
