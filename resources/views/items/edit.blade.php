@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Update Item</div>
                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form method="POST" action="{{ route('item.update', ['id' => $getItem->id]) }}"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="name">Name</label>
                                    <input type="text" class="form-control" value="{{ $getItem->name }}" name="name"
                                        id="name">
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="image">Image<span class="text-danger">*</span></label>
                                    <input type="file" class="form-control" name="image" id="image">
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="description">Description (Describe item) <span
                                            class="text-danger">*</span></label>
                                    <textarea class="form-control" maxlength="250" name="description" id="description" style="resize: none">{{ $getItem->description }}</textarea>
                                </div>
                            </div>
                            <br>
                            <button type="submit" class="btn btn-primary">Update Item</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
