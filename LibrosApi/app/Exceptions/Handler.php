<?php

namespace App\Exceptions;

use App\Traits\ApiResponder;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;
use Laravel\Lumen\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Throwable;

class Handler extends ExceptionHandler
{

    use ApiResponder;

    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        AuthorizationException::class,
        HttpException::class,
        ModelNotFoundException::class,
        ValidationException::class,
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param Throwable $exception
     * @return void
     *
     * @throws Exception
     */
    public function report(Throwable $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param Request $request
     * @param Throwable $e
     * @return Response|JsonResponse
     *
     * @throws Throwable
     */
    public function render($request, Throwable $e)
    {
        if ($e instanceof HttpException) {
            $code = $e->getStatusCode();
            $mensaje = Response::$statusTexts[$code];

            return $this->errorResponde($mensaje, $code);
        }
        if ($e instanceof ModelNotFoundException) {
            $model = strtolower(class_basename($e->getModel()));
            $code = Response::HTTP_NOT_FOUND;
            $mensaje = 'No existe el Identificador requerido: ' . $model;

            return $this->errorResponde($mensaje, $code);
        }

        if ($e instanceof AuthorizationException) {

            $code = $e->getCode();
            $mensaje = $e->getMessage();

            return $this->errorResponde($mensaje, $code);
        }
        if ($e instanceof AuthenticationException) {

            $code = $e->getCode();
            $mensaje = $e->getMessage();

            return $this->errorResponde($mensaje, $code);
        }


        if ($e instanceof ValidationException) {

            $mensaje = $e->validator->errors()->getMessages();

            $code = Response::HTTP_UNPROCESSABLE_ENTITY;

            return $this->errorResponde($mensaje, $code);
        }
        if (env('APP_DEBUG', false)) {
            return parent::render($request, $e);
        }

        return $this->errorResponde('Error inesperado. Intente nuevamente pasados unos instantes.', Response::HTTP_INTERNAL_SERVER_ERROR);

    }

    public function validationErrorsToString($errArray): string
    {
        $valArr = array();
        foreach ($errArray as $key => $value) {
            $errStr = $key . ': ' . $value[0];
            $valArr[] = $errStr;
        }
        if (!empty($valArr)) {
            $errStrFinal = implode(',', $valArr);
        }
        return $errStrFinal;
    }
}
