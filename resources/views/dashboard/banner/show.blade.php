@extends('dashboard/layout')

@section('contents')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Show Category</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('banner.index') }}"> Back</a>
            </div>
        </div>
    </div>

    <div class="row">
        <h2 class="col-xs-6 col-sm-6 col-md-6">
            <div class="form-group">
                <strong>Banner title : </strong>
                {{ $banner->title }}
            </div>
            <div class="form-group">
                <strong>Price : </strong>
                {{ $banner->details }}
            </div>
            <div class="form-group">
                <strong>Status : </strong>
                {{$banner->isShown == 1 ? "Shown" : "Not Shown"}}
            </div>


        </h2>
        <div class="col-xs-6 col-sm-6 col-md-6">
            @php
                $photo = asset("xBannerImage/" . $banner->photo);
            @endphp
            <img src="{{ $photo }}" width="300" alt="">
        </div>
    </div>

@endsection
