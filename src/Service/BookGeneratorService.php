<?php

namespace App\Service;

use Faker\Factory as FakerFactory;
use Faker\Generator as FakerGenerator;

class BookGeneratorService
{
    private FakerGenerator $faker;
    private BookTitleProvider $titleProvider;
    private ReviewProvider $reviewProvider;
    private string $language;

    public function __construct(string $language = 'en_US')
    {
        $this->language = $language;
        $this->faker = FakerFactory::create($language);
        $this->titleProvider = new BookTitleProvider($this->faker);
        $this->reviewProvider = new ReviewProvider($this->faker);
        $this->faker->addProvider($this->titleProvider);
        $this->faker->addProvider($this->reviewProvider);
    }

    public function generateBooks(int $seed, float $likes, float $reviews, int $page): array
    {
        mt_srand($seed + $page);
        $books = [];

        for ($i = 1; $i <= 20; $i++) {

            $isbn = $this->generateRandomISBN();
            $titleInfo = $this->titleProvider->bookTitleWithGenre($this->language);
            $bookLikes = $this->generateFractionalValue($likes);
            $bookReviews = $this->generateFractionalValue($reviews);
            $reviewInfo = $this->reviewProvider->bookReviewWithRating($this->language);

            $books[] = [
                'index' => (($page - 1) * 20) + $i,
                'isbn' => $isbn,
                'title' => $titleInfo['title'],
                'author' => $this->faker->name,
                'publisher' => $this->faker->company,
                'likes' => $bookLikes,
                'reviews' => $bookReviews,
                'review' => $reviewInfo['review'],
                'rating' => min(5, max(1, round($bookLikes / 10))),

            ];
        }

        return $books;
    }

    public function generateReviews(string $isbn, int $count): array
    {
        mt_srand(crc32($isbn));
        $reviews = [];

        for ($i = 0; $i < $count; $i++) {
            $reviewInfo = $this->reviewProvider->bookReviewWithRating($this->language);
            $reviewDate = $this->faker->dateTimeBetween('-1 year', 'now');

            $reviews[] = [
                'reviewer' => $this->generateReviewerName($isbn, $i),
                'review' => $reviewInfo['review'],
                'rating' => $reviewInfo['rating'],
                'verified_purchase' => $reviewInfo['verified_purchase'],
                'helpful_votes' => $this->faker->numberBetween(0, 100),
                'date' => $reviewDate->format('Y-m-d'),
                'country' => $this->getCountryForLocale($this->language)
            ];
        }

        return $reviews;
    }

    private function generateReviewerName(string $isbn, int $index): string
    {
        mt_srand(crc32($isbn . $index));
        return $this->faker->name;
    }

    private function generateRandomISBN(): string
    {
        return sprintf('978-%d-%d-%d-%d',
            $this->faker->numberBetween(0, 9),
            $this->faker->numberBetween(100, 999),
            $this->faker->numberBetween(10000, 99999),
            $this->faker->numberBetween(0, 9)
        );
    }

    private function generateFractionalValue(float $average): int
    {
        $base = floor($average);
        return $base + (mt_rand() / mt_getrandmax() < ($average - $base) ? 1 : 0);
    }

    private function getCurrencyForLocale(string $locale): string
    {
        $currencyMap = [
            'en_US' => 'USD',
            'fr_FR' => 'EUR',
            'de_DE' => 'EUR',
            'es_ES' => 'EUR',
            'default' => 'USD'
        ];

        return $currencyMap[$locale] ?? $currencyMap['default'];
    }

    private function getCountryForLocale(string $locale): string
    {
        $countryMap = [
            'en_US' => 'United States',
            'fr_FR' => 'France',
            'de_DE' => 'Germany',
            'es_ES' => 'Spain',
            'default' => 'United States'
        ];

        return $countryMap[$locale] ?? $countryMap['default'];
    }

    public function getLanguage(): string
    {
        return $this->language;
    }
}