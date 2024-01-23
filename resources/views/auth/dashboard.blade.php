@extends('layouts.auth')

<head>
    <link rel="stylesheet" href="//cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
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
                        <div id="openCard" class="card-body btn btn-sm mdi-24px tablinks"
                            onclick="openCity(event, 'open')">
                            <h4 class="font-weight-normal mb-3">Open <i
                                    class="mdi mdi-ticket-percent mdi-24px float-right"></i>
                            </h4>
                            <h1 id="openTickets" class="mb-5">{{ $openTickets }}</h1>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 stretch-card grid-margin">
                    <div class="card card-img-holder-progress text-center">
                        <div id="progressCard" class="card-body btn btn-sm mdi-24px tablinks"
                            onclick="openCity(event, 'Progress')">
                            <h4 class="font-weight-normal mb-3">Progress <i
                                    class="mdi mdi-progress-clock mdi-24px float-right"></i></h4>
                            <h1 id="progressTickets" class="mb-5">{{ $progressTickets }}</h1>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 stretch-card grid-margin">
                    <div class="card card-img-holder-pending text-center">
                        <div id="pendingCard" class="card-body btn btn-sm mdi-24px tablinks"
                            onclick="openCity(event, 'pending')">
                            <h4 class="font-weight-normal mb-3">Pending <i
                                    class="mdi mdi-account-clock-outline mdi-24px float-right"></i>
                            </h4>
                            <h1 id="pendingTickets" class="mb-5">{{ $pendingTickets }}</h1>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 stretch-card grid-margin">
                    <div class="card card-img-holder-solved text-center">
                        <div id="solvedCard" class="card-body btn btn-sm mdi-24px tablinks"
                            onclick="openCity(event, 'solved')">
                            <h4 class="font-weight-normal mb-3">Solved <i class="mdi mdi-check mdi-24px float-right"></i>
                            </h4>
                            <h1 id="solvedTickets" class="mb-5">{{ $solvedTickets }}</h1>
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
                            <table id="openTable" class="table table-striped" style="width:100%">
                                <thead>
                                    <tr>
                                        <th> Assignee </th>
                                        <th> Subject </th>
                                        <th> Status </th>
                                        <th> Submitted </th>
                                        <th> Tracking ID </th>
                                        <th> Info Ticket</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @include('partials.table')
                                </tbody>
                            </table>
                        </div>
                        
                    </div>
                </div>
                <div class="card tabcontent" id="Progress">
                    <div class="card-body">
                        <h4 class="card-title">Progress Ticket</h4>
                        <div class="table-responsive">
                            <table id="progressTable" class="table table-striped" style="width:100%">
                                <thead>
                                    <tr>
                                        <th> Assignee </th>
                                        <th> Assigned To </th>
                                        <th> Subject </th>
                                        <th> Status </th>
                                        <th> Submitted </th>
                                        <th> Tracking ID </th>
                                    </tr>
                                </thead>
                                    @include('partials.table_progress')
                            </table>
                        </div>
                    </div>
                </div>
                <div class="card tabcontent" id="pending">
                    <div class="card-body">
                        <h4 class="card-title">Pending Ticket</h4>
                        <div class="table-responsive">
                            <table id="pendingTable" class="table table-striped" style="width:100%">
                                <thead>
                                    <tr>
                                        <th> Assignee </th>
                                        <th> Assigned To </th>
                                        <th> Subject </th>
                                        <th> Status </th>
                                        <th> Submitted </th>
                                        <th> Tracking ID </th>
                                    </tr>
                                </thead>
                                    @include('partials.table_pending')                              
                            </table>
                        </div>
                    </div>
                </div>
                <div class="card tabcontent" id="solved">
                    <div class="card-body ">
                        <h4 class="card-title">Solved Ticket</h4>
                        <div class="table-responsive">
                            <table id="solvedTable" class="table table-striped" style="width:100%">
                                <thead>
                                    <tr>
                                        <th> Assignee </th>
                                        <th> Assigned To </th>
                                        <th> Subject </th>
                                        <th> Status </th>
                                        <th> Submitted </th>
                                        <th> Tracking ID </th>
                                    </tr>
                                </thead>
                                    @include('partials.table_solved')
                            </table>
                        </div>
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

        function refreshTable(tabId, routeName) {
            $.ajax({
                url: routeName,
                method: "GET",
                success: function(data) {
                    $("#" + tabId + " tbody").html(data.html);
                },
                error: function(xhr, status, error) {
                    console.error("Error refreshing table: " + error);
                }
            });
        }

        setInterval(function() {
            refreshTable("openTable", "{{ route('refresh.table') }}");
        }, 20000);

        setInterval(function() {
            refreshTable("progressTable", "{{ route('refresh.table_progress') }}");
        }, 20000);

        setInterval(function() {
            refreshTable("pendingTable", "{{ route('refresh.table_pending') }}");
        }, 20000);

        setInterval(function() {
            refreshTable("solvedTable", "{{ route('refresh.table_solved') }}");
        }, 20000);


        // Function to update ticket counts
        function updateTicketCounts() {
            $.ajax({
                url: "{{ route('refresh.ticket_counts') }}",
                method: "GET",
                dataType: 'json',
                success: function(data) {
                    $('#openTickets').text(data.openTickets);
                    $('#pendingTickets').text(data.pendingTickets);
                    $('#progressTickets').text(data.progressTickets);
                    $('#solvedTickets').text(data.solvedTickets);
                },
                error: function(xhr, status, error) {
                    console.error("Error updating ticket counts: " + error);
                }
            });
        }

        // Refresh ticket counts every 60 seconds (adjust as needed)
        setInterval(function() {
            updateTicketCounts();
        }, 1000);

        // Initial update
        updateTicketCounts();
    </script>
   
   @section('scripts')
   <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
   <script src="//cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
   <script>
       $(document).ready(function () {
           $('#openTable').DataTable();
       });
   </script>
   <script>
    $(document).ready(function () {
        $('#progressTable').DataTable();
    });
</script>
<script>
    $(document).ready(function () {
        $('#pendingTable').DataTable();
    });
</script>
<script>
    $(document).ready(function () {
        $('#solvedTable').DataTable();
    });
</script>
@endsection