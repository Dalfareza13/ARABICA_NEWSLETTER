<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Login Petugas - PLN UP3 JAMBI</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <style>
        :root { 
            --primary: #00a2e9; 
            --dark-blue: #005691; 
            --orange-pln: #ff6600; 
        }
        
        body {
            background: linear-gradient(135deg, var(--dark-blue) 0%, var(--primary) 100%);
            height: 100vh; 
            display: flex; 
            align-items: center; 
            justify-content: center; 
            font-family: 'Roboto', sans-serif;
            margin: 0;
        }

        .login-card {
            background: #ffffff; 
            padding: 40px; 
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2); 
            width: 100%; 
            max-width: 400px;
        }

        .btn-login {
            background-color: var(--orange-pln); 
            color: white; 
            border: none;
            font-weight: bold; 
            width: 100%; 
            padding: 12px; 
            transition: 0.3s;
            border-radius: 50px;
        }

        .btn-login:hover { 
            background-color: #e65c00; 
            color: white; 
            transform: translateY(-2px); 
        }

        .input-group-text {
            background-color: transparent;
            border-right: none;
        }

        .form-control {
            border-left: none;
        }

        .form-control:focus {
            box-shadow: none;
            border-color: #dee2e6;
        }

        /* Tambahan untuk feedback error */
        .is-invalid {
            border-color: #dc3545 !important;
        }
    </style>
</head>
<body>

<div class="login-card">
    <div class="login-logo text-center mb-4">
        <img src="https://upload.wikimedia.org/wikipedia/commons/2/20/Logo_PLN.svg" height="60" alt="Logo PLN">
        <h4 class="mt-3 fw-bold" style="color: #1a237e;">Portal Login Petugas</h4>
        <p class="text-muted small">PLN UP3 JAMBI</p>
    </div>

    @if($errors->any())
        <div class="alert alert-danger text-center small py-2">
            <i class="fas fa-exclamation-circle me-1"></i> {{ $errors->first() }}
        </div>
    @endif

    <form action="{{ route('login.post') }}" method="POST">
    @csrf 
    
    <div class="mb-3">
        <label class="form-label small fw-bold text-muted">Username</label>
        <div class="input-group">
            <span class="input-group-text"><i class="fas fa-user text-primary"></i></span>
            <input type="text" name="username" class="form-control" placeholder="admin" value="{{ old('username') }}" autocomplete="username" required>
        </div>
    </div>

    <div class="mb-4">
        <label class="form-label small fw-bold text-muted">Password</label>
        <div class="input-group">
            <span class="input-group-text"><i class="fas fa-lock text-primary"></i></span>
            <input type="password" name="password" class="form-control" placeholder="••••••••" autocomplete="current-password" required>
        </div>
    </div>

    <button type="submit" class="btn btn-login shadow">MASUK SEKARANG</button>
</form>

   <div class="text-center mt-4">
    <a href="{{ url('/') }}" class="text-decoration-none small text-muted">
        <i class="fas fa-arrow-left"></i> Kembali ke Dashboard
    </a>
</div>
</div>

</body>
</html>