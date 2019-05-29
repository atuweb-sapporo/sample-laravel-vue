<?php
namespace App\Services;

use Illuminate\Support\Collection;

/**
 * Interface BookSearchServiceInterface
 * @package App\Services
 */
interface BookSearchServiceInterface
{
    /**
     * 書籍を検索する
     *
     * @param string $searchValue
     * @return Collection
     */
    public function exec(string $searchValue): Collection;
}
