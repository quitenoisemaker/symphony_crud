@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-4"> <a href="{{ route('item.create') }}" class="btn btn-success btn-sm m-1">Click
                    Here to Add Item</a>
            </div>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>
                    @php
                        $no = 0;
                    @endphp
                    <div class="card-body">
                        <table class="table table-striped">
                            @if (count($getItems) > 0)
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Description</th>
                                        <th scope="col">Image</th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($getItems as $getItem)
                                        @php
                                            $no++;
                                        @endphp
                                        <tr>
                                            <th scope="row">{{ $no }}</th>
                                            <td>{{ $getItem->name }}</td>
                                            <td>{{ $getItem->description }}</td>
                                            <td><img src="{{ URL::asset('storage/' . $getItem->image) }}" width="100">
                                            </td>
                                            <td><a href="{{ route('item.edit', ['id' => $getItem->id]) }}"
                                                    class="btn btn-primary">Edit</a>
                                            </td>
                                            <td>
                                                <form action="{{ url('item/delete', $getItem->id) }}" method="POST">
                                                    {{ method_field('DELETE') }}
                                                    @csrf
                                                    <button type="submit" class="btn btn-danger">Delete
                                                        Item</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            @else
                                <div class="text-center">{{ 'No Items, click on the button above to add Item' }}</div>
                            @endif
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
