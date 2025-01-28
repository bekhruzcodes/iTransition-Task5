<?php
// src/Service/BookGeneratorService.php
namespace App\Service;

use Faker\Factory;

class BookGeneratorService
{
    private string $locale = 'en_US';
    private int $seed = 1;
    private float $averageLikes = 3.7;
    private float $averageReviews = 4.7;

    public function setLocale(string $locale): self
    {
        $this->locale = $locale;
        return $this;
    }

    public function setSeed(int $seed): self
    {
        $this->seed = $seed;
        return $this;
    }

    public function setAverageLikes(float $averageLikes): self
    {
        $this->averageLikes = $averageLikes;
        return $this;
    }

    public function setAverageReviews(float $averageReviews): self
    {
        $this->averageReviews = $averageReviews;
        return $this;
    }

    public function generateBooks(int $page): array
    {
        $faker = Factory::create($this->locale);
        $faker->seed($this->seed + $page); // Seed remains compatible

        $books = [];
        for ($i = 0; $i < 10; $i++) {
            $books[] = [
                'title' => $faker->sentence(3),
                'author' => $faker->name,
                'likes' => $this->generateValueAroundAverage($faker, $this->averageLikes),
                'reviews' => $this->generateValueAroundAverage($faker, $this->averageReviews),
            ];
        }

        return $books;
    }

    private function generateValueAroundAverage($faker, float $average): float
    {
        $min = max(0, $average - 1.0);
        $max = $average + 1.0;
        return $faker->randomFloat(1, $min, $max);
    }
}