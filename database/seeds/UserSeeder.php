<?php

use Illuminate\Database\Seeder;
use App\DB\Member;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->truncate();
        Member::unguard();
        factory(Member::class, 50)->create();
        Member::reguard();
    }
}
