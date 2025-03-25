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
                <div class="border rounded-lg p-6 hover:shadow-lg transition-shadow">
                    <img src="https://ui-avatars.com/api/?name=Youssef+El+Amrani&background=random" alt="Youssef El Amrani" class="w-24 h-24 rounded-full mx-auto mb-4">
                    <h3 class="font-bold mb-2">Ingénieur Télécoms</h3>
                    <p class="text-sm text-gray-600 mb-4">"LeJob.ma a transformé ma recherche d'emploi. En tant que jeune ingénieur, j'ai pu trouver un poste chez une grande entreprise de télécommunications en seulement 3 semaines."</p>
                    <p class="text-sm text-gray-500">Youssef El Amrani, Ingénieur Télécoms</p>
                </div>

                <!-- Testimonial Card 2 -->
                <div class="border rounded-lg p-6 hover:shadow-lg transition-shadow">
                    <img src="https://ui-avatars.com/api/?name=Nadia+Benjelloun&background=random" alt="Nadia Benjelloun" class="w-24 h-24 rounded-full mx-auto mb-4">
                    <h3 class="font-bold mb-2">Chargée de Marketing Digital</h3>
                    <p class="text-sm text-gray-600 mb-4">"Grâce aux outils de matching de LeJob.ma, j'ai pu me reconvertir dans le digital marketing. La plateforme m'a mise en relation avec des entreprises qui correspondaient exactement à mes aspirations."</p>
                    <p class="text-sm text-gray-500">Nadia Benjelloun, Chargée de Marketing Digital</p>
                </div>

                <!-- Testimonial Card 3 -->
                <div class="border rounded-lg p-6 hover:shadow-lg transition-shadow">
                    <img src="https://ui-avatars.com/api/?name=Karim+Tazi&background=random" alt="Karim Tazi" class="w-24 h-24 rounded-full mx-auto mb-4">
                    <h3 class="font-bold mb-2">Chef de Projet Senior</h3>
                    <p class="text-sm text-gray-600 mb-4">"La qualité des offres sur LeJob.ma est impressionnante. J'ai pu négocier un meilleur salaire et des conditions plus avantageuses grâce aux nombreuses opportunités disponibles."</p>
                    <p class="text-sm text-gray-500">Karim Tazi, Chef de Projet Senior</p>
                </div>

                <!-- Testimonial Card 4 -->
                <div class="border rounded-lg p-6 hover:shadow-lg transition-shadow">
                    <img src="https://ui-avatars.com/api/?name=Fatima+Alaoui&background=random" alt="Fatima Alaoui" class="w-24 h-24 rounded-full mx-auto mb-4">
                    <h3 class="font-bold mb-2">Responsable RH</h3>
                    <p class="text-sm text-gray-600 mb-4">"En tant que professionnelle RH, j'apprécie particulièrement la simplicité du processus de recrutement sur LeJob.ma. La plateforme nous permet d'identifier rapidement les meilleurs talents."</p>
                    <p class="text-sm text-gray-500">Fatima Alaoui, Responsable RH</p>
                </div>

            </div>

            <a href="#" class="inline-block bg-gray-900 text-white px-8 py-3 rounded-full mt-12 hover:bg-gray-800 transition-colors">Découvrir</a>
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
                    <img src="{{ asset('images/cv-builder.png') }}" alt="CV Builder" class="relative z-10">
                </div>
            </div>
        </section>
    </main>
</body>
</html>