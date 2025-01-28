<?php

namespace App\Service;

class BookGeneratorService
{
    private array $titles = [
        'en' => ['The Great Adventure', 'Hidden Secrets', 'Mystery in the Dark', 'Escape to Tomorrow'],
        'de' => ['Das Große Abenteuer', 'Verborgene Geheimnisse', 'Geheimnis im Dunkeln', 'Flucht in die Zukunft'],
        'fr' => ['La Grande Aventure', 'Secrets Cachés', 'Mystère dans le Noir', 'Évasion vers Demain'],
    ];

    private array $authors = [
        'en' => ['John Smith', 'Jane Doe', 'Robert Brown', 'Emily White'],
        'de' => ['Hans Müller', 'Maria Schmidt', 'Peter Klein', 'Anna Schwarz'],
        'fr' => ['Jean Dupont', 'Marie Curie', 'Jacques Lambert', 'Sophie Leclerc'],
    ];

    private array $publishers = [
        'en' => ['Penguin Books', 'HarperCollins', 'Simon & Schuster', 'Macmillan'],
        'de' => ['Verlagshaus Berlin', 'Suhrkamp Verlag', 'Fischer Taschenbuch', 'Piper Verlag'],
        'fr' => ['Éditions Gallimard', 'Hachette Livre', 'Flammarion', 'Éditions du Seuil'],
    ];

    public function generateBooks(string $language, string $region, int $seed, float $likes, float $reviews, int $page): array
    {
        mt_srand($seed + $page); // Combine seed and page for deterministic results
        $books = [];

        for ($i = 1; $i <= 20; $i++) {
            $isbn = $this->generateRandomISBN();
            $title = $this->getRandomElement($this->titles[$language]);
            $author = $this->getRandomElement($this->authors[$language]);
            $publisher = $this->getRandomElement($this->publishers[$language]);
            $bookLikes = $this->generateFractionalValue($likes);
            $bookReviews = $this->generateFractionalValue($reviews);

            $books[] = [
                'index' => (($page - 1) * 20) + $i,
                'isbn' => $isbn,
                'title' => $title,
                'author' => $author,
                'publisher' => $publisher,
                'likes' => $bookLikes,
                'reviews' => $bookReviews,
            ];
        }

        return $books;
    }

    private function generateRandomISBN(): string
    {
        return '978-' . mt_rand(1000000000, 9999999999);
    }

    private function getRandomElement(array $array): string
    {
        return $array[array_rand($array)];
    }

    private function generateFractionalValue(float $average): int
    {
        $base = floor($average);
        return $base + (mt_rand() / mt_getrandmax() < ($average - $base) ? 1 : 0);
    }
}
