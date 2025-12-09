@extends('skuser.dashboard')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
@section('content')
<style>
    :root {
        --primary-gradient: #2c3e50;
        --secondary-gradient: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
        --success-gradient: #28a745;
        --warning-gradient: #f8961e;
        --info-gradient: #4361ee;
        --dark-gradient: linear-gradient(135deg, #2c3e50 0%, #1a1a2e 100%);
        --light-bg: #f8fafc;
        --card-bg: #ffffff;
        --shadow-sm: 0 2px 10px rgba(0, 0, 0, 0.05);
        --shadow-md: 0 5px 20px rgba(0, 0, 0, 0.1);
        --shadow-lg: 0 10px 40px rgba(0, 0, 0, 0.15);
        --border-radius: 16px;
        --border-radius-sm: 12px;
        --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        background: linear-gradient(135deg, #f6f9ff 0%, #edf2ff 100%);
        font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
        color: #1e293b;
        line-height: 1.6;
    }

    /* Header Styling */
    .page-header {
        margin-bottom: 2rem;
        padding: 0 1rem;
        animation: fadeInDown 0.5s ease-out;
    }

    .page-header h1 {
        font-size: 2.5rem;
        font-weight: 800;
        color: #2c3e50;
        margin: 0 0 0.5rem 0;
        position: relative;
        display: inline-block;
        background: var(--primary-gradient);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.1);
    }

    .page-header h1:after {
        content: '';
        position: absolute;
        bottom: -8px;
        left: 0;
        width: 60px;
        height: 4px;
        background: var(--primary-gradient);
        border-radius: 2px;
    }

    .page-header .breadcrumb {
        font-size: 0.9rem;
        color: #64748b;
    }

    /* Stats Cards */
    .stats-container {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
        gap: 1.5rem;
        margin: 2rem 1rem;
        animation: fadeInUp 0.6s ease-out 0.2s both;
    }

    .stat-card {
        border-radius: var(--border-radius);
        padding: 1.5rem;
        box-shadow: var(--shadow-sm);
        transition: var(--transition);
        border: 1px solid rgba(255, 255, 255, 0.2);
        backdrop-filter: blur(10px);
        position: relative;
        overflow: hidden;
        cursor: pointer;
    }

    .stat-card:before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: var(--primary-gradient);
    }

    .stat-card:nth-child(2):before { background: var(--warning-gradient); }
    .stat-card:nth-child(3):before { background: var(--success-gradient); }
    .stat-card:nth-child(4):before { background: var(--info-gradient); }

    .stat-card:hover {
        transform: translateY(-8px);
        box-shadow: var(--shadow-lg);
    }

    .stat-icon {
        width: 50px;
        height: 50px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        margin-bottom: 1rem;
        background: var(--info-gradient);
        color: white;
    }

    .stat-card:nth-child(2) .stat-icon { background: var(--warning-gradient); }
    .stat-card:nth-child(3) .stat-icon { background: var(--success-gradient); }
    .stat-card:nth-child(4) .stat-icon { background: var(--info-gradient); }

    .stat-number {
        font-size: 2.5rem;
        font-weight: 800;
        background: var(--primary-gradient);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        line-height: 1;
        margin-bottom: 0.5rem;
    }

    .stat-card:nth-child(2) .stat-number { background: var(--primary-gradient); -webkit-background-clip: text; }
    .stat-card:nth-child(3) .stat-number { background: var(--primary-gradient); -webkit-background-clip: text; }
    .stat-card:nth-child(4) .stat-number { background: var(--primary-gradient); -webkit-background-clip: text; }

    .stat-label {
        font-size: 0.9rem;
        color: #64748b;
        text-transform: uppercase;
        letter-spacing: 1px;
        font-weight: 600;
    }

    /* Main Card */
    .card {
        background: var(--card-bg);
        border: none;
        border-radius: var(--border-radius);
        box-shadow: var(--shadow-md);
        overflow: hidden;
        margin: 0 1rem 2rem;
        animation: fadeInUp 0.6s ease-out 0.4s both;
    }

    /* UPDATED: Card Header with filters in one line */
    .card-header {
        background: var(--dark-gradient);
        color: white;
        border-bottom: none;
        padding: 1.5rem;
        position: relative;
        overflow: hidden;
        display: flex;
        flex-direction: column;
        gap: 1rem;
    }

    .card-header:before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(45deg, transparent, rgba(255,255,255,0.1), transparent);
        transform: translateX(-100%);
        animation: shimmer 2s infinite;
    }

    @keyframes shimmer {
        100% { transform: translateX(100%); }
    }

    /* UPDATED: Header top row with title and search */
    .header-top-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 1rem;
    }

    .card-title {
        font-size: 1.25rem;
        font-weight: 700;
        color: white;
        margin: 0;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .card-title i {
        color: #60a5fa;
    }

    /* UPDATED: White search bar */
    .card-header .search-form {
        flex: 1;
        max-width: 400px;
        min-width: 300px;
    }

    .card-header .input-group {
        border-radius: var(--border-radius-sm);
        overflow: hidden;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    }

    /* UPDATED: White search input */
    .card-header .form-control {
        border: none;
        padding: 0.75rem 1rem;
        background: #ffffff;
        font-size: 0.9rem;
        transition: var(--transition);
        color: #333;
    }

    .card-header .form-control::placeholder {
        color: #666;
    }

    .card-header .form-control:focus {
        background: white;
        box-shadow: 0 0 0 3px rgba(96, 165, 250, 0.2);
        outline: none;
    }

    .card-header .btn-search {
        background: var(--primary-gradient);
        border: none;
        color: white;
        padding: 0 1.5rem;
        font-weight: 600;
        transition: var(--transition);
    }

    .card-header .btn-search:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);
    }

    /* UPDATED: Compact Filter Controls */
    .filter-controls {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        background: rgba(255, 255, 255, 0.1);
        padding: 0.75rem;
        border-radius: var(--border-radius-sm);
        flex-wrap: nowrap;
        overflow-x: auto;
    }

    .filter-controls select {
        background: rgba(255, 255, 255, 0.9);
        border: 1px solid transparent;
        border-radius: 6px;
        padding: 0.4rem 0.75rem;
        font-size: 0.8rem;
        color: #334155;
        transition: var(--transition);
        min-width: 120px;
        flex-shrink: 0;
        height: 36px;
    }

    .filter-controls select:focus {
        outline: none;
        border-color: #60a5fa;
        box-shadow: 0 0 0 3px rgba(96, 165, 250, 0.2);
    }

    .filter-controls option {
        padding: 0.5rem;
    }

    /* Remove scrollbar styling for filter controls */
    .filter-controls::-webkit-scrollbar {
        height: 6px;
    }

    .filter-controls::-webkit-scrollbar-track {
        background: rgba(255, 255, 255, 0.1);
        border-radius: 3px;
    }

    .filter-controls::-webkit-scrollbar-thumb {
        background: rgba(255, 255, 255, 0.3);
        border-radius: 3px;
    }

    /* Table Styling */
    .table-responsive {
        border-radius: var(--border-radius-sm);
        overflow: hidden;
        margin: 0;
        position: relative;
    }

    .table-modern {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
        margin: 0;
        background: white;
    }

    .table-modern thead {
        background: var(--dark-gradient);
        position: sticky;
        top: 0;
        z-index: 10;
    }

    .table-modern thead th {
        background-color: var(--primary-gradient);
        color: white;
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.75rem;
        letter-spacing: 0.5px;
        padding: 1.25rem 1rem;
        border: none;
        white-space: nowrap;
    }

    .table-modern thead th:after {
        content: '';
        position: absolute;
        right: 0;
        top: 20%;
        height: 60%;
        width: 1px;
        background: rgba(255, 255, 255, 0.2);
    }

    .table-modern thead th:last-child:after {
        display: none;
    }

    .table-modern tbody tr {
        transition: var(--transition);
        border-bottom: 1px solid #f1f5f9;
        position: relative;
    }

    .table-modern tbody tr:hover {
        background: linear-gradient(90deg, rgba(96, 165, 250, 0.05) 0%, rgba(96, 165, 250, 0.02) 100%);
        transform: translateX(4px);
    }

    .table-modern tbody tr:last-child {
        border-bottom: none;
    }

    .table-modern tbody td {
        padding: 1.25rem 1rem;
        vertical-align: middle;
        color:var(--primary-gradient);
        font-weight: 500;
        position: relative;
        white-space: nowrap;
    }

    .table-modern tbody td:first-child {
        font-weight: 600;
        color: #1e293b;
        padding-left: 1.5rem;
    }

    /* Status Badges */
    .status-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.5rem 1rem;
        border-radius: 50px;
        font-size: 0.75rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        box-shadow: var(--shadow-sm);
        transition: var(--transition);
    }

    .status-badge:hover {
        transform: translateY(-2px);
        box-shadow: var(--shadow-md);
    }

    .status-badge i {
        font-size: 0.875rem;
    }

    .status-pending {
        background: var(--warning-gradient);
        color: white;
    }

    .status-approved {
        background: var(--info-gradient);
        color: white;
    }

    .status-released {
        background: var(--success-gradient);
        color: white;
    }

    .status-declined {
        background: var(--secondary-gradient);
        color: white;
    }

    /* Attachment Link */
    .attachment-link {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        color: #3b82f6;
        text-decoration: none;
        font-weight: 500;
        transition: var(--transition);
        padding: 0.5rem 1rem;
        border-radius: 8px;
        background: rgba(59, 130, 246, 0.1);
    }

    .attachment-link:hover {
        color: #1d4ed8;
        background: rgba(59, 130, 246, 0.2);
        text-decoration: none;
        transform: translateY(-2px);
    }

    /* Actions Group */
    .actions-group {
        display: flex;
        gap: 0.5rem;
    }

    .actions-group .btn {
        width: 36px;
        height: 36px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: var(--transition);
        position: relative;
        overflow: hidden;
    }

    .actions-group .btn:before {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        width: 0;
        height: 0;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.3);
        transform: translate(-50%, -50%);
        transition: width 0.6s, height 0.6s;
    }

    .actions-group .btn:hover:before {
        width: 300px;
        height: 300px;
    }

    .actions-group .btn-outline-info {
        border: 2px solid #0ea5e9;
        color: #0ea5e9;
    }

    .actions-group .btn-outline-info:hover {
        background: #0ea5e9;
        color: white;
        transform: translateY(-3px) rotate(5deg);
    }

    .actions-group .btn-outline-warning {
        border: 2px solid #f59e0b;
        color: #f59e0b;
    }

    .actions-group .btn-outline-warning:hover {
        background: #f59e0b;
        color: white;
        transform: translateY(-3px) rotate(-5deg);
    }

    .actions-group .btn-outline-danger {
        border: 2px solid #ef4444;
        color: #ef4444;
    }

    .actions-group .btn-outline-danger:hover {
        background: #ef4444;
        color: white;
        transform: translateY(-3px) scale(1.1);
    }

    /* Modal Styling */
    .modal-content {
        border: none;
        border-radius: var(--border-radius);
        overflow: hidden;
        box-shadow: var(--shadow-lg);
        animation: modalSlideIn 0.3s ease-out;
    }

    @keyframes modalSlideIn {
        from {
            opacity: 0;
            transform: translateY(-30px) scale(0.95);
        }
        to {
            opacity: 1;
            transform: translateY(0) scale(1);
        }
    }

    .modal-header {
        background: var(--primary-gradient);
        color: white;
        border-bottom: none;
        padding: 1.5rem;
    }

    .modal-title {
        font-weight: 700;
        font-size: 1.25rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .modal-body {
        padding: 2rem;
        background: #f8fafc;
    }

    .modal-body p {
        margin-bottom: 1rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .modal-body strong {
        color: #1e293b;
        min-width: 120px;
    }

    .modal-footer {
        padding: 1.5rem;
        background: white;
        border-top: 1px solid #e2e8f0;
    }

    /* Form Elements */
    .form-select {
        border: 2px solid #e2e8f0;
        border-radius: 10px;
        padding: 0.75rem 1rem;
        font-size: 0.9rem;
        transition: var(--transition);
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='%23343a40' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M2 5l6 6 6-6'/%3e%3c/svg%3e");
        background-repeat: no-repeat;
        background-position: right 0.75rem center;
        background-size: 16px 12px;
    }

    .form-select:focus {
        border-color: #60a5fa;
        box-shadow: 0 0 0 3px rgba(96, 165, 250, 0.2);
    }

    /* Empty State */
    .empty-state {
        text-align: center;
        padding: 4rem 2rem;
        color: #64748b;
    }

    .empty-state i {
        font-size: 4rem;
        margin-bottom: 1.5rem;
        opacity: 0.3;
        background: var(--dark-gradient);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    .empty-state h4 {
        color: #475569;
        margin-bottom: 0.5rem;
    }

    /* Animations */
    @keyframes fadeInDown {
        from {
            opacity: 0;
            transform: translateY(-20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Loading Skeleton */
    .skeleton {
        background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
        background-size: 200% 100%;
        animation: loading 1.5s infinite;
        border-radius: 4px;
    }

    @keyframes loading {
        0% { background-position: 200% 0; }
        100% { background-position: -200% 0; }
    }

    /* Tooltip Customization */
    .tooltip {
        --bs-tooltip-bg: #1e293b;
        --bs-tooltip-color: white;
    }

    .tooltip-inner {
        border-radius: 8px;
        padding: 0.5rem 0.75rem;
        font-size: 0.75rem;
        box-shadow: var(--shadow-md);
    }

    /* Custom Scrollbar */
    ::-webkit-scrollbar {
        width: 8px;
        height: 8px;
    }

    ::-webkit-scrollbar-track {
        background: #f1f5f9;
        border-radius: 4px;
    }

    ::-webkit-scrollbar-thumb {
        background: var(--primary-gradient);
        border-radius: 4px;
    }

    ::-webkit-scrollbar-thumb:hover {
        background: linear-gradient(135deg, #764ba2 0%, #667eea 100%);
    }

    /* UPDATED: Quick Actions - Refresh button on right side */
    .quick-actions {
        display: flex;
        justify-content: flex-end;
        margin-top: 1rem;
        margin-right: 1rem;
    }

    .quick-action-btn {
        padding: 0.5rem 1.25rem;
        border-radius: 8px;
        background: var(--info-gradient);
        border: none;
        color: white;
        font-weight: 600;
        transition: var(--transition);
        display: flex;
        align-items: center;
        gap: 0.5rem;
        box-shadow: var(--shadow-sm);
        margin-bottom: 12px;

    }

    .quick-action-btn:hover {
        background: var(--primary-gradient);
        color: white;
        transform: translateY(-2px);
        box-shadow: var(--shadow-md);
    }

    /* Responsive Design */
    @media (max-width: 1200px) {
        .filter-controls {
            gap: 0.5rem;
        }

        .filter-controls select {
            min-width: 110px;
            padding: 0.35rem 0.6rem;
            font-size: 0.75rem;
        }
    }

    @media (max-width: 992px) {
        .header-top-row {
            flex-direction: column;
            align-items: stretch;
        }

        .card-header .search-form {
            max-width: 100%;
            min-width: auto;
        }

        .filter-controls {
            flex-wrap: wrap;
            gap: 0.5rem;
        }

        .filter-controls select {
            min-width: calc(50% - 0.5rem);
            flex: 1 1 calc(50% - 0.5rem);
        }
    }

    @media (max-width: 768px) {
        .page-header h1 {
            font-size: 2rem;
        }

        .stats-container {
            grid-template-columns: 1fr;
            gap: 1rem;
            margin: 1rem 0.5rem;
        }

        .stat-card {
            padding: 1.25rem;
        }

        .card {
            margin: 0 0.5rem 1rem;
        }

        .card-header {
            padding: 1rem;
        }

        .filter-controls select {
            min-width: 100%;
            flex: 1 1 100%;
        }

        .table-modern thead th,
        .table-modern tbody td {
            padding: 0.75rem 0.5rem;
            font-size: 0.75rem;
        }

        .actions-group {
            flex-direction: column;
            gap: 0.25rem;
        }

        .actions-group .btn {
            width: 32px;
            height: 32px;
        }

        .modal-dialog {
            margin: 0.5rem;
        }

        .modal-body {
            padding: 1.5rem;
        }

        .quick-actions {
            margin-right: 0.5rem;
            justify-content: center;
        }
    }

    @media (max-width: 576px) {
        .header-top-row {
            gap: 0.75rem;
        }

        .card-title {
            font-size: 1.1rem;
        }

        .card-header .form-control {
            padding: 0.5rem 0.75rem;
            font-size: 0.85rem;
        }

        .card-header .btn-search {
            padding: 0 1rem;
        }

        .quick-action-btn {
            padding: 0.4rem 1rem;
            font-size: 0.9rem;
        }
    }

    @media (min-width: 1400px) {
        .content-container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 1rem;
        }
    }

    /* Print Styles */
    @media print {
        .card-header,
        .filter-controls,
        .actions-group,
        .modal,
        .tooltip,
        .quick-actions {
            display: none !important;
        }

        .card {
            box-shadow: none !important;
            border: 1px solid #ddd !important;
        }

        .table-modern {
            border: 1px solid #ddd;
        }
    }

    /* Notification Badge */
    .notification-badge {
        position: absolute;
        top: -8px;
        right: -8px;
        background: var(--secondary-gradient);
        color: white;
        width: 20px;
        height: 20px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.75rem;
        font-weight: 700;
        animation: pulse 2s infinite;
    }

    @keyframes pulse {
        0%, 100% { transform: scale(1); }
        50% { transform: scale(1.1); }
    }

    /* Dark Mode Support */
    @media (prefers-color-scheme: dark) {
        :root {
            --light-bg: #0f172a;
            --card-bg: #1e293b;
        }

        body {
            color: #cbd5e1;
        }

        .card-header .form-control {
            background: #ffffff;
            color: #333;
        }

        .card-header .form-control::placeholder {
            color: #666;
        }

        .table-modern tbody td {
            color: #94a3b8;
        }

        .table-modern tbody td:first-child {
            color: #e2e8f0;
        }
    }
</style>

<div class="page-header">
    <h1 class="page-title">Service Requests Dashboard</h1>
</div>

<!-- Stats Overview -->
<div class="stats-container">
    <div class="stat-card">
        <div class="stat-icon">
            <i class="fas fa-hourglass-half"></i>
        </div>
        <div class="stat-number">{{ $SKService->where('status', 'Pending')->count() }}</div>
        <div class="stat-label">Pending Requests</div>
    </div>
    <div class="stat-card">
        <div class="stat-icon">
            <i class="fas fa-check-circle"></i>
        </div>
        <div class="stat-number">{{ $SKService->where('status', 'Approved')->count() }}</div>
        <div class="stat-label">Approved</div>
    </div>
    <div class="stat-card">
        <div class="stat-icon">
            <i class="fas fa-paper-plane"></i>
        </div>
        <div class="stat-number">{{ $SKService->where('status', 'Released')->count() }}</div>
        <div class="stat-label">Released</div>
    </div>
    <div class="stat-card">
        <div class="stat-icon">
            <i class="fas fa-chart-line"></i>
        </div>
        <div class="stat-number">{{ $SKService->count() }}</div>
        <div class="stat-label">Total Requests</div>
    </div>
</div>

<!-- UPDATED: Quick Actions - Refresh button moved to right side -->
<div class="quick-actions">
    <button class="quick-action-btn" onclick="refreshData()">
        <i class="fas fa-sync-alt"></i> Refresh Data
    </button>
</div>

<!-- Main Card -->
<div class="card">
    <div class="card-header">
        <!-- Header Top Row: Title and Search -->
        <div class="header-top-row">
            <h5 class="card-title">
                <i class="fas fa-list-check"></i> Service Requests Management
                <span class="notification-badge" id="newRequestsCount">{{ $SKService->count() }}</span>
            </h5>

            <div class="search-form">
                <div class="input-group">
                    <input type="text" id="searchInput" class="form-control" placeholder="Search by name, school, or service type..." style="background: white; color: #333;">
                    <button class="btn btn-search" type="button">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- UPDATED: Smaller Filter Controls in one line -->
        <div class="filter-controls">
            <select id="filterYear" class="form-select">
                <option value="">📅 Year</option>
                @php
                $currentYear = date('Y');
                for ($year = $currentYear; $year >= $currentYear - 10; $year--) {
                    echo "<option value='{$year}'>{$year}</option>";
                }
                @endphp
            </select>

            <select id="filterMonth" class="form-select">
                <option value="">🗓️ Month</option>
                @for ($month = 1; $month <= 12; $month++)
                    <option value="{{ $month }}">{{ date('F', mktime(0, 0, 0, $month, 1)) }}</option>
                @endfor
            </select>

            <select id="filterStatus" class="form-select">
                <option value="">🎯 Status</option>
                <option value="Pending">Pending</option>
                <option value="Approved">Approved</option>
                <option value="Released">Released</option>
                <option value="Declined">Declined</option>
            </select>

            <select id="filterServiceType" class="form-select">
                <option value="">🔧 Service Type</option>
                @php
                    $serviceTypes = $SKService->pluck('type_of_service')->unique()->sort();
                @endphp
                @foreach($serviceTypes as $type)
                    <option value="{{ $type }}">{{ $type }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-modern" id="servicesTable">
            <thead>
                <tr>
                    <th>👤 Full Name</th>
                    <th>🏫 School</th>
                    <th>📅 Year</th>
                    <th>🔧 Type of Service</th>
                    <th>📊 Status</th>
                    <th>📅 Date Requested</th>
                    <th>📎 Attachment</th>
                    <th>📅 Released Date</th>
                    <th>⚡ Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($SKService as $service)
                    <tr>
                        <td>
                            <div class="d-flex align-items-center gap-2">
                                <div class="user-avatar">
                                    <i class="fas fa-user-circle"></i>
                                </div>
                                <div>
                                    <strong class="badge bg-light text-dark">{{ $service->firstname }} {{ $service->lastname }}</strong>
                                </div>
                            </div>
                        </td>
                        <td>
                            <span class="badge bg-light text-dark">{{ $service->school }}</span>
                        </td>
                        <td>
                            <span class="badge bg-light text-dark">{{ $service->school_year }}</span>
                        </td>
                        <td>
                            <span class="service-type badge bg-light text-dark">{{ $service->type_of_service }}</span>
                        </td>
                        <td>
                            <span class="status-badge status-{{ strtolower($service->status) }}">
                                <i class="fas
                                    @if($service->status == 'Pending') fa-clock
                                    @elseif($service->status == 'Approved') fa-check-circle
                                    @elseif($service->status == 'Released') fa-paper-plane
                                    @else fa-times-circle
                                    @endif
                                "></i>
                                {{ $service->status }}
                            </span>
                        </td>
                        <td>
                            <span class="date-badge badge bg-light text-dark">
                                <i class="fas fa-calendar"></i>
                                {{ $service->created_at->format('M d, Y') }}
                            </span>
                        </td>
                        <td>
                            @if ($service->attachment)
                                <a href="{{ route('sk.attachment', ['path' => $service->attachment]) }}"
                                   class="attachment-link" target="_blank">
                                    <i class="fas fa-paperclip"></i>
                                    View Attachment
                                </a>
                            @else
                                <span class="badge bg-light text-dark">N/A</span>
                            @endif
                        </td>
                        <td>
                            @if ($service->status == 'Released' && $service->released_date)
                                <span class="date-badge released badge bg-light text-dark">
                                    <i class="fas fa-calendar-check"></i>
                                    {{ $service->released_date->format('M d, Y') }}
                                </span>
                            @else
                                <span class="text-muted">N/A</span>
                            @endif
                        </td>
                        <td class="actions-group">
                            <!-- View Button -->
                            <span data-bs-toggle="tooltip" data-bs-placement="top" title="View Details">
                                <button type="button" class="btn btn-sm btn-outline-info"
                                        data-bs-toggle="modal"
                                        data-bs-target="#viewModal{{ $service->id }}">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </span>

                            <!-- Edit Button -->
                            <span data-bs-toggle="tooltip" data-bs-placement="top" title="Edit Status">
                                <button type="button" class="btn btn-sm btn-outline-warning"
                                        data-bs-toggle="modal"
                                        data-bs-target="#editModal{{ $service->id }}">
                                    <i class="fas fa-edit"></i>
                                </button>
                            </span>

                            <!-- Delete Button -->
                            <span data-bs-toggle="tooltip" data-bs-placement="top" title="Delete Request">
                                <button type="button" class="btn btn-sm btn-outline-danger"
                                        data-bs-toggle="modal"
                                        data-bs-target="#deleteModal{{ $service->id }}">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </span>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="9" class="text-center py-5">
                            <div class="empty-state">
                                <i class="fas fa-inbox"></i>
                                <h4>No service requests found</h4>
                                <p class="text-muted">Start by adding your first service request</p>
                                <button class="btn btn-primary mt-3" onclick="location.reload()">
                                    <i class="fas fa-sync-alt me-2"></i>Refresh
                                </button>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- Modals (Your existing modal code remains unchanged) -->
@foreach ($SKService as $service)
    <!-- View Modal -->
    <div class="modal fade" id="viewModal{{ $service->id }}" tabindex="-1" aria-labelledby="viewModalLabel{{ $service->id }}" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="viewModalLabel{{ $service->id }}">
                        <i class="fas fa-file-alt me-2"></i>Service Request Details
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p><strong><i class="fas fa-user me-2"></i>Full Name:</strong> {{ $service->firstname }} {{ $service->lastname }}</p>
                    <p><strong><i class="fas fa-school me-2"></i>School:</strong> {{ $service->school }}</p>
                    <p><strong><i class="fas fa-calendar-alt me-2"></i>School Year:</strong> {{ $service->school_year }}</p>
                    <p><strong><i class="fas fa-cogs me-2"></i>Type of Service:</strong> {{ $service->type_of_service }}</p>
                    <p><strong><i class="fas fa-info-circle me-2"></i>Status:</strong>
                        <span class="status-badge status-{{ strtolower($service->status) }}">{{ $service->status }}</span>
                    </p>
                    <p><strong><i class="fas fa-paperclip me-2"></i>Attachment:</strong>
                        @if ($service->attachment)
                            <div class="mt-2">
                                <a href="{{ \Illuminate\Support\Facades\Storage::url($service->attachment) }}"
                                   class="btn btn-sm btn-outline-primary me-2" target="_blank">
                                    <i class="fas fa-eye me-1"></i>View
                                </a>
                                <button class="btn btn-sm btn-outline-success"
                                        onclick="printAttachment('{{ \Illuminate\Support\Facades\Storage::url($service->attachment) }}')">
                                    <i class="fas fa-print me-1"></i>Print
                                </button>
                            </div>
                        @else
                            <span class="text-muted">N/A</span>
                        @endif
                    </p>
                    <p><strong><i class="fas fa-calendar me-2"></i>Date Requested:</strong> {{ $service->created_at->format('F d, Y') }}</p>
                    <p><strong><i class="fas fa-calendar-check me-2"></i>Released Date:</strong>
                        {{ $service->status == 'Released' && $service->released_date ? $service->released_date->format('F d, Y') : 'N/A' }}
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="fas fa-times me-1"></i>Close
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Modal -->
    <div class="modal fade" id="editModal{{ $service->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $service->id }}" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel{{ $service->id }}">
                        <i class="fas fa-edit me-2"></i>Update Service Status
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('skuser.services.update', $service->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="status-{{$service->id}}" class="form-label">
                                <i class="fas fa-tag me-2"></i>Status
                            </label>
                            <select name="status" id="status-{{$service->id}}" class="form-select">
                                <option value="Pending" {{ $service->status == 'Pending' ? 'selected' : '' }}>
                                    <i class="fas fa-clock me-2"></i>Pending
                                </option>
                                <option value="Approved" {{ $service->status == 'Approved' ? 'selected' : '' }}>
                                    <i class="fas fa-check-circle me-2"></i>Approved
                                </option>
                                <option value="Released" {{ $service->status == 'Released' ? 'selected' : '' }}>
                                    <i class="fas fa-paper-plane me-2"></i>Released
                                </option>
                                <option value="Declined" {{ $service->status == 'Declined' ? 'selected' : '' }}>
                                    <i class="fas fa-times-circle me-2"></i>Declined
                                </option>
                            </select>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                <i class="fas fa-times me-1"></i>Cancel
                            </button>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-1"></i>Update Status
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Modal -->
    <div class="modal fade" id="deleteModal{{ $service->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $service->id }}" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel{{ $service->id }}">
                        <i class="fas fa-exclamation-triangle me-2"></i>Confirm Deletion
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="text-center mb-4">
                        <i class="fas fa-trash-alt fa-3x text-danger mb-3"></i>
                        <p>Are you sure you want to delete this service request?</p>
                        <p class="fw-bold">{{ $service->firstname }} {{ $service->lastname }} - {{ $service->type_of_service }}</p>
                        <p class="text-danger small">
                            <i class="fas fa-exclamation-circle me-1"></i>
                            This action cannot be undone.
                        </p>
                    </div>
                </div>
                <div class="modal-footer">
                    <form action="{{ route('skuser.services.destroy', $service->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            <i class="fas fa-times me-1"></i>Cancel
                        </button>
                        <button type="submit" class="btn btn-danger">
                            <i class="fas fa-trash me-1"></i>Delete
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endforeach

<script>
    function printAttachment(url) {
        var printWindow = window.open(url, '_blank');
        printWindow.onload = function() {
            printWindow.print();
        }
    }

    // Enhanced JavaScript with animations and features
    $(document).ready(function(){
        // Initialize tooltips
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });

        // Enhanced search and filter functionality
        function filterTable() {
            var searchValue = $("#searchInput").val().toLowerCase();
            var filterYear = $("#filterYear").val();
            var filterMonth = $("#filterMonth").val();
            var filterStatus = $("#filterStatus").val();
            var filterServiceType = $("#filterServiceType").val();

            $("#servicesTable tbody tr").each(function() {
                var row = $(this);
                var textMatch = searchValue === '' || row.text().toLowerCase().indexOf(searchValue) > -1;

                var dateRequested = row.find('td:eq(5)').text().trim();
                var dateRequestedObj = new Date(dateRequested);
                var rowYear = dateRequestedObj.getFullYear();
                var rowMonth = dateRequestedObj.getMonth() + 1;

                var status = row.find('.status-badge').text().trim();
                var serviceType = row.find('.service-type').text().trim();

                var yearMatch = filterYear === '' || rowYear == filterYear;
                var monthMatch = filterMonth === '' || rowMonth == filterMonth;
                var statusMatch = filterStatus === '' || status === filterStatus;
                var typeMatch = filterServiceType === '' || serviceType === filterServiceType;

                if (textMatch && yearMatch && monthMatch && statusMatch && typeMatch) {
                    row.show().addClass('animate__animated animate__fadeIn');
                } else {
                    row.hide().removeClass('animate__animated animate__fadeIn');
                }
            });

            // Update counts
            updateFilteredCount();
        }

        // Real-time search
        $("#searchInput").on("keyup", function() {
            filterTable();
        });

        // Filter changes
        $("#filterYear, #filterMonth, #filterStatus, #filterServiceType").on("change", function() {
            filterTable();
        });

        // Search button click
        $(".btn-search").on("click", function() {
            filterTable();
        });

        // Update filtered count
        function updateFilteredCount() {
            var visibleRows = $("#servicesTable tbody tr:visible").length;
            $("#newRequestsCount").text(visibleRows);
        }

        // Initialize count
        updateFilteredCount();

        // Export to Excel function
        window.exportToExcel = function() {
            var table = document.getElementById("servicesTable");
            var wb = XLSX.utils.table_to_book(table, {sheet: "Service Requests"});
            XLSX.writeFile(wb, "Service_Requests_" + new Date().toISOString().split('T')[0] + ".xlsx");
        }

        // Print table function
        window.printTable = function() {
            var printWindow = window.open('', '_blank');
            printWindow.document.write('<html><head><title>Service Requests Report</title>');
            printWindow.document.write('<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">');
            printWindow.document.write('<style>');
            printWindow.document.write('body { font-family: Arial, sans-serif; margin: 20px; }');
            printWindow.document.write('table { width: 100%; border-collapse: collapse; }');
            printWindow.document.write('th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }');
            printWindow.document.write('th { background-color: #f8f9fa; }');
            printWindow.document.write('.status-badge { padding: 4px 8px; border-radius: 4px; color: white; }');
            printWindow.document.write('</style>');
            printWindow.document.write('</head><body>');
            printWindow.document.write('<h2>Service Requests Report</h2>');
            printWindow.document.write('<p>Generated: ' + new Date().toLocaleString() + '</p>');
            printWindow.document.write(table.outerHTML);
            printWindow.document.write('</body></html>');
            printWindow.document.close();
            printWindow.print();
        }

        // Refresh data function
        window.refreshData = function() {
            location.reload();
        }

        // Add row animation on load
        $("#servicesTable tbody tr").each(function(index) {
            $(this).delay(index * 100).queue(function(next) {
                $(this).addClass('animate__animated animate__fadeInUp');
                next();
            });
        });

        // Search input focus animation
        $("#searchInput").on("focus", function() {
            $(this).parent().addClass("animate__animated animate__pulse");
        }).on("blur", function() {
            $(this).parent().removeClass("animate__animated animate__pulse");
        });

        // Modal show animation
        $('.modal').on('show.bs.modal', function () {
            $(this).find('.modal-content').addClass('animate__animated animate__zoomIn');
        });

        // Modal hide animation
        $('.modal').on('hidden.bs.modal', function () {
            $(this).find('.modal-content').removeClass('animate__animated animate__zoomIn');
        });
    });

    // Add animate.css for animations
    if (!$('link[href*="animate.css"]').length) {
        $('head').append('<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">');
    }

    // Add SheetJS for Excel export
    if (typeof XLSX === 'undefined') {
        var script = document.createElement('script');
        script.src = 'https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js';
        document.head.appendChild(script);
    }
</script>

@endsection

@push('scripts')
<!-- Additional scripts if needed -->
@endpush
