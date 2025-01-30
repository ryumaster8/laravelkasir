<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Aplikasi Kasir Modern' }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Global Styles for Dark Theme */
        body {
            background-color: #121212;
            /* Dark background for body */
            color: #e0e0e0;
            /* Light text color */
        }

        /* Header */
        header {
            position: sticky;
            top: 0;
            z-index: 1020;
            background: #1f1f1f;
            /* Dark background for header */
            color: #ffffff;
            /* Light text in header */
            padding: 15px 30px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
            transition: all 0.3s ease;
        }

        header .nav-link {
            color: #e0e0e0;
            /* Light color for navigation links */
            font-weight: bold;
            transition: color 0.3s ease;
            font-size: 1.1rem;
            margin: 0 15px;
        }

        header .nav-link:hover {
            color: #ffdd57;
            /* Highlight color on hover */
        }

        header .nav-item {
            position: relative;
        }

        /* Add underline effect on hover for navigation items */
        header .nav-item:hover::after {
            content: '';
            position: absolute;
            width: 100%;
            height: 2px;
            background-color: #ffdd57;
            bottom: 0;
            left: 0;
            transition: all 0.3s ease;
        }

        /* Hero Section */
        .hero {
            background: url('{{ asset('uploads/intro.jpg') }}') no-repeat center center;
            background-size: cover;
            height: 600px;
            color: #ffffff;
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
            margin: 0 auto;
            box-shadow: inset 0 0 5px rgba(0, 0, 0, 0.8);
            /* Darken the hero background */
        }

        .hero h1 {
            font-size: 3rem;
            font-weight: bold;
            text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.5);
        }

        .hero p {
            font-size: 1.5rem;
            margin-bottom: 20px;
        }

        .hero a {
            margin-top: 20px;
            padding: 12px 24px;
            font-size: 1.2rem;
            border-radius: 30px;
            background-color: #ffdd57;
            /* Yellow button */
            color: #121212;
            text-decoration: none;
            font-weight: bold;
        }

        .hero a:hover {
            background-color: #e0c123;
            /* Darker yellow on hover */
        }

        /* Footer */
        footer {
            background: #1f1f1f;
            /* Dark background for footer */
            color: #ffffff;
            text-align: center;
            padding: 30px 0;
            margin-top: 40px;
            box-shadow: 0 -4px 8px rgba(0, 0, 0, 0.3);
        }

        footer a {
            color: #ffdd57;
            /* Highlight links */
            font-weight: bold;
            text-decoration: none;
        }

        footer a:hover {
            text-decoration: underline;
        }

        /* Dark Mode Form Elements */
        .form-control {
            background-color: #333333;
            /* Dark input fields */
            color: #e0e0e0;
            /* Light text inside input */
            border: 1px solid #444444;
            /* Border color */
        }

        .btn-primary {
            background-color: #ffdd57;
            /* Primary button with yellow */
            border: none;
            color: #121212;
        }

        .btn-primary:hover {
            background-color: #e0c123;
            /* Darker yellow on hover */
        }

        .table {
            background-color: #1f1f1f;
            /* Dark table background */
            color: #e0e0e0;
            /* Light text in table */
        }

        .table th,
        .table td {
            border-color: #333333;
            /* Dark border for table */
        }

        .table-hover tbody tr:hover {
            background-color: #333333;
            /* Darker row on hover */
        }
    </style>
</head>

<body>
    <!-- Header -->
    <header>
        <div class="d-flex justify-content-between align-items-center">
            <h1 class="h3">DigiSoft</h1>
            <nav>
                <ul class="nav">
                    <li class="nav-item">
                        <a href="{{ url('/') }}" class="nav-link">Home</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('/features') }}" class="nav-link">Fitur</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('/membership/details') }}" class="nav-link">Paket</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('/testimonials') }}" class="nav-link">Testimoni</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('/contact') }}" class="nav-link">Hubungi Kami</a>
                    </li>
                </ul>
            </nav>
            <!-- <a href="#cta" class="btn btn-light">Coba Gratis</a> -->
        </div>
    </header>

    <!-- Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer>
        <div>
            <p>© 2025 Aplikasi Kasir Modern. All Rights Reserved.</p>
            <ul class="nav justify-content-center">
                <li class="nav-item"><a href="#" class="nav-link">Facebook</a></li>
                <li class="nav-item"><a href="#" class="nav-link">Twitter</a></li>
                <li class="nav-item"><a href="#" class="nav-link">Instagram</a></li>
            </ul>
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>