<!DOCTYPE html>
<html lang="en">

<head>
    <?php include("CssLinks.php") ?>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <style>
        :root {
            --primary: #F57C20;
            --primary-dark: #e06b10;
            --secondary: #64748b;
            --bg-gradient: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
            --glass-bg: rgba(255, 255, 255, 0.03);
            --glass-border: rgba(255, 255, 255, 0.1);
        }

        body {
            background: var(--bg-gradient);
            font-family: 'Plus Jakarta Sans', sans-serif;
            height: 100vh;
            overflow: hidden;
            color: #f8fafc;
            margin: 0;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .login-wrapper {
            position: relative;
            height: 100vh;
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            z-index: 10;
        }

        /* Abstract shapes */
        .shape {
            position: absolute;
            border-radius: 50%;
            filter: blur(80px);
            z-index: 1;
            opacity: 0.4;
        }

        .shape-1 {
            width: 400px;
            height: 400px;
            background: var(--primary);
            top: -100px;
            right: -100px;
        }

        .shape-2 {
            width: 300px;
            height: 300px;
            background: #ec4899;
            bottom: -50px;
            left: -50px;
        }

        .login-card {
            background: var(--glass-bg);
            backdrop-filter: blur(20px);
            border: 1px solid var(--glass-border);
            border-radius: 24px;
            padding: 50px 40px;
            width: 100%;
            max-width: 450px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
            animation: slideUp 0.8s cubic-bezier(0.16, 1, 0.3, 1);
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .logo-area {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;

        }

        .logo-area a {
            display: block;
            margin-bottom: 15px;
        }

        .logo-area img {
            height: 60px;
            filter: brightness(0) invert(1);
            margin-bottom: 0px;
        }

        .portal-badge {
            display: inline-block;
            background: rgba(245, 124, 32, 0.1);
            color: var(--primary);
            padding: 6px 16px;
            border-radius: 100px;
            font-size: 0.75rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            border: 1px solid rgba(245, 124, 32, 0.2);
            margin-bottom: 15px;
        }

        h2 {
            font-size: 1.75rem;
            font-weight: 800;
            margin-bottom: 8px;
            color: #fff;
        }

        .subtitle {
            color: #94a3b8;
            font-size: 0.95rem;
            margin-bottom: 35px;
        }

        .form-group {
            margin-bottom: 20px;
            position: relative;
        }

        .form-label {
            display: block;
            font-size: 0.85rem;
            font-weight: 600;
            margin-bottom: 8px;
            color: #cbd5e1;
        }

        .form-control {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 12px;
            padding: 14px 18px;
            color: #fff;
            font-size: 1rem;
            transition: all 0.3s;
            width: 100%;
        }

        .form-control:focus {
            background: rgba(255, 255, 255, 0.08);
            border-color: var(--primary);
            box-shadow: 0 0 0 4px rgba(245, 124, 32, 0.15);
            outline: none;
            color: white;
        }

        .password-toggle-wrapper {
            position: relative;
            display: flex;
            align-items: center;
        }

        .password-toggle-wrapper .form-control {
            padding-right: 50px;
        }

        .toggle-password {
            position: absolute;
            right: 16px;
            cursor: pointer;
            color: #94a3b8;
            font-size: 1.2rem;
            transition: all 0.3s;
            z-index: 10;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100%;
        }

        .toggle-password:hover {
            color: var(--primary);
            transform: scale(1.1);
        }

        .btn-submit {
            background: var(--primary);
            color: white;
            border: none;
            border-radius: 12px;
            padding: 16px;
            font-size: 1rem;
            font-weight: 700;
            width: 100%;
            margin-top: 15px;
            cursor: pointer;
            transition: all 0.3s;
            box-shadow: 0 10px 15px -3px rgba(245, 124, 32, 0.3);
        }

        .btn-submit:hover {
            background: var(--primary-dark);
            transform: translateY(-2px);
            box-shadow: 0 20px 25px -5px rgba(245, 124, 32, 0.4);
        }

        .footer-text {
            text-align: center;
            margin-top: 30px;
            color: #64748b;
            font-size: 0.85rem;
        }

        .footer-text a {
            color: var(--primary);
            text-decoration: none;
            font-weight: 600;
        }

        /* Float animation for shapes */
        @keyframes float {
            0% {
                transform: translate(0, 0);
            }

            50% {
                transform: translate(30px, 30px);
            }

            100% {
                transform: translate(0, 0);
            }
        }

        .shape-1 {
            animation: float 10s infinite ease-in-out;
        }

        .shape-2 {
            animation: float 8s infinite ease-in-out reverse;
        }

        /* Responsive Breakpoints */
        @media (max-width: 576px) {
            .login-card {
                padding: 40px 25px;
                margin: 15px;
            }

            h2 {
                font-size: 1.5rem;
            }

            .shape-1 {
                width: 250px;
                height: 250px;
                top: -50px;
                right: -50px;
            }

            .shape-2 {
                width: 200px;
                height: 200px;
                bottom: -30px;
                left: -30px;
            }
        }
    </style>
</head>

<body>
    <div class="shape shape-1"></div>
    <div class="shape shape-2"></div>

    <div class="login-wrapper">
        <div class="login-card">
            <div class="logo-area">
                <a href="<?= base_url('Home') ?>">
                    <img src="<?= base_url('assets/web_assets/img/gallery/logo.png') ?>" alt="Logo">
                </a>
                <div class="portal-badge">Manager Gateway</div>
                <h2>Manager Login</h2>
                <p class="subtitle">Access your manager dashboard</p>
            </div>

            <form action="<?= base_url('Auth/ManagerAuthentication') ?>" method="POST">
                <div class="form-group">
                    <label class="form-label">Email Address</label>
                    <input type="email" class="form-control" name="email" placeholder="manager@shipperrj.com" required
                        autocomplete="email">
                </div>

                <div class="form-group">
                    <label class="form-label">Password</label>
                    <div class="password-toggle-wrapper">
                        <input type="password" class="form-control" name="password" id="managerPassword"
                            placeholder="••••••••" required>
                        <span class="toggle-password" onclick="togglePasswordVisibility('managerPassword', this)">
                            <i class="mdi mdi-eye-outline"></i>
                        </span>
                    </div>
                </div>

                <button type="submit" class="btn-submit">
                    Sign In as Manager
                </button>
            </form>

            <div class="footer-text">
                Secure access for authorized managers only. <br>
                <a href="<?= base_url('Home') ?>">← Back to Home</a>
            </div>
        </div>
    </div>

    <script>
        function togglePasswordVisibility(inputId, iconElement) {
            const passwordInput = document.getElementById(inputId);
            const icon = iconElement.querySelector('i');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                icon.classList.remove('mdi-eye-outline');
                icon.classList.add('mdi-eye-off-outline');
            } else {
                passwordInput.type = 'password';
                icon.classList.remove('mdi-eye-off-outline');
                icon.classList.add('mdi-eye-outline');
            }
        }
    </script>

    <?php include("JsLinks.php") ?>

    <?php
    if ($this->session->flashdata('res') == 'success') {
        echo '<script>$.notify("' . $this->session->flashdata('msg') . '","success")</script>';
    } else if ($this->session->flashdata('res') == 'error') {
        echo '<script>$.notify("' . $this->session->flashdata('msg') . '","error")</script>';
    }
    ?>
</body>

</html>