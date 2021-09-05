@extends('layouts.app')

@section('content')
    <div class="container">
        <a href="" class="btn btn-primary btn-sm mb-3">Add Product</a>
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">name</th>
                    <th scope="col">price</th>
                    <th scope="col">category</th>
                    <th scope="col">Operation</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $i = 0;
                @endphp
                @foreach ($products as $pro)

                    <tr>

                        <td scope="row">{{ ++$i }}</td>
                        <td scope="row">{{ $pro->name }}</td>
                        <td scope="row">{{ $pro->price }}</td>
                        <td scope="row">
                            @foreach ($categories as $cat)
                                @if ($cat->id == $pro->category_id)
                                    {{ $cat->name }}
                                @endif
                            @endforeach


                        </td>
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
