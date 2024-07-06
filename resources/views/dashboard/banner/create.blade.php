@extends('dashboard/layout')



@section('contents')
    <h2>
        Create New banner
    </h2>

    {{-- @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif --}}

    <h3>
        <form id="CreateForm" action="{{ route('banner.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Banner Title:</strong>
                        <input type="text" name="title" class="form-control" placeholder="BannerTitle">
                    </div>
                    @error('title')
                        <h5 class="alert alert-danger">{{ $message }}</h5>
                    @enderror
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Banner Details:</strong>
                        <input type="text" class="form-control" name="details" placeholder="Banner Details">
                    </div>
                    @error('details')
                        <h5 class="alert alert-danger">{{ $message }}</h5>
                    @enderror
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Banner Link</strong>
                        <input type="text" class="form-control" name="link" placeholder="Banner Link">
                    </div>
                    @error('link')
                    <h5 class="alert alert-danger">{{ $message }}</h5>
                    @enderror
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Banner Order</strong>
                        <input type="number" class="form-control" name="slideOrder" placeholder="Banner Order">
                    </div>
                    @error('slideOrder')
                    <h5 class="alert alert-danger">{{ $message }}</h5>
                    @enderror
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Banner Photo:</strong>
                        <input type="file" class="form-control" name="photo" placeholder="banner photo" onchange=" imageFilePreview (this);">
                    </div>
                    @error('photo')
                        <h5 class="alert alert-danger">{{ $message }}</h5>
                    @enderror
                </div>

                <img id="imagePreview" alt="image Preview" style="max-width:150px; max-height:150px;">

                <div class="col-xs-12 col-sm-12 col-md-12">
{{--                    <label class="form-check-label" for="isShown">--}}
{{--                        is Shown Banner--}}
{{--                    </label>--}}
                    <div class="form-check form-switch">

                        <input type="checkbox" class="form-check-input" name="isShown">
                        is Shown Banner

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


