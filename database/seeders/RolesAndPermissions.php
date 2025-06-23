<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RolesAndPermissions extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            'Pengurus ID',
            'Pengurus POC',
            'Pengurus Peralatan',
            'Pengurus VM',
            'Pengurus CR',
            'Pengurus Percetakkan',
            'Pengurus Firewall',
        ];

        $permissions = [
            'Approve Borang Bilik Mesyuarat Teratai',
            'Approve Borang Bilik Mesyuarat Lili',
            'Approve Permohonan migrasi system tempahan',
            'Approve Permohonan migrasi system IT',
            'Approve Permohonan pengurusan ID',
            'Approve Permohonan pengurusan POC',
            'Approve Permohonan serah peralatan ICT',
            'Approve Permohonan VM',
            'Approve Permohonan CR Operasi',
            'Approve Permohonan CR Aplikasi',
            'Approve Permohonan percetakkan digital',
            'Approve Permohonan percetakkan kad nama',
            'Approve Permohonan open dan close port firewall',
            'Approve Permohonan serah peralatan terimaan'
        ];

        foreach ($roles as $key => $role) {
            \Spatie\Permission\Models\Role::updateOrCreate(
                ['name' => $role],
                ['guard_name' => 'web']
            );
        }

        foreach ($permissions as $key => $permission) {
            \Spatie\Permission\Models\Permission::updateOrCreate(
                ['name' => $permission],
                ['guard_name' => 'web']
            );
        }
    }
}
