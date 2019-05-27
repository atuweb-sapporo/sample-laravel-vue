<?php
namespace App\Repositories;

use App\Models\User;

/**
 * Class UserRepository
 * @package App\Repositories
 */
class UserRepository implements UserRepositoryInterface
{
    /** @var User */
    protected $orm;


    /**
     * UserRepository constructor.
     *
     * @param User $orm
     */
    public function __construct(User $orm)
    {
        $this->orm = $orm;
    }


    /**
     * 取得
     *
     * @param int $id
     * @return User|null
     */
    public function fetch(int $id): ?User
    {
        return $this->orm->find($id);
    }


    /**
     * 新規登録
     *
     * @param array $data
     * @return int|null
     */
    public function create(array $data): ?int
    {
        $model = $this->orm->create($data);
        if (isset($model->id)) {
            return $model->id;
        }
        return null;
    }


    /**
     * 更新
     *
     * @param int   $id
     * @param array $data
     * @return int|null
     */
    public function update(int $id, array $data): ?int
    {
        if ($this->orm->find($id)->update($data)) {
            return $id;
        }
        return null;
    }


    /**
     * UIDで取得する
     *
     * @param string $uid
     * @return User|null
     */
    public function fetchByUid(string $uid): ?User
    {
        return $this->orm->where('uid', $uid)->first();
    }
}
