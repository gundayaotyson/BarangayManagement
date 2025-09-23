<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin Dashboard</title>

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
    .profile-container .dropdown-menu {
    transform: translate3d(-1px, 58.4px, 0px) !important;
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

        /* Nested Dropdown */
        .dropdown-content {
            display: none;
            background-color: rgba(0, 0, 0, 0.2);
            padding-left: 15px;
        }

        .dropdown-content a {
            color: var(--text-muted) !important;
            font-size: 14px !important;
            padding: 8px 15px 8px 30px;
            position: relative;
        }

        .dropdown-content a:before {
            content: "→";
            position: absolute;
            left: 15px;
            color: var(--text-muted);
        }

        .dropdown-content a:hover {
            color: var(--hover-color) !important;
        }

        .dropdown-content a:hover:before {
            color: var(--hover-color);
        }

        .dropdown.active .dropdown-content {
            display: block;
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

        /* Animations */
        @keyframes pulse {
            0% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.1);
            }

            100% {
                transform: scale(1);
            }
        }

        .menu-toggle.active {
            animation: pulse 0.5s ease;
            color: var(--hover-color);
        }

        /* Responsive Adjustments */
        @media (max-width: 992px) {
            .sidebar {
                transform: translateX(-100%);
            }

            .sidebar.collapsed {
                transform: translateX(0);
                width: 80px;
            }

            .main-content {
                margin-left: 0;
            }

            .main-content.collapsed {
                margin-left: 80px;
            }

            .profile-name {
                display: none;
            }
        }

        @media (max-width: 576px) {
            .header-row {
                padding: 0.5rem;
            }

            .menu-toggle {
                width: 36px;
                height: 36px;
                font-size: 1.1rem;
            }
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
                <button class="profile-btn dropdown-toggle d-flex align-items-center" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    <img src="{{ Auth::user() && Auth::user()->image ? asset('storage/profile_images/' . Auth::user()->image) : asset('images/images1.jpg') }}"
                        alt="Admin Profile" class="profile-img me-2">
                    <div class="d-flex flex-column">
                        <span class="profile-name">{{ Auth::user()->name ?? 'User' }}</span>

                    </div>
                </button>

                <div class="dropdown-menu dropdown-menu-end" style="min-width: 170px;">
                    <div class="dropdown-option">
                        <a href="{{ route('partials.profile')}}"
                            class="dropdown-item d-flex align-items-center px-3 py-2 rounded">
                            <i class="fas fa-user-circle me-3"></i>
                            <span>Edit Profile</span>
                        </a>
                    </div>
                    <div class="dropdown-option">
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit"
                                class="dropdown-item d-flex align-items-center px-3 py-2 rounded w-100">
                                <i class="fas fa-sign-out-alt me-3"></i>
                                <span>Logout</span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <ul>
            <li><a href="{{ route('resident.dashboard') }}"
                    class="{{ request()->routeIs('resident.dashboard') ? 'active' : '' }}"><i class="fas fa-home"></i>
                    <span>Dashboard</span></a></li>
            <li><a href="{{ route('resident.services') }}"
                    class="{{ request()->routeIs('resident.services') ? 'active' : '' }}"><i
                        class="fas fa-concierge-bell"></i> <span>Barangay Services</span></a></li>
            <li><a href="{{ route('resident.complaints') }}"
                    class="{{ request()->routeIs('resident.complaints') ? 'active' : '' }}"><i
                        class="fas fa-comment-dots"></i> <span>Complaint & Feedback</span></a></li>
            <li><a href="{{ route('resident.requests') }}"
                    class="{{ request()->routeIs('resident.requests') ? 'active' : '' }}"><i
                        class="fas fa-file-alt"></i> <span>My request</span></a></li>
        </ul>
    </nav>

    <!-- Main Content -->
    <div class="main-content" id="main-content">
        @yield('content')
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            // Set active link based on current route
            const currentPath = window.location.pathname;
            const links = document.querySelectorAll(".sidebar ul li a");

            links.forEach(link => {
                if (link.getAttribute('href') === currentPath) {
                    link.classList.add('active');

                    // If this is a nested link, ensure parent dropdown is visible
                    const dropdown = link.closest('.dropdown-content');
                    if (dropdown) {
                        dropdown.style.display = 'block';
                        dropdown.previousElementSibling.classList.add('active');
                    }
                }

                link.addEventListener("click", function (e) {
                    if (this.getAttribute('href') === '#') return;

                    links.forEach(l => l.classList.remove("active"));
                    this.classList.add("active");
                    localStorage.setItem("activeLink", this.getAttribute("href"));
                });
            });

            // Restore active link from localStorage
            const activeLink = localStorage.getItem("activeLink");
            if (activeLink) {
                links.forEach(link => {
                    if (link.getAttribute("href") === activeLink) {
                        link.classList.add("active");
                    }
                });
            }
        });

        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const mainContent = document.getElementById('main-content');
            const menuToggle = document.querySelector('.menu-toggle');

            sidebar.classList.toggle('collapsed');
            mainContent.classList.toggle('collapsed');
            menuToggle.classList.toggle('active');

            // Store sidebar state in localStorage
            localStorage.setItem('sidebarCollapsed', sidebar.classList.contains('collapsed'));
        }

        function toggleDropdown(event) {
            event.preventDefault();
            let dropdown = event.target.closest('.dropdown');
            dropdown.classList.toggle('active');

            // Close other dropdowns when opening a new one
            if (dropdown.classList.contains('active')) {
                document.querySelectorAll('.dropdown').forEach(item => {
                    if (item !== dropdown) {
                        item.classList.remove('active');
                    }
                });
            }
        }

        // Initialize sidebar state from localStorage
        window.addEventListener('load', function () {
            if (localStorage.getItem('sidebarCollapsed') === 'true') {
                document.getElementById('sidebar').classList.add('collapsed');
                document.getElementById('main-content').classList.add('collapsed');
            }
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
