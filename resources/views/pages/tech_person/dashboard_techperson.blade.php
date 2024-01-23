@extends('layouts.auth')

<head>
    <link rel="stylesheet" href="//cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
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

                                <table id="techPersonTable" class="table table-striped" style="width:100%">

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
                                    @include('partials.table_tech_person')
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- content-wrapper ends -->
        @endsection

        <script>
            function refreshTableTechPerson(tabId, routeName) {
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
                refreshTableTechPerson("techPersonTable", "{{ route('refresh.table_tech_person') }}");
            }, 20000);
        </script>
        @section('scripts')
            <script src="https://code.jquery.com/jquery-3.7.1.min.js"
                integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
            <script src="//cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
            <script>
                $(document).ready(function() {
                    $('#techPersonTable').DataTable();
                });
            </script>
        @endsection
