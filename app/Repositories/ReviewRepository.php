<?php
namespace App\Repositories;

use App\Models\Review;
use Illuminate\Support\Collection;

/**
 * Class ReviewRepository
 * @package App\Repositories
 */
class ReviewRepository implements ReviewRepositoryInterface
{
    /** @var Review  */
    protected $orm;


    /**
     * ReviewRepository constructor.
     *
     * @param Review $orm
     */
    public function __construct(Review $orm)
    {
        $this->orm = $orm;
    }


    /**
     * 取得
     *
     * @param int $id
     * @return Review|null
     */
    public function fetch(int $id): ?Review
    {
        return $this->orm->find($id);
    }


    /**
     * 一覧取得
     *
     * @return Collection|Review[]
     */
    public function fetchAll(): Collection
    {
        return $this->orm
            ->orderBy('id', 'asc')
            ->get();
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
     * 削除
     *
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool
    {
        return (1 === $this->orm->destroy($id));
    }


    /**
     * limit offset 指定で取得する
     *
     * @param int $limit
     * @param int $offset
     * @return Collection|Review[]
     */
    public function fetchList(int $limit, int $offset): Collection
    {
        return $this->orm
            ->orderBy('id', 'desc')
            ->take($limit)
            ->skip($offset)
            ->get();
    }
}
