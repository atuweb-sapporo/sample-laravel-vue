<?php
namespace App\Repositories;

use App\Models\Review;
use Illuminate\Support\Collection;

/**
 * Interface ReviewRepositoryInterface
 * @package App\Repositories
 */
interface ReviewRepositoryInterface
{
    /**
     * 取得
     *
     * @param int $id
     * @return Review|null
     */
    public function fetch(int $id): ?Review;


    /**
     * 一覧取得
     *
     * @return Collection|Review[]
     */
    public function fetchAll(): Collection;


    /**
     * 新規登録
     *
     * @param array $data
     * @return int|null
     */
    public function create(array $data): ?int;


    /**
     * 更新
     *
     * @param int   $id
     * @param array $data
     * @return int|null
     */
    public function update(int $id, array $data): ?int;


    /**
     * 削除
     *
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool;


    /**
     * limit offset 指定で取得する
     *
     * @param int $limit
     * @param int $offset
     * @return Collection|Review[]
     */
    public function fetchList(int $limit, int $offset): Collection;
}
