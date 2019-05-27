<?php
namespace App\Services;

use App\Exceptions\SqlExecuteException;
use App\Models\User;

/**
 * Interface UserServiceInterface
 * @package App\Services
 */
interface UserServiceInterface
{
    /**
     * UID指定で取得する
     *
     * @param string $uid Firebase UID
     * @return User|null
     */
    public function fetchByUid(string $uid): ?User;


    /**
     * 保存して取得する
     *
     * @param string $uid  Firebase UID
     * @param string $name
     * @return User
     * @throws SqlExecuteException
     */
    public function storeAndFetch(string $uid, string $name): User;
}
