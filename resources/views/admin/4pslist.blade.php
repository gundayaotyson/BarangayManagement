@extends('admin.dashboard')

@section('content')
<link rel="stylesheet" href="https://code.jquery.com/ui/1.13.3/themes/base/jquery-ui.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="https://code.jquery.com/ui/1.13.3/jquery-ui.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<style>
    :root {
        --primary-color: #2c3e50;
        --secondary-color: #3498db;
        --success-color: #2ecc71;
        --warning-color: #f39c12;
        --danger-color: #e74c3c;
        --light-color: #ecf0f1;
        --dark-color: #2c3e50;
        --card-bg: #ffffff;
        --border-radius: 12px;
        --box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        --transition: all 0.3s ease;
    }

    .page-header {
        background: linear-gradient(135deg, var(--primary-color) 0%, #34495e 100%);
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

    .page-header h1 {
        font-size: 2.5rem;
        font-weight: 700;
        margin-bottom: 0.5rem;
        position: relative;
        display: inline-block;
    }

    .page-header h1::after {
        content: '';
        position: absolute;
        bottom: -10px;
        left: 0;
        width: 60px;
        height: 4px;
        background: var(--secondary-color);
        border-radius: 2px;
    }

    .page-header p {
        font-size: 1.1rem;
        opacity: 0.9;
        margin-top: 1rem;
    }

    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 1.5rem;
        margin-bottom: 2rem;
    }

    .stat-card {
        background: var(--card-bg);
        border-radius: var(--border-radius);
        padding: 1.5rem;
        box-shadow: var(--box-shadow);
        transition: var(--transition);
        border-left: 4px solid var(--secondary-color);
        position: relative;
        overflow: hidden;
    }

    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
    }

    .stat-card.total {
        border-left-color: var(--primary-color);
    }

    .stat-card.active {
        border-left-color: var(--success-color);
    }

    .stat-card.inactive {
        border-left-color: var(--warning-color);
    }

    .stat-icon {
        position: absolute;
        top: 1.5rem;
        right: 1.5rem;
        font-size: 2.5rem;
        opacity: 0.1;
        color: var(--dark-color);
    }

    .stat-value {
        font-size: 2.5rem;
        font-weight: 700;
        color: var(--dark-color);
        margin-bottom: 0.5rem;
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
        margin-top: 0.5rem;
    }

    .stat-change.negative {
        color: var(--danger-color);
    }

    .content-card {
        background: var(--card-bg);
        border-radius: var(--border-radius);
        box-shadow: var(--box-shadow);
        padding: 1.5rem;
        margin-bottom: 2rem;
    }

    .card-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1.5rem;
        padding-bottom: 1rem;
        border-bottom: 2px solid var(--light-color);
    }

    .card-title {
        font-size: 1.5rem;
        font-weight: 600;
        color: var(--dark-color);
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .card-title i {
        color: var(--secondary-color);
    }

    .card-actions {
        display: flex;
        gap: 0.5rem;
    }

    .btn {
        padding: 0.5rem 1.25rem;
        border-radius: 6px;
        font-weight: 600;
        transition: var(--transition);
        border: none;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }

    .btn-primary {
        background: var(--secondary-color);
        color: white;
    }

    .btn-primary:hover {
        background: #2980b9;
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(52, 152, 219, 0.3);
    }

    .btn-success {
        background: var(--success-color);
        color: white;
    }

    .btn-success:hover {
        background: #27ae60;
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(46, 204, 113, 0.3);
    }

    .btn-outline {
        background: transparent;
        border: 2px solid var(--secondary-color);
        color: var(--secondary-color);
    }

    .btn-outline:hover {
        background: var(--secondary-color);
        color: white;
        transform: translateY(-2px);
    }

    .table-container {
        overflow-x: auto;
        border-radius: 8px;
    }

    .table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
        background: white;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
    }

    .table thead {
        background: linear-gradient(135deg, var(--primary-color) 0%, #34495e 100%);
    }

    .table th {
        background-color: var(--dark-color);
        padding: 1rem;
        text-align: left;
        color: white;
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.85rem;
        letter-spacing: 0.5px;
        border: none;
    }

    .table th:first-child {
        border-top-left-radius: 8px;
    }

    .table th:last-child {
        border-top-right-radius: 8px;
    }

    .table tbody tr {
        transition: var(--transition);
        border-bottom: 1px solid var(--light-color);
    }

    .table tbody tr:hover {
        background-color: #f8f9fa;
        transform: translateX(4px);
    }

    .table tbody tr:last-child {
        border-bottom: none;
    }

    .table td {
        padding: 1rem;
        vertical-align: middle;
        border: none;
    }

    .resident-info {
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .resident-avatar {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: linear-gradient(135deg, var(--secondary-color) 0%, #2980b9 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: 600;
        font-size: 1rem;
    }

    .resident-details h4 {
        margin: 0;
        font-weight: 600;
        color: var(--dark-color);
    }

    .resident-details p {
        margin: 0.25rem 0 0 0;
        font-size: 0.85rem;
        color: #666;
    }

    .status-badge {
        padding: 0.35rem 1rem;
        border-radius: 20px;
        font-size: 0.85rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }

    .status-badge.active {
        background: rgba(46, 204, 113, 0.1);
        color: var(--success-color);
        border: 1px solid rgba(46, 204, 113, 0.2);
    }

    .status-badge.inactive {
        background: rgba(243, 156, 18, 0.1);
        color: var(--warning-color);
        border: 1px solid rgba(243, 156, 18, 0.2);
    }

    .status-badge.pending {
        background: rgba(52, 152, 219, 0.1);
        color: var(--secondary-color);
        border: 1px solid rgba(52, 152, 219, 0.2);
    }

    .action-buttons {
        display: flex;
        gap: 0.5rem;
    }

    .action-btn {
        width: 36px;
        height: 36px;
        border-radius: 6px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: transparent;
        border: 1px solid #ddd;
        color: #666;
        cursor: pointer;
        transition: var(--transition);
    }

    .action-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .action-btn.view:hover {
        background: var(--secondary-color);
        color: white;
        border-color: var(--secondary-color);
    }

    .action-btn.edit:hover {
        background: var(--success-color);
        color: white;
        border-color: var(--success-color);
    }

    .action-btn.delete:hover {
        background: var(--danger-color);
        color: white;
        border-color: var(--danger-color);
    }

    .empty-state {
        text-align: center;
        padding: 3rem;
        color: #666;
    }

    .empty-state i {
        font-size: 4rem;
        margin-bottom: 1rem;
        opacity: 0.3;
        color: var(--dark-color);
    }

    .empty-state h3 {
        font-size: 1.5rem;
        margin-bottom: 0.5rem;
        color: var(--dark-color);
    }

    .empty-state p {
        margin-bottom: 1.5rem;
        max-width: 400px;
        margin-left: auto;
        margin-right: auto;
    }

    .filters {
        display: flex;
        gap: 1rem;
        margin-bottom: 1.5rem;
        flex-wrap: wrap;
    }

    .filter-group {
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .filter-label {
        font-weight: 600;
        color: var(--dark-color);
        font-size: 0.9rem;
    }

    .filter-select {
        padding: 0.5rem 1rem;
        border: 1px solid #ddd;
        border-radius: 6px;
        background: white;
        font-size: 0.9rem;
        min-width: 150px;
        transition: var(--transition);
    }

    .filter-select:focus {
        outline: none;
        border-color: var(--secondary-color);
        box-shadow: 0 0 0 3px rgba(52, 152, 219, 0.1);
    }

    /* Search Container */
    .search-container {
        position: relative;
        flex: 1;
        min-width: 300px;
    }

    .search-wrapper {
        position: relative;
    }

    .search-input {
        width: 100%;
        padding: 0.5rem 1rem 0.5rem 2.5rem;
        border: 1px solid #ddd;
        border-radius: 6px;
        font-size: 0.9rem;
        transition: var(--transition);
    }

    .search-input:focus {
        outline: none;
        border-color: var(--secondary-color);
        box-shadow: 0 0 0 3px rgba(52, 152, 219, 0.1);
    }

    .search-icon {
        position: absolute;
        left: 0.75rem;
        top: 50%;
        transform: translateY(-50%);
        color: #94a3b8;
        font-size: 0.9rem;
    }

    .clear-search {
        position: absolute;
        right: 0.75rem;
        top: 50%;
        transform: translateY(-50%);
        background: none;
        border: none;
        color: #94a3b8;
        cursor: pointer;
        display: none;
        font-size: 0.9rem;
        padding: 0;
    }

    .clear-search:hover {
        color: var(--danger-color);
    }

    /* Search Results Info */
    .search-results-info {
        padding: 0.75rem 0;
        margin-bottom: 1rem;
        color: #666;
        font-size: 0.9rem;
        border-bottom: 1px solid var(--light-color);
    }

    .search-results-info strong {
        color: var(--primary-color);
    }

    .pagination {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 0.5rem;
        margin-top: 2rem;
        padding-top: 1.5rem;
        border-top: 1px solid var(--light-color);
    }

    .page-link {
        padding: 0.5rem 1rem;
        border: 1px solid #ddd;
        border-radius: 6px;
        color: var(--dark-color);
        text-decoration: none;
        transition: var(--transition);
        font-weight: 600;
    }

    .page-link:hover {
        background: var(--secondary-color);
        color: white;
        border-color: var(--secondary-color);
    }

    .page-link.active {
        background: var(--secondary-color);
        color: white;
        border-color: var(--secondary-color);
    }

    .page-link.disabled {
        opacity: 0.5;
        cursor: not-allowed;
    }

    .page-link.disabled:hover {
        background: transparent;
        color: var(--dark-color);
        border-color: #ddd;
    }

    /* No Results State */
    .no-results-state {
        text-align: center;
        padding: 2rem;
        color: #666;
        display: none;
    }

    .no-results-state i {
        font-size: 3rem;
        margin-bottom: 1rem;
        opacity: 0.3;
        color: var(--dark-color);
    }

    .no-results-state h4 {
        font-size: 1.25rem;
        margin-bottom: 0.5rem;
        color: var(--dark-color);
    }

    /* Loading State */
    .loading {
        opacity: 0.7;
        pointer-events: none;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .stats-grid {
            grid-template-columns: 1fr;
        }

        .page-header {
            padding: 1.5rem;
        }

        .page-header h1 {
            font-size: 2rem;
        }

        .card-header {
            flex-direction: column;
            align-items: flex-start;
            gap: 1rem;
        }

        .card-actions {
            width: 100%;
            justify-content: flex-start;
        }

        .filters {
            flex-direction: column;
            align-items: stretch;
        }

        .filter-group {
            width: 100%;
        }

        .filter-select {
            width: 100%;
        }

        .search-container {
            min-width: 100%;
        }

        .table {
            font-size: 0.9rem;
        }

        .table th,
        .table td {
            padding: 0.75rem;
        }

        .action-buttons {
            flex-direction: column;
        }

        .action-btn {
            width: 32px;
            height: 32px;
        }
    }

    @media (max-width: 480px) {
        .page-header {
            padding: 1rem;
        }

        .page-header h1 {
            font-size: 1.75rem;
        }

        .stat-card {
            padding: 1rem;
        }

        .stat-value {
            font-size: 2rem;
        }

        .stat-icon {
            font-size: 2rem;
        }

        .content-card {
            padding: 1rem;
        }
    }

    /* Animation for loading */
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

    /* Custom scrollbar */
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
</style>

<div class="container-fluid">
    <!-- Page Header -->
    <div class="page-header fade-in">
        <h1><i class="fas fa-users-medical"></i> 4Ps Beneficiaries Management</h1>
        <p>Manage and monitor Pantawid Pamilyang Pilipino Program beneficiaries with real-time statistics and insights.</p>
    </div>

    <!-- Statistics Cards -->
    <div class="stats-grid fade-in" style="animation-delay: 0.1s;">
        <div class="stat-card total">
            <i class="fas fa-users stat-icon"></i>
            <div class="stat-value">{{ number_format($totalBeneficiaries) }}</div>
            <div class="stat-label">Total Beneficiaries</div>
            <div class="stat-change">
                <i class="fas fa-arrow-up"></i> Updated Today
            </div>
        </div>

        <div class="stat-card active">
            <i class="fas fa-check-circle stat-icon"></i>
            <div class="stat-value">{{ number_format($activeBeneficiaries) }}</div>
            <div class="stat-label">Active Beneficiaries</div>
            <div class="stat-change">
                <i class="fas fa-chart-line"></i> {{ number_format(($activeBeneficiaries/$totalBeneficiaries)*100, 1) }}% of total
            </div>
        </div>

        <div class="stat-card inactive">
            <i class="fas fa-times-circle stat-icon"></i>
            <div class="stat-value">{{ number_format($inactiveBeneficiaries) }}</div>
            <div class="stat-label">Inactive Beneficiaries</div>
            <div class="stat-change">
                <i class="fas fa-chart-bar"></i> {{ number_format(($inactiveBeneficiaries/$totalBeneficiaries)*100, 1) }}% of total
            </div>
        </div>
    </div>
     <!-- Quick Stats Footer -->
    <div class="row fade-in" style="animation-delay: 0.3s;">
        <div class="col-md-4">
            <div class="content-card" style="text-align: center; padding: 1rem;">
                <div style="font-size: 0.9rem; color: #666; margin-bottom: 0.5rem;">
                    <i class="fas fa-chart-pie"></i> Active Rate
                </div>
                <div style="font-size: 2rem; font-weight: 700; color: var(--success-color);">
                    {{ number_format(($activeBeneficiaries/$totalBeneficiaries)*100, 1) }}%
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="content-card" style="text-align: center; padding: 1rem;">
                <div style="font-size: 0.9rem; color: #666; margin-bottom: 0.5rem;">
                    </div>
                    <i class="fas fa-user-check"></i> Resident Match
                <div style="font-size: 2rem; font-weight: 700; color: var(--secondary-color);">
                    {{ number_format(($fourps->where('resident_id', '!=', null)->count()/$totalBeneficiaries)*100, 1) }}%
                </div>
            </div>
        </div>
        <!-- <div class="col-md-4">
            <div class="content-card" style="text-align: center; padding: 1rem;">
                <div style="font-size: 0.9rem; color: #666; margin-bottom: 0.5rem;">
                    <i class="fas fa-calendar-alt"></i> Updated
                </div>
                <div style="font-size: 1.25rem; font-weight: 600; color: var(--dark-color);">
                    {{ now()->format('F d, Y') }}
                </div>
            </div>
        </div> -->
    </div>
    <!-- Main Content Card -->
    <div class="content-card fade-in" style="animation-delay: 0.2s;">
        <div class="card-header">
            <div class="card-title">
                <i class="fas fa-list"></i>
                <span>Beneficiaries List</span>
                <span class="badge bg-primary" style="background: var(--secondary-color); color: white; padding: 0.25rem 0.75rem; border-radius: 12px; font-size: 0.85rem;">
                    {{ $totalBeneficiaries }} Records
                </span>
            </div>
            <div class="card-actions">
                <!-- <button class="btn btn-outline" id="exportBtn">
                    <i class="fas fa-download"></i> Export
                </button> -->
                <button class="btn btn-primary" id="refreshBtn">
                    <i class="fas fa-sync-alt"></i> Refresh
                </button>
            </div>
        </div>

        <!-- Filters -->
        <div class="filters">
            <div class="filter-group">
                <span class="filter-label">Status:</span>
                <select class="filter-select" id="statusFilter">
                    <option value="all">All Status</option>
                    <option value="active">Active</option>
                    <option value="inactive">Inactive</option>
                </select>
            </div>
            <div class="filter-group">
                <span class="filter-label">Sort By:</span>
                <select class="filter-select" id="sortFilter">
                    <option value="name_asc">Name (A-Z)</option>
                    <option value="name_desc">Name (Z-A)</option>
                    <option value="date_asc">Date Added (Oldest)</option>
                    <option value="date_desc">Date Added (Newest)</option>
                    <option value="status">Status</option>
                </select>
            </div>
            <div class="search-container">
                <div class="search-wrapper">
                    <i class="fas fa-search search-icon"></i>
                    <input type="text" id="searchInput" class="search-input" placeholder="Search beneficiaries by name, 4Ps ID...">
                    <button type="button" class="clear-search" id="clearSearchBtn">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Search Results Info -->
        <div class="search-results-info" id="searchResultsInfo" style="display: none;">
            Showing <strong id="resultsCount">0</strong> of <strong>{{ $fourps->count() }}</strong> records
            <span id="searchTermText"></span>
        </div>

        <!-- No Results State -->
        <div class="no-results-state" id="noResultsState">
            <i class="fas fa-search"></i>
            <h4>No Beneficiaries Found</h4>
            <p>No beneficiaries match your search criteria. Try adjusting your filters or search term.</p>
            <button class="btn btn-outline" id="clearFiltersBtn">
                <i class="fas fa-times"></i> Clear All Filters
            </button>
        </div>

        <!-- Beneficiaries Table -->
        <div class="table-container">
            @if($fourps->count() > 0)
            <table class="table" id="beneficiariesTable">
                <thead>
                    <tr>
                        <th>Beneficiary Information</th>
                        <th>4Ps ID</th>
                        <th>Status</th>
                        <th>Date Registered</th>
                        <!-- <th>Actions</th> -->
                    </tr>
                </thead>
                <tbody id="beneficiariesTableBody">
                    @foreach ($fourps as $beneficiary)
                    <tr class="fade-in beneficiary-row"
                        style="animation-delay: {{ $loop->index * 0.05 }}s;"
                        data-fullname="{{ strtolower(($beneficiary->resident ? $beneficiary->resident->Fname . ' ' . $beneficiary->resident->mname . ' ' . $beneficiary->resident->lname : '(No associated resident)')) }}"
                        data-firstname="{{ strtolower($beneficiary->resident ? $beneficiary->resident->Fname : '') }}"
                        data-lastname="{{ strtolower($beneficiary->resident ? $beneficiary->resident->lname : '') }}"
                        data-fourps-id="{{ strtolower($beneficiary->fourps_id ?? '') }}"
                        data-status="{{ strtolower($beneficiary->status ?? '') }}"
                        data-created-at="{{ $beneficiary->created_at ? $beneficiary->created_at->format('Y-m-d') : '' }}"
                        data-registered-date="{{ $beneficiary->created_at ? $beneficiary->created_at->timestamp : 0 }}">
                        <td>
                            <div class="resident-info">
                                <div class="resident-avatar">
                                    @if ($beneficiary->resident)
                                        {{ substr($beneficiary->resident->Fname, 0, 1) }}{{ substr($beneficiary->resident->lname, 0, 1) }}
                                    @else
                                        NA
                                    @endif
                                </div>
                                <div class="resident-details">
                                    <h4>
                                        @if ($beneficiary->resident)
                                            {{ $beneficiary->resident->Fname }} {{ $beneficiary->resident->mname }} {{ $beneficiary->resident->lname }}
                                        @else
                                            <span style="color: #999;">(No associated resident)</span>
                                        @endif
                                    </h4>
                                    @if ($beneficiary->resident)
                                        <p>
                                            <i class="fas fa-home"></i>
                                            {{ $beneficiary->resident->purok_no ?? 'N/A' }} •
                                            <i class="fas fa-hashtag"></i>
                                            {{ $beneficiary->resident->household_no ?? 'N/A' }}
                                        </p>
                                    @endif
                                </div>
                            </div>
                        </td>
                        <td>
                            <strong>{{ $beneficiary->fourps_id ?? 'N/A' }}</strong>
                        </td>
                        <td>
                            @if ($beneficiary->status == 'active')
                                <span class="status-badge active">
                                    <i class="fas fa-check-circle"></i> Active
                                </span>
                            @elseif ($beneficiary->status == 'inactive')
                                <span class="status-badge inactive">
                                    <i class="fas fa-times-circle"></i> Inactive
                                </span>
                            @else
                                <span class="status-badge pending">
                                    <i class="fas fa-clock"></i> Pending
                                </span>
                            @endif
                        </td>
                        <td>
                            {{ $beneficiary->created_at ? $beneficiary->created_at->format('M d, Y') : 'N/A' }}
                        </td>
                            <!-- <td>
                                <div class="action-buttons">
                                    <button class="action-btn view" title="View Details">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>
                            </td> -->
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @else
            <div class="empty-state">
                <i class="fas fa-users"></i>
                <h3>No Beneficiaries Found</h3>
                <p>There are no 4Ps beneficiaries in the system yet.</p>
                <button class="btn btn-success">
                    <i class="fas fa-plus"></i> Add First Beneficiary
                </button>
            </div>
            @endif
        </div>
    </div>


</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Elements
    const statusFilter = document.getElementById('statusFilter');
    const sortFilter = document.getElementById('sortFilter');
    const searchInput = document.getElementById('searchInput');
    const clearSearchBtn = document.getElementById('clearSearchBtn');
    const searchResultsInfo = document.getElementById('searchResultsInfo');
    const resultsCount = document.getElementById('resultsCount');
    const searchTermText = document.getElementById('searchTermText');
    const noResultsState = document.getElementById('noResultsState');
    const clearFiltersBtn = document.getElementById('clearFiltersBtn');
    const refreshBtn = document.getElementById('refreshBtn');
    const exportBtn = document.getElementById('exportBtn');
    const beneficiaryRows = document.querySelectorAll('.beneficiary-row');
    const beneficiariesTableBody = document.getElementById('beneficiariesTableBody');

    // View buttons
    const viewButtons = document.querySelectorAll('.action-btn.view');

    // Current filter state
    let currentFilters = {
        status: 'all',
        sort: 'name_asc',
        search: ''
    };

    // Initialize
    function initialize() {
        // Add event listeners
        statusFilter.addEventListener('change', handleStatusFilter);
        sortFilter.addEventListener('change', handleSortFilter);
        searchInput.addEventListener('input', handleSearchInput);
        clearSearchBtn.addEventListener('click', clearSearch);
        clearFiltersBtn.addEventListener('click', clearAllFilters);
        refreshBtn.addEventListener('click', handleRefresh);
        exportBtn.addEventListener('click', handleExport);

        // Add view button functionality
        viewButtons.forEach(btn => {
            btn.addEventListener('click', handleViewBeneficiary);
        });

        // Add hover effects to table rows
        beneficiaryRows.forEach(row => {
            row.addEventListener('mouseenter', function() {
                this.style.backgroundColor = '#f8f9fa';
            });
            row.addEventListener('mouseleave', function() {
                this.style.backgroundColor = '';
            });
        });

        // Apply initial filters
        applyFilters();
    }

    // Handle status filter change
    function handleStatusFilter() {
        currentFilters.status = this.value;
        applyFilters();
    }

    // Handle sort filter change
    function handleSortFilter() {
        currentFilters.sort = this.value;
        applyFilters();
    }

    // Handle search input
    function handleSearchInput() {
        currentFilters.search = this.value.toLowerCase().trim();
        clearSearchBtn.style.display = currentFilters.search ? 'block' : 'none';
        applyFilters();
    }

    // Clear search
    function clearSearch() {
        searchInput.value = '';
        currentFilters.search = '';
        clearSearchBtn.style.display = 'none';
        applyFilters();
        searchInput.focus();
    }

    // Clear all filters
    function clearAllFilters() {
        statusFilter.value = 'all';
        sortFilter.value = 'name_asc';
        searchInput.value = '';
        currentFilters.status = 'all';
        currentFilters.sort = 'name_asc';
        currentFilters.search = '';
        clearSearchBtn.style.display = 'none';
        applyFilters();
    }

    // Handle refresh
    function handleRefresh() {
        const icon = this.querySelector('i');
        icon.classList.add('fa-spin');
        this.classList.add('loading');

        // Simulate API call
        setTimeout(() => {
            icon.classList.remove('fa-spin');
            this.classList.remove('loading');
            // In real implementation, this would fetch fresh data
            // For now, just re-apply filters
            applyFilters();

            // Show success message
            showNotification('Data refreshed successfully!', 'success');
        }, 1000);
    }

    // Handle export
    function handleExport() {
        this.classList.add('loading');

        // Simulate export process
        setTimeout(() => {
            this.classList.remove('loading');

            // Get filtered data
            const filteredRows = Array.from(beneficiaryRows).filter(row => row.style.display !== 'none');

            if (filteredRows.length === 0) {
                showNotification('No data to export!', 'warning');
                return;
            }

            // In real implementation, this would trigger a download
            // For now, show a success message
            showNotification(`Exporting ${filteredRows.length} records...`, 'success');

            // Simulate download
            setTimeout(() => {
                showNotification('Export completed successfully!', 'success');
            }, 500);
        }, 500);
    }

    // Handle view beneficiary
    function handleViewBeneficiary() {
        const row = this.closest('.beneficiary-row');
        const name = row.querySelector('.resident-details h4').textContent;
        const fourpsId = row.querySelector('td:nth-child(2) strong').textContent;
        const status = row.querySelector('.status-badge').textContent.trim();

        // Show beneficiary details (in real app, this would open a modal)
        const details = `
            <strong>Name:</strong> ${name}<br>
            <strong>4Ps ID:</strong> ${fourpsId}<br>
            <strong>Status:</strong> ${status}
        `;

        showNotification(details, 'info', 5000);
    }

    // Apply all filters
    function applyFilters() {
        let visibleCount = 0;

        // First, show all rows
        beneficiaryRows.forEach(row => {
            row.style.display = 'table-row';
        });

        // Apply status filter
        if (currentFilters.status !== 'all') {
            beneficiaryRows.forEach(row => {
                if (row.style.display !== 'none') {
                    const rowStatus = row.dataset.status;
                    if (rowStatus !== currentFilters.status) {
                        row.style.display = 'none';
                    }
                }
            });
        }

        // Apply search filter
        if (currentFilters.search) {
            beneficiaryRows.forEach(row => {
                if (row.style.display !== 'none') {
                    const fullName = row.dataset.fullname;
                    const fourpsId = row.dataset.fourpsId;
                    const firstName = row.dataset.firstname;
                    const lastName = row.dataset.lastname;

                    const matchesSearch = fullName.includes(currentFilters.search) ||
                                        fourpsId.includes(currentFilters.search) ||
                                        firstName.includes(currentFilters.search) ||
                                        lastName.includes(currentFilters.search);

                    if (!matchesSearch) {
                        row.style.display = 'none';
                    }
                }
            });
        }

        // Count visible rows
        beneficiaryRows.forEach(row => {
            if (row.style.display !== 'none') {
                visibleCount++;
            }
        });

        // Sort rows
        sortRows();

        // Update UI
        updateResultsInfo(visibleCount);

        // Show/hide no results state
        if (visibleCount === 0 && beneficiaryRows.length > 0) {
            noResultsState.style.display = 'block';
            document.querySelector('.table-container').style.display = 'none';
        } else {
            noResultsState.style.display = 'none';
            document.querySelector('.table-container').style.display = 'block';
        }
    }

    // Sort rows
    function sortRows() {
        const rowsArray = Array.from(beneficiaryRows);

        rowsArray.sort((a, b) => {
            switch(currentFilters.sort) {
                case 'name_asc':
                    const nameA = (a.dataset.lastname || '') + (a.dataset.firstname || '');
                    const nameB = (b.dataset.lastname || '') + (b.dataset.firstname || '');
                    return nameA.localeCompare(nameB);

                case 'name_desc':
                    const nameC = (a.dataset.lastname || '') + (a.dataset.firstname || '');
                    const nameD = (b.dataset.lastname || '') + (b.dataset.firstname || '');
                    return nameD.localeCompare(nameC);

                case 'date_asc':
                    return new Date(a.dataset.createdAt) - new Date(b.dataset.createdAt);

                case 'date_desc':
                    return new Date(b.dataset.createdAt) - new Date(a.dataset.createdAt);

                case 'status':
                    const statusA = a.dataset.status || '';
                    const statusB = b.dataset.status || '';
                    return statusA.localeCompare(statusB);

                default:
                    return 0;
            }
        });

        // Reorder rows in the table
        rowsArray.forEach(row => {
            if (row.style.display !== 'none') {
                beneficiariesTableBody.appendChild(row);
            }
        });
    }

    // Update results info
    function updateResultsInfo(visibleCount) {
        if (currentFilters.status !== 'all' || currentFilters.search) {
            searchResultsInfo.style.display = 'block';
            resultsCount.textContent = visibleCount;

            let filterText = '';
            if (currentFilters.search) {
                filterText += ` for "<strong>${currentFilters.search}</strong>"`;
            }
            if (currentFilters.status !== 'all') {
                filterText += (currentFilters.search ? ' and ' : ' for ') +
                            `<strong>${currentFilters.status.charAt(0).toUpperCase() + currentFilters.status.slice(1)}</strong> status`;
            }

            searchTermText.innerHTML = filterText;
        } else {
            searchResultsInfo.style.display = 'none';
        }
    }

    // Show notification
    function showNotification(message, type = 'info', duration = 3000) {
        // Remove existing notifications
        const existingNotifications = document.querySelectorAll('.custom-notification');
        existingNotifications.forEach(notification => notification.remove());

        // Create notification element
        const notification = document.createElement('div');
        notification.className = `custom-notification alert alert-${type === 'success' ? 'success' : type === 'warning' ? 'warning' : type === 'error' ? 'danger' : 'info'} alert-dismissible fade show position-fixed`;
        notification.style.cssText = `
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 9999;
            min-width: 300px;
            max-width: 400px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        `;

        const icon = type === 'success' ? 'fa-check-circle' :
                    type === 'warning' ? 'fa-exclamation-triangle' :
                    type === 'error' ? 'fa-times-circle' : 'fa-info-circle';

        notification.innerHTML = `
            <div class="d-flex align-items-center">
                <i class="fas ${icon} me-2" style="font-size: 1.2rem;"></i>
                <div>${message}</div>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        `;

        document.body.appendChild(notification);

        // Auto remove after duration
        setTimeout(() => {
            if (notification.parentNode) {
                notification.remove();
            }
        }, duration);
    }

    // Keyboard shortcuts
    document.addEventListener('keydown', function(e) {
        // Focus search on Ctrl/Cmd + F
        if ((e.ctrlKey || e.metaKey) && e.key === 'f') {
            e.preventDefault();
            searchInput.focus();
            searchInput.select();
        }

        // Clear filters on Escape
        if (e.key === 'Escape' && document.activeElement === searchInput) {
            clearAllFilters();
        }
    });

    // Initialize the application
    initialize();
});
</script>
@endsection
