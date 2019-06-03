<?php
namespace App\Http\Controllers;

use App\Structures\Response AS ResponseStructure;

/**
 * Class ApiController
 * @package App\Http\Controllers
 */
class ApiController extends Controller
{
    /**
     * ステータス 200 をレスポンスする
     *
     * @param array  $contents
     * @return array
     */
    protected function success(array $contents)
    {
        return $this->response(200, '', $contents);
    }


    /**
     * エラーをレスポンスする
     *
     * @param int    $statusCode
     * @param string $message
     * @return array
     */
    protected function error(int $statusCode, string $message)
    {
        return $this->response($statusCode, $message);
    }


    /**
     * バリデートエラーをレスポンスする
     *
     * @param strig $message
     * @return array
     */
    protected function errorValidate($message = null)
    {
        if (true === is_null($message)) {
            $message = 'Validate error';
        }
        return $this->response(500, $message);
    }


    /**
     * レスポンスフォーマット
     *
     * @param int    $statusCode
     * @param string $message
     * @param array  $contents
     * @return array
     */
    protected function response(int $statusCode, string $message = '', array $contents = [])
    {
        return ResponseStructure::create($statusCode, $message, $contents)->toArray();
    }
}
