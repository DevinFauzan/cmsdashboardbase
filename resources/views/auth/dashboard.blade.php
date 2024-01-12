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
</style>


@section('content')
    <!-- partial -->
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="page-header">
                <h3 class="page-title">
                    <span class="page-title-icon bg-gradient-primary text-white me-2">
                        <i class="mdi mdi-home"></i>
                    </span> Dashboard
                </h3>
            </div>
            <div class="row">
                <div class="col-md-3 stretch-card grid-margin">
                    <div class="card bg-info card-img-holder text-white text-center">
                        <div class="card-body btn btn-sm mdi-24px text-white tablinks" onclick="openCity(event, 'open')">
                            {{-- <img src="{{ asset('assets/auth/images/dashboard/circle.svg') }}" class="card-img-absolute"
                                alt="circle-image" /> --}}
                            <h4 class="font-weight-high mb-3">Open <i
                                    class="mdi mdi-ticket-percent mdi-24px float-right"></i>
                            </h4>
                            <h1 class="mb-5">1
                            </h1>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 stretch-card grid-margin">
                    <div class="card bg-warning card-img-holder text-white text-center">
                        <div class="card-body btn btn-sm mdi-24px text-white tablinks"
                            onclick="openCity(event, 'progress')">
                            <h4 class="font-weight-normal mb-3">progress <i
                                    class="mdi mdi-progress-clock mdi-24px float-right"></i>
                            </h4>
                            <h1 class="mb-5">5</h1>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 stretch-card grid-margin">
                    <div class="card bg-danger card-img-holder text-white text-center">
                        <div class="card-body btn btn-sm mdi-24px text-white tablinks" onclick="openCity(event, 'pending')">
                            <img src="{{ asset('assets/auth/images/dashboard/circle.svg') }}" class="card-img-absolute"
                                alt="circle-image" />
                            <h4 class="font-weight-normal mb-3">Pending <i
                                    class="mdi mdi-account-clock-outline mdi-24px float-right"></i>
                            </h4>
                            <h1 class="mb-5">4</h1>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 stretch-card grid-margin">
                    <div class="card bg-success card-img-holder text-white text-center">
                        <div class="card-body btn btn-sm mdi-24px text-white tablinks" onclick="openCity(event, 'solved')">
                            <img src="{{ asset('assets/auth/images/dashboard/circle.svg') }}" class="card-img-absolute"
                                alt="circle-image" />
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
                                    <tr>
                                        <td>
                                            <img src="{{ asset('assets/auth/images/faces/face4.jpg') }}" class="me-2"
                                                alt="image"> John
                                            Doe
                                        </td>
                                        <td> Loosing control on server </td>
                                        <td>
                                            <label class="badge badge-gradient-info">OPEN</label>
                                        </td>
                                        <td> Dec 3, 2017 </td>
                                        <td> WD-12348 </td>
                                        <td>
                                            <button class="btn btn-primary btn-sm mdi-24px text-white"
                                                data-bs-toggle="modal" data-bs-target="#modalOpen">
                                                assign
                                            </button>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <img src="{{ asset('assets/auth/images/faces/face4.jpg') }}" class="me-2"
                                                alt="image"> John
                                            Doe
                                        </td>
                                        <td> Loosing control on server </td>
                                        <td>
                                            <label class="badge badge-gradient-info">OPEN</label>
                                        </td>
                                        <td> Dec 3, 2017 </td>
                                        <td> WD-12348 </td>
                                        <td>
                                            <button class="btn btn-primary btn-sm mdi-24px text-white"
                                                data-bs-toggle="modal" data-bs-target="#modalOpen">
                                                assign
                                            </button>
                                        </td>
                                    </tr>
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
            {{-- <div class="row">
                <div class="col-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Recent Updates</h4>
                            <div class="d-flex">
                                <div class="d-flex align-items-center me-4 text-muted font-weight-light">
                                    <i class="mdi mdi-account-outline icon-sm me-2"></i>
                                    <span>jack Menqu</span>
                                </div>
                                <div class="d-flex align-items-center text-muted font-weight-light">
                                    <i class="mdi mdi-clock icon-sm me-2"></i>
                                    <span>October 3rd, 2018</span>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-6 pe-1">
                                    <img src="{{ asset('assets/auth/images/dashboard/img_1.jpg') }}" class="mb-2 mw-100 w-100 rounded"
                                        alt="image">
                                    <img src="{{ asset('assets/auth/images/dashboard/img_4.jpg') }}" class="mw-100 w-100 rounded"
                                        alt="image">
                                </div>
                                <div class="col-6 ps-1">
                                    <img src="{{ asset('assets/auth/images/dashboard/img_2.jpg') }}" class="mb-2 mw-100 w-100 rounded"
                                        alt="image">
                                    <img src="{{ asset('assets/auth/images/dashboard/img_3.jpg') }}" class="mw-100 w-100 rounded"
                                        alt="image">
                                </div>
                            </div>
                            <div class="d-flex mt-5 align-items-top">
                                <img src="{{ asset('assets/auth/images/faces/face3.jpg') }}" class="img-sm rounded-circle me-3"
                                    alt="image">
                                <div class="mb-0 flex-grow">
                                    <h5 class="me-2 mb-2">School Website - Authentication Module.</h5>
                                    <p class="mb-0 font-weight-light">It is a long established fact that a reader will be
                                        distracted by the readable content of a page.</p>
                                </div>
                                <div class="ms-auto">
                                    <i class="mdi mdi-heart-outline text-muted"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}
            {{-- <div class="row">
                <div class="col-md-7 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Project Status</h4>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th> # </th>
                                            <th> Name </th>
                                            <th> Due Date </th>
                                            <th> Progress </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td> 1 </td>
                                            <td> Herman Beck </td>
                                            <td> May 15, 2015 </td>
                                            <td>
                                                <div class="progress">
                                                    <div class="progress-bar bg-gradient-success" role="progressbar"
                                                        style="width: 25%" aria-valuenow="25" aria-valuemin="0"
                                                        aria-valuemax="100"></div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td> 2 </td>
                                            <td> Messsy Adam </td>
                                            <td> Jul 01, 2015 </td>
                                            <td>
                                                <div class="progress">
                                                    <div class="progress-bar bg-gradient-danger" role="progressbar"
                                                        style="width: 75%" aria-valuenow="75" aria-valuemin="0"
                                                        aria-valuemax="100"></div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td> 3 </td>
                                            <td> John Richards </td>
                                            <td> Apr 12, 2015 </td>
                                            <td>
                                                <div class="progress">
                                                    <div class="progress-bar bg-gradient-warning" role="progressbar"
                                                        style="width: 90%" aria-valuenow="90" aria-valuemin="0"
                                                        aria-valuemax="100"></div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td> 4 </td>
                                            <td> Peter Meggik </td>
                                            <td> May 15, 2015 </td>
                                            <td>
                                                <div class="progress">
                                                    <div class="progress-bar bg-gradient-primary" role="progressbar"
                                                        style="width: 50%" aria-valuenow="50" aria-valuemin="0"
                                                        aria-valuemax="100"></div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td> 5 </td>
                                            <td> Edward </td>
                                            <td> May 03, 2015 </td>
                                            <td>
                                                <div class="progress">
                                                    <div class="progress-bar bg-gradient-danger" role="progressbar"
                                                        style="width: 35%" aria-valuenow="35" aria-valuemin="0"
                                                        aria-valuemax="100"></div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td> 5 </td>
                                            <td> Ronald </td>
                                            <td> Jun 05, 2015 </td>
                                            <td>
                                                <div class="progress">
                                                    <div class="progress-bar bg-gradient-info" role="progressbar"
                                                        style="width: 65%" aria-valuenow="65" aria-valuemin="0"
                                                        aria-valuemax="100"></div>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-5 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title text-white">Todo</h4>
                            <div class="add-items d-flex">
                                <input type="text" class="form-control todo-list-input"
                                    placeholder="What do you need to do today?">
                                <button class="add btn btn-gradient-primary font-weight-bold todo-list-add-btn"
                                    id="add-task">Add</button>
                            </div>
                            <div class="list-wrapper">
                                <ul class="d-flex flex-column-reverse todo-list todo-list-custom">
                                    <li>
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input class="checkbox" type="checkbox"> Meeting with Alisa </label>
                                        </div>
                                        <i class="remove mdi mdi-close-circle-outline"></i>
                                    </li>
                                    <li class="completed">
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input class="checkbox" type="checkbox" checked> Call John </label>
                                        </div>
                                        <i class="remove mdi mdi-close-circle-outline"></i>
                                    </li>
                                    <li>
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input class="checkbox" type="checkbox"> Create invoice </label>
                                        </div>
                                        <i class="remove mdi mdi-close-circle-outline"></i>
                                    </li>
                                    <li>
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input class="checkbox" type="checkbox"> Print Statements </label>
                                        </div>
                                        <i class="remove mdi mdi-close-circle-outline"></i>
                                    </li>
                                    <li class="completed">
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input class="checkbox" type="checkbox" checked> Prepare for presentation
                                            </label>
                                        </div>
                                        <i class="remove mdi mdi-close-circle-outline"></i>
                                    </li>
                                    <li>
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input class="checkbox" type="checkbox"> Pick up kids from school </label>
                                        </div>
                                        <i class="remove mdi mdi-close-circle-outline"></i>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}
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
                                                    placeholder="08xxxxx" readonly>
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
                                        <h4 class="card-title">Ticket #ID093209831</h4>
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
                                                    <tr>
                                                        <td> Doditdadsadsada </td>
                                                        <td> 0 </td>
                                                        <td>
                                                            <label class="badge badge-gradient-success">Free</label>
                                                        </td>
                                                        <td> 
                                                            <Button class="btn btn-sm btn-primary">
                                                                Assign
                                                            </Button> 
                                                        </td>
                                                    </tr>

                                                </tbody>
                                            </table>
                                        </div>

                                        {{-- <form class="forms-sample">
                                            <div class="form-group">
                                                <label for="exampleSelectGender">Assign</label>
                                                <select class="form-control" id="exampleSelectGender">
                                                    <option selected disabled>Select</option>
                                                    <option>Nanda | 3 Case ongoing</option>
                                                    <option>Pertuk | 1 Case ongoing</option>
                                                    <option>Noval | Free</option>
                                                </select>
                                            </div>
                                            <div class="justify-content-center center">
                                                <button class="btn btn-light btn-sm mr-4">Cancel</button>
                                                <button type="submit"
                                                    class="btn btn-gradient-primary btn-sm">Submit</button>
                                            </div>
                                        </form> --}}
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

    <script src="https://cdn.datatables.net/v/bs5/dt-1.13.8/datatables.min.js"></script>
