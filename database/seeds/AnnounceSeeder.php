<?php

use Illuminate\Database\Seeder;
use App\DB\Announce;

class AnnounceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('announces')->truncate();
        Announce::unguard();
        factory(Announce::class, 20)->create();
        Announce::reguard();
    }
}
