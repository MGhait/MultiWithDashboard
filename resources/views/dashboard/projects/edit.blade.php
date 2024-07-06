@extends('dashboard/layout')

@section('contents')
    <h2>
        Edit banner
    </h2>
    <div class="pull-right">
        <a class="btn btn-primary" href="{{ route('projects.index') }}"> Back</a>
    </div>


    <h3>
        <form id="CreateForm" action="{{ route('projects.update', $project->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method("PUT")

            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Project Title</strong>
                        <input type="text" name="title" class="form-control" placeholder="Project Title" value="{{ $project->title }}">
                    </div>
                    @error('title')
                        <h5 class="alert alert-danger">{{ $message }}</h5>
                    @enderror
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Project Brief</strong>
                        <input type="text" class="form-control" name="brief" placeholder="Project Brief" value="{{ $project->details }}">
                    </div>
                    @error('brief')
                        <h5 class="alert alert-danger">{{ $message }}</h5>
                    @enderror
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Project Photo</strong>
                        <input type="file" class="form-control" name="photo" placeholder="Product photo" onchange=" imageFilePreview (this);">
                    </div>
                    @error('photo')
                        <h5 class="alert alert-danger">{{ $message }}</h5>
                    @enderror
                </div>
                @php
                    $photo = asset("site/images/portfolio/" . $project->photo);
                @endphp
                <img id="imagePreview" alt="image Preview" style="max-width:150px; max-height:150px;" src="{{$photo}}">

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


