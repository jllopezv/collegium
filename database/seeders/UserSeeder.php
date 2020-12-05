<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Auth\Role;
use App\Models\Aux\Country;
use App\Models\Aux\Timezone;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user=new User;
        $user->username='lop';
        $user->name='José Luís López';
        $user->email='jllopezvicente@gmail.com';
        $user->password=Hash::make('secret');
        $user->level=1;
        $user->timezone_id=Timezone::where('name',config('lopsoft.timezone_default'))->first()->id??null;
        $user->country_id=Country::where('country',config('lopsoft.country_default'))->first()->id??null;
        $user->dateformat=config('lopsoft.date_format');
        $user->save();
        $user->roles()->sync([(Role::where('level',1)->first())->id]);


        $user=new User;
        $user->username='jose';
        $user->name='Jose';
        $user->email='jllopez@gmail.com';
        $user->password=Hash::make('secret');
        $user->level=1000;
        $user->timezone_id=Timezone::where('name',config('lopsoft.timezone_default'))->first()->id??null;
        $user->country_id=Country::where('country',config('lopsoft.country_default'))->first()->id??null;
        $user->dateformat=config('lopsoft.date_format');
        $user->save();
        $user->roles()->sync([(Role::where('level',1000)->first())->id]);



        // Factory

        User::factory()->count(500)->create();
    }
}
