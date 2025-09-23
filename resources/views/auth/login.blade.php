<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Barangay Management System - Login</title>
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
            padding-left: 250px;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .login-container {
            background-color: white;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            overflow: hidden;
            max-width: 1000px;
            width: 100%;
        }

        .login-left {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            color: white;
            padding: 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .login-right {
            padding: 40px;
        }

        .logo-container {
            text-align: center;
            margin-bottom: 30px;
        }

        .logo {
            width: 45px;
            height: 45px;
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

        .feature-list {
            margin-top: 30px;
        }

        .feature-item {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
        }

        .feature-icon {
            width: 40px;
            height: 40px;
            background-color: rgba(255, 255, 255, 0.2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 15px;
            font-size: 18px;
        }

        .login-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .login-header h2 {
            color: var(--primary-color);
            font-weight: 700;
        }

        .form-control {
            padding: 12px 15px;
            border-radius: 8px;
            border: 1px solid #ddd;
            margin-bottom: 20px;
            transition: all 0.3s;
        }

        .form-control:focus {
            border-color: var(--secondary-color);
            box-shadow: 0 0 0 0.2rem rgba(52, 152, 219, 0.25);
        }

        .input-group-text {
            background-color: white;
            border-right: none;
        }

        .btn-login {
            background-color: var(--secondary-color);
            color: white;
            padding: 12px;
            border: none;
            border-radius: 8px;
            width: 100%;
            font-weight: 600;
            transition: all 0.3s;
        }

        .btn-login:hover {
            background-color: #2980b9;
            transform: translateY(-2px);
        }

        .login-options {
            /* display: flex; */
              text-align: center;
            justify-content: space-between;
            margin-top: 15px;
            font-size: 14px;
        }

        .register-link {
            color: var(--secondary-color);
            text-decoration: none;
        }

        .register-link:hover {
            text-decoration: underline;
        }

        .footer-text {
            text-align: center;
            margin-top: 30px;
            font-size: 12px;
            color: #7f8c8d;
        }

        @media (max-width: 768px) {
            .login-left {
                display: none;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="login-container">
            <div class="row g-0">
                <!-- Left Side - Information -->
                <div class="col-lg-6">
                    <div class="login-left">
                        <div class="logo-container">
                            <div class="logo">
                            <img src="images/cobol logo small.png" alt="Barangay Cobol Logo " >
                            </div>
                            <h1 class="system-name">Barangay Management System</h1>
                            <p class="system-tagline">Streamlining community services and governance</p>
                        </div>

                        <div class="feature-list">
                            <div class="feature-item">
                                <div class="feature-icon">
                                    <i class="fas fa-users"></i>
                                </div>
                                <div>
                                    <h5>Resident Management</h5>
                                    <p>Efficiently manage resident information and records</p>
                                </div>
                            </div>

                            <div class="feature-item">
                                <div class="feature-icon">
                                    <i class="fas fa-file-alt"></i>
                                </div>
                                <div>
                                    <h5>Document Processing</h5>
                                    <p>Streamline barangay clearance and certificate issuance</p>
                                </div>
                            </div>

                            <div class="feature-item">
                                <div class="feature-icon">
                                    <i class="fas fa-chart-bar"></i>
                                </div>
                                <div>
                                    <h5>Reporting & Analytics</h5>
                                    <p>Generate comprehensive reports for better decision making</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Side - Login Form -->
                <div class="col-lg-6">
                    <div class="login-right">
                        <div class="login-header">
                            <h2>Welcome Back</h2>
                            <p>Sign in to your account to continue</p>
                        </div>

                        <!-- Display Messages -->
                        @if(session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif

                        @if(session('error'))
                            <div class="alert alert-danger">{{ session('error') }}</div>
                        @endif

                        @if($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('login') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="email" class="form-label">Email Address</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                                    <input type="email" name="email" id="email" class="form-control" placeholder="Enter your email" required autofocus>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                    <input type="password" name="password" id="password" class="form-control" placeholder="Enter your password" required>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-login">Sign In</button>

                            <div class="login-options">
                                <span>Don't have an account? <a href="{{ route('resident.register') }}" class="register-link">Register as Resident</a></span>
                            </div>
                        </form>

                        <div class="footer-text">
                            <p>Barangay Cobol Management System v2.1 © 2024. All rights reserved.</p>
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
