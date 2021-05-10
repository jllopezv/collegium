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
        $this->call(SchoolPeriodSeeder::class);

        // Setting
        $this->call(AppSettingPageSeeder::class);
        $this->call(AppSettingSeeder::class);

        // Website
        $this->call(WebsitePostCatSeeder::class);
        $this->call(WebsiteAdvertisementCatSeeder::class);
        $this->call(WebsiteNewsCatSeeder::class);
        $this->call(WebsiteSectionCatSeeder::class);
        $this->call(WebsiteMenuSeeder::class);

        // School
        $this->call(SchoolLevelSeeder::class);
        $this->call(SchoolGradeSeeder::class);
        $this->call(SchoolBatchSeeder::class);
        $this->call(SchoolModalitySeeder::class);

        //Auth
        $this->call(PermissionGroupSeeder::class);
        $this->call(PermissionSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(UserSeeder::class);



    }
}
