<!DOCTYPE html>
<html lang="es" class="h-full scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Unirse al Marketplace - Pino Montano</title>
    
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

    <!-- Main Content -->
    <main class="flex-1 py-12 px-4 sm:px-6 lg:px-8 max-w-4xl mx-auto w-full">
        <div class="text-center max-w-2xl mx-auto mb-10">
            <span class="text-xs font-bold uppercase tracking-widest text-emerald-600 bg-emerald-50 px-3 py-1 rounded-full border border-emerald-100">Para comerciantes locales</span>
            <h1 class="text-3xl sm:text-4xl font-extrabold text-slate-900 tracking-tight mt-4">Registra tu Comercio o Servicio</h1>
            <p class="mt-3 text-slate-550 text-sm sm:text-base">
                Completa el formulario a continuación. Una vez enviado, el administrador del barrio revisará los datos y activará tu ficha de comercio de forma gratuita.
            </p>
        </div>

        <div class="bg-white rounded-3xl border border-slate-200 p-6 sm:p-10 shadow-xl shadow-slate-100 relative overflow-hidden">
            <!-- Success Alert -->
            @if(session('success'))
                <div class="mb-8 p-6 bg-emerald-50 border border-emerald-200 rounded-2xl flex items-start gap-3">
                    <svg class="w-6 h-6 text-emerald-600 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <div>
                        <h4 class="font-bold text-emerald-900 text-sm">¡Solicitud Procesada!</h4>
                        <p class="text-emerald-700 text-xs mt-1 leading-relaxed">{{ session('success') }}</p>
                    </div>
                </div>
            @endif

            <!-- Validation Errors -->
            @if($errors->any())
                <div class="mb-8 p-6 bg-rose-50 border border-rose-200 rounded-2xl">
                    <div class="flex items-center gap-2 text-rose-800 font-bold text-sm mb-3">
                        <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                        </svg>
                        Por favor, corrige los siguientes errores:
                    </div>
                    <ul class="list-disc pl-5 text-rose-700 text-xs space-y-1">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('business.store') }}" method="POST" class="space-y-6" novalidate>
                @csrf
                
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <!-- Business Name -->
                    <div class="sm:col-span-2">
                        <label for="name" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Nombre del Negocio *</label>
                        <input type="text" name="name" id="name" value="{{ old('name') }}" placeholder="Ej: Talleres Mecánicos Pino Montano" required
                               class="w-full px-4 py-3 rounded-xl border focus:outline-none focus:ring-2 text-sm transition-all placeholder-slate-400 @error('name') border-rose-500 focus:ring-rose-500/20 focus:border-rose-500 @else border-slate-200 focus:ring-emerald-500/20 focus:border-emerald-500 @enderror">
                        @error('name')
                            <p class="mt-1.5 text-xs font-semibold text-rose-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Category -->
                    <div>
                        <label for="category" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Categoría del Negocio *</label>
                        <select name="category" id="category" required
                                class="w-full px-4 py-3 rounded-xl border focus:outline-none focus:ring-2 text-sm transition-all text-slate-750 bg-white @error('category') border-rose-500 focus:ring-rose-500/20 focus:border-rose-500 @else border-slate-200 focus:ring-emerald-500/20 focus:border-emerald-500 @enderror">
                            <option value="">-- Selecciona una categoría --</option>
                            @foreach($categories as $cat)
                                <option value="{{ $cat }}" {{ old('category') == $cat ? 'selected' : '' }}>{{ $cat }}</option>
                            @endforeach
                        </select>
                        @error('category')
                            <p class="mt-1.5 text-xs font-semibold text-rose-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Phone -->
                    <div>
                        <label for="phone" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Teléfono de Contacto *</label>
                        <input type="text" name="phone" id="phone" value="{{ old('phone') }}" placeholder="Ej: 954 123 456" required
                               class="w-full px-4 py-3 rounded-xl border focus:outline-none focus:ring-2 text-sm transition-all placeholder-slate-400 @error('phone') border-rose-500 focus:ring-rose-500/20 focus:border-rose-500 @else border-slate-200 focus:ring-emerald-500/20 focus:border-emerald-500 @enderror">
                        @error('phone')
                            <p class="mt-1.5 text-xs font-semibold text-rose-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div>
                        <label for="email" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Correo Electrónico *</label>
                        <input type="email" name="email" id="email" value="{{ old('email') }}" placeholder="Ej: contacto@tudominio.com" required
                               class="w-full px-4 py-3 rounded-xl border focus:outline-none focus:ring-2 text-sm transition-all placeholder-slate-400 @error('email') border-rose-500 focus:ring-rose-500/20 focus:border-rose-500 @else border-slate-200 focus:ring-emerald-500/20 focus:border-emerald-500 @enderror">
                        @error('email')
                            <p class="mt-1.5 text-xs font-semibold text-rose-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Website -->
                    <div>
                        <label for="website" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Página Web (Opcional)</label>
                        <input type="url" name="website" id="website" value="{{ old('website') }}" placeholder="Ej: https://tupagina.com"
                               class="w-full px-4 py-3 rounded-xl border focus:outline-none focus:ring-2 text-sm transition-all placeholder-slate-400 @error('website') border-rose-500 focus:ring-rose-500/20 focus:border-rose-500 @else border-slate-200 focus:ring-emerald-500/20 focus:border-emerald-500 @enderror">
                        @error('website')
                            <p class="mt-1.5 text-xs font-semibold text-rose-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Physical Address -->
                    <div class="sm:col-span-2">
                        <label for="address" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Dirección Física en Pino Montano *</label>
                        <input type="text" name="address" id="address" value="{{ old('address') }}" placeholder="Ej: Calle Corral del Agua, 24, 41015 Sevilla" required
                               class="w-full px-4 py-3 rounded-xl border focus:outline-none focus:ring-2 text-sm transition-all placeholder-slate-400 @error('address') border-rose-500 focus:ring-rose-500/20 focus:border-rose-500 @else border-slate-200 focus:ring-emerald-500/20 focus:border-emerald-500 @enderror">
                        @error('address')
                            <p class="mt-1.5 text-xs font-semibold text-rose-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Map Location Picker -->
                    <div class="sm:col-span-2">
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Ubicación en el Mapa *</label>
                        <p class="text-xs text-slate-505 mb-3">Haz clic en el mapa o arrastra el marcador verde hasta la ubicación exacta de tu negocio.</p>
                        <div id="map-picker" class="w-full h-[320px] rounded-2xl border shadow-inner z-10 @error('latitude') border-rose-500 ring-2 ring-rose-500/10 @else border-slate-200 @enderror"></div>
                        @error('latitude')
                            <p class="mt-1.5 text-xs font-semibold text-rose-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Coordinates (Read-only) -->
                    <div>
                        <label for="latitude" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Latitud *</label>
                        <input type="text" name="latitude" id="latitude" value="{{ old('latitude') }}" readonly required
                               class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-100/50 text-slate-500 text-sm transition-all cursor-not-allowed">
                    </div>
                    <div>
                        <label for="longitude" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Longitud *</label>
                        <input type="text" name="longitude" id="longitude" value="{{ old('longitude') }}" readonly required
                               class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-100/50 text-slate-500 text-sm transition-all cursor-not-allowed">
                    </div>

                    <!-- Description -->
                    <div class="sm:col-span-2">
                        <label for="description" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Descripción del Negocio *</label>
                        <textarea name="description" id="description" rows="5" placeholder="Cuéntales a tus vecinos qué ofreces, especialidades, horarios, etc..." required
                                  class="w-full px-4 py-3 rounded-xl border focus:outline-none focus:ring-2 text-sm transition-all placeholder-slate-400 resize-y @error('description') border-rose-500 focus:ring-rose-500/20 focus:border-rose-500 @else border-slate-200 focus:ring-emerald-500/20 focus:border-emerald-500 @enderror">{{ old('description') }}</textarea>
                        @error('description')
                            <p class="mt-1.5 text-xs font-semibold text-rose-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="pt-4 border-t border-slate-100 flex flex-col sm:flex-row justify-end gap-3">
                    <a href="/" class="px-6 py-3.5 bg-slate-100 text-slate-700 font-bold rounded-xl text-center text-sm hover:bg-slate-200 transition-colors">
                        Cancelar
                    </a>
                    <button type="submit" class="px-8 py-3.5 bg-gradient-to-r from-emerald-600 to-teal-500 text-white font-bold rounded-xl text-sm hover:from-emerald-500 hover:to-teal-450 transition-all shadow-md hover:shadow-lg shadow-emerald-500/10 active:scale-98 cursor-pointer">
                        Enviar Solicitud
                    </button>
                </div>
            </form>
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
                <a href="/#sobre-el-barrio" class="hover:text-white transition-colors">Sobre el Barrio</a>
                <a href="mailto:soporte@pinomontano.ddev.site" class="hover:text-white transition-colors">Soporte</a>
            </div>
            <div class="text-xs text-slate-500">
                Hecho con <span class="text-rose-500">♥</span> en Pino Montano, Sevilla.
            </div>
        </div>
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Default coordinates (Pino Montano center)
            var defaultLat = 37.426;
            var defaultLng = -5.965;

            // Load coordinates from old input if validation failed, otherwise use default
            var initialLat = document.getElementById('latitude').value || defaultLat;
            var initialLng = document.getElementById('longitude').value || defaultLng;

            // Set inputs to initial values
            document.getElementById('latitude').value = initialLat;
            document.getElementById('longitude').value = initialLng;

            var map = L.map('map-picker').setView([initialLat, initialLng], 15);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19,
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a>'
            }).addTo(map);

            // Add marker at initial position
            var marker = L.marker([initialLat, initialLng], {
                draggable: true
            }).addTo(map);

            // Update inputs on drag end
            marker.on('dragend', function (e) {
                var position = marker.getLatLng();
                document.getElementById('latitude').value = position.lat.toFixed(8);
                document.getElementById('longitude').value = position.lng.toFixed(8);
            });

            // Update marker and inputs on map click
            map.on('click', function (e) {
                marker.setLatLng(e.latlng);
                document.getElementById('latitude').value = e.latlng.lat.toFixed(8);
                document.getElementById('longitude').value = e.latlng.lng.toFixed(8);
            });
        });
    </script>
</body>
</html>
