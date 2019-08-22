<?php

namespace App\Interfaces\Http\Controllers\Register;

use Illuminate\Http\Request;
use App\Infrastructure\Http\Controllers\BaseController;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Domain\User\Resources\UserPaymentResource;
use App\Domain\User\Request\UserPaymentRequest;
use App\Domain\User\Contracts\UserPaymentRepositoryInterface;

class PaymentController extends BaseController
{
    use AuthenticatesUsers;

    protected $repository = null;

    public function __construct(UserPaymentRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $payment = $this->repository->findByField('user_id',$id);
        return $this->HTTPStatus::sendResponse(
            UserPaymentResource::make($payment),
            $this->HTTPStatus::HTTP_OK
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Illuminate\Http\Request;  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $payment = $this->repository->create($request->all());

        if(!$payment){
            return $this->HTTPStatus::sendError($this->HTTPStatus::HTTP_NO_CONTENT);
        }
        return $this->HTTPStatus::sendResponse(
            UserPaymentResource::make($payment),
            $this->HTTPStatus::HTTP_CREATED
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Illuminate\Http\Request;  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $payment = $this->repository->find($id);

        if($payment->update($request->all())){
            return $this->HTTPStatus::sendResponse(
                UserPaymentResource::make($payment),
                $this->HTTPStatus::HTTP_ACCEPTED
            );
        }
    }
}
