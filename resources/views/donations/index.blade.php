@extends('dashboard', ['pageTitle' => '_camelUpper_casePlural_ &raquo; Index'])

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="pull-right raw-margin-top-24 raw-margin-left-24">
                {!! Form::open(['route' => 'donations.search']) !!}
                <input class="form-control form-inline pull-right" name="search" placeholder="Search">
                {!! Form::close() !!}
            </div>
            <h1 class="pull-left">Donations</h1>
            <a class="btn btn-primary pull-right raw-margin-top-24 raw-margin-right-8" href="{!! route('donations.create') !!}">Add New</a>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            @if ($donations->isEmpty())
                <div class="well text-center">No donations found.</div>
            @else
                <table class="table table-striped">
                    <thead>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Address1</th>
                        <th>Address2</th>
                        <th>City</th>
                        <th>Zip</th>
                        <th>Amount</th>
                        <th>Twitter</th>
                        <th>Term</th>
                        <th>Created_At</th>
                        <th class="text-right" width="200px">Action</th>
                    </thead>
                    <tbody>
                        @foreach($donations as $donation)
                            <tr>
                                <td>
                                    <a href="{!! route('donations.edit', [$donation->id]) !!}">{{ $donation->first_name }}</a>
                                </td>
                                <td>
                                    <a href="{!! route('donations.edit', [$donation->id]) !!}">{{ $donation->last_name }}</a>
                                </td>
                                <td>
                                    <a href="{!! route('donations.edit', [$donation->id]) !!}">{{ $donation->email }}</a>
                                </td>
                                <td>
                                    <a href="{!! route('donations.edit', [$donation->id]) !!}">{{ $donation->phone }}</a>
                                </td>
                                <td>
                                    <a href="{!! route('donations.edit', [$donation->id]) !!}">{{ $donation->address1 }}</a>
                                </td>
                                <td>
                                    <a href="{!! route('donations.edit', [$donation->id]) !!}">{{ $donation->address2 }}</a>
                                </td>
                                <td>
                                    <a href="{!! route('donations.edit', [$donation->id]) !!}">{{ $donation->city }}</a>
                                </td>
                                <td>
                                    <a href="{!! route('donations.edit', [$donation->id]) !!}">{{ $donation->zip }}</a>
                                </td>
                                <td>
                                    <a href="{!! route('donations.edit', [$donation->id]) !!}">{{ $donation->amount/100 }}</a>
                                </td>
                                <td>
                                    <a href="{!! route('donations.edit', [$donation->id]) !!}">{{ $donation->twitter }}</a>
                                </td>
                                <td>
                                    <a href="{!! route('donations.edit', [$donation->id]) !!}">{{ $donation->terms }}</a>
                                </td>
                                <td>
                                    <a href="{!! route('donations.edit', [$donation->id]) !!}">{{ $donation->created_at }}</a>
                                </td>
                                <td class="text-right">
                                    <form method="post" action="{!! route('donations.destroy', [$donation->id]) !!}">
                                        {!! csrf_field() !!}
                                        {!! method_field('DELETE') !!}
                                        <button class="btn btn-danger btn-xs pull-right" type="submit" onclick="return confirm('Are you sure you want to delete this donation?')"><i class="fa fa-trash"></i> Delete</button>
                                    </form>
                                    <a class="btn btn-default btn-xs pull-right raw-margin-right-16" href="{!! route('donations.edit', [$donation->id]) !!}"><i class="fa fa-pencil"></i> Edit</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 text-center">
            {!! $donations; !!}
            {!! $donations->first() !!}
        </div>
    </div>

@stop