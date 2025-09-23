
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Barangay System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <style>
        /* Background Styling */
        body {
    background-image: url("{{ asset('images/SC_logo.png') }}");
    background-repeat: no-repeat; /* Prevents the image from repeating */
    background-position: center; /* Center the smaller image */
    background-attachment: fixed;
    position: relative;
    font-family: 'Arial', sans-serif;
    margin: 0;
    height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
    color: #ffffff;
}

        /* Overlay Effect */
        body::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(to bottom, rgba(0, 100, 0, 0.6), rgba(46, 139, 87, 0.7)); /* Green gradient overlay */
            z-index: -1;
        }

        /* Container Styling */
        .login-container {

            background: rgba(255, 255, 255, 0.95); /* Slight transparency */
            padding: 40px;
            border-radius: 16px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
            width: 100%;
            max-width: 400px;
            text-align: center;
            transition: transform 0.3s ease-in-out;
            color: #2e7d32;
        }

        .login-container:hover {
            transform: translateY(-5px);
        }

        /* Header Styling */
        .login-container h3 {
            margin-bottom: 20px;
            color: #2e7d32;
            font-weight: bold;
            font-size: 2rem;
        }

        /* Input Field Styling */
        .form-control {
            border-radius: 8px;
            border: 1px solid #c8e6c9;
            padding: 12px;
            font-size: 16px;
            transition: border 0.3s ease;
            color: #000;
            background-color: #f9f9f9;
        }

        .form-control:focus {
            border-color: #2e7d32;
            box-shadow: 0 0 8px rgba(46, 125, 50, 0.3);
        }

        /* Button Styling */
        .btn-primary {
            width: 100%;
            padding: 12px;
            background-color: #2e7d32;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: bold;
            color: #ffffff;
            transition: background-color 0.3s ease;
            margin-top: 10px;
        }

        .btn-primary:hover {
            background-color: #1b5e20;
        }

        /* Alert Styling */
        .alert {
            padding: 12px;
            margin-bottom: 15px;
            border-radius: 8px;
            font-size: 14px;
            color: #fff;
        }

        .alert-success {
            background-color: #4caf50;
        }

        .alert-danger {
            background-color: #f44336;
        }

        /* Icon Styling */
        .fas {
            margin-right: 5px;
        }

        /* Responsive Styling */
        @media (max-width: 576px) {
            .login-container {
                padding: 20px;
            }

            .login-container h3 {
                font-size: 1.5rem;
            }

            .btn-primary {
                font-size: 14px;
            }
        }

    </style>
</head>
<body>

<div class="login-container">
    <h3><i class="fas fa-user-plus"></i> Resident Registration</h3>

    <!-- Display Validation Errors -->
    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div style="flex: 1;">
        <form action="{{ route('register') }}" method="POST" class="form-container">
            @csrf
            <div class="mb-3">
                <input type="text" name="name" id="name" class="form-control" placeholder="Full Name" required autofocus>
            </div>

            <div class="mb-3">
                <input type="email" name="email" id="email" class="form-control" placeholder="Email Address" required>
            </div>

            <div class="mb-3">
                <input type="password" name="password" id="password" class="form-control" placeholder="Password" required>
            </div>

            <div class="mb-3">
                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="Confirm Password" required>
            </div>

            <button type="submit" class="btn btn-primary">
                <i class="fas fa-user-plus"></i> Register
            </button>
        </form>
         <div class="mt-3">
            <a href="{{ route('login') }}">Already have an account? Login</a>
        </div>
    </div>
</div>


<!-- Bootstrap Script -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
