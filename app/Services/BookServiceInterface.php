<?php
namespace App\Services;

use App\Models\Book;

/**
 * Interface BookServiceInterface
 * @package App\Services
 */
interface BookServiceInterface
{
    /**
     * 書籍情報を登録し、内部IDを取得する
     *
     * @param array $bookArray
     * @return int
     */
    public function storeAndFetchId(array $bookArray): int;


    /**
     * 書籍情報をISBNで取得する
     *
     * @param string|null $isbn10
     * @param string|null $isbn13
     * @return Book|null
     */
    public function fetchByIsbn(?string $isbn10, ?string $isbn13): ?Book;
}
