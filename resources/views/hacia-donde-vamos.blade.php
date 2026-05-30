<!DOCTYPE html>
<html lang="es" class="h-full scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Hacia Dónde Vamos - El Futuro Conectado de Pino Montano</title>
    
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
                <a href="/hacia-donde-vamos" class="text-emerald-600 transition-colors">Futuro</a>
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

    <!-- Hero Section -->
    <section class="relative bg-gradient-to-b from-slate-900 to-emerald-950 text-white py-20 sm:py-28 overflow-hidden">
        <div class="absolute inset-0 bg-[radial-gradient(circle_at_center,rgba(16,185,129,0.1),transparent_70%)]"></div>
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10">
            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-emerald-500/10 text-emerald-400 border border-emerald-500/20 mb-6">
                Línea 3 del Metro y el Pino Montano del mañana
            </span>
            <h1 class="text-4xl sm:text-6xl font-extrabold tracking-tight leading-[1.1]">
                Hacia Dónde <span class="bg-gradient-to-r from-emerald-400 to-teal-300 bg-clip-text text-transparent">Vamos</span>
            </h1>
            <p class="mt-6 text-base sm:text-xl text-slate-300 max-w-2xl mx-auto leading-relaxed">
                Pino Montano afronta la mayor transformación de su historia con las obras de la Línea 3 del Metro. Un salto hacia una Sevilla sin distancias, sostenible y llena de oportunidades comerciales.
            </p>
        </div>
    </section>

    <!-- Content Sections -->
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-16 sm:py-24 space-y-24">
        
        <!-- Section 1: The Metro Connection -->
        <section class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <div>
                <span class="text-xs font-bold uppercase tracking-widest text-emerald-600">CAPÍTULO I: CONECTIVIDAD HISTÓRICA</span>
                <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 mt-2">La Conexión Directa con el Corazón de Sevilla</h2>
                <p class="mt-4 text-slate-600 text-sm sm:text-base leading-relaxed">
                    Históricamente situado en el extremo norte de la ciudad, Pino Montano ha sufrido las dificultades de una conexión por carretera saturada. La llegada de la **Línea 3 del Metro** (tramo norte) pondrá fin a este aislamiento, conectando directamente al barrio con el centro y el sur de Sevilla.
                </p>
                <p class="mt-3 text-slate-605 text-sm sm:text-base leading-relaxed">
                    Con tres estaciones estratégicas en el barrio (Pino Montano Norte, Pino Montano y Los Mares), los vecinos podrán desplazarse en tan solo **12 minutos al Prado de San Sebastián** y conectar de manera fluida con infraestructuras vitales como el **Hospital Virgen Macarena**, campus universitarios clave y la periferia de la ciudad.
                </p>
            </div>
            <div>
                <div class="rounded-3xl overflow-hidden shadow-xl border border-slate-200/60 bg-slate-100 aspect-video">
                    <img src="/images/metro_pinomontano.png" alt="Futura estación de metro en Pino Montano" class="w-full h-full object-cover">
                </div>
            </div>
        </section>

        <!-- Section 2: Commercial Boost -->
        <section class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <div class="order-2 lg:order-1">
                <div class="rounded-3xl overflow-hidden shadow-xl border border-slate-200/60 bg-slate-100 aspect-video">
                    <img src="/images/impulso_comercial.png" alt="Impulso al comercio local de proximidad" class="w-full h-full object-cover">
                </div>
            </div>
            <div class="order-1 lg:order-2">
                <span class="text-xs font-bold uppercase tracking-widest text-emerald-600">CAPÍTULO II: EL MOTOR SOCIOECONÓMICO</span>
                <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 mt-2">Un Gran Impulso para la Economía de Barrio</h2>
                <p class="mt-4 text-slate-600 text-sm sm:text-base leading-relaxed">
                    El metro no es solo movilidad, es un enorme motor económico. La facilidad de transporte atraerá a nuevos visitantes de toda Sevilla a descubrir la riquísima oferta gastronómica y comercial de Pino Montano, dinamizando de forma inédita las calles del barrio.
                </p>
                <p class="mt-3 text-slate-605 text-sm sm:text-base leading-relaxed">
                    Para los negocios locales registrados en nuestro **Marketplace**, esto supone multiplicar la visibilidad de sus locales físicos. Comercios, peluquerías tradicionales y bares de tapas se verán beneficiados por un flujo constante de clientes procedentes de otros distritos, consolidando a Pino Montano como el gran motor comercial del norte sevillano.
                </p>
            </div>
        </section>

        <!-- Section 3: Urbanism and Sustainability -->
        <section class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <div>
                <span class="text-xs font-bold uppercase tracking-widest text-emerald-600">CAPÍTULO III: URBANISMO Y SOSTENIBILIDAD</span>
                <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 mt-2">Un Barrio Sostenible y de Espacios Verdes</h2>
                <p class="mt-4 text-slate-600 text-sm sm:text-base leading-relaxed">
                    La integración del trazado de la Línea 3 viene acompañada de una profunda regeneración urbana. El entorno de las futuras estaciones se transformará con plazas públicas peatonales más amplias, arbolado autóctono y carriles bici mejorados.
                </p>
                <p class="mt-3 text-slate-605 text-sm sm:text-base leading-relaxed">
                    Se prevé una drástica reducción del uso del coche particular en favor del transporte eléctrico limpio, aliviando las emisiones y la contaminación acústica. Esto permitirá que Pino Montano avance hacia un modelo de barrio del futuro: más verde, más transitable para los peatones y con mayor calidad de vida para todas las familias.
                </p>
            </div>
            <div>
                <div class="rounded-3xl overflow-hidden shadow-xl border border-slate-200/60 bg-slate-100 aspect-video">
                    <img src="/images/metro_real.jpg" alt="Trazado real del tramo norte de la línea 3 de metro" class="w-full h-full object-cover">
                </div>
            </div>
        </section>

    </div>

    <!-- Call to Action Section -->
    <section class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-16 text-center mb-16">
        <div class="bg-gradient-to-tr from-slate-900 to-emerald-950 rounded-3xl p-8 sm:p-12 shadow-xl relative overflow-hidden text-white">
            <div class="absolute -bottom-10 -right-10 w-40 h-40 bg-emerald-500/10 rounded-full blur-2xl"></div>
            
            <span class="text-emerald-400 text-xs font-bold uppercase tracking-widest">El futuro está aquí</span>
            <h2 class="text-3xl font-extrabold mt-3 tracking-tight">Apoya el Comercio que Hace Barrio</h2>
            <p class="mt-4 text-slate-300 max-w-lg mx-auto text-sm leading-relaxed">
                Conectados con Sevilla y orgullosos de nuestro comercio local. Explora el Marketplace de Pino Montano y compra a tus vecinos para seguir construyendo comunidad.
            </p>
            <div class="mt-8 flex justify-center">
                <a href="/#comercios" class="px-8 py-3.5 bg-emerald-600 text-white font-bold rounded-xl hover:bg-emerald-500 transition-colors shadow-md shadow-emerald-900/20">
                    Explorar el Directorio de Comercios
                </a>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-slate-900 text-slate-400 py-12 border-t border-slate-800 mt-auto">
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
            <div class="flex gap-6 text-xs font-semibold text-slate-550">
                <a href="/#comercios" class="hover:text-white transition-colors">Comercios</a>
                <a href="/historia" class="hover:text-white transition-colors">Historia del Barrio</a>
                <a href="/de-donde-vinimos" class="hover:text-white transition-colors">De Dónde Vinimos</a>
                <a href="/hacia-donde-vamos" class="hover:text-white transition-colors text-emerald-400">Hacia Dónde Vamos</a>
            </div>
            <div class="text-xs text-slate-500">
                Hecho con <span class="text-rose-500">♥</span> en Pino Montano, Sevilla.
            </div>
        </div>
    </footer>

</body>
</html>
