<!DOCTYPE html>
<html lang="en" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($title) ? $title : 'Malshoes - Premium Shoe Store'; ?></title>
    <!-- Web Icon -->
    <link rel="website icon" type="image/png" href="<?php echo BASE_URL; ?>assets/img/logo.png">
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Bootstrap 5 CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome 6 CDN -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    
    <!-- DataTables Bootstrap 5 CSS CDN -->
    <link href="https://cdn.datatables.net/1.13.5/css/dataTables.bootstrap5.min.css" rel="stylesheet">

    <!-- Theme CSS Variables & Custom styles -->
    <style>
        :root, html[data-theme="light"] {
            --bg-primary: #f8f9fa;
            --bg-card: #ffffff;
            --text-color: #212529;
            --text-muted: #6c757d;
            --sidebar-bg: #212529;
            --sidebar-text: #f8f9fa;
            --accent-color: #028391;
            --accent-hover: #015c67;
            --border-color: #dee2e6;
        }
        
        html[data-theme="dark"] {
            --bg-primary: #121212;
            --bg-card: #1e1e1e;
            --text-color: #f8f9fa;
            --text-muted: #a0a0a0;
            --sidebar-bg: #0f0f0f;
            --sidebar-text: #f8f9fa;
            --accent-color: #0dcaf0;
            --accent-hover: #0aa2c0;
            --border-color: #383838;
        }

        body {
            background-color: var(--bg-primary) !important;
            color: var(--text-color) !important;
            font-family: 'Poppins', sans-serif;
            transition: background-color 0.3s, color 0.3s;
        }

        .card, .box-login-content, .box-register-content, .box-content, .content-bawah {
            background-color: var(--bg-card) !important;
            border-color: var(--border-color) !important;
            color: var(--text-color) !important;
        }

        .text-muted {
            color: var(--text-muted) !important;
        }

        .border, hr, th, td, .form-control {
            border-color: var(--border-color) !important;
        }

        .form-control, .form-select {
            background-color: var(--bg-card) !important;
            color: var(--text-color) !important;
        }

        /* Sidebar styles */
        .sidebar {
            width: 270px;
            background-color: var(--sidebar-bg);
            color: var(--sidebar-text);
            position: fixed;
            height: 100vh;
            overflow-y: auto;
            padding: 20px;
            transition: background-color 0.3s, width 0.3s;
            z-index: 1000;
        }

        .sidebar-item {
            color: var(--sidebar-text);
            text-decoration: none;
            display: flex;
            align-items: center;
            padding: 10px 15px;
            border-radius: 8px;
            margin-bottom: 5px;
            transition: 0.2s;
        }

        .sidebar-item:hover, .active-sidebar-item {
            background-color: var(--accent-color);
            color: #ffffff !important;
        }

        .main-content {
            margin-left: 270px;
            padding: 30px;
            min-height: 100vh;
            transition: margin-left 0.3s;
        }

        /* Navbar details for Customer */
        .custom-navbar {
            background-color: var(--bg-card);
            border-bottom: 1px solid var(--border-color);
        }

        .custom-navbar .nav-link {
            color: var(--text-color);
            font-weight: 500;
        }

        .custom-navbar .nav-link:hover, .custom-navbar .nav-link.active {
            color: var(--accent-color);
        }

        /* DataTables Custom Theme Colors Overrides */
        .dataTables_wrapper .dataTables_length, 
        .dataTables_wrapper .dataTables_filter, 
        .dataTables_wrapper .dataTables_info, 
        .dataTables_wrapper .dataTables_processing, 
        .dataTables_wrapper .dataTables_paginate {
            color: var(--text-color) !important;
        }
        
        .page-link {
            background-color: var(--bg-card) !important;
            color: var(--text-color) !important;
            border-color: var(--border-color) !important;
        }
        
        .active > .page-link {
            background-color: var(--accent-color) !important;
            border-color: var(--accent-color) !important;
            color: #ffffff !important;
        }

        /* Mobile Responsiveness media queries */
        @media (max-width: 991.98px) {
            .sidebar {
                width: 100%;
                height: auto;
                position: relative;
            }
            .main-content {
                margin-left: 0;
                padding: 15px;
            }
            .sidebar-item {
                padding: 8px 12px;
            }
        }
    </style>
    <script>
        // Immediately apply saved theme to avoid flickering
        (function() {
            const theme = localStorage.getItem('malshoes_theme') || 'light';
            document.documentElement.setAttribute('data-theme', theme);
        })();
    </script>
</head>
<body>
