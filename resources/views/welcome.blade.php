<!DOCTYPE html>
<html lang="es" class="h-full">
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
            
            <nav class="hidden md:flex items-center gap-8 text-sm font-semibold text-slate-600">
                <a href="#comercios" class="hover:text-emerald-600 transition-colors">Comercios</a>
                <a href="#sobre-el-barrio" class="hover:text-emerald-600 transition-colors">Nuestro Barrio</a>
                <a href="{{ route('business.register') }}" class="hover:text-emerald-600 transition-colors">Registrar mi Negocio</a>
            </nav>

            <div>
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
            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-emerald-50 text-emerald-700 border border-emerald-100 mb-6">
                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                Impulsando el comercio de Pino Montano
            </span>
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
        </div>
    </section>

    <!-- Marketplace Section -->
    <section id="comercios" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 scroll-mt-24">
        <!-- Categories Filter -->
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-6 mb-12 border-b border-slate-200/60 pb-8">
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

        <!-- Businesses Grid -->
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
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($businesses as $business)
                    <div class="group bg-white rounded-3xl border transition-all duration-300 flex flex-col justify-between overflow-hidden relative shadow-sm hover:shadow-xl hover:shadow-slate-150 hover:-translate-y-1 {{ $business->is_featured ? 'border-emerald-200 ring-2 ring-emerald-500/10 bg-gradient-to-b from-emerald-50/10 to-white' : 'border-slate-200/85' }}">
                        
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
                            <span class="text-xs font-bold text-emerald-600 uppercase tracking-widest bg-emerald-50 px-2.5 py-1 rounded-lg border border-emerald-100/60">
                                {{ $business->category }}
                            </span>

                            <!-- Title -->
                            <h3 class="text-xl font-bold text-slate-900 mt-4 group-hover:text-emerald-600 transition-colors">
                                {{ $business->name }}
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
                            @if($business->phone)
                                <a href="tel:{{ str_replace(' ', '', $business->phone) }}" class="flex-1 inline-flex items-center justify-center gap-1.5 px-4 py-2.5 rounded-xl border border-slate-200 text-slate-700 font-semibold text-xs hover:bg-slate-50 active:bg-slate-100 transition-colors">
                                    Llamar
                                </a>
                            @endif
                            @if($business->website)
                                <a href="{{ $business->website }}" target="_blank" class="flex-1 inline-flex items-center justify-center gap-1.5 px-4 py-2.5 rounded-xl bg-slate-950 text-white font-semibold text-xs hover:bg-emerald-600 transition-colors">
                                    Ver Web
                                </a>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
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
                    <span class="text-xs font-semibold text-emerald-400 tracking-wider">ORÍGENES RURALES</span>
                    <h3 class="text-xl font-bold text-white mt-2">Los Cortijos y Huertas</h3>
                    <p class="mt-4 text-sm text-slate-400 leading-relaxed">
                        Hasta mediados del siglo XX, Pino Montano era una llanura agrícola al norte de Sevilla. El histórico **Cortijo de Pino Montano** presidía la zona rodeado de huertas que abastecían a la ciudad.
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
        </div>
    </section>

    <!-- Register Business CTA Section -->
    <section id="contacto" class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-20 text-center">
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
            <div class="flex gap-6 text-xs font-semibold text-slate-455">
                <a href="#comercios" class="hover:text-white transition-colors">Comercios</a>
                <a href="#sobre-el-barrio" class="hover:text-white transition-colors">Sobre el Barrio</a>
                <a href="mailto:soporte@pinomontano.ddev.site" class="hover:text-white transition-colors">Soporte</a>
            </div>
            <div class="text-xs text-slate-500">
                Hecho con <span class="text-rose-500">♥</span> en Pino Montano, Sevilla.
            </div>
        </div>
    </footer>

</body>
</html>
