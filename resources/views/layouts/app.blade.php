<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StaffHub - @yield('title', 'Gestion du Personnel')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
      
    </style>
</head>
<body class="bg-gray-50">
    <div class="min-h-screen">
        <!-- Barre de navigation -->
        <nav class="bg-white shadow-md">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex">
                        <div class="flex-shrink-0 flex items-center">
                            <a href="{{ route('landing') }}" class="text-xl font-bold text-blue-600">StaffHub</a>
                        </div>
                    </div>
                    
                    @auth
                    <div class="flex items-center">
                        <span class="text-gray-700 mr-4">Bienvenue, {{ auth()->user()->name }}</span>
                        <form action="{{ route('logout') }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg transition-colors">
                                Déconnexion
                            </button>
                        </form>
                    </div>
                    @endauth
                </div>
            </div>
        </nav>

        <!-- Contenu principal -->
        <main class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative fade-in" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            @if(session('error'))
                <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative fade-in" role="alert">
                    <span class="block sm:inline">{{ session('error') }}</span>
                </div>
            @endif

            @yield('content')
        </main>
    </div>

    <script>
        // Animation des éléments au chargement
        document.addEventListener('DOMContentLoaded', function() {
            const elements = document.querySelectorAll('.fade-in, .slide-up');
            elements.forEach((element, index) => {
                setTimeout(() => {
                    element.style.opacity = '1';
                    element.style.transform = 'translateY(0)';
                }, index * 100);
            });
        });
    </script>
</body>
</html> 