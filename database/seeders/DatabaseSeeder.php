<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Student;
use App\Models\Cicle;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call(CicleSeeder::class);
        $this->call(ModulSeeder::class);

        
        // Usuario administrador
        $adminUser = User::create([
            'name' => 'Administrador',
            'email' => 'admin@admin.cat',
            'password' => bcrypt('admin1234'),
        ]);

        
        
        Student::factory(20)->create();
    }
}
