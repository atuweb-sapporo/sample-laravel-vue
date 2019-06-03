<?php
namespace App\Http\Controllers;

use App\Services\BookServiceInterface;
use App\Services\ReviewServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

/**
 * Class ReviewController
 * @package App\Http\Controllers
 */
class ReviewController extends ApiController
{
    /** @var int */
    private const COUNT_PER_PAGE = 5;

    /** @var BookServiceInterface */
    private $bookService;

    /** @var ReviewServiceInterface */
    private $reviewService;


    /**
     * ReviewController constructor.
     *
     * @param BookServiceInterface   $bookService
     * @param ReviewServiceInterface $reviewService
     */
    public function __construct(
        BookServiceInterface   $bookService,
        ReviewServiceInterface $reviewService
    ) {
        $this->bookService   = $bookService;
        $this->reviewService = $reviewService;
    }


    /**
     * 件数指定で一覧を取得する
     *
     * @param Request $request
     * @param string $page
     * @return array
     */
    public function fetchPage(Request $request, string $page)
    {
        return $this->success([
            'items' => $this->reviewService->fetchList((int)$page, static::COUNT_PER_PAGE),
        ]);
    }


    /**
     * レビューを投稿する
     *
     * @param Request $request
     * @return array
     */
    public function postNew(Request $request)
    {
        $user = Auth::guard('spa')->user();
        if (true === is_null($user)) {
            // 認証できなかったため、ステータス 401 をレスポンスする
            abort(401);
        }

        $validator = Validator::make($request->all(), [
            'book.isbn_10' => 'string|size:10|nullable',
            'book.isbn_13' => 'integer|size:10|nullable',
            'comment'      => 'required|string|min:1|max:1000',
            'star'         => 'required|integer|between:1,5',
        ]);
        if ($validator->fails()) {
            return $this->errorValidate();
        }

        $isbn10 = $request->input('book.isbn_10', null);
        $isbn13 = $request->input('book.isbn_13', null);
        $book   = $this->bookService->fetchByIsbn($isbn10, $isbn13);
        if (true === is_null($book)) {
            return $this->errorValidate('not found by ISBN'. $isbn10 . $isbn13);
        }

        $comment  = $request->input('comment');
        $star     = $request->input('star');
        $reviewId = $this->reviewService->postNew($user->id, $book->id, $comment, $star);

        return $this->success([
            'review' => [
                'id' => $reviewId,
            ],
        ]);
    }
}
