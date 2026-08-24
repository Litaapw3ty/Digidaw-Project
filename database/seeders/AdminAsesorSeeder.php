<?php

namespace Database\Seeders;

use App\Models\Asesor;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;


// Pembuatan akun default untuk login ke sistem (ADMIN & ASESOR)
class AdminAsesorSeeder extends Seeder
{
    public function run(): void
    {
        $idRoleAdmin = Role::where('nama_role', 'ADMIN')->value('id_role');
        $idRoleAsesor = Role::where('nama_role', 'ASESOR')->value('id_role');

        $admin = User::updateOrCreate(
            ['email' => 'admin@digitama.test'],
            [
                'name' => 'Admin DIGITAMA',
                'username' => 'admin',
                'password' => Hash::make('password'),
                'id_role' => $idRoleAdmin,
                'status' => 'AKTIF',
            ]
        );

        $asesorUser = User::updateOrCreate(
            ['email' => 'asesor@digitama.test'],
            [
                'name' => 'Asesor Contoh',
                'username' => 'asesor1',
                'password' => Hash::make('password'),
                'id_role' => $idRoleAsesor,
                'status' => 'AKTIF',
            ]
        );

        Asesor::updateOrCreate(
            ['id_user' => $asesorUser->id_user],
            [
                'nip' => '198001012020121001',
                'jabatan' => 'Asesor PEMDI',
                'unit_kerja' => 'Tim Evaluasi',
                'wilayah' => 'Nasional',
                'status' => 'AKTIF',
            ]
        );

        $this->command->info('Admin login: admin@digitama.test / password');
        $this->command->info('Asesor login: asesor@digitama.test / password');
    }
}
