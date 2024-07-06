@extends('dashboard/layout')

@section('contents')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Show Project</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('projects.index') }}"> Back</a>
            </div>
        </div>
    </div>

    <div class="row">
        <h2 class="col-xs-6 col-sm-6 col-md-6">
            <div class="form-group">
                <strong>Project title : </strong>
                {{ $project->title }}
            </div>
            <div class="form-group">
                <strong>Project brief : </strong>
                {{ $project->brief }}
            </div>



        </h2>
        <div class="col-xs-6 col-sm-6 col-md-6">
            @php
                $photo = asset("site/images/portfolio/" . $project->photo);
            @endphp
            <img src="{{ $photo }}" width="300" alt="">
        </div>
    </div>

@endsection
