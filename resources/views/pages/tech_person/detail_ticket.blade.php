@extends('layouts.auth')

@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="page-header">
                <h3 class="page-title">Ticket Details </h3>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Tech Person</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Detail Ticket</li>
                    </ol>
                </nav>
            </div>
            <div class="row">
                <div class="col-9 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Ticket #ID093209831</h4>
                            <p class="card-description"> Open | Not Assigned Yet</p>
                            <form class="forms-sample">
                                <div class="form-group">
                                    <label for="exampleInputName1">Complainant Name</label>
                                    <input type="text" class="form-control" id="exampleInputName1" placeholder="Name"
                                        readonly>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail3">Email address</label>
                                    <input type="email" class="form-control" id="exampleInputEmail3" placeholder="Email"
                                        readonly>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputName1">Complained date</label>
                                    <input type="date" class="form-control" id="exampleInputName1" placeholder="date"
                                        readonly>
                                </div>
                                <div class="form-group">
                                    <label for="exampleTextarea1">Description</label>
                                    <textarea class="form-control" id="exampleTextarea1" rows="4" readonly></textarea>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-3 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Ticket #ID093209831</h4>
                            <p class="card-description">Once you assigned this ticket problem, this ticked is belong to you
                                untill you solved it, want to assigend this ticket?</p>
                            <form class="forms-sample">
                                <div class="form-group">
                                    <label for="exampleSelectGender">Assign</label>
                                    <select class="form-control" id="exampleSelectGender">
                                        <option>Assign this ticket</option>
                                        <option>Pending this ticket</option>
                                    </select>
                                </div>
                                <div class="justify-content-center center">
                                    <button class="btn btn-light btn-sm mr-4">Cancel</button>
                                    <button type="submit" class="btn btn-gradient-primary btn-sm">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
