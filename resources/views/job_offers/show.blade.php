<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $jobOffer->title }} - Pino Montano</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 font-sans">

    <!-- Navbar -->
    <nav class="bg-blue-600 p-4 shadow-lg sticky top-0 z-50">
        <div class="container mx-auto flex justify-between items-center">
            <a href="{{ url('/') }}" class="text-white text-2xl font-bold flex items-center">
                <span class="mr-2">🌲</span> Pino Montano
            </a>
            <div class="flex items-center space-x-4">
                <a href="{{ route('business.register') }}" class="text-white hover:text-blue-200 transition-colors">Añadir mi negocio</a>
                <a href="{{ route('job_offers.public.index') }}" class="bg-white text-blue-600 px-4 py-2 rounded-full font-bold hover:bg-blue-100 transition-colors shadow-md">Únete a nuestro equipo</a>
            </div>
        </div>
    </nav>

    <div class="container mx-auto mt-10 p-5">
        <div class="bg-white rounded-lg shadow-xl p-8">
            <h1 class="text-4xl font-bold text-gray-800 mb-4">{{ $jobOffer->title }}</h1>
            @if($jobOffer->salary_range)
                <p class="text-lg text-gray-600 mb-6"><span class="font-semibold">Rango Salarial:</span> {{ $jobOffer->salary_range }}</p>
            @endif
            <div class="prose max-w-none text-gray-700 mb-8">
                {!! nl2br(e($jobOffer->description)) !!}
            </div>

            <hr class="my-8">

            <h2 class="text-3xl font-bold text-gray-800 mb-6">Inscríbete en esta oferta</h2>

            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-6" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            @if ($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-6" role="alert">
                    <strong class="font-bold">¡Ups!</strong>
                    <span class="block sm:inline">Hay algunos problemas con tu solicitud.</span>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('job_applications.store', $jobOffer) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700">Nombre completo *</label>
                    <input type="text" name="name" id="name" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm" value="{{ old('name') }}">
                </div>
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">Correo electrónico *</label>
                    <input type="email" name="email" id="email" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm" value="{{ old('email') }}">
                </div>
                <div>
                    <label for="phone" class="block text-sm font-medium text-gray-700">Teléfono</label>
                    <input type="tel" name="phone" id="phone" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm" value="{{ old('phone') }}">
                </div>
                <div>
                    <label for="cv" class="block text-sm font-medium text-gray-700">Currículum (PDF, DOC, DOCX) *</label>
                    <input type="file" name="cv" id="cv" required class="mt-1 block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none">
                </div>
                <div>
                    <label for="cover_letter" class="block text-sm font-medium text-gray-700">Carta de presentación</label>
                    <textarea name="cover_letter" id="cover_letter" rows="4" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">{{ old('cover_letter') }}</textarea>
                </div>
                <div>
                    <button type="submit" class="w-full flex justify-center py-3 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Enviar candidatura
                    </button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
