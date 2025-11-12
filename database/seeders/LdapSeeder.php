<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Ldap;

class LdapSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $ldap = Ldap::create([
            'ip' => '192.168.1.1',
            'port' => '389',
            'domain' => 'example.com',
            'base_dn' => 'dc=example,dc=com',
            'user' => 'admin',
            'password' => 'password',  
            'version' => 3,
            'status' => true,
        ]);
    }
}
