<?php

namespace Database\Seeders;

use App\Models\Category;
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
        $this->call(PermissionSeed::class);
        $this->call(RoleSeed::class);
        $this->call(UserSeed::class);
        $this->call(UserSeedPivot::class);
        $this->call(RoleSeedPivot::class);
        $this->call(CategorySeed::class);
        $this->call(QuestionSeed::class);
        $this->call(OptionSeed::class);
    }
}
