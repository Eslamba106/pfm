<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome to FinexERP</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f7f8fa;
            color: #333;
            padding: 20px;
        }
        .email-container {
            max-width: 600px;
            margin: auto;
            background: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }
        .logo {
            text-align: center;
            margin-bottom: 30px;
        }
        .logo img {
            max-height: 60px;
        }
        h2 {
            color: #1a73e8;
        }
        .details {
            margin-top: 20px;
        }
        .details p {
            line-height: 1.6;
        }
        .footer {
            margin-top: 40px;
            font-size: 12px;
            color: #777;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div style="text-align: right; font-size: 14px; margin-bottom: 10px;">
            <span>Welcome to FinexERP - PFM Management!</span>  
        </div>
        <div class="logo">
            <img src="{{ asset('assets/finexerp_logo.png') }}" alt="FinexERP Logo">
        </div>

        <h2>Welcome to FinexERP - PFM Management!</h2>

        <p>We are excited to have you on board as part of our community.</p>

        <div class="details">
            <p><strong>Your Company ID:</strong> {{ $data['company_id'] }}</p>
            <p><strong>Domain:</strong> {{ $data['domain'] }}</p>
            <p><strong>Username:</strong> {{ $data['user name'] }}</p>
            <p><strong>Password:</strong> {{ $data['password'] }}</p>
        </div>

        <p>Please note that this is an automated email and cannot be responded to.</p>

        <p>If you have any questions or need assistance, feel free to reach out to our support team at 
            <a href="mailto:support@finexerp.com">support@finexerp.com</a>.
        </p>

        <div class="footer">
            Best regards,<br>
            The FinexERP Team
        </div>
    </div>
</body>
</html>
