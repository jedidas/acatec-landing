<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Setting::create([
            'key' => 'site_name',
            'label' => 'Nombre del sitio',
            'value' => 'Nombre de la pagina web',
            'type' => 'text',
            'order' => 1,
        ]);

        Setting::create([
            'key' => 'site_slogan',
            'label' => 'Slogan del sitio',
            'value' => 'Slogan',
            'type' => 'text',
            'order' => 2,
        ]);

        Setting::create([
            'key' => 'theme_color',
            'label' => 'Color del sitio',
            'value' => '#238dbe',
            'type' => 'color',
            'order' => 2,
        ]);

        Setting::create([
            'key' => 'title_legend',
            'label' => 'Leyenda del titulo',
            'value' => 'Titulo Slogan',
            'type' => 'text',
            'order' => 2,
        ]);

        Setting::create([
            'key' => 'og_website',
            'label' => 'URL del sitio web',
            'value' => 'http://localhost',
            'type' => 'text',
            'order' => 3,
        ]);

        Setting::create([
            'key' => 'email',
            'label' => 'Correo electronico del formulario',
            'value' => 'email@gmail.com',
            'type' => 'text',
            'order' => 4,
        ]);

        Setting::create([
            'key' => 'site_email',
            'label' => 'Correo electronico visible',
            'value' => 'email@gmail.com',
            'type' => 'text',
            'order' => 5,
        ]);

        Setting::create([
            'key' => 'schedule',
            'label' => 'Horario',
            'value' => '',
            'type' => 'values',
            'attributes' => [
                [
                    'value' => 'Lunes a viernes de 7:30am a 5:30pm.'
                ],
                [
                    'value' => 'Sábado de 7:30am a 12:00md'
                ],
                [
                    'value' => 'Domingo cerrado'
                ],
            ],
            'order' => 6,
        ]);

        Setting::create([
            'key' => 'telephone',
            'label' => 'Teléfono de contacto',
            'value' => '+5000000000',
            'type' => 'text',
            'order' => 6,
        ]);

        Setting::create([
            'key' => 'telephone_name',
            'label' => 'Teléfono de visible',
            'value' => '0000 0000',
            'type' => 'text',
            'order' => 6,
        ]);

        Setting::create([
            'key' => 'whatsapp',
            'label' => 'Whatsapp',
            'value' => '000-00000',
            'type' => 'text',
            'order' => 7,
        ]);

        Setting::create([
            'key' => 'whatsapp_number',
            'label' => 'Numero Whatsapp',
            'value' => '00000000',
            'type' => 'text',
            'order' => 7,
        ]);

        Setting::create([
            'key' => 'telephone_number',
            'label' => 'Teléfonos',
            'value' => '',
            'type' => 'phones',
            'attributes' => [
                [
                    "number" => "Casa",
                    "is_whatsapp" => false,
                    "visible_number" => "00000000"
                ],
                [
                    "number" => "Celular",
                    "is_whatsapp" => true,
                    "visible_number" => "00000000"
                ]
            ],
            'order' => 6,
        ]);

        Setting::create([
            'key' => 'social_networks',
            'label' => 'Redes sociales',
            'value' => '',
            'values' => [
                [
                    "url" => "https=>//facebook.com/Facebook",
                    "name" => "Facebook",
                    "networks" => "facebook"
                ],
                [
                    "url" => "https=>//www.tiktok.com/@TikTok",
                    "name" => "TikTok",
                    "networks" => "tiktok"
                ]
            ],
            'type' => 'social_networks',
            'attributes' => [
                'options' => [
                    'facebook' => 'Facebook',
                    'instagram' => 'Instagram',
                    'x-twitter' => 'X (Twitter)',
                    'linkedin' => 'LinkedIn',
                    'youtube' => 'YouTube',
                    'tiktok' => 'TikTok',
                    'telegram' => 'Telegram',
                    'snapchat' => 'Snapchat',
                    'pinterest' => 'Pinterest',
                    'reddit' => 'Reddit',
                    'discord' => 'Discord',
                    'twitch' => 'Twitch',
                ],
            ],
            'order' => 6,
        ]);

        Setting::create([
            'key' => 'address_region',
            'label' => 'Región',
            'value' => 'Nombre del lugar',
            'type' => 'text',
            'order' => 11,
        ]);

        Setting::create([
            'key' => 'street_address',
            'label' => 'Dirección',
            'value' => 'Direccion del local',
            'type' => 'text',
            'order' => 12,
        ]);

        Setting::create([
            'key' => 'og_description',
            'label' => 'Descripción de la tienda',
            'value' => 'Descripción de la tienda',
            'type' => 'text',
            'order' => 13,
        ]);

        Setting::create([
            'key' => 'items_per_page',
            'label' => 'Artículo por página',
            'value' => 16,
            'type' => 'number',
            'order' => 14,
        ]);

        Setting::create([
            'key' => 'tag_manager',
            'label' => 'Código tag manager',
            'value' => '',
            'type' => 'text',
            'order' => 14,
        ]);

        Setting::create([
            'key' => 'address_locality',
            'label' => 'Localidad',
            'value' => 'San José',
            'type' => 'select',
            'attributes' => [
                'options' => [
                    'San José' => 'San José',
                    'Alajuela' => 'Alajuela',
                    'Cartago' => 'Cartago',
                    'Heredia' => 'Heredia',
                    'Guanacaste' => 'Guanacaste',
                    'Puntarenas' => 'Puntarenas',
                    'Limón' => 'Limón',
                ],
            ],
            'order' => 16,
        ]);
    }
}
