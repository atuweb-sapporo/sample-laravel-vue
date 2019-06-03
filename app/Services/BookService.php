<?php
namespace App\Services;

use App\Exceptions\SqlExecuteException;
use App\Models\Book;
use App\Repositories\BookRepositoryInterface;
use Illuminate\Support\Facades\DB;

/**
 * Class BookService
 * @package App\Services
 */
class BookService implements BookServiceInterface
{
    /** @var BookRepositoryInterface */
    protected $bookRepo;


    /**
     * ReviewService constructor.
     *
     * @param BookRepositoryInterface $bookRepository
     */
    public function __construct(BookRepositoryInterface $bookRepository)
    {
        $this->bookRepo = $bookRepository;
    }


    /**
     * 書籍情報を登録し、内部IDを取得する
     *
     * @param array $bookArray
     * @return int
     */
    public function storeAndFetchId(array $bookArray): int
    {
        DB::beginTransaction();
        try {
            $book    = $this->fetchByIsbn($bookArray['isbn_10'], $bookArray['isbn_13']);
            $savedId = (true === is_null($book))
                ? $this->bookRepo->create($bookArray)
                : $this->bookRepo->update($book->id, $bookArray);

            if (true === is_null($savedId)) {
                // 更新に失敗したため例外をスロー
                throw new \Exception();
            }
            DB::commit();

            return $savedId;
        } catch (\Exception $e) {
            DB::rollback();
            throw new SqlExecuteException();
        }
    }


    /**
     * 書籍情報をISBNで取得する
     *
     * @param string|null $isbn10
     * @param string|null $isbn13
     * @return Book|null
     */
    public function fetchByIsbn(?string $isbn10, ?string $isbn13): ?Book
    {
        return $this->bookRepo->fetchByIsbn($isbn10, $isbn13);
    }
}
