<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FITUC Festival - Application</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans">
    <div class="min-h-screen flex flex-col">
        <nav class="bg-blue-600 text-white py-4">
            <div class="container mx-auto flex justify-between px-4">
                <a href="/" class="text-xl font-bold">FITUC Festival</a>
                <a href="{{ route('applications.index') }}" class="hover:underline">Admin Panel</a>
            </div>
        </nav>

        <div class="container mx-auto px-4 py-6">
            @yield('content')
        </div>
    </div>
</body>
</html>
