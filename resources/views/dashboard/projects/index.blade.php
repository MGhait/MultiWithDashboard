@extends('dashboard/layout')

@section('contents')
    <h1>
        Projects index
    </h1>
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <a class="btn btn-success" href="{{ route('projects.create') }}">Create New Product</a>
    @if (count($projects) == 0)
        <h3>no Products saved yet</h3>
    @else
        <table class="table table-striped table-bordered" style="margin: 0 auto; width: 77%;">
            <tr>
                <th>no</th>
                <th>Project title</th>
                <th>Project Brief</th>
                <th>Operations</th>
            </tr>
            @foreach ($projects as $project)
                <tr>
                    <td>
                        {{ ++$i }}
                    </td>
                    <td>
                        {{ $project->title }}
                    </td>
                    <td>
                        {{ $project->brief }}
                    </td>

                    <td>
                        <form action="{{ route('projects.destroy',$project->id) }}" method="POST" style="display: inline;">

                            <a class="btn btn-info" href="{{ route('projects.show', $project->id) }}">Show</a>

                            <a class="btn btn-primary" href="{{ route('projects.edit', $project->id) }}">Edit</a>

                            @csrf
                            @method('DELETE')

                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>

                    </td>

                </tr>
            @endforeach
        </table>

        <div id="paginationNumbers">
            {!! $projects->links('pagination::bootstrap-4') !!}
        </div>

    @endif
@endsection
