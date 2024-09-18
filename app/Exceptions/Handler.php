<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use Illuminate\Routing\Exceptions\InvalidSignatureException;

class Handler extends ExceptionHandler
{
    /**
     * A list of exception types with their corresponding custom log levels.
     *
     * @var array<class-string<\Throwable>, \Psr\Log\LogLevel::*>
     */
    protected $levels = [
        //
    ];

    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<\Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });

        $this->renderable(function (InvalidSignatureException $e) {
            if(request()->segment(1) === 'verify-email'){
                return redirect()->route('verification.notice')->with('error','Your request is not valid');
            }
        });

        $this->renderable(function (\Exception $e) {
            if ($e->getPrevious() instanceof \Illuminate\Session\TokenMismatchException) {
                return redirect()->back()->with('error','Something went wrong');
            }
        });

        $this->renderable(function (\Exception $e, $request) {
            if ($e instanceof \Symfony\Component\HttpKernel\Exception\NotFoundHttpException) {
                if(env('APP_ENV') != 'local'){
                    if (!$request->wantsJson() && !preg_match('/^www\./', $request->host())) {
                        $wwwUrl = $request->getScheme() . '://www.' . $request->getHost() . $request->getRequestUri();

                        return redirect()->to($wwwUrl, 301);
                    }
                }
            }
        });
    }
}
