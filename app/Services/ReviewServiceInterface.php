<?php
namespace App\Services;

/**
 * Interface ReviewServiceInterface
 * @package App\Services
 */
interface ReviewServiceInterface
{
    /**
     * レビューを新規投稿する
     *
     * @param int    $user_id
     * @param int    $book_id
     * @param string $comment
     * @param int    $star
     * @return int|null
     */
    public function postNew(int $user_id, int $book_id, string $comment, int $star): ?int;
}
