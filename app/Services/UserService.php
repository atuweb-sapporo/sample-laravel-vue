<?php
namespace App\Services;

use App\Exceptions\SqlExecuteException;
use App\Models\User;
use App\Repositories\UserRepositoryInterface;
use Illuminate\Support\Facades\DB;

/**
 * Class UserService
 * @package App\Services
 */
class UserService implements UserServiceInterface
{
    /** @var UserRepositoryInterface */
    protected $userRepo;


    /**
     * UserService constructor.
     *
     * @param UserRepositoryInterface $userRepository
     */
    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepo = $userRepository;
    }


    /**
     * UID指定で取得する
     *
     * @param string $uid Firebase UID
     * @return User|null
     */
    public function fetchByUid(string $uid): ?User
    {
        return $this->userRepo->fetchByUid($uid);
    }


    /**
     * 保存して取得する
     *
     * @param string $uid Firebase UID
     * @param string $name
     * @return User
     * @throws SqlExecuteException
     */
    public function storeAndFetch(string $uid, string $name): User
    {
        $savedUser = null;

        DB::beginTransaction();
        try {
            $user   = $this->fetchByUid($uid);
            $userId = (true === is_null($user))
                ? $this->create($uid,      $name)
                : $this->update($user->id, $name);

            if (true === is_null($userId)) {
                // 更新に失敗したため例外をスロー
                throw new \Exception();
            }

            // マスタに接続したいため、トランザクション内で fetch する
            $savedUser = $this->userRepo->fetch($userId);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            throw new SqlExecuteException();
        }

        return $savedUser;
    }


    /**
     * User を作成する
     *
     * @param string $uid Firebase UID
     * @param string $name
     * @return int|null
     */
    private function create(string $uid, string $name)
    {
        return $this->userRepo->create([
            'uid' => $uid,
            'name' => $name,
            'name_origin' => $name,
        ]);
    }


    /**
     * User を更新する
     *
     * @param int    $id
     * @param string $name
     * @return int|null
     */
    private function update(int $id, $name)
    {
        return $this->userRepo->update(
            $id,
            [
                'name' => $name,
            ]
        );
    }
}
