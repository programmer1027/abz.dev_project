<p align="center">Тестовое задание для abz.dev. Список сотрудников</p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>

## About Laravel

Разработка онлайн каталога сотрудников компании с более чем 50,000 сотрудников. 
Технические характеристики проекта:
Framework: Laravel 5.4
Версия PHP: 7.2.0
Версия MySQL: 5.7
Apache/2.4.29
<p>
1.	Создание БД для сотрудников компании:
Была создана БД “company”. Заполняем базу данных используя миграции Laravel.
На ряду с уже существующими миграциями от Фреймворка было создано еще 2 миграции: create_employees_table (нужна для хранения информации о сотрудниках), и create_position_table (нужна для хранения должности сотрудника и его зарплаты, зп. начисляется в зависимости от должности).
<p>
