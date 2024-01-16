@extends('layouts.auth')

@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="page-header">
                <h3 class="page-title">
                    <span class="page-title-icon bg-gradient-primary text-white me-2">
                        <i class="mdi mdi-arrow-left"></i>
                    </span> My Ticket
                </h3>
            </div>
            <div class="row">
                <div class="col-6 grid-margin stretch-card ">
                    <div class="card">
                        <div class="card-body">
                            <form class="forms-sample">
                                <div class="form-group">
                                    <label for="exampleInputName1">Subject</label>
                                    <input type="text" class="form-control" id="exampleInputName1" placeholder="subject"
                                        readonly>
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
                                    <input type="email" class="form-control" id="exampleInputEmail3" placeholder="Email"
                                        readonly>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputTelp">Telephone</label>
                                    <input type="number_format" class="form-control" id="exampleInputTelp"
                                        placeholder="08xxxxx" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputName1">Complained date</label>
                                    <input type="date" class="form-control" id="exampleInputName1" placeholder="date"
                                        readonly>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-6 grid-margin stretch-card ">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Ticket #xxxxxx</h4>
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
                                            <td>name</td>
                                            <td>0</td>
                                            <td>
                                                <label class="badge badge-gradient-success">Free</label>
                                            </td>
                                            <td>
                                                <button type="submit" class="btn btn-sm btn-primary">
                                                    Assign
                                                </button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
