<?php

namespace Database\Seeders;

use App\Models\Aux\Currency;
use Illuminate\Database\Seeder;

class CurrencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $record=new Currency;
        $record->currency="PESO DOMINICANO";
        $record->symbol='RD$';
        $record->code='DOP';
        $record->decimals_separator=',';
        $record->decimals_separator='.';
        $record->rate=1;
        $record->save();

        $current=$record;

        $record=new Currency;
        $record->currency="DOLAR ESTADOUNIDENSE";
        $record->symbol='$';
        $record->code='USD';
        $record->decimals_separator=',';
        $record->decimals_separator='.';
        $record->rate=0.017;
        $record->save();

        $record=new Currency;
        $record->currency="EURO";
        $record->symbol='€';
        $record->code='EUR';
        $record->decimals_separator='.';
        $record->decimals_separator=',';
        $record->rate=0.014;
        $record->save();




        $current->setCurrent(); // this updates rates
    }
}
