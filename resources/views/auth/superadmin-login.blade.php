<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{ asset('assets/landing/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/landing/css/custom.css') }}">
    <title>Sign in - SEO</title>
</head>

<body style="display: grid; place-items: center; min-height: 100vh; background-color: #2d0606; flex-wrap: wrap;">
    <main class="main">
        <div class="container">
            <div class="d-flex justify-content-center align-items-center ">
                <form action="{{ route('login-superadmin') }}" class="login-container" method="POST">
                    @csrf
                    <div class="login-card">
                        <div class="login-title">
                            <span class="login-text">Login</span>
                        </div>
                        <div class="login-form">
                            <div class="input-group">
                                <input required name="email" placeholder="Username" class="login-input" type="email" />
                            </div>
                            <div class="input-group">
                                <input required name="password" placeholder="Password" class="login-input" type="password" />
                            </div>
                            <button class="login-btn" type="submit">LOGIN</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </main>
</body>

</html>
