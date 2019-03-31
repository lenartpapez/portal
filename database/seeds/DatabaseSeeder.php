<?php

use App\Field;
use App\Goal;
use App\User;
use App\Role;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{

    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->users_and_roles();
        $this->srips();
        $this->fields();
        $this->goals();
        // $this->call(UsersTableSeeder::class);
    }

    // Fill the fields
    public function fields()
    {
        $fields = [
            ['name' => 'Tehnologija - pridelava', 'srip_id' => '1'],
            ['name' => 'Tehnologija - predelava', 'srip_id' => '1'],
            ['name' => 'Distribucija', 'srip_id' => '1'],
            ['name' => 'Kakovost živil', 'srip_id' => '1'],
            ['name' => 'Embalaža', 'srip_id' => '1'],
            ['name' => 'Prehrana v javnih zavodih', 'srip_id' => '1'],
            ['name' => 'Novi izdelki', 'srip_id' => '1'],
            ['name' => 'Surovine', 'srip_id' => '1'],
            ['name' => 'Povezovanje / prenos znanja', 'srip_id' => '1'],
            ['name' => 'Učinki na zdravje', 'srip_id' => '1'],
            ['name' => 'Poskusni / testni centri', 'srip_id' => '1'],
        ];
        Field::insert($fields);
    }

    // Fill the users
    public function users_and_roles()
    {
        User::insert([
            'name' => 'Lenart Papež',
            'email' => 'admin@portal.si',
            'password' => bcrypt('admin'),
            'created_at' => now(),
            'updated_at' => now()
        ]);
        Role::insert(['name' => 'admin']);
        DB::table('role_user')->insert(['role_id' => 1, 'user_id' => 1]);
    }

    // Fill the SRIP
    public function srips()
    {
        DB::table('srips')->insert([['name' => 'SRIP3'], ['name' => 'SRIP4']]);
    }

    // Fill the goals
    public function goals()
    {
        $goals = [
            ['name' => 'Optimizacija pridelave zelenjave', 'field_id' => '1'],
            ['name' => 'Kultivacija alg', 'field_id' => '2'],
            ['name' => 'Tehnologija - distribucija', 'field_id' => '3'],
            ['name' => 'Ohranjanje kakovosti', 'field_id' => '4'],
            ['name' => 'Pakiranje', 'field_id' => '5'],
            ['name' => 'Javna prehrana', 'field_id' => '6'],
            ['name' => 'Razvoj funkcionalnih živil in prehranskih dopolnil', 'field_id' => '7'],
            ['name' => 'Surovine', 'field_id' => '8'],
            ['name' => 'Povezovanje / prenos znanja', 'field_id' => '9'],
            ['name' => 'Učinki hrane na zdravje', 'field_id' => '10'],
            ['name' => 'Prenašanje tehnologij iz znanstvenega v aplikativno raziskovanje', 'field_id' => '11'],
        ];
        Goal::insert($goals);
    }
}
