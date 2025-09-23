<!-- resources/views/user/dashboard.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <title>User Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        /* General Body Styling */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
        }

        /* Sidebar Styling */
        .sidebar {
            width: 260px;
            height: 100vh;
            background-color: #212529;
            padding: 20px;
            color: white;
            position: fixed;
            left: 0;
            top: 0;
        }

        .sidebar h2 {
            color: #fff;
            text-align: center;
            margin-bottom: 30px;
        }

        .sidebar ul {
            list-style-type: none;
            padding: 0;
            margin: 0;
        }

        .sidebar ul li {
            margin-bottom: 15px;
        }

        .sidebar ul li a {
            display: flex;
            align-items: center;
            padding: 12px;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            background-color: transparent;
            transition: background-color 0.3s;
        }

        .sidebar ul li a:hover {
            background-color: #007bff;
        }

        .sidebar ul li a.active {
            background-color: #007bff;
        }

        /* Logout Button */
        .sidebar form button {
            width: 100%;
            padding: 12px;
            color: #fff;
            background-color: #dc3545;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .sidebar form button:hover {
            background-color: #c82333;
        }

        /* Main Content Styling */
        .main-content {
            margin-left: 280px;
            padding: 20px;
            width: calc(100% - 280px);
            box-sizing: border-box;
        }

    </style>
</head>
<body>

<!-- Sidebar -->
<div class="sidebar">
    <h2>Dashboard</h2>
    <ul>
        <li>
            <a href="{{ route('sk.home') }}" class="{{ request()->routeIs('sk.home') ? 'active' : '' }}">
                <i class="fas fa-home me-3"></i> Home
            </a>
        </li>
        <li>
            <a href="#" class="{{ request()->routeIs('profile') ? 'active' : '' }}">
                <i class="fas fa-user me-3"></i> Profile
            </a>
        </li>
        <li>
            <a href="{{ route('sk.projects') }}" class="{{ request()->routeIs('sk.projects') ? 'active' : '' }}">
                <i class="fas fa-folder me-3"></i> Projects
            </a>
        </li>
        <li>
            <a href="{{ route('sk.services') }}" class="{{ request()->routeIs('sk.services') ? 'active' : '' }}">
                <i class="fas fa-cogs me-3"></i> Services
            </a>
        </li>
        <li>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit">
                    <i class="fas fa-sign-out-alt me-3"></i> Logout
                </button>
            </form>
        </li>
    </ul>
</div>

<!-- Main Content -->
<div class="main-content">
   @yield('content')
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
