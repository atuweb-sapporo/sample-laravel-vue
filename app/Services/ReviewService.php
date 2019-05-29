<?php
namespace App\Services;

use App\Repositories\ReviewRepositoryInterface;

/**
 * Class ReviewService
 * @package App\Services
 */
class ReviewService implements ReviewServiceInterface
{
    /** @var ReviewRepositoryInterface */
    protected $reviewRepo;


    /**
     * ReviewService constructor.
     *
     * @param ReviewRepositoryInterface $reviewRepository
     */
    public function __construct(ReviewRepositoryInterface $reviewRepository)
    {
        $this->reviewRepo = $reviewRepository;
    }
}
