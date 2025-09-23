<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Barangay Clearance Request</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-color: #2c3e50;
            --secondary-color: #3498db;
            --accent-color: #e74c3c;
            --light-gray: #f8f9fa;
            --dark-gray: #343a40;
            --success-color: #27ae60;
            --border-radius: 8px;
            --box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
            --transition: all 0.3s ease;
        }

        body {
            background-color: #f5f7fa;
            display: flex;
            justify-content: center;
            align-items: flex-start;
            min-height: 100vh;
            padding: 40px 20px;
            font-family: 'Poppins', sans-serif;
            line-height: 1.6;
        }

        .form-container {
            background-color: #ffffff;
            padding: 40px;
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
            width: 100%;
            max-width: 700px;
            position: relative;
            overflow: hidden;
        }

        .form-container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 5px;
            background: linear-gradient(90deg, var(--primary-color), var(--secondary-color));
        }

        h1 {
            text-align: center;
            color: var(--primary-color);
            font-size: 2rem;
            margin-bottom: 25px;
            font-weight: 600;
            position: relative;
            padding-bottom: 10px;
        }

        h1::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 3px;
            background: var(--secondary-color);
        }

        label {
            font-size: 0.95rem;
            margin-bottom: 8px;
            display: block;
            color: var(--dark-gray);
            font-weight: 500;
        }

        .form-group {
            margin-bottom: 20px;
            width: 100%;
            position: relative;
        }

        .form-row {
            display: flex;
            gap: 20px;
            margin-bottom: 20px;
        }

        .form-row .form-group {
            flex: 1;
            margin-bottom: 0;
        }

        /* Custom styles for each input field */
        #tracking_code {
            background-color: #f8f9fa;
            font-weight: 600;
            letter-spacing: 1px;
            color: var(--primary-color);
            text-align: start;
            border: 1px solid #b3d4ff;
            padding: 12px 15px;
            border-radius: var(--border-radius);
            font-size: 0.95rem;
            width: 100%;
            transition: var(--transition);
        }

        #fullname {
            background-color: #f8f9fa;
            border: 1px solid #b3d4ff;
            padding: 12px 7px;
            border-radius: var(--border-radius);
            font-size: 0.95rem;
            width: 100%;
            transition: var(--transition);
        }

        #address {
            background-color: #f8f9fa;
            border: 1px solid #b3d4ff;
            padding: 12px 15px;
            border-radius: var(--border-radius);
            font-size: 0.95rem;
            width: 100%;
            transition: var(--transition);
        }

        #dateofbirth {
            background-color: #f8f9fa;
            border: 1px solid #b3d4ff;
            padding: 12px 7px;
            border-radius: var(--border-radius);
            font-size: 0.95rem;
            width: 100%;
            transition: var(--transition);
        }

        #placeofbirth {
            background-color:  #f8f9fa;
            border: 1px solid #add8e6;
            padding: 12px 15px;
            border-radius: var(--border-radius);
            font-size: 0.95rem;
            width: 100%;
            transition: var(--transition);
        }

        #civil_status {
            background-color: #f8f9fa;
            border: 1px solid #b3d4ff;
            padding: 12px 20px;
            border-radius: var(--border-radius);
            font-size: 0.95rem;
            width: 100%;
            transition: var(--transition);
        }

        #pickup_date {
            background-color: #f8f9fa;
            border: 1px solid #b3d4ff;
            padding: 12px 15px;
            border-radius: var(--border-radius);
            font-size: 0.95rem;
            width: 100%;
            transition: var(--transition);
        }

        #purpose {
            background-color: #f8f9fa;
            border: 1px solid #b3d4ff;
            padding: 12px 15px;
            border-radius: var(--border-radius);
            font-size: 0.95rem;
            width: 100%;
            transition: var(--transition);
            resize: vertical;
            min-height: 100px;
        }

        input:focus,
        select:focus,
        textarea:focus {
            outline: none;
            box-shadow: 0 0 0 3px rgba(52, 152, 219, 0.2);
            background-color: #fff;
        }

        /* Specific focus styles */
        #fullname:focus {
            background-color: #f8f9fa;
        }

        #address:focus {
            background-color: #f8f9fa;
        }

        #dateofbirth:focus {

            background-color: #f8f9fa;
        }

        #placeofbirth:focus {
            background-color: #f8f9fa;
        }

        #civil_status:focus {
            background-color: #f8f9fa;
        }

        #pickup_date:focus {
            background-color: #f8f9fa;
        }

        #purpose:focus {
            background-color: #f8f9fa;
        }

        .gender-group {
            display: flex;
            gap: 15px;
            margin-top: 5px;
            padding: 10px;
            border-radius: var(--border-radius);
        }

        .gender-option {
            display: flex;
            align-items: center;
            gap: 8px;
            cursor: pointer;
        }

        input[type="radio"] {
            width: 18px;
            height: 18px;
            accent-color: var(--secondary-color);
        }

        .submit-btn {
            background: linear-gradient(135deg, var(--success-color), #2ecc71);
            color: white;
            padding: 14px;
            border: none;
            border-radius: var(--border-radius);
            cursor: pointer;
            font-size: 1rem;
            font-weight: 500;
            width: 100%;
            max-width: 280px;
            display: block;
            margin: 30px auto 0;
            text-align: center;
            transition: var(--transition);
            text-transform: uppercase;
            letter-spacing: 0.5px;
            box-shadow: 0 4px 10px rgba(39, 174, 96, 0.3);
        }

        .submit-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(39, 174, 96, 0.4);
        }

        .submit-btn:active {
            transform: translateY(0);
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .form-container {
                padding: 30px 20px;
            }

            .form-row {
                flex-direction: column;
                gap: 15px;
            }

            h1 {
                font-size: 1.6rem;
            }
        }

        @media (max-width: 480px) {
            body {
                padding: 20px 10px;
            }

            .form-container {
                padding: 25px 15px;
            }

            .gender-group {
                flex-direction: column;
                gap: 10px;
            }
        }
    </style>
</head>
<body>
<div class="form-container">
    <h1>Barangay Legal Documents</h1>
    <form action="/BarangayCobolServices/Clearance/submit" method="POST">
        @csrf

        <!-- Tracking Code -->
        <div class="form-group">
            <label for="tracking_code">Tracking Code:</label>
            <input type="text" id="tracking_code" name="tracking_code" readonly value="{{ strtoupper(Str::random(10)) }}">
        </div>

        <!-- Full Name & Address -->
        <div class="form-row">
            <div class="form-group">
                <label for="fullname">Full Name:</label>
                <input type="text" id="fullname" name="fullname" required>
            </div>
            <div class="form-group">
                <label for="address">Address:</label>
                <input type="text" id="address" name="address" required>
            </div>
        </div>

        <!-- Date of Birth & Place of Birth -->
        <div class="form-row">
            <div class="form-group">
                <label for="dateofbirth">Date of Birth:</label>
                <input type="date" id="dateofbirth" name="dateofbirth" required>
            </div>
            <div class="form-group">
                <label for="placeofbirth">Place of Birth:</label>
                <input type="text" id="placeofbirth" name="placeofbirth" required>
            </div>
        </div>

        <!-- Civil Status & Pickup Date -->
        <div class="form-row">
            <div class="form-group">
                <label for="civil_status">Civil Status:</label>
                <select id="civil_status" name="civil_status" required>
                    <option value="">Select Status</option>
                    <option value="Single">Single</option>
                    <option value="Married">Married</option>
                    <option value="Widowed">Widowed</option>
                    <option value="Separated">Separated</option>
                    <option value="Divorced">Divorced</option>
                </select>
            </div>
            <div class="form-group">
                <label for="pickup_date">Pickup Date:</label>
                <input type="date" id="pickup_date" name="pickup_date" required>
            </div>
        </div>

        <!-- Gender -->
        <div class="form-group">
            <label>Gender:</label>
            <div class="gender-group">
                <label class="gender-option"><input type="radio" name="gender" value="male" required> Male</label>
                <label class="gender-option"><input type="radio" name="gender" value="female" required> Female</label>
            </div>
        </div>

        <!-- Purpose -->
        <div class="form-group">
            <label for="purpose">Purpose of Clearance:</label>
            <textarea id="purpose" name="purpose" required></textarea>
        </div>

        <!-- Submit Button -->
        <div class="form-group">
            <button type="submit" class="submit-btn">Submit Request</button>
        </div>
    </form>
</div>
</body>
</html>
