<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>À propos - LeJob.ma</title>
    
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
        <!-- Mission Section -->
        <section class="px-6 py-20">
            <div class="max-w-6xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
                <div class="text-left">
                    <h1 class="crafty-font text-4xl mb-6">Notre Mission :<br>Connecter les Talents<br>aux Opportunités</h1>
                    <p class="text-gray-600 mb-8">
                        Chez LeJob.ma, nous révolutionnons le recrutement au Maroc. Notre plateforme innovante facilite la rencontre entre les meilleurs talents et les entreprises les plus dynamiques du pays, tout en offrant des outils modernes pour le développement professionnel.
                    </p>
                    <div class="space-y-4">
                        <a href="#" class="inline-block bg-black text-white px-8 py-3 rounded-full hover:bg-gray-800 transition-colors">Créer mon compte</a>
                        <a href="#" class="block w-fit text-black border-2 border-black px-8 py-3 rounded-full hover:bg-gray-100 transition-colors mt-4">Explorer les opportunités</a>
                    </div>
                </div>
                <div class="relative">
                    <div class="bg-gray-100 rounded-full w-[400px] h-[400px] absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2"></div>
                    <img src="{{ asset('images/woman-illustration.png') }}" alt="Illustration professionnelle" class="relative z-10">
                </div>
            </div>
        </section>

        <!-- Services Section -->
        <section class="px-6 py-16 bg-gray-50">
            <div class="max-w-6xl mx-auto">
                <h2 class="crafty-font text-3xl text-center mb-12">Nos Services Innovants</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div class="bg-white p-8 rounded-2xl shadow-sm hover:shadow-lg transition-all">
                        <h3 class="font-bold text-xl mb-4">CV Builder Intelligent</h3>
                        <p class="text-gray-600">Créez un CV professionnel et ATS-friendly avec nos templates modernes. Optimisez vos chances d'être remarqué par les recruteurs.</p>
                    </div>
                    <div class="bg-white p-8 rounded-2xl shadow-sm hover:shadow-lg transition-all">
                        <h3 class="font-bold text-xl mb-4">Matching Emploi</h3>
                        <p class="text-gray-600">Notre algorithme intelligent vous connecte aux offres d'emploi qui correspondent le mieux à votre profil et à vos aspirations.</p>
                    </div>
                    <div class="bg-white p-8 rounded-2xl shadow-sm hover:shadow-lg transition-all">
                        <h3 class="font-bold text-xl mb-4">Coaching Carrière</h3>
                        <p class="text-gray-600">Accédez à nos experts en développement de carrière pour des conseils personnalisés et un accompagnement sur mesure.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Next Move Section -->
        <section class="px-6 py-20">
            <div class="max-w-6xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
                <div class="bg-gray-100 rounded-3xl overflow-hidden">
                    <img src="{{ asset('images/two-women-illustration.png') }}" alt="Illustration professionnelle" class="w-full">
                </div>
                <div class="text-left">
                    <h2 class="crafty-font text-4xl mb-6">Construisez<br>Votre Avenir</h2>
                    <p class="text-gray-600 mb-8">
                        LeJob.ma s'engage à transformer le paysage du recrutement au Maroc. Notre plateforme trilingue (Français, Arabe, Anglais) offre :
                    </p>
                    <ul class="space-y-4 mb-8">
                        <li class="flex items-center">
                            <svg class="w-5 h-5 mr-2 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Des outils de création de CV professionnels
                        </li>
                        <li class="flex items-center">
                            <svg class="w-5 h-5 mr-2 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Un accès aux meilleures opportunités du marché
                        </li>
                        <li class="flex items-center">
                            <svg class="w-5 h-5 mr-2 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Un accompagnement personnalisé par des experts
                        </li>
                    </ul>
                    <a href="#" class="inline-block bg-black text-white px-8 py-3 rounded-full hover:bg-gray-800 transition-colors">Rejoignez-nous</a>
                </div>
            </div>
        </section>

        <!-- Stats Section -->
        <section class="px-6 py-16 bg-gray-50">
            <div class="max-w-6xl mx-auto">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-center">
                    <div class="p-6">
                        <h3 class="text-4xl font-bold mb-2">1000+</h3>
                        <p class="text-gray-600">Entreprises partenaires</p>
                    </div>
                    <div class="p-6">
                        <h3 class="text-4xl font-bold mb-2">5000+</h3>
                        <p class="text-gray-600">CV créés</p>
                    </div>
                    <div class="p-6">
                        <h3 class="text-4xl font-bold mb-2">98%</h3>
                        <p class="text-gray-600">Taux de satisfaction</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Trusted Collaborations Section -->
        <section class="px-6 py-24 bg-gradient-to-b from-white to-gray-50">
            <div class="max-w-6xl mx-auto text-center">
                <p class="text-gray-600 mb-2 uppercase tracking-wider text-sm">Découvrez Nos Partenaires</p>
                <h2 class="crafty-font text-5xl mb-6">Collaborations de Confiance</h2>
                <p class="text-gray-600 mb-16 max-w-2xl mx-auto text-lg">
                    Nous collaborons avec les leaders du marché marocain pour offrir des opportunités exceptionnelles. Notre réseau de partenaires de confiance s'engage à créer un impact positif sur le marché de l'emploi.
                </p>

                <div class="grid grid-cols-2 md:grid-cols-4 gap-16 items-center">
                    <!-- Partner 1 -->
                    <div class="text-center transform hover:-translate-y-2 transition-all duration-300">
                        <div class="w-28 h-28 bg-black rounded-full mx-auto mb-6 flex items-center justify-center shadow-lg hover:shadow-xl">
                            <span class="text-white text-xl font-bold">OCP</span>
                        </div>
                        <p class="font-bold text-lg mb-2">Innovation</p>
                        <p class="text-gray-600">Leader en développement durable</p>
                    </div>

                    <!-- Partner 2 -->
                    <div class="text-center transform hover:-translate-y-2 transition-all duration-300">
                        <div class="w-28 h-28 bg-black rounded-full mx-auto mb-6 flex items-center justify-center shadow-lg hover:shadow-xl">
                            <span class="text-white text-xl font-bold">CIH</span>
                        </div>
                        <p class="font-bold text-lg mb-2">Finance</p>
                        <p class="text-gray-600">Excellence bancaire</p>
                    </div>

                    <!-- Partner 3 -->
                    <div class="text-center transform hover:-translate-y-2 transition-all duration-300">
                        <div class="w-28 h-28 bg-black rounded-full mx-auto mb-6 flex items-center justify-center shadow-lg hover:shadow-xl">
                            <span class="text-white text-xl font-bold">RAM</span>
                        </div>
                        <p class="font-bold text-lg mb-2">Transport</p>
                        <p class="text-gray-600">Connection mondiale</p>
                    </div>

                    <!-- Partner 4 -->
                    <div class="text-center transform hover:-translate-y-2 transition-all duration-300">
                        <div class="w-28 h-28 bg-black rounded-full mx-auto mb-6 flex items-center justify-center shadow-lg hover:shadow-xl">
                            <span class="text-white text-xl font-bold">ONCF</span>
                        </div>
                        <p class="font-bold text-lg mb-2">Logistique</p>
                        <p class="text-gray-600">Mobilité innovante</p>
                    </div>
                </div>

                <div class="mt-16">
                    <a href="#" class="inline-flex items-center text-black hover:text-gray-700 transition-colors">
                        <span class="mr-2">Découvrir tous nos partenaires</span>
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                        </svg>
                    </a>
                </div>
            </div>
        </section>

        <!-- Team Section -->
        <section class="px-6 py-20">
            <div class="max-w-6xl mx-auto text-center">
                <p class="text-gray-600 mb-2">Meet the Crafty Girls</p>
                <h2 class="crafty-font text-4xl mb-8">Notre Équipe Talentueuse</h2>
                <p class="text-gray-600 mb-12 max-w-2xl mx-auto">
                    Notre équipe diversifiée rassemble des professionnels passionnés qui œuvrent ensemble pour créer un environnement de travail inclusif et innovant
                </p>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-12">
                    <!-- Team Member 1 -->
                    <div class="text-center">
                        <div class="w-48 h-48 mx-auto mb-6">
                            <img src="{{ asset('images/team/samantha.jpg') }}" alt="Samantha" class="w-full h-full object-cover rounded-full">
                        </div>
                        <h3 class="font-bold text-xl mb-2">Samantha</h3>
                        <p class="text-gray-600">Directrice Marketing créative avec un talent pour le design. Elle dirige nos efforts marketing, créant des campagnes visuellement captivantes qui incarnent l'essence de notre marque.</p>
                    </div>

                    <!-- Team Member 2 -->
                    <div class="text-center">
                        <div class="w-48 h-48 mx-auto mb-6">
                            <img src="{{ asset('images/team/olivia.jpg') }}" alt="Olivia" class="w-full h-full object-cover rounded-full">
                        </div>
                        <h3 class="font-bold text-xl mb-2">Olivia</h3>
                        <p class="text-gray-600">Notre experte technique résidente, s'assurant que notre plateforme est conviviale et dotée de fonctionnalités innovantes.</p>
                    </div>

                    <!-- Team Member 3 -->
                    <div class="text-center">
                        <div class="w-48 h-48 mx-auto mb-6">
                            <img src="{{ asset('images/team/liam.jpg') }}" alt="Liam" class="w-full h-full object-cover rounded-full">
                        </div>
                        <h3 class="font-bold text-xl mb-2">Liam</h3>
                        <p class="text-gray-600">Le cœur de notre équipe service client, offrant un support personnalisé aux chercheurs d'emploi et aux employeurs.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Streamlined Job Search Section -->
        <section class="px-6 py-20 bg-gray-50">
            <div class="max-w-6xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
                <div class="text-left">
                    <p class="text-gray-600 mb-2">Pourquoi Choisir LeJob</p>
                    <h2 class="crafty-font text-4xl mb-6">Recherche d'Emploi<br>Simplifiée</h2>
                    <p class="text-gray-600 mb-8">
                        Chez LeJob.ma, nous comprenons la complexité du marché de l'emploi. C'est pourquoi nous avons conçu une plateforme qui simplifie le processus de recherche, vous permettant de parcourir et postuler facilement aux postes qui correspondent à vos aspirations.
                    </p>
                    <a href="#" class="inline-block bg-black text-white px-8 py-3 rounded-full hover:bg-gray-800 transition-colors">Commencer...</a>
                </div>
                <div class="relative">
                    <img src="{{ asset('images/job-search.jpg') }}" alt="Recherche d'emploi simplifiée" class="rounded-2xl shadow-lg">
                </div>
            </div>
        </section>

        <!-- Employer Insights Section -->
        <section class="px-6 py-20">
            <div class="max-w-6xl mx-auto">
                <p class="text-gray-600 text-center mb-2">Flexible & Responsive</p>
                <h2 class="crafty-font text-4xl text-center mb-6">Employer Insights</h2>
                <p class="text-gray-600 text-center mb-12">
                    Notre plateforme conviviale s'adapte à votre appareil, garantissant une expérience fluide que vous soyez en déplacement ou au bureau
                </p>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
                    <div class="relative">
                        <img src="{{ asset('images/woman-profile.png') }}" alt="Professional illustration" class="w-full">
                    </div>
                    <div class="space-y-6">
                        <!-- Location Card -->
                        <div class="bg-white p-6 rounded-xl shadow-sm">
                            <div class="flex items-center gap-4 mb-3">
                                <div class="w-10 h-10 bg-gray-100 rounded-full flex items-center justify-center">
                                    <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    </svg>
                                </div>
                                <h3 class="font-bold text-xl">Nos Emplacements</h3>
                            </div>
                            <p class="text-gray-600">
                                Avec un réseau croissant de bureaux à travers le pays, LeJob.ma s'engage à servir les chercheurs d'emploi et les employeurs dans toutes les régions du Maroc
                            </p>
                        </div>

                        <!-- Verified Employers Card -->
                        <div class="bg-white p-6 rounded-xl shadow-sm">
                            <div class="flex items-center gap-4 mb-3">
                                <div class="w-10 h-10 bg-gray-100 rounded-full flex items-center justify-center">
                                    <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                </div>
                                <h3 class="font-bold text-xl">Employeurs Vérifiés</h3>
                            </div>
                            <p class="text-gray-600">
                                Chez LeJob.ma, nous collaborons avec un large éventail d'employeurs réputés, des grandes entreprises multinationales aux startups dynamiques
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Connect with Us Section -->
        <section class="px-6 py-20 bg-gray-50">
            <div class="max-w-3xl mx-auto text-center">
                <p class="text-gray-600 mb-2">Suivez-nous</p>
                <h2 class="crafty-font text-4xl mb-6">Connectez-vous avec Nous</h2>
                <p class="text-gray-600 mb-8">
                    Restez informé des dernières offres d'emploi, des actualités du secteur et des nouvelles de l'entreprise en suivant LeJob.ma sur les réseaux sociaux. Nos canaux en ligne sont une source précieuse d'informations et d'inspiration pour votre parcours professionnel
                </p>
                <a href="#" class="inline-block bg-black text-white px-8 py-3 rounded-full hover:bg-gray-800 transition-colors">
                    Rejoindre la Communauté
                </a>
            </div>
        </section>

        <!-- Footer remains unchanged -->
    </main>

    @include('components.footer')
</body>
</html>