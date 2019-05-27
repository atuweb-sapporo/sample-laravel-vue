<?php
namespace App\Repositories;

use App\Models\User;

/**
 * Interface UserRepositoryInterface
 * @package App\Repositories
 */
interface UserRepositoryInterface
{
    /**
     * 取得
     * 
     * @param int $id
     * @return User|null
     */
    public function fetch(int $id): ?User;


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
     * UIDで取得する
     *
     * @param string $uid
     * @return User|null
     */
    public function fetchByUid(string $uid): ?User;
}
