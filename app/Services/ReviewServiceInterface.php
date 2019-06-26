<?php
namespace App\Services;

use App\Models\Review;
use Illuminate\Support\Collection;

/**
 * Interface ReviewServiceInterface
 * @package App\Services
 */
interface ReviewServiceInterface
{
    /**
     * 指定件数取得する
     *
     * @param int $pageNo
     * @param int $countPerPage
     * @return Collection|Review[]
     */
    public function fetchList(int $pageNo, int $countPerPage): Collection;


    /**
     * レビューを新規投稿する
     *
     * @param int    $user_id
     * @param string $isbn
     * @param string $comment
     * @param int    $star
     * @return int|null
     */
    public function postNew(int $user_id, string $isbn, string $comment, int $star): ?int;
}
