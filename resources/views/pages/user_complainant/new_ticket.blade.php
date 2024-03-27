@extends('layouts.auth')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="page-header">
                <h3 class="page-title">
                    <a href="/my_ticket" class="page-title-icon bg-gradient-primary text-white me-2">
                        <i class="mdi mdi-arrow-left"></i>
                    </a>
                    New Ticket
                </h3>
                <nav aria-label="breadcrumb">
                </nav>
            </div>
            <div class="row">
                <div class="col-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <form class="forms-sample" id="submitNewTicketForm" action="{{ route('submit_ticket') }}"
                                method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="exampleInputName1">Complainant Name</label>
                                    <input type="text" value="{{ $user->name }}" class="form-control "
                                        id="exampleInputName1" placeholder="Name" name="name_user" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail3">Email address</label>
                                    <input type="email" value="{{ $user->email }}" class="form-control"
                                        id="exampleInputEmail3" name="email" placeholder="Email" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputName1">Complained date</label>
                                    <input type="date" class="form-control" id="exampleInputName1" name="complained_date"
                                        placeholder="date" required value="{{ now()->format('Y-m-d') }}">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputSubject">Subject</label>
                                    <input type="text" class="form-control @error('subject') is-invalid @enderror"
                                        id="exampleInputSubject" placeholder="Subject" name="subject" required
                                        value="{{ old('subject') }}">
                                    @error('subject')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="exampleTextarea1">Description</label>
                                    <textarea class="form-control @error('description') is-invalid @enderror" id="exampleTextarea1" rows="4"
                                        name="description" required>{{ old('description') }}</textarea>
                                    @error('description')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="images">Photos</label>
                                    <input type="file" class="form-control @error('images') is-invalid @enderror"
                                        id="exampleInputName1" name="images[]" id="images" multiple accept="image/*"
                                        required>
                                    @error('images')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="exampleSelectProduct">Product</label>
                                    <select class="form-control @error('product') is-invalid @enderror"
                                        id="exampleSelectProduct" name="product" required>
                                        <option disabled selected>Select product type</option>
                                        <option value="0" {{ old('product') == '0' ? 'selected' : '' }}>Tableau Server
                                        </option>
                                        <option value="1" {{ old('product') == '1' ? 'selected' : '' }}>Tableau Online
                                        </option>
                                        <option value="2" {{ old('product') == '2' ? 'selected' : '' }}>Tableau
                                            Desktop</option>
                                        <option value="3" {{ old('product') == '3' ? 'selected' : '' }}>Tableau Prep
                                            Builder</option>
                                    </select>
                                    @error('product')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputTableauVersion">Tableau Version</label>
                                    <input type="text"
                                        class="form-control @error('tableau_version') is-invalid @enderror"
                                        id="exampleInputTableauVersion" name="tableau_version"
                                        placeholder="Type Your Tableau Version" required
                                        value="{{ old('tableau_version') }}">
                                    @error('tableau_version')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputOs">Operating System</label>
                                    <input type="text" class="form-control @error('os') is-invalid @enderror"
                                        id="exampleInputOs" name="os" placeholder="Type your Operating System" required
                                        value="{{ old('os') }}">
                                    @error('os')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputName1">Telephone</label>
                                    <input type="text" value="{{ $user->phone }}" class="form-control"
                                        id="exampleInputSubject" name="phone" readonly>
                                </div>
                                <div>
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                @if (session('newTicketInfoUser'))
                    <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            // Show SweetAlert when the page is loaded
                            const sweetAlert = Swal.fire({
                                icon: 'success',
                                title: 'Ticket submitted successfully!',
                                html: `
                        <p>Ticket ID: {{ session('newTicketInfoUser')['ticket_id'] }}</p>
                        <p>Name: {{ session('newTicketInfoUser')['name_user'] }}</p>
                        <p>Email: {{ session('newTicketInfoUser')['email'] }}</p>                        
                    `,
                            });
                        });
                    </script>
                @endif
                @if (session('error'))
                    <script>
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: '{{ session('error') }}',
                        });
                    </script>
                @endif
            @endsection
