<?php

namespace Database\Seeders;

use App\Models\ContactInformation;
use App\Models\Doctor;
use App\Models\Service;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@azmeerdental.com',
            'password' => Hash::make('password'),
            'is_admin' => true,
        ]);

        Doctor::create([
            'name' => 'Dr. Sher Shah',
            'qualification' => 'BDS',
            'specialization' => 'Dental Surgeon',
            'registration_number' => '10448',
            'visiting_hours' => 'Morning: 10:00 AM – 2:00 PM · Evening: 4:00 PM – 8:00 PM',
            'bio' => 'Dr. Sher Shah is a qualified Dental Surgeon registered with the Bangladesh Medical and Dental Council (BMDC Reg. No: 10448). He completed his Bachelor of Dental Surgery (BDS) from Sylhet MAG Osmani Medical College and Mymensingh Medical College. With a commitment to patient-centered care, Dr. Shah provides comprehensive dental treatments ranging from routine check-ups to advanced dental procedures at Azmeer Dental Care, Jamalpur.',
        ]);

        $services = [
            [
                'title' => 'Dental Consultation',
                'description' => 'Comprehensive dental examinations and personalized treatment plans. Dr. Sher Shah evaluates your oral health, discusses concerns, and recommends the best course of action for your dental care needs.',
                'icon' => 'fas fa-stethoscope',
            ],
            [
                'title' => 'Oral Care',
                'description' => 'Professional teeth cleaning, scaling, and preventive oral care treatments. Regular oral care helps prevent gum disease, cavities, and maintains overall dental hygiene for a healthy smile.',
                'icon' => 'fas fa-tooth',
            ],
            [
                'title' => 'Dental Treatment',
                'description' => 'Full range of dental treatments including fillings, root canal therapy, teeth whitening, and restorative procedures. Each treatment is performed with precision and care using modern techniques.',
                'icon' => 'fas fa-syringe',
            ],
            [
                'title' => 'Dental Surgery',
                'description' => 'Expert dental surgical procedures including tooth extractions, wisdom teeth removal, and other oral surgeries. Dr. Shah ensures safe, comfortable surgical care with proper post-operative guidance.',
                'icon' => 'fas fa-band-aid',
            ],
        ];

        foreach ($services as $service) {
            Service::create($service);
        }

        ContactInformation::create([
            'phone' => '01638209228',
            'email' => null,
            'address' => 'Patgram Road, Jamalpur',
            'whatsapp' => null,
            'facebook' => null,
            'google_map_embed' => null,
        ]);
    }
}
