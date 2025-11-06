@extends('senior.dashboard')

<style>
:root {
    --primary-color: #4361ee;
    --primary-light: #eef2ff;
    --secondary-color: #3f37c9;
    --success-color: #4cc9f0;
    --text-dark: #2b2d42;
    --text-light: #6c757d;
    --bg-light: #f8f9fa;
    --white: #ffffff;
    --border-radius: 12px;
    --box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
    --transition: all 0.3s ease;
}

.dashboard-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 30px 20px;
}

.welcome-box {
    background: var(--text-dark);
    color: var(--white);
    padding: 40px 30px;
    border-radius: var(--border-radius);
    box-shadow: var(--box-shadow);
    margin-top: 50px;
    margin-bottom: 30px;
    text-align: center;
    position: relative;
    overflow: hidden;
}

.welcome-box::before {
    content: '';
    position: absolute;
    top: -50%;
    right: -50%;
    width: 100%;
    height: 100%;
    background: rgba(255, 255, 255, 0.1);
    transform: rotate(30deg);
}

.welcome-box h1 {
    font-size: 2.2rem;
    font-weight: 600;
    margin-bottom: 10px;
    position: relative;
    z-index: 1;
}

.welcome-box p {
    font-size: 1.1rem;
    opacity: 0.9;
    position: relative;
    z-index: 1;
}

.dashboard-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 25px;
    margin-bottom: 30px;
}

.statistics-card {
    background-color: var(--white);
    padding: 25px;
    border-radius: var(--border-radius);
    box-shadow: var(--box-shadow);
    transition: var(--transition);
}

.statistics-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
}

.statistics-card h2 {
    color: var(--text-dark);
    font-size: 1.4rem;
    margin-bottom: 20px;
    font-weight: 600;
    display: flex;
    align-items: center;
    gap: 10px;
}

.statistics-card h2 i {
    color: var(--primary-color);
}

.filter-form {
    margin-bottom: 25px;
}

.filter-controls {
    display: flex;
    gap: 15px;
    flex-wrap: wrap;
}

.filter-controls select {
    flex: 1;
    min-width: 150px;
    padding: 12px 15px;
    border: 1px solid #e0e0e0;
    border-radius: 8px;
    background-color: var(--white);
    font-size: 0.95rem;
    transition: var(--transition);
}

.filter-controls select:focus {
    outline: none;
    border-color: var(--primary-color);
    box-shadow: 0 0 0 3px rgba(67, 97, 238, 0.15);
}

.filter-controls button {
    background-color: var(--primary-color);
    color: var(--white);
    border: none;
    padding: 12px 25px;
    border-radius: 8px;
    font-weight: 500;
    cursor: pointer;
    transition: var(--transition);
    white-space: nowrap;
}

.filter-controls button:hover {
    background-color: var(--secondary-color);
}

.stats-display {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 20px;
}

.stat-item {
    text-align: center;
    padding: 20px 15px;
    border-radius: 10px;
    background-color: var(--primary-light);
    transition: var(--transition);
}

.stat-item:hover {
    transform: scale(1.03);
}

.stat-item.male {
    border-left: 4px solid #4361ee;
}

.stat-item.female {
    border-left: 4px solid #f72585;
}

.stat-value {
    font-size: 2.2rem;
    font-weight: 700;
    margin-bottom: 5px;
}

.stat-value.male {
    color: #4361ee;
}

.stat-value.female {
    color: #f72585;
}

.stat-label {
    font-size: 0.95rem;
    color: var(--text-dark);
    font-weight: 500;
}

.chart-container {
    background-color: var(--white);
    padding: 25px;
    border-radius: var(--border-radius);
    box-shadow: var(--box-shadow);
    margin-bottom: 30px;
}

.chart-container h2 {
    color: var(--text-dark);
    font-size: 1.4rem;
    margin-bottom: 20px;
    font-weight: 600;
    display: flex;
    align-items: center;
    gap: 10px;
}

.chart-container h2 i {
    color: var(--primary-color);
}

.chart-wrapper {
    width: 100%;
    height: 350px;
    position: relative;
}

.loading {
    display: none;
    text-align: center;
    padding: 20px;
    color: var(--text-light);
}

.loading.active {
    display: block;
}

@media (max-width: 768px) {
    .dashboard-container {
        padding: 20px 15px;
    }

    .welcome-box h1 {
        font-size: 1.8rem;
    }

    .dashboard-grid {
        grid-template-columns: 1fr;
    }

    .filter-controls {
        flex-direction: column;
    }

    .stats-display {
        grid-template-columns: 1fr;
    }

    .chart-wrapper {
        height: 300px;
    }
}

@media (max-width: 480px) {
    .welcome-box {
        padding: 30px 20px;
    }

    .welcome-box h1 {
        font-size: 1.5rem;
    }

    .statistics-card, .chart-container {
        padding: 20px 15px;
    }

    .chart-wrapper {
        height: 250px;
    }
}
</style>

<div class="dashboard-container">
    <div class="welcome-box">
        <h1>Welcome, <strong>{{ Auth::user()->name }}</strong></h1>
        <p>Senior Citizen Management Dashboard</p>
    </div>

    <div class="dashboard-grid">
        <div class="statistics-card">
            <h2>
                <i class="fas fa-filter"></i> Filter Statistics
            </h2>
            <form id="filterForm" class="filter-form">
                <div class="filter-controls">
                    <select name="year" id="year">
                        <option value="">Select Year</option>
                        @php
                            $currentYear = date('Y');
                        @endphp
                        @for ($year = $currentYear; $year >= $currentYear - 10; $year--)
                            <option value="{{ $year }}" {{ request('year') == $year ? 'selected' : '' }}>{{ $year }}</option>
                        @endfor
                    </select>
                    <select name="month" id="month">
                        <option value="">Select Month</option>
                        @php
                            $months = [
                                '01' => 'January', '02' => 'February', '03' => 'March', '04' => 'April',
                                '05' => 'May', '06' => 'June', '07' => 'July', '08' => 'August',
                                '09' => 'September', '10' => 'October', '11' => 'November', '12' => 'December'
                            ];
                        @endphp
                        @foreach ($months as $key => $month)
                            <option value="{{ $key }}" {{ request('month') == $key ? 'selected' : '' }}>{{ $month }}</option>
                        @endforeach
                    </select>
                    <button type="submit">Apply Filter</button>
                </div>
            </form>

            <div class="stats-display">
                <div class="stat-item male">
                    <div class="stat-value male" id="filteredMaleSeniors">{{ $filteredMaleSeniors }}</div>
                    <div class="stat-label">Male Seniors</div>
                </div>
                <div class="stat-item female">
                    <div class="stat-value female" id="filteredFemaleSeniors">{{ $filteredFemaleSeniors }}</div>
                    <div class="stat-label">Female Seniors</div>
                </div>
            </div>
        </div>

        <div class="statistics-card">
            <h2>
                <i class="fas fa-chart-pie"></i> Gender Distribution
            </h2>
            <div class="chart-wrapper">
                <canvas id="seniorStatusChart"></canvas>
            </div>
        </div>
    </div>

    <div class="loading" id="loadingIndicator">
        <p>Loading data...</p>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    // Initialize the chart
    var ctx = document.getElementById('seniorStatusChart').getContext('2d');
    var seniorStatusChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: ['Male Seniors', 'Female Seniors'],
            datasets: [{
                data: [{{ $maleSeniors }}, {{ $femaleSeniors }}],
                backgroundColor: [
                    'rgba(67, 97, 238, 0.8)',
                    'rgba(247, 37, 133, 0.8)'
                ],
                borderColor: [
                    'rgba(67, 97, 238, 1)',
                    'rgba(247, 37, 133, 1)'
                ],
                borderWidth: 2,
                hoverOffset: 15
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        padding: 20,
                        usePointStyle: true,
                        font: {
                            size: 13
                        }
                    }
                },
                tooltip: {
                    backgroundColor: 'rgba(0, 0, 0, 0.7)',
                    padding: 12,
                    titleFont: {
                        size: 14
                    },
                    bodyFont: {
                        size: 13
                    }
                }
            },
            cutout: '65%'
        }
    });

    // Filter form submission
    document.getElementById('filterForm').addEventListener('submit', function(event) {
        event.preventDefault();
        const year = document.getElementById('year').value;
        const month = document.getElementById('month').value;
        const loadingIndicator = document.getElementById('loadingIndicator');

        // Show loading indicator
        loadingIndicator.classList.add('active');

        fetch(`{{ route('senior.homepage') }}?year=${year}&month=${month}`, {
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(response => response.json())
        .then(data => {
            // Update statistics
            document.getElementById('filteredMaleSeniors').textContent = data.filteredMaleSeniors;
            document.getElementById('filteredFemaleSeniors').textContent = data.filteredFemaleSeniors;

            // Update chart if needed
            if (data.maleSeniors !== undefined && data.femaleSeniors !== undefined) {
                seniorStatusChart.data.datasets[0].data = [data.maleSeniors, data.femaleSeniors];
                seniorStatusChart.update();
            }

            // Hide loading indicator
            loadingIndicator.classList.remove('active');
        })
        .catch(error => {
            console.error('Error fetching filtered data:', error);
            loadingIndicator.classList.remove('active');
            alert('An error occurred while fetching data. Please try again.');
        });
    });
});
</script>
