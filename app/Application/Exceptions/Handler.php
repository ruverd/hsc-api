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
        if ($exception instanceof ValidationException) {
            return HTTPStatus::sendError(HTTPStatus::HTTP_BAD_REQUEST,'Validation errors',$exception->validator->errors()->getMessages());
        } else if($exception instanceof AuthorizationException){
            return HTTPStatus::sendError(HTTPStatus::HTTP_FORBIDDEN );
        } else if (!method_exists($exception, 'getStatusCode') || !$request->wantsJson()) {
             return HTTPStatus::sendError(HTTPStatus::HTTP_NOT_FOUND);
        } else if ($exception instanceof ModelNotFoundException && $request->wantsJson()) {
            return response()->json(['error' => 'Resource not found'], 404);
        }
        return HTTPStatus::sendError($exception->getStatusCode());
        // return HTTPStatus::sendError($exception);
    }
}
