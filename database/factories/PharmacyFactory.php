<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Pharmacy;
use Faker\Generator as Faker;


$factory->define(Pharmacy::class, function (Faker $faker) {	 
    $days = ['понедельник',
    		'вторник',
    		'среда',
    		'четверг',
    		'пятница'];
 	$district = ['Голосеевский',
    			'Дарницкий',
    			'Деснянский',
    			'Днепровский',
    			'Оболонский',
    			'Печерский',
    			'Подольский',
    			'Святошинский',
    			'Соломенский',
    			'Шевченковский'];
    $category = ['D1', 'D2', 'D3', 'D4'];
    $equipment = ['Шкаф', NULL];
    $legal_entity = ['Аптека АНЦ ТОВ',
                    'Аптека Низьких Цін К ТОВ',
                    'Аптека низьких цін ТМ ТОВ', 
                    'Аптека низьких цін плюс ТОВ', 
                    'Благодія ТОВ',
    				'Аптекарь ТОВ м.Київ@@@',
                    'Віталюкс ТОВ г.Киев',
    				'Вітамін-1 ТОВ',
                    'Вітамінка ТОВ',
                    'Вітамін-Центр ТОВ', 
                    'Денді-Фарм ТОВ', 
                    'СМАРТ-ФАРМАЦІЯ ТОВ',
    				'ТАС - Фарма ТОВ',
    				'Фармастор м.Київ',
    				'Лекфарм',
    				'Лекхім',
                    'Ласкава-Фарм ТОВ',
    				'Столичний медичний альянс',
    				'Ексімед',
    				'Дорадо Фарм',
    				'Київ-Фармація',
    				'Євроаптека',
    				'Цитрус-Фарм'];
    $sales_rep = ['Михайлов Илья',
				'Шарапов Денис',
				'Таранец Юрий',
				'Анисимов Сергей'];
				
    return [
     	'legal_entity' => $legal_entity[array_rand($legal_entity)],
        'address' => $faker->streetAddress,
        'city' => 'Киев',
        'district' => $district[array_rand($district)],

        'sales_rep' => $sales_rep[array_rand($sales_rep)],
        'category' => $category[array_rand($category)],
           
        'day_of_order' => $days[array_rand($days)],
        'day_of_delivery' => $days[array_rand($days)],
        'equipment' =>$equipment[array_rand($equipment)],

        'pharmacy_manager' => $faker->name($gender = 'female'),
        'phone_number' => $faker->phoneNumber(),
        'email' => $faker->unique()->safeEmail,
    ];
});
