<?php

namespace App\Controller;

use App\Service\BookGeneratorService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BookController extends AbstractController
{
    #[Route("/", name: "book_index")]
    public function index(Request $request, BookGeneratorService $bookGenerator): Response
    {
        // Default parameters
        $language = $request->query->get('language', 'en');
        $region = $request->query->get('region', 'US');
        $seed = $request->query->get('seed', random_int(1, 1000000));
        $likes = (float) $request->query->get('likes', 3.5);
        $reviews = (float) $request->query->get('reviews', 4.5);
        $page = (int) $request->query->get('page', 1);

        // Generate books based on parameters
        $books = $bookGenerator->generateBooks($language, $region, $seed, $likes, $reviews, $page);

        return $this->render('book/index.html.twig', [
            'books' => $books,
            'language' => $language,
            'region' => $region,
            'seed' => $seed,
            'likes' => $likes,
            'reviews' => $reviews,
        ]);
    }
}
