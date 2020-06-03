<?php

namespace App\Interfaces\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Infrastructure\Http\Controllers\BaseController;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Domain\User\Resources\UserResource;
use App\Domain\User\Request\UserRequest;
use App\Domain\User\Contracts\UserRepositoryInterface;
use App\Domain\User\Contracts\UserDocumentRepositoryInterface;
use App\Domain\User\Contracts\UserContactRepositoryInterface;
use App\Domain\User\Contracts\UserSpecialityRepositoryInterface;
use App\Domain\User\Contracts\UserVehicleRepositoryInterface;
use App\Domain\User\Contracts\UserPaymentRepositoryInterface;
use App\Domain\User\Contracts\UserFileRepositoryInterface;
use App\Domain\Speciality\Contracts\SpecialityRepositoryInterface;

class InfoController extends BaseController
{
  use AuthenticatesUsers;

  protected
    $repositorySpeciality,
    $repositoryUser,
    $repositoryUserDocument,
    $repositoryUserContact,
    $repositoryUserSpeciality,
    $repositoryUserVehicle,
    $repositoryUserPayment,
    $repositoryUserFile = null;

  public function __construct(
    SpecialityRepositoryInterface $repositorySpeciality,
    UserRepositoryInterface $repositoryUser,
    UserDocumentRepositoryInterface $repositoryUserDocument,
    UserContactRepositoryInterface $repositoryUserContact,
    UserSpecialityRepositoryInterface $repositoryUserSpeciality,
    UserVehicleRepositoryInterface $repositoryUserVehicle,
    UserPaymentRepositoryInterface $repositoryUserPayment,
    UserFileRepositoryInterface $repositoryUserFile
  )
  {
    $this->repositorySpeciality = $repositorySpeciality;
    $this->repositoryUser = $repositoryUser;
    $this->repositoryUserDocument = $repositoryUserDocument;
    $this->repositoryUserContact = $repositoryUserContact;
    $this->repositoryUserSpeciality = $repositoryUserSpeciality;
    $this->repositoryUserVehicle = $repositoryUserVehicle;
    $this->repositoryUserPayment = $repositoryUserPayment;
    $this->repositoryUserFile = $repositoryUserFile;
  }

  /**
   * Return total of users
   *
   * @return Array
   */
  public function report()
  {
    return response()->json(
      $this->guard()->user()->profile_id == 1 ? $this->reportUser() : $this->reportAdmin(),
      $this->HTTPStatus::HTTP_OK
    );
  }

  /**
   * Return total of users
   *
   * @return Array
   */
  public function reportUser()
  {
    $document = $this->repositoryUserDocument->findByField('user_id',$this->guard()->user()->id);
    $contact = $this->repositoryUserContact->findByField('user_id',$this->guard()->user()->id);
    $speciality = $this->repositoryUserSpeciality->findByField('user_id',$this->guard()->user()->id);
    $vehicle = $this->repositoryUserVehicle->findByField('user_id',$this->guard()->user()->id);
    $payment = $this->repositoryUserPayment->findByField('user_id',$this->guard()->user()->id);
    $file = $this->repositoryUserFile->findByField('user_id',$this->guard()->user()->id);

    $total = 1;

    return [
        'data' => [
            'percentage' => 78,
            'status' => 'Arquivos enviados',
            'avgTime' => 5,
            'steps' => [
                '1' => [
                'key' => 1,
                'title' => 'Registro',
                'concluded' => date("d/m/Y", strtotime($this->guard()->user()->created_at))
                ],
                '2' => [
                'key' => 2,
                'title' => 'Dados Pessoais',
                'concluded' => isset($document[0]) ? date("d/m/Y", \strtotime($document[0]->created_at)) : false
                ],
                '3' => [
                'key' => 3,
                'title' => 'Informação de Contato',
                'concluded' => isset($contact[0]) ? date("d/m/Y", \strtotime($contact[0]->created_at)) : false
                ],
                '4' => [
                'key' => 4,
                'title' => 'Cadastro de Especialidades',
                'concluded' => isset($speciality[0]) ? date("d/m/Y", \strtotime($speciality[0]->created_at)) : false
                ],
                '5' => [
                'key' => 5,
                'title' => 'Cadastro de Veículo',
                'concluded' => isset($vehicle[0]) ? date("d/m/Y", \strtotime($vehicle[0]->created_at)) : false
                ],
                '6' => [
                'key' => 6,
                'title' => 'Dados de Pagamento',
                'concluded' => isset($payment[0]) ? date("d/m/Y", \strtotime($payment[0]->created_at)) : false
                ],
                '7' => [
                'key' => 7,
                'title' => 'Upload de arquivos',
                'concluded' => isset($file[0]) ? date("d/m/Y", \strtotime($file[0]->created_at)) : false
                ],
                '8' => [
                'key' => 8,
                'title' => 'Validação dos Dados',
                'concluded' => isset($this->guard()->user()->validate) ? date("d/m/Y", strtotime($this->guard()->user()->created_at)) : false
                ],
                '9' => [
                'key' => 9,
                'title' => 'Aprovação de Dados',
                'concluded' => isset($this->guard()->user()->approve) ? date("d/m/Y", strtotime($this->guard()->user()->created_at)) : false
                ]
            ]
        ]
    ];
  }

  /**
   * Return total of users
   *
   * @return Array
   */
  public function reportAdmin()
  {

    return [
        'data' => [
            'totalUser' => count($this->repositoryUser->all()),
            'awaitingApproval' => count($this->repositoryUser->findByField('user_status_id', 2)),
            'avgTime' => $this->repositoryUser->avgApproveDays(),
            'notCompleted' => count($this->repositoryUser->findByField('user_status_id', 1)),
            'totalSpeciality' => count($this->repositorySpeciality->all())
        ]
    ];
  }
}
