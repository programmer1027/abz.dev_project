<?php

use Illuminate\Database\Seeder;

class PositionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('position')->insert(array(
            array('position' => 'Генеральный директор', 'salary' => 120000),
            array('position' => 'Менеджер выс. звена', 'salary' => 100000),
            array('position' => 'Менеджер сред. звена', 'salary' => 70000),
            array('position' => 'Менеджер нижн. звена', 'salary' => 40000),
            array('position' => 'Рядовой сотрудник', 'salary' => 20000),
        ));
    }
}
