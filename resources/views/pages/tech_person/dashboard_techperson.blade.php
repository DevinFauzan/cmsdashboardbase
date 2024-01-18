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
                                    
                                    @if ($tickets->count() > 0)
                                        @include('partials.table_tech_person')
                                    @else
                                        <tbody>
                                            <tr>
                                                <td colspan="6" class="text-center">There is no data</td>
                                            </tr>
                                        </tbody>
                                    @endif
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
            }, 1000);
        </script>
