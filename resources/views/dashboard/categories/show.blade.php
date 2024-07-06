@extends('dashboard/layout')

@section('contents')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Show Category</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('categories.index') }}"> Back</a>
            </div>
        </div>
    </div>

    <div class="row">
        <h2 class="col-xs-6 col-sm-6 col-md-6">
            <div class="form-group">
                <strong>Category Name : </strong>
                {{ $category->categoryName }}
            </div>
        </h2>
    </div>

@endsection
