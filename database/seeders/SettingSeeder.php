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
            'value' => 'Acatec',
            'type' => 'text',
            'order' => 1,
        ]);

        Setting::create([
            'key' => 'site_slogan',
            'label' => 'Slogan del sitio',
            'value' => 'Salud Ocupacional y Ambiente',
            'type' => 'text',
            'order' => 2,
        ]);

        Setting::create([
            'key' => 'theme_color',
            'label' => 'Color del sitio',
            'value' => '#1B0166',
            'type' => 'color',
            'order' => 2,
        ]);

        Setting::create([
            'key' => 'title_legend',
            'label' => 'Leyenda del titulo',
            'value' => 'Programas de bienestar',
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
            'value' => 'info@acatecso.com',
            'type' => 'text',
            'order' => 4,
        ]);

        Setting::create([
            'key' => 'site_email',
            'label' => 'Correo electronico visible',
            'value' => 'info@acatecso.com',
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
                    'value' => 'Lunes a sábado de 8 am a 6 pm.'
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
            'value' => '+50670993933',
            'type' => 'text',
            'order' => 6,
        ]);

        Setting::create([
            'key' => 'telephone_name',
            'label' => 'Teléfono de visible',
            'value' => '+506 7099 3933',
            'type' => 'text',
            'order' => 6,
        ]);

        Setting::create([
            'key' => 'whatsapp',
            'label' => 'Whatsapp',
            'value' => '7099-3933',
            'type' => 'text',
            'order' => 7,
        ]);

        Setting::create([
            'key' => 'whatsapp_number',
            'label' => 'Numero Whatsapp',
            'value' => '70993933',
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
                    "number" => "70993933",
                    "is_whatsapp" => true,
                    "visible_number" => "+506 7099-3933"
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
                    "url" => "https://www.facebook.com/acatec17",
                    "name" => "acatec17",
                    "networks" => "facebook"
                ],
                [
                    "url" => "https://www.instagram.com/acatec_cr",
                    "name" => "acatec_cr",
                    "networks" => "instagram"
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
            'key' => 'map_iframe',
            'label' => 'Mapa',
            'value' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3929.3435530035595!2d-84.06736332448527!3d9.98845377323228!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8fa0e3417c3ec9b7%3A0xce577c5bac09ea49!2sAMB%20ideas!5e0!3m2!1ses-419!2sch!4v1785435956234!5m2!1ses-419!2sch',
            'type' => 'text',
            'order' => 13,
        ]);

        Setting::create([
            'key' => 'street_address',
            'label' => 'Dirección',
            'value' => 'Curridabat, San José, Costa Rica',
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
