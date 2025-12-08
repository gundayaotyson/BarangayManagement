@extends('admin.dashboard')

@section('content')
<style>
    :root {
        --primary-color: #2c3e50;
        --secondary-color: #303f9f;
        --accent-color: #5c6bc0;
        --success-color: #4caf50;
        --warning-color: #ff9800;
        --danger-color: #f44336;
        --info-color: #2196f3;
        --light-color: #f5f7ff;
        --dark-color: #1a237e;
        --card-bg: #ffffff;
        --border-radius: 16px;
        --box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
        --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    /* Page Header */
    .dashboard-header {
        background: linear-gradient(135deg, var(--primary-color) 0%, #283593 100%);
        color: white;
        padding: 2.5rem;
        border-radius: var(--border-radius);
        margin-bottom: 2rem;
        box-shadow: var(--box-shadow);
        position: relative;
        overflow: hidden;
    }

    .dashboard-header::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(255, 255, 255, 0.05);
    }

    .header-content {
        position: relative;
        z-index: 1;
        max-width: 800px;
    }

    .welcome-title {
        font-size: 2.75rem;
        font-weight: 700;
        margin-bottom: 1rem;
        line-height: 1.2;
    }

    .welcome-subtitle {
        font-size: 1.2rem;
        opacity: 0.9;
        margin-bottom: 1.5rem;
        line-height: 1.6;
    }

    .header-stats {
        display: flex;
        gap: 2rem;
        margin-top: 2rem;
        flex-wrap: wrap;
    }

    .header-stat {
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .header-stat-icon {
        width: 48px;
        height: 48px;
        border-radius: 12px;
        background: rgba(255, 255, 255, 0.2);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
    }

    .header-stat-info h4 {
        font-size: 1.75rem;
        font-weight: 700;
        margin: 0;
        line-height: 1;
    }

    .header-stat-info p {
        margin: 0.25rem 0 0 0;
        font-size: 0.9rem;
        opacity: 0.8;
    }

    /* Statistics Cards */
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 1.5rem;
        margin-bottom: 2.5rem;
    }

    .stat-card {
        background: var(--card-bg);
        border-radius: var(--border-radius);
        padding: 2rem;
        box-shadow: var(--box-shadow);
        transition: var(--transition);
        position: relative;
        overflow: hidden;
        border-top: 4px solid var(--accent-color);
    }

    .stat-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.12);
    }

    .stat-card.total-babies {
        border-top-color: var(--info-color);
    }

    .stat-card.boys {
        border-top-color: var(--info-color);
        background: linear-gradient(135deg, #e3f2fd 0%, #bbdefb 100%);
    }

    .stat-card.girls {
        border-top-color: #e91e63;
        background: linear-gradient(135deg, #fce4ec 0%, #f8bbd9 100%);
    }

    .stat-card.gender-ratio {
        border-top-color: var(--success-color);
        background: linear-gradient(135deg, #e8f5e9 0%, #c8e6c9 100%);
    }

    .stat-card-icon {
        position: absolute;
        top: 2rem;
        right: 2rem;
        font-size: 3rem;
        opacity: 0.2;
        color: var(--dark-color);
    }

    .stat-card-content h3 {
        font-size: 2.5rem;
        font-weight: 800;
        margin: 0 0 0.5rem 0;
        color: var(--dark-color);
        line-height: 1;
    }

    .stat-card-content h3 span {
        font-size: 1.5rem;
        opacity: 0.7;
    }

    .stat-card-content p {
        font-size: 1rem;
        color: #666;
        margin: 0 0 1rem 0;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .stat-card-trend {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 0.9rem;
        padding: 0.5rem 1rem;
        background: rgba(0, 0, 0, 0.05);
        border-radius: 20px;
        width: fit-content;
    }

    .stat-card-trend.positive {
        color: var(--success-color);
        background: rgba(76, 175, 80, 0.1);
    }

    .stat-card-trend.negative {
        color: var(--danger-color);
        background: rgba(244, 67, 54, 0.1);
    }

    /* Main Content Card */
    .content-card {
        background: var(--card-bg);
        border-radius: var(--border-radius);
        box-shadow: var(--box-shadow);
        margin-bottom: 2.5rem;
        overflow: hidden;
    }

    .card-header {
        background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
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
        background: rgba(255, 255, 255, 0.2);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 1.5rem;
    }

    .card-title-text h2 {
        font-size: 1.75rem;
        font-weight: 700;
        color: var(--card-bg);
        margin: 0;
    }

    .card-title-text p {
        font-size: 0.95rem;
        color: rgba(255, 255, 255, 0.9);
        margin: 0.25rem 0 0 0;
    }
     .filters {
            margin-top: 12px;
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

    /* Search and Filter Container */
    .search-filter-container {
        display: flex;
        gap: 1rem;
        align-items: center;
        flex-wrap: wrap;
        padding: 0 2rem;
        background: #f8f9fa;
        border-bottom: 1px solid #e9ecef;
    }

    .search-wrapper {
        position: relative;
        flex: 1;
        min-width: 300px;
        max-width: 400px;
    }

    .search-input {
        width: 100%;
        padding:  0.5rem 1rem 0.5rem 0.5rem;
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

    .clear-search-btn {
        position: absolute;
        right: 1rem;
        top: 50%;
        transform: translateY(-50%);
        background: none;
        border: none;
        color: #94a3b8;
        cursor: pointer;
        display: none;
        font-size: 1rem;
        transition: var(--transition);
    }

    .clear-search-btn:hover {
        color: var(--danger-color);
    }

    .filter-select {
        padding: 0.5rem 1rem;
        border: 2px solid #e0e6ed;
        border-radius: 12px;
        background: white;
        font-size: 1rem;
        min-width: 180px;
        cursor: pointer;
        transition: var(--transition);
    }

    .filter-select:focus {
        outline: none;
        border-color: var(--secondary-color);
        box-shadow: 0 4px 15px rgba(52, 152, 219, 0.2);
    }

    .card-actions {
        display: flex;
        gap: 1rem;
        align-items: center;
    }

    .btn {
        padding: 0.75rem 1.5rem;
        border-radius: 10px;
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
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(52, 152, 219, 0.4);
    }

    .btn-outline {
        background: transparent;
        border: 2px solid white;
        color: white;
    }

    .btn-outline:hover {
        background: white;
        color: var(--primary-color);
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(255, 255, 255, 0.3);
    }

    /* Table Styles */
    .table-container {
        overflow-x: auto;
        padding: 0 2rem 2rem 2rem;
    }

    .table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
        min-width: 800px;
    }

    .table thead {
        background: linear-gradient(135deg, var(--light-color) 0%, #e9ecef 100%);
    }



    .table th {
        background-color: #2c3e50;
        padding: 1.25rem 1rem;
        text-align: left;
        font-weight: 600;
        color: var(--dark-color);
        font-size: 0.9rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        border-bottom: 2px solid var(--light-color);
        white-space: nowrap;
        color: white;
    }

    .table tbody tr {
        transition: var(--transition);
        border-radius: 8px;
    }

    .table tbody tr:hover {
        background: #f8f9ff;
        transform: translateX(4px);
    }

    .table td {
        padding: 1.25rem 1rem;
        vertical-align: middle;
        border-bottom: 1px solid #f0f0f0;
    }

    .child-info {
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .child-avatar {
        width: 45px;
        height: 45px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.25rem;
        font-weight: 600;
        color: white;
        flex-shrink: 0;
    }

    .child-avatar.boy {
        background: linear-gradient(135deg, #2196f3 0%, #1976d2 100%);
    }

    .child-avatar.girl {
        background: linear-gradient(135deg, #e91e63 0%, #c2185b 100%);
    }

    .child-details h4 {
        margin: 0;
        font-weight: 600;
        color: var(--dark-color);
        font-size: 1.05rem;
    }

    .child-details p {
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
        background: rgba(33, 150, 243, 0.1);
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--info-color);
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

    .gender-badge {
        padding: 0.5rem 1.25rem;
        border-radius: 20px;
        font-size: 0.85rem;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        min-width: 100px;
        justify-content: center;
    }

    .gender-badge.boy {
        background: rgba(33, 150, 243, 0.1);
        color: #1976d2;
        border: 1px solid rgba(33, 150, 243, 0.2);
    }

    .gender-badge.girl {
        background: rgba(233, 30, 99, 0.1);
        color: #c2185b;
        border: 1px solid rgba(233, 30, 99, 0.2);
    }

    .measurement {
        margin-right: 150px;
        text-align: center;
    }

    .measurement-value {
        font-size: 1.5rem;
        font-weight: 700;
        color: var(--dark-color);
        line-height: 1;
    }

    .measurement-unit {
        font-size: 0.85rem;
        color: #666;
        margin-top: 0.25rem;
    }

    .empty-state {
        text-align: center;
        padding: 4rem 2rem;
        color: #666;
    }

    .empty-state-icon {
        font-size: 5rem;
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

    .search-results-info {
        padding: 1rem 2rem;
        background: #f8f9fa;
        border-bottom: 1px solid #e9ecef;
        color: #666;
        font-size: 0.95rem;
    }

    .search-results-info strong {
        color: var(--primary-color);
    }

    /* Quick Actions */
    .quick-actions {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 1.5rem;
        margin-top: 2rem;
    }

    .action-card {
        background: var(--card-bg);
        border-radius: var(--border-radius);
        padding: 1.5rem;
        text-align: center;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        transition: var(--transition);
        border: 2px solid transparent;
        cursor: pointer;
    }

    .action-card:hover {
        transform: translateY(-5px);
        border-color: var(--accent-color);
        box-shadow: var(--box-shadow);
    }

    .action-icon {
        width: 60px;
        height: 60px;
        border-radius: 15px;
        margin: 0 auto 1rem auto;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.75rem;
        color: white;
    }

    .action-card:nth-child(1) .action-icon {
        background: linear-gradient(135deg, #4caf50 0%, #388e3c 100%);
    }

    .action-card:nth-child(2) .action-icon {
        background: linear-gradient(135deg, #2196f3 0%, #1976d2 100%);
    }

    .action-card:nth-child(3) .action-icon {
        background: linear-gradient(135deg, #ff9800 0%, #f57c00 100%);
    }

    .action-card:nth-child(4) .action-icon {
        background: linear-gradient(135deg, #9c27b0 0%, #7b1fa2 100%);
    }

    .action-card h4 {
        margin: 0 0 0.5rem 0;
        font-size: 1.1rem;
        color: var(--dark-color);
    }

    .action-card p {
        margin: 0;
        font-size: 0.9rem;
        color: #666;
        line-height: 1.4;
    }

    /* Responsive Design */
    @media (max-width: 1200px) {
        .welcome-title {
            font-size: 2.25rem;
        }

        .stats-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 992px) {
        .dashboard-header {
            padding: 2rem 1.5rem;
        }

        .welcome-title {
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

        .search-filter-container {
            flex-direction: column;
            align-items: stretch;
        }

        .search-wrapper {
            max-width: 100%;
        }

        .filter-select {
            width: 100%;
        }

        .header-stats {
            flex-direction: column;
            gap: 1rem;
        }

        .table-container {
            padding: 0 1rem 1rem 1rem;
        }

        .table th,
        .table td {
            padding: 1rem 0.75rem;
        }
    }

    @media (max-width: 768px) {
        .stats-grid {
            grid-template-columns: 1fr;
        }

        .welcome-title {
            font-size: 1.75rem;
        }

        .card-title {
            flex-direction: column;
            align-items: flex-start;
            gap: 0.75rem;
        }

        .search-results-info {
            padding: 1rem;
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
    }

    @media (max-width: 576px) {
        .quick-actions {
            grid-template-columns: 1fr;
        }

        .table {
            font-size: 0.9rem;
        }
    }

    /* Animations */
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .fade-in-up {
        animation: fadeInUp 0.6s ease-out;
    }

    @keyframes pulse {
        0% {
            transform: scale(1);
        }
        50% {
            transform: scale(1.05);
        }
        100% {
            transform: scale(1);
        }
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
        background: #f1f1f1;
        border-radius: 4px;
    }

    ::-webkit-scrollbar-thumb {
        background: var(--accent-color);
        border-radius: 4px;
    }

    ::-webkit-scrollbar-thumb:hover {
        background: var(--secondary-color);
    }
</style>

<div class="container-fluid">
    <!-- Dashboard Header -->
    <div class="dashboard-header fade-in-up">
        <div class="header-content">
            <h1 class="welcome-title">
                <i class="fas fa-user-nurse me-3"></i>Welcome to BHW Dashboard
            </h1>
            <p class="welcome-subtitle">
                Barangay Health Worker Management System - Monitor maternal and child health records,
                track new deliveries, and manage community health programs efficiently.
            </p>
        </div>
    </div>

    <!-- Statistics Overview -->
    <div class="stats-grid">
        <div class="stat-card total-babies fade-in-up" style="animation-delay: 0.1s;">
            <i class="fas fa-baby-carriage stat-card-icon"></i>
            <div class="stat-card-content">
                <h3>{{ number_format($totalBabies) }}</h3>
                <p>Total Deliveries</p>
                <div class="stat-card-trend positive">
                    <i class="fas fa-chart-line"></i>
                    <span>Monthly Average: {{ number_format($totalBabies/12, 1) }}</span>
                </div>
            </div>
        </div>

        <div class="stat-card boys fade-in-up" style="animation-delay: 0.2s;">
            <i class="fas fa-mars stat-card-icon"></i>
            <div class="stat-card-content">
                <h3>{{ number_format($totalBoys) }} <span>/ {{ $totalBabies > 0 ? number_format(($totalBoys/$totalBabies)*100, 1) : 0 }}%</span></h3>
                <p>Male Babies</p>
                <div class="stat-card-trend">
                    <i class="fas fa-balance-scale"></i>
                    <span>{{ $totalGirls > 0 ? number_format($totalBoys/$totalGirls, 2) : 0 }}:1 Ratio</span>
                </div>
            </div>
        </div>

        <div class="stat-card girls fade-in-up" style="animation-delay: 0.3s;">
            <i class="fas fa-venus stat-card-icon"></i>
            <div class="stat-card-content">
                <h3>{{ number_format($totalGirls) }} <span>/ {{ $totalBabies > 0 ? number_format(($totalGirls/$totalBabies)*100, 1) : 0 }}%</span></h3>
                <p>Female Babies</p>
                <div class="stat-card-trend positive">
                    <i class="fas fa-heart"></i>
                    <span>Healthy Growth Trend</span>
                </div>
            </div>
        </div>

        <div class="stat-card gender-ratio fade-in-up" style="animation-delay: 0.4s;">
            <i class="fas fa-chart-pie stat-card-icon"></i>
            <div class="stat-card-content">
                <h3>
                    @if($totalBabies > 0)
                        {{ number_format($totalBoys/$totalBabies*100, 1) }}:{{ number_format($totalGirls/$totalBabies*100, 1) }}
                    @else
                        0:0
                    @endif
                </h3>
                <p>Gender Ratio (M:F)</p>
                <div class="stat-card-trend">
                    <i class="fas fa-percentage"></i>
                    <span>Overall Distribution</span>
                </div>
            </div>
        </div>
    </div>

    <!-- New Deliveries Table -->
    <div class="content-card fade-in-up" style="animation-delay: 0.5s;">
        <div class="card-header">
            <div class="card-title">
                <div class="card-title-icon">
                    <i class="fas fa-clipboard-list"></i>
                </div>
                <div class="card-title-text">
                    <h2>New Deliveries Registry</h2>
                    <p>Recently recorded births in the barangay</p>
                </div>
            </div>

            <div class="card-actions">
                <!-- <button class="btn btn-outline">
                    <i class="fas fa-download"></i> Export Records
                </button> -->
                <button class="btn btn-outline" id="refreshBtn">
                    <i class="fas fa-sync-alt"></i> Refresh
                </button>
            </div>
        </div>

        <!-- Search and Filter Section -->
        <div class="search-filter-container">




        </div>

        <!-- Search Results Info -->
        <div class="search-results-info" id="searchResultsInfo" style="display: none;">
            Showing <strong id="resultCount">0</strong> of <strong>{{ $newdeliveries->count() }}</strong> records
            <span id="searchTermDisplay"></span>
        </div>

        <div class="table-container">
           <div class="filters">
                <div  class="filter-group">
                     <span class="filter-label">Status:</span>
                    <select class="filter-select" id="genderFilter">
                        <option value="all">All Genders</option>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                    </select>
                </div>
                <div class="filter-group">
                     <span class="filter-label">Short by:</span>
                    <select class="filter-select" id="sortBy">
                        <option value="name_asc">Sort by Name (A-Z)</option>
                        <option value="name_desc">Sort by Name (Z-A)</option>
                        <option value="date_asc">Sort by Date (Oldest)</option>
                        <option value="date_desc">Sort by Date (Newest)</option>
                    </select>
                </div>
                <div class="filter-group">
                    <div class="search-wrapper">
                        <!-- <i class="fas fa-search search-icon"></i> -->
                        <input type="text" id="searchInput" class="form-control search-input"
                            placeholder="Search child by name ">
                        <button type="button" class="clear-search-btn" id="clearSearchBtn">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>


           </div>
            @if($newdeliveries->count() > 0)
            <table class="table" id="deliveriesTable">
                <thead>
                    <tr>
                        <th style="width: 25%;">Child's Information</th>
                        <th style="width: 20%;">Birth Details</th>
                        <th style="width: 15%;">Gender</th>
                        <th style="width: 20%;">Weight</th>
                        <th style="width: 20%;">Height</th>
                    </tr>
                </thead>
                <tbody id="deliveriesTableBody">
                    @foreach ($newdeliveries as $delivery)
                    <tr class="fade-in-up delivery-row"
                        style="animation-delay: {{ $loop->index * 0.05 }}s;"
                        data-fullname="{{ strtolower($delivery->c_fname . ' ' . $delivery->c_mname . ' ' . $delivery->c_lname) }}"
                        data-firstname="{{ strtolower($delivery->c_fname) }}"
                        data-middlename="{{ strtolower($delivery->c_mname) }}"
                        data-lastname="{{ strtolower($delivery->c_lname) }}"
                        data-gender="{{ strtolower($delivery->gender) }}"
                        data-birthdate="{{ $delivery->c_birthday }}"
                        data-weight="{{ $delivery->weight }}"
                        data-height="{{ $delivery->height }}">
                        <td>
                            <div class="child-info">
                                <div class="child-avatar {{ strtolower($delivery->gender) == 'male' ? 'boy' : 'girl' }}">
                                    {{ substr($delivery->c_fname, 0, 1) }}{{ substr($delivery->c_lname, 0, 1) }}
                                </div>
                                <div class="child-details">
                                    <h4>{{ $delivery->c_fname }} {{ $delivery->c_mname }} {{ $delivery->c_lname }}</h4>
                                    <p>
                                        <i class="fas fa-id-badge"></i> ID: {{ $loop->iteration + 1000 }}
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
                                        {{ \Carbon\Carbon::parse($delivery->c_birthday)->format('M d, Y') }}
                                    </div>
                                    <div class="age">
                                        {{ \Carbon\Carbon::parse($delivery->c_birthday)->age }} years old
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <span class="gender-badge {{ strtolower($delivery->gender) == 'male' ? 'boy' : 'girl' }}">
                                <i class="fas fa-{{ strtolower($delivery->gender) == 'male' ? 'mars' : 'venus' }}"></i>
                                {{ $delivery->gender }}
                            </span>
                        </td>
                        <td>
                            <div class="measurement">
                                <div class="measurement-value">{{ $delivery->weight }}</div>
                                <div class="measurement-unit">kg</div>
                            </div>
                        </td>
                        <td>
                            <div class="measurement">
                                <div class="measurement-value">{{ $delivery->height }}</div>
                                <div class="measurement-unit">cm</div>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @else
            <div class="empty-state">
                <div class="empty-state-icon">
                    <i class="fas fa-baby"></i>
                </div>
                <h3>No New Deliveries Recorded</h3>
                <p>There are no new delivery records in the system yet.</p>
            </div>
            @endif
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Search functionality
    const searchInput = document.getElementById('searchInput');
    const clearSearchBtn = document.getElementById('clearSearchBtn');
    const genderFilter = document.getElementById('genderFilter');
    const sortBy = document.getElementById('sortBy');
    const searchResultsInfo = document.getElementById('searchResultsInfo');
    const resultCount = document.getElementById('resultCount');
    const searchTermDisplay = document.getElementById('searchTermDisplay');
    const deliveriesTableBody = document.getElementById('deliveriesTableBody');
    const deliveryRows = document.querySelectorAll('.delivery-row');
    const refreshBtn = document.getElementById('refreshBtn');

    // Show/hide clear button based on search input
    searchInput.addEventListener('input', function() {
        clearSearchBtn.style.display = this.value ? 'block' : 'none';
        performSearch();
    });

    // Clear search button
    clearSearchBtn.addEventListener('click', function() {
        searchInput.value = '';
        this.style.display = 'none';
        performSearch();
        searchInput.focus();
    });

    // Filter by gender
    genderFilter.addEventListener('change', performSearch);

    // Sort by
    sortBy.addEventListener('change', performSearch);

    // Refresh button
    if (refreshBtn) {
        refreshBtn.addEventListener('click', function() {
            const icon = this.querySelector('i');
            icon.classList.add('fa-spin');

            // Simulate refresh
            setTimeout(() => {
                icon.classList.remove('fa-spin');
                // In real implementation, you would reload data or make an AJAX call
                location.reload();
            }, 1000);
        });
    }

    // Search function
    function performSearch() {
        const searchTerm = searchInput.value.toLowerCase().trim();
        const genderValue = genderFilter.value;
        const sortValue = sortBy.value;

        let visibleRows = 0;

        // Show all rows first
        deliveryRows.forEach(row => {
            row.style.display = 'table-row';
        });

        // Filter by search term if provided
        if (searchTerm) {
            deliveryRows.forEach(row => {
                const fullName = row.dataset.fullname || '';
                const firstName = row.dataset.firstname || '';
                const middleName = row.dataset.middlename || '';
                const lastName = row.dataset.lastname || '';

                // Check if search term matches any part of the name
                const matchesSearch = fullName.includes(searchTerm) ||
                                     firstName.includes(searchTerm) ||
                                     middleName.includes(searchTerm) ||
                                     lastName.includes(searchTerm);

                if (!matchesSearch) {
                    row.style.display = 'none';
                }
            });
        }

        // Filter by gender
        if (genderValue !== 'all') {
            deliveryRows.forEach(row => {
                if (row.style.display !== 'none') {
                    const rowGender = row.dataset.gender || '';
                    if (rowGender !== genderValue) {
                        row.style.display = 'none';
                    }
                }
            });
        }

        // Count visible rows
        deliveryRows.forEach(row => {
            if (row.style.display !== 'none') {
                visibleRows++;
            }
        });

        // Update search results info
        if (searchTerm || genderValue !== 'all') {
            searchResultsInfo.style.display = 'block';
            resultCount.textContent = visibleRows;

            let filterText = '';
            if (searchTerm) {
                filterText += ` for "<strong>${searchTerm}</strong>"`;
            }
            if (genderValue !== 'all') {
                filterText += (searchTerm ? ' and ' : ' for ') +
                             `<strong>${genderValue.charAt(0).toUpperCase() + genderValue.slice(1)}</strong> gender`;
            }

            searchTermDisplay.innerHTML = filterText;
        } else {
            searchResultsInfo.style.display = 'none';
        }

        // Sort rows
        sortTable(sortValue);

        // Show no results message if no rows visible
        if (visibleRows === 0) {
            showNoResultsMessage(searchTerm, genderValue);
        } else {
            hideNoResultsMessage();
        }
    }

    // Sort table function
    function sortTable(sortValue) {
        const rowsArray = Array.from(deliveryRows).filter(row => row.style.display !== 'none');

        rowsArray.sort((a, b) => {
            switch(sortValue) {
                case 'name_asc':
                    const nameA = (a.dataset.lastname || '') + (a.dataset.firstname || '');
                    const nameB = (b.dataset.lastname || '') + (b.dataset.firstname || '');
                    return nameA.localeCompare(nameB);

                case 'name_desc':
                    const nameC = (a.dataset.lastname || '') + (a.dataset.firstname || '');
                    const nameD = (b.dataset.lastname || '') + (b.dataset.firstname || '');
                    return nameD.localeCompare(nameC);

                case 'date_asc':
                    return new Date(a.dataset.birthdate) - new Date(b.dataset.birthdate);

                case 'date_desc':
                    return new Date(b.dataset.birthdate) - new Date(a.dataset.birthdate);

                default:
                    return 0;
            }
        });

        // Reorder rows in the table
        rowsArray.forEach(row => {
            deliveriesTableBody.appendChild(row);
        });
    }

    // Show no results message
    function showNoResultsMessage(searchTerm, genderValue) {
        let noResultsRow = document.getElementById('noResultsRow');

        if (!noResultsRow) {
            noResultsRow = document.createElement('tr');
            noResultsRow.id = 'noResultsRow';
            noResultsRow.innerHTML = `
                <td colspan="5">
                    <div class="empty-state" style="padding: 2rem;">
                        <div class="empty-state-icon">
                            <i class="fas fa-search"></i>
                        </div>
                        <h3>No Matching Records Found</h3>
                        <p>No children found${searchTerm ? ` matching "${searchTerm}"` : ''}${genderValue !== 'all' ? ` with ${genderValue} gender` : ''}. Try adjusting your search criteria.</p>
                        <button class="btn btn-outline" onclick="clearFilters()" style="border-color: var(--accent-color); color: var(--accent-color);">
                            <i class="fas fa-times me-2"></i>Clear All Filters
                        </button>
                    </div>
                </td>
            `;
            deliveriesTableBody.appendChild(noResultsRow);
        }
    }

    // Hide no results message
    function hideNoResultsMessage() {
        const noResultsRow = document.getElementById('noResultsRow');
        if (noResultsRow) {
            noResultsRow.remove();
        }
    }

    // Clear all filters function (exposed to global scope)
    window.clearFilters = function() {
        searchInput.value = '';
        clearSearchBtn.style.display = 'none';
        genderFilter.value = 'all';
        sortBy.value = 'name_asc';
        performSearch();
    };

    // Animate stat cards on scroll
    const observerOptions = {
        threshold: 0.2,
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

    // Observe all animated elements
    document.querySelectorAll('.fade-in-up').forEach(el => {
        observer.observe(el);
    });

    // Table row hover effects
    document.querySelectorAll('.table tbody tr').forEach(row => {
        row.addEventListener('mouseenter', function() {
            this.style.backgroundColor = '#f8f9ff';
        });

        row.addEventListener('mouseleave', function() {
            this.style.backgroundColor = '';
        });
    });

    // Button click animations
    document.querySelectorAll('.btn').forEach(button => {
        button.addEventListener('mousedown', function() {
            this.style.transform = 'scale(0.95)';
        });

        button.addEventListener('mouseup', function() {
            this.style.transform = 'translateY(-2px)';
        });

        button.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0)';
        });
    });

    // Initialize search on page load (in case there's a URL parameter)
    performSearch();
});

// Keyboard shortcuts
document.addEventListener('keydown', function(e) {
    // Focus search on Ctrl/Cmd + F
    if ((e.ctrlKey || e.metaKey) && e.key === 'f') {
        e.preventDefault();
        const searchInput = document.getElementById('searchInput');
        if (searchInput) {
            searchInput.focus();
        }
    }

    // Clear search on Escape
    if (e.key === 'Escape') {
        const searchInput = document.getElementById('searchInput');
        if (searchInput && document.activeElement === searchInput) {
            searchInput.value = '';
            searchInput.dispatchEvent(new Event('input'));
        }
    }
});
</script>
@endsection
