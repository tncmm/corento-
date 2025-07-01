<?php

namespace Database\Seeders\Themes\Main;

use Botble\Base\Supports\BaseSeeder;
use Botble\CarRentals\Database\Traits\HasCarSeeder;

class CarSeeder extends BaseSeeder
{
    use HasCarSeeder;

    public function run(): void
    {
        $this->uploadFiles('cars');

        $cars = [
            [
                'license_plate' => '30A-123.00',
                'name' => 'Toyota Camry XLE Hybrid 2024',
                'insurance_info' => '',
                'location' => '',
            ],
            [
                'license_plate' => '30A-123.11',
                'name' => 'Honda Accord Sport 2.0T 2024',
                'insurance_info' => '',
                'location' => '',
            ],
            [
                'license_plate' => '29A-123.22',
                'name' => 'Mercedes-Benz C300 4MATIC 2024',
                'insurance_info' => '',
                'location' => '',
            ],
            [
                'license_plate' => '30A-123.33',
                'name' => 'BMW 330i xDrive M Sport 2024',
                'insurance_info' => '',
                'location' => '',
            ],
            [
                'license_plate' => '30A-123.44',
                'name' => 'Lexus ES 350 F Sport 2024',
                'insurance_info' => '',
                'location' => '',
            ],
            [
                'license_plate' => '30A-123.55',
                'name' => 'Toyota RAV4 Prime XSE AWD 2024',
                'insurance_info' => '',
                'location' => '',
            ],
            [
                'license_plate' => '30A-123.66',
                'name' => 'Honda CR-V Touring Hybrid AWD 2024',
                'insurance_info' => '',
                'location' => '',
            ],
            [
                'license_plate' => '30A-123.77',
                'name' => 'BMW X5 xDrive40i M Sport 2024',
                'insurance_info' => '',
                'location' => '',
            ],
            [
                'license_plate' => '30A-123.88',
                'name' => 'Mercedes-Benz GLC 300 4MATIC 2024',
                'insurance_info' => '',
                'location' => '',
            ],
            [
                'license_plate' => '29A-123.99',
                'name' => 'Lexus RX 350 F Sport Handling AWD 2024',
                'insurance_info' => '',
                'location' => '',
            ],
        ];

        $this->createCars($cars);
    }
}
