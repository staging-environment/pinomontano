<!DOCTYPE html>
<html lang="es" class="h-full scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pino Montano - Marketplace de Negocios Locales</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Styles / Scripts -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <style>
            /* Fallback en caso de que no esté compilado aún */
            body { font-family: 'Outfit', sans-serif; }
        </style>
    @endif
    <style>
        body {
            font-family: 'Outfit', sans-serif;
            position: relative;
        }
        body::before {
            content: "";
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -10;
            background-image: url('/images/filament_color.png');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            opacity: 0.25;
            pointer-events: none;
        }
    </style>
    <!-- Leaflet Map Assets -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    <style>
        .leaflet-container {
            font-family: 'Outfit', sans-serif;
        }
        .custom-marker-icon {
            background: none !important;
            border: none !important;
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
                <a href="#comercios" class="hover:text-emerald-600 transition-colors">Comercios</a>
                <a href="{{ route('barrio.history') }}" class="hover:text-emerald-600 transition-colors">Historia</a>
                <a href="{{ route('barrio.name-origin') }}" class="hover:text-emerald-600 transition-colors">El Nombre</a>
                <a href="{{ route('barrio.origins') }}" class="hover:text-emerald-600 transition-colors">Orígenes</a>
                <a href="{{ route('barrio.future') }}" class="hover:text-emerald-600 transition-colors">Futuro</a>
                <a href="#contacto" class="hover:text-emerald-600 transition-colors">Contacto</a>
            </nav>

            <div class="flex items-center gap-6">
                <a href="/admin" class="hidden sm:inline-flex text-sm font-bold text-slate-650 hover:text-emerald-600 transition-colors">
                    Acceso Admin
                </a>
                <a href="{{ route('business.register') }}" class="inline-flex items-center justify-center px-5 py-2.5 rounded-xl bg-slate-900 text-white font-semibold text-sm hover:bg-emerald-600 transition-all duration-300 shadow-md hover:shadow-lg hover:shadow-emerald-500/20 hover:-translate-y-0.5">
                    Sumar mi Comercio
                </a>
            </div>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="relative overflow-hidden bg-gradient-to-b from-slate-100/80 via-white to-slate-50 py-16 sm:py-24">
        <!-- Background Elements -->
        <div class="absolute inset-0 -z-10 overflow-hidden">
            <div class="absolute -top-40 -right-40 w-96 h-96 rounded-full bg-emerald-100 blur-3xl opacity-60"></div>
            <div class="absolute top-1/2 -left-40 w-96 h-96 rounded-full bg-teal-100 blur-3xl opacity-60"></div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <div class="flex flex-wrap justify-center gap-3 mb-6">
                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-emerald-50 text-emerald-700 border border-emerald-100">
                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                    Impulsando el comercio de Pino Montano
                </span>
                <a href="https://t.me/pinomontanomarketplace" target="_blank" class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-sky-50 text-sky-700 border border-sky-100 hover:bg-sky-100 transition-colors shadow-sm">
                    <svg class="w-3.5 h-3.5 fill-current text-[#0088cc]" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm4.64 6.8c-.15 1.58-.8 5.42-1.13 7.19-.14.75-.42 1-.68 1.03-.58.05-1.02-.38-1.58-.75-.88-.58-1.38-.94-2.23-1.5-.99-.65-.35-1.01.22-1.59.15-.15 2.71-2.48 2.76-2.69.01-.03.01-.14-.07-.2-.08-.06-.19-.04-.27-.02-.12.02-1.96 1.25-5.54 3.69-.52.36-1 .53-1.42.52-.47-.01-1.37-.26-2.03-.48-.82-.27-1.47-.42-1.42-.88.03-.24.35-.49.97-.74 3.79-1.65 6.32-2.73 7.57-3.26 3.6-1.5 4.35-1.76 4.84-1.77.11 0 .35.03.5.16.13.1.17.24.18.34-.01.06-.01.12-.02.18z"/>
                    </svg>
                    Canal de Telegram
                </a>
                <a href="https://www.facebook.com/1181578651701504" target="_blank" class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-blue-50 text-blue-700 border border-blue-100 hover:bg-blue-100 transition-colors shadow-sm">
                    <svg class="w-3.5 h-3.5 fill-current text-[#1877F2]" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path d="M22 12c0-5.52-4.48-10-10-10S2 6.48 2 12c0 4.84 3.44 8.87 8.02 9.71v-6.86H7.56v-2.85h2.46V9.81c0-2.42 1.49-3.77 3.63-3.77 1.02 0 1.9.08 2.15.11v2.5h-1.48c-1.18 0-1.54.56-1.54 1.39v1.82h2.77l-.36 2.85h-2.41v6.87C18.56 20.88 22 16.85 22 12z"/>
                    </svg>
                    Facebook
                </a>
                <a href="https://www.instagram.com/jarodriguezbonilla" target="_blank" class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-pink-50 text-pink-700 border border-pink-100 hover:bg-pink-100 transition-colors shadow-sm">
                    <svg class="w-3.5 h-3.5 fill-current text-[#E1306C]" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.92-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.051.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/>
                    </svg>
                    Instagram
                </a>
            </div>
            <h1 class="text-4xl sm:text-6xl font-extrabold text-slate-900 tracking-tight max-w-3xl mx-auto leading-[1.1]">
                Descubre los comercios y servicios de <span class="bg-gradient-to-r from-emerald-600 via-emerald-500 to-teal-500 bg-clip-text text-transparent">Pino Montano</span>
            </h1>
            <p class="mt-6 text-lg text-slate-500 max-w-xl mx-auto leading-relaxed">
                Apoya a los comercios locales. Encuentra desde bares tradicionales y panaderías artesanas hasta talleres de confianza y peluquerías en tu propio barrio.
            </p>

            <!-- Search Form -->
            <div class="mt-10 max-w-2xl mx-auto">
                <form action="{{ url('/') }}#comercios" method="GET" class="p-2 bg-white rounded-2xl shadow-xl shadow-slate-200/80 border border-slate-100 flex flex-col sm:flex-row gap-2">
                    @if(request('category'))
                        <input type="hidden" name="category" value="{{ request('category') }}">
                    @endif
                    <div class="flex-1 relative flex items-center">
                        <svg class="absolute left-4 w-5 h-5 text-slate-450" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                        <input type="text" name="search" value="{{ $search }}" placeholder="¿Qué negocio estás buscando?" class="w-full pl-12 pr-4 py-3 bg-transparent text-slate-800 placeholder-slate-400 focus:outline-none text-base">
                    </div>
                    <button type="submit" class="px-8 py-3.5 bg-gradient-to-r from-emerald-600 to-teal-500 text-white font-bold rounded-xl hover:from-emerald-500 hover:to-teal-450 transition-all shadow-md hover:shadow-lg shadow-emerald-500/10 active:scale-98 cursor-pointer">
                        Buscar Negocios
                    </button>
                </form>
            </div>

            <!-- Categories Filter -->
            <div id="comercios" class="flex flex-col md:flex-row md:items-center justify-between gap-6 mt-16 border-t border-slate-200/60 pt-10 text-left scroll-mt-24">
                <div>
                    <h2 class="text-2xl font-extrabold text-slate-900 tracking-tight">Directorio de Negocios</h2>
                    <p class="text-sm text-slate-500 mt-1">Explora los comercios según tu necesidad</p>
                </div>

                <div class="flex flex-wrap gap-2">
                    <a href="{{ request()->fullUrlWithQuery(['category' => null, 'search' => request('search')]) }}#comercios" 
                       class="px-4 py-2 rounded-xl text-sm font-semibold transition-all duration-205 {{ !$category ? 'bg-emerald-600 text-white shadow-md shadow-emerald-500/15' : 'bg-white text-slate-600 border border-slate-200 hover:border-slate-300 hover:bg-slate-50' }}">
                        Todos
                    </a>
                    @foreach($categories as $cat)
                        <a href="{{ request()->fullUrlWithQuery(['category' => $cat, 'search' => request('search')]) }}#comercios" 
                           class="px-4 py-2 rounded-xl text-sm font-semibold transition-all duration-205 {{ $category === $cat ? 'bg-emerald-600 text-white shadow-md shadow-emerald-500/15' : 'bg-white text-slate-600 border border-slate-200 hover:border-slate-300 hover:bg-slate-50' }}">
                            {{ $cat }}
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <!-- Marketplace Section -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">

        <!-- Search Results Notification -->
        @if($search || $category)
            <div class="flex items-center justify-between bg-slate-100 rounded-2xl px-6 py-4 mb-8 text-sm text-slate-600 border border-slate-200/50">
                <div class="flex items-center gap-2">
                    <span class="font-semibold text-slate-800">Filtrado activo:</span>
                    @if($search)
                        <span class="bg-white border border-slate-200 px-2.5 py-1 rounded-lg text-xs font-medium">Búsqueda: "{{ $search }}"</span>
                    @endif
                    @if($category)
                        <span class="bg-white border border-slate-200 px-2.5 py-1 rounded-lg text-xs font-medium">Categoría: "{{ $category }}"</span>
                    @endif
                </div>
                <a href="{{ url('/') }}#comercios" class="text-emerald-600 hover:text-emerald-700 font-bold transition-colors">Limpiar Filtros</a>
            </div>
        @endif

        <!-- Interactive Map -->
        <div class="mb-12 bg-white p-4 rounded-3xl border border-slate-200/80 shadow-sm relative z-10">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-4 px-2">
                <div class="flex items-center gap-2">
                    <div class="w-2.5 h-2.5 rounded-full bg-emerald-500 animate-ping"></div>
                    <h3 class="font-extrabold text-slate-900 tracking-tight text-sm sm:text-base">Mapa de Comercios en Pino Montano</h3>
                </div>
                
                <!-- Client-side Name Filter -->
                <div class="relative w-full sm:w-72">
                    <svg class="absolute left-3.5 top-3 w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                    <input type="text" id="name-filter" placeholder="Filtrar por nombre..." class="w-full pl-10 pr-4 py-2 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 text-xs transition-all placeholder-slate-400 text-slate-800">
                </div>
            </div>
            <div id="map" class="w-full h-[450px] rounded-2xl border border-slate-100"></div>
        </div>

        <!-- Businesses Grid -->
        <div id="grid-parent">
            @if($businesses->isEmpty())
                <div class="text-center py-20 bg-white rounded-3xl border border-slate-200/80 shadow-sm max-w-xl mx-auto px-6">
                    <div class="w-16 h-16 bg-slate-100 rounded-full flex items-center justify-center mx-auto text-slate-400 mb-4">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-slate-900">No encontramos negocios</h3>
                    <p class="text-slate-500 mt-2 text-sm">Prueba a buscar con otros términos o cambia la categoría seleccionada.</p>
                    <a href="{{ url('/') }}#comercios" class="mt-6 inline-flex px-5 py-2.5 bg-slate-900 text-white rounded-xl text-sm font-semibold hover:bg-slate-800 transition-colors">Mostrar Todos</a>
                </div>
            @else
                <div id="business-grid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($businesses as $business)
                        <div class="business-card group bg-white rounded-3xl border transition-all duration-300 flex flex-col justify-between overflow-hidden relative shadow-sm hover:shadow-xl hover:shadow-slate-150 hover:-translate-y-1 {{ $business->is_featured ? 'border-emerald-200 ring-2 ring-emerald-500/10 bg-gradient-to-b from-emerald-50/10 to-white' : 'border-slate-200/85' }}" data-name="{{ mb_strtolower($business->name, 'UTF-8') }}">
                        
                        <!-- Top Banner / Badge -->
                        @if($business->is_featured)
                            <div class="absolute top-4 right-4 z-10">
                                <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-xs font-bold bg-amber-500 text-white shadow-md shadow-amber-500/20">
                                    <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                    </svg>
                                    Destacado
                                </span>
                            </div>
                        @endif

                        <div class="p-8">
                            <!-- Category & Meta -->
                            <div class="flex items-center justify-between gap-2 flex-wrap">
                                <span class="text-xs font-bold text-emerald-600 uppercase tracking-widest bg-emerald-50 px-2.5 py-1 rounded-lg border border-emerald-100/60">
                                    {{ $business->category }}
                                </span>
                                <div class="flex items-center gap-1 bg-amber-50 px-2 py-1 rounded-lg border border-amber-100">
                                    @if($business->reviews_count > 0)
                                        <span class="text-amber-500 text-xs font-extrabold">★</span>
                                        <span class="text-xs font-bold text-amber-800">{{ $business->average_rating }}</span>
                                        <span class="text-[10px] text-amber-600 font-semibold">({{ $business->reviews_count }})</span>
                                    @else
                                        <span class="text-[10px] text-slate-400 font-semibold">Sin opiniones</span>
                                    @endif
                                </div>
                            </div>

                            <!-- Title -->
                            <h3 class="text-xl font-bold text-slate-900 mt-4 group-hover:text-emerald-600 transition-colors">
                                <a href="{{ route('business.show', $business->slug) }}">{{ $business->name }}</a>
                            </h3>

                            <!-- Description -->
                            <p class="text-sm text-slate-500 mt-3 line-clamp-3 leading-relaxed">
                                {{ $business->description }}
                            </p>

                            <!-- Business Details -->
                            <div class="mt-6 space-y-3 pt-6 border-t border-slate-100">
                                @if($business->address)
                                    <div class="flex items-start gap-2.5 text-xs text-slate-500">
                                        <svg class="w-4 h-4 text-slate-400 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        </svg>
                                        <span>{{ $business->address }}</span>
                                    </div>
                                @endif
                                @if($business->phone)
                                    <div class="flex items-center gap-2.5 text-xs text-slate-500">
                                        <svg class="w-4 h-4 text-slate-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h2.28a1 1 0 01.94.725l.548 2.2a1 1 0 01-.321.988l-1.305.98a10.582 10.582 0 004.872 4.872l.98-1.305a1 1 0 01.988-.321l2.2.548a1 1 0 01.725.94V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                        </svg>
                                        <span>{{ $business->phone }}</span>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="p-8 pt-0 flex gap-2">
                            <a href="{{ route('business.show', $business->slug) }}" class="flex-1 inline-flex items-center justify-center gap-1.5 px-4 py-2.5 rounded-xl bg-slate-950 text-white font-bold text-xs hover:bg-emerald-600 transition-colors shadow-sm">
                                Ver Ficha
                            </a>
                            @if($business->phone)
                                <a href="tel:{{ str_replace(' ', '', $business->phone) }}" class="inline-flex items-center justify-center px-4 py-2.5 rounded-xl border border-slate-200 text-slate-700 font-semibold text-xs hover:bg-slate-50 active:bg-slate-100 transition-colors">
                                    Llamar
                                </a>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
    </section>

    <!-- Neighborhood History Section -->
    <section id="sobre-el-barrio" class="bg-gradient-to-br from-slate-900 to-emerald-950 text-white py-20 relative overflow-hidden">
        <div class="absolute inset-0 bg-[radial-gradient(circle_at_top_right,rgba(16,185,129,0.08),transparent_50%)]"></div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="text-center max-w-3xl mx-auto mb-16">
                <span class="text-xs font-bold uppercase tracking-widest text-emerald-450 bg-emerald-500/10 px-3 py-1 rounded-full border border-emerald-500/20">Historia e Identidad</span>
                <h2 class="text-3xl sm:text-5xl font-extrabold tracking-tight mt-4">
                    La Historia de Pino Montano
                </h2>
                <p class="mt-4 text-slate-350 text-base sm:text-lg">
                    De tierras agrícolas a uno de los barrios más dinámicos y con mayor tejido comercial y social de la Sevilla obrera.
                </p>
            </div>

            <!-- Interactive Timeline / Milestones -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <!-- Milestone 1 -->
                <div class="bg-white/5 backdrop-blur-md border border-white/10 rounded-3xl p-8 hover:bg-white/10 transition-all duration-300 hover:-translate-y-1">
                    <div class="w-12 h-12 rounded-2xl bg-emerald-500/20 border border-emerald-500/30 flex items-center justify-center text-emerald-400 font-extrabold text-lg mb-6 shadow-inner">
                        1
                    </div>
                    <span class="text-xs font-semibold text-emerald-400 tracking-wider">RAÍCES MILENARIAS</span>
                    <h3 class="text-xl font-bold text-white mt-2">Villas, Norias y Cortijos</h3>
                    <p class="mt-4 text-sm text-slate-400 leading-relaxed">
                        Desde asentamientos prehistóricos, villas romanas y regadíos andalusíes hasta el histórico **Cortijo de Pino Montano**, esta tierra ha sido durante siglos el pulmón agrícola de Sevilla.
                    </p>
                </div>

                <!-- Milestone 2 -->
                <div class="bg-white/5 backdrop-blur-md border border-white/10 rounded-3xl p-8 hover:bg-white/10 transition-all duration-300 hover:-translate-y-1">
                    <div class="w-12 h-12 rounded-2xl bg-emerald-500/20 border border-emerald-500/30 flex items-center justify-center text-emerald-400 font-extrabold text-lg mb-6 shadow-inner">
                        2
                    </div>
                    <span class="text-xs font-semibold text-emerald-400 tracking-wider">AÑOS 70 y 80</span>
                    <h3 class="text-xl font-bold text-white mt-2">Nacimiento del Barrio</h3>
                    <p class="mt-4 text-sm text-slate-400 leading-relaxed">
                        Se levantan los primeros bloques de pisos residenciales para acoger a familias trabajadoras. Nace así la fuerte identidad de un barrio unido, forjado con la solidaridad de sus vecinos desde el primer día.
                    </p>
                </div>

                <!-- Milestone 3 -->
                <div class="bg-white/5 backdrop-blur-md border border-white/10 rounded-3xl p-8 hover:bg-white/10 transition-all duration-300 hover:-translate-y-1">
                    <div class="w-12 h-12 rounded-2xl bg-emerald-500/20 border border-emerald-500/30 flex items-center justify-center text-emerald-400 font-extrabold text-lg mb-6 shadow-inner">
                        3
                    </div>
                    <span class="text-xs font-semibold text-emerald-400 tracking-wider">AÑOS 90</span>
                    <h3 class="text-xl font-bold text-white mt-2">Consolidación y Lucha</h3>
                    <p class="mt-4 text-sm text-slate-400 leading-relaxed">
                        A través de movimientos asociativos y demandas vecinales se consiguieron los primeros colegios, centros de salud, parques como el **Parque de Miraflores** y las conexiones de transporte.
                    </p>
                </div>

                <!-- Milestone 4 -->
                <div class="bg-white/5 backdrop-blur-md border border-white/10 rounded-3xl p-8 hover:bg-white/10 transition-all duration-300 hover:-translate-y-1">
                    <div class="w-12 h-12 rounded-2xl bg-emerald-500/20 border border-emerald-500/30 flex items-center justify-center text-emerald-400 font-extrabold text-lg mb-6 shadow-inner">
                        4
                    </div>
                    <span class="text-xs font-semibold text-emerald-400 tracking-wider">ACTUALIDAD</span>
                    <h3 class="text-xl font-bold text-white mt-2">El Motor del Comercio</h3>
                    <p class="mt-4 text-sm text-slate-400 leading-relaxed">
                        Pino Montano es hoy en día uno de los barrios más dinámicos y poblados de Sevilla, orgulloso de su historia de autogestión y con una amplísima red de pequeños comercios que impulsan la economía local.
                    </p>
                </div>
            </div>
            
            <div class="mt-12 text-center">
                <a href="{{ route('barrio.history') }}" class="inline-flex items-center gap-2 px-6 py-3 rounded-xl bg-emerald-600 hover:bg-emerald-500 text-white font-bold text-sm shadow-md transition-all">
                    <span>Ver Historia Completa con Fotos e Inicios</span>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                    </svg>
                </a>
            </div>
        </div>
    </section>

    <!-- Register Business CTA Section -->
    <section id="unirse-cta" class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-20 text-center">
        <div class="bg-white rounded-3xl border border-slate-200 p-8 sm:p-12 shadow-xl shadow-slate-200/40 relative overflow-hidden">
            <div class="absolute -bottom-10 -right-10 w-40 h-40 bg-teal-50 rounded-full blur-2xl opacity-80"></div>
            <div class="absolute -top-10 -left-10 w-40 h-40 bg-emerald-50 rounded-full blur-2xl opacity-80"></div>
            
            <span class="text-emerald-600 text-xs font-bold uppercase tracking-widest">¿Eres comerciante?</span>
            <h2 class="text-3xl font-extrabold text-slate-900 mt-3 tracking-tight">Une tu negocio al Marketplace del barrio</h2>
            <p class="mt-4 text-slate-500 max-w-lg mx-auto text-sm leading-relaxed">
                Queremos dar visibilidad a todos los comercios y servicios de Pino Montano de manera gratuita. Registra tu negocio para que tus vecinos puedan encontrarte fácilmente.
            </p>
            <div class="mt-8 flex flex-col sm:flex-row justify-center gap-3">
                <a href="{{ route('business.register') }}" class="px-8 py-3.5 bg-slate-900 text-white font-bold rounded-xl hover:bg-slate-800 transition-colors shadow-md">
                    Comenzar Registro Online
                </a>
                <a href="tel:600000000" class="px-8 py-3.5 bg-slate-50 text-slate-700 border border-slate-200 font-bold rounded-xl hover:bg-slate-100 transition-colors">
                    Llamar al Coordinador
                </a>
            </div>
        </div>
    </section>

    <!-- Contact Form Section -->
    <section id="contacto" class="relative bg-slate-100/50 border-t border-b border-slate-200/60 py-20 overflow-hidden">
        <!-- Background decorative elements -->
        <div class="absolute inset-0 -z-10 overflow-hidden">
            <div class="absolute top-1/2 -right-40 w-96 h-96 rounded-full bg-emerald-100 blur-3xl opacity-40"></div>
            <div class="absolute -bottom-20 left-10 w-96 h-96 rounded-full bg-teal-100 blur-3xl opacity-40"></div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-stretch">
                <!-- Left info block -->
                <div class="lg:col-span-5 flex flex-col justify-between space-y-8">
                    <div>
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-emerald-50 text-emerald-700 border border-emerald-100 mb-6">
                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                            Contacto Oficial
                        </span>
                        <h2 class="text-3xl sm:text-4xl font-extrabold text-slate-900 tracking-tight">¿Tienes alguna duda o sugerencia?</h2>
                        <p class="mt-4 text-slate-500 text-sm sm:text-base leading-relaxed">
                            Ponte en contacto con el equipo del Marketplace de Pino Montano. Si tienes problemas con el registro de tu comercio, ideas de mejora o quieres sugerir nuevas características, envíanos un mensaje.
                        </p>
                    </div>

                    <div class="space-y-6">
                        <!-- Info item 1 -->
                        <div class="flex items-start gap-4">
                            <div class="w-12 h-12 rounded-xl bg-white border border-slate-200 shadow-sm flex items-center justify-center text-emerald-600 shrink-0">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-bold text-slate-900 text-sm">Correo Electrónico</h4>
                                <a href="mailto:soporte@pinomontano.ddev.site" class="text-xs text-emerald-600 hover:text-emerald-700 font-semibold transition-colors mt-0.5 block">soporte@pinomontano.ddev.site</a>
                            </div>
                        </div>

                        <!-- Info item 2 -->
                        <div class="flex items-start gap-4">
                            <div class="w-12 h-12 rounded-xl bg-white border border-slate-200 shadow-sm flex items-center justify-center text-emerald-600 shrink-0">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-bold text-slate-900 text-sm">Ubicación de Referencia</h4>
                                <span class="text-xs text-slate-500 mt-0.5 block">Bulevar de Pino Montano, Sevilla</span>
                            </div>
                        </div>
                    </div>

                    <div class="pt-6 border-t border-slate-200/80 text-xs text-slate-400">
                        Responderemos a tu consulta en un plazo máximo de 24/48 horas laborables.
                    </div>
                </div>

                <!-- Right form block -->
                <div class="lg:col-span-7">
                    <div class="bg-white rounded-3xl border border-slate-200/80 p-8 sm:p-10 shadow-xl shadow-slate-100 relative overflow-hidden">
                        
                        <!-- Success message -->
                        @if(session('contact_success'))
                            <div class="mb-6 p-5 bg-emerald-50 border border-emerald-200 rounded-2xl flex items-start gap-3">
                                <svg class="w-5 h-5 text-emerald-600 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                <div>
                                    <h4 class="font-bold text-emerald-950 text-sm">¡Mensaje Recibido!</h4>
                                    <p class="text-emerald-700 text-xs mt-1 leading-relaxed">{{ session('contact_success') }}</p>
                                </div>
                            </div>
                        @endif

                        <!-- General errors block -->
                        @if($errors->any() && (old('contact_form') === '1' || session()->has('errors')))
                            <div class="mb-6 p-5 bg-rose-50 border border-rose-200 rounded-2xl">
                                <div class="flex items-center gap-2 text-rose-800 font-bold text-sm mb-2">
                                    <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                                    </svg>
                                    Corrige los siguientes detalles:
                                </div>
                                <ul class="list-disc pl-5 text-rose-700 text-xs space-y-1">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('contact.store') }}" method="POST" class="space-y-6">
                            @csrf
                            <input type="hidden" name="contact_form" value="1">
                            
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                                <div>
                                    <label for="contact_name" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Nombre completo *</label>
                                    <input type="text" name="name" id="contact_name" value="{{ old('name') }}" placeholder="Ej: María García" required
                                           class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 text-sm transition-all placeholder-slate-400">
                                </div>
                                <div>
                                    <label for="contact_email" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Correo electrónico *</label>
                                    <input type="email" name="email" id="contact_email" value="{{ old('email') }}" placeholder="Ej: maria@correo.com" required
                                           class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 text-sm transition-all placeholder-slate-400">
                                </div>
                            </div>

                            <div>
                                <label for="contact_subject" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Asunto (Opcional)</label>
                                <input type="text" name="subject" id="contact_subject" value="{{ old('subject') }}" placeholder="Ej: Sugerencia de nueva categoría"
                                       class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 text-sm transition-all placeholder-slate-400">
                            </div>

                            <div>
                                <label for="contact_message" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Mensaje *</label>
                                <textarea name="message" id="contact_message" rows="5" placeholder="Escribe aquí tu consulta con al menos 10 caracteres..." required
                                          class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 text-sm transition-all placeholder-slate-400 resize-none">{{ old('message') }}</textarea>
                            </div>

                            <button type="submit" class="w-full py-4 bg-gradient-to-r from-emerald-600 to-teal-500 text-white font-bold rounded-xl text-sm hover:from-emerald-500 hover:to-teal-450 transition-all shadow-md hover:shadow-lg shadow-emerald-500/10 cursor-pointer">
                                Enviar Mensaje de Contacto
                            </button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- Footer -->
    <footer class="mt-auto bg-slate-900 text-slate-400 py-12 border-t border-slate-800">
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
            <div class="flex gap-6 text-xs font-semibold text-slate-455 flex-wrap justify-center">
                <a href="#comercios" class="hover:text-white transition-colors">Comercios</a>
                <a href="{{ route('barrio.history') }}" class="hover:text-white transition-colors">Sobre el Barrio</a>
                <a href="https://t.me/pinomontanomarketplace" target="_blank" class="hover:text-white transition-colors flex items-center gap-1.5">
                    <svg class="w-3.5 h-3.5 fill-current text-[#0088cc]" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm4.64 6.8c-.15 1.58-.8 5.42-1.13 7.19-.14.75-.42 1-.68 1.03-.58.05-1.02-.38-1.58-.75-.88-.58-1.38-.94-2.23-1.5-.99-.65-.35-1.01.22-1.59.15-.15 2.71-2.48 2.76-2.69.01-.03.01-.14-.07-.2-.08-.06-.19-.04-.27-.02-.12.02-1.96 1.25-5.54 3.69-.52.36-1 .53-1.42.52-.47-.01-1.37-.26-2.03-.48-.82-.27-1.47-.42-1.42-.88.03-.24.35-.49.97-.74 3.79-1.65 6.32-2.73 7.57-3.26 3.6-1.5 4.35-1.76 4.84-1.77.11 0 .35.03.5.16.13.1.17.24.18.34-.01.06-.01.12-.02.18z"/>
                    </svg>
                    Telegram
                </a>
                <a href="https://www.facebook.com/1181578651701504" target="_blank" class="hover:text-white transition-colors flex items-center gap-1.5">
                    <svg class="w-3.5 h-3.5 fill-current text-[#1877F2]" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path d="M22 12c0-5.52-4.48-10-10-10S2 6.48 2 12c0 4.84 3.44 8.87 8.02 9.71v-6.86H7.56v-2.85h2.46V9.81c0-2.42 1.49-3.77 3.63-3.77 1.02 0 1.9.08 2.15.11v2.5h-1.48c-1.18 0-1.54.56-1.54 1.39v1.82h2.77l-.36 2.85h-2.41v6.87C18.56 20.88 22 16.85 22 12z"/>
                    </svg>
                    Facebook
                </a>
                <a href="https://www.instagram.com/jarodriguezbonilla" target="_blank" class="hover:text-white transition-colors flex items-center gap-1.5">
                    <svg class="w-3.5 h-3.5 fill-current text-[#E1306C]" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.92-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.051.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/>
                    </svg>
                    Instagram
                </a>
                <a href="mailto:soporte@pinomontano.ddev.site" class="hover:text-white transition-colors">Soporte</a>
            </div>
            <div class="text-xs text-slate-500">
                Hecho con <span class="text-rose-500">♥</span> en Pino Montano, Sevilla.
            </div>
        </div>
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Center of Pino Montano
            var map = L.map('map').setView([37.426, -5.965], 15);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19,
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a>'
            }).addTo(map);

            // Custom markers by category
            function getCustomIcon(category) {
                var emoji = '📍';
                var colorClass = 'bg-slate-500 border-slate-700 shadow-slate-500/20';

                switch (category) {
                    case 'Restauración':
                        emoji = '🍔';
                        colorClass = 'bg-rose-500 border-rose-700 shadow-rose-500/20';
                        break;
                    case 'Alimentación':
                        emoji = '🛒';
                        colorClass = 'bg-amber-500 border-amber-700 shadow-amber-500/20';
                        break;
                    case 'Servicios':
                        emoji = '🛠️';
                        colorClass = 'bg-blue-500 border-blue-700 shadow-blue-500/20';
                        break;
                    case 'Salud y Belleza':
                        emoji = '💖';
                        colorClass = 'bg-emerald-500 border-emerald-700 shadow-emerald-500/20';
                        break;
                    case 'Peluquerías':
                        emoji = '✂️';
                        colorClass = 'bg-indigo-500 border-indigo-700 shadow-indigo-500/20';
                        break;
                    case 'Otros':
                    default:
                        emoji = '📍';
                        colorClass = 'bg-slate-500 border-slate-700 shadow-slate-500/20';
                        break;
                }

                return L.divIcon({
                    className: 'custom-marker-icon',
                    html: `<div class="flex items-center justify-center w-8 h-8 rounded-full border-2 border-white text-white font-bold shadow-lg ${colorClass} hover:scale-115 transition-all duration-200" style="font-size: 16px; line-height: 1;">${emoji}</div>`,
                    iconSize: [32, 32],
                    iconAnchor: [16, 16],
                    popupAnchor: [0, -16]
                });
            }

            // Storing marker items with metadata
            var markerItems = [];

            @foreach($businesses as $business)
                @if($business->latitude && $business->longitude)
                    var marker = L.marker([{{ $business->latitude }}, {{ $business->longitude }}], { icon: getCustomIcon("{{ $business->category }}") }).addTo(map);
                    marker.bindPopup(`
                        <div class="p-2 min-w-[200px]">
                            <span class="inline-block text-[10px] font-bold text-emerald-600 uppercase tracking-widest bg-emerald-50 px-2 py-0.5 rounded border border-emerald-100/60 mb-2">
                                {{ $business->category }}
                            </span>
                            <h4 class="text-sm font-bold text-slate-900 m-0">{{ $business->name }}</h4>
                            <p class="text-xs text-slate-500 my-1 line-clamp-2">{{ $business->description }}</p>
                            
                            <div class="flex items-center gap-1 my-1.5">
                                @if($business->reviews_count > 0)
                                    <span class="text-amber-500 text-xs">★</span>
                                    <span class="text-xs font-bold text-slate-700">{{ $business->average_rating }}</span>
                                    <span class="text-[10px] text-slate-400">({{ $business->reviews_count }})</span>
                                @else
                                    <span class="text-[10px] text-slate-400">Sin opiniones</span>
                                @endif
                            </div>

                            <a href="{{ route('business.show', $business->slug) }}" class="mt-2 block text-center py-1.5 px-3 bg-slate-950 text-white font-bold rounded-lg text-[10px] hover:bg-emerald-600 transition-colors">
                                Ver Ficha
                            </a>
                        </div>
                    `);
                    markerItems.push({
                        marker: marker,
                        name: "{{ mb_strtolower($business->name, 'UTF-8') }}"
                    });
                @endif
            @endforeach

            // Default bounding box adjust
            if (markerItems.length > 0) {
                var group = new L.featureGroup(markerItems.map(item => item.marker));
                map.fitBounds(group.getBounds().pad(0.1));
            }

            // Real-time Name Filter Logic
            var nameFilter = document.getElementById('name-filter');
            if (nameFilter) {
                nameFilter.addEventListener('input', function () {
                    var query = nameFilter.value.toLowerCase().normalize("NFD").replace(/[\u0300-\u036f]/g, "");
                    var visibleCardsCount = 0;

                    // Filter cards
                    var cards = document.querySelectorAll('.business-card');
                    cards.forEach(function (card) {
                        var cardName = card.getAttribute('data-name').normalize("NFD").replace(/[\u0300-\u036f]/g, "");
                        if (cardName.includes(query)) {
                            card.style.display = 'flex';
                            visibleCardsCount++;
                        } else {
                            card.style.display = 'none';
                        }
                    });

                    // Manage empty state block
                    var gridParent = document.getElementById('grid-parent');
                    var businessGrid = document.getElementById('business-grid');
                    var noResults = document.getElementById('no-results-client');

                    if (visibleCardsCount === 0) {
                        if (businessGrid) businessGrid.style.display = 'none';
                        if (!noResults) {
                            noResults = document.createElement('div');
                            noResults.id = 'no-results-client';
                            noResults.className = 'text-center py-20 bg-white rounded-3xl border border-slate-200/80 shadow-sm max-w-xl mx-auto px-6';
                            noResults.innerHTML = `
                                <div class="w-16 h-16 bg-slate-100 rounded-full flex items-center justify-center mx-auto text-slate-400 mb-4">
                                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                </div>
                                <h3 class="text-lg font-bold text-slate-900">No encontramos negocios</h3>
                                <p class="text-slate-500 mt-2 text-sm">Prueba a buscar con otros términos en el filtro por nombre.</p>
                            `;
                            gridParent.appendChild(noResults);
                        } else {
                            noResults.style.display = 'block';
                        }
                    } else {
                        if (noResults) noResults.style.display = 'none';
                        if (businessGrid) businessGrid.style.display = 'grid';
                    }

                    // Filter markers
                    var visibleMarkers = [];
                    markerItems.forEach(function (item) {
                        var markerName = item.name.normalize("NFD").replace(/[\u0300-\u036f]/g, "");
                        if (markerName.includes(query)) {
                            if (!map.hasLayer(item.marker)) {
                                item.marker.addTo(map);
                            }
                            visibleMarkers.push(item.marker);
                        } else {
                            if (map.hasLayer(item.marker)) {
                                map.removeLayer(item.marker);
                            }
                        }
                    });

                    // Dynamic map zoom adjust
                    if (visibleMarkers.length > 0) {
                        var group = new L.featureGroup(visibleMarkers);
                        map.fitBounds(group.getBounds().pad(0.1));
                    }
                });
            }
        });
    </script>
    <!-- Tailwind Safelist Trigger for Map Marker Colors -->
    <div class="hidden bg-rose-500 border-rose-700 shadow-rose-500/20 bg-amber-500 border-amber-700 shadow-amber-500/20 bg-blue-500 border-blue-700 shadow-blue-500/20 bg-emerald-500 border-emerald-700 shadow-emerald-500/20 bg-indigo-500 border-indigo-700 shadow-indigo-500/20 bg-slate-500 border-slate-700 shadow-slate-500/20"></div>
</body>
</html>
