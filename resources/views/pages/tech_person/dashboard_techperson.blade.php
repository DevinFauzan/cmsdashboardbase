@extends('layouts.auth')

<head>
    <link rel="stylesheet" href="//cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<style>
    .dataTables_filter {
        display: none;
    }
</style>
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
                            <div class="d-flex justify-content-end mb-3">
                                <div class="col-3">
                                    <input type="text" id="search-techperson" class="form-control"
                                        placeholder="Type to search...">
                                </div>
                            </div>
                            <div class="table-responsive">

                                <table id="techPersonTable" class="table table-striped" style="width:100%">

                                    <thead>
                                        <tr>
                                            <th> Assignee </th>
                                            <th> Subject </th>
                                            <th> Status </th>
                                            <th> Ticket Created </th>
                                            <th> Last Update </th>
                                            <th> Ticket ID </th>
                                            <th> Detail </th>
                                        </tr>
                                    </thead>
                                    @include('partials.table_tech_person')
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- content-wrapper ends -->
        @endsection
        @section('scripts')
            <script>
                var orderBy = '{{ $orderBy }}';
                var orderDirection = '{{ $orderDirection }}';
                var searchValue = '';
                var intervalId = null; // Store interval ID
                function refreshTableTechPerson(tabId, routeName, search) {
                    $.ajax({
                        url: routeName,
                        search: search,
                        orderBy: orderBy,
                        orderDirection: orderDirection,
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
                    if (searchValue === '') {
                        refreshTableTechPerson("techPersonTable", "{{ route('refresh.table_tech_person') }}", searchValue);
                    }
                }, 10000);
            </script>


            <script src="https://code.jquery.com/jquery-3.7.1.min.js"
                integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
            <script src="//cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>

            <script>
                $(document).ready(function() {
                    // Initialize DataTable only if it's not already initialized
                    if ($.fn.DataTable.isDataTable('#techPersonTable')) {
                        $('#techPersonTable').DataTable().destroy();
                    }
                    var table = $('#techPersonTable').DataTable({
                        "order": [
                            [5, "desc"]
                        ]
                    });

                    // Add search functionality
                    $('#search-techperson').on('input', function() {
                        searchValue = this.value;
                        table.search(searchValue).draw();

                        // Clear the interval if searchValue is not empty
                        if (searchValue !== '' && intervalId !== null) {
                            clearInterval(intervalId);
                            intervalId = null;
                        }

                        // Start the interval if searchValue is empty and interval is not already running
                        if (searchValue === '' && intervalId === null) {
                            intervalId = setInterval(function() {
                                // Check if DataTable is initialized before refreshing
                                if ($.fn.DataTable.isDataTable('#techPersonTable')) {
                                    refreshTable("techPersonTable",
                                        "{{ route('refresh.table_tech_person') }}", searchValue);
                                }
                            }, 10000);
                        }
                    });

                    // Initial refresh
                    refreshTable("techPersonTable", "{{ route('refresh.table_tech_person') }}", searchValue);
                });
            </script>
        @endsection
