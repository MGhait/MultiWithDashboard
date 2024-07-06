@extends('dashboard/layout')

@section('contents')
    <h2>
        Edit Category
    </h2>
    <div class="pull-right">
        <a class="btn btn-primary" href="{{ route('categories.index') }}"> Back</a>
    </div>


    <h3>
        <form id="CreateForm" action="{{ route('categories.update', $category->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method("PUT")

            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Category Name:</strong>
                        <input type="text" name="categoryName" class="form-control" placeholder="categoryName" value="{{ $category->categoryName }}">
                    </div>
                    @error('categoryName')
                        <h5 class="alert alert-danger">{{ $message }}</h5>
                    @enderror
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                        <br>
                        <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>

        </form>
    </h3>
@endsection

