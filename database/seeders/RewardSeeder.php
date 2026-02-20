<?php

namespace Database\Seeders;

use App\Models\Reward;
use Illuminate\Database\Seeder;

class RewardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $rewards = [
            [
                'name' => 'Pase de Batalla - Temporada 5',
                'description' => 'Desbloquea 100 niveles de contenido exclusivo, skins legendarias y 1000 monedas premium.',
                'point_cost' => 1200,
                'image_path' => '/images/rewards/battle-pass.jpg',
                'is_active' => true,
            ],
            [
                'name' => 'Skin Legendaria: Lobo Espectral',
                'description' => 'Cambia por completo la apariencia de tu personaje y sus efectos de habilidades en el multijugador.',
                'point_cost' => 2500,
                'image_path' => '/images/rewards/skin-lobo.jpg',
                'is_active' => true,
            ],
            [
                'name' => 'Cofre de Botín Épico',
                'description' => 'Garantiza al menos un objeto de rareza épica o superior. Puede contener monturas raras.',
                'point_cost' => 500,
                'image_path' => '/images/rewards/cofre-botin.jpg',
                'is_active' => true,
            ],
            [
                'name' => 'Expansión: Tierras Sombrías',
                'description' => 'Acceso anticipado a la nueva zona del mapa, 5 nuevas mazmorras y aumento del nivel máximo.',
                'point_cost' => 5000,
                'image_path' => '/images/rewards/expansion.jpg',
                'is_active' => true,
            ],
            [
                'name' => 'Boost de Experiencia (7 días)',
                'description' => 'Obtén el doble de experiencia en todas las partidas emparejadas durante una semana entera.',
                'point_cost' => 800,
                'image_path' => '/images/rewards/boost-xp.jpg',
                'is_active' => true,
            ],
            [
                'name' => 'Elden Ring',
                'description' => 'Juego de rol de acción y fantasía oscura en un vasto mundo abierto. Levántate, Tiznado, y déjate guiar por la gracia para esgrimir el poder del Círculo de Elden.',
                'point_cost' => 15000,
                'image_path' => '/images/rewards/elden-ring.jpg',
                'is_active' => true,
            ],
            [
                'name' => 'Cyberpunk 2077',
                'description' => 'Adéntrate en Night City, una megalópolis obsesionada con el poder, el glamur y la modificación corporal en este RPG de acción de mundo abierto.',
                'point_cost' => 12000,
                'image_path' => '/images/rewards/cyberpunk.jpg',
                'is_active' => true,
            ],
            [
                'name' => 'Red Dead Redemption 2',
                'description' => 'Una historia épica sobre la vida en el implacable corazón de Estados Unidos en los albores del siglo XX. Incluye acceso a Red Dead Online.',
                'point_cost' => 14000,
                'image_path' => '/images/rewards/rdr2.jpg',
                'is_active' => true,
            ],
            [
                'name' => 'Hollow Knight',
                'description' => 'Forja tu propio camino en este clásico juego de acción y aventura en 2D. Explora cavernas serpenteantes y enfréntate a criaturas corrompidas.',
                'point_cost' => 3500,
                'image_path' => '/images/rewards/hollow-knight.jpg',
                'is_active' => true,
            ],
            [
                'name' => 'Stardew Valley',
                'description' => 'Acabas de heredar la vieja granja de tu abuelo. Armado con herramientas de segunda mano y algunas monedas, te dispones a comenzar tu nueva vida.',
                'point_cost' => 3000,
                'image_path' => '/images/rewards/stardew-valley.jpg',
                'is_active' => true,
            ]
        ];

        foreach ($rewards as $reward) {
            Reward::create($reward);
        }
    }
}