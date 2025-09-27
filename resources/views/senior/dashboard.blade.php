<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Senior Dashboard</title>

    <!-- Bootstrap & Font Awesome -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <style>
        :root {
            --primary-color: #0d6efd;
            --sidebar-bg: #343a40;
            --header-bg: #2c3e50;
            --hover-color: #007bff;
            --text-light: #ffffff;
            --text-muted: #adb5bd;
            --transition-speed: 0.3s;
        }

        body {
            margin: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f5f5f5;
            overflow-x: hidden;
        }

        /* Header Row */
        .header-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0.75rem 1.5rem;
            background-color: var(--header-bg);
            color: var(--text-light);
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1000;
            height: 70px;
        }

        /* Menu Toggle Button */
        .menu-toggle {
            background: transparent;
            border: none;
            color: var(--text-light);
            font-size: 1.25rem;
            cursor: pointer;
            padding: 0.5rem;
            border-radius: 4px;
            transition: all var(--transition-speed) ease;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            position: relative;
            z-index: 1001;
        }

        .menu-toggle:hover {
            background-color: rgba(255, 255, 255, 0.1);
            transform: scale(1.05);
        }

        .menu-toggle:active {
            transform: scale(0.95);
        }

        /* Sidebar */
        .sidebar {
            width: 240px;
            height: 100vh;
            background: var(--sidebar-bg);
            color: var(--text-light);
            position: fixed;
            top: 0;
            left: 0;
            padding-top: 70px;
            transition: width var(--transition-speed) ease;
            overflow-x: hidden;
            white-space: nowrap;
            z-index: 999;
        }

        .sidebar.collapsed {
            width: 80px;
        }

        .sidebar ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .sidebar ul li {
            padding: 0;
        }

        .sidebar ul li a {
            display: flex;
            align-items: center;
            color: var(--text-light);
            text-decoration: none;
            font-size: 15px;
            transition: all var(--transition-speed) ease;
            padding: 12px 15px;
            border-left: 3px solid transparent;
        }

        .sidebar ul li a:hover {
            background-color: rgba(0, 0, 0, 0.2);
            border-left-color: var(--hover-color);
        }

        .sidebar ul li a i {
            margin-right: 15px;
            width: 24px;
            font-size: 1.1rem;
            text-align: center;
            transition: all var(--transition-speed) ease;
        }

        .sidebar ul li a:hover i,
        .sidebar ul li a:hover span {
            color: var(--hover-color);
        }

        .sidebar.collapsed ul li a span {
            display: none;
        }

        /* Active state */
        .sidebar ul li a.active {
            background-color: rgba(0, 0, 0, 0.3);
            border-left-color: var(--hover-color);
            color: var(--hover-color);
        }

        .sidebar ul li a.active i {
            color: var(--hover-color);
        }

        /* Profile Container */
        .profile-container {
    margin-left: auto;
}

.profile-btn {
    background: transparent;
    border: none;
    cursor: pointer;
    padding: 0.5rem;
    border-radius: 50px;
    transition: all 0.3s ease;
    color: var(--text-light);
}

.profile-btn:hover {
    background-color: rgba(255, 255, 255, 0.1);
}

.profile-img {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    object-fit: cover;
    border: 2px solid rgba(255, 255, 255, 0.3);
}

.profile-name {
    font-weight: 500;
    font-size: 0.9rem;
    line-height: 1.2;
}
.profile-container .dropdown-menu {
    transform: translate3d(-1px, 58.4px, 0px) !important;
}
/* Dropdown Menu */
.dropdown-menu {
    border: none;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    border-radius: 8px;
}

.dropdown-item {
    transition: all 0.2s ease;
    font-size: 0.9rem;
    color: #495057;
}

/* Blue hover for Edit Profile */
.dropdown-option:first-child .dropdown-item:hover {
    background-color: #e7f1ff;
    color: #0d6efd;
}

/* Red hover for Logout */
.dropdown-option:last-child .dropdown-item:hover {
    background-color: #fff0f0;
    color: #dc3545;
}

/* Icon alignment */
.fa-user-circle,
.fa-sign-out-alt {
    width: 1.25em;
    text-align: center;
}
        /* Main Content */
        .main-content {
            margin-left: 240px;
            padding: 90px 20px 20px;
            transition: margin-left var(--transition-speed) ease;
            min-height: 100vh;
        }

        .main-content.collapsed {
            margin-left: 80px;
        }

        .dashboard-box {
            background-color: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .dashboard-box h1 {
            color: #333;
            text-align: center;
        }

        .dashboard-box p {
            text-align: center;
            font-size: 18px;
            color: #555;
        }

        .login-link {
            display: block;
            text-align: center;
            background-color: #007bff;
            color: white;
            padding: 12px;
            border-radius: 5px;
            text-decoration: none;
            transition: background-color 0.3s;
        }

        .login-link:hover {
            background-color: #0056b3;
        }

    </style>
</head>
<body>

<!-- Sidebar Navigation -->
<nav class="sidebar" id="sidebar">
    <!-- Header Row -->
    <div class="header-row">
        <!-- Menu Toggle -->
        <button class="menu-toggle" onclick="toggleSidebar()">
            <i class="fa-solid fa-bars"></i>
        </button>
        <div class="profile-container dropdown">
            <button class="profile-btn dropdown-toggle d-flex align-items-center" data-bs-toggle="dropdown" aria-expanded="false">
                <img src="{{ Auth::user() && Auth::user()->image ? asset('storage/profile_images/' . Auth::user()->image) : asset('images/images1.jpg') }}"
                    alt="User Profile" class="profile-img me-2">
                <div class="d-flex flex-column">
                    <span class="profile-name">{{ Auth::user()->name ?? 'User' }}</span>
                </div>
            </button>

            <div class="dropdown-menu dropdown-menu-end" style="min-width: 170px;">
                <div class="dropdown-option">
                    <a href="{{ route('senior.profile')}}" class="dropdown-item d-flex align-items-center px-3 py-2 rounded">
                        <i class="fas fa-user-circle me-3"></i>
                        <span>Edit Profile</span>
                    </a>
                </div>
                <div class="dropdown-option">
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="dropdown-item d-flex align-items-center px-3 py-2 rounded w-100">
                            <i class="fas fa-sign-out-alt me-3"></i>
                            <span>Logout</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <ul>
        <li><a href="#" class="active"><i class="fas fa-home"></i> <span>Home</span></a></li>
        <li><a href="#"><i class="fas fa-user"></i> <span>Profile</span></a></li>
    </ul>
</nav>

<!-- Main Content -->
<div class="main-content" id="main-content">
    <div class="dashboard-box">
        <h1>Welcome to Senior Dashboard</h1>
        @auth
            <p>You are logged in as <strong>{{ Auth::user()->name }}</strong></p>
            <p>Email: <strong>{{ Auth::user()->email }}</strong></p>
        @else
            <p>Please log in to access this dashboard.</p>
            <a href="{{ route('login') }}" class="login-link">Login</a>
        @endauth
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        // Scripts can be added here
    });

    function toggleSidebar() {
        const sidebar = document.getElementById('sidebar');
        const mainContent = document.getElementById('main-content');
        const menuToggle = document.querySelector('.menu-toggle');

        sidebar.classList.toggle('collapsed');
        mainContent.classList.toggle('collapsed');
        menuToggle.classList.toggle('active');

        localStorage.setItem('sidebarCollapsed', sidebar.classList.contains('collapsed'));
    }

    window.addEventListener('load', function() {
        if (localStorage.getItem('sidebarCollapsed') === 'true') {
            document.getElementById('sidebar').classList.add('collapsed');
            document.getElementById('main-content').classList.add('collapsed');
        }
    });
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
