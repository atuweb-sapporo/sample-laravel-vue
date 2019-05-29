<?php
namespace App\Repositories;

use App\Models\Book;
use Illuminate\Support\Collection;

/**
 * Class BookRepository
 * @package App\Repositories
 */
class BookRepository implements BookRepositoryInterface
{
    /** @var Book  */
    protected $orm;


    /**
     * BookRepository constructor.
     *
     * @param Book $orm
     */
    public function __construct(Book $orm)
    {
        $this->orm = $orm;
    }


    /**
     * 取得
     *
     * @param int $id
     * @return Book|null
     */
    public function fetch(int $id): ?Book
    {
        return $this->orm->find($id);
    }


    /**
     * 一覧取得
     *
     * @return Collection|Book[]
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
}
