<?php
namespace App\Services;

use App\Repositories\BookRepositoryInterface;

/**
 * Class BookService
 * @package App\Services
 */
class BookService implements BookServiceInterface
{
    /** @var BookRepositoryInterface */
    protected $bookRepo;


    /**
     * ReviewService constructor.
     *
     * @param BookRepositoryInterface $bookRepository
     */
    public function __construct(BookRepositoryInterface $bookRepository)
    {
        $this->bookRepo = $bookRepository;
    }
}
