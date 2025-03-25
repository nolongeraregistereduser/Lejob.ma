<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>LeJob.ma - Plateforme de recrutement moderne</title>
    
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;500;600;700&family=Crafty+Girls&display=swap" rel="stylesheet">
    
    @vite('resources/css/app.css')
    <style>
        .crafty-font {
            font-family: 'Crafty Girls', cursive;
        }
    </style>
</head>
<body class="font-[Quicksand] bg-white">
    @include('components.navbar')

    <main>
        <!-- Hero Section -->
        <section class="relative px-6 py-16 text-center">
            <h1 class="crafty-font text-4xl mb-8">Bienvenue sur LeJob.ma!</h1>
            <a href="#" class="inline-block bg-gray-800 text-white px-8 py-3 rounded-full hover:bg-gray-700">Postuler</a>
            
            <div class="max-w-5xl mx-auto mt-12">
                <img src="{{ asset('images/Frame1.png') }}" alt="LeJob.ma platform preview" class="w-full h-auto">
            </div>
        </section>

        <!-- Platform Section -->
        <section class="px-6 py-16 text-center bg-gray-50">
            <p class="text-gray-600 mb-2">Qui sommes-nous ?</p>
            <h2 class="crafty-font text-3xl mb-12">LeJob, la plateforme de<br>recrutement moderne</h2>
            
            <div class="max-w-4xl mx-auto">
                <img src="{{ asset('images/Frame1.png') }}" alt="LeJob.ma platform features" class="w-full h-auto">
            </div>
        </section>

        <!-- Job Search Section -->
        <section class="px-6 py-16 text-center">
            <h2 class="crafty-font text-4xl mb-6">Faciliter la recherche d'emploie</h2>
            <p class="text-gray-600 max-w-3xl mx-auto mb-12">
                Avec LeJob.ma, trouvez rapidement le poste qui vous correspond grâce à nos fonctionnalités avancées de recherche et de dépôt de candidature
            </p>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 max-w-6xl mx-auto">
                <!-- Testimonial Card 1 -->
                <div class="border rounded-lg p-6">
                    <img src="{{ asset('images/testimonial1.png') }}" alt="Témoignage" class="w-24 h-24 rounded-full mx-auto mb-4">
                    <h3 class="font-bold mb-2">Témoignages</h3>
                    <p class="text-sm text-gray-600 mb-4">"LeJob.ma m'a permis de décrocher mon CDI en seulement quelques semaines..."</p>
                    <p class="text-sm text-gray-500">Fatima, Ingénieur</p>
                </div>

                <!-- Testimonial Card 2 -->
                <div class="border rounded-lg p-6">
                    <img src="{{ asset('images/testimonial2.png') }}" alt="Témoignage" class="w-24 h-24 rounded-full mx-auto mb-4">
                    <h3 class="font-bold mb-2">"Grâce à la plateforme..."</h3>
                    <p class="text-sm text-gray-600 mb-4">Michel, Responsable Marketing</p>
                    <p class="text-sm text-gray-500">Lorem, Chargée de Ressources h...</p>
                </div>

                <!-- Testimonial Card 3 -->
                <div class="border rounded-lg p-6">
                    <img src="{{ asset('images/testimonial3.png') }}" alt="Témoignage" class="w-24 h-24 rounded-full mx-auto mb-4">
                    <h3 class="font-bold mb-2">"LeJob.ma est une vérita..."</h3>
                    <p class="text-sm text-gray-600 mb-4">Karim, Consultant en Stratégie</p>
                    <p class="text-sm text-gray-500">Jamal, Développeuse Web</p>
                </div>

                <!-- Testimonial Card 4 -->
                <div class="border rounded-lg p-6">
                    <img src="{{ asset('images/testimonial4.png') }}" alt="Témoignage" class="w-24 h-24 rounded-full mx-auto mb-4">
                    <h3 class="font-bold mb-2">Prêt à donner un nouve...</h3>
                    <p class="text-sm text-gray-600 mb-4">Rejoignez dès maintenant la communauté LeJob.ma !</p>
                    <p class="text-sm text-gray-500">Postuler</p>
                </div>
            </div>

            <a href="#" class="inline-block bg-gray-900 text-white px-8 py-3 rounded-full mt-12">Découvrir</a>
        </section>

        <!-- CV Builder Section -->
        <section class="px-6 py-16 bg-gray-50">
            <div class="max-w-6xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
                <div class="text-left">
                    <h2 class="crafty-font text-4xl mb-6">Construisez<br>votre CV</h2>
                    <p class="text-gray-600 mb-8">Avec nos modèles pro, mettez en valeur votre expérience et vos compétences</p>
                    <a href="#" class="inline-block bg-gray-900 text-white px-8 py-3 rounded-full">Télécharger</a>
                </div>
                <div class="relative">
                    <div class="bg-gray-900 rounded-full w-[500px] h-[500px] absolute -z-10 right-0"></div>
                    <img src="{{ asset('images/cv-builder.png') }}" alt="CV Builder" class="relative z-10">
                </div>
            </div>
        </section>
    </main>
</body>
</html>