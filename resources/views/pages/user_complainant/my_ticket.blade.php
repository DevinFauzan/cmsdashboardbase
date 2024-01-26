@extends('layouts.auth')

@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="page-header">
                <h3 class="page-title">
                    My Ticket
                </h3>
            </div>
            <div class="row">
                <div class="col-12 grid-margin">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">
                                History Tickets
                                <a href="{{ route('new_ticket', ['user' => Auth::user()->id]) }}"
                                    class="btn btn-sm btn-primary mdi mdi-plus mdi-18px float-end text-center">
                                    New Ticket
                                </a>
                            </h4>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th> Assigned </th>
                                            <th> Subject </th>
                                            <th> Status </th>
                                            <th> Last Update </th>
                                            <th> Tracking ID </th>
                                            <th> Detail </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($allTickets as $ticket)
                                            <tr>
                                                <td>
                                                    {{ $ticket->name_tech }}
                                                </td>
                                                <td>{{ $ticket->subject }}</td>
                                                <td>
                                                    <label class="card-description badge badge- text-black">
                                                        @switch($ticket->status)
                                                            @case('Open')
                                                                <label class="badge badge-info">Open</label>
                                                            @break

                                                            @case('Progress')
                                                                <label class="badge badge-warning">Progress</label>
                                                            @break

                                                            @case('Pending')
                                                                <label class="badge badge-danger">Pending</label>
                                                            @break

                                                            @case('Solved')
                                                                <label class="badge badge-success">Solved</label>
                                                            @break

                                                            @default
                                                                <label class="badge badge-secondary">Unknown</label>
                                                        @endswitch
                                                    </label>
                                                </td>
                                                <td>{{ $ticket->created_at }}</td>
                                                <td>{{ $ticket->ticket_id }}</td>
                                                <td>
                                                    <a href="{{ route('detail_ticket_user.edit', ['id' => $ticket->id]) }}"
                                                        class="btn btn-info bg-gradient-info">
                                                        <span class="mdi mdi-details"></span>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
