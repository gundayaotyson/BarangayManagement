<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Barangay Management System</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <!-- Favicon -->
    <link rel="icon" href="images/cobol logo.png" type="image/png">
    <!-- <link rel="stylesheet" href="{{ asset('css/style.css') }}"> -->
</head>
<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap');
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        text-decoration: none;
        border: none;
        outline: none;
        scroll-behavior: smooth;
        font-family: 'Poppins', sans-serif;
    }
    :root {
        --bg-color: #0B2447;
        --second-bg-color: #19376D;
        --text-color: #fff;
        --main-color: #0092bc;
        --nav-color: #070F2B;
        --box-shadow: 0 0 15px rgba(0, 146, 188, 0.3);
    }

    html {
        font-size: 62.5%;
        overflow-x: hidden;
    }

    body {
        background: var(--bg-color);
        color: var(--text-color);
        line-height: 1.6;
    }

    section {
        min-height: 100vh;
        padding: 10rem 9% 2rem;
    }

    .header {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        background: var(--nav-color);
        padding: 1.5rem 2%;
        display: flex;
        justify-content: space-between;
        align-items: center;
        z-index: 400;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
        transition: all 0.3s ease;
    }

    .header.sticky {
        padding: 1rem 2%;
        border-bottom: .2rem solid var(--main-color);
    }

    .logo {
        display: flex;
        align-items: center;
        font-size: 1.8rem;
        color: var(--text-color);
        font-weight: 600;
        cursor: pointer;
        transition: transform 0.3s ease;
    }

    .logo:hover {
        transform: scale(1.02);
    }

    .logo img {
        width: 85px;
        height: auto;
        margin-right: 10px;
        filter: drop-shadow(0 0 5px rgba(0, 146, 188, 0.5));
    }

    .logo h1 {
        margin-right: 5px;
        font-size: 2.8rem;
        white-space: nowrap;
        text-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
    }

    .navbar a {
        font-size: 1.7rem;
        color: var(--text-color);
        margin-left: 3.5rem;
        transition: all 0.3s ease;
        position: relative;
        font-weight: 500;
    }

    .navbar a:hover,
    .navbar a.active {
        color: var(--main-color);
    }

    .navbar a::after {
        content: '';
        position: absolute;
        width: 0;
        height: 2px;
        background: var(--main-color);
        bottom: -5px;
        left: 0;
        transition: width 0.3s ease;
    }

    .navbar a:hover::after,
    .navbar a.active::after {
        width: 100%;
    }

    #menu-icon {
        font-size: 3.6rem;
        color: var(--text-color);
        display: none;
        cursor: pointer;
        transition: transform 0.3s ease;
    }

    #menu-icon:hover {
        transform: rotate(90deg);
        color: var(--main-color);
    }

    .home {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 5rem;
    }

    .home-content {
        max-width: 600px;
    }

    .carousel-container {
        width: 35vw;
        position: relative;
        overflow: hidden;
        border-radius: 15px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
        height: 400px; /* Fixed height for better consistency */
    }

    .carousel {
        display: flex;
        height: 100%;
        position: relative;
        transition: transform 0.5s ease-in-out;
    }

    .carousel-slide {
        min-width: 100%;
        height: 100%;
    }

    .carousel-slide img {
        width: 100%;
        height: 100%;
        display: block;
        object-fit: cover;
    }

    .carousel-btn {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        background: rgba(0, 146, 188, 0.5);
        color: white;
        border: none;
        width: 4rem;
        height: 4rem;
        font-size: 2rem;
        cursor: pointer;
        border-radius: 50%;
        z-index: 10;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .carousel-btn:hover {
        background: var(--main-color);
        transform: translateY(-50%) scale(1.1);
    }

    .prev {
        left: 2rem;
    }

    .next {
        right: 2rem;
    }

    .carousel-indicators {
        position: absolute;
        bottom: 2rem;
        left: 50%;
        transform: translateX(-50%);
        display: flex;
        gap: 1rem;
        z-index: 10;
    }

    .carousel-indicators span {
        display: block;
        width: 1.2rem;
        height: 1.2rem;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.5);
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .carousel-indicators span.active {
        background: var(--main-color);
        transform: scale(1.2);
    }

    /* Animation */
    @keyframes floatImage {
        0% { transform: translateY(0); }
        50% { transform: translateY(-1.5rem); }
        100% { transform: translateY(0); }
    }

    .carousel-container {
        animation: floatImage 6s ease-in-out infinite;
        filter: drop-shadow(0 10px 20px rgba(0, 146, 188, 0.3));
    }

    .home-content h3 {
        font-size: 3.2rem;
        font-weight: 700;
        margin-bottom: 1rem;
    }

    .home-content h3:nth-of-type(2) {
        margin-bottom: 2rem;
    }

    span {
        color: var(--main-color);
    }

    span.multiple-text {
        font-weight: 700;
        text-shadow: 0 0 10px rgba(0, 146, 188, 0.5);
    }

    .home-content h1 {
        font-size: 5.5rem;
        font-weight: 700;
        line-height: 1.2;
        margin: 1rem 0;
        background: linear-gradient(to right, var(--text-color), var(--main-color));
        -webkit-background-clip: text;
        background-clip: text;
        color: transparent;
    }

    .home-content p {
        font-size: 1.8rem;
        margin-bottom: 2rem;
        color: rgba(255, 255, 255, 0.8);
    }

    .social-media {
        display: flex;
        gap: 1.5rem;
        margin: 2.5rem 0;
    }

    .social-media a {
        display: inline-flex;
        justify-content: center;
        align-items: center;
        width: 4.5rem;
        height: 4.5rem;
        background: rgba(0, 146, 188, 0.1);
        border: .2rem solid var(--main-color);
        border-radius: 50%;
        font-size: 2.2rem;
        color: var(--main-color);
        transition: all 0.5s ease;
    }

    .social-media a:hover {
        background: var(--main-color);
        color: var(--second-bg-color);
        box-shadow: var(--box-shadow);
        transform: translateY(-5px) scale(1.1);
    }

    .btn {
        display: inline-block;
        padding: 1.2rem 3.2rem;
        background: var(--main-color);
        border-radius: 4rem;
        box-shadow: var(--box-shadow);
        font-size: 1.6rem;
        color: var(--second-bg-color);
        letter-spacing: 0.1rem;
        font-weight: 600;
        transition: all 0.5s ease;
        position: relative;
        overflow: hidden;
        z-index: 1;
    }

    .btn::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 0;
        height: 100%;
        background: rgba(255, 255, 255, 0.2);
        transition: width 0.5s ease;
        z-index: -1;
    }

    .btn:hover {
        box-shadow: 0 0 2rem var(--main-color);
        transform: translateY(-3px);
    }

    .btn:hover::before {
        width: 100%;
    }

    .about {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 5rem;
        background: var(--second-bg-color);
    }

    .about-img img {
        width: 35vw;
        border-radius: 10px;
        box-shadow: var(--box-shadow);
        transition: transform 0.5s ease;
    }

    .about-img img:hover {
        transform: scale(1.03);
    }

    .heading {
        text-align: center;
        font-size: 4.5rem;
        margin-bottom: 5rem;
        position: relative;
    }

    .heading::after {
        content: '';
        position: absolute;
        bottom: -1rem;
        left: 50%;
        transform: translateX(-50%);
        width: 100px;
        height: 3px;
        background: var(--main-color);
    }

    .about-content h2 {
        text-align: left;
        line-height: 1.2;
        margin-bottom: 2rem;
    }

    .about-content h3 {
        font-size: 2.6rem;
        margin-bottom: 1.5rem;
        color: var(--main-color);
    }

    .about-content p {
        font-size: 1.7rem;
        margin: 1.5rem 0;
        color: rgba(255, 255, 255, 0.8);
    }

    .about-content ul {
        font-size: 1.7rem;
        margin: 2rem 0 3rem;
        margin-left: 2rem;
        list-style-type: none;
    }

    .about-content ul li {
        position: relative;
        padding-left: 2.5rem;
        margin-bottom: 1rem;
    }

    .about-content ul li::before {
        content: '✓';
        position: absolute;
        left: 0;
        color: var(--main-color);
        font-weight: bold;
    }

    .products h2 {
        margin-bottom: 5rem;
    }

    .products-container {
        display: flex;
        justify-content: center;
        align-items: stretch;
        flex-wrap: wrap;
        gap: 3rem;
    }

    .products-box,
    .products-box1,
    .products-box2 {
        flex: 1 1 30rem;
        background: var(--second-bg-color);
        padding: 3rem 2rem 4rem;
        border-radius: 2rem;
        text-align: center;
        border: 0.2rem solid var(--bg-color);
        transition: all 0.5s ease;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: space-between;
        min-height: 380px;
    }

    .products-box:hover,
    .products-box1:hover,
    .products-box2:hover {
        border-color: var(--main-color);
        transform: translateY(-10px);
        box-shadow: var(--box-shadow);
    }

    .products-box i,
    .products-box1 i,
    .products-box2 i {
        font-size: 7rem;
        color: var(--main-color);
        margin-bottom: 2rem;
        transition: transform 0.3s ease;
    }

    .products-box:hover i,
    .products-box1:hover i,
    .products-box2:hover i {
        transform: scale(1.1);
    }

    .products-box h3,
    .products-box1 h3,
    .products-box2 h3 {
        font-size: 2.6rem;
        margin-bottom: 1.5rem;
    }

    .products-box p,
    .products-box1 p,
    .products-box2 p {
        font-size: 1.6rem;
        margin: 1rem 0 3rem;
        color: rgba(255, 255, 255, 0.7);
    }

    .more {
        background: var(--second-bg-color);
    }

    .more h2 {
        margin-bottom: 4rem;
    }

    .more-container {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        align-items: center;
        gap: 2.5rem;
    }

    .more-box {
        position: relative;
        border-radius: 1rem;
        box-shadow: 0 0 1rem var(--bg-color);
        overflow: hidden;
        display: flex;
        height: 250px;
        transition: all 0.5s ease;
    }

    .more-box:hover {
        transform: translateY(-10px);
        box-shadow: var(--box-shadow);
    }

    .more-box img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: .5s ease;
    }

    .more-box:hover img {
        transform: scale(1.1);
    }

    .more-layer {
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(rgba(0, 0, 0, 0.1), var(--main-color));
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
        text-align: center;
        padding: 0 4rem;
        transform: translateY(100%);
        transition: .5s ease;
    }

    .more-box:hover .more-layer {
        transform: translateY(0);
    }

    .more-layer h4 {
        font-size: 2.5rem;
        margin-bottom: 1rem;
    }

    .more-layer p {
        font-size: 1.4rem;
        margin: 0.5rem 0 1.5rem;
    }

    .more-layer a {
        display: inline-flex;
        justify-content: center;
        align-items: center;
        width: 4rem;
        height: 4rem;
        background: var(--text-color);
        border-radius: 50%;
        transition: all 0.3s ease;
    }

    .more-layer a:hover {
        transform: rotate(360deg);
    }

    .more-layer a i {
        font-size: 2rem;
        color: var(--second-bg-color);
    }

    /* Tracking Section Styles */
    .tracking {
        padding: 4rem;
        background: linear-gradient(to bottom, var(--bg-color), var(--second-bg-color));
        border-radius: 12px;
        margin: 4rem auto;
        max-width: 900px;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.2);
    }

    .tracking-container {
        width: 100%;
    }

    .tracking h2 {
        text-align: center;
        color: var(--text-color);
        margin-bottom: 2.5rem;
        font-size: 3.5rem;
    }

    .tracking-form {
        display: flex;
        justify-content: center;
        margin-bottom: 3rem;
    }

    .input-group {
        display: flex;
        width: 100%;
        max-width: 600px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        border-radius: 8px;
        overflow: hidden;
    }

    #tracking-code {
        flex: 1;
        padding: 1.5rem 2rem;
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 8px 0 0 8px;
        font-size: 1.6rem;
        background: rgba(255, 255, 255, 0.1);
        color: var(--text-color);
        transition: all 0.3s ease;
    }

    #tracking-code::placeholder {
        color: rgba(255, 255, 255, 0.6);
    }

    #tracking-code:focus {
        background: rgba(255, 255, 255, 0.15);
        outline: none;
    }

    .track-button {
        padding: 0 3rem;
        background: var(--main-color);
        color: white;
        border: none;
        border-radius: 0 8px 8px 0;
        cursor: pointer;
        font-size: 1.6rem;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .track-button:hover {
        background: #00a8e8;
        box-shadow: 0 0 10px rgba(0, 146, 188, 0.5);
    }

    /* Tracking Result Table Styles */
    #trackingResult {
        margin-top: 2.5rem;
        transition: all 0.3s ease;
    }

    #trackingResult h3 {
        font-size: 2.2rem;
        margin-bottom: 1.5rem;
        color: var(--main-color);
        text-align: center;
    }

    .result-table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 1.5rem;
        background: rgba(255, 255, 255, 0.05);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        border-radius: 8px;
        overflow: hidden;
    }

    .result-table th {
        background: var(--main-color);
        color: white;
        padding: 1.5rem;
        text-align: left;
        font-size: 1.6rem;
    }

    .result-table td {
        padding: 1.5rem;
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        font-size: 1.5rem;
        color: var(--text-color);
    }

    .result-table tr:last-child td {
        border-bottom: none;
    }

    .result-table tr:nth-child(even) {
        background: rgba(255, 255, 255, 0.03);
    }

    .result-table tr:hover {
        background: rgba(255, 255, 255, 0.07);
    }

    .no-result, .error-message {
        text-align: center;
        padding: 2rem;
        border-radius: 8px;
        font-size: 1.6rem;
        margin-top: 2rem;
    }

    .no-result {
        color: #e74c3c;
        background: rgba(231, 76, 60, 0.1);
        border: 1px solid rgba(231, 76, 60, 0.3);
    }

    .error-message {
        color: #e74c3c;
        background: rgba(231, 76, 60, 0.1);
        border: 1px solid rgba(231, 76, 60, 0.3);
    }

    .contact h2 {
        margin-bottom: 3rem;
    }

    .contact form {
        max-width: 70rem;
        margin: 1rem auto;
        text-align: center;
        margin-bottom: 3rem;
        background: rgba(255, 255, 255, 0.05);
        padding: 3rem;
        border-radius: 12px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    }

    .contact form .input-box {
        display: flex;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 1.5rem;
        margin-bottom: 1.5rem;
    }

    .contact form .input-box input,
    .contact form textarea {
        width: 100%;
        padding: 1.5rem;
        font-size: 1.6rem;
        color: var(--text-color);
        background: rgba(255, 255, 255, 0.05);
        border-radius: .8rem;
        margin: .7rem 0;
        transition: all 0.3s ease;
        border: 1px solid rgba(255, 255, 255, 0.1);
    }

    .contact form .input-box input::placeholder,
    .contact form textarea::placeholder {
        color: rgba(255, 255, 255, 0.6);
    }

    .contact form .input-box input:focus,
    .contact form textarea:focus {
        border-color: var(--main-color);
        box-shadow: 0 0 10px rgba(0, 146, 188, 0.3);
        background: rgba(255, 255, 255, 0.1);
    }

    .contact form .input-box input {
        width: 48%;
    }

    .contact form textarea {
        resize: none;
        height: 20rem;
    }

    .contact form .btn {
        margin-top: 2rem;
        cursor: pointer;
    }

    /* Map Container Improvements */
    .map-container {
        width: 100%;
        max-width: 1000px;
        height: 500px;
        margin: 40px auto;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
        transition: all 0.3s ease;
        border: 3px solid var(--main-color);
    }

    .map-container:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 30px rgba(0, 146, 188, 0.4);
    }

    .map-container iframe {
        width: 100%;
        height: 100%;
        border: none;
    }

    .footer {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        padding: 2rem 9%;
        background: var(--nav-color);
        border-top: 1px solid rgba(255, 255, 255, 0.1);
    }

    .footer-text p {
        font-size: 1.6rem;
        color: rgba(255, 255, 255, 0.7);
    }

    .footer-iconTop a {
        display: inline-flex;
        justify-content: center;
        align-items: center;
        padding: 1rem;
        background: var(--main-color);
        border-radius: .8rem;
        transition: .5s ease;
    }

    .footer-iconTop a:hover {
        box-shadow: var(--box-shadow);
        transform: translateY(-5px);
    }

    .footer-iconTop a i {
        font-size: 2.4rem;
        color: var(--second-bg-color);
    }

    /* Loading Animation */
    .loading {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: var(--bg-color);
        display: flex;
        justify-content: center;
        align-items: center;
        z-index: 9999;
        transition: opacity 0.5s ease;
    }

    .loading-spinner {
        width: 60px;
        height: 60px;
        border: 5px solid rgba(0, 146, 188, 0.3);
        border-radius: 50%;
        border-top-color: var(--main-color);
        animation: spin 1s ease-in-out infinite;
    }

    @keyframes spin {
        to { transform: rotate(360deg); }
    }

    /* Responsive Design */
    @media (max-width: 1200px) {
        html {
            font-size: 55%;
        }

        .more-container {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 991px) {
        .header {
            padding: 2rem 3%;
        }

        section {
            padding: 10rem 3% 2rem;
        }

        .products {
            padding-bottom: 7rem;
        }

        .more {
            padding-bottom: 7rem;
        }

        .contact {
            min-height: auto;
        }

        .footer {
            padding: 2rem 3%;
        }

        .carousel-container {
            width: 45vw;
        }
    }

    @media (max-width: 768px) {
        #menu-icon {
            display: block;
        }

        .navbar {
            position: absolute;
            top: 100%;
            left: 0;
            width: 100%;
            padding: 1rem 3%;
            background: var(--bg-color);
            border-top: .1rem solid rgba(0, 0, 0, .2);
            box-shadow: 0 .5rem 1rem rgba(0, 0, 0, .2);
            display: none;
            z-index: 1000;
        }

        .navbar.active {
            display: block;
        }

        .navbar a {
            display: block;
            font-size: 2rem;
            margin: 3rem 0;
        }

        .home {
            flex-direction: column;
            text-align: center;
        }

        .home-content h3 {
            font-size: 2.6rem;
        }

        .home-content h1 {
            font-size: 5rem;
        }

        .carousel-container {
            width: 70vw;
            margin-top: 4rem;
        }

        .about {
            flex-direction: column-reverse;
            text-align: center;
        }

        .about-img img {
            width: 70vw;
            margin-top: 4rem;
        }

        .about-content h2 {
            text-align: center;
        }

        .products h2 {
            margin-bottom: 3rem;
        }

        .more h2 {
            margin-bottom: 3rem;
        }

        .tracking {
            padding: 3rem 2rem;
        }
    }

    @media (max-width: 617px) {
        .more-container {
            grid-template-columns: 1fr;
        }

        .contact form .input-box input {
            width: 100%;
        }

        .tracking h2 {
            font-size: 3rem;
        }
    }

    @media (max-width: 450px) {
        html {
            font-size: 50%;
        }

        .home-content h1 {
            font-size: 4.5rem;
        }

        .carousel-container {
            width: 90vw;
        }

        .tracking {
            padding: 2rem 1.5rem;
        }
    }

    @media (max-width: 365px) {
        .carousel-container {
            width: 90vw;
        }

        .about-img img {
            width: 90vw;
        }

        .footer {
            flex-direction: column-reverse;
            gap: 2rem;
        }

        .footer p {
            text-align: center;
            margin-top: 2rem;
        }
    }
</style>
<body>
    <!-- Loading Screen -->
    <div class="loading">
        <div class="loading-spinner"></div>
    </div>

    <header class="header">
        <div class="logo">
            <img src="images/cobol logo small.png" alt="Barangay Cobol Logo">
            <h1>Barangay Cobol San Carlos City</h1>
        </div>
        <i class='bx bx-menu' id="menu-icon"></i>
        <nav class="navbar">
            <a href="#home" class="active">Home</a>
            <a href="#about">About</a>
            <a href="#products">Services</a>
            <a href="#more">Map</a>
            <a href="#contact">Contact</a>
            <a href="#tracking">Track Doc</a>
            <a href="/login">Login</a>
        </nav>
    </header>

    <section class="home" id="home">
        <div class="home-content" id="bslur">
            <h3>Welcome to</h3>
            <h1>Barangay Cobol <br>San Carlos City, Pangasinan!</h1>
            <h3>Service at <span class="multiple-text"></span></h3>
            <p>Open hours of our service: Monday to Friday | 8:00 AM to 5:00 PM </p>

            <h2>Contact us on</h2>
            <div class="social-media">
                <a href="https://www.facebook.com/profile.php?id=100069068354959"><i class='bx bxl-facebook'></i></a>
                <!-- <a href="#"><i class='bx bxl-youtube'></i></a>
                <a href="#"><i class='bx bxl-instagram'></i></a>
                <a href="#"><i class='bx bxl-tiktok'></i></a> -->
            </div>
            <a href="#about" onclick="toggle()" class="btn">ABOUT!</a>
        </div>

        <div class="carousel-container">
            <div class="carousel">
                <div class="carousel-slide active">
                    <img src="images/brgyhall.jpg" alt="Barangay Hall Front View">
                </div>
                <div class="carousel-slide">
                    <img src="images/healthcenter.png" alt="Barangay Office Interior">
                </div>
                <div class="carousel-slide">
                    <img src="images/hallpic1.jpg" alt="Barangay Community Event">
                </div>
                <div class="carousel-slide">
                    <img src="images/flag.jpg" alt="flag Event">
                </div>
                <div class="carousel-slide">
                    <img src="images/nighthall.jpg" alt="Barangay hall Event">
                </div>

                <!-- Navigation Arrows -->
                <button class="carousel-btn prev" aria-label="Previous slide"><i class='bx bx-chevron-left'></i></button>
                <button class="carousel-btn next" aria-label="Next slide"><i class='bx bx-chevron-right'></i></button>

                <!-- Indicators -->
                <div class="carousel-indicators"></div>
            </div>
        </div>
    </section>

    <section class="about" id="about">
        <!-- <div class="about-img">
            <img src="models.png" alt="About Barangay Cobol">
        </div> -->
        <div class="about-content">
            <h2 class="heading">About <span class="multiple-text1"></span></h2>
            <h3>Welcome to the official website of Barangay Cobol!</h3>
            <p>To the official website of Barangay Cobol, a vibrant and progressive community located in the heart of Pangasinan.<br> Our Barangay has a rich history and a strong commitment to fostering a safe, inclusive, and sustainable environment for all residents.</p>
            <p>At Barangay Cobol, we believe in empowering our community through transparent governance, active participation, and collaborative efforts. Our local leadership is dedicated to addressing the needs of our citizens, ensuring access to essential services, and promoting initiatives that contribute to the growth and well-being of everyone within our jurisdiction.</p>
            <p>Our website offers a convenient platform for you to request and access the legal documents you need without the hassle of long lines or multiple visits. With the help of modern technology, we aim to deliver services that are efficient, secure, and user-friendly. Our team is dedicated to ensuring that all requests are processed promptly and accurately.</p>
            <p>At Barangay Cobol, we are here to serve you. Your trust is important to us, and we are continuously improving our services to meet your needs.</p>
            <ul>
                <li>Barangay Clearance</li>
                <li>Certificate of Indigency</li>
                <li>Barangay Certification</li>
                <li>And other legal documents</li>
            </ul>
            <a href="#" class="btn">Read More</a>
        </div>
    </section>

    <section class="products" id="products">
        <h2 class="heading">Our <span class="multiple-text2"></span></h2>
        <div class="products-container">
            <div class="products-box">
                <i class='bx bx-file'></i>
                <h3>Barangay Clearance</h3>
                <p>Request your official Barangay Clearance for various transactions</p>
                <a href="{{ route('brgyclearance') }}" class="btn">Proceed</a>
            </div>

            <div class="products-box1">
                <i class='bx bx-id-card'></i>
                <h3>Barangay Indigency</h3>
                <p>Obtain a Certificate of Indigency for social welfare purposes</p>
                <a href="{{ route('brgyindigencyform') }}" class="btn">Proceed</a>
            </div>

            <div class="products-box2">
                <i class='bx bx-building-house'></i>
                <h3>Barangay Permit</h3>
                <p>Apply for business permits and other necessary clearances</p>
                <a href="#" class="btn">Proceed</a>
            </div>
            @foreach($services as $service)
                <div class="products-box">
                    <!-- Optionally, add an icon if needed -->
                    <i class="bx bx-file"></i> <!-- You can customize icons later -->
                    <h3>{{ $service->name }}</h3>
                    <p>{{ $service->description }}</p>
                    <button class="btn" onclick="alert('You selected {{ $service->name }}')">Proceed</button> <!-- Simple alert or action -->
                </div>
            @endforeach
        </div>
    </section>

    <section class="tracking" id="tracking">
        <div class="tracking-container">
            <h2>Track Your Document Request</h2>
            <form class="tracking-form" id="trackingForm">
                <div class="input-group">
                    <input
                        type="text"
                        id="tracking-code"
                        name="tracking-code"
                        placeholder="Enter your tracking number"
                        required
                    >
                    <button type="submit" class="track-button">Track Now</button>
                </div>
            </form>
            <div id="trackingResult"></div> <!-- This will display the result -->
        </div>
    </section>

    <section class="more" id="more">
        <!-- <h2 class="heading">Why choose us?</h2>
        <div class="more-container">
            <div class="more-box">
                <img src="https://via.placeholder.com/400x250/19376D/FFFFFF?text=Authentic+Documents" alt="Authentic Assurance">
                <div class="more-layer">
                    <i class='bx bxs-diamond'></i>
                    <h4>Authentic Assurance</h4>
                    <p>100% Genuine Documents with official seals and signatures</p>
                </div>
            </div>

            <div class="more-box">
                <img src="https://via.placeholder.com/400x250/19376D/FFFFFF?text=Fast+Processing" alt="Fast Processing">
                <div class="more-layer">
                    <i class='bx bx-time-five'></i>
                    <h4>Fast Processing</h4>
                    <p>Quick turnaround time for all your document requests</p>
                </div>
            </div>

            <div class="more-box">
                <img src="https://via.placeholder.com/400x250/19376D/FFFFFF?text=Online+Services" alt="Online Services">
                <div class="more-layer">
                    <i class='bx bx-globe'></i>
                    <h4>Online Services</h4>
                    <p>Convenient online requests and status tracking</p>
                </div>
            </div>
        </div> -->

        <div class="map-container">
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3858.6427481036984!2d120.3911693!3d15.9000811!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x339145a86e729fef%3A0xdf1a4ea2f8e318d9!2sCobol%20National%20High%20School!5e0!3m2!1sen!2sph!4v1710482842906!5m2!1sen!2sph"
                width="100%"
                height="500"
                style="border:0; border-radius: 12px;"
                allowfullscreen=""
                loading="lazy">
            </iframe>
        </div>
    </section>

    <section class="contact" id="contact">
        <h2 class="heading">Contact <span class="multiple-text4"></span></h2>
        <form action="#">
            <div class="input-box">
                <input type="text" placeholder="Full Name" required>
                <input type="email" placeholder="Email Address" required>
            </div>
            <div class="input-box">
                <input type="number" placeholder="Mobile Number" required>
                <input type="text" placeholder="Email Subject" required>
            </div>
            <textarea name="" id="" cols="30" rows="10" placeholder="Your Message" required></textarea>
            <input type="submit" value="Send Message" class="btn">
        </form>
    </section>

    <footer class="footer">
        <div class="footer-text">
            <p>Copyright &copy; 2025 by Barangay Cobol San Carlos City Pangasinan | All Rights Reserved.</p>
        </div>
        <div class="footer-iconTop">
            <a href="#home"><i class='bx bx-up-arrow-alt'></i></a>
        </div>
    </footer>

    <script src="https://unpkg.com/scrollreveal"></script>
    <script src="https://unpkg.com/typed.js@2.0.16/dist/typed.umd.js"></script>

    @yield('content')
      <!-- trackingCode -->
      <script>
    document.getElementById('trackingForm').addEventListener('submit', function(event) {
        event.preventDefault(); // Prevent form submission

        var trackingCode = document.getElementById('tracking-code').value;

        if (trackingCode) {
            // Show loading indicator
            document.getElementById('trackingResult').innerHTML = `
                <div style="text-align: center; padding: 2rem;">
                    <div class="loading-spinner" style="margin: 0 auto; width: 40px; height: 40px;"></div>
                    <p style="margin-top: 1rem; color: var(--main-color);">Searching for your document...</p>
                </div>
            `;

            // Send AJAX request
            fetch(`/track-clearance/${trackingCode}`)
                .then(response => response.json())
                .then(data => {
                    const resultContainer = document.getElementById('trackingResult');

                    if (data.success) {
                        let result = `
                            <h3>Requested Document Information</h3>
                            <table class="result-table">
                                <thead>
                                    <tr>
                                        <th>Field</th>
                                        <th>Value</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><strong>Full Name</strong></td>
                                        <td>${data.fullname}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Service Type</strong></td>
                                        <td>${data.service_type}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Requested Date</strong></td>
                                        <td>${data.request_date}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Pick-up Date</strong></td>
                                        <td>${data.pickup_date || 'Not specified'}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Status</strong></td>
                                        <td>
                                            <span style="
                                                padding: 0.5rem 1rem;
                                                border-radius: 4px;
                                                background: ${getStatusColor(data.status)};
                                                color: white;
                                                font-weight: 500;
                                                display: inline-block;
                                                min-width: 120px;
                                                text-align: center;
                                            ">${data.status}</span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        `;
                        resultContainer.innerHTML = result;
                    } else {
                        resultContainer.innerHTML = `<div class="no-result">No record found for tracking code: ${trackingCode}</div>`;
                    }
                })
                .catch(error => {
                    document.getElementById('trackingResult').innerHTML = `
                        <div class="error-message">Error: ${error.message || 'An error occurred while fetching tracking information'}</div>
                    `;
                });
        } else {
            alert('Please enter a valid tracking code');
        }
    });

    // Helper function to get status color - CUSTOMIZE COLORS HERE
    function getStatusColor(status) {
        if (!status) return '#3498db'; // Default gray for null/undefined

        switch(status.toLowerCase()) {
            // You can change these hex color codes to your preferred colors
            case 'pending':
                return '#e74c3c';  // Red
            case 'processing':
                return '#f39c12';  // Orange
            case 'ready for pickup':
                return '#3498db';  // Blue
            case 'released':       // Note: lowercase comparison
                return '#2ecc71';  // Green
            default:
                return '#3498db';  // Gray
        }
    }
</script>
    <script>
        // Loading screen
        window.addEventListener('load', function() {
            const loading = document.querySelector('.loading');
            setTimeout(() => {
                loading.style.opacity = '0';
                setTimeout(() => {
                    loading.style.display = 'none';
                }, 500);
            }, 1000);
        });

        document.addEventListener('DOMContentLoaded', () => {
            console.log('DOM fully loaded and parsed');

            let menuIcon = document.querySelector('#menu-icon');
            let navbar = document.querySelector('.navbar');

            // Toggle menu icon and navbar
            menuIcon.onclick = () => {
                menuIcon.classList.toggle('bx-x');
                navbar.classList.toggle('active');
            };

            let sections = document.querySelectorAll('section');
            let navLinks = document.querySelectorAll('header nav a');

            // Handle scrolling and highlight nav links
            window.onscroll = () => {
                sections.forEach(sec => {
                    let top = window.scrollY;
                    let offset = sec.offsetTop - 150;
                    let height = sec.offsetHeight;
                    let id = sec.getAttribute('id');

                    if (top >= offset && top < offset + height) {
                        navLinks.forEach(links => {
                            links.classList.remove('active');
                            let currentLink = document.querySelector(`header nav a[href*="${id}"]`);
                            if (currentLink) currentLink.classList.add('active');
                        });
                    }
                });

                let header = document.querySelector('header');
                header.classList.toggle('sticky', window.scrollY > 100);

                // Close menu on scroll
                menuIcon.classList.remove('bx-x');
                navbar.classList.remove('active');
            };

            // ScrollReveal animations
            ScrollReveal({
                reset: true,
                distance: '80px',
                duration: 2000,
                delay: 200
            });

            ScrollReveal().reveal('.home-content, .heading', { origin: 'top' });
            ScrollReveal().reveal('.carousel-container, .products-container, .more-box, .contact form', { origin: 'bottom' });
            ScrollReveal().reveal('.home-content h1, .about-img', { origin: 'left' });
            ScrollReveal().reveal('.home-content p, .about-content', { origin: 'right' });

            // Typed.js animations
            const typed = new Typed('.multiple-text', {
                strings: ['Purok 1', 'Purok 2', 'Purok 3'],
                typeSpeed: 100,
                backSpeed: 100,
                backDelay: 1000,
                loop: true
            });

            const type = new Typed('.multiple-text1', {
                strings: ['Us'],
                typeSpeed: 100,
                backSpeed: 100,
                backDelay: 1000,
                loop: true
            });

            const typ = new Typed('.multiple-text2', {
                strings: ['Services!'],
                typeSpeed: 100,
                backSpeed: 100,
                backDelay: 1000,
                loop: true
            });

            const ty = new Typed('.multiple-text3', {
                strings: ['Project'],
                typeSpeed: 100,
                backSpeed: 100,
                backDelay: 1000,
                loop: true
            });

            const t = new Typed('.multiple-text4', {
                strings: ['Us!'],
                typeSpeed: 100,
                backSpeed: 100,
                backDelay: 1000,
                loop: true
            });

            // Smooth scrolling for all links
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function (e) {
                    e.preventDefault();
                    document.querySelector(this.getAttribute('href')).scrollIntoView({
                        behavior: 'smooth'
                    });
                });
            });
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const carousel = document.querySelector('.carousel');
            const slides = document.querySelectorAll('.carousel-slide');
            const prevBtn = document.querySelector('.prev');
            const nextBtn = document.querySelector('.next');
            const indicatorsContainer = document.querySelector('.carousel-indicators');
            let currentIndex = 0;
            let intervalId;

            // Create indicators
            slides.forEach((_, index) => {
                const indicator = document.createElement('span');
                if (index === 0) indicator.classList.add('active');
                indicator.addEventListener('click', () => goToSlide(index));
                indicatorsContainer.appendChild(indicator);
            });

            const indicators = document.querySelectorAll('.carousel-indicators span');

            // Update carousel display
            function updateCarousel() {
                // Use transform for better performance
                for (let i = 0; i < slides.length; i++) {
                    slides[i].style.transform = `translateX(${(i - currentIndex) * 100}%)`;
                }

                // Update indicators
                indicators.forEach((indicator, index) => {
                    indicator.classList.toggle('active', index === currentIndex);
                });
            }

            // Initial setup - position all slides
            for (let i = 0; i < slides.length; i++) {
                slides[i].style.position = 'absolute';
                slides[i].style.width = '100%';
                slides[i].style.height = '100%';
                slides[i].style.transition = 'transform 0.5s ease-in-out';
                slides[i].style.transform = `translateX(${(i - currentIndex) * 100}%)`;
            }

            // Go to specific slide
            function goToSlide(index) {
                currentIndex = index;
                updateCarousel();
                resetInterval();
            }

            // Next slide
            function nextSlide() {
                currentIndex = (currentIndex + 1) % slides.length;
                updateCarousel();
                resetInterval();
            }

            // Previous slide
            function prevSlide() {
                currentIndex = (currentIndex - 1 + slides.length) % slides.length;
                updateCarousel();
                resetInterval();
            }

            // Auto-rotate slides
            function startInterval() {
                intervalId = setInterval(nextSlide, 5000); // Change slide every 5 seconds
            }

            // Reset interval when user interacts
            function resetInterval() {
                clearInterval(intervalId);
                startInterval();
            }

            // Event listeners
            if (prevBtn) prevBtn.addEventListener('click', prevSlide);
            if (nextBtn) nextBtn.addEventListener('click', nextSlide);

            // Pause on hover
            carousel.addEventListener('mouseenter', () => clearInterval(intervalId));
            carousel.addEventListener('mouseleave', startInterval);

            // Touch support for mobile
            let touchStartX = 0;
            let touchEndX = 0;

            carousel.addEventListener('touchstart', (e) => {
                touchStartX = e.changedTouches[0].screenX;
                clearInterval(intervalId);
            });

            carousel.addEventListener('touchend', (e) => {
                touchEndX = e.changedTouches[0].screenX;
                handleSwipe();
                startInterval();
            });

            function handleSwipe() {
                if (touchEndX < touchStartX - 50) nextSlide(); // Swipe left
                if (touchEndX > touchStartX + 50) prevSlide(); // Swipe right
            }

            // Initialize
            updateCarousel();
            startInterval();
        });
    </script>
</body>
</html>
