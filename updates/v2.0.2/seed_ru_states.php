<?php namespace Winter\Location\Updates;

use Winter\Storm\Database\Updates\Seeder;
use Winter\Location\Models\Country;
use Winter\Location\Models\State;

class SeedItStates extends Seeder
{
    public function run()
    {
        Country::extend(function ($model) {
            $model->setTable('winter_location_countries');
        });

        State::extend(function ($model) {
            $model->setTable('winter_location_states');
        });

        $it = Country::whereCode('RU')->first();

        if ($it->states()->count() > 0) {
            return;
        }

        $it->states()->createMany([
            ['code' => 'RU-AD', 'name' => 'Адыгея'],
            ['code' => 'RU-BA', 'name' => 'Башкортостан'],
            ['code' => 'RU-BU', 'name' => 'Бурятия'],
            ['code' => 'RU-AL', 'name' => 'Республика Алтай'],
            ['code' => 'RU-DA', 'name' => 'Дагестан'],
            ['code' => 'RU-IN', 'name' => 'Ингушетия'],
            ['code' => 'RU-KB', 'name' => 'Кабардино-Балкария'],
            ['code' => 'RU-KL', 'name' => 'Калмыкия'],
            ['code' => 'RU-KC', 'name' => 'Карачаево-Черкесия'],
            ['code' => 'RU-KR', 'name' => 'Карелия'],
            ['code' => 'RU-KO', 'name' => 'Республика Коми'],
            ['code' => 'RU-ME', 'name' => 'Марий Эл'],
            ['code' => 'RU-MO', 'name' => 'Мордовия'],
            ['code' => 'RU-SA', 'name' => 'Якутия'],
            ['code' => 'RU-SE', 'name' => 'Северная Осетия'],
            ['code' => 'RU-TA', 'name' => 'Татарстан'],
            ['code' => 'RU-TY', 'name' => 'Тыва'],
            ['code' => 'RU-UD', 'name' => 'Удмуртия'],
            ['code' => 'RU-KK', 'name' => 'Хакасия'],
            ['code' => 'RU-CU', 'name' => 'Чувашия'],
            ['code' => 'RU-ALT', 'name' => 'Алтайский край'],
            ['code' => 'RU-KDA', 'name' => 'Краснодарский край'],
            ['code' => 'RU-KYA', 'name' => 'Красноярский край'],
            ['code' => 'RU-PRI', 'name' => 'Приморский край'],
            ['code' => 'RU-STA', 'name' => 'Ставропольский край'],
            ['code' => 'RU-KHA', 'name' => 'Хабаровский край'],
            ['code' => 'RU-AMU', 'name' => 'Амурская область'],
            ['code' => 'RU-ARK', 'name' => 'Архангельская область'],
            ['code' => 'RU-AST', 'name' => 'Астраханская область'],
            ['code' => 'RU-BEL', 'name' => 'Белгородская область'],
            ['code' => 'RU-BRY', 'name' => 'Брянская область'],
            ['code' => 'RU-VLA', 'name' => 'Владимирская область'],
            ['code' => 'RU-VGG', 'name' => 'Волгоградская область'],
            ['code' => 'RU-VLG', 'name' => 'Вологодская область'],
            ['code' => 'RU-VOR', 'name' => 'Воронежская область'],
            ['code' => 'RU-IVA', 'name' => 'Ивановская область'],
            ['code' => 'RU-IRK', 'name' => 'Иркутская область'],
            ['code' => 'RU-KGD', 'name' => 'Калининградская область'],
            ['code' => 'RU-KLU', 'name' => 'Калужская область'],
            ['code' => 'RU-KAM', 'name' => 'Камчатский край'],
            ['code' => 'RU-KEM', 'name' => 'Кемеровская область'],
            ['code' => 'RU-KIR', 'name' => 'Кировская область'],
            ['code' => 'RU-KOS', 'name' => 'Костромская область'],
            ['code' => 'RU-KGN', 'name' => 'Курганская область'],
            ['code' => 'RU-KRS', 'name' => 'Курская область'],
            ['code' => 'RU-LEN', 'name' => 'Ленинградская область'],
            ['code' => 'RU-LIP', 'name' => 'Липецкая область'],
            ['code' => 'RU-MAG', 'name' => 'Магаданская область'],
            ['code' => 'RU-MOS', 'name' => 'Московская область'],
            ['code' => 'RU-MUR', 'name' => 'Мурманская область'],
            ['code' => 'RU-NIZ', 'name' => 'Нижегородская область'],
            ['code' => 'RU-NGR', 'name' => 'Новгородская область'],
            ['code' => 'RU-NVS', 'name' => 'Новосибирская область'],
            ['code' => 'RU-OMS', 'name' => 'Омская область'],
            ['code' => 'RU-ORE', 'name' => 'Оренбургская область'],
            ['code' => 'RU-ORL', 'name' => 'Орловская область'],
            ['code' => 'RU-PNZ', 'name' => 'Пензенская область'],
            ['code' => 'RU-PER', 'name' => 'Пермский край'],
            ['code' => 'RU-PSK', 'name' => 'Псковская область'],
            ['code' => 'RU-ROS', 'name' => 'Ростовская область'],
            ['code' => 'RU-RYA', 'name' => 'Рязанская область'],
            ['code' => 'RU-SAM', 'name' => 'Самарская область'],
            ['code' => 'RU-SAR', 'name' => 'Саратовская область'],
            ['code' => 'RU-SAK', 'name' => 'Сахалинская область'],
            ['code' => 'RU-SVE', 'name' => 'Свердловская область'],
            ['code' => 'RU-SMO', 'name' => 'Смоленская область'],
            ['code' => 'RU-TAM', 'name' => 'Тамбовская область'],
            ['code' => 'RU-TVE', 'name' => 'Тверская область'],
            ['code' => 'RU-TOM', 'name' => 'Томская область'],
            ['code' => 'RU-TUL', 'name' => 'Тульская область'],
            ['code' => 'RU-TYU', 'name' => 'Тюменская область'],
            ['code' => 'RU-ULY', 'name' => 'Ульяновская область'],
            ['code' => 'RU-CHE', 'name' => 'Челябинская область'],
            ['code' => 'RU-ZAB', 'name' => 'Забайкальский край'],
            ['code' => 'RU-YAR', 'name' => 'Ярославская область'],
            ['code' => 'RU-MOW', 'name' => 'Москва'],
            ['code' => 'RU-SPE', 'name' => 'Санкт-Петербург'],
            ['code' => 'RU-YEV', 'name' => 'Еврейская автономная область'],
            ['code' => 'UA-43', 'name' => 'Крым'],
            ['code' => 'RU-NEN', 'name' => 'Ненецкий автономный округ'],
            ['code' => 'RU-KHM', 'name' => 'Ханты-Мансийский автономный округ - Югра'],
            ['code' => 'RU-CHU', 'name' => 'Чукотский автономный округ'],
            ['code' => 'RU-YAN', 'name' => 'Ямало-Ненецкий автономный округ'],
            ['code' => 'UA-40', 'name' => 'Севастополь'],
            ['code' => 'RU-CE', 'name' => 'Чечня'],
        ]);
    }
}
