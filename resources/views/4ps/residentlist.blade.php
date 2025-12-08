@extends('4ps.dashboard')

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
        --primary-gradient: #2c3e50;
        --secondary-gradient: linear-gradient(135deg, #7209b7, #f72585);
        --success-gradient: #28a745;
        --warning-gradient:  #f8961e;
        --danger-gradient: #dc3545;
        --dark-color: #1a1a2e;
        --light-color: #f8f9fa;
        --card-bg: #ffffff;
        --shadow-sm: 0 2px 4px rgba(0, 0, 0, 0.05);
        --shadow-md: 0 4px 6px rgba(0, 0, 0, 0.07);
        --shadow-lg: 0 10px 15px rgba(0, 0, 0, 0.1);
        --border-radius: 12px;
        --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    body {
        background: linear-gradient(135deg, #f6f9ff 0%, #edf2ff 100%);
        min-height: 100vh;
        font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
        color: #333;
    }

    /* Glass Morphism Effect */
    .glass-card {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.2);
        box-shadow: var(--shadow-lg);
    }

    /* Autocomplete Styles */
    .ui-autocomplete {
        z-index: 99999 !important;
        max-height: 300px;
        overflow-y: auto;
        overflow-x: hidden;
        background: white;
        border-radius: 8px;
        box-shadow: var(--shadow-lg);
        border: 1px solid #e2e8f0;
    }

    .ui-autocomplete .ui-menu-item {
        padding: 12px 16px;
        border-bottom: 1px solid #f1f5f9;
        cursor: pointer;
        transition: var(--transition);
        font-size: 14px;
    }

    .ui-autocomplete .ui-menu-item:last-child {
        border-bottom: none;
    }

    .ui-autocomplete .ui-menu-item:hover {
        background: rgba(67, 97, 238, 0.1);
    }

    .ui-autocomplete .ui-state-focus {
        background: var(--primary-gradient) !important;
        color: white !important;
        border: none !important;
        margin: 0 !important;
    }

    /* Toggle Button */
    .toggle-manual-btn {
        background: #f8f9fa;
        border: 2px dashed #dee2e6;
        color: #6c757d;
        padding: 10px 20px;
        border-radius: 8px;
        cursor: pointer;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
    }

    .toggle-manual-btn:hover {
        background: #e9ecef;
        border-color: #4361ee;
        color: #4361ee;
    }

    /* Readonly Input Style */
    .form-control[readonly] {
        background-color: #f8f9fa;
        cursor: not-allowed;
    }

    /* Form Section */
    .form-section {
        background: #f8fafc;
        border-radius: 10px;
        padding: 20px;
        margin-bottom: 20px;
        border: 1px solid #e2e8f0;
    }

    /* Manual Entry Fields */
    .manual-entry-fields {
        border-top: 2px solid #4361ee;
        padding-top: 20px;
        margin-top: 20px;
    }

    /* Enhanced Container */
    .container {
        max-width: 1400px;
        padding: 20px;
    }

    /* Modern Card Design */
    .card {
        border: none;
        border-radius: var(--border-radius);
        box-shadow: var(--shadow-md);
        margin-bottom: 24px;
        transition: var(--transition);
        overflow: hidden;
        background: var(--card-bg);
    }

    .card:hover {
        /* transform: translateY(-4px); */
        box-shadow: var(--shadow-lg);
    }

    .card-header {
        background: var(--primary-gradient);
        color: white;
        border-bottom: none;
        padding: 20px 24px;
        font-weight: 600;
        font-size: 1.1rem;
        position: relative;
        overflow: hidden;
    }

    .card-header::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        height: 3px;
        background: rgba(255, 255, 255, 0.3);
    }

    /* Enhanced Stats Cards */
    .stats-card {
        background: var(--card-bg);
        border-radius: var(--border-radius);
        padding: 24px;
        text-align: center;
        transition: var(--transition);
        position: relative;
        overflow: hidden;
        cursor: pointer;
        border: 1px solid rgba(0, 0, 0, 0.05);
        height: 100%;
    }

    .stats-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: var(--primary-gradient);
    }

    .stats-card:hover {
        transform: translateY(-6px);
        box-shadow: var(--shadow-lg);
    }

    .stats-card:nth-child(2)::before { background: var(--success-gradient); }
    .stats-card:nth-child(3)::before { background: var(--warning-gradient); }
    .stats-card:nth-child(4)::before { background: var(--secondary-gradient); }

    .stats-number {
        font-size: 2.75rem;
        font-weight: 800;
        background: var(--primary-gradient);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        margin-bottom: 8px;
        line-height: 1;
        display: block;
    }

    .stats-label {
        font-size: 0.9rem;
        color: #666;
        text-transform: uppercase;
        letter-spacing: 1px;
        font-weight: 600;
    }

    /* Enhanced Form Controls */
    .form-label {
        font-weight: 600;
        color: var(--dark-color);
        margin-bottom: 8px;
        font-size: 0.9rem;
    }

    .form-control, .form-select {
        border-radius: 8px;
        padding: 12px 16px;
        border: 2px solid #e2e8f0;
        transition: var(--transition);
        font-size: 0.95rem;
        background: #fff;
    }

    .form-control:focus,
    .form-select:focus {
        border-color: #4361ee;
        box-shadow: 0 0 0 3px rgba(67, 97, 238, 0.15);
        transform: translateY(-1px);
    }

    .form-control.is-invalid {
        border-color: #ef476f;
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 12 12' width='12' height='12' fill='none' stroke='%23ef476f'%3e%3ccircle cx='6' cy='6' r='4.5'/%3e%3cpath stroke-linejoin='round' d='M5.8 3.6h.4L6 6.5z'/%3e%3ccircle cx='6' cy='8.2' r='.6' fill='%23ef476f' stroke='none'/%3e%3c/svg%3e");
    }

    .card {
        border: none;
        border-radius: 12px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        margin-bottom: 1.5rem;
    }

    /* Modern Buttons */
    .btn {
        border-radius: 8px;
        padding: 12px 24px;
        font-weight: 600;
        transition: var(--transition);
        border: none;
        position: relative;
        overflow: hidden;
    }

    .btn::before {
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

    .btn:hover::before {
        width: 300px;
        height: 300px;
    }

    .btn-primary {
        background: var(--primary-gradient);
        box-shadow: 0 4px 15px rgba(67, 97, 238, 0.3);
        color: white;
    }

    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(67, 97, 238, 0.4);
        color: white;
    }

    .btn-warning {
        background: #4361ee;
        color: white;
        box-shadow: 0 4px 15px rgba(248, 150, 30, 0.3);
    }

    .btn-warning:hover {
        background-color: #4361ee;
        color: white;
    }

    .btn-danger {
        background: var(--danger-gradient);
        box-shadow: 0 4px 15px rgba(239, 71, 111, 0.3);
        color: white;
    }

    .btn-danger:hover {
        color: white;
    }

    .btn-sm {
        padding: 8px 16px;
        font-size: 0.875rem;
    }

    /* Enhanced Table */
    .table {
        border-radius: var(--border-radius);
        overflow: hidden;
        box-shadow: var(--shadow-sm);
        margin-bottom: 0;
        background: white;
    }

    .table thead {
        background: linear-gradient(135deg, #1a1a2e, #16213e);
    }

    .table th {
        background-color: var(--primary-gradient);
        border: none;
        padding: 18px 16px;
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.8rem;
        letter-spacing: 0.5px;
        color: white;
        border-bottom: none;
    }

    .table td {
        padding: 18px 16px;
        vertical-align: middle;
        border-color: #f1f5f9;
        font-weight: 500;
    }

    .table tbody tr {
        transition: background-color 0.2s;
        border-bottom: 1px solid #f1f5f9;
    }

    .table tbody tr:hover {
        background-color: rgba(67, 97, 238, 0.05);
    }

    .table tbody tr:last-child {
        border-bottom: none;
    }

    /* Modern Badges */
    .badge {
        padding: 8px 16px;
        border-radius: 20px;
        font-weight: 600;
        font-size: 0.75rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        box-shadow: var(--shadow-sm);
    }

    .badge.bg-success {
        background: var(--success-gradient) !important;
        color: white !important;
    }

    .badge.bg-primary {
        background: var(--primary-gradient) !important;
        color: white !important;
    }

    .badge.bg-secondary {
        background: var(  --danger-gradient) !important;
        color: white !important;
    }

    .badge.bg-danger {
        background: var(--danger-gradient) !important;
        color: white !important;
    }

    /* Enhanced Modal */
    .modal-content {
        border-radius: var(--border-radius);
        border: none;
        overflow: hidden;
        box-shadow: 0 20px 25px rgba(0, 0, 0, 0.15);
    }

    .modal-header {
        background: var(--primary-gradient);
        color: white;
        padding: 24px;
        border-bottom: none;
    }

    .modal-title {
        font-weight: 700;
        font-size: 1.25rem;
    }

    .modal-body {
        padding: 32px;
        background: #f8fafc;
    }

    .modal-footer {
        padding: 20px 32px;
        background: white;
        border-top: 1px solid #e2e8f0;
    }

    .btn-close-white {
        filter: invert(1) grayscale(100%) brightness(200%);
    }

    /* Section Titles */
    .section-title {
        color: var(--dark-color);
        font-weight: 700;
        margin-bottom: 24px;
        padding-bottom: 12px;
        position: relative;
        display: inline-block;
        font-size: 1.5rem;
    }

    .section-title::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 60px;
        height: 4px;
        background: var(--primary-gradient);
        border-radius: 2px;
    }

    /* Resident Info Card */
    .resident-info-card {
        background: linear-gradient(135deg, #f1f5f9, #e2e8f0);
        border-left: 4px solid #4361ee;
        padding: 20px;
        margin: 24px 0;
        border-radius: 8px;
        box-shadow: var(--shadow-sm);
        transition: var(--transition);
    }

    .resident-info-card:hover {
        transform: translateX(4px);
    }

    .info-icon {
        color: #4361ee;
        margin-right: 12px;
        font-size: 1.2rem;
        background: rgba(67, 97, 238, 0.1);
        width: 40px;
        height: 40px;
        border-radius: 50%;
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }

    /* Action Buttons */
    .action-buttons {
        display: flex;
        gap: 8px;
        justify-content: flex-start;
    }

    .action-buttons .btn {
        min-width: 44px;
        height: 44px;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 0;
        border-radius: 10px;
    }

    /* Empty State */
    .empty-state {
        text-align: center;
        padding: 64px 32px;
        color: #64748b;
    }

    .empty-state i {
        font-size: 4rem;
        margin-bottom: 20px;
        opacity: 0.5;
        background: linear-gradient(135deg, #94a3b8, #64748b);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    /* Loading Animation */
    .loading-spinner {
        width: 40px;
        height: 40px;
        border: 3px solid rgba(67, 97, 238, 0.1);
        border-radius: 50%;
        border-top-color: #4361ee;
        animation: spin 1s ease-in-out infinite;
    }

    @keyframes spin {
        to { transform: rotate(360deg); }
    }

    /* Floating Action Button */
    .fab {
        position: fixed;
        bottom: 30px;
        right: 30px;
        width: 60px;
        height: 60px;
        border-radius: 50%;
        background: var(--primary-gradient);
        color: white;
        border: none;
        box-shadow: 0 8px 20px rgba(67, 97, 238, 0.4);
        transition: var(--transition);
        z-index: 1000;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        cursor: pointer;
    }

    .fab:hover {
        transform: scale(1.1) rotate(90deg);
        box-shadow: 0 12px 25px rgba(67, 97, 238, 0.5);
    }

    /* Animations */
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

    .fade-in-up {
        animation: fadeInUp 0.5s ease-out;
    }

    @keyframes pulse {
        0% { transform: scale(1); }
        50% { transform: scale(1.05); }
        100% { transform: scale(1); }
    }

    .pulse {
        animation: pulse 2s infinite;
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
        background: linear-gradient(135deg, #4361ee, #3a0ca3);
        border-radius: 4px;
    }

    ::-webkit-scrollbar-thumb:hover {
        background: linear-gradient(135deg, #3a0ca3, #4361ee);
    }

    /* Status Indicators */
    .status-indicator {
        display: inline-block;
        width: 8px;
        height: 8px;
        border-radius: 50%;
        margin-right: 6px;
    }

    .status-active { background: #10b981; }
    .status-inactive { background: #6b7280; }
    .status-pending { background: #f59e0b; }

    /* Tooltip Enhancements */
    .tooltip {
        --bs-tooltip-bg: var(--dark-color);
        --bs-tooltip-color: white;
    }

    /* Focus States */
    *:focus {
        outline: 2px solid rgba(67, 97, 238, 0.5);
        outline-offset: 2px;
    }

    /* Smooth Transitions */
    a, button, .btn, .card, .stats-card {
        transition: var(--transition);
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .container {
            padding: 12px;
        }

        .card-body {
            padding: 16px;
        }

        .table-responsive {
            border-radius: 8px;
            font-size: 0.875rem;
        }

        .table th,
        .table td {
            padding: 12px 8px;
        }

        .stats-card {
            padding: 20px 16px;
            margin-bottom: 16px;
        }

        .stats-number {
            font-size: 2rem;
        }

        .modal-body {
            padding: 20px;
        }

        .modal-header {
            padding: 16px;
        }

        .btn {
            padding: 10px 20px;
        }

        .section-title {
            font-size: 1.25rem;
        }

        .action-buttons {
            flex-wrap: wrap;
        }

        .action-buttons .btn {
            width: 40px;
            height: 40px;
        }
    }

    @media (max-width: 576px) {
        .modal-dialog {
            margin: 10px;
        }

        .modal-content {
            border-radius: 16px;
        }

        .action-buttons {
            flex-direction: column;
            gap: 4px;
        }

        .action-buttons .btn {
            width: 100%;
            justify-content: center;
        }

        .fab {
            bottom: 20px;
            right: 20px;
            width: 50px;
            height: 50px;
            font-size: 1.25rem;
        }

        .resident-info-card .row > div {
            margin-bottom: 10px;
        }
    }

    /* Print Styles */
    @media print {
        .btn,
        .action-buttons,
        .modal,
        .fab {
            display: none !important;
        }

        .card {
            box-shadow: none !important;
            border: 1px solid #ddd !important;
            break-inside: avoid;
        }

        .table {
            box-shadow: none !important;
            border: 1px solid #ddd;
        }

        .stats-card {
            border: 1px solid #ddd !important;
        }
    }

    /* Additional Utility Classes */
    .text-gradient {
        background: var(--primary-gradient);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    .shadow-hover:hover {
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
    }

    .transition-all {
        transition: all 0.3s ease;
    }

    /* Search Input Styling */
    .search-container {
        position: relative;
    }

    .search-icon {
        position: absolute;
        right: 12px;
        top: 50%;
        transform: translateY(-50%);
        color: #94a3b8;
    }

    /* NEW: Search and Filter Bar Styles */
    .search-filter-bar {
        background: white;
        border-radius: 10px;
        padding: 20px;
        margin-bottom: 20px;
        box-shadow: var(--shadow-sm);
        border: 1px solid #e2e8f0;
    }

    .search-filter-bar .form-control {
        border-radius: 8px;
        padding: 12px 16px;
        border: 2px solid #e2e8f0;
        transition: var(--transition);
    }

    .search-filter-bar .form-control:focus {
        border-color: #4361ee;
        box-shadow: 0 0 0 3px rgba(67, 97, 238, 0.15);
    }

    .search-filter-bar .form-select {
        border-radius: 8px;
        padding: 12px 16px;
        border: 2px solid #e2e8f0;
        transition: var(--transition);
        height: auto;
    }

    .search-filter-bar .form-select:focus {
        border-color: #4361ee;
        box-shadow: 0 0 0 3px rgba(67, 97, 238, 0.15);
    }

    .filter-badge {
        cursor: pointer;
        transition: var(--transition);
    }

    .filter-badge:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
    }

    .filter-badge.active {
        background: var(--primary-gradient) !important;
        color: white !important;
    }

    .clear-filters-btn {
        color: #ef476f;
        cursor: pointer;
        transition: color 0.3s ease;
    }

    .clear-filters-btn:hover {
        color: #dc3545;
        text-decoration: underline;
    }

    .results-count {
        font-size: 0.9rem;
        color: #64748b;
        font-weight: 500;
    }

    /* Status dropdown indicator */
    .status-dropdown-indicator {
        position: absolute;
        right: 12px;
        top: 50%;
        transform: translateY(-50%);
        pointer-events: none;
        color: #64748b;
    }

    /* Loading Overlay */
    .table-loading {
        position: relative;
        min-height: 200px;
    }

    .table-loading::after {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(255, 255, 255, 0.8);
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 10;
        border-radius: var(--border-radius);
    }

    .table-loading::before {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 40px;
        height: 40px;
        border: 3px solid rgba(67, 97, 238, 0.1);
        border-radius: 50%;
        border-top-color: #4361ee;
        animation: spin 1s linear infinite;
        z-index: 11;
    }

    /* Status dropdown option colors */
    .status-option-all {
        color: #64748b;
    }

    .status-option-active {
        color: #10b981;
        font-weight: 500;
    }

    .status-option-inactive {
        color: #6b7280;
        font-weight: 500;
    }

    /* Real-time search indicator */
    .search-indicator {
        position: absolute;
        right: 40px;
        top: 50%;
        transform: translateY(-50%);
        color: #4361ee;
        font-size: 0.875rem;
        display: none;
    }

    .searching .search-indicator {
        display: block;
    }
</style>

<div class="container py-4">
    <!-- Header Section -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="section-title">
                <i class="fas fa-users me-2 text-gradient"></i>4Ps Beneficiaries Management
            </h1>
            <p class="text-muted">Manage 4Ps beneficiaries and their information</p>
        </div>
        <button type="button" class="btn btn-primary d-none d-md-block" data-bs-toggle="modal" data-bs-target="#addModal">
            <i class="fas fa-plus-circle me-2"></i>Add New Beneficiary
        </button>
    </div>

    <!-- Stats Cards -->
    <div class="row mb-4">
        <div class="col-md-3 col-sm-6 mb-4">
            <div class="stats-card">
                <div class="stats-number">{{ count($fourps) }}</div>
                <div class="stats-label">Total Beneficiaries</div>
                <i class="fas fa-users mt-3" style="font-size: 2rem; opacity: 100; color: #4361ee;"></i>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 mb-4">
            <div class="stats-card">
                <div class="stats-number">{{ $fourps->where('status', 'active')->count() }}</div>
                <div class="stats-label">Active</div>
                <i class="fas fa-check-circle mt-3" style="font-size: 2rem; opacity: 100; color: #28a745;"></i>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 mb-4">
            <div class="stats-card">
                <div class="stats-number">{{ $fourps->where('status', 'inactive')->count() }}</div>
                <div class="stats-label">Inactive</div>
                <i class="fas fa-times-circle mt-3" style="font-size: 2rem; opacity: 100; color: #f8961e;"></i>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 mb-4">
            <div class="stats-card">
                <div class="stats-number">{{ $fourps->whereNotNull('resident_id')->count() }}</div>
                <div class="stats-label">Resident Matched</div>
                <i class="fas fa-link mt-3" style="font-size: 2rem; opacity: 100; color: #7209b7;"></i>
            </div>
        </div>
    </div>

    <!-- NEW: Search and Filter Bar with Dropdown -->
    <div class="search-filter-bar fade-in-up">
        <div class="row align-items-center">
            <div class="col-md-6 mb-3 mb-md-0">
                <div class="search-container">
                    <input type="text"
                           id="searchInput"
                           class="form-control"
                           placeholder="Search by name, 4Ps ID, house number..."
                           autocomplete="off">
                    <i class="fas fa-search search-icon"></i>
                    <span class="search-indicator">
                        <i class="fas fa-spinner fa-spin"></i>
                    </span>
                </div>
            </div>
            <div class="col-md-4 mb-3 mb-md-0">
                <div class="position-relative">
                    <select class="form-select" id="statusFilter">
                        <option value="all" class="status-option-all">All Status</option>
                        <option value="active" class="status-option-active">Active</option>
                        <option value="inactive" class="status-option-inactive">Inactive</option>
                    </select>
                    <i class="fas fa-chevron-down status-dropdown-indicator"></i>
                </div>
            </div>
            <div class="col-md-2 text-md-end">
                <span class="results-count" id="resultsCount">{{ count($fourps) }} results</span>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="d-flex gap-2 flex-wrap" id="activeFilters">
                        <!-- Active filters will appear here -->
                    </div>
                    <div>
                        <span class="clear-filters-btn" id="clearFilters" style="display: none;">
                            <i class="fas fa-times me-1"></i>Clear all filters
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Beneficiaries Table -->
    <div class="card fade-in-up">
        <div class="card-header d-flex justify-content-between align-items-center">
            <div>
                <i class="fas fa-list me-2"></i>4Ps Beneficiaries List
            </div>
            <div class="d-flex align-items-center">
                <span class="badge bg-primary me-3" id="tableCount">{{ count($fourps) }} Records</span>
            </div>
        </div>
        <div class="card-body">
            @if(count($fourps) > 0)
            <div class="table-responsive">
                <table class="table table-hover" id="beneficiariesTable">
                    <thead>
                        <tr>
                            <th>Full Name</th>
                            <th>Purok No.</th>
                            <th>House No.</th>
                            <th>4Ps ID</th>
                            <th>Status</th>
                            <th>Resident Match</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="tableBody">
                        @foreach ($fourps as $fourp)
                            <tr class="transition-all"
                                data-name="{{ strtolower($fourp->fname . ' ' . $fourp->mname . ' ' . $fourp->lname) }}"
                                data-purok="{{ strtolower($fourp->purok_no) }}"
                                data-household="{{ strtolower($fourp->household_no) }}"
                                data-fourps-id="{{ strtolower($fourp->fourps_id) }}"
                                data-status="{{ $fourp->status }}">
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="status-indicator status-{{ $fourp->status }}"></div>
                                        {{ $fourp->fname }} {{ $fourp->mname }} {{ $fourp->lname }}
                                    </div>
                                </td>
                                <td>{{ $fourp->purok_no }}</td>
                                <td>{{ $fourp->household_no }}</td>
                                <td>
                                    <span class="badge bg-dark">{{ $fourp->fourps_id }}</span>
                                </td>
                                <td>
                                    @if ($fourp->status == 'active')
                                        <span class="badge bg-success">
                                            <i class="fas fa-check-circle me-1"></i>Active
                                        </span>
                                    @else
                                        <span class="badge bg-secondary">
                                            <i class="fas fa-times-circle me-1"></i>Inactive
                                        </span>
                                    @endif
                                </td>
                                <td>
                                    @if ($fourp->resident_id)
                                        <span class="badge bg-success">
                                            <i class="fas fa-link me-1"></i>Matched
                                        </span>
                                        @else
                                            <span class="badge bg-success">
                                                <i class="fas fa-user-edit me-1"></i>Matched
                                            </span>
                                    @endif
                                </td>
                                <td>
                                    <div class="action-buttons">
                                        <button type="button" class="btn btn-warning btn-sm edit-btn" data-bs-toggle="modal" data-bs-target="#editModal"
                                            data-id="{{ $fourp->id }}"
                                            data-fname="{{ $fourp->fname }}"
                                            data-mname="{{ $fourp->mname }}"
                                            data-lname="{{ $fourp->lname }}"
                                            data-purok_no="{{ $fourp->purok_no }}"
                                            data-household_no="{{ $fourp->household_no }}"
                                            data-fourps_id="{{ $fourp->fourps_id }}"
                                            data-status="{{ $fourp->status }}"
                                            data-resident_id="{{ $fourp->resident_id }}"
                                            title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <form action="{{ route('4ps.residentlist.destroy', $fourp->id) }}" method="POST" style="display: inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm"
                                                onclick="return confirm('Are you sure you want to delete this beneficiary? This action cannot be undone.')"
                                                title="Delete">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @else
            <div class="empty-state">
                <i class="fas fa-users"></i>
                <h4>No Beneficiaries Found</h4>
                <p class="text-muted">Start by adding your first 4Ps beneficiary.</p>
                <button type="button" class="btn btn-primary mt-3" data-bs-toggle="modal" data-bs-target="#addModal">
                    <i class="fas fa-plus-circle me-2"></i>Add First Beneficiary
                </button>
            </div>
            @endif
        </div>
    </div>
</div>

<!-- Add Modal -->
<div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="{{ route('4ps.residentlist.store') }}" method="POST" id="addForm">
                @csrf

                <!-- Hidden field to indicate manual entry -->
                <input type="hidden" name="is_manual_entry" id="is_manual_entry" value="0">
                <input type="hidden" name="resident_id" id="resident_id">

                <div class="modal-header">
                    <h5 class="modal-title">
                        <i class="fas fa-plus-circle me-2"></i>Add New 4Ps Beneficiary
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Resident Search Section -->
                    <div class="form-section">
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <h5 class="section-title">
                                    <i class="fas fa-user info-icon"></i>Resident Information
                                </h5>
                                <p class="text-muted mb-3">Search for an existing resident or enter details manually</p>
                            </div>
                        </div>

                        <!-- Search Section -->
                        <div class="row mb-4" id="searchSection">
                            <div class="col-md-12 mb-3">
                                <label for="resident_name" class="form-label">Search Existing Resident</label>
                                <div class="search-container">
                                    <input type="text" id="resident_name" class="form-control" placeholder="Type resident name to search...">
                                    <i class="fas fa-search search-icon"></i>
                                </div>
                                <div class="form-text text-muted">Start typing to search for existing residents. If found, fields will auto-fill.</div>
                            </div>
                            <div class="col-md-12">
                                <!-- <button type="button" id="toggleManualBtn" class="toggle-manual-btn w-100">
                                    <i class="fas fa-user-edit me-2"></i>
                                    Enter Details Manually Instead
                                </button> -->
                            </div>
                        </div>

                        <!-- Manual Entry Section (Hidden by default) -->
                        <div class="manual-entry-fields" id="manualEntrySection" style="display: none;">
                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <h6 class="mb-3" style="color: #4361ee;">
                                        <i class="fas fa-edit me-2"></i>Manual Entry Details
                                    </h6>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="manual_fname" class="form-label">First Name *</label>
                                    <input type="text" class="form-control" id="manual_fname" placeholder="Enter first name">
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="manual_mname" class="form-label">Middle Name</label>
                                    <input type="text" class="form-control" id="manual_mname" placeholder="Enter middle name">
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="manual_lname" class="form-label">Last Name *</label>
                                    <input type="text" class="form-control" id="manual_lname" placeholder="Enter last name">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="manual_purok_no" class="form-label">Purok No. *</label>
                                    <select class="form-select" id="manual_purok_no">
                                        <option value="">Select Purok</option>
                                        <option value="Purok 1">Purok 1</option>
                                        <option value="Purok 2">Purok 2</option>
                                        <option value="Purok 3">Purok 3</option>
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="manual_household_no" class="form-label">House No. *</label>
                                    <input type="text" class="form-control" id="manual_household_no" placeholder="Enter house number">
                                </div>
                                <div class="col-md-12">
                                    <button type="button" id="backToSearchBtn" class="btn btn-outline-secondary w-100">
                                        <i class="fas fa-search me-2"></i>
                                        Back to Search
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Auto-filled fields (Readonly) -->
                        <div class="row" id="autoFilledFields">
                            <div class="col-md-4 mb-3">
                                <label for="fname" class="form-label">First Name *</label>
                                <input type="text" class="form-control" id="fname" name="fname" required readonly>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="mname" class="form-label">Middle Name</label>
                                    <input type="text" class="form-control" id="mname" name="mname" readonly>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="lname" class="form-label">Last Name *</label>
                                <input type="text" class="form-control" id="lname" name="lname" required readonly>
                            </div>
                        </div>

                        <!-- Auto-filled address fields -->
                        <div class="row" id="autoFilledAddress">
                            <div class="col-md-6 mb-3">
                                <label for="purok_no" class="form-label">Purok No. *</label>
                                <input type="text" class="form-control" id="purok_no" name="purok_no" required readonly>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="household_no" class="form-label">House No. *</label>
                                <input type="text" class="form-control" id="household_no" name="household_no" required readonly>
                            </div>
                        </div>
                    </div>

                    <!-- 4Ps Information -->
                    <div class="form-section">
                        <div class="row">
                            <div class="col-md-12">
                                <h5 class="section-title">
                                    <i class="fas fa-id-card info-icon"></i>4Ps Information
                                </h5>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="fourps_id" class="form-label">4Ps ID *</label>
                                <input type="text" class="form-control" id="fourps_id" name="fourps_id" required
                                    >
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="status" class="form-label">Status *</label>
                                <select class="form-select" id="status" name="status" required>
                                    <option value="">Select Status</option>
                                    <option value="active">Active</option>
                                    <option value="inactive">Inactive</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary" id="saveButton">
                        <i class="fas fa-save me-2"></i>Save Beneficiary
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form id="editForm" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title">
                        <i class="fas fa-edit me-2"></i>Edit 4Ps Beneficiary
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id" id="edit_id">
                    <input type="hidden" name="resident_id" id="edit_resident_id">

                    <!-- Resident Information -->
                    <div class="row mb-4">
                        <div class="col-md-12">
                            <h5 class="section-title">
                                <i class="fas fa-user info-icon"></i>Resident Information
                            </h5>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="edit_fname" class="form-label">First Name *</label>
                            <input type="text" class="form-control" id="edit_fname" name="fname" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="edit_mname" class="form-label">Middle Name</label>
                            <input type="text" class="form-control" id="edit_mname" name="mname">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="edit_lname" class="form-label">Last Name *</label>
                            <input type="text" class="form-control" id="edit_lname" name="lname" required>
                        </div>
                    </div>

                    <!-- Address Information -->
                    <div class="row mb-4">
                        <div class="col-md-12">
                            <h5 class="section-title">
                                <i class="fas fa-home info-icon"></i>Address Information
                            </h5>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="edit_purok_no" class="form-label">Purok No. *</label>
                            <select class="form-select" id="edit_purok_no" name="purok_no" required>
                                <option value="">Select Purok</option>
                                <option value="Purok 1">Purok 1</option>
                                <option value="Purok 2">Purok 2</option>
                                <option value="Purok 3">Purok 3</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="edit_household_no" class="form-label">House No. *</label>
                            <input type="text" class="form-control" id="edit_household_no" name="household_no" required>
                        </div>
                    </div>

                    <!-- 4Ps Information -->
                    <div class="row">
                        <div class="col-md-12">
                            <h5 class="section-title">
                                <i class="fas fa-id-card info-icon"></i>4Ps Information
                            </h5>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="edit_fourps_id" class="form-label">4Ps ID *</label>
                            <input type="text" class="form-control" id="edit_fourps_id" name="fourps_id" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="edit_status" class="form-label">Status *</label>
                            <select class="form-select" id="edit_status" name="status" required>
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-2"></i>Update Beneficiary
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Floating Action Button (for mobile) -->
<button class="fab d-md-none" data-bs-toggle="modal" data-bs-target="#addModal">
    <i class="fas fa-plus"></i>
</button>

<script>
$(document).ready(function() {
    // ============================================
    // UPDATED: Search and Filter Functionality
    // ============================================

    let currentSearchTerm = '';
    let currentStatusFilter = 'all';
    let isSearching = false;
    let searchTimer = null;

    // Real-time search input handler
    $('#searchInput').on('input', function() {
        currentSearchTerm = $(this).val().toLowerCase().trim();

        // Show searching indicator
        if (currentSearchTerm.length > 0 && !isSearching) {
            isSearching = true;
            $('#searchInput').parent().addClass('searching');
        } else if (currentSearchTerm.length === 0) {
            isSearching = false;
            $('#searchInput').parent().removeClass('searching');
        }

        // Clear any previous timer
        if (searchTimer) {
            clearTimeout(searchTimer);
        }

        // Filter immediately for better UX
        filterTable();
        updateActiveFilters();

        // Hide indicator after filtering
        setTimeout(() => {
            isSearching = false;
            $('#searchInput').parent().removeClass('searching');
        }, 300);
    });

    // Status dropdown handler
    $('#statusFilter').on('change', function() {
        currentStatusFilter = $(this).val();
        filterTable();
        updateActiveFilters();
    });

    // Clear all filters
    $('#clearFilters').on('click', function() {
        // Clear search input
        $('#searchInput').val('');
        currentSearchTerm = '';

        // Reset status dropdown
        $('#statusFilter').val('all');
        currentStatusFilter = 'all';

        // Hide clear filters button
        $(this).hide();

        // Apply filters (show all)
        filterTable();
        updateActiveFilters();
    });

    // Main filtering function
    function filterTable() {
        const rows = $('#tableBody tr');
        let visibleCount = 0;

        rows.each(function() {
            const $row = $(this);
            const name = $row.data('name') || '';
            const purok = $row.data('purok') || '';
            const household = $row.data('household') || '';
            const fourpsId = $row.data('fourps-id') || '';
            const status = $row.data('status') || '';

            let matchesSearch = true;
            let matchesStatus = true;

            // Apply search filter in real-time
            if (currentSearchTerm) {
                // Search in multiple fields
                matchesSearch = name.includes(currentSearchTerm) ||
                               purok.includes(currentSearchTerm) ||
                               household.includes(currentSearchTerm) ||
                               fourpsId.includes(currentSearchTerm);
            }

            // Apply status filter
            if (currentStatusFilter !== 'all') {
                matchesStatus = status === currentStatusFilter;
            }

            // Show/hide row based on filters
            if (matchesSearch && matchesStatus) {
                $row.show();
                visibleCount++;

                // Highlight search term in row
                if (currentSearchTerm) {
                    highlightSearchTerm($row, currentSearchTerm);
                } else {
                    removeHighlights($row);
                }
            } else {
                $row.hide();
                removeHighlights($row);
            }
        });

        // Update counts
        $('#resultsCount').text(visibleCount + ' result' + (visibleCount !== 1 ? 's' : ''));
        $('#tableCount').text(visibleCount + ' Record' + (visibleCount !== 1 ? 's' : ''));

        // Show/hide empty state
        if (visibleCount === 0) {
            showNoResultsMessage();
        } else {
            hideNoResultsMessage();
        }

        // Show/hide clear filters button
        if (currentSearchTerm || currentStatusFilter !== 'all') {
            $('#clearFilters').show();
        } else {
            $('#clearFilters').hide();
        }
    }

    // Highlight search term in table rows
    function highlightSearchTerm($row, term) {
        // Remove previous highlights
        $row.find('.highlight').each(function() {
            $(this).replaceWith($(this).text());
        });

        // Highlight in name cells
        const nameCell = $row.find('td:first-child');
        const nameText = nameCell.text();
        const highlightedName = nameText.replace(new RegExp(`(${term})`, 'gi'), '<span class="highlight bg-warning text-dark rounded px-1">$1</span>');
        nameCell.html(highlightedName);

        // Highlight in 4Ps ID badge
        const idBadge = $row.find('td:nth-child(4) .badge');
        const idText = idBadge.text();
        const highlightedId = idText.replace(new RegExp(`(${term})`, 'gi'), '<span class="highlight bg-warning text-dark rounded px-1">$1</span>');
        idBadge.html(highlightedId);

        // Highlight in house number
        const houseCell = $row.find('td:nth-child(3)');
        const houseText = houseCell.text();
        const highlightedHouse = houseText.replace(new RegExp(`(${term})`, 'gi'), '<span class="highlight bg-warning text-dark rounded px-1">$1</span>');
        houseCell.html(highlightedHouse);
    }

    // Remove highlights from row
    function removeHighlights($row) {
        $row.find('.highlight').each(function() {
            $(this).replaceWith($(this).text());
        });
    }

    // Update active filters display
    function updateActiveFilters() {
        const $activeFilters = $('#activeFilters');
        $activeFilters.empty();

        if (currentSearchTerm) {
            $activeFilters.append(`
                <span class="badge bg-info filter-badge" data-type="search">
                    <i class="fas fa-search me-1"></i>Search: "${currentSearchTerm}"
                    <i class="fas fa-times ms-2" onclick="removeFilter('search')" style="cursor: pointer;"></i>
                </span>
            `);
        }

        if (currentStatusFilter !== 'all') {
            const statusText = currentStatusFilter === 'active' ? 'Active' : 'Inactive';
            const statusColor = currentStatusFilter === 'active' ? 'success' : 'warning';
            $activeFilters.append(`
                <span class="badge bg-${statusColor} filter-badge" data-type="status">
                    <i class="fas fa-filter me-1"></i>Status: ${statusText}
                    <i class="fas fa-times ms-2" onclick="removeFilter('status')" style="cursor: pointer;"></i>
                </span>
            `);
        }
    }

    // Remove specific filter
    window.removeFilter = function(type) {
        if (type === 'search') {
            $('#searchInput').val('');
            currentSearchTerm = '';
        } else if (type === 'status') {
            $('#statusFilter').val('all');
            currentStatusFilter = 'all';
        }

        filterTable();
        updateActiveFilters();
    }

    // Show no results message
    function showNoResultsMessage() {
        // Check if message already exists
        if ($('#noResultsMessage').length === 0) {
            $('#tableBody').after(`
                <tr id="noResultsMessage">
                    <td colspan="7" class="text-center py-5">
                        <i class="fas fa-search fa-3x mb-3" style="color: #94a3b8;"></i>
                        <h5 class="text-muted mb-2">No beneficiaries found</h5>
                        <p class="text-muted">Try adjusting your search or filter criteria</p>
                        <button class="btn btn-outline-primary mt-2" onclick="clearAllFilters()">
                            <i class="fas fa-times me-2"></i>Clear all filters
                        </button>
                    </td>
                </tr>
            `);
        }
    }

    // Hide no results message
    function hideNoResultsMessage() {
        $('#noResultsMessage').remove();
    }

    // Clear all filters function
    window.clearAllFilters = function() {
        $('#clearFilters').click();
    }

    // Initialize with "All" filter selected
    $('#statusFilter').val('all');

    // ============================================
    // EXISTING CODE (All your original functionality)
    // ============================================

    // Initialize autocomplete when modal is shown
    $('#addModal').on('shown.bs.modal', function () {
        // Initialize autocomplete for resident search
        $("#resident_name").autocomplete({
            source: function(request, response) {
                $.ajax({
                    url: "{{ route('4ps.search_residents') }}",
                    dataType: "json",
                    data: { query: request.term },
                    success: function(data) {
                        console.log("Search results:", data);
                        response($.map(data, function(item) {
                            return {
                                label: item.fname + " " + (item.mname ? item.mname + " " : "") + item.lname +
                                       " (Purok: " + (item.purok_no || 'N/A') + ", House No: " + (item.household_no || 'N/A') + ")",
                                value: item.fname + " " + item.lname,
                                data: item
                            };
                        }));
                    },
                    error: function(xhr, status, error) {
                        console.error("Autocomplete error:", error);
                        showNotification('error', 'Error searching residents');
                        response([]);
                    }
                });
            },
            minLength: 2,
            select: function(event, ui) {
                if (ui.item.data) {
                    const r = ui.item.data;

                    // Set hidden resident_id field
                    $('#resident_id').val(r.id);

                    // Reset manual entry flag
                    $('#is_manual_entry').val('0');

                    // Populate auto-filled fields with resident data
                    $('#fname').val(r.fname);
                    $('#mname').val(r.mname || '');
                    $('#lname').val(r.lname);
                    $('#purok_no').val(r.purok_no);
                    $('#household_no').val(r.household_no);

                    // Hide manual entry section if visible
                    $('#manualEntrySection').hide();
                    $('#searchSection').show();
                    $('#autoFilledFields').show();
                    $('#autoFilledAddress').show();

                    // Enable readonly fields
                    $('#fname, #mname, #lname, #purok_no, #household_no').prop('readonly', true);

                    showNotification('success', 'Resident found and fields auto-filled!');
                }
            },
            focus: function(event, ui) {
                // Just update the input field with the name
                $(this).val(ui.item.value);
                return false;
            }
        }).autocomplete("instance")._renderItem = function(ul, item) {
            return $("<li>")
                .append("<div>" + item.label + "</div>")
                .appendTo(ul);
        };

        // Reset form state when modal opens
        resetAddForm();
    });

    // Toggle between search and manual entry
    $('#toggleManualBtn').on('click', function() {
        $('#searchSection').hide();
        $('#manualEntrySection').show();
        $('#autoFilledFields').hide();
        $('#autoFilledAddress').hide();

        // Set manual entry flag
        $('#is_manual_entry').val('1');

        // Clear any auto-filled values
        $('#fname, #mname, #lname, #purok_no, #household_no').val('');
        $('#resident_id').val('');

        // Make fields editable for manual entry
        $('#fname, #mname, #lname, #purok_no, #household_no').prop('readonly', false);

        showNotification('info', 'Manual entry mode enabled. Please fill in the details below.');
    });

    // Back to search button
    $('#backToSearchBtn').on('click', function() {
        $('#manualEntrySection').hide();
        $('#searchSection').show();
        $('#autoFilledFields').show();
        $('#autoFilledAddress').show();

        // Reset manual entry flag
        $('#is_manual_entry').val('0');

        // Clear manual entry fields
        $('#manual_fname, #manual_mname, #manual_lname, #manual_purok_no, #manual_household_no').val('');

        // Clear auto-filled fields
        $('#fname, #mname, #lname, #purok_no, #household_no').val('');
        $('#resident_id').val('');
    });

    // Handle form submission for ADD modal
    $('#addForm').on('submit', function(e) {
        e.preventDefault();

        const form = $(this);
        const submitBtn = form.find('button[type="submit"]');
        const originalBtnText = submitBtn.html();
        const isManualEntry = $('#is_manual_entry').val() === '1';

        // Validate form based on entry mode
        if (!validateAddForm(isManualEntry)) {
            return;
        }

        // Prepare form data
        let formData = new FormData(form[0]);

        // If manual entry, use manual field values
        if (isManualEntry) {
            formData.set('fname', $('#manual_fname').val());
            formData.set('mname', $('#manual_mname').val());
            formData.set('lname', $('#manual_lname').val());
            formData.set('purok_no', $('#manual_purok_no').val());
            formData.set('household_no', $('#manual_household_no').val());
            formData.set('resident_id', ''); // Clear resident_id for manual entry
        }

        // Show loading state
        submitBtn.prop('disabled', true);
        submitBtn.html('<i class="fas fa-spinner fa-spin me-2"></i>Saving...');

        $.ajax({
            url: form.attr('action'),
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                showNotification('success', response.success || 'Beneficiary added successfully!');
                $('#addModal').modal('hide');
                resetAddForm();

                // Reload the page to show updated data
                setTimeout(() => {
                    window.location.reload();
                }, 1500);
            },
            error: function(xhr) {
                submitBtn.prop('disabled', false);
                submitBtn.html(originalBtnText);

                if (xhr.status === 422) {
                    // Handle validation errors
                    const errors = xhr.responseJSON.errors;
                    let errorMessage = '';

                    // Clear previous errors
                    form.find('.is-invalid').removeClass('is-invalid');
                    form.find('.invalid-feedback').remove();

                    // Display new errors
                    $.each(errors, function(key, value) {
                        const input = form.find(`[name="${key}"]`);
                        if (input.length) {
                            input.addClass('is-invalid');
                            input.after(`<div class="invalid-feedback">${value[0]}</div>`);
                        }
                        errorMessage += value[0] + '<br>';
                    });

                    showNotification('error', errorMessage);
                } else {
                    showNotification('error', 'An error occurred while saving the beneficiary.');
                }
            }
        });
    });

    // Validate add form
    function validateAddForm(isManualEntry) {
        let isValid = true;

        // Clear previous errors
        $('#addForm .is-invalid').removeClass('is-invalid');
        $('#addForm .invalid-feedback').remove();

        if (isManualEntry) {
            // Validate manual entry fields
            const requiredFields = [
                { id: 'manual_fname', name: 'First Name' },
                { id: 'manual_lname', name: 'Last Name' },
                { id: 'manual_purok_no', name: 'Purok No.' },
                { id: 'manual_household_no', name: 'House No.' }
            ];

            requiredFields.forEach(field => {
                const input = $(`#${field.id}`);
                if (!input.val().trim()) {
                    input.addClass('is-invalid');
                    input.after(`<div class="invalid-feedback">${field.name} is required</div>`);
                    isValid = false;
                }
            });
        } else {
            // Validate auto-filled fields (from search)
            const requiredFields = [
                { id: 'fname', name: 'First Name' },
                { id: 'lname', name: 'Last Name' },
                { id: 'purok_no', name: 'Purok No.' },
                { id: 'household_no', name: 'House No.' }
            ];

            requiredFields.forEach(field => {
                const input = $(`#${field.id}`);
                if (!input.val().trim()) {
                    showNotification('error', 'Please search and select a resident or use manual entry.');
                    isValid = false;
                }
            });
        }

        // Validate 4Ps ID
        if (!$('#fourps_id').val().trim()) {
            $('#fourps_id').addClass('is-invalid');
            $('#fourps_id').after('<div class="invalid-feedback">4Ps ID is required</div>');
            isValid = false;
        }

        // Validate status
        if (!$('#status').val()) {
            $('#status').addClass('is-invalid');
            $('#status').after('<div class="invalid-feedback">Status is required</div>');
            isValid = false;
        }

        return isValid;
    }

    // Reset add form
    function resetAddForm() {
        $('#addForm')[0].reset();
        $('#resident_name').val('');
        $('#resident_id').val('');
        $('#is_manual_entry').val('0');

        // Clear manual fields
        $('#manual_fname, #manual_mname, #manual_lname, #manual_purok_no, #manual_household_no').val('');

        // Show search section, hide manual
        $('#searchSection').show();
        $('#manualEntrySection').hide();
        $('#autoFilledFields').show();
        $('#autoFilledAddress').show();

        // Make fields editable initially
        $('#fname, #mname, #lname, #purok_no, #household_no').prop('readonly', false);

        // Clear validation errors
        $('#addForm .is-invalid').removeClass('is-invalid');
        $('#addForm .invalid-feedback').remove();
    }

    // Handle Edit Button Click
    $(document).on('click', '.edit-btn', function() {
        const id = $(this).data('id');
        const fname = $(this).data('fname');
        const mname = $(this).data('mname');
        const lname = $(this).data('lname');
        const purok_no = $(this).data('purok_no');
        const household_no = $(this).data('household_no');
        const fourps_id = $(this).data('fourps_id');
        const status = $(this).data('status');
        const resident_id = $(this).data('resident_id');

        // Debug log to see what status is being passed
        console.log('Edit clicked - Status:', status, 'ID:', id);

        // Populate form fields with 4Ps beneficiary data
        $('#edit_id').val(id);
        $('#edit_fname').val(fname);
        $('#edit_mname').val(mname || '');
        $('#edit_lname').val(lname);
        $('#edit_purok_no').val(purok_no);
        $('#edit_household_no').val(household_no);
        $('#edit_fourps_id').val(fourps_id);
        $('#edit_resident_id').val(resident_id || '');

        // CRITICAL FIX: Set the status value - ensure it matches exactly
        $('#edit_status').val(status);

        // Debug: Check what value is being set
        console.log('Setting status to:', status);
        console.log('Current select value:', $('#edit_status').val());

        // Set form action with correct route
        $('#editForm').attr('action', "{{ route('4ps.residentlist.update', '') }}/" + id);

        // Reset any validation errors
        $('#editForm .is-invalid').removeClass('is-invalid');
        $('#editForm .invalid-feedback').remove();

        // Force refresh of select2 if you're using it
        if ($.fn.select2) {
            $('#edit_status').trigger('change');
        }
    });

    // Handle edit form submission
    $('#editForm').on('submit', function(e) {
        e.preventDefault();

        const form = $(this);
        const submitBtn = form.find('button[type="submit"]');
        const originalBtnText = submitBtn.html();
        const formData = new FormData(form[0]);

        // Debug form data
        console.log('Edit form data to be sent:');
        for (let [key, value] of formData.entries()) {
            console.log(`${key}: ${value}`);
        }

        // Validate required fields
        let isValid = true;
        form.find('.form-control:required, .form-select:required').each(function() {
            if (!$(this).val().trim()) {
                $(this).addClass('is-invalid');
                if (!$(this).next('.invalid-feedback').length) {
                    $(this).after('<div class="invalid-feedback">This field is required</div>');
                }
                isValid = false;
            }
        });

        if (!isValid) {
            showNotification('error', 'Please fill in all required fields.');
            return;
        }

        // Show loading state
        submitBtn.prop('disabled', true);
        submitBtn.html('<i class="fas fa-spinner fa-spin me-2"></i>Updating...');

        // Add _method field for Laravel
        formData.append('_method', 'PUT');

        $.ajax({
            url: form.attr('action'),
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                showNotification('success', response.success || 'Beneficiary updated successfully!');
                $('#editModal').modal('hide');

                // Reload the page to show updated data
                setTimeout(() => {
                    window.location.reload();
                }, 1000);
            },
            error: function(xhr) {
                submitBtn.prop('disabled', false);
                submitBtn.html(originalBtnText);

                if (xhr.status === 422) {
                    // Handle validation errors
                    const errors = xhr.responseJSON.errors;
                    let errorMessage = '';

                    // Clear previous errors
                    form.find('.is-invalid').removeClass('is-invalid');
                    form.find('.invalid-feedback').remove();

                    // Display new errors
                    $.each(errors, function(key, value) {
                        const input = form.find(`[name="${key}"]`);
                        input.addClass('is-invalid');
                        input.after(`<div class="invalid-feedback">${value[0]}</div>`);
                        errorMessage += value[0] + '<br>';
                    });

                    showNotification('error', errorMessage);
                } else {
                    showNotification('error', 'An error occurred while updating the beneficiary.');
                    console.error('Edit error:', xhr.responseText);
                }
            }
        });
    });

    // Clear autocomplete when modal is closed
    $('#addModal').on('hidden.bs.modal', function () {
        $("#resident_name").autocomplete("destroy");
        resetAddForm();
    });

    // Notification function
    function showNotification(type, message) {
        // Remove existing notifications
        $('.alert-notification').remove();

        const alertClass = type === 'success' ? 'alert-success' :
                          type === 'error' ? 'alert-danger' :
                          type === 'info' ? 'alert-info' : 'alert-warning';

        const icon = type === 'success' ? 'fa-check-circle' :
                    type === 'error' ? 'fa-exclamation-circle' :
                    type === 'info' ? 'fa-info-circle' : 'fa-exclamation-triangle';

        const notification = $(`
            <div class="alert ${alertClass} alert-notification alert-dismissible fade show position-fixed"
                 style="top: 20px; right: 20px; z-index: 9999; min-width: 300px; max-width: 400px;">
                <div class="d-flex align-items-center">
                    <i class="fas ${icon} me-2"></i>
                    <div>${message}</div>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        `);

        $('body').append(notification);

        // Auto remove after 5 seconds
        setTimeout(() => {
            notification.alert('close');
        }, 5000);
    }

    // Reset edit form when modal closes
    $('#editModal').on('hidden.bs.modal', function() {
        $(this).find('form')[0].reset();
        $('#editForm .is-invalid').removeClass('is-invalid');
        $('#editForm .invalid-feedback').remove();
    });

    // Confirm before deleting
    $(document).on('submit', 'form[action*="destroy"]', function(e) {
        e.preventDefault();
        const form = $(this);

        if (confirm('Are you sure you want to delete this beneficiary? This action cannot be undone.')) {
            form.unbind('submit').submit();
        }
    });

    // Initialize tooltips
    $('[title]').tooltip({
        trigger: 'hover',
        placement: 'top'
    });
});
</script>
@endsection
