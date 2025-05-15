<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container py-5">
        <h2>Welcome, {{ Auth::user()->name }}</h2>
        <p>Email: {{ Auth::user()->email }}</p>
        <img src="{{ Auth::user()->avatar }}" alt="avatar" width="100" class="rounded-circle">
        <br><br>
        <a href="{{ route('logout') }}" class="btn btn-secondary">Logout</a>
    </div>
</body>
</html>
