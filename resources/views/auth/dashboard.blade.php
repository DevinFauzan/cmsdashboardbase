@extends('layouts.auth')


<link href="https://cdn.datatables.net/v/bs5/dt-1.13.8/datatables.min.css" rel="stylesheet">

<style>
    body {
        font-family: Arial;
    }

    /* Style the tab */
    .tab {
        overflow: hidden;
        border: 1px solid #ccc;
        background-color: #f1f1f1;
    }

    /* Style the buttons inside the tab */
    .tab button {
        background-color: inherit;
        float: left;
        border: none;
        outline: none;
        cursor: pointer;
        padding: 14px 16px;
        transition: 0.3s;
        font-size: 17px;
    }

    /* Change background color of buttons on hover */
    .tab button:hover {
        background-color: #ddd;
    }

    /* Create an active/current tablink class */
    .tab button.active {
        background-color: #ccc;
    }

    /* Style the tab content */
    .tabcontent {
        display: none;
        padding: 6px 12px;
        border: 1px solid #ccc;
        border-top: none;
    }

    .card-img-holder-open:hover {
        background: #54B4D3;
    }

    .card-img-holder-progress:hover {
        background: #E4A11B;
    }

    .card-img-holder-pending:hover {
        background: #DC4C64;
    }

    .card-img-holder-solved:hover {
        background: #14A44D;
    }

    .card-img-holder-open:hover h4 {
        color: white;
    }

    .card-img-holder-open:hover h1 {
        color: white;
    }

    .card-img-holder-progress:hover h4 {
        color: white;
    }

    .card-img-holder-progress:hover h1 {
        color: white;
    }

    .card-img-holder-pending:hover h4 {
        color: white;
    }

    .card-img-holder-pending:hover h1 {
        color: white;
    }

    .card-img-holder-solved:hover h4 {
        color: white;
    }

    .card-img-holder-solved:hover h1 {
        color: white;
    }
</style>


@section('content')
    <!-- partial -->
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="page-header">
                <h3 class="page-title">
                    <button class="page-title-icon bg-gradient-primary text-white me-2">
                        <i class="mdi mdi-home"></i>
                    </button class="text-black"> Dashboard
                </h3>
            </div>
            <div class="row">
                <div class="col-md-3 stretch-card grid-margin">
                    <div class="card card-img-holder-open text-center">
                        <div class="card-body btn btn-sm mdi-24px tablinks" onclick="openCity(event, 'open')">
                            {{-- <img src="{{ asset('assets/auth/images/dashboard/circle.svg') }}" class="card-img-absolute"
                                alt="circle-image" /> --}}
                            <h4 class="font-weight-normal mb-3">Open <i
                                    class="mdi mdi-ticket-percent mdi-24px float-right"></i>
                            </h4>
                            <h1 class="mb-5">{{ $openTickets }}</h1>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 stretch-card grid-margin">
                    <div class="card card-img-holder-progress text-center">
                        <div class="card-body btn btn-sm mdi-24px tablinks" onclick="openCity(event, 'progress')">
                            <h4 class="font-weight-normal mb-3">Progress <i
                                    class="mdi mdi-progress-clock mdi-24px float-right"></i>
                            </h4>
                            <h1 class="mb-5">{{ $progressTickets }}</h1>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 stretch-card grid-margin">
                    <div class="card card-img-holder-pending text-center">
                        <div class="card-body btn btn-sm mdi-24px tablinks" onclick="openCity(event, 'pending')">
                            {{-- <img src="{{ asset('assets/auth/images/dashboard/circle.svg') }}" class="card-img-absolute"
                                alt="circle-image" /> --}}
                            <h4 class="font-weight-normal mb-3">Pending <i
                                    class="mdi mdi-account-clock-outline mdi-24px float-right"></i>
                            </h4>
                            <h1 class="mb-5">{{ $pendingTickets }}</h1>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 stretch-card grid-margin">
                    <div class="card card-img-holder-solved text-center">
                        <div class="card-body btn btn-sm mdi-24px tablinks" onclick="openCity(event, 'solved')">
                            {{-- <img src="{{ asset('assets/auth/images/dashboard/circle.svg') }}" class="card-img-absolute"
                                alt="circle-image" /> --}}
                            <h4 class="font-weight-normal mb-3">Solved <i class="mdi mdi-check mdi-24px float-right"></i>
                            </h4>
                            <h1 class="mb-5">{{ $solvedTickets }}</h1>
                        </div>
                    </div>
                </div>
            </div>
            {{-- TAB CONTENT HERE --}}
            <div class="col-12 grid-margin">
                <div class="card tabcontent" id="open">
                    <div class="card-body">
                        <h4 class="card-title">Open Ticket</h4>
                        @if ($ticket->where('status', 'Open')->isEmpty())
                        <p class="text-center">There is no data</p>
                    @else
                            <div class="table-responsive">
                                <table id="example" class="table table-striped" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th> Assignee </th>
                                            <th> Subject </th>
                                            <th> Status </th>
                                            <th> Submited </th>
                                            <th> Tracking ID </th>
                                            <th> Info Ticket</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($ticket as $t)
                                            @if ($t->name_tech == '')
                                                <tr>
                                                    <td>
                                                        {{-- <img src="{{ asset('assets/auth/images/faces/face4.jpg') }}" class="me-2" alt="image"> --}}
                                                        {{ $t->name_user }}
                                                    </td>
                                                    <td>{{ $t->subject }}</td>
                                                    <td>
                                                        <label class="badge badge-gradient-info">{{ $t->status }}</label>
                                                    </td>
                                                    <td>{{ $t->created_at }}</td>
                                                    <td>{{ $t->ticket_id }}</td>
                                                    <td>
                                                        <button class="btn btn-primary btn-sm mdi-24px text-white"
                                                            onclick="window.location.href='{{ route('admin_ticket_detail.edit', ['id' => $t->id]) }}'">
                                                            Info
                                                        </button>
                                                    </td>
                                                </tr>
                                            @else
                                            @endif
                                        @endforeach
                                    </tbody>

                                </table>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="card tabcontent" id="progress">
                    <div class="card-body">
                        <h4 class="card-title">Progress Ticket</h4>
                        @if ($ticket->where('status', 'Progress')->isEmpty())
                            <p class="text-center">There is no data</p>
                        @else
                            <div class="table-responsive">
                                <table id="example" class="table table-striped" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th> Assignee </th>
                                            <th> Assigned To </th>
                                            <th> Subject </th>
                                            <th> Status </th>
                                            <th> Submited </th>
                                            <th> Tracking ID </th>
                                            {{-- <th> Assign Ticket </th> --}}
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($ticket as $t)
                                            @if ($t->status === 'Progress')
                                                <tr>
                                                    <td>
                                                        {{-- <img src="{{ asset('assets/auth/images/faces/face4.jpg') }}" class="me-2" alt="image"> --}}
                                                        {{ $t->name_user }}
                                                    </td>
                                                    <td>
                                                        {{ $t->name_tech }}
                                                    </td>
                                                    <td>{{ $t->subject }}</td>
                                                    <td>
                                                        <label
                                                            class="badge badge-gradient-warning text-black">{{ $t->status }}</label>
                                                    </td>
                                                    <td>{{ $t->created_at }}</td>
                                                    <td>{{ $t->ticket_id }}</td>
                                                    {{-- <td>
                                                    <button class="btn btn-primary btn-sm mdi-24px text-white"
                                                        onclick="window.location.href='{{ route('admin_ticket_detail.edit', ['id' => $t->id]) }}'">
                                                        assign
                                                    </button>
                                                </td> --}}
                                                </tr>
                                            @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="card tabcontent" id="pending">
                    <div class="card-body">
                        <h4 class="card-title">Pending Ticket</h4>
                        @if ($ticket->where('status', 'Pending')->isEmpty())
                            <p class="text-center">There is no data</p>
                        @else
                            <div class="table-responsive">
                                <table id="example" class="table table-striped" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th> Assignee </th>
                                            <th> Assigned To </th>
                                            <th> Subject </th>
                                            <th> Status </th>
                                            <th> Submited </th>
                                            <th> Tracking ID </th>
                                            {{-- <th> Assign Ticket </th> --}}
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($ticket as $t)
                                            @if ($t->status === 'Pending')
                                                <tr>
                                                    <td>
                                                        {{-- <img src="{{ asset('assets/auth/images/faces/face4.jpg') }}" class="me-2" alt="image"> --}}
                                                        {{ $t->name_user }}
                                                    </td>
                                                    <td>
                                                        {{ $t->name_tech }}
                                                    </td>
                                                    <td>{{ $t->subject }}</td>
                                                    <td>
                                                        <label
                                                            class="badge badge-gradient-danger">{{ $t->status }}</label>
                                                    </td>
                                                    <td>{{ $t->created_at }}</td>
                                                    <td>{{ $t->ticket_id }}</td>
                                                    {{-- <td>
                                                    <button class="btn btn-primary btn-sm mdi-24px text-white"
                                                        onclick="window.location.href='{{ route('admin_ticket_detail.edit', ['id' => $t->id]) }}'">
                                                        assign
                                                    </button>
                                                </td> --}}
                                                </tr>
                                            @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="card tabcontent" id="solved">
                    <div class="card-body ">
                        <h4 class="card-title">Solved Ticket</h4>
                        @if ($ticket->where('status', 'Solved')->isEmpty())
                            <p class="text-center">There is no data</p>
                        @else
                            <div class="table-responsive">
                                <table id="example" class="table table-striped" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th> Assignee </th>
                                            <th> Assigned To </th>
                                            <th> Subject </th>
                                            <th> Status </th>
                                            <th> Submited </th>
                                            <th> Tracking ID </th>
                                            {{-- <th> Assign Ticket </th> --}}
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($ticket as $t)
                                            @if ($t->status === 'Solved')
                                                <tr>
                                                    <td>
                                                        {{-- <img src="{{ asset('assets/auth/images/faces/face4.jpg') }}" class="me-2" alt="image"> --}}
                                                        {{ $t->name_user }}
                                                    </td>
                                                    <td>
                                                        {{ $t->name_tech }}
                                                    </td>
                                                    <td>{{ $t->subject }}</td>
                                                    <td>
                                                        <label
                                                            class="badge badge-gradient-success">{{ $t->status }}</label>
                                                    </td>
                                                    <td>{{ $t->created_at }}</td>
                                                    <td>{{ $t->ticket_id }}</td>
                                                    {{-- <td>
                                                    <button class="btn btn-primary btn-sm mdi-24px text-white"
                                                        onclick="window.location.href='{{ route('admin_ticket_detail.edit', ['id' => $t->id]) }}'">
                                                        assign
                                                    </button>
                                                </td> --}}
                                                </tr>
                                            @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <!-- content-wrapper ends -->
    @endsection

    <script>
        function openCity(evt, cityName) {
            var i, tabcontent, tablinks;
            tabcontent = document.getElementsByClassName("tabcontent");
            for (i = 0; i < tabcontent.length; i++) {
                tabcontent[i].style.display = "none";
            }
            tablinks = document.getElementsByClassName("tablinks");
            for (i = 0; i < tablinks.length; i++) {
                tablinks[i].className = tablinks[i].className.replace(" active", "");
            }
            document.getElementById(cityName).style.display = "block";
            evt.currentTarget.className += " active";
        }
    </script>

    <script src="https://cdn.datatables.net/v/bs5/dt-1.13.8/datatables.min.js"></script>

    <!-- Include jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Include jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
