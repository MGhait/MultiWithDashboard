@extends('dashboard/layout')

@section('contents')
    <h1>
        Categories index
    </h1>
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <a class="btn btn-success" href="{{ route('categories.create') }}">Create New Category</a>
    @if (count($categories) == 0)
        <h3>no Categories saved yet</h3>
    @else
        <table class="table table-striped table-bordered" style="margin: 0 auto; width: 77%;">
            <tr>
                <th>no</th>
                <th>Category Name</th>
                <th>Operations</th>
            </tr>
            @foreach ($categories as $category)
                <tr>
                    <td>
                        {{ ++$i }}
                    </td>
                    <td>
                        {{ $category->categoryName }}
                    </td>

                    <td>
                        <form action="{{ route('categories.destroy',$category->id) }}" method="POST" style="display: inline;">

                            <a class="btn btn-info" href="{{ route('categories.show', $category->id) }}">Show</a>

                            <a class="btn btn-primary" href="{{ route('categories.edit', $category->id) }}">Edit</a>

                            @csrf
                            @method('DELETE')

                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>


                    </td>

                </tr>
            @endforeach
        </table>

        <div id="paginationNumbers">
            {!! $categories->links('pagination::bootstrap-4') !!}
        </div>

    @endif
@endsection
