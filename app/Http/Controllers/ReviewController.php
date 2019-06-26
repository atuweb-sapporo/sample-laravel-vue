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
        // TODO ユーザ情報、書籍情報の結合
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
            'isbn'     => 'required|string|min:10|max:13',
            'comment'  => 'required|string|min:1|max:1000',
            'star'     => 'required|integer|between:1,5',
        ]);
        if ($validator->fails()) {
            return $this->errorValidate();
        }

        $isbn     = $request->input('isbn');
        $comment  = $request->input('comment');
        $star     = $request->input('star');
        $reviewId = $this->reviewService->postNew($user->id, $isbn, $comment, $star);

        return $this->success([
            'review' => [
                'id' => $reviewId,
            ],
        ]);
    }
}
