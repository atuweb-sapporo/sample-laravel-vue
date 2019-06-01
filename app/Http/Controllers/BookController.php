<?php
namespace App\Http\Controllers;

use App\Services\BookSearchServiceInterface;
use App\Services\BookServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
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
}
