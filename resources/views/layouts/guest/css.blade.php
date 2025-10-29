
    <style>
        /* HERO */
        .hero {
            padding: 120px 0 80px;
            background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)),
            url('{{ asset(' assets/img/banner.jpg') }}') center center/cover no-repeat;
            color: #fff;
            text-align: center;
        }

        .hero h1 {
            font-weight: 700;
            font-size: 2.8rem;
        }

        .hero p {
            font-size: 1.2rem;
            color: #e0e0e0;
        }

        /* NAVIGATION */
        #navbar ul {
            list-style: none;
            padding: 0;
            margin: 0;
            display: flex;
            align-items: center;
        }

        #navbar ul li {
            position: relative;
            padding: 10px 15px;
        }

        #navbar ul li a {
            color: #012970;
            font-weight: 600;
            text-decoration: none;
            transition: 0.3s;
        }

        #navbar ul li a:hover,
        #navbar ul li a.active {
            color: #4154f1;
        }

        /* SECTION CARD */
        .dashboard-section {
            padding: 60px 0;
        }

        .card-dashboard {
            border: none;
            border-radius: 15px;
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            text-align: center;
            background-color: #fff;
        }

        .card-dashboard:hover {
            transform: translateY(-10px);
        }

        .card-dashboard img {
            width: 100%;
            height: 220px;
            object-fit: cover;
            border-top-left-radius: 15px;
            border-top-right-radius: 15px;
        }

        .card-dashboard i {
            font-size: 3rem;
            color: #0d6efd;
            margin-top: 20px;
        }

        .card-dashboard .btn {
            margin-bottom: 20px;
        }

        footer {
            background-color: #f8f9fa;
            padding: 20px 0;
        }
    </style>