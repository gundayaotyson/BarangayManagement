@extends('admin.dashboard')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Senior Citizen Management System</title>

    <!-- Bootstrap & Font Awesome -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <style>
        :root {
            --primary-color: #2c3e50;
            --secondary-color: #3498db;
            --accent-color: #e74c3c;
            --success-color: #2ecc71;
            --warning-color: #f39c12;
            --light-color: #ecf0f1;
            --dark-color: #2c3e50;
            --card-bg: #ffffff;
            --border-radius: 16px;
            --box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        body {
            margin: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #f5f7fa 0%, #e4edf5 100%);
            overflow-x: hidden;
            color: var(--dark-color);
        }

        /* Main Content */
        .main-content {
            margin-left: 240px;
            padding: 100px 30px 30px;
            transition: margin-left var(--transition) ease;
            min-height: 100vh;
        }

        .main-content.collapsed {
            margin-left: 80px;
        }

        /* Dashboard Container */
        .dashboard-container {
            max-width: 1400px;
            margin: 0 auto;
        }

        /* Page Header */
        .page-header {
            background: #2c3e50;
            color: white;
            padding: 2rem;
            border-radius: var(--border-radius);
            margin-bottom: 2rem;
            box-shadow: var(--box-shadow);
            position: relative;
            overflow: hidden;
        }

        .page-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url("data:image/svg+xml,%3Csvg width='100' height='100' viewBox='0 0 100 100' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M11 18c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm48 25c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm-43-7c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm63 31c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM34 90c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm56-76c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM12 86c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm28-65c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm23-11c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-6 60c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm29 22c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zM32 63c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm57-13c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-9-21c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM60 91c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM35 41c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM12 60c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2z' fill='%23ffffff' fill-opacity='0.05' fill-rule='evenodd'/%3E%3C/svg%3E");
            opacity: 0.1;
        }

        .header-content {
            position: relative;
            z-index: 1;
        }

        .page-title {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .page-title i {
            font-size: 2rem;
            background: rgba(255, 255, 255, 0.2);
            width: 60px;
            height: 60px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .page-subtitle {
            font-size: 1.1rem;
            opacity: 0.9;
            max-width: 600px;
            line-height: 1.6;
        }

        /* Statistics Cards */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .stat-card {
            background: var(--card-bg);
            border-radius: var(--border-radius);
            padding: 1.75rem;
            box-shadow: var(--box-shadow);
            transition: var(--transition);
            position: relative;
            overflow: hidden;
            border-left: 4px solid var(--secondary-color);
        }

        .stat-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.12);
        }

        .stat-card.total {
            border-left-color: var(--primary-color);
        }

        .stat-card.matched {
            border-left-color: var(--success-color);
        }

        .stat-card.unmatched {
            border-left-color: var(--warning-color);
        }

        .stat-card-icon {
            position: absolute;
            top: 1.75rem;
            right: 1.75rem;
            font-size: 2.5rem;
            opacity: 100;
            color: var(--dark-color);
        }

        .stat-value {
            font-size: 2.5rem;
            font-weight: 800;
            color: var(--dark-color);
            margin-bottom: 0.5rem;
            line-height: 1;
        }

        .stat-label {
            font-size: 1rem;
            color: #666;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-weight: 600;
        }

        .stat-change {
            font-size: 0.85rem;
            color: var(--success-color);
            margin-top: 0.75rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        /* Main Content Card */
        .content-card {
            background: var(--card-bg);
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
            margin-bottom: 2rem;
            overflow: hidden;
        }

        .card-header {
            background: var(--primary-color);
            padding: 1.75rem 2rem;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .card-title {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .card-title-icon {
            width: 50px;
            height: 50px;
            border-radius: 12px;
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.5rem;
        }

        .card-title-text h2 {
            font-size: 1.75rem;
            font-weight: 700;
            color: var(--dark-color);
            margin: 0;
        }

        .card-title-text p {
            font-size: 0.95rem;
            color: #666;
            margin: 0.25rem 0 0 0;
        }

        .card-actions {
            display: flex;
            gap: 1rem;
            flex-wrap: wrap;
        }

        /* Enhanced Search Bar */
        .search-container {
            position: relative;
            flex: 1;
            min-width: 300px;
            max-width: 500px;
        }

        .search-wrapper {
            position: relative;
            width: 100%;
        }

        .search-input {
            width: 100%;
            padding: 0.875rem 1rem 0.875rem 3.5rem;
            border: 2px solid #e0e6ed;
            border-radius: 12px;
            font-size: 1rem;
            background: white;
            transition: var(--transition);
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        }

        .search-input:focus {
            outline: none;
            border-color: var(--secondary-color);
            box-shadow: 0 4px 15px rgba(52, 152, 219, 0.2);
            transform: translateY(-1px);
        }

        .search-icon {
            position: absolute;
            left: 1.25rem;
            top: 50%;
            transform: translateY(-50%);
            color: #94a3b8;
            font-size: 1.1rem;
            pointer-events: none;
        }

        /* Buttons */
        .btn {
            padding: 0.875rem 1.75rem;
            border-radius: 12px;
            font-weight: 600;
            font-size: 0.95rem;
            transition: var(--transition);
            border: none;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            white-space: nowrap;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            color: white;
            box-shadow: 0 4px 15px rgba(52, 152, 219, 0.3);
        }

        .btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(52, 152, 219, 0.4);
        }

        .btn-success {
            background: linear-gradient(135deg, var(--success-color) 0%, #27ae60 100%);
            color: white;
            box-shadow: 0 4px 15px rgba(46, 204, 113, 0.3);
        }

        .btn-success:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(46, 204, 113, 0.4);
        }

        .btn-outline {
            background: transparent;
            border: 2px solid var(--secondary-color);
            color: var(--secondary-color);
        }

        .btn-outline:hover {
            background: var(--secondary-color);
            color: white;
            transform: translateY(-3px);
            box-shadow: 0 4px 15px rgba(52, 152, 219, 0.3);
        }

        /* Table Container */
        .table-container {
            overflow-x: auto;
            padding: 0 2rem 2rem 2rem;
        }

        /* Enhanced Table */
        .table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            min-width: 1000px;
            background: white;
        }

        .table thead {
            background: var(--primary-color) ;
            color: white;
        }

        .table th {
            background-color: var(--primary-color);
            padding: 1.25rem 1.5rem;
            text-align: left;
            font-weight: 600;
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            border: none;
            color: white;
        }

        .table th:first-child {
            border-top-left-radius: 8px;
        }

        .table th:last-child {
            border-top-right-radius: 8px;
        }

        .table tbody tr {
            transition: var(--transition);
            border-bottom: 1px solid #f1f5f9;
        }

        /* .table tbody tr:hover {
            background-color: rgba(52, 152, 219, 0.05);
            transform: translateX(4px);
        } */

        .table td {
            padding: 1.25rem 1.5rem;
            vertical-align: middle;
            border: none;
        }

        /* Senior Info Cells */
        .senior-info {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .senior-avatar {
            width: 45px;
            height: 45px;
            border-radius: 12px;
            background: linear-gradient(135deg, var(--secondary-color) 0%, #2980b9 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
            font-size: 1.1rem;
            flex-shrink: 0;
        }

        .senior-details h4 {
            margin: 0;
            font-weight: 600;
            color: var(--dark-color);
            font-size: 1.05rem;
        }

        .senior-details p {
            margin: 0.25rem 0 0 0;
            font-size: 0.85rem;
            color: #666;
        }

        .birthday-cell {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .birthday-icon {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            background: rgba(52, 152, 219, 0.1);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--secondary-color);
            font-size: 1rem;
            flex-shrink: 0;
        }

        .birthday-info .date {
            font-weight: 600;
            color: var(--dark-color);
        }

        .birthday-info .age {
            font-size: 0.85rem;
            color: #666;
        }

        /* ID Badges */
        .id-badge {
            padding: 0.5rem 1rem;
            border-radius: 8px;
            font-size: 0.85rem;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            min-width: 120px;
        }

        .id-badge.osca {
            background: rgba(52, 152, 219, 0.1);
            color: #1976d2;
            border: 1px solid rgba(52, 152, 219, 0.2);
        }

        .id-badge.fcap {
            background: rgba(243, 156, 18, 0.1);
            color: #f57c00;
            border: 1px solid rgba(243, 156, 18, 0.2);
        }

        /* Status Badges */
        .status-badge {
            padding: 0.5rem 1.25rem;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .status-badge.matched {
            background: rgba(46, 204, 113, 0.1);
            color: var(--success-color);
            border: 1px solid rgba(46, 204, 113, 0.2);
        }

        .status-badge.unmatched {
            background: rgba(231, 76, 60, 0.1);
            color: var(--accent-color);
            border: 1px solid rgba(231, 76, 60, 0.2);
        }

        /* Action Buttons */
        .action-buttons {
            display: flex;
            gap: 0.5rem;
            justify-content: flex-start;
        }

        .action-btn {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: transparent;
            border: 1px solid #e0e6ed;
            color: #64748b;
            cursor: pointer;
            transition: var(--transition);
        }

        .action-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .action-btn.view:hover {
            background: var(--secondary-color);
            color: white;
            border-color: var(--secondary-color);
        }

        .action-btn.edit:hover {
            background: var(--warning-color);
            color: white;
            border-color: var(--warning-color);
        }

        .action-btn.delete:hover {
            background: var(--accent-color);
            color: white;
            border-color: var(--accent-color);
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 4rem 2rem;
            color: #666;
        }

        .empty-state-icon {
            font-size: 4rem;
            margin-bottom: 1.5rem;
            opacity: 0.2;
            color: var(--dark-color);
        }

        .empty-state h3 {
            font-size: 1.75rem;
            margin-bottom: 0.75rem;
            color: var(--dark-color);
        }

        .empty-state p {
            max-width: 500px;
            margin: 0 auto 2rem auto;
            line-height: 1.6;
        }

        /* Modal Enhancements */
        .modal-content {
            border: none;
            border-radius: var(--border-radius);
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.15);
            overflow: hidden;
        }

        .modal-header {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            color: white;
            padding: 1.75rem 2rem;
            border-bottom: none;
        }

        .modal-title {
            font-weight: 700;
            font-size: 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .btn-close-white {
            filter: invert(1) grayscale(100%) brightness(200%);
            opacity: 0.8;
        }

        .modal-body {
            padding: 2rem;
        }

        /* Resident Details Modal */
        .resident-details-modal .modal-dialog {
            max-width: 900px;
        }

        .resident-profile {
            display: flex;
            align-items: center;
            gap: 2rem;
            margin-bottom: 2rem;
            padding-bottom: 2rem;
            border-bottom: 1px solid #f1f5f9;
        }

        .resident-photo {
            width: 120px;
            height: 120px;
            border-radius: 20px;
            overflow: hidden;
            border: 4px solid white;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
            flex-shrink: 0;
        }

        .resident-photo img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .resident-basic-info h3 {
            font-size: 1.75rem;
            font-weight: 700;
            color: var(--dark-color);
            margin: 0 0 0.5rem 0;
        }

        .resident-meta {
            display: flex;
            gap: 1.5rem;
            flex-wrap: wrap;
            margin-top: 1rem;
        }

        .resident-meta-item {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.95rem;
            color: #666;
        }

        .resident-meta-item i {
            color: var(--secondary-color);
            font-size: 1rem;
        }

        /* Info Grid */
        .info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
        }

        .info-section {
            margin-bottom: 2rem;
        }

        .info-section h5 {
            font-size: 1.1rem;
            font-weight: 600;
            color: var(--dark-color);
            margin-bottom: 1rem;
            padding-bottom: 0.5rem;
            border-bottom: 2px solid #f1f5f9;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .info-item {
            margin-bottom: 1rem;
        }

        .info-label {
            font-size: 0.85rem;
            color: #64748b;
            margin-bottom: 0.25rem;
            font-weight: 500;
        }

        .info-value {
            font-size: 1rem;
            font-weight: 600;
            color: var(--dark-color);
            word-break: break-word;
        }

        /* Responsive Design */
        @media (max-width: 1200px) {
            .main-content {
                margin-left: 80px;
                padding: 90px 20px 20px;
            }

            .search-container {
                min-width: 250px;
            }
        }

        @media (max-width: 992px) {
            .page-header {
                padding: 1.5rem;
            }

            .page-title {
                font-size: 2rem;
            }

            .card-header {
                flex-direction: column;
                align-items: stretch;
                gap: 1.5rem;
            }

            .card-actions {
                width: 100%;
                justify-content: flex-start;
            }

            .search-container {
                max-width: 100%;
                min-width: 100%;
            }

            .table-container {
                padding: 0 1rem 1rem 1rem;
            }

            .table th,
            .table td {
                padding: 1rem;
            }
        }

        @media (max-width: 768px) {
            .main-content {
                margin-left: 0;
                padding: 80px 15px 15px;
            }

            .stats-grid {
                grid-template-columns: 1fr;
            }

            .resident-profile {
                flex-direction: column;
                text-align: center;
                gap: 1.5rem;
            }

            .resident-meta {
                justify-content: center;
            }

            .info-grid {
                grid-template-columns: 1fr;
            }

            .table {
                min-width: 700px;
            }
        }

        @media (max-width: 576px) {
            .page-title {
                font-size: 1.75rem;
            }

            .page-title i {
                width: 50px;
                height: 50px;
                font-size: 1.5rem;
            }

            .btn {
                padding: 0.75rem 1.25rem;
                font-size: 0.9rem;
            }

            .modal-body {
                padding: 1.5rem;
            }

            .resident-meta {
                flex-direction: column;
                gap: 0.75rem;
                align-items: center;
            }
        }

        /* Animations */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .fade-in {
            animation: fadeIn 0.5s ease-out;
        }

        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb {
            background: var(--secondary-color);
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #2980b9;
        }

        /* Loading States */
        .loading-shimmer {
            background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
            background-size: 200% 100%;
            animation: shimmer 1.5s infinite;
            border-radius: 4px;
        }

        @keyframes shimmer {
            0% {
                background-position: -200% 0;
            }
            100% {
                background-position: 200% 0;
            }
        }
    </style>
</head>
<body>

<div class="main-content" id="main-content">
    <div class="dashboard-container">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
                <div class="d-flex align-items-center">
                    <i class="fas fa-check-circle me-2" style="font-size: 1.2rem;"></i>
                    <div>{{ session('success') }}</div>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show shadow-sm" role="alert">
                <div class="d-flex align-items-center">
                    <i class="fas fa-exclamation-triangle me-2" style="font-size: 1.2rem;"></i>
                    <div>
                        <strong>Please fix the following errors:</strong>
                        <ul class="mb-0 mt-2">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <!-- Page Header -->
        <div class="page-header fade-in">
            <div class="header-content">
                <h1 class="page-title">
                    <i class="fas fa-user-circle"></i>
                    <span>Senior Citizen List</span>
                </h1>
                <p class="page-subtitle">
                    Manage senior citizen records, OSCA/FCAP IDs, and resident matching for comprehensive senior care program.
                </p>
            </div>
        </div>

        <!-- Statistics Overview -->
        <div class="stats-grid fade-in" style="animation-delay: 0.1s;">
            @php
                $totalSeniors = count($seniors);
                $matchedSeniors = $seniors->where('resident', '!=', null)->count();
                $unmatchedSeniors = $totalSeniors - $matchedSeniors;
                $averageAge = $seniors->avg(function($senior) {
                    return \Carbon\Carbon::parse($senior->birthday)->age;
                });
            @endphp

            <div class="stat-card total">
                <i class="fas fa-users stat-card-icon"></i>
                <div class="stat-value">{{ number_format($totalSeniors) }}</div>
                <div class="stat-label">Total Seniors</div>
                <div class="stat-change">
                    <i class="fas fa-chart-line"></i>
                    <span>Registered in System</span>
                </div>
            </div>

            <div class="stat-card matched">
                <i class="fas fa-link stat-card-icon"></i>
                <div class="stat-value">{{ number_format($matchedSeniors) }}</div>
                <div class="stat-label">Resident Matched</div>
                <div class="stat-change">
                    <i class="fas fa-percentage"></i>
                    <span>{{ $totalSeniors > 0 ? number_format(($matchedSeniors/$totalSeniors)*100, 1) : 0 }}% Success Rate</span>
                </div>
            </div>

            <div class="stat-card unmatched">
                <i class="fas fa-unlink stat-card-icon"></i>
                <div class="stat-value">{{ number_format($unmatchedSeniors) }}</div>
                <div class="stat-label">Unmatched Records</div>
                <div class="stat-change">
                    <i class="fas fa-exclamation-circle"></i>
                    <span>Requires Attention</span>
                </div>
            </div>

            <div class="stat-card">
                <i class="fas fa-birthday-cake stat-card-icon"></i>
                <div class="stat-value">{{ $averageAge ? number_format($averageAge, 1) : '0.0' }}</div>
                <div class="stat-label">Average Age</div>
                <div class="stat-change">
                    <i class="fas fa-user-clock"></i>
                    <span>Senior Population Age</span>
                </div>
            </div>
        </div>

        <!-- Main Content Card -->
        <div class="content-card fade-in" style="animation-delay: 0.2s;">
            <div class="card-header">
                <div class="card-title">
                    <div class="card-title-icon">
                        <i class="fas fa-list"></i>
                    </div>
                    <div class="card-title-text">
                        <h2>Senior Citizen Registry</h2>
                        <p>Complete list of registered senior citizens with OSCA/FCAP IDs</p>
                    </div>
                </div>
                <div class="card-actions">
                    <div class="search-container">
                        <div class="search-wrapper">
                            <input type="text" id="searchInput" class="form-control search-input"
                            placeholder="Search by name, OSCA ID, or FCAP ID...">
                        </div>
                    </div>
                    <div class="d-flex gap-2">
                         <button class="btn btn-primary add-senior-btn" data-bs-toggle="modal" data-bs-target="#addSeniorModal">
                            <i class="fas fa-plus"></i> Add Senior
                        </button>
                        <!-- <button class="btn btn-outline">
                            <i class="fas fa-download"></i> Export
                        </button> -->
                        <div class="d-flex gap-2 align-items-center mb-2">
                            <!-- PUROK FILTER -->
                            <select id="purokFilter" class="form-select" style="max-width: 180px;">
                                <option value="">All Purok</option>
                                @php
                                    $puroks = $seniors->filter(fn($s) => $s->resident)
                                                    ->pluck('resident.purok_no')
                                                    ->unique()
                                                    ->sort();
                                @endphp
                                @foreach($puroks as $purok)
                                    <option value="{{ strtolower($purok) }}">{{ $purok }}</option>
                                @endforeach
                            </select>

                            <!-- MONTH FILTER -->
                            <select id="monthFilter" class="form-select" style="max-width: 180px;">
                                <option value="">All Months</option>
                                @foreach(range(1,12) as $month)
                                    <option value="{{ $month }}">
                                        {{ \Carbon\Carbon::create()->month($month)->format('F') }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <button class="btn btn-outline" id="refreshBtn">
                            <i class="fas fa-sync-alt"></i> Refresh
                        </button>
                    </div>
                </div>
            </div>

            <div class="table-container">
                @if($seniors->count() > 0)
                <table class="table table-hover" id="seniorTable">
                    <thead>
                        <tr>
                            <th>Senior Information</th>
                            <th>Birth Details</th>
                            <th>OSCA ID</th>
                            <th>FCAP ID</th>
                            <th>Resident Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($seniors as $senior)
                        <tr class="fade-in" style="animation-delay: {{ $loop->index * 0.05 }}s;"
                            data-search="{{ strtolower($senior->firstname . ' ' . $senior->middlename . ' ' . $senior->lastname . ' ' . $senior->osca_id . ' ' . $senior->fcap_id) }}"
                               data-purok=""
                                data-month="{{ \Carbon\Carbon::parse($senior->birthday)->month }}"
                            >
                            <td>
                                <div class="senior-info">
                                    <div class="senior-avatar">
                                        {{ substr($senior->firstname, 0, 1) }}{{ substr($senior->lastname, 0, 1) }}
                                    </div>
                                    <div class="senior-details">
                                        <h4>{{ $senior->firstname }} {{ $senior->middlename }} {{ $senior->lastname }}</h4>
                                        <p>
                                            <i class="fas fa-id-card me-1"></i> Record #{{ $loop->iteration + 1000 }}
                                        </p>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="birthday-cell">
                                    <div class="birthday-icon">
                                        <i class="fas fa-birthday-cake"></i>
                                    </div>
                                    <div class="birthday-info">
                                        <div class="date">
                                            {{ \Carbon\Carbon::parse($senior->birthday)->format('M d, Y') }}
                                        </div>
                                        <div class="age">
                                            {{ \Carbon\Carbon::parse($senior->birthday)->age }} years old
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="id-badge osca">
                                        <i class="fas fa-id-card-alt"></i>
                                        {{ $senior->osca_id }}
                                    </span>
                            </td>
                            <td>
                                <span class="id-badge fcap">
                                        <i class="fas fa-id-badge"></i>
                                        {{ $senior->fcap_id }}
                                    </span>
                            </td>
                            <td>
                                @if ($senior->resident)
                                <div class="d-flex flex-column gap-2">
                                    <span class="status-badge matched">
                                        <i class="fas fa-check-circle"></i> Matched
                                    </span>
                                    <button class="btn btn-success btn-sm" onclick="openResidentModal({{ $senior->id }})">
                                        <i class="fas fa-eye me-1"></i> View Details
                                    </button>
                                </div>
                                @else
                                    <span class="status-badge unmatched">
                                        <i class="fas fa-exclamation-circle"></i> No Match
                                    </span>
                                @endif
                            </td>
                            <td>
                                <div class="action-buttons">
                                    <button class="action-btn view" onclick="openViewModal({{$senior->id}})" title="View Details">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button class="action-btn edit" onclick="openEditModal({{$senior->id}})" title="Edit Senior">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <form action="{{ route('senior.destroy', $senior) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="action-btn delete" onclick="return confirm('Are you sure you want to delete this senior record?')" title="Delete">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @else
                <div class="empty-state">
                    <div class="empty-state-icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <h3>No Senior Citizens Found</h3>
                    <p>There are no senior citizen records in the database yet. Start by adding your first senior citizen.</p>
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addSeniorModal">
                        <i class="fas fa-user-plus me-2"></i>Add First Senior Citizen
                    </button>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Add Senior Modal -->
<div class="modal fade" id="addSeniorModal" tabindex="-1" aria-labelledby="addSeniorModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addSeniorModalLabel">
            <i class="fas fa-user-plus me-2"></i>Add New Senior Citizen
        </h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="{{ route('senior.store') }}" method="POST" id="addSeniorForm">
            @csrf
            <div class="row g-3">
                <div class="col-md-4">
                    <label for="firstname" class="form-label">First Name *</label>
                    <input type="text" class="form-control" id="firstname" name="firstname" required>
                </div>
                <div class="col-md-4">
                    <label for="lastname" class="form-label">Last Name *</label>
                    <input type="text" class="form-control" id="lastname" name="lastname" required>
                </div>
                <div class="col-md-4">
                    <label for="middlename" class="form-label">Middle Name</label>
                    <input type="text" class="form-control" id="middlename" name="middlename">
                </div>
            </div>

            <div class="row g-3 mt-3">
                <div class="col-md-6">
                    <label for="birthday" class="form-label">Birthday *</label>
                    <input type="date" class="form-control" id="birthday" name="birthday" required>
                </div>
                <div class="col-md-6">
                    <label for="osca_id" class="form-label">OSCA ID *</label>
                    <input type="text" class="form-control" id="osca_id" name="osca_id" required>
                </div>
            </div>

            <div class="mt-3">
                <label for="fcap_id" class="form-label">FCAP ID *</label>
                <input type="text" class="form-control" id="fcap_id" name="fcap_id" required>
            </div>

            <div class="modal-footer mt-4">
                <button type="button" class="btn btn-outline" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save me-2"></i>Save Senior
                </button>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- View Senior Modal -->
<div class="modal fade" id="viewSeniorModal" tabindex="-1" aria-labelledby="viewSeniorModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="viewSeniorModalLabel">
            <i class="fas fa-user-circle me-2"></i>Senior Citizen Details
        </h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div id="viewSeniorContent"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<!-- Edit Senior Modal -->
<div class="modal fade" id="editSeniorModal" tabindex="-1" aria-labelledby="editSeniorModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editSeniorModalLabel">
            <i class="fas fa-edit me-2"></i>Edit Senior Citizen
        </h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="editSeniorForm" method="POST">
            @csrf
            @method('PUT')
            <div class="row g-3">
                <div class="col-md-4">
                    <label for="edit_firstname" class="form-label">First Name *</label>
                    <input type="text" class="form-control" id="edit_firstname" name="firstname" required>
                </div>
                <div class="col-md-4">
                    <label for="edit_lastname" class="form-label">Last Name *</label>
                    <input type="text" class="form-control" id="edit_lastname" name="lastname" required>
                </div>
                <div class="col-md-4">
                    <label for="edit_middlename" class="form-label">Middle Name</label>
                    <input type="text" class="form-control" id="edit_middlename" name="middlename">
                </div>
            </div>

            <div class="row g-3 mt-3">
                <div class="col-md-6">
                    <label for="edit_birthday" class="form-label">Birthday *</label>
                    <input type="date" class="form-control" id="edit_birthday" name="birthday" required>
                </div>
                <div class="col-md-6">
                    <label for="edit_osca_id" class="form-label">OSCA ID *</label>
                    <input type="text" class="form-control" id="edit_osca_id" name="osca_id" required>
                </div>
            </div>

            <div class="mt-3">
                <label for="edit_fcap_id" class="form-label">FCAP ID *</label>
                <input type="text" class="form-control" id="edit_fcap_id" name="fcap_id" required>
            </div>

            <div class="modal-footer mt-4">
                <button type="button" class="btn btn-outline" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save me-2"></i>Update Senior
                </button>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Resident Details Modal -->
<div class="modal fade resident-details-modal" id="viewResidentDetailsModal" tabindex="-1" aria-labelledby="viewResidentDetailsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewResidentDetailsModalLabel">
                    <i class="fas fa-user-check me-2"></i>Resident Details
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="residentContent">
                    <!-- Content will be loaded here -->
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<script>
document.addEventListener('DOMContentLoaded', function () {

    const purokFilter  = document.getElementById('purokFilter');
    const monthFilter  = document.getElementById('monthFilter');
    const searchInput  = document.getElementById('searchInput');
    const rows         = document.querySelectorAll('#seniorTable tbody tr');

    function filterTable() {
        const purokValue  = purokFilter.value;
        const monthValue  = monthFilter.value;
        const searchValue = searchInput.value.toLowerCase();

        rows.forEach(row => {
            const rowPurok  = row.getAttribute('data-purok');
            const rowMonth  = row.getAttribute('data-month');
            const rowSearch = row.getAttribute('data-search');

            const matchPurok  = !purokValue || rowPurok === purokValue;
            const matchMonth  = !monthValue || rowMonth === monthValue;
            const matchSearch = !searchValue || rowSearch.includes(searchValue);

            row.style.display = (matchPurok && matchMonth && matchSearch) ? '' : 'none';
        });
    }

    purokFilter.addEventListener('change', filterTable);
    monthFilter.addEventListener('change', filterTable);
    searchInput.addEventListener('keyup', filterTable);
});
</script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Enhanced search functionality
    const searchInput = document.getElementById('searchInput');
    if (searchInput) {
        searchInput.addEventListener('input', function() {
            const searchText = this.value.toLowerCase().trim();
            const rows = document.querySelectorAll('#seniorTable tbody tr');
            let hasVisibleRows = false;

            rows.forEach(row => {
                const searchData = row.getAttribute('data-search') ||
                                 row.textContent.toLowerCase();
                const isVisible = searchText === '' || searchData.includes(searchText);
                row.style.display = isVisible ? '' : 'none';
                if (isVisible) hasVisibleRows = true;
            });

            // Show empty state if no results
            const emptyState = document.querySelector('.empty-state');
            if (emptyState && searchText !== '') {
                emptyState.style.display = hasVisibleRows ? 'none' : 'block';
            }
        });

        // Add clear search button
        const searchWrapper = document.querySelector('.search-wrapper');
        const clearBtn = document.createElement('button');
        clearBtn.innerHTML = '<i class="fas fa-times"></i>';
        clearBtn.type = 'button';
        clearBtn.className = 'btn btn-sm position-absolute end-0 top-50 translate-middle-y me-2 d-none';
        clearBtn.style.background = 'transparent';
        clearBtn.style.border = 'none';
        clearBtn.style.color = '#94a3b8';
        clearBtn.style.zIndex = '10';

        clearBtn.addEventListener('click', function() {
            searchInput.value = '';
            searchInput.focus();
            searchInput.dispatchEvent(new Event('input'));
            this.classList.add('d-none');
        });

        searchWrapper.appendChild(clearBtn);

        searchInput.addEventListener('input', function() {
            clearBtn.classList.toggle('d-none', this.value === '');
        });
    }

    // Auto-dismiss alerts
    const alerts = document.querySelectorAll('.alert');
    alerts.forEach(alert => {
        setTimeout(() => {
            const bsAlert = bootstrap.Alert.getOrCreateInstance(alert);
            bsAlert.close();
        }, 5000);
    });

    // Refresh button
    const refreshBtn = document.getElementById('refreshBtn');
    if (refreshBtn) {
        refreshBtn.addEventListener('click', function() {
            this.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Refreshing...';
            this.disabled = true;

            setTimeout(() => {
                location.reload();
            }, 1000);
        });
    }

    // Form validation for add senior
    const addForm = document.getElementById('addSeniorForm');
    if (addForm) {
        addForm.addEventListener('submit', function(e) {
            const birthday = new Date(document.getElementById('birthday').value);
            const today = new Date();
            const age = today.getFullYear() - birthday.getFullYear();

            if (age < 60) {
                e.preventDefault();
                alert('Senior citizen must be at least 60 years old.');
                return false;
            }
            return true;
        });
    }
});

async function openViewModal(id) {
    try {
        const response = await fetch(`/seniors/${id}/json`);
        if (!response.ok) throw new Error('Failed to fetch senior data');
        const senior = await response.json();

        const age = Math.floor((new Date() - new Date(senior.birthday)) / (365.25 * 24 * 60 * 60 * 1000));

        const content = `
            <div class="resident-profile">
                <div class="resident-photo">
                    <div style="width: 100%; height: 100%; background: linear-gradient(135deg, #3498db 0%, #2980b9 100%);
                         display: flex; align-items: center; justify-content: center; color: white; font-size: 2.5rem; font-weight: 600;">
                        ${senior.firstname.charAt(0)}${senior.lastname.charAt(0)}
                    </div>
                </div>
                <div class="resident-basic-info">
                    <h3>${senior.firstname} ${senior.middlename || ''} ${senior.lastname}</h3>
                    <div class="resident-meta">
                        <div class="resident-meta-item">
                            <i class="fas fa-birthday-cake"></i>
                            <span>${age} years old</span>
                        </div>
                        <div class="resident-meta-item">
                            <i class="fas fa-calendar-alt"></i>
                            <span>Born: ${new Date(senior.birthday).toLocaleDateString('en-US', {
                                year: 'numeric',
                                month: 'long',
                                day: 'numeric'
                            })}</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="info-grid">
                <div class="info-section">
                    <h5><i class="fas fa-id-card"></i> Identification</h5>
                    <div class="info-item">
                        <div class="info-label">OSCA ID</div>
                        <div class="info-value">${senior.osca_id}</div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">FCAP ID</div>
                        <div class="info-value">${senior.fcap_id}</div>
                    </div>
                </div>

                <div class="info-section">
                    <h5><i class="fas fa-user"></i> Personal Information</h5>
                    <div class="info-item">
                        <div class="info-label">Full Name</div>
                        <div class="info-value">${senior.firstname} ${senior.middlename || ''} ${senior.lastname}</div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">Birthdate</div>
                        <div class="info-value">${new Date(senior.birthday).toLocaleDateString('en-US', {
                            year: 'numeric',
                            month: 'long',
                            day: 'numeric'
                        })}</div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">Age</div>
                        <div class="info-value">${age} years old</div>
                    </div>
                </div>

                <div class="info-section">
                    <h5><i class="fas fa-history"></i> Record Information</h5>
                    <div class="info-item">
                        <div class="info-label">Date Registered</div>
                        <div class="info-value">${senior.created_at ? new Date(senior.created_at).toLocaleDateString('en-US', {
                            year: 'numeric',
                            month: 'long',
                            day: 'numeric'
                        }) : 'N/A'}</div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">Last Updated</div>
                        <div class="info-value">${senior.updated_at ? new Date(senior.updated_at).toLocaleDateString('en-US', {
                            year: 'numeric',
                            month: 'long',
                            day: 'numeric'
                        }) : 'N/A'}</div>
                    </div>
                </div>
            </div>
        `;

        document.getElementById('viewSeniorContent').innerHTML = content;
        const modal = new bootstrap.Modal(document.getElementById('viewSeniorModal'));
        modal.show();
    } catch (error) {
        console.error('Error:', error);
        alert('Failed to load senior details. Please try again.');
    }
}

async function openEditModal(id) {
    try {
        const response = await fetch(`/seniors/${id}/json`);
        if (!response.ok) throw new Error('Failed to fetch senior data');
        const senior = await response.json();

        document.getElementById('edit_firstname').value = senior.firstname;
        document.getElementById('edit_lastname').value = senior.lastname;
        document.getElementById('edit_middlename').value = senior.middlename || '';
        document.getElementById('edit_birthday').value = senior.birthday;
        document.getElementById('edit_osca_id').value = senior.osca_id;
        document.getElementById('edit_fcap_id').value = senior.fcap_id;
        document.getElementById('editSeniorForm').action = `/seniors/${id}`;

        const modal = new bootstrap.Modal(document.getElementById('editSeniorModal'));
        modal.show();
    } catch (error) {
        console.error('Error:', error);
        alert('Failed to load senior data for editing.');
    }
}


async function openResidentModal(seniorId) {

    const viewBtn = document.querySelector(
        `[onclick="openResidentModal(${seniorId})"]`
    );

    const originalContent = viewBtn.innerHTML;
    viewBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-1"></i> Loading...';
    viewBtn.disabled = true;

    try {
        const response = await fetch(`/seniors/${seniorId}/resident`);
        if (!response.ok) throw new Error('Failed to fetch resident data');

        const resident = await response.json();

        if (resident.error) {
            alert(resident.error);
            return;
        }

        /* ================================
           ✅ GET PUROK FROM RESIDENT
        ================================= */
        const purok = resident.purok_no || '';
        const sitio = resident.sitio || '';
        const fullAddress = `${purok}${sitio ? ', ' + sitio : ''}`;

        /* ================================
           ✅ SAVE PUROK INTO TABLE ROW
        ================================= */
        const row = viewBtn.closest('tr');
        if (row) {
            row.dataset.purok = purok.toLowerCase();
        }

        /* ================================
           OTHER RESIDENT DATA
        ================================= */
        const fullName = `${resident.lname}, ${resident.Fname} ${resident.mname || ''}`.trim();

        const age = resident.age ||
            Math.floor(
                (new Date() - new Date(resident.birthday)) /
                (365.25 * 24 * 60 * 60 * 1000)
            );

        /* ================================
           MODAL CONTENT
        ================================= */
        const content = `
            <div class="resident-profile">
                <div class="resident-photo">
                    <img src="${resident.image ? `/storage/${resident.image}` : '{{ asset('images/default.png') }}'}"
                         onerror="this.src='{{ asset('images/default.png') }}'">
                </div>

                <div class="resident-basic-info">
                    <h3>${fullName}</h3>
                    <div class="resident-meta">
                        <div class="resident-meta-item">
                            <i class="fas fa-venus-mars"></i>
                            <span>${resident.gender || 'N/A'}</span>
                        </div>
                        <div class="resident-meta-item">
                            <i class="fas fa-birthday-cake"></i>
                            <span>${age} years old</span>
                        </div>
                        <div class="resident-meta-item">
                            <i class="fas fa-ring"></i>
                            <span>${resident.civil_status || 'N/A'}</span>
                        </div>
                    </div>

                    <div class="resident-meta">
                        <div class="resident-meta-item">
                            <i class="fas fa-map-marker-alt"></i>
                            <span>${fullAddress}</span>
                        </div>
                        <div class="resident-meta-item">
                            <i class="fas fa-home"></i>
                            <span>Household #${resident.household_no || 'N/A'}</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="info-grid">
                <div class="info-section">
                    <h5><i class="fas fa-user-circle"></i> Personal Information</h5>
                    <div class="info-item">
                        <div class="info-label">Full Name</div>
                        <div class="info-value">${fullName}</div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">Birthdate</div>
                        <div class="info-value">
                            ${resident.birthday
                                ? new Date(resident.birthday).toLocaleDateString('en-US', {
                                    year: 'numeric',
                                    month: 'long',
                                    day: 'numeric'
                                })
                                : 'N/A'}
                        </div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">Age</div>
                        <div class="info-value">${age} years old</div>
                    </div>
                </div>

                <div class="info-section">
                    <h5><i class="fas fa-address-card"></i> Contact & Address</h5>
                    <div class="info-item">
                        <div class="info-label">Contact</div>
                        <div class="info-value">${resident.contact_number || 'N/A'}</div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">Purok / Sitio</div>
                        <div class="info-value">${fullAddress}</div>
                    </div>
                </div>
            </div>
        `;

        document.getElementById('residentContent').innerHTML = content;

        const modal = new bootstrap.Modal(
            document.getElementById('viewResidentDetailsModal')
        );
        modal.show();

    } catch (error) {
        console.error(error);
        alert('Failed to load resident details.');
    } finally {
        viewBtn.innerHTML = originalContent;
        viewBtn.disabled = false;
    }
}


// Add smooth animations
document.addEventListener('DOMContentLoaded', function() {
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
            }
        });
    }, observerOptions);

    document.querySelectorAll('.fade-in').forEach(el => {
        observer.observe(el);
    });
});
</script>
</body>
</html>

