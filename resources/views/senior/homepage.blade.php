@extends('senior.dashboard')

<style>
     .dashboard-box {
            margin-top: 107px;
            background-color: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
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

</style>
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

