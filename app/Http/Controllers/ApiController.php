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
     * @return array
     */
    protected function errorValidate()
    {
        return $this->response(500, 'Validate error');
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
