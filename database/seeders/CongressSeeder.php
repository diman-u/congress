<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\Nomination;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CongressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $event = Event::create([
            'title' => 'Конгресс «Оргздрав-2023»',
            'is_active' => 1
        ]);

        $nominations = [
            [
                'title' => 'Эффективное управление медицинскими кадрами',
                'body' => 'Решения по ликвидации дефицита и повышению квалификации кадров, борьба с выгоранием и командообразующие проекты'
            ],
            [
                'title' => 'Управление качеством медицинской помощи: изменение стереотипов',
                'body' => 'Проекты по внедрению и совершенствованию систем менеджмента качества, формированию культуры по обеспечению безопасности пациентов'
            ],
            [
                'title' => 'Цифровая трансформация здравоохранения: интересные решения',
                'body' => 'Работающие примеры и перспективные технологии (МИС, СППВР, ЭБС, телемедицина, удаленный мониторинг), перестройка управленческих процессов'
            ],
            [
                'title' => 'Стратегические решения в развитии здравоохранения региона',
                'body' => 'Новые и проверенные подходы к охране здоровья населения'
            ],
            [
                'title' => 'Прорыв года: проект медицинской организации',
                'body' => 'Локальные решения – масштабные преобразования'
            ],
            [
                'title' => 'Корифей отрасли',
                'body' => 'Наставники, лидеры, новаторы, старейшины отрасли – рассказы о людях, создающих здравоохранение'
            ],
            [
                'title' => 'Научное открытие отечественной медицины',
                'body' => 'Новаторские идеи, революционные открытия'
            ],
            [
                'title' => 'Частное здравоохранение: вклад в национальную систему',
                'body' => 'Эффективные форматы и совместные проекты'
            ],
            [
                'title' => 'Авторская журналистика: создаем информационное пространство отрасли',
                'body' => 'Медицинские блоги и каналы, авторские колонки, отраслевые обзоры, расследования и циклы статей по медицине и организации здравоохранения
(для участия в премии необходимо прикрепить описание проекта, один материал и ссылку на источник)'
            ],
            [
                'title' => 'Финансово-экономическая модель: эффективные решения',
                'body' => 'Организационные модели для обеспечения эффективности деятельности, управленческие подходы'
            ],
        ];


        foreach ($nominations as $nominationData) {
            $nomination = Nomination::create($nominationData);
            $nomination->events()->attach($event);
        }
    }
}
