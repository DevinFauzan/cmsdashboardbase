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
                            <h1 class="mb-5">1</h1>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 stretch-card grid-margin">
                    <div class="card card-img-holder-progress text-center">
                        <div class="card-body btn btn-sm mdi-24px tablinks" onclick="openCity(event, 'progress')">
                            <h4 class="font-weight-normal mb-3">Progress <i
                                    class="mdi mdi-progress-clock mdi-24px float-right"></i>
                            </h4>
                            <h1 class="mb-5">5</h1>
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
                            <h1 class="mb-5">4</h1>
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
                            <h1 class="mb-5">4</h1>
                        </div>
                    </div>
                </div>
            </div>
            {{-- TAB CONTENT HERE --}}
            <div class="col-12 grid-margin">
                <div class="card tabcontent" id="open">
                    <div class="card-body">
                        <h4 class="card-title">Open Ticket</h4>
                        <div class="table-responsive">
                            <table id="example" class="table table-striped" style="width:100%">
                                <thead>
                                    <tr>
                                        <th> Assignee </th>
                                        <th> Subject </th>
                                        <th> Status </th>
                                        <th> Submited </th>
                                        <th> Tracking ID </th>
                                        <th>Assign Ticket</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($ticket as $t)
                                        <tr>
                                            <td>
                                                {{-- <img src="{{ asset('assets/auth/images/faces/face4.jpg') }}" class="me-2" alt="image"> --}}
                                                {{ $t->name_user }}
                                            </td>
                                            <td>{{ $t->subject }}</td>
                                            <td>
                                                <label class="badge badge-gradient-info">{{ $t->status }}</label>
                                            </td>
                                            <td>{{ $t->ticket_id }}</td>
                                            <td>{{ $t->created_at }}</td>
                                            <td>
                                                <button class="btn btn-primary btn-sm mdi-24px text-white"
                                                    data-bs-toggle="modal" data-bs-target="#modalOpen"
                                                    data-ticket-id="{{ $t->id }}">
                                                    assign
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>

                            </table>
                        </div>
                    </div>
                </div>
                <div class="card tabcontent" id="progress">
                    <div class="card-body">
                        <h4 class="card-title">progress Ticket</h4>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th> Assignee </th>
                                        <th> Assigned By </th>
                                        <th> Subject </th>
                                        <th> Status </th>
                                        <th> Last Update </th>
                                        <th> Tracking ID </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <img src="{{ asset('assets/auth/images/faces/face1.jpg') }}" class="me-2"
                                                alt="image">
                                            Davcccccc
                                        </td>
                                        <td>
                                            <img src="{{ asset('assets/auth/images/faces/face1.jpg') }}" class="me-2"
                                                alt="image">
                                            RudiRudiRudiRudi
                                        </td>
                                        <td> Fund is not recieved </td>
                                        <td>
                                            <label class="badge badge-gradient-warning">Progress</label>
                                        </td>
                                        <td> Dec 5, 2017 </td>
                                        <td> WD-12345 </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="card tabcontent" id="pending">
                    <div class="card-body">
                        <h4 class="card-title">Pending Ticket</h4>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th> Assignee </th>
                                        <th> Assigned By </th>
                                        <th> Subject </th>
                                        <th> Status </th>
                                        <th> Last Update </th>
                                        <th> Tracking ID </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <img src="{{ asset('assets/auth/images/faces/face2.jpg') }}" class="me-2"
                                                alt="image">
                                            Stella Johnson
                                        </td>
                                        <td>
                                            <img src="{{ asset('assets/auth/images/faces/face2.jpg') }}" class="me-2"
                                                alt="image">
                                            Johnson
                                        </td>
                                        <td> High loading time </td>
                                        <td>
                                            <label class="badge badge-gradient-danger">Pending</label>
                                        </td>
                                        <td> Dec 12, 2017 </td>
                                        <td> WD-12346 </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="card tabcontent" id="solved">
                    <div class="card-body">
                        <h4 class="card-title">Solved Ticket</h4>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th> Assignee </th>
                                        <th> Assigned By </th>
                                        <th> Subject </th>
                                        <th> Status </th>
                                        <th> Last Update </th>
                                        <th> Tracking ID </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <img src="{{ asset('assets/auth/images/faces/face3.jpg') }}" class="me-2"
                                                alt="image">
                                            Marina Michel
                                        </td>
                                        <td>
                                            <img src="{{ asset('assets/auth/images/faces/face3.jpg') }}" class="me-2"
                                                alt="image">
                                            Marina Michel
                                        </td>
                                        <td> Website down for one week </td>
                                        <td>
                                            <label class="badge badge-gradient-success">Solved</label>
                                        </td>
                                        <td> Dec 16, 2017 </td>
                                        <td> WD-12347 </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal" id="modalOpen" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-xl row">
                    <div class="modal-content ">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Ticket #ID093209831</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body row">
                            <div class="col-6 grid-margin stretch-card ">
                                <div class="card">
                                    <div class="card-body">
                                        <form class="forms-sample">
                                            <div class="form-group">
                                                <label for="exampleInputName1">Subject</label>
                                                <input type="text" class="form-control" id="exampleInputName1"
                                                    placeholder="subject" readonly>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleTextarea1">Description</label>
                                                <textarea class="form-control" id="exampleTextarea1" rows="4" readonly></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleSelectProduct">Product</label>
                                                <select class="form-control" id="exampleSelectProduct" disabled>
                                                    <option disabled selected>select product type</option>
                                                    <option>Tableau Server</option>
                                                    <option>Tableau Online</option>
                                                    <option>Tableau Desktop</option>
                                                    <option>Tableau Prep Builder</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputEmail3">Email address</label>
                                                <input type="email" class="form-control" id="exampleInputEmail3"
                                                    placeholder="Email" readonly>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputTelp">Telephone</label>
                                                <input type="number_format" class="form-control" id="exampleInputTelp"
                                                    placeholder="08xxxxx" value="{{ $ticket->phone }}" readonly>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputName1">Complained date</label>
                                                <input type="date" class="form-control" id="exampleInputName1"
                                                    placeholder="date" readonly>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6 grid-margin stretch-card ">
                                <div class="card">
                                    <div class="card-body">
                                        @foreach ($ticket as $ticket)
                                            <h4 class="card-title">Ticket #{{ $ticket->ticket_id }}</h4>
                                            <p class="card-description">Select Technical person to solve this ticket</p>
                                            <div class="table-responsive">
                                                <table class="table text-center">
                                                    <thead>
                                                        <tr>
                                                            <th> Name </th>
                                                            <th> Case Total </th>
                                                            <th> Status </th>
                                                            <th> Action </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($Users as $user)
                                                            <tr>
                                                                <td>{{ $user->name }}</td>
                                                                <td>0</td>
                                                                <td>
                                                                    <label
                                                                        class="badge badge-gradient-success">Free</label>
                                                                </td>
                                                                <td>
                                                                    <form
                                                                        action="{{ route('tickets.assign', ['ticket' => $ticket->ticket_id, 'user' => $user->id]) }}"
                                                                        method="post">
                                                                        @csrf
                                                                        @method('PUT')
                                                                        <button type="submit"
                                                                            class="btn btn-sm btn-primary">
                                                                            Assign
                                                                        </button>
                                                                    </form>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        @endforeach
                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>
                    {{-- <div class="modal-footer">
                        <button type="button" class="btn btn-primary">Submit</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div> --}}
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

    <script>
        $(document).ready(function() {
            // Handle the click event of the "Assign" button
            $('.assign-button').on('click', function() {
                // Get the ticket ID from the data attribute
                var ticketId = $(this).data('ticket-id');

                // AJAX request to fetch ticket details
                $.ajax({
                    url: '/tickets/' + ticketId + '/details', // Update the URL based on your routes
                    type: 'GET',
                    success: function(response) {
                        // Update the modal content with the fetched details
                        $('#modalOpen .modal-body').html(response);
                    },
                    error: function(error) {
                        console.log(error);
                    }
                });
            });
        });
    </script>


    <script src="https://cdn.datatables.net/v/bs5/dt-1.13.8/datatables.min.js"></script>
