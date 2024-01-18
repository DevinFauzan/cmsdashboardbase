@extends('layouts.auth')

@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="page-header">
                <h2 class="page-title text-center">
                    <a href="javascript:history.back()" class="page-title-icon bg-gradient-primary text-white me-2">
                        <i class="mdi mdi-arrow-left"></i>
                    </a>                    
                    {{ $ticket->ticket_id }} | {{ $ticket->name_user }} | {{ $ticket->name_tech }}
                </h2>
            </div>
            <div class="row">
                <div class="col-6 grid-margin stretch-card ">
                    <div class="card">
                        <div class="card-body">
                            <form class="forms-sample">
                                <div class="form-group">
                                    <label for="exampleInputName1">Subject</label>
                                    <input type="text" class="form-control" value="{{ $ticket->subject }}" id="exampleInputName1" placeholder="subject"
                                        readonly>
                                </div>
                                <div class="form-group">
                                    <label for="exampleTextarea1">Description</label>
                                    <textarea class="form-control" id="exampleTextarea1" rows="4" readonly>{{ $ticket->description }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="exampleSelectProduct">Product</label>
                                    <select class="form-control" id="exampleSelectProduct" disabled>
                                        <option disabled selected>select product type</option>
                                        <option value="0" {{ $ticket->product == 0 ? 'selected' : '' }}>Tableau Server</option>
                                        <option value="1" {{ $ticket->product == 1 ? 'selected' : '' }}>Tableau Online</option>
                                        <option value="2" {{ $ticket->product == 2 ? 'selected' : '' }}>Tableau Desktop</option>
                                        <option value="3" {{ $ticket->product == 3 ? 'selected' : '' }}>Tableau Prep Builder</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail3">Email address</label>
                                    <input type="email" value="{{ $ticket->email }}" class="form-control" id="exampleInputEmail3" placeholder="Email"
                                        readonly>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputTelp">Telephone</label>
                                    <input type="number_format" value="{{ $ticket->phone }}" class="form-control" id="exampleInputTelp"
                                        placeholder="08xxxxx" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputName1">Complained date</label>
                                    <input type="date" value="{{ $ticket->created_at->format('Y-m-d') }}"  class="form-control" id="exampleInputName1" placeholder="date"
                                        readonly>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-6 grid-margin stretch-card ">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Ticket {{ $ticket->ticket_id }}</h4>
                            <p class="card-description">Select Technical person to solve this ticket</p>
                            <div class="table-responsive">
                                @include('partials.table_user_tech')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    function refreshAssignedTable(ticketId) {
        $.ajax({
            url: `/refresh-assigned-table/${ticketId}`,
            method: "GET",
            success: function (data) {
                $("#assignedTable").html(data.html);
            },
            error: function (xhr, status, error) {
                console.error("Error refreshing assigned table: " + error);
            }
        });
    }

    setInterval(function () {
        refreshAssignedTable({{ $ticket->id }});
    }, 1000);
</script>

