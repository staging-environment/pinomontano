<!DOCTYPE html>
<html lang="es" class="h-full scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $business->name }} - Pino Montano Marketplace</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Styles / Scripts -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <style>
            body { font-family: 'Outfit', sans-serif; }
        </style>
    @endif
    
    <style>
        body {
            font-family: 'Outfit', sans-serif;
        }
    </style>

    <!-- Leaflet Map Assets -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    <style>
        .leaflet-container {
            font-family: 'Outfit', sans-serif;
        }
    </style>
</head>
<body class="bg-slate-50 text-slate-800 min-h-full flex flex-col antialiased selection:bg-emerald-500 selection:text-white">

    <!-- Header / Navbar -->
    <header class="sticky top-0 z-50 backdrop-blur-md bg-white/80 border-b border-slate-100 transition-all duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-20 flex items-center justify-between">
            <a href="/" class="flex items-center gap-3 group">
                <div class="w-10 h-10 rounded-xl bg-gradient-to-tr from-emerald-600 to-teal-400 flex items-center justify-center text-white font-bold text-xl shadow-lg shadow-emerald-500/20 group-hover:scale-105 transition-transform">
                    PM
                </div>
                <div>
                    <span class="font-extrabold text-xl tracking-tight bg-gradient-to-r from-emerald-700 to-teal-600 bg-clip-text text-transparent">Pino Montano</span>
                    <span class="block text-xs font-semibold text-slate-400 uppercase tracking-widest -mt-1">Marketplace</span>
                </div>
            </a>
            
            <nav class="hidden md:flex items-center gap-6 text-sm font-semibold text-slate-600">
                <a href="/#comercios" class="hover:text-emerald-600 transition-colors">Comercios</a>
                <a href="/historia" class="hover:text-emerald-600 transition-colors">Historia</a>
                <a href="/de-donde-vinimos" class="hover:text-emerald-600 transition-colors">Orígenes</a>
                <a href="/hacia-donde-vamos" class="hover:text-emerald-600 transition-colors">Futuro</a>
                <a href="/#contacto" class="hover:text-emerald-600 transition-colors">Contacto</a>
            </nav>

            <div class="flex items-center gap-6">
                <a href="/admin" class="hidden sm:inline-flex text-sm font-bold text-slate-650 hover:text-emerald-600 transition-colors">
                    Acceso Admin
                </a>
                <a href="/" class="inline-flex items-center justify-center px-5 py-2.5 rounded-xl border border-slate-200 bg-white text-slate-700 font-semibold text-sm hover:bg-slate-50 transition-all duration-300 shadow-sm">
                    Volver al Inicio
                </a>
            </div>
        </div>
    </header>

    <!-- Hero / Business Header -->
    <section class="relative bg-gradient-to-b from-slate-900 to-emerald-950 text-white py-16 sm:py-20 overflow-hidden">
        <div class="absolute inset-0 bg-[radial-gradient(circle_at_center,rgba(16,185,129,0.08),transparent_70%)]"></div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="flex flex-col md:flex-row md:items-end md:justify-between gap-6">
                <div>
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-emerald-500/10 text-emerald-400 border border-emerald-500/20 mb-4">
                        {{ $business->category }}
                    </span>
                    <h1 class="text-3xl sm:text-5xl font-extrabold tracking-tight leading-none mb-4">
                        {{ $business->name }}
                    </h1>
                    
                    <!-- Rating and address info -->
                    <div class="flex flex-wrap items-center gap-x-6 gap-y-2 text-sm text-slate-300">
                        <div class="flex items-center gap-1 bg-white/5 px-3 py-1 rounded-full border border-white/10">
                            @if($business->reviews_count > 0)
                                <span class="text-amber-400 text-base">★</span>
                                <span class="font-bold text-white">{{ $business->average_rating }}</span>
                                <span class="text-slate-400">({{ $business->reviews_count }} {{ $business->reviews_count == 1 ? 'opinión' : 'opiniones' }})</span>
                            @else
                                <span class="text-slate-400">Sin opiniones aún</span>
                            @endif
                        </div>
                        @if($business->address)
                            <div class="flex items-center gap-1.5">
                                <svg class="w-4 h-4 text-emerald-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                                <span>{{ $business->address }}</span>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Action Button in Hero -->
                <div class="flex gap-2 shrink-0">
                    @if($business->phone)
                        <a href="tel:{{ str_replace(' ', '', $business->phone) }}" class="px-6 py-3.5 bg-white text-slate-900 font-bold rounded-xl hover:bg-slate-50 transition-colors shadow-md text-sm text-center">
                            Llamar ({{ $business->phone }})
                        </a>
                    @endif
                    @if($business->website)
                        <a href="{{ $business->website }}" target="_blank" class="px-6 py-3.5 bg-emerald-600 text-white font-bold rounded-xl hover:bg-emerald-500 transition-colors shadow-md text-sm text-center">
                            Visitar Sitio Web
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <!-- Main Content Grid -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 sm:py-16 flex-1 w-full">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-12 items-start">
            
            <!-- Left 2 Columns: Description & Map -->
            <div class="lg:col-span-2 space-y-10">
                
                <!-- About / Description -->
                <div class="bg-white rounded-3xl border border-slate-200 p-8 shadow-sm">
                    <h2 class="text-xl font-extrabold text-slate-900 mb-4 pb-3 border-b border-slate-100">Sobre el Negocio</h2>
                    <p class="text-slate-600 text-base leading-relaxed whitespace-pre-line">
                        {{ $business->description }}
                    </p>

                    <!-- Contact Details list -->
                    <div class="mt-8 grid grid-cols-1 sm:grid-cols-2 gap-4 bg-slate-50 p-6 rounded-2xl border border-slate-100 text-sm">
                        <div>
                            <span class="block text-xs font-bold text-slate-450 uppercase tracking-wider">Correo electrónico</span>
                            <span class="block font-semibold text-slate-800 mt-1">{{ $business->email }}</span>
                        </div>
                        @if($business->phone)
                            <div>
                                <span class="block text-xs font-bold text-slate-455 uppercase tracking-wider">Teléfono de contacto</span>
                                <span class="block font-semibold text-slate-800 mt-1">{{ $business->phone }}</span>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Location Map -->
                @if($business->latitude && $business->longitude)
                    <div class="bg-white rounded-3xl border border-slate-200 p-8 shadow-sm">
                        <h2 class="text-xl font-extrabold text-slate-900 mb-4 pb-3 border-b border-slate-100">Ubicación</h2>
                        <div id="single-map" class="w-full h-[350px] rounded-2xl border border-slate-100 z-10"></div>
                        <div class="mt-4 flex items-center gap-2 text-xs text-slate-500">
                            <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"/>
                            </svg>
                            <span>{{ $business->address }}</span>
                        </div>
                    </div>
                @endif

            </div>

            <!-- Right 1 Column: Reviews & Comment Form -->
            <div class="space-y-8">
                
                <!-- Ratings Summary & Form -->
                <div class="bg-white rounded-3xl border border-slate-200 p-8 shadow-sm">
                    <h2 class="text-xl font-extrabold text-slate-900 mb-6">Opiniones de Vecinos</h2>

                    <!-- Alerts for Submission -->
                    @if(session('success'))
                        <div class="mb-6 p-4 bg-emerald-50 border border-emerald-250 rounded-2xl flex items-start gap-2">
                            <svg class="w-5 h-5 text-emerald-600 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <span class="text-xs text-emerald-805 leading-relaxed">{{ session('success') }}</span>
                        </div>
                    @endif

                    @if(session('warning'))
                        <div class="mb-6 p-4 bg-amber-50 border border-amber-250 rounded-2xl flex items-start gap-2">
                            <svg class="w-5 h-5 text-amber-600 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                            </svg>
                            <span class="text-xs text-amber-805 leading-relaxed">{{ session('warning') }}</span>
                        </div>
                    @endif

                    <!-- Validation Errors -->
                    @if($errors->any())
                        <div class="mb-6 p-4 bg-rose-50 border border-rose-250 rounded-2xl">
                            <ul class="list-disc pl-4 text-rose-700 text-xs space-y-1">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <!-- Review Form -->
                    <form action="{{ route('business.review.store', $business->slug) }}" method="POST" class="space-y-4">
                        @csrf
                        <div>
                            <label for="author_name" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Tu Nombre *</label>
                            <input type="text" name="author_name" id="author_name" value="{{ old('author_name') }}" placeholder="Ej: Vecino de Pino Montano" required
                                   class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 text-sm transition-all placeholder-slate-400">
                        </div>

                        <!-- Stars Selector -->
                        <div>
                            <span class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Valoración *</span>
                            <div class="flex items-center gap-1.5" id="star-selector">
                                @for($i = 1; $i <= 5; $i++)
                                    <button type="button" data-value="{{ $i }}" class="star-btn text-2xl text-slate-300 hover:scale-110 transition-transform">★</button>
                                @endfor
                            </div>
                            <input type="hidden" name="rating" id="rating-input" value="{{ old('rating', 5) }}">
                        </div>

                        <div>
                            <label for="comment" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Comentario *</label>
                            <textarea name="comment" id="comment" rows="4" placeholder="Cuéntanos tu experiencia con este negocio..." required
                                      class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 text-sm transition-all placeholder-slate-400 resize-none">{{ old('comment') }}</textarea>
                        </div>

                        <button type="submit" class="w-full py-3 bg-gradient-to-r from-emerald-600 to-teal-500 text-white font-bold rounded-xl text-sm hover:from-emerald-500 hover:to-teal-450 transition-all shadow-md hover:shadow-lg shadow-emerald-500/10 cursor-pointer">
                            Publicar Comentario
                        </button>
                    </form>
                </div>

                <!-- Reviews List -->
                <div class="space-y-4">
                    <h3 class="text-lg font-bold text-slate-900 px-1">Comentarios Recientes ({{ $reviews->count() }})</h3>
                    
                    @if($reviews->isEmpty())
                        <div class="text-center py-8 bg-white rounded-3xl border border-slate-100 shadow-sm px-6">
                            <span class="text-2xl">💬</span>
                            <h4 class="font-bold text-slate-700 mt-2 text-sm">Aún no hay comentarios</h4>
                            <p class="text-slate-400 text-xs mt-1">Sé el primero en dejar tu valoración sobre este negocio del barrio.</p>
                        </div>
                    @else
                        @foreach($reviews as $review)
                            <div class="bg-white rounded-2xl border border-slate-200/80 p-5 shadow-sm space-y-2">
                                <div class="flex items-center justify-between gap-2">
                                    <span class="font-bold text-slate-900 text-sm">{{ $review->author_name }}</span>
                                    <span class="text-[10px] text-slate-450 font-medium">{{ $review->created_at->diffForHumans() }}</span>
                                </div>
                                
                                <!-- Stars -->
                                <div class="flex items-center gap-0.5 text-amber-500 text-xs">
                                    @for($i = 1; $i <= 5; $i++)
                                        <span>{{ $i <= $review->rating ? '★' : '☆' }}</span>
                                    @endfor
                                </div>

                                <p class="text-slate-650 text-xs leading-relaxed">
                                    {{ $review->comment }}
                                </p>
                            </div>
                        @endforeach
                    @endif
                </div>

            </div>

        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-slate-900 text-slate-400 py-12 border-t border-slate-800 mt-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col md:flex-row items-center justify-between gap-6">
            <div class="flex items-center gap-3">
                <div class="w-8 h-8 rounded-lg bg-emerald-600 flex items-center justify-center text-white font-bold text-base">
                    PM
                </div>
                <div class="text-left">
                    <span class="font-bold text-white text-sm">Marketplace Pino Montano</span>
                    <span class="block text-[10px] text-slate-500">© {{ date('Y') }} Todos los derechos reservados.</span>
                </div>
            </div>
            <div class="flex gap-6 text-xs font-semibold text-slate-455">
                <a href="/#comercios" class="hover:text-white transition-colors">Comercios</a>
                <a href="/historia" class="hover:text-white transition-colors">Sobre el Barrio</a>
                <a href="mailto:soporte@pinomontano.ddev.site" class="hover:text-white transition-colors">Soporte</a>
            </div>
            <div class="text-xs text-slate-500">
                Hecho con <span class="text-rose-500">♥</span> en Pino Montano, Sevilla.
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Interactive Stars Selector logic
            var stars = document.querySelectorAll('.star-btn');
            var ratingInput = document.getElementById('rating-input');

            function updateStars(val) {
                stars.forEach(function (star) {
                    var starValue = parseInt(star.getAttribute('data-value'));
                    if (starValue <= val) {
                        star.classList.remove('text-slate-300');
                        star.classList.add('text-amber-400');
                    } else {
                        star.classList.remove('text-amber-400');
                        star.classList.add('text-slate-300');
                    }
                });
            }

            // Init
            updateStars(parseInt(ratingInput.value));

            stars.forEach(function (star) {
                star.addEventListener('click', function () {
                    var val = parseInt(this.getAttribute('data-value'));
                    ratingInput.value = val;
                    updateStars(val);
                });
            });

            // Leaflet Map Initialization for Single Business
            @if($business->latitude && $business->longitude)
                var map = L.map('single-map').setView([{{ $business->latitude }}, {{ $business->longitude }}], 16);

                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    maxZoom: 19,
                    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a>'
                }).addTo(map);

                var marker = L.marker([{{ $business->latitude }}, {{ $business->longitude }}]).addTo(map);
                marker.bindPopup(`
                    <div class="p-1">
                        <h4 class="text-xs font-bold text-slate-900 m-0">{{ $business->name }}</h4>
                        <span class="text-[9px] text-slate-400">{{ $business->address }}</span>
                    </div>
                `).openPopup();
            @endif
        });
    </script>

</body>
</html>
