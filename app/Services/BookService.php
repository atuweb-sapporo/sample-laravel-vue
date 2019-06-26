<?php
namespace App\Services;

/**
 * Class BookService
 * @package App\Services
 */
class BookService implements BookServiceInterface
{
    /** @var BookSearchServiceInterface */
    protected $bookSearchService;


    /**
     * ReviewService constructor.
     *
     * @param BookSearchServiceInterface $bookSearchService
     */
    public function __construct(BookSearchServiceInterface $bookSearchService)
    {
        $this->bookSearchService = $bookSearchService;
    }
}
