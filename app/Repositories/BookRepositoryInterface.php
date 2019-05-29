<?php
namespace App\Repositories;

use App\Models\Book;
use Illuminate\Support\Collection;

/**
 * Interface BookRepositoryInterface
 * @package App\Repositories
 */
interface BookRepositoryInterface
{
    /**
     * 取得
     * 
     * @param int $id
     * @return Book|null
     */
    public function fetch(int $id): ?Book;


    /**
     * 一覧取得
     *
     * @return Collection|Book[]
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
}
