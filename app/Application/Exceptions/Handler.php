<?php

namespace App\Application\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use App\Infrastructure\Http\HTTPStatus;
use Illuminate\Validation\ValidationException;
use Illuminate\Auth\Access\AuthorizationException ;

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
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return json
     */
    public function render($request, Exception $exception)
    {
        // dd($exception);
        if ($exception instanceof ValidationException) {
            dd('111');
            return HTTPStatus::sendError(HTTPStatus::HTTP_BAD_REQUEST,'Validation errors',$exception->validator->errors()->getMessages());
        } else if($exception instanceof AuthorizationException){
            dd('222');
            return HTTPStatus::sendError(HTTPStatus::HTTP_FORBIDDEN );
        } else if (!method_exists($exception, 'getStatusCode') || !$request->wantsJson()) {
            dd('333');
            return HTTPStatus::sendError(HTTPStatus::HTTP_NOT_FOUND);
        } else if ($exception instanceof ModelNotFoundException && $request->wantsJson()) {
            dd('444');
            return response()->json(['error' => 'Resource not found'], 404);
        }
        dd('555');
        //return HTTPStatus::sendError($exception->getStatusCode());
        return HTTPStatus::sendError($exception);
    }
}
