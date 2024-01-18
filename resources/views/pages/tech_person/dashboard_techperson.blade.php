@extends('layouts.auth')

@section('content')
    <!-- partial -->
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="page-header">
                <h3 class="page-title">
                    <span class="page-title-icon bg-gradient-primary text-white me-2">
                        <i class="mdi mdi-home"></i>
                    </span> Dashboard Tech Peson
                </h3>
            </div>
            <div class="row">
                <div class="col-12 grid-margin">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Tickets List</h4>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th> Assignee </th>
                                            <th> Subject </th>
                                            <th> Status </th>
                                            <th> Last Update </th>
                                            <th> Ticket ID </th>
                                            <th> Detail </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($tickets as $ticket)
                                            <tr>
                                                <td>{{ $ticket->name_user }}</td>
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
                                                <td>{{ $ticket->updated_at }}</td>
                                                <td>{{ $ticket->ticket_id }}</td>
                                                <td>
                                                    <a href="{{ route('detail_ticket.edit', ['id' => $ticket->id]) }}"
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
        <!-- content-wrapper ends -->
    @endsection
