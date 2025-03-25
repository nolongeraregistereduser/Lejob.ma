<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>À propos - LeJob.ma</title>
    
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
        <!-- Mission Section -->
        <section class="px-6 py-20">
            <div class="max-w-6xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
                <div class="text-left">
                    <h1 class="crafty-font text-4xl mb-6">Our Mission:<br>Connecting Talent<br>with Opportunity</h1>
                    <p class="text-gray-600 mb-8">
                        At LeJob.ma, we believe that every individual deserves the chance to unlock their full potential.
                    </p>
                    <div class="space-y-4">
                        <a href="#" class="inline-block bg-black text-white px-8 py-3 rounded-full hover:bg-gray-800 transition-colors">Apply Now</a>
                        <a href="#" class="block w-fit text-black border-2 border-black px-8 py-3 rounded-full hover:bg-gray-100 transition-colors mt-4">Explore Opportunities</a>
                    </div>
                </div>
                <div class="relative">
                    <div class="bg-gray-100 rounded-full w-[400px] h-[400px] absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2"></div>
                    <img src="{{ asset('images/woman-illustration.png') }}" alt="Professional woman illustration" class="relative z-10">
                </div>
            </div>
        </section>

        <!-- Partners Section -->
        <section class="px-6 py-12 bg-gray-50">
            <div class="max-w-6xl mx-auto">
                <div class="flex items-center justify-between overflow-x-auto space-x-8 py-4">
                    <span class="text-gray-400 whitespace-nowrap">Partner</span>
                    <span class="text-gray-400 whitespace-nowrap">Partner</span>
                    <span class="text-gray-400 whitespace-nowrap">Partner</span>
                    <span class="text-gray-400 whitespace-nowrap">Partner</span>
                    <span class="text-gray-400 whitespace-nowrap">Partner</span>
                </div>
            </div>
        </section>

        <!-- Next Move Section -->
        <section class="px-6 py-20">
            <div class="max-w-6xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
                <div class="bg-gray-100 rounded-3xl overflow-hidden">
                    <img src="{{ asset('images/two-women-illustration.png') }}" alt="Two professional women illustration" class="w-full">
                </div>
                <div class="text-left">
                    <h2 class="crafty-font text-4xl mb-6">Discover Your<br>Next Move</h2>
                    <p class="text-gray-600 mb-8">
                        At LeJob.ma, we're on a mission to revolutionize the job search and hiring process. Our state-of-the-art platform connects talented individuals with the right opportunities, empowering them to take control of their careers.
                    </p>
                    <a href="#" class="inline-block bg-black text-white px-8 py-3 rounded-full hover:bg-gray-800 transition-colors">Join Now</a>
                </div>
            </div>
        </section>
    </main>

    @include('components.footer')
</body>
</html>