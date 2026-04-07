<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class ReviewsSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('ru_RU');

        $productIds = [49, 50, 51, 52, 53, 54, 55, 56, 57, 58, 59, 60];

        foreach ($productIds as $productId) {
            $reviewsCount = rand(3, 100);

            for ($i = 0; $i < $reviewsCount; $i++) {
                DB::table('reviews')->insert([
                    'product_id' => $productId,
                    'name' => $faker->name,
                    'email' => $faker->safeEmail,
                    'phone' => $faker->phoneNumber,
                    'rating' => rand(3, 5),
                    'body' => $this->getRandomReviewText($faker),
                    'is_published' => rand(0, 1) ? true : false,
                    'created_at' => $faker->dateTimeBetween('-6 months', 'now'),
                    'updated_at' => now(),
                ]);
            }
        }

        $this->addSpecificReviews();
    }

    private function getRandomReviewText($faker): string
    {
        $reviews = [
            'Отличный товар! Качество на высоте, всем рекомендую.',
            'Доставка быстрая, товар соответствует описанию. Спасибо!',
            'Очень доволен покупкой, буду заказывать еще.',
            'Хороший товар за свои деньги. Рекомендую!',
            'Претензий нет, все работает отлично.',
            'Немного не соответствует ожиданиям, но в целом нормально.',
            'Качество хорошее, доставка вовремя. Спасибо продавцу!',
            'Товар супер! Полностью оправдал ожидания.',
            'Быстрая доставка, качественный товар. Спасибо!',
            'Очень понравилось качество, буду рекомендовать друзьям.',
            'Хорошее соотношение цены и качества. Доволен покупкой.',
            'Все отлично, спасибо большое!',
            'Товар пришел в целости, все работает. Рекомендую!',
            'Отличный продавец, быстрая отправка. Спасибо!',
            'Качество на высоте, очень доволен покупкой.',
            'Все супер, буду заказывать еще!',
            'Немного долгая доставка, но товар качественный.',
            'Хороший товар, соответствует описанию.',
            'Очень качественный продукт, спасибо продавцу!',
            'Рекомендую всем, отличное качество!',
        ];

        // Иногда добавляем негативные отзывы
        if (rand(1, 10) <= 2) { // 20% негативных отзывов
            $negativeReviews = [
                'Товар не соответствует описанию. Разочарован.',
                'Качество оставляет желать лучшего. Не рекомендую.',
                'Доставка была очень долгой, товар пришел поврежденным.',
                'Не понравилось качество, не буду заказывать больше.',
                'Товар сломался через неделю использования.',
            ];
            return $negativeReviews[array_rand($negativeReviews)];
        }

        return $reviews[array_rand($reviews)];
    }

    private function addSpecificReviews(): void
    {
        // Добавляем несколько конкретных отзывов для разнообразия
        $specificReviews = [
            [
                'product_id' => 49,
                'name' => 'Иван Петров',
                'email' => 'ivan.petrov@example.com',
                'phone' => '+7 (999) 123-45-67',
                'rating' => 5,
                'body' => 'Отличный товар! Пользуюсь уже месяц, все работает отлично. Качество на высоте, спасибо продавцу!',
                'is_published' => true,
                'created_at' => now()->subDays(15),
            ],
            [
                'product_id' => 52,
                'name' => 'Мария Сидорова',
                'email' => 'maria.sidorova@example.com',
                'phone' => '+7 (916) 234-56-78',
                'rating' => 4,
                'body' => 'Хороший товар, но доставка была немного долгой. В остальном все отлично, рекомендую.',
                'is_published' => true,
                'created_at' => now()->subDays(10),
            ],
            [
                'product_id' => 55,
                'name' => 'Алексей Кузнецов',
                'email' => 'alexey.kuznetsov@example.com',
                'phone' => '+7 (905) 345-67-89',
                'rating' => 5,
                'body' => 'Супер! Очень качественный товар, быстрая доставка. Обязательно буду заказывать еще!',
                'is_published' => true,
                'created_at' => now()->subDays(5),
            ],
            [
                'product_id' => 58,
                'name' => 'Елена Волкова',
                'email' => 'elena.volkova@example.com',
                'phone' => '+7 (926) 456-78-90',
                'rating' => 3,
                'body' => 'В целом нормально, но ожидала большего. Качество среднее, но за эти деньги пойдет.',
                'is_published' => false,
                'created_at' => now()->subDays(3),
            ],
        ];

        foreach ($specificReviews as $review) {
            DB::table('reviews')->insert($review);
        }
    }
}
