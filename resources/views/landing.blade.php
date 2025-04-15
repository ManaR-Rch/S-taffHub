<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StaffHub - Gestion RH Simplifiée</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .fade-in {
            animation: fadeIn 1s ease-in;
        }
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        .slide-up {
            animation: slideUp 0.8s ease-out;
        }
        @keyframes slideUp {
            from { transform: translateY(20px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }
    </style>
</head>
<body class="bg-gradient-to-br from-blue-50 to-indigo-100 min-h-screen">
    <div class="min-h-screen flex flex-col items-center justify-center p-4">
        <div class="max-w-4xl mx-auto text-center fade-in">
            <div class="bg-white rounded-xl shadow-lg p-8 md:p-12 mb-8 slide-up">
                <h1 class="text-4xl md:text-5xl font-bold text-blue-800 mb-4">StaffHub</h1>
                <p class="text-xl text-gray-600 mb-6">Votre plateforme de gestion du personnel simplifiée</p>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                    <div class="bg-blue-50 p-4 rounded-lg">
                        <div class="text-blue-600 text-2xl mb-2">👥</div>
                        <h3 class="font-semibold text-blue-800">Gestion des employés</h3>
                        <p class="text-sm text-gray-600">Suivez facilement vos équipes</p>
                    </div>
                    <div class="bg-indigo-50 p-4 rounded-lg">
                        <div class="text-indigo-600 text-2xl mb-2">📊</div>
                        <h3 class="font-semibold text-indigo-800">Tableaux de bord</h3>
                        <p class="text-sm text-gray-600">Visualisez les données clés</p>
                    </div>
                    <div class="bg-purple-50 p-4 rounded-lg">
                        <div class="text-purple-600 text-2xl mb-2">📅</div>
                        <h3 class="font-semibold text-purple-800">Planification</h3>
                        <p class="text-sm text-gray-600">Organisez les emplois du temps</p>
                    </div>
                </div>
                
                <a href="{{ route('login') }}" 
                   id="login-btn"
                   class="inline-block bg-blue-600 text-white px-8 py-3 rounded-lg font-semibold hover:bg-blue-700 transition-colors shadow-md hover:shadow-lg">
                    Se connecter
                </a>
            </div>
            
            <div class="text-gray-500 text-sm mt-4">
                © {{ date('Y') }} StaffHub - Tous droits réservés
            </div>
        </div>
    </div>

    <script>
        // Animation simple au survol du bouton
        document.addEventListener('DOMContentLoaded', function() {
            const loginBtn = document.getElementById('login-btn');
            
            loginBtn.addEventListener('mouseover', function() {
                this.style.transform = 'scale(1.05)';
            });
            
            loginBtn.addEventListener('mouseout', function() {
                this.style.transform = 'scale(1)';
            });
            
            // Animation des éléments au chargement
            const elements = document.querySelectorAll('.slide-up');
            elements.forEach((el, index) => {
                el.style.animationDelay = `${index * 0.2}s`;
            });
        });
    </script>
</body>
</html> 