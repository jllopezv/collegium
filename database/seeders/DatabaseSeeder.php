<?php

namespace Database\Seeders;

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
        // Auxs
        $this->call(ColorSeeder::class);
        $this->call(CountrySeeder::class);
        $this->call(TimezoneSeeder::class);
        $this->call(LanguageSeeder::class);
        $this->call(AnnoSeeder::class);

        // Setting
        $this->call(AppSettingPageSeeder::class);
        $this->call(AppSettingSeeder::class);

        // Website
        $this->call(WebsitePostCatSeeder::class);

        //Auth
        $this->call(PermissionGroupSeeder::class);
        $this->call(PermissionSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(UserSeeder::class);

    }
}
