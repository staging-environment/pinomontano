<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Business;

class BusinessSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $businesses = [
            [
                'name' => 'Cervecería El Rincón de Pino Montano',
                'slug' => 'cerveceria-el-rincon-de-pino-montano',
                'description' => 'Las mejores tapas del barrio con un ambiente familiar. Especialidad en montaditos y pescaito frito.',
                'category' => 'Restauración',
                'address' => 'Av. de Pino Montano, 42, 41015 Sevilla',
                'phone' => '954 123 456',
                'email' => 'contacto@elrincondepinomontano.com',
                'website' => 'https://elrincondepinomontano.ddev.site',
                'logo' => null,
                'banner_image' => null,
                'is_featured' => true,
            ],
            [
                'name' => 'Panadería y Pastelería Los Parques',
                'slug' => 'panaderia-y-pasteleria-los-parques',
                'description' => 'Pan artesano recién hecho cada mañana y repostería tradicional. Tartas por encargo para celebraciones.',
                'category' => 'Alimentación',
                'address' => 'Calle Corral de los Olmos, 8, 41015 Sevilla',
                'phone' => '954 987 654',
                'email' => 'pastelerialosparques@gmail.com',
                'website' => null,
                'logo' => null,
                'banner_image' => null,
                'is_featured' => true,
            ],
            [
                'name' => 'Talleres Mecánicos Pino Montano',
                'slug' => 'talleres-mecanicos-pino-montano',
                'description' => 'Tu taller mecánico de confianza. Cambios de aceite, neumáticos, diagnosis de motor y mecánica general multimarca.',
                'category' => 'Servicios',
                'address' => 'Calle Corral de la Caridad, 15, 41015 Sevilla',
                'phone' => '654 321 098',
                'email' => 'info@tallerespinomontano.es',
                'website' => 'https://tallerespinomontano.es',
                'logo' => null,
                'banner_image' => null,
                'is_featured' => false,
            ],
            [
                'name' => 'Peluquería y Estética Sandra',
                'slug' => 'peluqueria-y-estetica-sandra',
                'description' => 'Cortes de pelo modernos, tintes, tratamientos capilares y estética general. Pide tu cita previa.',
                'category' => 'Salud y Belleza',
                'address' => 'Av. de los Parques Alcosa-Pino Montano, 112, 41015 Sevilla',
                'phone' => '954 333 444',
                'email' => 'sandra@esteticapinomontano.com',
                'website' => null,
                'logo' => null,
                'banner_image' => null,
                'is_featured' => true,
            ],
            [
                'name' => 'Frutería Hermanos Gómez',
                'slug' => 'fruteria-hermanos-gomez',
                'description' => 'Frutas y verduras de temporada traídas diariamente. Calidad y frescura directa a tu mesa al mejor precio del barrio.',
                'category' => 'Alimentación',
                'address' => 'Calle Corral del Agua, 24, 41015 Sevilla',
                'phone' => '611 222 333',
                'email' => 'gomezfrutas@hotmail.com',
                'website' => null,
                'logo' => null,
                'banner_image' => null,
                'is_featured' => false,
            ],
            [
                'name' => 'Ferretería El Tornillo',
                'slug' => 'ferreteria-el-tornillo',
                'description' => 'Todo lo necesario para bricolaje, fontanería, electricidad y reparaciones del hogar. Duplicado de llaves al instante.',
                'category' => 'Servicios',
                'address' => 'Calle Mar de Alborán, 3, 41015 Sevilla',
                'phone' => '954 555 666',
                'email' => 'eltornillofre@gmail.com',
                'website' => null,
                'logo' => null,
                'banner_image' => null,
                'is_featured' => false,
            ],
        ];

        foreach ($businesses as $business) {
            $business['is_approved'] = true;
            Business::create($business);
        }
    }
}
