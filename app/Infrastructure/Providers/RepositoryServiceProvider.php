<?php

namespace App\Infrastructure\Providers;

use Illuminate\Support\ServiceProvider;
use App\Domain\User\Repositories\UserRepository;
use App\Domain\User\Contracts\UserRepositoryInterface;
use App\Domain\Profile\Repositories\ProfileRepository;
use App\Domain\Profile\Contracts\ProfileRepositoryInterface;
use App\Domain\File\Repositories\FileRepository;
use App\Domain\File\Contracts\FileRepositoryInterface;
use App\Domain\Speciality\Repositories\SpecialityRepository;
use App\Domain\Speciality\Contracts\SpecialityRepositoryInterface;
use App\Domain\User\Repositories\UserBackgroundRepository;
use App\Domain\User\Contracts\UserBackgroundRepositoryInterface;
use App\Domain\User\Repositories\UserContactRepository;
use App\Domain\User\Contracts\UserContactRepositoryInterface;
use App\Domain\User\Repositories\UserDocumentRepository;
use App\Domain\User\Contracts\UserDocumentRepositoryInterface;
use App\Domain\User\Repositories\UserFileRepository;
use App\Domain\User\Contracts\UserFileRepositoryInterface;
use App\Domain\User\Repositories\UserOfficeRepository;
use App\Domain\User\Contracts\UserOfficeRepositoryInterface;
use App\Domain\User\Repositories\UserPaymentRepository;
use App\Domain\User\Contracts\UserPaymentRepositoryInterface;
use App\Domain\User\Repositories\UserSpecialityRepository;
use App\Domain\User\Contracts\UserSpecialityRepositoryInterface;
use App\Domain\User\Repositories\UserStatusRepository;
use App\Domain\User\Contracts\UserStatusRepositoryInterface;
use App\Domain\User\Repositories\UserVehicleRepository;
use App\Domain\User\Contracts\UserVehicleRepositoryInterface;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(UserRepositoryInterface::class, UserRepository::class);
        $this->app->singleton(FileRepositoryInterface::class, FileRepository::class);
        $this->app->singleton(ProfileRepositoryInterface::class, ProfileRepository::class);
        $this->app->singleton(SpecialityRepositoryInterface::class, SpecialityRepository::class);
        $this->app->singleton(UserBackgroundRepositoryInterface::class, UserBackgroundRepository::class);
        $this->app->singleton(UserContactRepositoryInterface::class, UserContactRepository::class);
        $this->app->singleton(UserDocumentRepositoryInterface::class, UserDocumentRepository::class);
        $this->app->singleton(UserFileRepositoryInterface::class, UserFileRepository::class);
        $this->app->singleton(UserOfficeRepositoryInterface::class, UserOfficeRepository::class);
        $this->app->singleton(UserPaymentRepositoryInterface::class, UserPaymentRepository::class);
        $this->app->singleton(UserSpecialityRepositoryInterface::class, UserSpecialityRepository::class);
        $this->app->singleton(UserStatusRepositoryInterface::class, UserStatusRepository::class);
        $this->app->singleton(UserVehicleRepositoryInterface::class, UserVehicleRepository::class);
    }
}
