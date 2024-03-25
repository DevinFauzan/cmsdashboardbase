@extends('layouts.user')

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="page-header">
                <h3 class="page-title">
                    New Ticket
                </h3>
                <nav aria-label="breadcrumb">
                </nav>
            </div>
            <div class="row">
                <div class="col-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <form class="forms-sample" action="{{ route('dashboard-user.store') }}" method="post">
                                @csrf

                                <div class="form-group">
                                    <label for="exampleInputName1">User Name</label>
                                    <input type="text" class="form-control @error('name_user') is-invalid @enderror"
                                        id="exampleInputName1" name="name_user" placeholder="Name"
                                        value="{{ old('name_user') }}" required>
                                    @error('name_user')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail3">Email address</label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror"
                                        id="exampleInputEmail3" name="email" placeholder="Email"
                                        value="{{ old('email') }}" required>
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputName1">Complained date</label>
                                    <input type="date"
                                        class="form-control @error('complained_date') is-invalid @enderror"
                                        id="exampleInputName1" name="complained_date"
                                        value="{{ old('complained_date', now()->format('Y-m-d')) }}" required readonly>
                                    @error('complained_date')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputName1">Subject</label>
                                    <input type="text" class="form-control @error('subject') is-invalid @enderror"
                                        id="exampleInputName1" name="subject" placeholder="subject"
                                        value="{{ old('subject') }}" required>
                                    @error('subject')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="exampleTextarea1">Description</label>
                                    <textarea class="form-control @error('description') is-invalid @enderror" id="exampleTextarea1" name="description"
                                        rows="4" required>{{ old('description') }}</textarea>
                                    @error('description')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="exampleSelectProduct">Product</label>
                                    <select class="form-control @error('product') is-invalid @enderror"
                                        id="exampleSelectProduct" name="product" required>
                                        <option disabled selected>Select product type</option>
                                        <option value="0" @if (old('product') == '0') selected @endif>Tableau
                                            Server</option>
                                        <option value="1" @if (old('product') == '1') selected @endif>Tableau
                                            Online</option>
                                        <option value="2" @if (old('product') == '2') selected @endif>Tableau
                                            Desktop</option>
                                        <option value="3" @if (old('product') == '3') selected @endif>Tableau
                                            Prep Builder</option>
                                    </select>
                                    @error('product')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputName1">Tableau Version</label>
                                    <input type="text"
                                        class="form-control @error('tableau_version') is-invalid @enderror"
                                        id="exampleInputName1" name="tableau_version"
                                        placeholder="Type Your Tableau Version" value="{{ old('tableau_version') }}"
                                        required>
                                    @error('tableau_version')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputName1">Operating System</label>
                                    <input type="text" class="form-control @error('os') is-invalid @enderror"
                                        id="exampleInputName1" name="os" placeholder="Type your Operating System"
                                        value="{{ old('os') }}" required>
                                    @error('os')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputTelp">Telephone</label>
                                    <input type="text" class="form-control @error('phone') is-invalid @enderror"
                                        id="exampleInputTelp" name="phone" placeholder="08xxxxx"
                                        value="{{ old('phone') }}" required>
                                    @error('phone')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div>
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                @if (session('newTicketInfo'))
                    <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            // Show SweetAlert when the page is loaded
                            const sweetAlert = Swal.fire({
                                icon: 'success',
                                title: 'Ticket submitted successfully!',
                                html: `
                        <p>Ticket ID: {{ session('newTicketInfo')['ticket_id'] }}</p>
                        <p>Name: {{ session('newTicketInfo')['name_user'] }}</p>
                        <p>Email: {{ session('newTicketInfo')['email'] }}</p>
                        <p>Password: {{ session('newTicketInfo')['password'] }}</p>
                        <h5 id="goToLogin" class="btn btn-link"> <b> Click here to go to the Login Page</h5>
                    `,
                                showCancelButton: false,
                                confirmButtonText: 'Close',
                                closeOnClickOutside: false, // Do not close on click outside the alert
                                allowOutsideClick: false, // Do not allow clicking outside the alert to close it
                                reverseButtons: true, // Reverse the order of buttons (confirm/cancel)
                            });

                            // Add a click event listener to the specific text element
                            const goToLoginText = document.getElementById('goToLogin');
                            if (goToLoginText) {
                                goToLoginText.addEventListener('click', function() {
                                    // Open the login page in a new tab using window.open()
                                    window.open('{{ route('login') }}');
                                });
                            }
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
