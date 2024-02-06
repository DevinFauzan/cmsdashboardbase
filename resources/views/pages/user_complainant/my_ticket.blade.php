@extends('layouts.auth')
<style>
    .dataTables_filter {
        display: none;
    }
</style>
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
                            <div class="d-flex justify-content-end mb-3">
                                <div class="col-3">
                                    <input type="text" id="search-userticket" class="form-control"
                                        placeholder="Type to search...">
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table id="userTable" class="table table-striped" style="width: 100%">
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
                                    @include('partials.table_user')
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection

    @section('scripts')
        <script>
            var searchValue = '';
            var intervalId = null; // Store interval ID

            function refreshTableUser(tabId, routeName, search) {
                $.ajax({
                    url: routeName,
                    data: {
                        search: search
                    },
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
                console.log('Interval function running');
                if (searchValue === '') {
                    refreshTableUser("userTable", "{{ route('refresh.table_user') }}", searchValue);
                }
            }, 10000);
        </script>

        <script src="https://code.jquery.com/jquery-3.7.1.min.js"
            integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
        <script src="//cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>

        <script>
            $(document).ready(function() {
                // Initialize DataTable only if it's not already initialized
                if ($.fn.DataTable.isDataTable('#userTable')) {
                    $('#userTable').DataTable().destroy();
                }

                // Initialize DataTable
                var table = $('#userTable').DataTable({
                    "order": [
                        [3, "asc"]
                    ]
                });


                // Add search functionality
                $('#search-userticket').on('input', function() {
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
                            if ($.fn.DataTable.isDataTable('#userTable')) {
                                refreshTableUser("userTable", "{{ route('refresh.table_user') }}",
                                    searchValue);
                            }
                        }, 10000);
                    }
                });

                // Initial refresh
                refreshTableUser("userTable", "{{ route('refresh.table_user') }}", searchValue);
            });
        </script>
    @endsection
