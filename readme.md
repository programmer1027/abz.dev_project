<p align="center">Тестовое задание для abz.dev. Список сотрудников</p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>

## About Laravel

<p>Техническое задание abz.agency<br>
Разработка онлайн каталога сотрудников компании с более чем 50,000 сотрудников. <br>
Технические характеристики проекта:<br>
Framework: Laravel 5.4<br>
Версия PHP: 7.2.0<br>
Версия MySQL: 5.7<br>
Apache/2.4.29</p>

<p>1. Создание БД для сотрудников компании:<br>
Была создана БД “company”. Заполняем базу данных используя миграции Laravel.<br>
На ряду с уже существующими миграциями от Фреймворка было создано еще 2 миграции: create_employees_table (нужна для хранения информации о сотрудниках), и create_position_table (нужна для хранения должности сотрудника и его зарплаты, зп. начисляется в зависимости от должности).<br>
 php artisan make:migration create_position_table --create=position<br>
 php artisan make:migration create_employees_table --create= employees<br>
CreateEmployeesTable (содержит поля):<br>
 <br>
Schema::create('employees', function (Blueprint $table) {<br>
 $table->increments('id');<br>
 $table->integer('parent_id')->default(0);//Ссылка на начальника<br>
 $table->tinyInteger('position_id');//Должность<br>
 $table->string('name', 60);//ФИО сотрудника<br>
 $table->date('date');//Дата приема<br>
 $table->string('image', 100);//Фото сотрудника<br>
 $table->timestamps();<br>
});</p>

<br>
<p>Информация о каждом сотруднике должна храниться в базе данных и содержать следующие данные:<br>
○ ФИО;<br>
○ Должность;<br>
○ Дата приема на работу;<br>
○ Размер заработной платы;</p>

<p>CreatePositionTable (содержит поля):</p>

<p>Schema::create('position', function (Blueprint $table) {<br>
 $table->increments('id');<br>
 $table->string('position', 40);//Наименование должности<br>
 $table->integer('salary');//Уровень ЗП<br>
 $table->timestamps();<br>
});</p>

<p>После делаем запуск всех необходимых миграций используя Artisan-команду migrate:</p>

<br>
<p>php artisan migrate</p>

<p>Проверяем содержимое базы данных “company”:<br>
+------------------------------------+<br>
 | Tables_in_company |<br>
+------------------------------------+<br>
| employees |<br>
| migrations |<br>
| password_resets |<br>
| position |<br>
| users |<br>
+------------------------------------+<br>
5 rows in set (0.00 sec)</p>

<p>2. Для добавления данных в БД используем Artisan-команду make:seeder. Все начальные данные, сгенерированные фреймворком, будут помещены в директорию database/seeds.</p>

<p>Для заполнения нашей БД для таблицы emploees будем использовать фабрики моделей. Создем модели для таблиц position и employees.</p>

<p>php artisan make:model Employees<br>
Model created successfully.</p>

<p>php artisan make:model Position<br>
Model created successfully.</p>

<p>Создаем фабрику для таблицы employees:<br>
$factory->defineAs(App\Employees::class,'general', function (Faker\Generator $faker) {<br>
 $faker = \Faker\Factory::create('ru_RU');<br>
 return [<br>
 'name' => $faker->name,<br>
 'parent_id' => 0,<br>
 'position_id' => 1,<br>
 'date' => $faker->date,<br>
 'image'=> 'img/general.jpg'<br>
 ];<br>
});</p>

<p>$factory->defineAs(App\Employees::class,'top_menager', function (Faker\Generator $faker) {<br>
 $faker = \Faker\Factory::create('ru_RU');<br>
 return [<br>
 'name' => $faker->name,<br>
 'parent_id' => 1,<br>
 'position_id' => 2,<br>
 'date' => $faker->date,<br>
 'image'=> 'img/top_manager.jpg'<br>
 ];<br>
});</p>

<p>$factory->defineAs(App\Employees::class,'midle_menager', function (Faker\Generator $faker) {<br>
 $faker = \Faker\Factory::create('ru_RU');<br>
 return [<br>
 'name' => $faker->name,<br>
 'parent_id' => $faker->numberBetween(2, 3),<br>
 'position_id' => 3,<br>
 'date' => $faker->date,<br>
 'image'=> 'img/midle_manager.jpg'<br>
 ];<br>
});</p>

<p>$factory->defineAs(App\Employees::class,'junior_menager', function (Faker\Generator $faker) {<br>
 $faker = \Faker\Factory::create('ru_RU');<br>
 return [<br>
 'name' => $faker->name,<br>
 'parent_id' => $faker->numberBetween(4, 7),<br>
 'position_id' => 4,<br>
 'date' => $faker->date,<br>
 'image'=> 'img/jun_manager.jpg'<br>
 ];<br>
});</p>

<p>$factory->defineAs(App\Employees::class,'common_employee', function (Faker\Generator $faker) {<br>
 $faker = \Faker\Factory::create('ru_RU');<br>
 return [<br>
 'name' => $faker->name,<br>
 'parent_id' => $faker->numberBetween(12, 17),<br>
 'position_id' => 5,<br>
 'date' => $faker->date,<br>
 'image'=> 'img/common.jpg'<br>
 ];<br>
});</p>

<p>Заполнение таблицы должностей с зарплатами.</p>

<p>DB::table('position')->insert(array(<br>
 array('position' => 'Генеральный директор', 'salary' => 120000),<br>
 array('position' => 'Менеджер выс. звена', 'salary' => 100000),<br>
 array('position' => 'Менеджер сред. звена', 'salary' => 70000),<br>
 array('position' => 'Менеджер нижн. звена', 'salary' => 40000),<br>
 array('position' => 'Рядовой сотрудник', 'salary' => 20000),<br>
));</p>

<p>Выполняем загрузку начальных данных, заполняем класс DatabaseSeeder.</p>

<p>$this->call(EmployeesTableSeeder::class);<br>
$this->call(UsersTableSeeder::class);<br>
$this->call(PositionTableSeeder::class);</p>

<p>Производим выполнение загрузки начальных данных:<br>
php artisan db:seed</p>

<p>3. Использование Twitter Bootstrap для создания базовых стилей страницы.</p>

<p>Используем команду npm install в терминале для загрузки пакетов.</p>

<p>Далее будем использовать Laravel Mix.</p>

<p>Производим сборку в режиме development: npm run dev</p>

<p> Asset Size Chunks Chunk Names<br>
 fonts/vendor/bootstrap-sass/bootstrap/glyphicons-halflings-regular.eot?f4769f9bdb7466be65088239c12046d1 20.1 kB [emitted]<br>
 fonts/vendor/bootstrap-sass/bootstrap/glyphicons-halflings-regular.svg?89889688147bd7575d6327160d64e760 109 kB [emitted]<br>
 fonts/vendor/bootstrap-sass/bootstrap/glyphicons-halflings-regular.ttf?e18bbf611f2a2e43afc071aa2f4e1512 45.4 kB [emitted]<br>
 fonts/vendor/bootstrap-sass/bootstrap/glyphicons-halflings-regular.woff?fa2772327f55d8198301fdb8bcfc8158 23.4 kB [emitted]<br>
fonts/vendor/bootstrap-sass/bootstrap/glyphicons-halflings-regular.woff2?448c34a56d699c29117adc64c43affeb 18 kB [emitted]<br>
 /js/app.js 1.23 MB 0 [emitted] [big] /js/app<br>
 /css/app.css 671 kB 0 [emitted] [big] /js/app<br>
 mix-manifest.json 66 bytes [emitted]</p>

<br>
<p>Далее создаем шаблон нашей страницы. Путь шаблона будет хранится в директории layout под названием master.(layout/ master.blade.php). Шаблон будет взят с сайта http://www.bootstrap-3.ru/bootstraptheme.php.<br>
Под названием starter-template. http://www.bootstrap-3.ru/examples/starter-template/</p>

<p>Подключаем в шаблоне файлы стилей и javascript. Которые были сгенерированы ранее.</p>

<p><link href="{{asset('css/app.css')}}" rel="stylesheet"><br>
<script src="{{asset('js/app.js')}}"></script></p>

<p>Шаблон для проекта готов к использованию. <br>
Часть №1 (обязательная). Выводим список сотрудников в древовидной форме.</p>

<br>
<p>Создадим контроллер EmployeesController который будет отвечать за работу с таблицей сотрудников.<br>
php artisan make:controller EmployeesController –resource</p>

<br>
<p>Метод tree будет отвечать за отображение нашего иерархического списка. Работа метода в данном случае, будет заключаться в получении данных из базы и формировании массива с нужной структурой.<br>
Метод выборки из базы храним в модели Employees.</p>

<p>public function getEmployeesAll()<br>
{<br>
 return<br>
 DB::table('employees')<br>
 // ->where('id', '>', '10')<br>
 ->leftJoin('position', function ($query) {<br>
 $query->on('position.id', '=', 'employees.position_id');<br>
 })<br>
 ->select('employees.*', DB::raw('position.position as position, <br>
 position.salary as salary'))<br>
 //->groupBy('employees.id')<br>
 ->orderBy('position', 'asc')<br>
 //->limit(5)<br>
 ->get();<br>
}</p>

<p>Метод tree котроллера EmployeesController<br>
public function tree(Employees $employees)<br>
{<br>
 return view('EmployeeTreeview.index',['tree'=>$this- <br>
 >makeArray($employees->getEmployeesAll())]);<br>
}<br>
Для формирования правильной структуры для дальнейшего использования и построения дерева используется метод makeArray<br>
private function makeArray($employees){<br>
 $childs=[];</p>

<p> foreach($employees as $employee){<br>
 $childs[$employee->parent_id][]=$employee;<br>
 }</p>

<p> foreach($employees as $employee){<br>
 if(isset($childs[$employee->id]))<br>
 $employee->childs=$childs[$employee->id];</p>

<p> }<br>
 if(count($childs)>0){<br>
 $tree=$childs[0];<br>
 }<br>
 else {<br>
 $tree=[];<br>
 }<br>
 return $tree;<br>
}</p>

<p>Отредактируем наш вид index.blade.php. Он будет иметь след. вид:</p>

<p>@extends('layout.master')<br>
@section('content')<br>
 <h3 style="text-align: center">Иерархия сотрудников</h3></p>

<p> <ul id="tree1"><br>
 @foreach($employees as $empl)<br>
 <li><br>
 {{$empl->name}}, Должность: {{$empl->position}}, Приём: {{$empl->date}}, ЗП: {{$empl->salary}}</p>

<p> @if(isset($empl->childs))<br>
 @include('EmployeeTreeview.tree',["childs"=>$empl->childs])<br>
 @endif<br>
 </li><br>
 @endforeach<br>
 </ul><br>
@endsection<br>
Если у руководителя есть подчиненные, то подключаем еще кусочек кода из файла tree.blade.php. Который примет следующий вид:</p>

<p><ul><br>
 @foreach($childs as $child)<br>
 <li><br>
 {{$child->name}}, Должность: {{$child->position}}, Приём: {{$child->date}}, ЗП: {{$child->salary}}<br>
 @if(isset($child->childs))<br>
 @include('EmployeeTreeview.tree',['childs'=>$child->childs])<br>
 @endif<br>
 </li><br>
 @endforeach<br>
</ul></p>

<p>Для корректного отображения необходимо подключить к проекту еще 2 файла. Файл стилей treeview.css и файл treeview.js.</p>

<p>Файл стилей treeview.css</p>

<p>.tree, .tree ul {<br>
 margin:0;<br>
 padding:0;<br>
 list-style:none<br>
}<br>
.tree ul {<br>
 margin-left:1em;<br>
 position:relative<br>
}<br>
.tree ul ul {<br>
 margin-left:.5em<br>
}<br>
.tree ul:before {<br>
 content:"";<br>
 display:block;<br>
 width:0;<br>
 position:absolute;<br>
 top:0;<br>
 bottom:0;<br>
 left:0;<br>
 border-left:1px solid<br>
}<br>
.tree li {<br>
 margin:0;<br>
 padding:0 1em;<br>
 line-height:2em;<br>
 color:#369;<br>
 font-weight:700;<br>
 position:relative<br>
}<br>
.tree ul li:before {<br>
 content:"";<br>
 display:block;<br>
 width:10px;<br>
 height:0;<br>
 border-top:1px solid;<br>
 margin-top:-1px;<br>
 position:absolute;<br>
 top:1em;<br>
 left:0<br>
}<br>
.tree ul li:last-child:before {<br>
 background:#fff;<br>
 height:auto;<br>
 top:1em;<br>
 bottom:0<br>
}<br>
.indicator {<br>
 margin-right:5px;<br>
}<br>
.tree li a {<br>
 text-decoration: none;<br>
 color:#369;<br>
}<br>
.tree li button, .tree li button:active, .tree li button:focus {<br>
 text-decoration: none;<br>
 color:#369;<br>
 border:none;<br>
 background:transparent;<br>
 margin:0px 0px 0px 0px;<br>
 padding:0px 0px 0px 0px;<br>
 outline: 0;<br>
}</p>

<p>Файл treeview.js.<br>
$.fn.extend({<br>
 treed: function (o) {</p>

<p> var openedClass = 'glyphicon-minus-sign';<br>
 var closedClass = 'glyphicon-plus-sign';</p>

<p> if (typeof o != 'undefined'){<br>
 if (typeof o.openedClass != 'undefined'){<br>
 openedClass = o.openedClass;<br>
 }<br>
 if (typeof o.closedClass != 'undefined'){<br>
 closedClass = o.closedClass;<br>
 }<br>
 };</p>

<p> //initialize each of the top levels<br>
 var tree = $(this);<br>
 tree.addClass("tree");<br>
 tree.find('li').has("ul").each(function () {<br>
 var branch = $(this); //li with children ul<br>
 branch.prepend("<i class='indicator glyphicon " + closedClass + "'></i>");<br>
 branch.addClass('branch');<br>
 branch.on('click', function (e) {<br>
 if (this == e.target) {<br>
 var icon = $(this).children('i:first');<br>
 icon.toggleClass(openedClass + " " + closedClass);<br>
 $(this).children().children().toggle();<br>
 }<br>
 })<br>
 branch.children().children().toggle();<br>
 });<br>
 //fire event from the dynamically added icon<br>
 tree.find('.branch .indicator').each(function(){<br>
 $(this).on('click', function () {<br>
 $(this).closest('li').click();<br>
 });<br>
 });<br>
 //fire event to open branch if the li contains an anchor instead of text<br>
 tree.find('.branch>a').each(function () {<br>
 $(this).on('click', function (e) {<br>
 $(this).closest('li').click();<br>
 e.preventDefault();<br>
 });<br>
 });<br>
 //fire event to open branch if the li contains a button instead of text<br>
 tree.find('.branch>button').each(function () {<br>
 $(this).on('click', function (e) {<br>
 $(this).closest('li').click();<br>
 e.preventDefault();<br>
 });<br>
 });<br>
 }<br>
});</p>

<p>//Initialization of treeviews</p>

<p>$('#tree1').treed();</p>

<p>Получаем древовидный список всех сотрудников компании. <br>
Рисунок 1. Скриншот древовидного списка сотрудников.<br>
Задание №4, 5. Создайте еще одну страницу и выведите на ней список сотрудников со всей имеющейся о сотруднике информацией из базы данных и возможностью сортировать по любому полю. Добавьте возможность поиска сотрудников по любому полю для страницы созданной в задаче 4.<br>
В контроллере EmployeesController создадим метод index<br>
Данные метод будет отвечать за отображение списка сотрудников с имеющейся информацией о сотруднике.<br>
public function index(Request $request)<br>
{<br>
 if(isset($request)) {<br>
 $field = $request->get('field') != '' ? $request->get('field') : 'id';<br>
 $sort = $request->get('sort') != '' ? $request->get('sort') : 'asc';<br>
 $search = $request->get('search');<br>
 }<br>
 else {<br>
 $field = "id"; $sort = "asc";<br>
 }</p>

<p> return view('employees.index', ['employees'=>Employees::getEmployees($sort, $field, $search)]);<br>
}<br>
В модели Employees создаем метод getEmployees. Метод будет производить выборку из базы данных с параметрами для сортировки по полям, а также с возможностью поиска сотрудника.<br>
static public function getEmployees($order = "asc", $name = "id", $search="")<br>
{<br>
 return<br>
 DB::table('employees')<br>
 ->where("name", "like","%".$search."%")<br>
 ->orWhere("position", "like","%".$search."%")<br>
 ->orWhere("date", "like","%".$search."%")<br>
 ->orWhere("salary", "like","%".$search."%")<br>
 ->leftJoin('position', function ($query) {<br>
 $query->on('position.id', '=', 'employees.position_id');<br>
 })<br>
 ->select('employees.*', DB::raw('position.position as position, position.salary as salary'))<br>
 ->orderBy($name, $order)<br>
 ->paginate(30);<br>
}</p>

<p>Создаем вид index.dlade.php в каталоге employees.<br>
@extends('layout.master')</p>

<p>@section('content')<br>
 <h3 style="text-align: center">Список сотрудников фирмы</h3><br>
 {{--*** Блок поиска на сайте по табице Employees ***--}}<br>
 <div class="row"><br>
 <form action="{{action('EmployeesController@index')}}" method="get"><br>
 <div class="col-sm-6 col-md-4 pull-right"><br>
 <div class="input-group"><br>
 <input type="text" class="form-control" name="search" placeholder="Поиск..."><br>
 <input type="hidden" value="{{request('field')}}" name="field"/><br>
 <input type="hidden" value="{{request('sort')}}" name="sort"/><br>
 <span class="input-group-btn"><br>
 <button class="btn btn-primary" type="submit"><i class="glyphicon glyphicon-search"></i></button><br>
 </span><br>
 </div><!-- /input-group --><br>
 </div><!-- /.col-lg-6 --><br>
 </form><br>
 </div><br>
 {{-- ********************************************** --}}<br>
 <br /><br>
 {{-- Отоброжаем таблицу всех сотрудников с возможностью сортировки по полям --}}<br>
 <table class="table"><br>
 <thead><br>
 <tr class="info"><br>
 {{-- Реализуем сортировки по полям: ID, NAME, Position, DATE, Salary --}}<br>
 <th scope="col"><br>
 {{-- Сортировка по полю ID. Работает по умолчанию --}}<br>
 <a href="{{url('employees')}}?page={{request('page')}}&search={{request('search')}}&field=id&sort={{request('sort','asc')=='asc'?'desc':'asc'}}">ID</a><br>
 {{request('field','id')=='id'?(request('sort','asc')=='asc'?'&#9652;':'&#9662;'):''}}<br>
 </th><br>
 <th scope="col"><br>
 {{-- Сортировка по полю NAME.--}}<br>
 <a href="{{url('employees')}}?page={{request('page')}}&search={{request('search')}}&field=name&sort={{request('sort','asc')=='asc'?'desc':'asc'}}">Ф.И.О.</a><br>
 {{request('field','name')=='name'?(request('sort','asc')=='asc'?'&#9652;':'&#9662;'):''}}<br>
 </th><br>
 <th scope="col"><br>
 {{-- Сортировка по полю Position(Должность).--}}<br>
 <a href="{{url('employees')}}?page={{request('page')}}&search={{request('search')}}&field=position&sort={{request('sort','asc')=='asc'?'desc':'asc'}}">Должность</a><br>
 {{request('field','position')=='position'?(request('sort','asc')=='asc'?'&#9652;':'&#9662;'):''}}<br>
 </th><br>
 <th scope="col"><br>
 {{-- Сортировка по полю Date(Дата приема).--}}<br>
 <a href="{{url('employees')}}?page={{request('page')}}&search={{request('search')}}&field=date&sort={{request('sort','asc')=='asc'?'desc':'asc'}}">Дата приема</a><br>
 {{request('field','date')=='date'?(request('sort','asc')=='asc'?'&#9652;':'&#9662;'):''}}<br>
 </th><br>
 <th scope="col"><br>
 {{-- Сортировка по полю Salary(Уровень заработной платы).--}}<br>
 <a href="{{url('employees')}}?page={{request('page')}}&search={{request('search')}}&field=salary&sort={{request('sort','asc')=='asc'?'desc':'asc'}}"><br>
 Уровень ЗП <i class="glyphicon glyphicon-ruble"></i></a><br>
 {{request('field','salary')=='salary'?(request('sort','asc')=='asc'?'&#9652;':'&#9662;'):''}}<br>
 </th><br>
 </tr><br>
 </thead><br>
 <tbody><br>
 @foreach ($employees as $empl)<br>
 <tr><br>
 <th scope="row">{{ $empl->id }}</th><br>
 <td>{{ $empl->name }}</td><br>
 <td>{{ $empl->position }}</td><br>
 <td>{{ $empl->date }}</td><br>
 <td>{{ $empl->salary }}</td><br>
 </tr><br>
 @endforeach<br>
 </tbody><br>
 </table></p>

<p> {{-- ..... Постраничная навигация ..... --}}<br>
 <nav aria-label="Page navigation" class="text-center"><br>
 {{ $employees->appends(array('search' => request('search'), 'sort' => request('sort'), 'field' => request('field')))->links() }}<br>
 {{-- @else {{ $employees->links() }} --}}</p>

<p> </nav></p>

<p>@endsection</p>

<p>Задание № 6 перенесено в ajax crud операции. Задание 8, 9.<br>
Задание 7. Используя стандартные функции Laravel / Symfony, осуществите аутентификацию пользователя для раздела веб сайта доступного только для зарегистрированных пользователей.<br>
В терминале производим команду php artisan make:auth<br>
Данная команда сгенерирует необходимые классы и вид для аутентификации и регистрации пользователя. На начальном этапе мы уже создали одного пользователя при создании миграций. <br>
$factory->define(App\User::class, function () {<br>
 return [<br>
 'name' => 'Доценко А. В.',<br>
 'email' => 'admin@laravel.net',<br>
 'password' => bcrypt('qazwsx1027'),<br>
 'remember_token' => str_random(10),<br>
 ];<br>
});<br>
Пользователь с именем 'admin@laravel.net' находится в базе данных в таблице Users.<br>
Задачи 6, 8, 9. Crud оперции над таблицей сотрудники используя ajax.<br>
Задание 6. Добавьте возможность сортировать (и искать если Вы выполнили задачу No5) по любому полю без перезагрузки страницы, например используя ajax.<br>
Задание 8. Перенесите функционал разработанный в задачах 4, 5 и 6 (используя ajax запросы) в раздел доступный только для зарегистрированных пользователей.<br>
Задание 9. В разделе доступном только для зарегистрированных пользователей, реализуйте остальные CRUD операции для записей сотрудников. Пожалуйста заметьте, что все поля касающиеся пользователей должны быть редактируемыми, включая начальника каждого сотрудника.<br>
Создадим необходимые маршруты в файле web.php<br>
Route::group(['prefix'=>'ajaxemployees', 'middleware' => 'auth'], function(){<br>
Route::get('/', 'AjaxEmployeeController@index');//Cписок всех сотрудников<br>
 ////////////////////////<br>
Route::match(['get', 'put'], 'edit/{id}', <br>
AjaxEmployeeController@edit');//Обновляем информацию о сотруднике<br>
//Добовляем сотрудника в базу<br>
Route::match(['get', 'post'], 'create', 'AjaxEmployeeController@create'); <br>
//Инфо о конкретном сотруднике<br>
Route::get('show/{id}', 'AjaxEmployeeController@show'); <br>
//Удаляем сотрудника из базы<br>
Route::delete('delete/{id}', 'AjaxEmployeeController@destroy'); <br>
 ////////////////////////<br>
 Route::get('/changeselect', 'AjaxEmployeeController@change');//Изменяем select, начальник по подчененности<br>
});<br>
Таким образом если переходить по url 'ajaxemployees' то для просмотра списка сотрудников и для выполнения необходимых crud операций необходимо будет авторизироватся на сайте.<br>
Создаем контроллер AjaxEmployeeController. Данный контроллер будет отвечать за выполнение необходимых круд операций над сотрудниками фирмы. Будет осуществлять возможность отображения списка сотрудников, просмотр полной информации о конкретном сотруднике с указанием его начальника, редактирование информации о сотруднике с возможностью менять начальника, удаление сотрудника. При удалении сотрудника его подчиненные будут распределены другому начальнику такого же ранга или выше.<br>
В терминале вводим команду php artisan make:controller AjaxEmployeeController -–resourse. Команда автоматически создаст контроллер, а также необходимые методы для работы.</p>

<p>Далее в контроллере AjaxEmployeeController создадим метод index. Необходим он будет для отображения списка сотрудников. А также для выполнения сортировок и поиска сотрудников используя ajax запросы.<br>
Метод index будет иметь следующий вид:</p>

<p>public function index(Request $request)<br>
{<br>
 $request->session()->put('search', $request<br>
 ->has('search') ? $request->get('search') : ($request->session()<br>
 ->has('search') ? $request->session()->get('search', '') : ""));<br>
 $request->session()->put('field', $request<br>
 ->has('field') ? $request->get('field') : ($request->session()<br>
 ->has('field') ? $request->session()->get('field') : 'name'));<br>
 $request->session()->put('sort', $request<br>
 ->has('sort') ? $request->get('sort') : ($request->session()<br>
 ->has('sort') ? $request->session()->get('sort') : 'asc'));</p>

<p> /** Выбираем всех сотрудников из таблицы employees,<br>
 * и подставляем данные переданные через AJAX<br>
 */<br>
 $employees = Employees::getEmployees($request->session()->get('sort'),<br>
 $request->session()->get('field'), $request->session()->get('search'));</p>

<p> if ($request->ajax()) {<br>
//Если были переданны по средствам ajax, передаем данные с параметрами сотрировки или поиска<br>
 return view('ajaxCrud.index', compact('employees'));<br>
 } else { <br>
 //Иначе отправляем данные с параметрами по умолчанию при авторизации<br>
 return view('ajaxCrud.ajax', compact('employees'));<br>
 }<br>
}</p>

<p>Необходимо создать каталог ajaxCrud который будет содержать необходимые файлы видов.<br>
Создаем вид по умолчанию ajax.dlade.php. Он будет отображать список сотрудников, когда пользователь пройдет авторизацию. Будет иметь следующий вид.<br>
@extends('layout.master')<br>
@section('css')<br>
 <style><br>
 .loading {<br>
 background: #c9e2b3;<br>
 padding: 15px;<br>
 position: fixed;<br>
 border-radius: 10px;<br>
 left: 50%;<br>
 top: 50%;<br>
 text-align: center;<br>
 margin: -40px 0 0 -50px;<br>
 z-index: 2000;<br>
 display: none;<br>
 }</p>

<p> .form-group.required label:after {<br>
 content: " *";<br>
 color: red;<br>
 font-weight: bold;<br>
 }<br>
 </style><br>
@endsection</p>

<p>@section('content')<br>
 <div id="content"><br>
 @include('ajaxCrud.index')<br>
 </div><br>
 <div class="loading"><br>
 <i class="glyphicon glyphicon-refresh glyphicon-refresh-animate"></i><br>
 <br><br>
 <span>Загрузка..</span><br>
 </div><br>
@endsection</p>

<p>@section('js')<br>
 <script src="{{ asset('js/ajax.js') }}"></script><br>
@endsection</p>

<p>При сортировке или поиске будет загружатся вид 'ajaxCrud.index'<br>
<div class="container"></p>

<p> <h3 style="text-align: center">AJAX CRUD for Employees</h3><br>
 {{--*** Блок поиска на сайте по табице Employees ***--}}<br>
 <div class="row"><br>
 <div class="col-sm-6 col-md-4 pull-right"><br>
 <div class="input-group"><br>
 <input class="form-control" id="search"<br>
 value="{{ request()->session()->get('search') }}"<br>
 onkeydown="if (event.keyCode == 13) ajaxLoad('{{url('ajaxemployees')}}?search='+this.value)"<br>
 placeholder="Поиск сотрудников..." name="search"<br>
 type="text" id="search"/><br>
 <div class="input-group-btn"><br>
 <button type="submit" class="btn btn-info"<br>
 onclick="ajaxLoad('{{url('ajaxemployees')}}?search='+$('#search').val())"><br>
 <i class="glyphicon glyphicon-search" aria-hidden="true"></i><br>
 </button><br>
 </div><br>
 </div><br>
 </div><br>
 </div><br>
 {{-- ********************************************** --}}<br>
 <br /></p>

<p> <table class="table"><br>
 <thead><br>
 <tr></p>

<p> <th width="60px">Фото</th><br>
 <th><a href="javascript:ajaxLoad('{{url('ajaxemployees?page='.(request()->session()->get('page')).'&field=name&sort='<br>
 .(request()->session()->get('sort')=='asc'?'desc':'asc'))}}')">Ф. И. О</a><br>
 {{request()->session()->get('field')=='name'?(request()->session()->get('sort')=='asc'?'&#9652;':'&#9662;'):''}}<br>
 </th></p>

<p> <th style="vertical-align: middle"><br>
 <a href="javascript:ajaxLoad('{{url('ajaxemployees?page='.(request()->session()->get('page')).'&field=position&sort='.(request()->session()->get('sort')=='asc'?'desc':'asc'))}}')"><br>
 Должность<br>
 </a><br>
 {{request()->session()->get('field')=='position'?(request()->session()->get('sort')=='asc'?'&#9652;':'&#9662;'):''}}<br>
 </th></p>

<p> <th style="vertical-align: middle"><br>
 <a href="javascript:ajaxLoad('{{url('ajaxemployees?page='.(request()->session()->get('page')).'&field=date&sort='.(request()->session()->get('sort')=='asc'?'desc':'asc'))}}')"><br>
 Дата приема<br>
 </a><br>
 {{request()->session()->get('field')=='date'?(request()->session()->get('sort')=='asc'?'&#9652;':'&#9662;'):''}}<br>
 </th></p>

<p> <th style="vertical-align: middle"><br>
 <a href="javascript:ajaxLoad('{{url('ajaxemployees?page='.(request()->session()->get('page')).'&field=salary&sort='.(request()->session()->get('sort')=='asc'?'desc':'asc'))}}')"><br>
 Зарплата<br>
 </a><br>
 {{request()->session()->get('field')=='salary'?(request()->session()->get('sort')=='asc'?'&#9652;':'&#9662;'):''}}<br>
 </th><br>
 <th width="160px" style="vertical-align: middle"><br>
 <a href="javascript:ajaxLoad('{{url('ajaxemployees/create')}}')"<br>
 class="btn btn-primary btn-xs"> <i class="glyphicon glyphicon-plus" aria-hidden="true"></i> Добавить</a><br>
 </th><br>
 </tr><br>
 </thead><br>
 <tbody></p>

<p> @foreach ($employees as $empl)<br>
 <tr><br>
 <th><img src="{{asset($empl->image)}}" class="img-rounded" alt="{{$empl->name}}" width="32" height="32"></th><br>
 <td>{{ $empl->name }}</td><br>
 <td >{{ $empl->position }}</td><br>
 <td>{{ $empl->date }}</td><br>
 <td>{{ $empl->salary }}</td><br>
 <td><br>
 <a class="btn btn-success btn-xs" title="Show"<br>
 href="javascript:ajaxLoad('{{url('ajaxemployees/show/'.$empl->id)}}')"><br>
 <b class="glyphicon glyphicon-eye-open"></b><br>
 </a><br>
 &nbsp;<br>
 <a class="btn btn-warning btn-xs" title="Edit"<br>
 href="javascript:ajaxLoad('{{url('ajaxemployees/edit/'.$empl->id)}}')"><br>
 <b class="glyphicon glyphicon-edit"></b><br>
 </a><br>
 &nbsp;<br>
 <input type="hidden" name="_method" value="delete"/><br>
 <a class="btn btn-danger btn-xs" title="Delete"<br>
 href="javascript:if(confirm('Вы хотите удалить сотрудника?')) ajaxDelete('{{url('ajaxemployees/delete/'.$empl->id)}}','{{csrf_token()}}')"><br>
 <b class="glyphicon glyphicon-trash"></b><br>
 </a><br>
 </td><br>
 </tr><br>
 @endforeach</p>

<p> </tbody><br>
 </table><br>
 {{ $employees->links()}}<br>
 </div><br>
 <br>
Рисунок 2. Crud операции ajax<br>
Метод js для осуществления сортирвок и поиска<br>
$(document).on('submit', 'form#frm', function (event) {<br>
 event.preventDefault();<br>
 var form = $(this);<br>
 var data = new FormData($(this)[0]);<br>
 var url = form.attr("action");<br>
 $.ajax({<br>
 type: form.attr('method'),<br>
 url: url,<br>
 data: data,<br>
 cache: false,<br>
 contentType: false,<br>
 processData: false,<br>
 success: function (data) {<br>
 $('.is-invalid').removeClass('is-invalid');<br>
 if (data.fail) {<br>
 for (control in data.errors) {<br>
 $('#' + control).addClass('is-invalid');<br>
 $('#error-' + control).html(data.errors[control]);<br>
 }<br>
 } else {<br>
 ajaxLoad(data.redirect_url);<br>
 }<br>
 },<br>
 error: function (xhr, textStatus, errorThrown) {<br>
 alert("Error: " + errorThrown);<br>
 }<br>
 });<br>
 return false;<br>
});</p>

<p>Подгрузка контента<br>
function ajaxLoad(filename, content) {<br>
 content = typeof content !== 'undefined' ? content : 'content';<br>
 $('.loading').show();<br>
 $.ajax({<br>
 type: "GET",<br>
 url: filename,<br>
 contentType: false,<br>
 success: function (data) {<br>
 $("#" + content).html(data);<br>
 $('.loading').hide();<br>
 },<br>
 error: function (xhr, status, error) {<br>
 alert(xhr.responseText);<br>
 }<br>
 });<br>
}</p>

<p>Метод show контроллера AjaxEmployeeController будет производить отображение информации о конкретном выбранном сотруднике.<br>
public function show(Request $request, $id)<br>
{<br>
 /**<br>
 *Метод show принимает значение ID конкретного сотрудника<br>
 * Функция getEmployeesID делаем выборку по конкретному сотруднику с нужным id<br>
 * возвращает массив сотрудников с нужным ID. При этом отображает начальника сотрудника<br>
 * его ФИО и занимаемую должность.<br>
 */<br>
 if($request->isMethod('get')) {<br>
 $employees = Employees::getEmployeesID($id);<br>
 return view('ajaxCrud.show',['employees' => $employees]);<br>
 }<br>
}</p>

<p>Метод getEmployeesID модели App\Employees осуществляет выборку информации о сотруднике и его начальнике.<br>
static public function getEmployeesID($id)<br>
{<br>
 return<br>
 DB::select('select name, date, image, position, salary,<br>
 (select name from employees b where a.parent_id = b.id) chiefName,<br>
 (select position from employees d<br>
 left join position c ON<br>
 c.id = d.position_id where a.parent_id = d.id) chiefPosition<br>
 from employees a<br>
 left join position c<br>
 ON c.id = a.position_id<br>
 where a.id = :id', ['id' => $id]);<br>
}</p>

<p>Вид show.blade.php. Вывод информации о конкретном оструднике.<br>
<h2 class="text-center text-primary">Информация о сотруднике</h2><br>
<div class="row"><br>
 @foreach($employees as $empl)<br>
 <div class="col-xs-6 col-md-4"><br>
 <img src="{{asset($empl->image)}}" alt="{{$empl->name}}" width="350" height="400"><br>
 </div></p>

<p> <div class="col-xs-6 col-md-6"><br>
 <h3 class="my-3">{{$empl->name}}</h3><br>
 <table class="table"><br>
 <tr><br>
 <td>Должность</td><br>
 <td>{{$empl->position}}</td><br>
 </tr><br>
 <tr><br>
 <td>Дата приема</td><br>
 <td>{{$empl->date}}</td><br>
 </tr><br>
 <tr><br>
 <td>Зарплата</td><br>
 <td>{{$empl->salary}} руб.</td><br>
 </tr><br>
 </table></p>

<p> <h4 class="my-3">Начальник сотрудника</h4><br>
 <table class="table"><br>
 <tr><br>
 <td>Ф.И.О</td><br>
 <td>{{$empl->chiefName}}</td><br>
 </tr><br>
 <tr><br>
 <td>Должность</td><br>
 <td>{{$empl->chiefPosition}}</td><br>
 </tr><br>
 </table><br>
 <div class="col-md-4"><br>
 <a href="javascript:ajaxLoad('{{url('ajaxemployees')}}')" class="btn btn-danger btn-xs"><br>
 Назад</a><br>
 </div><br>
 </div><br>
 @endforeach<br>
</div></p>

<p>/**<br>
 *Добовляем нового сотрудника в базу данных<br>
 */<br>
public function create(Request $request)<br>
{<br>
 if ($request->isMethod('get')){<br>
 $position = Position::all(); //Выбираем все должности для острудника<br>
 //Передаем виду create и отображаем select-ом для выбоара должности нанимаегого сотрудника<br>
 return view('ajaxCrud.create', compact('position'));<br>
 }<br>
 //Правило для полей при отправке формы, для добавления<br>
 //инфо о сотруднике, В случае не соответствия вернем ошибку.<br>
 $this->validate($request, [<br>
 'name' => 'required|max:100', //Проверка ФИО работника<br>
 'parent_id' => 'required||regex:/^[1-9]+$/i',//Проверка на начальника, передается число<br>
 'position_id' => 'required||regex:/^[0-9]+$/i',//Проверка на должность, предается число.<br>
 'date' => 'required||regex:/^\d{4}-\d{2}-\d{2}/' //Дата приема в формате YYYY-MM-DD<br>
 ]);<br>
 if($request->hasFile('image')){//Если передано изображение<br>
 $f_name=$request->file('image')->getClientOriginalName();//определяем имя файла<br>
 $root = public_path('img'); // это корневая папка для загрузки картинок<br>
 $request->file('image')->move($root, $f_name); //перемещаем файл в папку с оригинальным именем<br>
 $all=$request->all(); //в переменой $all будет массив, который содержит все введенные данные в форме<br>
 $all['image']="/img/".$f_name;// меняем значение image на нашу ссылку, иначе в базу попадет что-то вроде /tmp/adfEEsf.tmp<br>
 Employees::create($all);<br>
 }<br>
}</p>

<p>Вид добавления нового сотрудника create.blade.php.<br>
<h1 class="text-center text-primary">Добавление сотрудника</h1><br>
<hr/><br>
 {!! Form::open(['id'=>'frm']) !!}<br>
<div class="row"><br>
 <div class="col-xs-6 col-md-4 center-block"><br>
 <b style="margin-left: 20px">Загрузите изображение</b><br>
 <span style="color: #BA0000; font-family: Verdana; font-size: 14px; font-weight: bold;"> *</span><br>
 <div class="anyName"><br>
 <input type="file" name="image" id="img" accept="image/gif, image/jpeg, image/png" required="required"><br>
 </div><br>
 </div><br>
 <div class="col-xs-6 col-md-6"><br>
 <table class="table"><br>
 <tr><br>
 <td class="form-group row required"><br>
 Ф.И.О.<span style="color: #BA0000; font-family: Verdana; font-size: 14px; font-weight: bold;"> *</span><br>
 </td><br>
 <td><br>
 <input name="name" type="text" class="form-control" placeholder="Введите имя" value="" required><br>
 </td><br>
 </tr><br>
 <tr><br>
 <td><br>
 Должность <span style="color: #BA0000; font-family: Verdana; font-size: 14px; font-weight: bold;"> *</span><br>
 </td><br>
 <td><br>
 <select class="form-control" name="position_id" id="position" required="required"><br>
 @foreach($position as $pos)<br>
 <option name="pos" id="{{$pos->id}}" value="{{$pos->id}}">{{$pos->position}}</option><br>
 @endforeach<br>
 </select><br>
 </td><br>
 </tr><br>
 <tr><br>
 <td><br>
 Дата приема<br>
 <span style="color: #BA0000; font-family: Verdana; font-size: 14px; font-weight: bold;"> *</span><br>
 </td><br>
 <td><br>
 <div class="form-group"><br>
 <input type="date" name="date" class="form-control" required="required"><br>
 </div><br>
 </td><br>
 </tr><br>
 <tr><br>
 <td><br>
 Начальник<br>
 <span style="color: #BA0000; font-family: Verdana; font-size: 14px; font-weight: bold;"> *</span><br>
 </td><br>
 <td><br>
 {!! Form::select('parent_id',[''=>'--- Начальник ---'],null,['class'=>'form-control']) !!}<br>
 </td><br>
 </tr><br>
 </table><br>
 <div class="col-md-4"><br>
 <a href="javascript:ajaxLoad('{{url('ajaxemployees')}}')" class="btn btn-danger btn-xs"><br>
 Назад</a><br>
 <button type="submit" class="btn btn-primary btn-xs" name="submit" id="submit1">Сохранить</button><br>
 </div><br>
 </div></p>

<p> {!! Form::close() !!}<br>
</div><br>
<script type="text/javascript"><br>
 $('.anyName').uploadPreview({<br>
 width: '200px',<br>
 height: '200px',<br>
 backgroundSize: 'cover',<br>
 fontSize: '16px',<br>
 borderRadius: '100px',<br>
 border: '3px solid #dedede',<br>
 lang: 'ru', //language<br>
 });<br>
</script></p>

<p>Для редактирования информации о сотруднике используется метод edit контроллера AjaxEmployeeController.<br>
public function edit(Request $request, $id)<br>
{<br>
 if ($request->isMethod('get')){<br>
 $employees = Employees::getEmployeesID($id);<br>
 $position = Position::all();<br>
 return view('ajaxCrud.edit',['employees' => $employees, 'position' => $position, 'id' => $id]);<br>
 }<br>
 if($request->isMethod('put')){<br>
 $employees = Employees::find($request->id);<br>
 $employees->name = $request->name; //Сохраняем имя.</p>

<p> if(isset($request->position_id)){<br>
 $employees->position_id = $request->position_id;//Сохраняем должность<br>
 $employees->position_id = $request->parent_id;//Сохраняем Начальника для сотрудника<br>
 }<br>
if($request->hasFile('image')){//Если передано изображение<br>
$f_name=$request->file('image')->getClientOriginalName();//определяем имя файла<br>
$root = public_path('img'); // это корневая папка для загрузки картинок<br>
$request->file('image')->move($root, $f_name); //перемещаем файл в папку с оригинальным именем<br>
$employees->image="/img/".$f_name;// меняем значение image на нашу ссылку, иначе в базу попадет что-то вроде /tmp/adfEEsf.tmp<br>
 }<br>
$employees->save();//Сохраняем отредактированную инфу в базу<br>
 return response()->json([<br>
 'fail' => false,<br>
 'redirect_url' => url('ajaxemployees')<br>
 ]);<br>
 }<br>
}<br>
При изменении должности сотрудника используется метод change контроллера AjaxEmployeeController. Данный метод принимает информацию по средствам ajax и выводит список всех начальников для сотрудника.<br>
//Метод change нужен для select-а при добавлении сотрудника<br>
//Данные аередаются через ajax.<br>
//Выбрав должность ему предлагается выбрать начальника<br>
//Ранг начальника должен быть выше.<br>
public function change(Request $request){<br>
 if ($request->isMethod('get')){<br>
 $id = $request->id; // ID выбраной должности<br>
 $chiefs = Employees::getChiefs($id); //Выбираепм имена всех начальников старших по должности<br>
 $data = view('ajaxCrud.ajax-select',compact('chiefs'))->render();<br>
 return response()->json(['options'=>$data]);<br>
 }<br>
}</p>

<p>В модели Empoyees создаем метод getChiefs. Выбираем начальников для сотрудника при добавлении. Выбираем только тех сотрудников где переданный уровень позиции выше.</p>

<p>static public function getChiefs($id){<br>
 return<br>
 DB::table('employees')->where('position_id', '<', $id)->pluck("name", "id")->all();<br>
}</p>

<br>
<p>В файле ajax.js создадим метод. Который реагирует на изменение select-a, то есть на изменение должности сотрудника.<br>
$(document).on('change', '#position', function (event) {<br>
 event.preventDefault();<br>
 var position = $("#position option:selected").val();<br>
 var formData = $(this).val();<br>
 $.ajax({<br>
 method: 'GET', // Type of response and matches what we said in the route<br>
 url: 'ajaxemployees/changeselect', // This is the url we gave in the route<br>
 data: {'id': position}, // a JSON object to send back<br>
 contentType: false,<br>
 success: function(response){ // What to do if we succeed<br>
 $("select[name='parent_id']").html('');<br>
 $("select[name='parent_id']").html(response.options);<br>
 },<br>
 error: function (xhr, status, error) {<br>
 alert(xhr.responseText);<br>
 }<br>
 });<br>
});</p>

<p>Далее вид ajax-select.blade.php<br>
@if(!empty($chiefs))<br>
 @foreach($chiefs as $key => $value)<br>
 <option value="{{ $key }}">{{ $value }}</option><br>
 @endforeach<br>
@endif</p>

<p>Шаблон для редактирования информации о сотруднике edit.blade.php<br>
<h1 class="text-center text-primary">{{isset($employees)?'Редактирование':'Добавление'}} сотрудника</h1><br>
<hr/><br>
@if(isset($employees))<br>
 {!! Form::model($employees,['method'=>'put','id'=>'frm']) !!}<br>
@endif<br>
<div class="row"><br>
 @foreach($employees as $empl)<br>
 {{-- Загружаем изображение --}}<br>
 <div class="col-xs-6 col-md-4"><br>
 <img src="{{asset($empl->image)}}" name="image" alt="{{$empl->name}}" width="350" height="400"><br><br><br>
 <span class="btn btn-default btn-file"><br>
 Загрузка изображения<br>
 <input type="file" name="image" id="img" class="form-control-file" accept="image/gif, image/jpeg, image/png"><br>
 </span><br>
 </div><br>
 <input type="hidden" id="{{$id}}" name="empl_id"><br>
 <div class="col-xs-6 col-md-6"><br>
 <table class="table"><br>
 <tr><br>
 <td class="form-group row required"><br>
 Ф.И.О.<span style="color: #BA0000; font-family: Verdana; font-size: 14px; font-weight: bold;"> *</span><br>
 </td><br>
 <td><br>
 <input name="name" type="text" class="form-control" placeholder="Ваше имя" value="{{$empl->name}}" required><br>
 </td><br>
 </tr><br>
 <tr><br>
 <td>Текущая должность</td><br>
 <td>{{$empl->position}}</td><br>
 </tr><br>
 <tr><br>
 <td><br>
 Изменить должность<br>
 <input class="form-check-input" type="checkbox" value="" id="enableSelect"><br>
 </td><br>
 <td><br>
 <input type="hidden" name="hidenPosition" value="{{$empl->position}}"><br>
 <select class="form-control" name="position_id" id="position" disabled><br>
 @foreach($position as $pos)<br>
 @if($pos->position == $empl->position)<br>
 <option name="pos" selected id="{{$pos->id}}" value="{{$pos->id}}">{{$pos->position}}</option><br>
 @else<br>
 <option name="pos" id="{{$pos->id}}" value="{{$pos->id}}">{{$pos->position}}</option><br>
 @endif<br>
 @endforeach<br>
 </select><br>
 </td><br>
 </tr><br>
 <tr><br>
 <td>Дата приема</td><br>
 <td>{{$empl->date}}</td><br>
 </tr><br>
 <tr><br>
 <td>Зарплата</td><br>
 <td>{{$empl->salary}} руб.</td><br>
 </tr><br>
 </table></p>

<p> <h4 class="my-3">Начальник сотрудника</h4><br>
 <table class="table"><br>
 <tr><br>
 <td>Ф.И.О</td><br>
 <td>{{$empl->chiefName}}</td><br>
 </tr><br>
 <tr><br>
 <td>Должность</td><br>
 <td>{{$empl->chiefPosition}}</td><br>
 </tr><br>
 <tr><br>
 <td><br>
 Изменить начальника<br>
 </td><br>
 <td><br>
 {!! Form::select('parent_id',[''=>'--- Начальник ---'], $empl->chiefName,['class'=>'form-control', 'disabled' => true, 'id' => 'parent_id']) !!}<br>
 </td><br>
 </tr><br>
 </table><br>
 <div class="col-md-4"><br>
 <a href="javascript:ajaxLoad('{{url('ajaxemployees')}}')" class="btn btn-danger btn-xs"><br>
 Назад</a><br>
 <button type="submit" class="btn btn-primary btn-xs" name="submit" id="submit1">Сохранить</button><br>
{{-- {!! Form::button("Сохранить",["type" => "submit","class"=>"btn btn-primary btn-xs"])!!} --}}<br>
</div><br>
</div><br>
@endforeach<br>
 {!! Form::close() !!}<br>
</div><br>
 <br>
Далее делаем удаление сотрудника из базы. За это отвечает метод destroy<br>
контроллера AjaxEmployeeController.<br>
Метод удаления сотрудника из базы. Нужно учесть, что у сотрудника могут быть подчинённые у которых parent_id указывает на удаляющегося сотрудника. В таком случае необходимо предусмотреть перераспределение подчинённых новому руководителю.<br>
public function destroy($id)<br>
{<br>
 //Выбираем всех сотрудников где parent_id = id; Всех подчененных если они есть у сотрудника<br>
$employees_parent = Employees::where('parent_id', '=', $id)->get();<br>
$data = Employees::find($id);//Выбираем конкретного сотрудника которого будем удалять<br>
 if(count($employees_parent) == 0){<br>
 //Если у сотрудника нет подчиненных то просто удаляем его из базы<br>
 Employees::destroy($id);<br>
 }<br>
 //Если ужаляем ген. директора. То необходимо назначить другого работника на его должность<br>
 elseif ($data->position_id == 1)<br>
 {<br>
 //Выбираем сотрудника из базы который ниже по рангу на 1 уровень.<br>
 $employees = Employees::where('position_id', '=', $data->position_id + 1)->first();<br>
 Employees::where('id', '=', $employees->id)->update(["position_id" => 1, "parent_id" => 0]);<br>
 //Модифицируем сылку на нового начальника(parent_id)<br>
 Employees::where('parent_id', $id)->update(['parent_id' => <br>
 $employees->id]);<br>
 Employees::destroy($id);//Удаляем из базы предыдущего ген. директора<br>
 }<br>
 else<br>
 {<br>
 //Необходимо определить начальника сотрудника которому будут переданы подчиненные<br>
 //Передаем всех подченненных начальнику удаляемого сотрудника.<br>
 $parent_id = $data->parent_id;//Определяем его начальника<br>
 //Переносим всех сотрудников к новому начальнику.<br>
 Employees::where('parent_id', '=', $id)->update(["parent_id" => $parent_id]);<br>
 //Удаляем выбраного сотрудника из базы данных<br>
 Employees::destroy($id);<br>
 }<br>
 return redirect('ajaxemployees'); //Возвращаемся к списку сотрудников.<br>
}</p>

<br>
<p></p>
