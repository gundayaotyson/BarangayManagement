@extends('admin.dashboard')

@section('content')
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Delivery Records - BHW Dashboard</title>
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
            --secondary-color: #343a40;
            --accent-color: #e74c3c;
            --light-bg: #f8f9fa;
            --card-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        body {
            background-color: #f5f7fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .bg-primary.text-white.p-3.rounded-lg {
            background: var(--primary-color);
            border: none;
            box-shadow: var(--box-shadow);
            border-radius: var(--border-radius) !important;
        }

        .container {
            max-width: 1200px;
        }

        .page-title {
            color: var(--primary-color);
            font-weight: 700;
            margin-bottom: 1.5rem;
            border-bottom: 2px solid var(--secondary-color);
            padding-bottom: 0.5rem;
        }

        .card {
            border: none;
            border-radius: 10px;
            box-shadow: var(--card-shadow);
            margin-bottom: 1.5rem;
            transition: transform 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
        }

        .card-headers {
            background: var(--primary-color);
            color: white;
            border-radius: 10px 10px 0 0 !important;
            padding: 1rem 1.5rem;
            font-weight: 600;
        }

        .form-label {
            font-weight: 600;
            color: #555;
        }

        .form-control, .form-select {
            border-radius: 8px;
            padding: 0.75rem;
            border: 1px solid #ddd;
            transition: all 0.3s;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: #2c3e50;
            box-shadow: 0 0 0 0.25rem rgba(44, 62, 80, 0.25);
        }

        .btn-primary {
            background: var(--primary-color);
            border: none;
            border-radius: 8px;
            padding: 0.75rem 1.5rem;
            font-weight: 600;
            transition: all 0.3s;
        }

        .btn-primary:hover {
            background: var(--primary-color);
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .btn-warning, .btn-danger, .btn-info {
            border-radius: 6px;
            padding: 0.5rem 1rem;
        }

        .table {
            border-radius: 10px;
            overflow: hidden;
            box-shadow: var(--card-shadow);
        }

        .table thead {
            background:  var(--primary-color);
            color: white;
        }

        .table th {
            background-color: var(--primary-color);
            color: white;
            border: none;
            padding: 1rem;
            font-weight: 600;
        }

        .table td {
            padding: 1rem;
            vertical-align: middle;
        }

        .table tbody tr {
            transition: background-color 0.2s;
        }

        .table tbody tr:hover {
            background-color: rgba(155, 89, 182, 0.05);
        }

        .alert {
            border-radius: 10px;
            border: none;
            padding: 1rem 1.5rem;
        }

        .alert-success {
            background-color: #d4edda;
            color: #155724;
        }

        .section-divider {
            height: 2px;
            background: linear-gradient(to right, var(--primary-color), var(--secondary-color));
            margin: 2rem 0;
            border: none;
        }

        .info-icon {
            color: var(--light-bg);
            margin-right: 0.5rem;
        }

        .resident-badge {
            background-color: var(--primary-color);
            color: white;
            padding: 0.25rem 0.5rem;
            border-radius: 4px;
            font-size: 0.875rem;
        }

        .ui-autocomplete {
            max-height: 200px;
            overflow-y: auto;
            overflow-x: hidden;
            border-radius: 8px;
            box-shadow: var(--card-shadow);
            z-index: 1060;
        }

        .ui-menu-item {
            padding: 0.5rem 1rem;
            border-bottom: 1px solid #eee;
        }

        .ui-menu-item:last-child {
            border-bottom: none;
        }

        .ui-state-active {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
            border: none;
        }

        .modal-header {
            background:  var(--primary-color);
            color: white;
            border-radius: 10px 10px 0 0;
        }

        .modal-footer {
            border-radius: 0 0 10px 10px;
        }

        .action-buttons {
            display: flex;
            gap: 0.5rem;
        }

        .stats-card {
            text-align: center;
            padding: 1.5rem;
        }

        .stats-number {
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--primary-color);
            margin-bottom: 0.5rem;
        }

        .stats-label {
            font-size: 1rem;
            color: #666;
        }

        .search-highlight {
            background-color: #fff3cd;
            padding: 0.25rem 0.5rem;
            border-radius: 4px;
            font-weight: 600;
        }

        /* View Modal Specific Styles */
        .info-item {
            display: flex;
            flex-direction: column;
            margin-bottom: 1rem;
        }

        .info-label {
            font-size: 1rem;
            font-weight: 600;
            color:var(--primary-color);
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 0.25rem;
        }

        .info-value {
            font-size: 0.95rem;
            color: #2c3e50;
            font-weight: 500;
            margin-bottom: 0.25rem;
        }

        .info-value:last-child {
            margin-bottom: 0;
        }

        .gender-badge {
            font-size: 0.9rem;
            padding: 0.5rem 1rem;
            border-radius: 20px;
        }

        .summary-item {
            padding: 1rem;
            text-align: center;
        }

        .summary-icon {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1rem;
            color: white;
            font-size: 1.25rem;
        }

        .summary-value {
            font-size: 1rem;
            font-weight: 600;
            color: #2c3e50;
            margin-bottom: 0.25rem;
        }

        .summary-label {
            font-size: 0.8rem;
            color: #6c757d;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .bg-gradient-info {
            background: linear-gradient(135deg, #17a2b8, #20c997) !important;
        }

        .card-header h6 {
            font-size: 0.9rem;
        }

        .display-6 {
            font-size: 1.5rem;
        }

        /* Print Styles */
        @media print {
            .modal-footer {
                display: none !important;
            }

            .modal-header {
                background: #2c3e50 !important;
                -webkit-print-color-adjust: exact;
            }

            .card-header {
                background: #2c3e50 !important;
                color: white !important;
                -webkit-print-color-adjust: exact;
            }
        }

        @media (max-width: 768px) {
            .card-body {
                padding: 1rem;
            }

            .table-responsive {
                font-size: 0.875rem;
            }

            .btn {
                padding: 0.5rem 1rem;
            }

            .action-buttons {
                flex-direction: column;
            }

            .summary-item {
                margin-bottom: 1rem;
            }
        }
    </style>
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
        background:var(--primary-color);
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
                <i class="fas fa-user-nurse me-3"></i>Welcome to BHW List
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
             <div class="search-wrapper">
                        <!-- <i class="fas fa-search search-icon"></i> -->
                        <input type="text" id="searchInput" class="form-control search-input"
                            placeholder="Search child by name ">
                        <button type="button" class="clear-search-btn" id="clearSearchBtn">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>

            <div class="card-actions">
                <!-- <button class="btn btn-outline">
                    <i class="fas fa-download"></i> Export Records
                </button> -->
                 <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addDeliveryModal">
                <i class="fas fa-plus-circle me-2"></i>Add New Delivery
            </button>
            <button class="btn btn-success" onclick="exportCSV()">
                <i class="fas fa-file-csv"></i> Export CSV
            </button>

                <button class="btn btn-outline" id="refreshBtn">
                    <i class="fas fa-sync-alt"></i> Refresh
                </button>
            </div>



        </div>


        <!-- Search Results Info -->
        <div class="search-results-info" id="searchResultsInfo" style="display: none;">
            Showing <strong id="resultCount">0</strong> of <strong>{{ $newdeliveries->count() }}</strong> records
            <span id="searchTermDisplay"></span>
        </div>

        <div class="table-container">
           <div class="filters">
                <div class="filter-group">
                    <span class="filter-label">Purok:</span>
                    <select class="filter-select" id="purokFilter">
                        <option value="all">All Puroks</option>
                        <option value="1">Purok 1</option>
                        <option value="2">Purok 2</option>
                        <option value="3">Purok 3</option>
                    </select>
                </div>
                <div class="filter-group">
                    <span class="filter-label">Month:</span>
                    <select class="filter-select" id="monthFilter">
                        <option value="all">All Months</option>
                        <option value="1">January</option>
                        <option value="2">February</option>
                        <option value="3">March</option>
                        <option value="4">April</option>
                        <option value="5">May</option>
                        <option value="6">June</option>
                        <option value="7">July</option>
                        <option value="8">August</option>
                        <option value="9">September</option>
                        <option value="10">October</option>
                        <option value="11">November</option>
                        <option value="12">December</option>
                    </select>
                </div>

                <div class="filter-group">
                     <span class="filter-label">Gender:</span>
                    <select class="filter-select" id="genderFilter">
                        <option value="all">All Genders</option>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                    </select>
                </div>
                <div class="filter-group">
                     <span class="filter-label">Sort by:</span>
                    <select class="filter-select" id="sortBy">
                        <option value="name_asc">Sort by Name (A-Z)</option>
                        <option value="name_desc">Sort by Name (Z-A)</option>
                        <option value="date_asc">Sort by Date (Oldest)</option>
                        <option value="date_desc">Sort by Date (Newest)</option>
                    </select>
                </div>
                <div class="filter-group">

                </div>


           </div>
            @if($newdeliveries->count() > 0)
            <table class="table" id="deliveriesTable">
                <thead>
                    <tr>
                        <th style="width: 25%;">Parent Information</th>
                        <th style="width: 25%;">Child's Information</th>
                        <th style="width: 20%;">Birth Details</th>
                        <th style="width: 15%;">Gender</th>
                        <th style="width: 20%;">Weight</th>
                        <th style="width: 20%;">Height</th>
                        <th style="width: 10%;">Purok</th>
                        <th style="width: 20%;">Action</th>

                    </tr>
                </thead>
                <tbody id="deliveriesTableBody">
                    @foreach ($newdeliveries as $delivery)
                    <tr class="fade-in-up delivery-row"
                        style="animation-delay: {{ $loop->index * 0.05 }}s;"
                        data-fullname="{{ strtolower($delivery->p_fname . ' ' . $delivery->p_mname . ' ' . $delivery->p_lname) }}"
                        data-childname="{{ strtolower($delivery->c_fname . ' ' . $delivery->c_mname . ' ' . $delivery->c_lname) }}"
                        data-firstname="{{ strtolower($delivery->c_fname) }}"
                        data-middlename="{{ strtolower($delivery->c_mname) }}"
                        data-lastname="{{ strtolower($delivery->c_lname) }}"
                        data-gender="{{ strtolower($delivery->gender) }}"
                        data-birthdate="{{ $delivery->c_birthday }}"
                        data-weight="{{ $delivery->weight }}"
                        data-height="{{ $delivery->height }}"
                        data-purok="{{ $delivery->purok_no }}">
                         <td>
                            <div class="child-info">
                                <div class="child-avatar {{ strtolower($delivery->gender) == 'male' ? 'boy' : 'girl' }}">
                                    {{ substr($delivery->p_fname, 0, 1) }}{{ substr($delivery->p_lname, 0, 1) }}
                                </div>
                                <div class="child-details">
                                    <h4>{{ $delivery->p_fname }} {{ $delivery->p_mname }} {{ $delivery->p_lname }}</h4>
                                    <p>
                                        <i class="fas fa-id-badge"></i> ID: {{ $loop->iteration + 1000 }}
                                    </p>
                                </div>
                            </div>
                        </td>
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
                        <td>
                            <div class="measurement">
                                <div class="measurement-value">Purok {{ $delivery->purok_no }}</div>
                                <div class="measurement-unit">Area</div>
                            </div>
                        </td>
                        <td>
                            <div class="action-buttons">
                                <button class="btn btn-info btn-sm view-btn" data-bs-toggle="modal" data-bs-target="#viewDeliveryModal" data-delivery="{{ json_encode($delivery) }}">
                                <i class="fas fa-eye"></i>
                                </button>
                                <button class="btn btn-warning btn-sm edit-btn" data-bs-toggle="modal" data-bs-target="#editDeliveryModal" data-delivery="{{ json_encode($delivery) }}">
                                <i class="fas fa-edit"></i>
                                </button>
                                 <!-- Add Delete Button -->
                                    <form action="{{ route('bhw.newdelivery.destroy', $delivery->id) }}" method="POST" style="display: inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirmDelete()">
                                            <i class="fas fa-trash"></i>
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
                    <i class="fas fa-baby"></i>
                </div>
                <h3>No New Deliveries Recorded</h3>
                <p>There are no new delivery records in the system yet.</p>
            </div>
            @endif
        </div>
    </div>
</div>
  <!-- Add Delivery Modal -->
    <div class="modal fade" id="addDeliveryModal" tabindex="-1" aria-labelledby="addDeliveryModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <form action="{{ route('bhw.storeNewDelivery') }}" method="POST">
                    @csrf
                    <input type="hidden" name="resident_id" id="resident_id">
                    <input type="hidden" name="pregnants_id" id="pregnants_id">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addDeliveryModalLabel">
                            <i class="fas fa-plus-circle me-2"></i>Add New Delivery Record
                        </h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="card mb-4">
                                    <div class="card-headers">
                                        <i class="fas fa-user info-icon"></i>Parent Information
                                    </div>
                                    <div class="card-body">
                                        <div class="row mb-3">
                                            <div class="col-md-12">
                                                <label for="resident_search" class="form-label">Search Resident</label>
                                                <input type="text" id="resident_search" class="form-control" placeholder="Type resident name...">
                                                <div class="form-text">Start typing to search for residents or leave blank to enter manually</div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4 mb-3">
                                                <label for="p_fname" class="form-label">First Name *</label>
                                                <input type="text" name="p_fname" id="p_fname" class="form-control" required>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label for="p_mname" class="form-label">Middle Name</label>
                                                <input type="text" name="p_mname" id="p_mname" class="form-control">
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label for="p_lname" class="form-label">Last Name *</label>
                                                <input type="text" name="p_lname" id="p_lname" class="form-control" required>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label for="age" class="form-label">Age *</label>
                                                <div class="input-group">
                                                    <span class="input-group-text"><i class="fas fa-user-clock"></i></span>
                                                    <input type="number" name="age" id="age" class="form-control" required>
                                                </div>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label for="birthday" class="form-label">Birthday *</label>
                                                <div class="input-group">
                                                    <span class="input-group-text"><i class="fas fa-birthday-cake"></i></span>
                                                    <input type="date" name="birthday" id="birthday" class="form-control" required>
                                                </div>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label for="household_no" class="form-label">Household No. *</label>
                                                <div class="input-group">
                                                    <span class="input-group-text"><i class="fas fa-home"></i></span>
                                                    <input type="text" name="household_no" id="household_no" class="form-control" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="purok_no" class="form-label">Purok No. *</label>
                                                <input type="text" class="form-control" id="purok_no" name="purok_no" readonly>

                                                <!-- <select name="purok_no" id="purok_no" class="form-select" required>
                                                    <option value="">Select Purok</option>
                                                    <option value="1">Purok 1</option>
                                                    <option value="2">Purok 2</option>
                                                    <option value="3">Purok 3</option>
                                                </select> -->
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="sitio" class="form-label">Sitio *</label>
                                                <input type="text" class="form-control" id="sitio" name="sitio" readonly>

                                                <!-- <select name="sitio" id="sitio" class="form-select" required>
                                                    <option value="">Select Sitio</option>
                                                    <option value="N/A">N/A</option>
                                                    <option value="Leksab">Leksab</option>
                                                    <option value="Taew">Taew</option>
                                                    <option value="Pidlaoan">Pidlaoan</option>
                                                </select> -->
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="birthplace" class="form-label">Place of Birth *</label>
                                                <div class="input-group">
                                                    <span class="input-group-text"><i class="fas fa-map-marker-alt"></i></span>
                                                    <input type="text" name="birthplace" id="birthplace" class="form-control" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="typeof_birth" class="form-label">Type of Birth *</label>
                                                <select name="typeof_birth" id="typeof_birth" class="form-select" required>
                                                    <option value="">Select Type</option>
                                                    <option value="Normal">Normal</option>
                                                    <option value="Caesarean">Caesarean</option>
                                                    <option value="Assisted">Assisted</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-headers">
                                        <i class="fas fa-baby info-icon"></i>Child Information
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-4 mb-3">
                                                <label for="c_fname" class="form-label">First Name *</label>
                                                <input type="text" name="c_fname" id="c_fname" class="form-control" required>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label for="c_mname" class="form-label">Middle Name</label>
                                                <input type="text" name="c_mname" id="c_mname" class="form-control">
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label for="c_lname" class="form-label">Last Name *</label>
                                                <input type="text" name="c_lname" id="c_lname" class="form-control" required>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="c_birthday" class="form-label">Birthday *</label>
                                                <div class="input-group">
                                                    <span class="input-group-text"><i class="fas fa-calendar-day"></i></span>
                                                    <input type="date" name="c_birthday" id="c_birthday" class="form-control" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="time" class="form-label">Time *</label>
                                                <div class="input-group">
                                                    <span class="input-group-text"><i class="fas fa-clock"></i></span>
                                                    <input type="time" name="time" id="time" class="form-control" required>
                                                </div>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label for="weight" class="form-label">Weight (kg) *</label>
                                                <div class="input-group">
                                                    <span class="input-group-text"><i class="fas fa-weight"></i></span>
                                                    <input type="text" name="weight" id="weight" class="form-control" required>
                                                </div>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label for="height" class="form-label">Height (cm) *</label>
                                                <div class="input-group">
                                                    <span class="input-group-text"><i class="fas fa-ruler-vertical"></i></span>
                                                    <input type="text" name="height" id="height" class="form-control" required>
                                                </div>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label for="gender" class="form-label">Gender *</label>
                                                <select name="gender" id="gender" class="form-select" required>
                                                    <option value="">Select Gender</option>
                                                    <option value="Male">Male</option>
                                                    <option value="Female">Female</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-2"></i>Add Delivery Record
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
     <!-- View Delivery Modal -->
    <div class="modal fade" id="viewDeliveryModal" tabindex="-1" aria-labelledby="viewDeliveryModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header" style="background: #2c3e50;">
                    <h5 class="modal-title" id="viewDeliveryModalLabel">
                        <i class="fas fa-eye me-2"></i>Delivery Record Details
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <!-- Parent Information -->
                        <div class="col-md-6">
                            <div class="card border-0 shadow-sm mb-4">
                                <div class="card-header bg-#2c3e50 text-white py-3">
                                    <div class="d-flex align-items-center">
                                        <div class="bg-white rounded-circle p-2 me-3">
                                            <i class="fas fa-user text-primary fa-lg"></i>
                                        </div>
                                        <div>
                                            <h6 class="mb-0 fw-bold">PARENT INFORMATION</h6>
                                            <small class="opacity-75">Mother's Details</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body p-4">
                                    <div class="row g-3">
                                        <div class="col-12">
                                            <div class="info-item">
                                                <span class="info-label">Full Name:  <span class="info-value" id="view_p_fname"></span> <span class="info-value" id="view_p_mname"></span> <span class="info-value" id="view_p_lname"></span></span>

                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="info-item">
                                                <span class="info-label">Age: <span class="info-value" id="view_age"></span></span>

                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="info-item">
                                                <span class="info-label">Birthday: <span class="info-value" id="view_birthday"></span></span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="info-item">
                                                <span class="info-label">Household No.<span class="info-value" id="view_household_no"></span></span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="info-item">
                                                <span class="info-label">Purok No.<span class="info-value" id="view_purok_no"></span></span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="info-item">
                                                <span class="info-label">Sitio: <span id="view_sitio" class="info-value"></span>
                                                <span class="info-value" id="view_sitio"></span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="info-item">
                                                <span class="info-label">Place of Birth:<span class="info-value" id="view_birthplace"></span></span>

                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="info-item">
                                                <span class="info-label">Type of Birth</span>
                                                <span class="info-value badge bg-info" id="view_typeof_birth"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Child Information -->
                        <div class="col-md-6">
                            <div class="card border-0 shadow-sm">
                                <div class="card-header bg-#2c3e50 text-white py-3">
                                    <div class="d-flex align-items-center">
                                        <div class="bg-white rounded-circle p-2 me-3">
                                            <i class="fas fa-baby text-success fa-lg"></i>
                                        </div>
                                        <div>
                                            <h6 class="mb-0 fw-bold">CHILD INFORMATION</h6>
                                            <small class="opacity-75">Newborn Details</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body p-4">
                                    <div class="row g-3">
                                        <div class="col-12">
                                            <div class="info-item">
                                                <span class="info-label">Full Name:<span class="info-value" id="view_c_fname"></span> <span class="info-value" id="view_c_mname"></span> <span class="info-value" id="view_c_lname"></span></span>

                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="info-item">
                                                <span class="info-label">Birth Date:<span class="info-value" id="view_c_birthday"></span></span>

                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="info-item">
                                                <span class="info-label">Time of Birth:<span class="info-value" id="view_time"></span></span>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="info-item text-center">
                                                <span class="info-label">Weight</span>
                                                <span class="info-value display-6 text-primary fw-bold" id="view_weight"></span>
                                                <small class="text-muted">kg</small>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="info-item text-center">
                                                <span class="info-label">Height</span>
                                                <span class="info-value display-6 text-success fw-bold" id="view_height"></span>
                                                <small class="text-muted">cm</small>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="info-item text-center">
                                                <span class="info-label">Gender</span>
                                                <span class="info-value">
                                                    <span class="badge gender-badge" id="view_gender_badge"></span>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Summary Card -->
                    <!-- <div class="card border-0 shadow-sm mt-4">
                        <div class="card-header bg-gradient-info text-white py-3">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-clipboard-check fa-lg me-3"></i>
                                <h6 class="mb-0 fw-bold">DELIVERY SUMMARY</h6>
                            </div>
                        </div>
                        <div class="card-body p-4">
                            <div class="row text-center">
                                <div class="col-md-3 mb-3">
                                    <div class="summary-item">
                                        <div class="summary-icon bg-primary">
                                            <i class="fas fa-user-circle"></i>
                                        </div>
                                        <div class="summary-content">
                                            <div class="summary-value" id="summary_parent_name"></div>
                                            <div class="summary-label">Mother's Name</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <div class="summary-item">
                                        <div class="summary-icon bg-success">
                                            <i class="fas fa-baby"></i>
                                        </div>
                                        <div class="summary-content">
                                            <div class="summary-value" id="summary_child_name"></div>
                                            <div class="summary-label">Baby's Name</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <div class="summary-item">
                                        <div class="summary-icon bg-warning">
                                            <i class="fas fa-calendar-day"></i>
                                        </div>
                                        <div class="summary-content">
                                            <div class="summary-value" id="summary_birth_date"></div>
                                            <div class="summary-label">Date of Birth</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <div class="summary-item">
                                        <div class="summary-icon bg-info">
                                            <i class="fas fa-venus-mars"></i>
                                        </div>
                                        <div class="summary-content">
                                            <div class="summary-value" id="summary_gender"></div>
                                            <div class="summary-label">Gender</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> -->
                </div>
                <!-- <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">

                    </button>
                    <button type="button" class="btn btn-primary" onclick="window.print()">
                        <i class="fas fa-print me-2"></i>Print Record
                    </button>
                </div> -->
            </div>
        </div>
    </div>

    <!-- Edit Delivery Modal -->
    <div class="modal fade" id="editDeliveryModal" tabindex="-1" aria-labelledby="editDeliveryModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <form action="#" method="POST" id="editDeliveryForm">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="delivery_id" id="edit_delivery_id">
                    <input type="hidden" name="resident_id" id="edit_resident_id">
                    <input type="hidden" name="pregnants_id" id="edit_pregnants_id">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editDeliveryModalLabel">
                            <i class="fas fa-edit me-2"></i>Edit Delivery Record
                        </h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <i class="fas fa-user info-icon"></i>Parent Information
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-4 mb-3">
                                                <label for="edit_p_fname" class="form-label">First Name *</label>
                                                <input type="text" name="p_fname" id="edit_p_fname" class="form-control" required>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label for="edit_p_mname" class="form-label">Middle Name</label>
                                                <input type="text" name="p_mname" id="edit_p_mname" class="form-control">
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label for="edit_p_lname" class="form-label">Last Name *</label>
                                                <input type="text" name="p_lname" id="edit_p_lname" class="form-control" required>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label for="edit_age" class="form-label">Age *</label>
                                                <div class="input-group">
                                                    <span class="input-group-text"><i class="fas fa-user-clock"></i></span>
                                                    <input type="number" name="age" id="edit_age" class="form-control" required>
                                                </div>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label for="edit_birthday" class="form-label">Birthday *</label>
                                                <div class="input-group">
                                                    <span class="input-group-text"><i class="fas fa-birthday-cake"></i></span>
                                                    <input type="date" name="birthday" id="edit_birthday" class="form-control" required>
                                                </div>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label for="edit_household_no" class="form-label">Household No. *</label>
                                                <div class="input-group">
                                                    <span class="input-group-text"><i class="fas fa-home"></i></span>
                                                    <input type="text" name="household_no" id="edit_household_no" class="form-control" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="edit_purok_no" class="form-label">Purok No. *</label>
                                                <select name="purok_no" id="edit_purok_no" class="form-select" required>
                                                    <option value="">Select Purok</option>
                                                    <option value="1">Purok 1</option>
                                                    <option value="2">Purok 2</option>
                                                    <option value="3">Purok 3</option>
                                                </select>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="edit_sitio" class="form-label">Sitio *</label>
                                                <select name="sitio" id="edit_sitio" class="form-select" required>
                                                    <option value="">Select Sitio</option>
                                                    <option value="N/A">N/A</option>
                                                    <option value="Leksab">Leksab</option>
                                                    <option value="Taew">Taew</option>
                                                    <option value="Pidlaoan">Pidlaoan</option>
                                                </select>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="edit_birthplace" class="form-label">Place of Birth *</label>
                                                <div class="input-group">
                                                    <span class="input-group-text"><i class="fas fa-map-marker-alt"></i></span>
                                                    <input type="text" name="birthplace" id="edit_birthplace" class="form-control" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="edit_typeof_birth" class="form-label">Type of Birth *</label>
                                                <select name="typeof_birth" id="edit_typeof_birth" class="form-select" required>
                                                    <option value="">Select Type</option>
                                                    <option value="Normal">Normal</option>
                                                    <option value="Caesarean">Caesarean</option>
                                                    <option value="Assisted">Assisted</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-header">
                                        <i class="fas fa-baby info-icon"></i>Child Information
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-4 mb-3">
                                                <label for="edit_c_fname" class="form-label">First Name *</label>
                                                <input type="text" name="c_fname" id="edit_c_fname" class="form-control" required>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label for="edit_c_mname" class="form-label">Middle Name</label>
                                                <input type="text" name="c_mname" id="edit_c_mname" class="form-control">
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label for="edit_c_lname" class="form-label">Last Name *</label>
                                                <input type="text" name="c_lname" id="edit_c_lname" class="form-control" required>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="edit_c_birthday" class="form-label">Birthday *</label>
                                                <div class="input-group">
                                                    <span class="input-group-text"><i class="fas fa-calendar-day"></i></span>
                                                    <input type="date" name="c_birthday" id="edit_c_birthday" class="form-control" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="edit_time" class="form-label">Time *</label>
                                                <div class="input-group">
                                                    <span class="input-group-text"><i class="fas fa-clock"></i></span>
                                                    <input type="time" name="time" id="edit_time" class="form-control" required>
                                                </div>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label for="edit_weight" class="form-label">Weight (kg) *</label>
                                                <div class="input-group">
                                                    <span class="input-group-text"><i class="fas fa-weight"></i></span>
                                                    <input type="text" name="weight" id="edit_weight" class="form-control" required>
                                                </div>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label for="edit_height" class="form-label">Height (cm) *</label>
                                                <div class="input-group">
                                                    <span class="input-group-text"><i class="fas fa-ruler-vertical"></i></span>
                                                    <input type="text" name="height" id="edit_height" class="form-control" required>
                                                </div>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label for="edit_gender" class="form-label">Gender *</label>
                                                <select name="gender" id="edit_gender" class="form-select" required>
                                                    <option value="">Select Gender</option>
                                                    <option value="Male">Male</option>
                                                    <option value="Female">Female</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-2"></i>Update Delivery Record
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<script>
    // Month filter: show/hide table rows based on selected month
document.getElementById("monthFilter").addEventListener("change", function() {
    const selectedMonth = this.value; // "all" or 1-12

    // Loop through each table row
    document.querySelectorAll("#deliveriesTable tbody tr").forEach(row => {
        const birthDateStr = row.getAttribute("data-birthdate"); // get the birthdate from data attribute
        if (!birthDateStr) return;

        const birthDate = new Date(birthDateStr);
        const birthMonth = birthDate.getMonth() + 1; // JS months are 0-based

        // Show row if "all" is selected or if month matches
        if (selectedMonth === "all" || birthMonth.toString() === selectedMonth) {
            row.style.display = "";
        } else {
            row.style.display = "none";
        }
    });
});

</script>
<script>
function exportCSV() {
    const table = document.getElementById("deliveriesTable");
    const purokSelected = document.getElementById("purokFilter").value;
    const monthSelected = document.getElementById("monthFilter").value; // 1-12 or "all"
    let csv = [];

    // ===== GET HEADERS (EXCLUDE ACTION) =====
    let headers = [];
    table.querySelectorAll("thead th").forEach((th, index) => {
        if (th.innerText.trim().toLowerCase() !== "action") {
            headers.push('"' + th.innerText.trim() + '"');
        }
    });
    csv.push(headers.join(","));

    // ===== GET ROWS =====
    table.querySelectorAll("tbody tr").forEach(row => {
        const rowPurok = row.getAttribute("data-purok"); // purok number
        const birthdate = row.getAttribute("data-birthdate"); // YYYY-MM-DD

        let rowMonth = 0;
        if (birthdate) {
            const dateObj = new Date(birthdate);
            rowMonth = dateObj.getMonth() + 1; // 0-indexed
        }

        // FILTER BY PUROK AND MONTH
        if ((purokSelected !== "all" && rowPurok !== purokSelected) ||
            (monthSelected !== "all" && rowMonth.toString() !== monthSelected)) {
            return;
        }

        let rowData = [];

        row.querySelectorAll("td").forEach((td, index) => {
            // Skip last TD (Action column)
            if (index === row.cells.length - 1) return;

            // Remove avatar content
            let tdClone = td.cloneNode(true);
            tdClone.querySelectorAll('.child-avatar').forEach(el => el.remove());

            let text = tdClone.innerText
                .replace(/\n/g, " ")
                .replace(/\s+/g, " ")
                .trim();

            rowData.push('"' + text + '"');
        });

        csv.push(rowData.join(","));
    });

    // ===== DOWNLOAD CSV =====
    let csvContent = csv.join("\n");
    let blob = new Blob([csvContent], { type: "text/csv;charset=utf-8;" });
    let url = URL.createObjectURL(blob);

    let link = document.createElement("a");
    link.setAttribute("href", url);

    let filename = "New_Deliveries_";
    if (purokSelected === "all" && monthSelected === "all") {
        filename += "All.csv";
    } else if (purokSelected === "all") {
        filename += "Month_" + monthSelected + ".csv";
    } else if (monthSelected === "all") {
        filename += "Purok_" + purokSelected + ".csv";
    } else {
        filename += "Purok_" + purokSelected + "_Month_" + monthSelected + ".csv";
    }

    link.setAttribute("download", filename);
    link.style.visibility = "hidden";

    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
}
</script>



 <script>
        $(function() {
            function calculateAge(birthday) {
                if (birthday) {
                    var age = new Date().getFullYear() - new Date(birthday).getFullYear();
                    return age;
                }
                return '';
            }
            function formatTo12Hour(time) {
                    if (!time) return 'N/A';

                    // Split into hours/minutes
                    const [hour, minute] = time.split(':');
                    let h = parseInt(hour);
                    const ampm = h >= 12 ? 'PM' : 'AM';

                    h = h % 12 || 12; // Convert 0 → 12, 13 → 1, 14 → 2, etc.

                    return `${h}:${minute} ${ampm}`;
                }

            function updateSitio() {
                var purok = document.getElementById('purok_no').value;
                if (purok == 1) {
                    $("#sitio").val("Leksab");
                } else if (purok == 2) {
                    $("#sitio").val("Taew");
                } else if (purok == 3) {
                    $("#sitio").val("Pidlaoan");
                } else {
                    $("#sitio").val("N/A");
                }

            }

            // View Button Click Handler
            $('.view-btn').on('click', function() {
                var deliveryData = $(this).data('delivery');

                // Populate Parent Information
                $('#view_p_fname').text(deliveryData.p_fname || 'N/A');
                $('#view_p_mname').text(deliveryData.p_mname || '');
                $('#view_p_lname').text(deliveryData.p_lname || 'N/A');
                $('#view_age').text(deliveryData.age ? deliveryData.age + ' years old' : 'N/A');
                $('#view_birthday').text(deliveryData.birthday || 'N/A');
                $('#view_household_no').text(deliveryData.household_no || 'N/A');
                $('#view_purok_no').text(deliveryData.purok_no ? 'Purok ' + deliveryData.purok_no : 'N/A');
                $('#view_sitio').text(deliveryData.sitio || 'N/A');
                $('#view_birthplace').text(deliveryData.birthplace || 'N/A');
                $('#view_typeof_birth').text(deliveryData.typeof_birth || 'N/A');

                // Populate Child Information
                $('#view_c_fname').text(deliveryData.c_fname || 'N/A');
                $('#view_c_mname').text(deliveryData.c_mname || '');
                $('#view_c_lname').text(deliveryData.c_lname || 'N/A');
                $('#view_c_birthday').text(deliveryData.c_birthday || 'N/A');
                $('#view_time').text(formatTo12Hour(deliveryData.time));
                $('#view_weight').text(deliveryData.weight || 'N/A');
                $('#view_height').text(deliveryData.height || 'N/A');

                // Gender badge with color coding
                var gender = deliveryData.gender || 'N/A';
                var genderBadge = $('#view_gender_badge');
                genderBadge.text(gender);
                if (gender === 'Male') {
                    genderBadge.removeClass('bg-danger bg-secondary').addClass('bg-primary');
                } else if (gender === 'Female') {
                    genderBadge.removeClass('bg-primary bg-secondary').addClass('bg-danger');
                } else {
                    genderBadge.removeClass('bg-primary bg-danger').addClass('bg-secondary');
                }

                // Populate Summary Section
                $('#summary_parent_name').text((deliveryData.p_fname || '') + ' ' + (deliveryData.p_lname || ''));
                $('#summary_child_name').text((deliveryData.c_fname || '') + ' ' + (deliveryData.c_lname || ''));
                $('#summary_birth_date').text(deliveryData.c_birthday || 'N/A');
                $('#summary_gender').text(deliveryData.gender || 'N/A');
            });

            // Edit Button Click Handler
            $('.edit-btn').on('click', function() {
                var deliveryData = $(this).data('delivery');

                // Set form action
                $('#editDeliveryForm').attr('action', '{{ route("bhw.newdelivery.update", "") }}/' + deliveryData.id);
                $('#edit_delivery_id').val(deliveryData.id);

                // Populate Parent Information
                $('#edit_p_fname').val(deliveryData.p_fname || '');
                $('#edit_p_mname').val(deliveryData.p_mname || '');
                $('#edit_p_lname').val(deliveryData.p_lname || '');
                $('#edit_age').val(deliveryData.age || '');
                $('#edit_birthday').val(deliveryData.birthday || '');
                $('#edit_household_no').val(deliveryData.household_no || '');
                $('#edit_purok_no').val(deliveryData.purok_no || '');
                $('#edit_sitio').val(deliveryData.sitio || '');
                $('#edit_birthplace').val(deliveryData.birthplace || '');
                $('#edit_typeof_birth').val(deliveryData.typeof_birth || '');

                // Populate Child Information
                $('#edit_c_fname').val(deliveryData.c_fname || '');
                $('#edit_c_mname').val(deliveryData.c_mname || '');
                $('#edit_c_lname').val(deliveryData.c_lname || '');
                $('#edit_c_birthday').val(deliveryData.c_birthday || '');
                $('#edit_time').val(deliveryData.time || '');
                $('#edit_weight').val(deliveryData.weight || '');
                $('#edit_height').val(deliveryData.height || '');
                $('#edit_gender').val(deliveryData.gender || '');
            });

            // Initialize autocomplete when modal is shown
            $('#addDeliveryModal').on('shown.bs.modal', function () {
                $("#resident_search").autocomplete({
                    source: function(request, response) {
                        $.ajax({
                            url: "{{ route('bhw.search_residents') }}",
                            dataType: "json",
                            data: { query: request.term },
                            success: function(data) {
                                response($.map(data, function(item) {
                                    return {
                                        label: item.fname + ' ' + item.lname,
                                        value: item.fname + ' ' + item.lname,
                                        data: item
                                    };
                                }));
                            }
                        });
                    },
                    select: function(event, ui) {
                        const r = ui.item.data;
                        $("#resident_id").val(r.id);
                        $("#p_fname").val(r.fname);
                        $("#p_mname").val(r.mname);
                        $("#p_lname").val(r.lname);
                        $("#birthday").val(r.birthday);
                        $("#age").val(calculateAge(r.birthday));
                        $("#household_no").val(r.household_no);
                        $("#purok_no").val(r.purok_no);
                        updateSitio();
                        $("#sitio").val(r.sitio);
                        $('#birthplace').val(r.birthplace);

                    }
                });
            });

            // Update sitio when purok changes
            $('#purok_no').on('change', function() {
                updateSitio();
            });

            // Calculate age when birthday changes
            $('#birthday').on('change', function() {
                var birthday = $(this).val();
                if (birthday) {
                    var age = calculateAge(birthday);
                    $("#age").val(age);
                }
            });

            // Reset form when modal is closed
            $('#addDeliveryModal').on('hidden.bs.modal', function () {
                $(this).find('form')[0].reset();
                if ($("#resident_search").hasClass("ui-autocomplete-input")) {
                    $("#resident_search").autocomplete("destroy");
                }
            });

            // Add some visual feedback when required fields are filled
            $('input, select').on('change', function() {
                if ($(this).val()) {
                    $(this).addClass('is-valid');
                } else {
                    $(this).removeClass('is-valid');
                }
            });
        });
    </script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Search functionality
    const searchInput = document.getElementById('searchInput');
    const clearSearchBtn = document.getElementById('clearSearchBtn');
    const genderFilter = document.getElementById('genderFilter');
    const purokFilter = document.getElementById('purokFilter');
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

    // Filter by purok
    purokFilter.addEventListener('change', performSearch);

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
        const purokValue = purokFilter.value;
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
                const childName = row.dataset.childname || '';
                const firstName = row.dataset.firstname || '';
                const middleName = row.dataset.middlename || '';
                const lastName = row.dataset.lastname || '';

                // Check if search term matches any part of the name
                const matchesSearch = fullName.includes(searchTerm) ||
                                     childName.includes(searchTerm) ||
                                     firstName.includes(searchTerm) ||
                                     middleName.includes(searchTerm) ||
                                     lastName.includes(searchTerm);

                if (!matchesSearch) {
                    row.style.display = 'none';
                }
            });
        }

        // Filter by purok
        if (purokValue !== 'all') {
            deliveryRows.forEach(row => {
                if (row.style.display !== 'none') {
                    const rowPurok = row.dataset.purok || '';
                    if (rowPurok !== purokValue) {
                        row.style.display = 'none';
                    }
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
        if (searchTerm || genderValue !== 'all' || purokValue !== 'all') {
            searchResultsInfo.style.display = 'block';
            resultCount.textContent = visibleRows;

            let filterText = '';
            if (searchTerm) {
                filterText += ` for "<strong>${searchTerm}</strong>"`;
            }
            if (purokValue !== 'all') {
                filterText += (searchTerm || genderValue !== 'all' ? ' and ' : ' for ') +
                             `<strong>Purok ${purokValue}</strong>`;
            }
            if (genderValue !== 'all') {
                filterText += (searchTerm || purokValue !== 'all' ? ' and ' : ' for ') +
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
            showNoResultsMessage(searchTerm, genderValue, purokValue);
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
    function showNoResultsMessage(searchTerm, genderValue, purokValue) {
        let noResultsRow = document.getElementById('noResultsRow');

        if (!noResultsRow) {
            noResultsRow = document.createElement('tr');
            noResultsRow.id = 'noResultsRow';
            noResultsRow.innerHTML = `
                <td colspan="8">
                    <div class="empty-state" style="padding: 2rem;">
                        <div class="empty-state-icon">
                            <i class="fas fa-search"></i>
                        </div>
                        <h3>No Matching Records Found</h3>
                        <p>No children found${searchTerm ? ` matching "${searchTerm}"` : ''}${purokValue !== 'all' ? ` in Purok ${purokValue}` : ''}${genderValue !== 'all' ? ` with ${genderValue} gender` : ''}. Try adjusting your search criteria.</p>
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
        purokFilter.value = 'all';
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
    // Delete confirmation function
function confirmDelete() {
    return confirm('Are you sure you want to delete this delivery record? This action cannot be undone.');
}

// Optional: Add AJAX deletion for better UX
function deleteDelivery(id) {
    if (confirm('Are you sure you want to delete this delivery record?')) {
        $.ajax({
            url: '/bhw/newdelivery/' + id,
            type: 'DELETE',
            data: {
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                // Remove the row from table
                $('#delivery-row-' + id).fadeOut(300, function() {
                    $(this).remove();
                });

                // Show success message
                showNotification('Delivery record deleted successfully!', 'success');

                // Update statistics if needed
                updateStats();
            },
            error: function(xhr) {
                showNotification('Error deleting delivery record!', 'error');
            }
        });
    }
}
});
</script>
@endsection
