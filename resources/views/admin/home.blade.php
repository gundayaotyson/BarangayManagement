@extends('admin.dashboard')

@section('title', 'Dashboard')

@section('content')

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<style>
/* Enhanced Dashboard Styles */
.container {
    margin-top: 30px;
    max-width: 1400px;
    padding: 0 20px;
}

.dashboard-row {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 25px;
    margin: 0 auto;
}

.dashboard-card {
    color: white;
    padding: 25px 20px;
    border-radius: 15px;
    text-align: center;
    box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
    transition: all 0.4s cubic-bezier(0.25, 0.8, 0.25, 1);
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    position: relative;
    overflow: hidden;
    min-height: 180px;
}

/* Card background with subtle gradient */
.dashboard-card:nth-child(1) { background: linear-gradient(135deg, #007BFF 0%, #0062CC 100%); }
.dashboard-card:nth-child(2) { background: linear-gradient(135deg, #28A745 0%, #1E7E34 100%); }
.dashboard-card:nth-child(3) { background: linear-gradient(135deg, #DC3545 0%, #BD2130 100%); }
.dashboard-card:nth-child(4) { background: linear-gradient(135deg, #FFC107 0%, #FFA000 100%); color: #212529; }
.dashboard-card:nth-child(5) { background: linear-gradient(135deg, #6610F2 0%, #560AC8 100%); }

/* Card hover effect */
.dashboard-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 12px 20px rgba(0, 0, 0, 0.15);
}

/* Icon styling */
.dashboard-card i {
    font-size: 42px;
    margin-bottom: 15px;
    transition: transform 0.3s ease;
}

.dashboard-card:hover i {
    transform: scale(1.1);
}

/* Title styling */
.dashboard-card h4 {
    font-size: 18px;
    font-weight: 600;
    margin-bottom: 8px;
}

/* Value styling */
.dashboard-card p {
    font-size: 24px;
    font-weight: 700;
    margin: 0;
}

/* Responsive adjustments */
@media (max-width: 1200px) {
    .dashboard-row {
        grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
    }
}

@media (max-width: 768px) {
    .dashboard-row {
        grid-template-columns: 1fr 1fr;
        gap: 15px;
    }

    .dashboard-card {
        min-height: 160px;
        padding: 20px 15px;
    }
}

@media (max-width: 576px) {
    .dashboard-row {
        grid-template-columns: 1fr;
    }
}

/* Decorative elements */
.dashboard-card::after {
    content: '';
    position: absolute;
    top: -50%;
    right: -50%;
    width: 100%;
    height: 100%;
    background: rgba(255, 255, 255, 0.1);
    transform: rotate(30deg);
    transition: all 0.3s ease;
}

.dashboard-card:hover::after {
    transform: rotate(30deg) translate(20px, 20px);
}
</style>

<div class="container">
    <div class="dashboard-row">
        <div class="dashboard-card">
            <i class="fas fa-users"></i>
            <h4>Total Residents</h4>
            <p>{{ $totalResidentsCount }}</p>
        </div>
        <div class="dashboard-card">
            <i class="fas fa-male"></i>
            <h4>Total Male Residents</h4>
            <p>{{ $totalResidentsMale }}</p>
        </div>
        <div class="dashboard-card">
            <i class="fas fa-female"></i>
            <h4>Total Female Residents</h4>
            <p>{{ $totalResidentsFemale }}</p>
        </div>
        <!-- <div class="dashboard-card">
            <i class="fas fa-balance-scale"></i>
            <h4>Total Barangay Cases</h4>
            <p>{{ 0 }}</p> Added placeholder value
        </div> -->
        <div class="dashboard-card">
            <i class="fas fa-user-plus"></i>
            <h4>Total Senior Citizens</h4>
            <p>{{ 0  }}</p> <!-- Added placeholder value -->
        </div>
    </div>
</div>

@endsection
