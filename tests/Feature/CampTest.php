<?php

namespace Tests\Feature;

use App\Models\Camp;
use Database\Seeders\CampSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CampTest extends TestCase
{
    public function testSeedCamp()
    {
        $this->seed([CampSeeder::class]);

        $camps = Camp::where('id','1')->first();

    }
}
