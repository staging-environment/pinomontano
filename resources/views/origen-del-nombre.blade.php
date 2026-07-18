<!DOCTYPE html>
<html lang="es" class="h-full scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Origen del Nombre - Historia y Raíces de Pino Montano</title>
    
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
                <a href="/origen-del-nombre" class="text-emerald-600 transition-colors">El Nombre</a>
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
                Etimología, Leyenda y Patrimonio
            </span>
            <h1 class="text-4xl sm:text-6xl font-extrabold tracking-tight leading-[1.1]">
                Origen de <span class="bg-gradient-to-r from-emerald-400 to-teal-300 bg-clip-text text-transparent">Nuestro Nombre</span>
            </h1>
            <p class="mt-6 text-base sm:text-xl text-slate-300 max-w-2xl mx-auto leading-relaxed">
                Descubre cómo un rincón de pinos plantados por el señor Montano en el siglo XIX dio paso a la barriada obrera más dinámica y viva del norte de Sevilla.
            </p>
        </div>
    </section>

    <!-- Chapters & Layout -->
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-16 sm:py-24 space-y-24">
        
        <!-- Chapter 1: The Landowner and the Pines -->
        <section class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <div class="order-2 lg:order-1">
                <span class="text-xs font-bold uppercase tracking-widest text-emerald-600">EL COMIENZO (SIGLO XIX)</span>
                <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 mt-2">El Señor Montano y sus Pinos</h2>
                <p class="mt-4 text-slate-600 text-sm sm:text-base leading-relaxed">
                    Mucho antes de que el asfalto y los bloques de pisos poblaran esta zona de Sevilla, el paisaje estaba compuesto por un inmenso campo andaluz de huertas y olivares. En este entorno, un acomodado terrateniente de apellido **Montano** poseía una gran hacienda dedicada a la agricultura y la ganadería.
                </p>
                <p class="mt-3 text-slate-605 text-sm sm:text-base leading-relaxed">
                    Con el fin de delimitar los linderos de su propiedad y, de paso, ofrecer un refugio de sombra a sus jornaleros y al ganado frente a las rigurosas temperaturas del verano sevillano, el señor Montano decidió plantar una gran cantidad de **pinos piñoneros** a lo largo de las lindes y del camino de acceso a su finca.
                </p>
                <p class="mt-3 text-slate-605 text-sm sm:text-base leading-relaxed">
                    Pronto, los campesinos de las huertas vecinas y los viajeros empezaron a referirse coloquialmente a ese punto de la vega del Guadalquivir como la zona de "los pinos de Montano" o "los pinos de la finca de Montano". La popularidad de la arboleda fue tal que el nombre quedó arraigado de forma definitiva, dando nacimiento a la denominación oficial del **Cortijo de Pino Montano**.
                </p>
            </div>
            <div class="order-1 lg:order-2">
                <div class="rounded-3xl overflow-hidden shadow-xl border border-slate-200/60 bg-slate-100 aspect-video group">
                    <img src="/images/senor_montano_pinos.png" alt="Ilustración artística de la finca del señor Montano" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                </div>
            </div>
        </section>

        <!-- Chapter 2: The Bullfighters and the Generation of 27 -->
        <section class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <div>
                <div class="rounded-3xl overflow-hidden shadow-xl border border-slate-200/60 bg-slate-100 aspect-video group">
                    <img src="/images/cortijo_historico.png" alt="Ilustración del Cortijo de Pino Montano" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                </div>
            </div>
            <div>
                <span class="text-xs font-bold uppercase tracking-widest text-emerald-600">EDAD DE ORO Y PLATA (1914 - 1936)</span>
                <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 mt-2">La Fama de un Cortijo Histórico</h2>
                <p class="mt-4 text-slate-600 text-sm sm:text-base leading-relaxed">
                    A finales de 1914, el célebre torero sevillano **José Gómez Ortega, "Joselito el Gallo"** (o simplemente "Joselito"), adquirió la finca de Pino Montano para su familia. Al ser aún menor de edad en ese instante, la compraventa se escrituró a nombre de su madre, Gabriela Ortega.
                </p>
                <p class="mt-3 text-slate-605 text-sm sm:text-base leading-relaxed">
                    Tras la trágica muerte de Joselito en la plaza de Talavera en 1920, la propiedad del cortijo pasó a manos de su hermana Dolores Gómez Ortega, casada con otra figura histórica de la tauromaquia y la vida cultural española: **Ignacio Sánchez Mejías**.
                </p>
                <p class="mt-3 text-slate-605 text-sm sm:text-base leading-relaxed">
                    Sánchez Mejías, mecenas y amigo íntimo de los poetas de la **Generación del 27**, convirtió los salones y jardines del Cortijo de Pino Montano en el epicentro intelectual de España. Figuras como **Federico García Lorca, Rafael Alberti, Gerardo Diego y Jorge Guillén** se reunían bajo la sombra de aquellos legendarios pinos para debatir, escribir y buscar la inspiración en la campiña.
                </p>
            </div>
        </section>

        <!-- Chapter 3: From Land to Working Class Neighborhood -->
        <section class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <div class="order-2 lg:order-1">
                <span class="text-xs font-bold uppercase tracking-widest text-emerald-600">LA URBANIZACIÓN (1975)</span>
                <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 mt-2">El Nombre que Bautizó al Barrio</h2>
                <p class="mt-4 text-slate-600 text-sm sm:text-base leading-relaxed">
                    A finales de la década de 1960 y principios de 1970, la ciudad de Sevilla experimentó una fase de rápida expansión urbana. Los terrenos agrícolas que rodeaban el Cortijo de Pino Montano y las huertas adyacentes fueron elegidos por el Patronato Municipal de la Vivienda para levantar un nuevo distrito residencial destinado a acoger a miles de familias trabajadoras.
                </p>
                <p class="mt-3 text-slate-605 text-sm sm:text-base leading-relaxed">
                    Al planificar la zona y entregar los primeros bloques de pisos hacia **1975**, se decidió mantener la denominación del cortijo de referencia como homenaje a las raíces de esa tierra. Los primeros vecinos se agruparon con fuerza identitaria bajo la marca del barrio.
                </p>
                <p class="mt-3 text-slate-605 text-sm sm:text-base leading-relaxed">
                    De este modo, los pinos sembrados por el señor Montano un siglo atrás terminaron dando su nombre a una comunidad que hoy destaca por su orgullo vecinal, sus intensas luchas por los derechos sociales y un comercio de proximidad floreciente.
                </p>
            </div>
            <div class="order-1 lg:order-2">
                <div class="rounded-3xl overflow-hidden shadow-xl border border-slate-200/60 bg-slate-100 aspect-video group">
                    <img src="/images/estampa_barrio.png" alt="Estampa urbana de Pino Montano" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                </div>
            </div>
        </section>

        <!-- Dynamic Call to Action -->
        <section class="bg-gradient-to-r from-emerald-900 to-slate-900 text-white rounded-3xl p-8 sm:p-12 text-center relative overflow-hidden shadow-xl">
            <div class="absolute inset-0 bg-[radial-gradient(circle_at_bottom_left,rgba(16,185,129,0.1),transparent_40%)]"></div>
            <div class="relative z-10">
                <span class="text-emerald-400 text-xs font-bold uppercase tracking-widest bg-emerald-500/10 px-3 py-1 rounded-full border border-emerald-500/20">Identidad Compartida</span>
                <h2 class="text-2xl sm:text-3xl font-extrabold mt-4 tracking-tight">Orgullo de Nuestras Raíces</h2>
                <p class="mt-4 text-slate-350 text-sm sm:text-base max-w-2xl mx-auto leading-relaxed">
                    El nombre de Pino Montano es sinónimo de historia, cultura y lucha obrera. Descubre más sobre la evolución de nuestro barrio o apoya el comercio de cercanía de los vecinos.
                </p>
                <div class="mt-8 flex flex-wrap justify-center gap-4">
                    <a href="/historia" class="px-6 py-3 bg-emerald-600 hover:bg-emerald-500 text-white font-bold rounded-xl transition-all shadow-md">
                        Ver Historia Completa (Siglo XX)
                    </a>
                    <a href="/#comercios" class="px-6 py-3 bg-white/10 hover:bg-white/20 text-white font-bold rounded-xl border border-white/20 transition-all">
                        Visitar el Marketplace
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
