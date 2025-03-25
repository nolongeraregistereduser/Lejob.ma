<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Contact - LeJob.ma</title>
    
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
                    <h1 class="crafty-font text-5xl mb-6">Bienvenue sur LeJob.ma -<br>Votre Passerelle vers<br>le Succès Professionnel</h1>
                    <p class="text-gray-600 mb-8">
                        Chez LeJob.ma, nous nous engageons à révolutionner le secteur du recrutement. Notre plateforme offre une expérience fluide et efficace, connectant les talents avec les meilleures opportunités professionnelles au Maroc.
                    </p>
                    <a href="#contact-form" class="inline-block bg-black text-white px-8 py-3 rounded-full hover:bg-gray-800 transition-colors">
                        Contactez-nous
                    </a>
                </div>
                <div class="relative">
                    <img src="{{ asset('images/contact-hero.png') }}" alt="Professional illustration" class="w-full">
                </div>
            </div>
        </section>

        <!-- Services Section -->
        <section class="px-6 py-20 bg-gray-50">
            <div class="max-w-6xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
                <div class="relative">
                    <img src="{{ asset('images/faq-person-desk.png') }}" alt="Services illustration" class="w-full">
                </div>
                <div>
                    <h2 class="crafty-font text-4xl mb-6">Découvrez Nos Services</h2>
                    <p class="text-gray-600 mb-8">
                        De la création de CV à la préparation d'entretien, notre suite complète d'outils et de ressources est conçue pour vous accompagner vers la réussite professionnelle.
                    </p>
                    <div class="space-y-4">
                        <div class="bg-white p-6 rounded-xl shadow-sm">
                            <h3 class="font-bold text-xl mb-2">CV Builder Pro</h3>
                            <p class="text-gray-600">Créez un CV professionnel qui vous démarque</p>
                        </div>
                        <div class="bg-white p-6 rounded-xl shadow-sm">
                            <h3 class="font-bold text-xl mb-2">Coaching Personnalisé</h3>
                            <p class="text-gray-600">Bénéficiez des conseils de nos experts en carrière</p>
                        </div>
                        <div class="bg-white p-6 rounded-xl shadow-sm">
                            <h3 class="font-bold text-xl mb-2">Matching Intelligent</h3>
                            <p class="text-gray-600">Trouvez les offres qui correspondent à votre profil</p>
                        </div>
                    </div>
                    <a href="#" class="inline-block mt-8 text-black hover:text-gray-600 transition-colors">
                        Rejoignez-nous →
                    </a>
                </div>
            </div>
        </section>

        <!-- Contact Form Section -->
        <section id="contact-form" class="px-6 py-20">
            <div class="max-w-4xl mx-auto">
                <h2 class="crafty-font text-4xl text-center mb-12">Contactez Notre Équipe</h2>
                <form class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="space-y-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Nom complet</label>
                            <input type="text" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-black focus:border-transparent">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                            <input type="email" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-black focus:border-transparent">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Téléphone</label>
                            <input type="tel" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-black focus:border-transparent">
                        </div>
                    </div>
                    <div class="space-y-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Sujet</label>
                            <input type="text" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-black focus:border-transparent">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Message</label>
                            <textarea rows="5" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-black focus:border-transparent"></textarea>
                        </div>
                    </div>
                    <div class="md:col-span-2 text-center">
                        <button type="submit" class="inline-block bg-black text-white px-8 py-3 rounded-full hover:bg-gray-800 transition-colors">
                            Envoyer le message
                        </button>
                    </div>
                </form>
            </div>
        </section>

        <!-- Contact Info Cards -->
        <section class="px-6 py-20 bg-gray-50">
            <div class="max-w-6xl mx-auto">
                <h2 class="crafty-font text-4xl text-center mb-16">Restons en Contact</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <!-- Office Card -->
                    <div class="bg-white p-8 rounded-2xl shadow-sm hover:shadow-lg transition-all text-center">
                        <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-6">
                            <svg class="w-8 h-8 text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                            </svg>
                        </div>
                        <h3 class="font-bold text-xl mb-4">Notre Bureau</h3>
                        <p class="text-gray-600 mb-2">Casablanca, Maroc</p>
                        <p class="text-gray-600">Twin Center, Tour Ouest, 16ème étage</p>
                    </div>

                    <!-- Contact Card -->
                    <div class="bg-white p-8 rounded-2xl shadow-sm hover:shadow-lg transition-all text-center">
                        <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-6">
                            <svg class="w-8 h-8 text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                        <h3 class="font-bold text-xl mb-4">Contactez-nous</h3>
                        <p class="text-gray-600 mb-2">contact@lejob.ma</p>
                        <p class="text-gray-600">+212 5 22 43 67 89</p>
                    </div>

                    <!-- Hours Card -->
                    <div class="bg-white p-8 rounded-2xl shadow-sm hover:shadow-lg transition-all text-center">
                        <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-6">
                            <svg class="w-8 h-8 text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <h3 class="font-bold text-xl mb-4">Heures d'Ouverture</h3>
                        <p class="text-gray-600 mb-2">Lundi - Vendredi</p>
                        <p class="text-gray-600">9:00 - 18:00</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- FAQ Section -->
        <section class="px-6 py-20 bg-white">
            <div class="max-w-6xl mx-auto">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-16 items-start">
                    <!-- Left Side: FAQ Content -->
                    <div class="space-y-8">
                        <h2 class="crafty-font text-4xl">Questions Fréquemment Posées</h2>
                        <div class="space-y-6">
                            <div class="bg-gray-50 p-6 rounded-xl">
                                <h3 class="font-bold text-xl mb-3">Comment créer mon CV sur LeJob.ma ?</h3>
                                <p class="text-gray-600">Notre CV Builder intelligent vous guide à travers le processus. Choisissez un template professionnel, remplissez vos informations, et obtenez un CV optimisé pour les recruteurs marocains.</p>
                            </div>
                            <div class="bg-gray-50 p-6 rounded-xl">
                                <h3 class="font-bold text-xl mb-3">Comment postuler aux offres d'emploi ?</h3>
                                <p class="text-gray-600">Une fois votre profil complété, vous pouvez postuler en un clic. Notre système de matching vous suggère également les offres qui correspondent le mieux à votre profil.</p>
                            </div>
                            <div class="bg-gray-50 p-6 rounded-xl">
                                <h3 class="font-bold text-xl mb-3">Quels sont les services disponibles ?</h3>
                                <p class="text-gray-600">Nous proposons la création de CV, le matching d'emploi intelligent, le coaching carrière personnalisé, et une plateforme trilingue adaptée au marché marocain.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Right Side: Illustration -->
                    <div class="relative">
                        <img src="{{ asset('images/person-desk-working.png') }}" alt="Professional at work" class="w-full">

                    </div>
                </div>
            </div>
        </section>




        <!-- First FAQ Section remains unchanged -->

        <!-- Second FAQ Section -->
        <section class="px-6 py-20 bg-gray-50">
            <div class="max-w-6xl mx-auto">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-16 items-start">
                    <!-- Left Side: Illustration -->
                    <div class="relative">
                        <img src="{{ asset('images/faq-person-laptop1.png') }}" alt="Support Specialist" class="w-full">

                    </div>

                    <!-- Right Side: FAQ Content -->
                    <div class="space-y-8">
                        <h2 class="crafty-font text-4xl">En Savoir Plus</h2>
                        <div class="space-y-6">
                            <div class="bg-white p-6 rounded-xl">
                                <h3 class="font-bold text-xl mb-3">Comment fonctionne le matching intelligent ?</h3>
                                <p class="text-gray-600">Notre algorithme analyse votre profil, vos compétences et vos préférences pour vous proposer les offres d'emploi les plus pertinentes sur le marché marocain.</p>
                            </div>
                            <div class="bg-white p-6 rounded-xl">
                                <h3 class="font-bold text-xl mb-3">Quels sont les délais de réponse ?</h3>
                                <p class="text-gray-600">Les recruteurs sont notifiés instantanément de votre candidature. Le délai de réponse dépend de chaque entreprise, mais nous encourageons des retours rapides.</p>
                            </div>
                            <div class="bg-white p-6 rounded-xl">
                                <h3 class="font-bold text-xl mb-3">Comment accéder au coaching personnalisé ?</h3>
                                <p class="text-gray-600">Connectez-vous à votre compte et réservez une session avec l'un de nos experts en carrière. Nous proposons des conseils sur mesure pour votre développement professionnel.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        @include('components.footer')
</body>
</html>