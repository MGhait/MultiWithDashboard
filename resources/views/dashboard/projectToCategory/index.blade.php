@extends('dashboard/layout')

@section('contents')
    <h1>
        Projects to category
    </h1>
    @if (count($pToc) == 0)
        <h3>No projects assigned to categories yet !!!</h3>
    @else
        <div>
            <table class="table table-striped table-bordered" style="margin: 0 auto; width: 55%;">
                <tr>
                    <th>Project title</th>
                    <th>Category name</th>
                </tr>
                @foreach ($pToc as $item)
                    <tr>
                        <td>{{$item->ProjectName}}</td>
                        <td>{{$item->CategoryName}}</td>
                    </tr>
                @endforeach
            </table>
        </div>

    @endif

    <form action="{{ route('storeprojecttocategory') }}" method="POST">
        @csrf
        @method('post')

        <select class="form-select mb-3" name="projectId" id="">
            @foreach ($projects as $oneProject)
                <option value="{{$oneProject->id}}">{{$oneProject->title}}</option>
            @endforeach
        </select>

        <select class="form-select mb-3" name="categoryId" id="">
            @foreach ($categories as $oneCategory)
                <option value="{{$oneCategory->id}}">{{$oneCategory->categoryName}}</option>
            @endforeach
        </select>

        <button class="btn btn-success">Assign Project to A category</button>
    </form>
@endsection
