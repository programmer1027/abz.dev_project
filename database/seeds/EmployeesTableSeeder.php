<?php

use Illuminate\Database\Seeder;

class EmployeesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Генеральный директор
        factory(App\Employees::class, 'general')->create();
        //Менеджеры выс. звена
        factory(App\Employees::class, 'top_menager', 2)->create();
        //Менеджеры Среднего звена
        factory(App\Employees::class, 'midle_menager', 4)->create();
        //Менеджеры Нижнего звена
        factory(App\Employees::class, 'junior_menager', 10)->create();
        //Рядовые сотрудники
        factory(App\Employees::class, 'common_employee', 50000)->create();
    }
}
