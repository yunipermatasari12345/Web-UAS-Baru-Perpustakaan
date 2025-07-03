<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Member;

class MemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $members = [
            [
                'name' => 'Ahmad Rizki',
                'email' => 'ahmad@email.com',
                'phone' => '081234567890',
                'address' => 'Jl. Sudirman No. 123, Jakarta',
                'birth_date' => '1990-05-15',
                'member_code' => 'MBR001',
            ],
            [
                'name' => 'Siti Nurhaliza',
                'email' => 'siti@email.com',
                'phone' => '081234567891',
                'address' => 'Jl. Thamrin No. 456, Jakarta',
                'birth_date' => '1992-08-20',
                'member_code' => 'MBR002',
            ],
            [
                'name' => 'Budi Santoso',
                'email' => 'budi@email.com',
                'phone' => '081234567892',
                'address' => 'Jl. Gatot Subroto No. 789, Jakarta',
                'birth_date' => '1988-12-10',
                'member_code' => 'MBR003',
            ],
            [
                'name' => 'Dewi Sartika',
                'email' => 'dewi@email.com',
                'phone' => '081234567893',
                'address' => 'Jl. Asia Afrika No. 321, Bandung',
                'birth_date' => '1995-03-25',
                'member_code' => 'MBR004',
            ],
            [
                'name' => 'Rudi Hermawan',
                'email' => 'rudi@email.com',
                'phone' => '081234567894',
                'address' => 'Jl. Malioboro No. 654, Yogyakarta',
                'birth_date' => '1991-07-18',
                'member_code' => 'MBR005',
            ],
        ];

        foreach ($members as $member) {
            Member::create($member);
        }
    }
}
