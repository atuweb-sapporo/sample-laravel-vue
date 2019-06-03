<?php
namespace App\Services;

use App\Models\Review;
use App\Repositories\ReviewRepositoryInterface;
use App\Exceptions\SqlExecuteException;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

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


    /**
     * 指定件数取得する
     *
     * @param int $pageNo
     * @param int $countPerPage
     * @return Collection|Review[]
     */
    public function fetchList(int $pageNo, int $countPerPage): Collection
    {
        $offset = ($pageNo - 1) * $countPerPage;
        return $this->reviewRepo->fetchList($countPerPage, $offset);
    }


    /**
     * レビューを投稿する
     *
     * @param int    $user_id
     * @param int    $book_id
     * @param string $comment
     * @param int    $star
     * @return int|null
     */
    public function postNew(int $user_id, int $book_id, string $comment, int $star): ?int
    {
        DB::beginTransaction();
        try {
            $reviewId = $this->reviewRepo->create([
                'user_id' => $user_id,
                'book_id' => $book_id,
                'comment' => $comment,
                'star'    => $star,
            ]);
            if (true === is_null($reviewId)) {
                // 更新に失敗したため例外をスロー
                throw new \Exception();
            }
            DB::commit();

            return $reviewId;
        } catch (\Exception $e) {
            DB::rollback();
            throw new SqlExecuteException();
        }
    }
}
