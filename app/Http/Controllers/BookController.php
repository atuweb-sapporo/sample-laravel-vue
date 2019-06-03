<?php
namespace App\Http\Controllers;

use App\Services\BookSearchServiceInterface;
use App\Services\BookServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

/**
 * Class BookController
 * @package App\Http\Controllers
 */
class BookController extends ApiController
{
    /** @var BookServiceInterface */
    private $bookService;

    /** @var BookSearchServiceInterface */
    private $bookSearchService;


    /**
     * BookController constructor.
     *
     * @param BookServiceInterface $bookService
     * @param BookSearchServiceInterface $bookSearchService
     */
    public function __construct(
        BookServiceInterface       $bookService,
        BookSearchServiceInterface $bookSearchService
    ) {
        $this->bookService       = $bookService;
        $this->bookSearchService = $bookSearchService;
    }


    /**
     * リクエストに従って書籍を検索する
     *
     * @param Request $request
     * @return array
     */
    public function search(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'value' => 'required',
        ]);
        if ($validator->fails()) {
            return [
                'books' => [],
            ];
        }

        $searchValue = $request->input('value', '');
        return [
            'books' => $this->bookSearchService->exec($searchValue),
        ];
    }


    /**
     * 選択された書籍情報を登録する
     *
     * @param Request $request
     * @return array
     */
    public function store(Request $request)
    {
        $book      = $request->input('book', []);
        $validator = Validator::make($book, [
            'title'      => 'required|string',
            'subtitle'   => 'string|nullable',
            'author'     => 'string|nullable',
            'publisher'  => 'string|nullable',
            'release'    => 'string|max:10|nullable',
            'summary'    => 'string|max:500|nullable',
            'isbn_10'    => 'required_without:isbn_13|string|size:10|nullable',
            'isbn_13'    => 'required_without:isbn_10|string|size:13|nullable',
            'image_link' => 'string|max:200|nullable',
            'language'   => 'string|max:5|nullable',
        ]);
        if ($validator->fails()) {
            return $this->errorValidate();
        }

        $bookId = $this->bookService->storeAndFetchId($book);

        return $this->success([
            'book' => [
                'id' => $bookId,
            ],
        ]);
    }
}
