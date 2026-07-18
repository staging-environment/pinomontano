<!DOCTYPE html>
<html lang="es" class="h-full scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Historia de Pino Montano - Raíces e Identidad de Nuestro Barrio</title>
    
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
                <a href="/historia" class="text-emerald-600 transition-colors">Historia</a>
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

    <!-- Hero Section -->
    <section class="relative bg-gradient-to-b from-slate-900 to-emerald-950 text-white py-20 sm:py-28 overflow-hidden">
        <div class="absolute inset-0 bg-[radial-gradient(circle_at_center,rgba(16,185,129,0.1),transparent_70%)]"></div>
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10">
            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-emerald-500/10 text-emerald-400 border border-emerald-500/20 mb-6">
                Orígenes y lucha de la Sevilla obrera
            </span>
            <h1 class="text-4xl sm:text-6xl font-extrabold tracking-tight leading-[1.1]">
                Historia de <span class="bg-gradient-to-r from-emerald-400 to-teal-300 bg-clip-text text-transparent">Pino Montano</span>
            </h1>
            <p class="mt-6 text-base sm:text-xl text-slate-300 max-w-2xl mx-auto leading-relaxed">
                De llanura de olivares y cortijos históricos a un referente de orgullo obrero, auto-organización vecinal y un próspero comercio de proximidad.
            </p>
        </div>
    </section>

    <!-- History Chapters -->
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-16 sm:py-24 space-y-24">
        
        <!-- Chapter 1: Origins -->
        <section class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <div class="order-2 lg:order-1">
                <span class="text-xs font-bold uppercase tracking-widest text-emerald-600">CAPÍTULO I (HASTA 1970)</span>
                <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 mt-2">Los Cortijos y la Cuna de la Generación del 27</h2>
                <p class="mt-4 text-slate-600 text-sm sm:text-base leading-relaxed">
                    Antes del ladrillo, Pino Montano era un mar verde al norte de Sevilla, compuesto por huertas, olivares y majestuosos cortijos agrícolas. El más importante, el **Cortijo de Pino Montano**, no solo fue el centro agrícola de la zona, sino un epicentro cultural nacional.
                </p>
                <p class="mt-3 text-slate-605 text-sm sm:text-base leading-relaxed">
                    La finca perteneció al mítico torero **Joselito "El Gallo"** y posteriormente al polifacético **Ignacio Sánchez Mejías**. En este cortijo se reunían intelectuales y poetas de la **Generación del 27** como Federico García Lorca, Rafael Alberti, Gerardo Diego y Jorge Guillén, buscando inspiración en la paz y el duende del campo sevillano.
                </p>

                <!-- Origin of the Name Highlight Card -->
                <div class="mt-6 p-6 rounded-2xl bg-gradient-to-br from-emerald-50 to-teal-50/30 border border-emerald-100 text-slate-700 shadow-sm relative overflow-hidden group hover:shadow-md transition-all duration-300">
                    <div class="absolute -right-6 -bottom-6 text-emerald-100/40 text-7xl font-bold select-none group-hover:scale-110 transition-transform duration-300">🌲</div>
                    <h3 class="font-bold text-slate-900 text-sm sm:text-base flex items-center gap-2">
                        <span class="flex items-center justify-center w-6 h-6 rounded-lg bg-emerald-500 text-white text-xs shrink-0">i</span>
                        ¿De dónde viene el nombre de "Pino Montano"?
                    </h3>
                    <p class="mt-3 text-slate-600 text-xs sm:text-sm leading-relaxed relative z-10">
                        El nombre de nuestro barrio procede directamente del histórico <strong>Cortijo de Pino Montano</strong>. Esta finca fue bautizada combinando dos rasgos que la identificaban: la presencia de distinguidos <strong>pinos</strong> plantados en sus campos y el apellido de su propietario original, el señor <strong>Montano</strong>. Al urbanizarse el barrio a partir de 1975, los vecinos adoptaron este nombre tradicional para designar lo que hoy es el corazón del norte de Sevilla.
                    </p>
                </div>
            </div>
            <div class="order-1 lg:order-2">
                <div class="rounded-3xl overflow-hidden shadow-xl border border-slate-200/60 bg-slate-100 aspect-video">
                    <img src="/images/cortijo_historico.png" alt="Ilustración del Cortijo Histórico de Pino Montano" class="w-full h-full object-cover">
                </div>
            </div>
        </section>

        <!-- Chapter 2: The Birth -->
        <section class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <div>
                <div class="bg-gradient-to-tr from-emerald-600 to-teal-500 rounded-3xl aspect-video flex items-center justify-center p-8 text-white shadow-xl">
                    <div class="text-center">
                        <span class="text-5xl">🏗️</span>
                        <h4 class="font-extrabold text-lg mt-4">1975</h4>
                        <p class="text-xs text-emerald-100 mt-2">Entrega de las primeras llaves de viviendas a familias trabajadoras.</p>
                    </div>
                </div>
            </div>
            <div>
                <span class="text-xs font-bold uppercase tracking-widest text-emerald-600">CAPÍTULO II (1970 - 1980)</span>
                <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 mt-2">El Nacimiento del Barrio Obrero</h2>
                <p class="mt-4 text-slate-600 text-sm sm:text-base leading-relaxed">
                    A principios de los años 70, la intensa migración rural hacia la capital impulsó a Sevilla a expandirse hacia el norte. Así comenzó la edificación de las primeras grandes promociones del barrio de Pino Montano.
                </p>
                <p class="mt-3 text-slate-605 text-sm sm:text-base leading-relaxed">
                    Hacia **1975**, las primeras familias recibieron las llaves de sus pisos. Sin embargo, las viviendas se entregaron de forma precaria: calles sin asfaltar que se convertían en barrizales con la lluvia, ausencia de colegios públicos, mercados, centros de salud e incluso de transporte público que conectara a los vecinos con el resto de la ciudad.
                </p>
            </div>
        </section>

        <!-- Chapter 3: The Fight -->
        <section class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <div class="order-2 lg:order-1">
                <span class="text-xs font-bold uppercase tracking-widest text-emerald-600">CAPÍTULO III (AÑOS 80)</span>
                <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 mt-2">La Unión Vecinal: Conquistando el Barrio</h2>
                <p class="mt-4 text-slate-600 text-sm sm:text-base leading-relaxed">
                    Ante el abandono institucional de los inicios, nació la verdadera alma de Pino Montano: **su movimiento vecinal asociativo**. Unidos por la necesidad común, los vecinos se organizaron en asambleas y asociaciones combativas.
                </p>
                <p class="mt-3 text-slate-605 text-sm sm:text-base leading-relaxed">
                    Mediante manifestaciones históricas, encierros pacíficos y cortes de carretera, el vecindario fue conquistando cada derecho: el tendido eléctrico definitivo, el agua potable regular, las primeras líneas de autobuses (como la emblemática **Línea 12** de TUSSAM) y los primeros colegios públicos para sus hijos. Pino Montano se autoconstruyó gracias al sudor y la unión de su gente.
                </p>
            </div>
            <div class="order-1 lg:order-2">
                <div class="bg-slate-900 text-white rounded-3xl p-8 shadow-xl border border-slate-800 flex flex-col justify-center h-full min-h-[250px]">
                    <span class="text-xs font-bold text-emerald-450 uppercase tracking-widest">LOGROS HISTÓRICOS</span>
                    <ul class="mt-6 space-y-4 text-sm">
                        <li class="flex items-center gap-3">
                            <span class="w-6 h-6 rounded-full bg-emerald-500/20 text-emerald-400 font-bold flex items-center justify-center text-xs shrink-0">✓</span>
                            <span>Asfaltado y alumbrado público definitivo en todo el barrio.</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <span class="w-6 h-6 rounded-full bg-emerald-500/20 text-emerald-400 font-bold flex items-center justify-center text-xs shrink-0">✓</span>
                            <span>Conexión de transporte directo (Línea 12).</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <span class="w-6 h-6 rounded-full bg-emerald-500/20 text-emerald-400 font-bold flex items-center justify-center text-xs shrink-0">✓</span>
                            <span>Construcción de colegios e infraestructuras sanitarias.</span>
                        </li>
                    </ul>
                </div>
            </div>
        </section>

        <!-- Chapter 4: Miraflores -->
        <section class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <div>
                <div class="rounded-3xl overflow-hidden shadow-xl border border-slate-200/60 bg-slate-100 aspect-video">
                    <img src="/images/parque_miraflores.png" alt="Ilustración del Parque de Miraflores" class="w-full h-full object-cover">
                </div>
            </div>
            <div>
                <span class="text-xs font-bold uppercase tracking-widest text-emerald-600">CAPÍTULO IV (1983 - ACTUALIDAD)</span>
                <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 mt-2">El Parque de Miraflores: De Vertedero a Pulmón Verde</h2>
                <p class="mt-4 text-slate-600 text-sm sm:text-base leading-relaxed">
                    Uno de los hitos más emblemáticos de la fuerza colectiva de Pino Montano es el **Parque de Miraflores**. En los años 70 y 80, la zona de las antiguas huertas y arroyos de Miraflores corría riesgo de convertirse en un enorme vertedero de escombros de las constructoras.
                </p>
                <p class="mt-3 text-slate-605 text-sm sm:text-base leading-relaxed">
                    En **1983**, los vecinos y colectivos sociales formaron el **Comité Pro-Parque Educativo Miraflores**. Mediante jornadas de limpieza voluntaria, plantación colectiva y autogestión, protegieron el patrimonio arqueológico (el caserío de la Albarrana, el molino y el secadero de tabaco) y lograron que se declarara zona verde. Hoy es el gran pulmón del norte de Sevilla y un símbolo mundial de ecología social participativa.
                </p>
            </div>
        </section>

        <!-- Identity / Festivities -->
        <section class="bg-gradient-to-r from-emerald-50 to-teal-50 border border-emerald-100 rounded-3xl p-8 sm:p-12 text-center">
            <span class="text-emerald-700 text-xs font-bold uppercase tracking-widest bg-emerald-100/50 px-3 py-1 rounded-full border border-emerald-200/40">Cultura de Barrio</span>
            <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 mt-4 tracking-tight">Tradiciones y Cohesión Social</h2>
            <p class="mt-4 text-slate-600 text-sm sm:text-base max-w-2xl mx-auto leading-relaxed">
                Pino Montano no es solo calles y edificios; es una gran familia. Destacan hitos como la **Cabalgata de Reyes Magos de Pino Montano**, autogestionada por los vecinos y convertida en una de las más multitudinarias de Sevilla, y la **Hermandad de Pino Montano**, que el Viernes de Dolores abre oficialmente la Semana Santa sevillana arropada por miles de devotos.
            </p>
            <div class="mt-8 flex justify-center">
                <a href="/#comercios" class="px-8 py-3.5 bg-slate-900 text-white font-bold rounded-xl hover:bg-emerald-600 transition-colors shadow-md hover:shadow-lg hover:shadow-emerald-500/20">
                    Apoyar al Comercio del Barrio
                </a>
            </div>
        </section>
    </div>

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
