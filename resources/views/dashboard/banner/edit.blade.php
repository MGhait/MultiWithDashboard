@extends('dashboard/layout')

@section('contents')
    <h2>
        Edit banner
    </h2>
    <div class="pull-right">
        <a class="btn btn-primary" href="{{ route('banner.index') }}"> Back</a>
    </div>


    <h3>
        <form id="CreateForm" action="{{ route('banner.update', $banner->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method("PUT")

            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Banner Title:</strong>
                        <input type="text" name="title" class="form-control" placeholder="BannerTitle" value="{{ $banner->title }}">
                    </div>
                    @error('title')
                        <h5 class="alert alert-danger">{{ $message }}</h5>
                    @enderror
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Banner Details:</strong>
                        <input type="text" class="form-control" name="details" placeholder="Banner Details" value="{{ $banner->details }}">
                    </div>
                    @error('details')
                        <h5 class="alert alert-danger">{{ $message }}</h5>
                    @enderror
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Banner Link</strong>
                        <input type="text" class="form-control" name="link" placeholder="Banner Link" value="{{ $banner->link }}">
                    </div>
                    @error('link')
                    <h5 class="alert alert-danger">{{ $message }}</h5>
                    @enderror
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Banner Order</strong>
                        <input type="text" class="form-control" name="slideOrder" placeholder="Banner Order" value="{{ $banner->slideOrder }}">
                    </div>
                    @error('slideOrder')
                    <h5 class="alert alert-danger">{{ $message }}</h5>
                    @enderror
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Banner Photo:</strong>
                        <input type="file" class="form-control" name="photo" placeholder="Product photo" onchange=" imageFilePreview (this);">
                    </div>
                    @error('photo')
                        <h5 class="alert alert-danger">{{ $message }}</h5>
                    @enderror
                </div>
                @php
                    $photo = asset("site/images/slider/" . $banner->photo);
                @endphp
                <img id="imagePreview" alt="image Preview" style="max-width:150px; max-height:150px;" src="{{$photo}}">

                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-check form-switch">
                        @php
                            if($banner->isShown == 1) {
                                $status = "checked";
                            }
                            else {
                                $status = "";
                            }
                        @endphp
                        <input type="checkbox" class="form-check-input" name="isShown" {{$banner->isShown == 1 ? "checked" : ""}}>
                        is Active Banner
                        <label class="form-check-label" for="isShown">
                            is Active banner
                        </label>
                    </div>

                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                        <br>
                        <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>

        </form>
    </h3>
@endsection

<script>
    function imageFilePreview(inputFile){
        var file = inputFile.files[0];
        if(file){
            var reader = new FileReader();
            reader.onload = function(){
                document.getElementById("imagePreview").setAttribute("src", reader.result);
            }
            reader.readAsDataURL(file);
        }
    }
</script>


