<!DOCTYPE html>
<html lang="es" class="h-full scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>De Dónde Vinimos - Raíces Milenarias de Pino Montano</title>
    
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
                <img src="/favicon.ico" alt="Pino Montano Logo" class="w-10 h-10 rounded-xl shadow-lg shadow-emerald-500/20 group-hover:scale-105 transition-transform object-contain">
                <div>
                    <span class="font-extrabold text-xl tracking-tight bg-gradient-to-r from-emerald-700 to-teal-600 bg-clip-text text-transparent">Pino Montano</span>
                    <span class="block text-xs font-semibold text-slate-400 uppercase tracking-widest -mt-1">Marketplace</span>
                </div>
            </a>
            
            <nav class="hidden md:flex items-center gap-6 text-sm font-semibold text-slate-600">
                <a href="/#comercios" class="hover:text-emerald-600 transition-colors">Comercios</a>
                <a href="/historia" class="hover:text-emerald-600 transition-colors">Historia</a>
                <a href="/origen-del-nombre" class="hover:text-emerald-600 transition-colors">El Nombre</a>
                <a href="/de-donde-vinimos" class="text-emerald-600 transition-colors">Orígenes</a>
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

    <!-- Hero Section -->
    <section class="relative bg-gradient-to-b from-slate-900 to-emerald-950 text-white py-20 sm:py-28 overflow-hidden">
        <div class="absolute inset-0 bg-[radial-gradient(circle_at_center,rgba(16,185,129,0.1),transparent_70%)]"></div>
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10">
            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-emerald-500/10 text-emerald-400 border border-emerald-500/20 mb-6">
                Arqueología, agricultura y raíces de esta tierra
            </span>
            <h1 class="text-4xl sm:text-6xl font-extrabold tracking-tight leading-[1.1]">
                De Dónde <span class="bg-gradient-to-r from-emerald-400 to-teal-300 bg-clip-text text-transparent">Vinimos</span>
            </h1>
            <p class="mt-6 text-base sm:text-xl text-slate-300 max-w-2xl mx-auto leading-relaxed">
                Antes de los bloques de pisos, el asfalto y el orgullo obrero de Pino Montano, esta tierra era el corazón agrícola que alimentaba a la Sevilla de romanos y andalusíes.
            </p>
        </div>
    </section>

    <!-- Historical Eras -->
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-16 sm:py-24 space-y-24">
        
        <!-- Era 1: Prehistory -->
        <section class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <div>
                <div class="rounded-3xl overflow-hidden shadow-xl border border-slate-200/60 bg-slate-100 aspect-video">
                    <img src="/images/prehistoria.png" alt="Ilustración de la prehistoria en el valle del Guadalquivir" class="w-full h-full object-cover">
                </div>
            </div>
            <div>
                <span class="text-xs font-bold uppercase tracking-widest text-emerald-600">ERA I (HASTA EL SIGLO II A.C.)</span>
                <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 mt-2">La Prehistoria y el Origen del Valle Fértil</h2>
                <p class="mt-4 text-slate-600 text-sm sm:text-base leading-relaxed">
                    Mucho antes de que se construyeran los cortijos, la llanura fluvial al norte de Sevilla ya albergaba vida humana. Las excavaciones y estudios arqueológicos en el actual entorno de Miraflores han revelado asentamientos que se remontan al **tercer milenio a.C.** (período Calcolítico y Edad del Bronce).
                </p>
                <p class="mt-3 text-slate-605 text-sm sm:text-base leading-relaxed">
                    Aquel primer asentamiento de pobladores prehistóricos aprovechó la gran fertilidad del suelo aluvial, regado por los antiguos arroyos de Miraflores y Ranilla. Practicaban una agricultura y ganadería de subsistencia, sentando las bases de una vocación agrícola que perduraría a lo largo de los siglos.
                </p>
            </div>
        </section>

        <!-- Era 2: Roman Era -->
        <section class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <div class="order-2 lg:order-1">
                <span class="text-xs font-bold uppercase tracking-widest text-emerald-600">ERA II (SIGLO I A.C. - V D.C.)</span>
                <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 mt-2">El Granero Romano de Hispalis</h2>
                <p class="mt-4 text-slate-600 text-sm sm:text-base leading-relaxed">
                    Con la integración de la península ibérica en el Imperio Romano, las fértiles tierras de esta zona se convirtieron en un área clave de producción agropecuaria. Se establecieron villas rústicas destinadas a la producción a gran escala para abastecer a la importante urbe vecina de **Hispalis** (Sevilla).
                </p>
                <p class="mt-3 text-slate-605 text-sm sm:text-base leading-relaxed">
                    Los yacimientos arqueológicos documentan la existencia de dependencias agrícolas romanas destinadas al prensado de aceite de oliva, cultivo de trigo y almacenamiento de cosechas. Esta tierra ya era sinónimo de trabajo, producción y sustento para la ciudad.
                </p>
            </div>
            <div class="order-1 lg:order-2">
                <div class="rounded-3xl overflow-hidden shadow-xl border border-slate-200/60 bg-slate-100 aspect-video">
                    <img src="/images/epoca_romana.png" alt="Ilustración de una villa romana en Sevilla" class="w-full h-full object-cover">
                </div>
            </div>
        </section>

        <!-- Era 3: Moorish Era -->
        <section class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <div>
                <div class="rounded-3xl overflow-hidden shadow-xl border border-slate-200/60 bg-slate-100 aspect-video">
                    <img src="/images/origenes_tierra.png" alt="Ilustración de la agricultura andalusí y la torre almohade" class="w-full h-full object-cover">
                </div>
            </div>
            <div>
                <span class="text-xs font-bold uppercase tracking-widest text-emerald-600">ERA III (SIGLO VIII - XIII D.C.)</span>
                <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 mt-2">Al-Ándalus: La Revolución de las Huertas</h2>
                <p class="mt-4 text-slate-600 text-sm sm:text-base leading-relaxed">
                    Durante el periodo andalusí, la vega experimentó una revolución tecnológica y agrícola. Los musulmanes introdujeron nuevos cultivos y perfeccionaron el regadío mediante el uso de **norias de madera** y canalizaciones de acequias conectadas a los cauces de agua locales.
                </p>
                <p class="mt-3 text-slate-605 text-sm sm:text-base leading-relaxed">
                    Bajo el dominio almohade (siglos XII-XIII) se levantaron defensas y torres de control. El ejemplo más importante es el yacimiento de la **Huerta de la Albarrana** y la **torre almohade** del Cortijo de Miraflores. Esta edificación servía para vigilar las ricas huertas que rodeaban el norte de la ciudad y controlar el valioso reparto de aguas, consolidando el carácter agrícola que conservaría el término hasta mediados del siglo XX.
                </p>
            </div>
        </section>

        <!-- Transition to Neighborhood History CTA -->
        <section class="bg-gradient-to-r from-emerald-900 to-slate-900 text-white rounded-3xl p-8 sm:p-12 text-center relative overflow-hidden shadow-xl">
            <div class="absolute inset-0 bg-[radial-gradient(circle_at_bottom_left,rgba(16,185,129,0.1),transparent_40%)]"></div>
            <div class="relative z-10">
                <span class="text-emerald-400 text-xs font-bold uppercase tracking-widest bg-emerald-500/10 px-3 py-1 rounded-full border border-emerald-500/20">La Evolución Continúa</span>
                <h2 class="text-2xl sm:text-3xl font-extrabold mt-4 tracking-tight">Del Legado Milenario al Nacimiento del Barrio</h2>
                <p class="mt-4 text-slate-350 text-sm sm:text-base max-w-2xl mx-auto leading-relaxed">
                    Estas huertas, acequias y cortijos históricos mantuvieron su esencia rural hasta que, a mediados de la década de 1970, el crecimiento urbano y las familias trabajadoras dieron vida al Pino Montano moderno. Descubre la historia contemporánea de nuestro barrio.
                </p>
                <div class="mt-8 flex justify-center gap-4">
                    <a href="/historia" class="px-8 py-3.5 bg-emerald-600 hover:bg-emerald-500 text-white font-bold rounded-xl transition-all shadow-md hover:shadow-lg hover:shadow-emerald-500/20">
                        Ver Historia del Barrio (Siglo XX)
                    </a>
                </div>
            </div>
        </section>
    </div>

    <!-- Footer -->
    <footer class="mt-auto bg-slate-900 text-slate-400 py-12 border-t border-slate-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col md:flex-row items-center justify-between gap-6">
            <div class="flex items-center gap-3">
                <img src="/favicon.ico" alt="Pino Montano Logo" class="w-8 h-8 rounded-lg object-contain">
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

</body>
</html>
