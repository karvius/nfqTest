@extends('layouts.app')
@section('title', '| Search Results')

@section('content')



    <h1>Search Results:</h1>
    <div class="container-fluid">
        <form action="{{ route('queries.search') }}" class="form navbar-form navbar-nav">
            {{ csrf_field() }}
            <input type="text" name="search" id="search" class="form-control" placeholder="{{ $query }}">
            <input type="submit" value="Search" class="btn btn-success">
        </form>
    </div>

    @if (count($results) === 0)
        <h4>No orders match your query.</h4>
    @elseif (count($results) >= 1)
        <h4>Total results: {{$results->count() }}</h4>
        <div class="table-responsive">
            <table class="table table-bordered">
                <tr>
                    <th width="80px">@sortablelink('id', 'ID')</th>
                    <th>@sortablelink('first_name', 'First Name')</th>
                    <th>@sortablelink('last_name', 'Last Name')</th>
                    <th>@sortablelink('email', 'E-mail')</th>
                    <th>@sortablelink('details', 'Details')</th>
                    <th>@sortablelink('created_at', 'Date')</th>
                </tr>

                @if($results->count())
                    @foreach($results as $order)
                        <tr>
                            <td>{{ $order->id }}</td>
                            <td>{{ $order->first_name }}</td>
                            <td>{{ $order->last_name }}</td>
                            <td>{{ $order->email }}</td>
                            <td>{{ substr(strip_tags($order->details), 0, 50) }} {{ strlen(strip_tags($order->details)) > 50 ? "..." : "" }}</td>
                            <td>{{ $order->created_at->format('d-m-Y') }}</td>
                            <td><a href="{{ route('orders.show', $order->id) }}" class="btn btn-default">Details</a></td>
                        </tr>
                    @endforeach
                @endif
            </table>
        </div>

        <div class="text-center">
            {{ $results->appends(\Request::except('page'))->links() }}
        </div>
    @endif

@endsection
