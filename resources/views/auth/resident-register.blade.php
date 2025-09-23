<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resident Registration - Barangay Management System</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #2c3e50;
            --secondary-color: #3498db;
            --accent-color: #e74c3c;
            --light-color: #ecf0f1;
            --dark-color: #2c3e50;
        }

        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            padding: 2rem 0;
        }

        .register-container {
            background-color: white;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            overflow: hidden;
            max-width: 1200px;
            width: 100%;
        }

        .register-left {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            color: white;
            padding: 105px;
            display: flex;
            text-align: center;
            flex-direction: column;
            justify-content: center;
        }

        .register-right {
            padding: 40px;
            overflow-y: auto;
            max-height: 90vh;
        }

        .logo-container {
            text-align: center;
            margin-bottom: 30px;
        }

        .logo {
            width: 80px;
            height: 80px;
            background-color: var(--light-color);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 15px;
            color: var(--primary-color);
            font-size: 40px;
        }

        .system-name {
            font-weight: 700;
            font-size: 24px;
            margin-bottom: 5px;
        }

        .system-tagline {
            font-size: 14px;
            opacity: 0.8;
        }

        .register-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .register-header h2 {
            color: var(--primary-color);
            font-weight: 700;
        }

        .form-section-heading {
            font-weight: 600;
            color: var(--primary-color);
            margin-top: 1rem;
            margin-bottom: 1.5rem;
            border-bottom: 2px solid var(--secondary-color);
            padding-bottom: 5px;
        }

        /* Use Bootstrap's floating labels, so custom control styles are simplified */
        .form-control, .form-select {
            border-radius: 8px;
            border: 1px solid #ddd;
            transition: all 0.3s;
        }

        .form-control:focus, .form-select:focus {
            border-color: var(--secondary-color);
            box-shadow: 0 0 0 0.2rem rgba(52, 152, 219, 0.25);
        }

        .form-floating label {
            padding: 1rem 0.95rem;
        }

        .btn-register {
            background-color: var(--secondary-color);
            color: white;
            padding: 12px;
            border: none;
            border-radius: 8px;
            width: 100%;
            font-weight: 600;
            transition: all 0.3s;
        }

        .btn-register:hover {
            background-color: #2980b9;
            transform: translateY(-2px);
        }

        .login-link {
            text-align: center;
            margin-top: 20px;
        }

        .login-link a {
             color: var(--secondary-color);
            text-decoration: none;
        }

        .login-link a:hover {
            text-decoration: underline;
        }

        @media (max-width: 992px) {
            .register-left {
                display: none;
            }
             .register-right {
                max-height: none;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="register-container">
            <div class="row g-0">
                <!-- Left Side -->
                <div class="col-lg-5">
                    <div class="register-left">
                        <div class="logo-container">
                            <div class="logo">
                                <i class="fas fa-landmark"></i>
                            </div>
                            <h1 class="system-name">Barangay Management System</h1>
                            <p class="system-tagline">Your gateway to community services</p>
                        </div>
                        <p>By registering, you gain access to a variety of barangay services online, including document requests, facility reservations, and local announcements.</p>
                        <p>Please fill out the form accurately. Your information is kept confidential and is used solely for barangay-related purposes.</p>
                    </div>
                </div>

                <!-- Right Side - Registration Form -->
                <div class="col-lg-7">
                    <div class="register-right">
                        <div class="register-header">
                            <h2>Create Your Account</h2>
                            <p>Join our community platform</p>
                        </div>

                        @if($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('resident.register') }}" method="POST">
                            @csrf

                            <h5 class="form-section-heading">Personal Information</h5>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-floating mb-3">
                                        <input type="text" name="Fname" id="Fname" class="form-control" placeholder="First Name" required value="{{ old('Fname') }}">
                                        <label for="Fname">First Name</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                     <div class="form-floating mb-3">
                                        <input type="text" name="mname" id="mname" class="form-control" placeholder="Middle Name" value="{{ old('mname') }}">
                                        <label for="mname">Middle Name</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                     <div class="form-floating mb-3">
                                        <input type="text" name="lname" id="lname" class="form-control" placeholder="Last Name" required value="{{ old('lname') }}">
                                        <label for="lname">Last Name</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                        <input type="date" name="birthday" id="birthday" class="form-control" placeholder="Birthday" required value="{{ old('birthday') }}">
                                        <label for="birthday">Birthday</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                     <div class="form-floating mb-3">
                                        <select name="gender" id="gender" class="form-select" required>
                                            <option value="" disabled selected></option>
                                            <option value="Male" @if(old('gender') == 'Male') selected @endif>Male</option>
                                            <option value="Female" @if(old('gender') == 'Female') selected @endif>Female</option>
                                        </select>
                                        <label for="gender">Gender</label>
                                    </div>
                                </div>
                            </div>
                             <div class="row">
                                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                        <input type="text" name="birthplace" id="birthplace" class="form-control" placeholder="Birthplace" required value="{{ old('birthplace') }}">
                                        <label for="birthplace">Birthplace</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                     <div class="form-floating mb-3">
                                        <select name="civil_status" id="civil_status" class="form-select" required>
                                            <option value="" disabled selected></option>
                                            <option value="Single" @if(old('civil_status') == 'Single') selected @endif>Single</option>
                                            <option value="Married" @if(old('civil_status') == 'Married') selected @endif>Married</option>
                                            <option value="Widowed" @if(old('civil_status') == 'Widowed') selected @endif>Widowed</option>
                                            <option value="Separated" @if(old('civil_status') == 'Separated') selected @endif>Separated</option>
                                        </select>
                                        <label for="civil_status">Civil Status</label>
                                    </div>
                                </div>
                            </div>
                             <div class="row">
                                 <div class="col-md-6">
                                     <div class="form-floating mb-3">
                                        <input type="text" name="Citizenship" id="Citizenship" class="form-control" placeholder="Citizenship" required value="{{ old('Citizenship') }}">
                                        <label for="Citizenship">Citizenship</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                     <div class="form-floating mb-3">
                                        <input type="text" name="occupation" id="occupation" class="form-control" placeholder="Occupation" value="{{ old('occupation') }}">
                                        <label for="occupation">Occupation</label>
                                    </div>
                                </div>
                            </div>

                            <h5 class="form-section-heading">Contact & Address</h5>
                             <div class="row">
                                <div class="col-md-6">
                                     <div class="form-floating mb-3">
                                        <input type="text" name="contact_number" id="contact_number" class="form-control" placeholder="Contact Number" value="{{ old('contact_number') }}">
                                        <label for="contact_number">Contact Number</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                     <div class="form-floating mb-3">
                                        <input type="text" name="household_no" id="household_no" class="form-control" placeholder="House/Lot/Bldg No." required value="{{ old('household_no') }}">
                                        <label for="household_no">House/Lot/Bldg No.</label>
                                    </div>
                                </div>
                            </div>
                             <div class="row">
                                <div class="col-md-6">
                                     <div class="form-floating mb-3">
                                        <select name="purok_no" id="purok_no" class="form-select" required>
                                            <option value="" disabled selected></option>
                                            <option value="Purok 1" @if(old('purok_no') == 'Purok 1') selected @endif>Purok 1</option>
                                            <option value="Purok 2" @if(old('purok_no') == 'Purok 2') selected @endif>Purok 2</option>
                                            <option value="Purok 3" @if(old('purok_no') == 'Purok 3') selected @endif>Purok 3</option>
                                        </select>
                                        <label for="purok_no">Purok</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                        <select name="sitio" id="sitio" class="form-select">
                                            <option value="" disabled selected></option>
                                            <option value="Sitio Leksab" @if(old('sitio') == 'Sitio Leksab') selected @endif>Sitio Leksab</option>
                                            <option value="Sitio Taew" @if(old('sitio') == 'Sitio Taew') selected @endif>Sitio Taew</option>
                                            <option value="Sitio Pidlaoan" @if(old('sitio') == 'Sitio Pidlaoan') selected @endif>Sitio Pidlaoan</option>
                                        </select>
                                        <label for="sitio">Sitio (if applicable)</label>
                                    </div>
                                </div>
                            </div>

                            <h5 class="form-section-heading">Account Credentials</h5>
                             <div class="form-floating mb-3">
                                <input type="email" name="email" id="email" class="form-control" placeholder="Email Address" required value="{{ old('email') }}">
                                <label for="email">Email Address</label>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                        <input type="password" name="password" id="password" class="form-control" placeholder="Password" required>
                                        <label for="password">Password</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="Confirm Password" required>
                                        <label for="password_confirmation">Confirm Password</label>
                                    </div>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-register mt-4">
                                <i class="fas fa-user-plus"></i> Register
                            </button>
                        </form>

                        <div class="login-link">
                            <p>Already have an account? <a href="{{ route('login') }}">Sign In</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
