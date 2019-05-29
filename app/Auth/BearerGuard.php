<?php
namespace App\Auth;

use App\Models\User;
use Illuminate\Auth\GuardHelpers;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;

class BearerGuard implements Guard
{
    use GuardHelpers;

    /** @var object User Model */
    private $model;

    /** @var Request */
    protected $request;


    /**
     * BearerGuard constructor.
     *
     * @param Request $request
     * @param User    $userModel
     */
    public function __construct(Request $request, User $userModel)
    {
        $this->request = $request;
        $this->model   = $userModel;
        $this->user    = null;
    }


    /**
     * Get the currently authenticated user.
     *
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     */
    public function user()
    {
        if (false === is_null($this->user)) {
            return $this->user;
        }

        $idTokenString = $this->request->bearerToken();
        if (true === is_null($idTokenString)) {
            return null;
        }

        $user = $this->retrieve($idTokenString);
        if (true === is_null($user)) {
            return null;
        }
        $this->user = $user;

        return $this->user;
   }


    /**
     * トークンに紐づくユーザ情報を復元する
     *
     * @param string $token
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     */
    private function retrieve(string $token)
    {
        $verifiedToken = null;
        try {
            $verifiedToken = (app('firebase'))->getAuth()->verifyIdToken($token);
        } catch (\Exception $e) {
            return null;
        }

        return $this->model
            ->where('uid', $verifiedToken->getClaim('sub'))
            ->first();
    }


    /**
     * Validate a user's credentials.
     *
     * @param array $credentials
     * @return bool
     */
    public function validate(array $credentials = [])
    {
        throw new \Exception('Not implemented');
    }
}
