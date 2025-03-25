<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Créer Votre CV - LeJob.ma</title>
    
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
        <section class="px-6 py-20">
            <div class="max-w-6xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
                <div class="text-left">
                    <h1 class="crafty-font text-5xl mb-6">Créez Votre CV Parfait avec LeJob.ma</h1>
                    <p class="text-gray-600 mb-8">
                        Notre outil de création de CV de pointe vous permet de créer un CV professionnel et personnalisé qui se démarque. Explorez notre large gamme de modèles personnalisables, nos fonctionnalités de design intuitives et nos conseils d'experts.
                    </p>
                    <div class="flex gap-4">
                        <a href="#templates" class="inline-block bg-black text-white px-8 py-3 rounded-full hover:bg-gray-800 transition-colors">
                            Créer Mon CV
                        </a>
                        <a href="#features" class="inline-block bg-gray-100 text-black px-8 py-3 rounded-full hover:bg-gray-200 transition-colors">
                            En savoir plus
                        </a>
                    </div>
                </div>
                <div class="relative">
                    <div class="bg-gray-200 h-[600px] w-full rounded-xl flex items-center justify-center">
                        <span class="text-gray-500">Image Professionnelle</span>
                    </div>
                    <div class="absolute -right-4 top-1/2 -translate-y-1/2">
                        <div class="w-32 h-32 bg-gray-100 rounded-xl"></div>
                    </div>
                </div>
            </div>
        </section>

        <!-- ATS-Friendly Section -->
        <section class="px-6 py-20 bg-gray-50">
            <div class="max-w-6xl mx-auto">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
                    <div class="relative">
                        <div class="bg-gray-200 h-[400px] w-full rounded-xl flex items-center justify-center">
                            <span class="text-gray-500">ATS Illustration</span>
                        </div>
                    </div>
                    <div>
                        <h2 class="crafty-font text-4xl mb-6">CV Compatible ATS</h2>
                        <p class="text-gray-600 mb-8">
                            Nos templates sont optimisés pour les systèmes ATS (Applicant Tracking System) utilisés par les recruteurs. Maximisez vos chances d'être sélectionné avec un CV qui répond aux standards des logiciels de recrutement.
                        </p>
                        <ul class="space-y-4">
                            <li class="flex items-center gap-3">
                                <div class="w-6 h-6 bg-black rounded-full flex items-center justify-center">
                                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                </div>
                                <span>Mots-clés optimisés pour votre secteur</span>
                            </li>
                            <li class="flex items-center gap-3">
                                <div class="w-6 h-6 bg-black rounded-full flex items-center justify-center">
                                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                </div>
                                <span>Format compatible avec tous les ATS</span>
                            </li>
                            <li class="flex items-center gap-3">
                                <div class="w-6 h-6 bg-black rounded-full flex items-center justify-center">
                                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                </div>
                                <span>Structure claire et lisible</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>

        <!-- Features Section -->
        <section id="features" class="px-6 py-20 bg-white">
            <div class="max-w-6xl mx-auto text-center">
                <h2 class="crafty-font text-4xl mb-16">Libérez Votre Potentiel Professionnel</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <!-- Feature 1 -->
                    <div class="bg-white p-8 rounded-2xl shadow-sm hover:shadow-lg transition-all">
                        <div class="w-20 h-20 bg-gray-100 rounded-full mx-auto mb-6 flex items-center justify-center">
                            <img src="{{ asset('images/templates-icon.png') }}" alt="" class="w-10 h-10">
                        </div>
                        <h3 class="font-bold text-xl mb-4">Nos Templates</h3>
                        <p class="text-gray-600">
                            Découvrez notre collection de modèles modernes et visuellement attrayants qui vous aideront à faire une impression durable.
                        </p>
                    </div>

                    <!-- Feature 2 -->
                    <div class="bg-white p-8 rounded-2xl shadow-sm hover:shadow-lg transition-all">
                        <div class="w-20 h-20 bg-gray-100 rounded-full mx-auto mb-6 flex items-center justify-center">
                            <img src="{{ asset('images/customize-icon.png') }}" alt="" class="w-10 h-10">
                        </div>
                        <h3 class="font-bold text-xl mb-4">Personnalisation</h3>
                        <p class="text-gray-600">
                            Personnalisez votre CV avec nos outils conviviaux, mettant en valeur vos compétences uniques.
                        </p>
                    </div>

                    <!-- Feature 3 -->
                    <div class="bg-white p-8 rounded-2xl shadow-sm hover:shadow-lg transition-all">
                        <div class="w-20 h-20 bg-gray-100 rounded-full mx-auto mb-6 flex items-center justify-center">
                            <img src="{{ asset('images/format-icon.png') }}" alt="" class="w-10 h-10">
                        </div>
                        <h3 class="font-bold text-xl mb-4">Mise en Page</h3>
                        <p class="text-gray-600">
                            Obtenez une mise en page professionnelle avec nos options de formatage automatique.
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Templates Preview -->
        <section id="templates" class="px-6 py-20">
            <div class="max-w-6xl mx-auto">
                <h2 class="crafty-font text-4xl text-center mb-16">Templates Professionnels</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <!-- Template 1: Modern -->
                    <div class="bg-white rounded-xl overflow-hidden shadow-sm hover:shadow-lg transition-all">
                        <div class="bg-gray-200 h-96 flex items-center justify-center">
                            <span class="text-gray-500">Aperçu Template Moderne</span>
                        </div>
                        <div class="p-6">
                            <h3 class="font-bold text-xl mb-2">Modern Pro</h3>
                            <p class="text-gray-600 mb-4">Design épuré et professionnel</p>
                            <a href="#" class="text-black hover:text-gray-600 transition-colors">Utiliser ce template →</a>
                        </div>
                    </div>

                    <!-- Template 2: Creative -->
                    <div class="bg-white rounded-xl overflow-hidden shadow-sm hover:shadow-lg transition-all">
                        <div class="bg-gray-200 h-96 flex items-center justify-center">
                            <span class="text-gray-500">Aperçu Template Créatif</span>
                        </div>
                        <div class="p-6">
                            <h3 class="font-bold text-xl mb-2">Creative Plus</h3>
                            <p class="text-gray-600 mb-4">Design créatif et dynamique</p>
                            <a href="#" class="text-black hover:text-gray-600 transition-colors">Utiliser ce template →</a>
                        </div>
                    </div>

                    <!-- Template 3: Classic -->
                    <div class="bg-white rounded-xl overflow-hidden shadow-sm hover:shadow-lg transition-all">
                        <div class="bg-gray-200 h-96 flex items-center justify-center">
                            <span class="text-gray-500">Aperçu Template Classique</span>
                        </div>
                        <div class="p-6">
                            <h3 class="font-bold text-xl mb-2">Classic Elite</h3>
                            <p class="text-gray-600 mb-4">Design traditionnel et élégant</p>
                            <a href="#" class="text-black hover:text-gray-600 transition-colors">Utiliser ce template →</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Call to Action -->
        <section class="px-6 py-20 bg-gray-50">
            <div class="max-w-4xl mx-auto text-center">
                <h2 class="crafty-font text-4xl mb-6">Prêt à Créer Votre CV ?</h2>
                <p class="text-gray-600 mb-8">
                    Commencez dès aujourd'hui et créez un CV qui vous démarquera auprès des recruteurs.
                </p>
                <a href="#" class="inline-block bg-black text-white px-8 py-3 rounded-full hover:bg-gray-800 transition-colors">
                    Commencer Maintenant
                </a>
            </div>
        </section>
    </main>

    @include('components.footer')
</body>
</html>