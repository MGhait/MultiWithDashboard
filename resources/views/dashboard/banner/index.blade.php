@extends('dashboard/layout')

@section('contents')
    <h1>
        banner index
    </h1>
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <a class="btn btn-success" href="{{ route('banner.create') }}">Create New Product</a>
    @if (count($banners) == 0)
        <h3>no Products saved yet</h3>
    @else
        <table class="table table-striped table-bordered" style="margin: 0 auto; width: 77%;">
            <tr>
                <th>no</th>
                <th>Slide title</th>
                <th>Slide Details</th>
                <td>Slide Link</td>
                <th>Operations</th>
            </tr>
            @foreach ($banners as $banner)
                <tr>
                    <td>
                        {{ ++$i }}
                    </td>
                    <td>
                        {{ $banner->title }}
                    </td>
                    <td>
                        {{ $banner->details }}
                    </td>
                    <td>
                        {{ $banner->link }}
                    </td>

                    <td>
                        <form action="{{ route('banner.destroy',$banner->id) }}" method="POST" style="display: inline;">

                            <a class="btn btn-info" href="{{ route('banner.show', $banner->id) }}">Show</a>

                            <a class="btn btn-primary" href="{{ route('banner.edit', $banner->id) }}">Edit</a>

                            @csrf
                            @method('DELETE')

                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>

                        {{-- ------------------------------- --}}

                        <form action="{{ route('banner.isShown', $banner->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('POST')
                            @if ($banner->isShown == 0)
                                <button type="submit" class="btn btn-secondary">Active</button>
                            @else
                                <button type="submit" class="btn btn-warning">DeActive</button>
                            @endif
                        </form>

                    </td>

                </tr>
            @endforeach
        </table>

        <div id="paginationNumbers">
            {!! $banners->links('pagination::bootstrap-4') !!}
        </div>

    @endif
@endsection
