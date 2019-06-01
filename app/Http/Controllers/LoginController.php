<?php
namespace App\Http\Controllers;

use App\Services\UserServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Kreait\Firebase\Auth\UserRecord AS FirebaseUser;

/**
 * Class LoginController
 * @package App\Http\Controllers
 */
class LoginController extends ApiController
{
    /** @var UserServiceInterface */
    private $userService;


    /**
     * LoginController constructor.
     *
     * @param UserServiceInterface $userService
     */
    public function __construct(UserServiceInterface $userService)
    {
        $this->userService = $userService;
    }


    /**
     * Firebase UID を問い合わせ、紐づく内部ユーザ情報を返却する
     *
     * @param Request $request
     * @return array
     */
    public function verify(Request $request)
    {
        $idTokenString = $request->input('token', '');

        $firebaseUser  = null;
        try {
            $firebaseAuth  = (app('firebase'))->getAuth();
            $verifiedToken = $firebaseAuth->verifyIdToken($idTokenString);

            /** @var FirebaseUser $firebaseUser */
            $firebaseUser  = $firebaseAuth->getUser($verifiedToken->getClaim('sub'));
        } catch (\Exception $e) {
            // UIDに紐づくユーザを取得できなかったため、ステータス 401 をレスポンスする
            abort(401);
        }

        $user = $this->userService->storeAndFetch($firebaseUser->uid, $firebaseUser->displayName);

        return [
            'uid'  => $firebaseUser->uid,
            'user' => [
                'id'   => $user->id,
                'name' => $user->name,
            ],
        ];
    }


    /**
     * 認証済み内部ユーザ情報を返却する
     *
     * @return array
     */
    public function showUser()
    {
        $user = Auth::guard('spa')->user();
        if (true === is_null($user)) {
            // 認証できなかったため、ステータス 401 をレスポンスする
            abort(401);
        }

        return [
            'user' => [
                'id'   => $user->id,
                'name' => $user->name,
            ],
        ];
    }
}
