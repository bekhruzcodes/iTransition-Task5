<?php

namespace App\Controller;

use App\Service\BookGeneratorService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;


class BookGeneratorController extends AbstractController
{

    #[Route('/', name: 'book_generator')]
    public function index(Request $request, BookGeneratorService $bookGenerator): Response
    {
        $locale = $request->query->get('locale', 'en_US');
        $seed = $request->query->get('seed', 1);
        $averageLikes = $request->query->get('likes', 3.7);
        $averageReviews = $request->query->get('reviews', 4.7);
        $page = $request->query->get('page', 1);

        $bookGenerator->setLocale($locale);
        $bookGenerator->setSeed($seed);
        $bookGenerator->setAverageLikes($averageLikes);
        $bookGenerator->setAverageReviews($averageReviews);

        $books = $bookGenerator->generateBooks($page);

        return $this->render('book_generator/index.html.twig', [
            'books' => $books,
            'locale' => $locale,
            'seed' => $seed,
            'averageLikes' => $averageLikes,
            'averageReviews' => $averageReviews,
        ]);
    }
}