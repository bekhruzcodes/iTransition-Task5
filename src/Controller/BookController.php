<?php

namespace App\Controller;

use App\Service\BookGeneratorService;
use PhpParser\Node\Scalar\String_;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Symfony\Component\Routing\Annotation\Route;

class BookController extends AbstractController
{
    private BookGeneratorService $bookGenerator;

    public function __construct()
    {
        $this->bookGenerator = new BookGeneratorService('en_US');
    }

    private function getRequestParameters(Request $request): array
    {
        return [
            'language' => $request->query->get('language', 'en_US'),
            'seed' => $request->query->get('seed', random_int(1, 1000000)),
            'likes' => (float) $request->query->get('likes', 3.5),
            'reviews' => (float) $request->query->get('reviews', 4.5),
            'page' => (int) $request->query->get('page', 1),
        ];
    }

    private function getBookGenerator(string $language): BookGeneratorService
    {
        if ($this->bookGenerator->getLanguage() !== $language) {
            $this->bookGenerator = new BookGeneratorService($language);
        }
        return $this->bookGenerator;
    }

    private function generateBooksData(Request $request): array
    {
        $params = $this->getRequestParameters($request);
        $bookGenerator = $this->getBookGenerator($params['language']);

        $books = $bookGenerator->generateBooks(
            $params['seed'],
            $params['likes'],
            $params['reviews'],
            $params['page']
        );

        return [
            'books' => $books,
            'language' => $params['language'],
            'seed' => $params['seed'],
            'likes' => $params['likes'],
            'reviews' => $params['reviews'],
        ];
    }

    #[Route("/", name: "book_index")]
    public function index(Request $request): Response
    {
        $data = $this->generateBooksData($request);
        return $this->render('book/index.html.twig', $data);
    }

    #[Route("/books/json", name: "book_json", methods: ["GET"])]
    public function booksJson(Request $request): JsonResponse
    {
        return $this->json($this->generateBooksData($request));
    }

    #[Route("/books/export", name: "book_export", methods: ["GET"])]
    public function exportBooksAsCsv(Request $request): StreamedResponse
    {
        $booksData = $this->generateBooksData($request);
        $books = $booksData['books'];

        $response = new StreamedResponse(function () use ($books) {
            if (ob_get_level() > 0) {
                ob_end_clean();
            }

            $handle = fopen('php://output', 'w+');

            header('Content-Type: text/csv');
            header('Content-Disposition: attachment; filename="books.csv"');

            fputcsv($handle, [
                'Index',
                'ISBN',
                'Title',
                'Author',
                'Publisher',
                'Likes',
                'Reviews',
                'Review',
                'Rating'
            ]);

            foreach ($books as $book) {
                fputcsv($handle, [
                    $book['index'] ?? '',
                    $book['isbn'] ?? '',
                    $book['title'] ?? '',
                    $book['author'] ?? '',
                    $book['publisher'] ?? '',
                    $book['likes'] ?? '',
                    $book['reviews'] ?? '',
                    $book['review'] ?? '',
                    $book['rating'] ?? '',
                ]);
            }

            fclose($handle);
            flush();
        });

        $response->headers->set('Content-Type', 'text/csv');
        $response->headers->set('Content-Disposition', 'attachment; filename="books.csv"');

        return $response;
    }


    #[Route("/book-details", name: "book_details", methods: ["GET"])]
    public function bookDetails(Request $request): JsonResponse
    {
        $language = $request->query->get('language', 'en_US');
        $isbn = $request->query->get('isbn');

        if (!$isbn) {
            return new JsonResponse([
                'error' => 'ISBN is required'
            ], JsonResponse::HTTP_BAD_REQUEST);
        }

        $bookGenerator = $this->getBookGenerator($language);
        $reviews = $bookGenerator->generateReviews($isbn, 6);
        $coverImage = 'https://picsum.photos/seed/' . $isbn . '/200/250';

        return new JsonResponse([
            'coverImage' => $coverImage,
            'reviews' => $reviews,
        ]);
    }
}