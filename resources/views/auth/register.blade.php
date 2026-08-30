<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Register - Air Ticketing System</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        * { box-sizing: border-box; }
        body {
            margin: 0;
            font-family: -apple-system, "Segoe UI", Roboto, Arial, sans-serif;
            background: #f4f5f7;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 24px;
        }
        .card {
            width: 100%;
            max-width: 460px;
            background: #ffffff;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.08);
        }
        .card__header {
            background: #123821;
            color: #fff;
            text-align: center;
            padding: 32px 24px;
        }
        .card__header h1 { margin: 0 0 6px; font-size: 24px; }
        .card__header p { margin: 0; opacity: 0.8; font-size: 14px; }
        .card__body { padding: 32px 28px; }
        .alert {
            background: #fdecea; color: #a3231f; border: 1px solid #f6c7c5;
            border-radius: 6px; padding: 12px 14px; margin-bottom: 18px; font-size: 14px;
        }
        .alert ul { margin: 0; padding-left: 18px; }
        label { display: block; font-weight: 600; font-size: 14px; color: #123821; margin-bottom: 6px; }
        .field { margin-bottom: 18px; }
        input[type="text"], input[type="email"], input[type="password"] {
            width: 100%; padding: 12px 14px; font-size: 15px;
            border: 1px solid #d7dbe0; border-radius: 6px; outline: none;
        }
        input:focus { border-color: #a79132; }
        button[type="submit"] {
            width: 100%; padding: 13px; background: #123821; color: #fff;
            border: none; border-radius: 6px; font-size: 16px; font-weight: 600; cursor: pointer;
            margin-top: 6px;
        }
        button[type="submit"]:hover { background: #1a5230; }
        .footer-text { text-align: center; margin-top: 20px; font-size: 14px; color: #6b7280; }
        .footer-text a { color: #a79132; font-weight: 600; text-decoration: none; }
        .back-home { display: block; text-align: center; margin-top: 16px; font-size: 13px; color: #9aa0a6; text-decoration: none; }
    </style>
</head>
<body>
    <div class="card">
        <div class="card__header">
            <h1>Create Your Account</h1>
            <p>Register to search, book, and manage your flights</p>
        </div>
        <div class="card__body">
            @if ($errors->any())
                <div class="alert">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="field">
                    <label for="name">Full Name</label>
                    <input type="text" id="name" name="name" value="{{ old('name') }}" required autofocus>
                </div>

                <div class="field">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" required>
                </div>

                <div class="field">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required>
                </div>

                <div class="field">
                    <label for="password_confirmation">Confirm Password</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" required>
                </div>

                <button type="submit">Register</button>
            </form>

            <p class="footer-text">
                Already have an account? <a href="{{ route('login') }}">Log in here</a>
            </p>
        </div>
    </div>

    <a href="{{ url('/') }}" class="back-home">&larr; Back to homepage</a>
</body>
</html>
