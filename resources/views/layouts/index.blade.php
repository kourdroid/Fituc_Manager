<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    <!-- Animation library -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" rel="stylesheet">
    
    <style>
        /* Custom animations */
        .slide-in-left {
            animation: slideInLeft 0.5s ease-out;
        }
        
        .slide-out-right {
            animation: slideOutRight 0.5s ease-in;
        }
        
        @keyframes slideInLeft {
            0% {
                transform: translateX(-100px);
                opacity: 0;
            }
            100% {
                transform: translateX(0);
                opacity: 1;
            }
        }
        
        @keyframes slideOutRight {
            0% {
                transform: translateX(0);
                opacity: 1;
            }
            100% {
                transform: translateX(100px);
                opacity: 0;
            }
        }
        
        /* Enhance form elements */
        input:focus, select:focus, textarea:focus {
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.25);
        }
        
        /* Progress bars animation */
        .progress-bar {
            transition: width 0.6s ease;
        }
        
        /* Custom color themes */
        :root {
            --primary-color: #3b82f6;
            --primary-dark: #2563eb;
            --primary-light: #93c5fd;
            --success-color: #10b981;
            --warning-color: #f59e0b;
            --error-color: #ef4444;
        }
    </style>
</head>
<body class="font-sans antialiased bg-gray-100 dark:bg-gray-900">
    <div class="min-h-screen">
        @include('layouts.navigation')

        <!-- Page Content -->
        <main>
            <div class="container mx-auto p-4">
                @yield('content')
            </div>
        </main>
    </div>
    
    <!-- Global notification container -->
    <div id="notification-container" class="fixed bottom-4 right-4 z-50"></div>
    
    <!-- Optional: Global JavaScript for notifications -->
    <script>
        function showNotification(message, type = 'info') {
            const container = document.getElementById('notification-container');
            const notification = document.createElement('div');
            
            // Set type-based classes
            let bgColor, textColor;
            switch(type) {
                case 'success':
                    bgColor = 'bg-green-500';
                    textColor = 'text-white';
                    break;
                case 'error':
                    bgColor = 'bg-red-500';
                    textColor = 'text-white';
                    break;
                case 'warning':
                    bgColor = 'bg-yellow-500';
                    textColor = 'text-white';
                    break;
                default:
                    bgColor = 'bg-blue-500';
                    textColor = 'text-white';
            }
            
            notification.className = `${bgColor} ${textColor} px-4 py-3 rounded shadow-lg mb-2 animate__animated animate__fadeInUp`;
            notification.textContent = message;
            
            container.appendChild(notification);
            
            // Remove after 3 seconds
            setTimeout(() => {
                notification.classList.remove('animate__fadeInUp');
                notification.classList.add('animate__fadeOutDown');
                
                setTimeout(() => {
                    container.removeChild(notification);
                }, 500);
            }, 3000);
        }
    </script>
</body>
</html>
