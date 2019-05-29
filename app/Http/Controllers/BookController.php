<?php
namespace App\Http\Controllers;

use App\Services\BookSearchServiceInterface;
use App\Services\BookServiceInterface;

/**
 * Class BookController
 * @package App\Http\Controllers
 */
class BookController extends Controller
{
    /** @var BookServiceInterface */
    private $bookService;

    /** @var BookSearchServiceInterface */
    private $bookSearchService;


    /**
     * BookController constructor.
     *
     * @param BookServiceInterface $bookService
     * @param BookSearchServiceInterface $bookSearchService
     */
    public function __construct(
        BookServiceInterface       $bookService,
        BookSearchServiceInterface $bookSearchService
    ) {
        $this->bookService       = $bookService;
        $this->bookSearchService = $bookSearchService;
    }
}
