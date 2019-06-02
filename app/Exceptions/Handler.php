<?php
namespace App\Exceptions;

use App\Structures\Response AS ResponseStructure;
use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\HttpException;

/**
 * Class Handler
 * @package App\Exceptions
 */
class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];


    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }


    /**
     * Render an exception into an HTTP response.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Exception               $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
        if (true === $this->isHttpException($exception)) {
            return $this->handleHttpException($request, $exception);
        }
        return parent::render($request, $exception);
    }


    /**
     * Handle Http Exception
     *
     * @param \Illuminate\Http\Request $request
     * @param HttpException            $exception
     * @return \Illuminate\Http\Response
     */
    private function handleHttpException($request, HttpException $exception)
    {
        $message = '';
        switch ($exception->getStatusCode()) {
            case 401:
                $message = 'Unauthorized';
                break;
            case 403:
                $message = 'Permission Denied';
                break;
            case 404:
                $message = 'Not Found';
                break;
            case 410:
                $message = 'Gone';
                break;
            default:
                $message = 'Server Error';
                break;
        }

        if (false === $request->is('api/*') && false === $request->expectsJson()) {
            return response($message, $exception->getStatusCode());
        }
        return response()->json(
            ResponseStructure::create($exception->getStatusCode(), $message)->toArray(),
            $exception->getStatusCode()
        );
    }
}
