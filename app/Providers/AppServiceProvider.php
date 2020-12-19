<?php

namespace App\Providers;

use App\Repositories\BaseRepository;
use App\Repository\AccountPackage\AccountPackageRepository;
use App\Repository\AccountPackage\IAccountPackageRepository;
use App\Repository\City\CityRepository;
use App\Repository\City\ICityRepository;
use App\Repository\CompanyImage\CompanyImageRepository;
use App\Repository\CompanyImage\ICompanyImageRepository;
use App\Repository\IBaseRepository;
use App\Repository\Job\IJobRepository;
use App\Repository\Job\JobRepository;
use App\Repository\Position\IPositionRepository;
use App\Repository\Position\PositionRepository;
use App\Repository\Recruiter\IRecruiterRepository;
use App\Repository\Recruiter\RecruiterRepository;
use App\Repository\Seeker\ISeekerRepository;
use App\Repository\Seeker\SeekerRepository;
use App\Repository\SeekerJob\ISeekerJobRepository;
use App\Repository\SeekerJob\SeekerJobRepository;
use App\Repository\Transaction\ITransactionRepository;
use App\Repository\Transaction\TransactionRepository;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
        $this->app->bind(IBaseRepository::class,BaseRepository::class);
        $this->app->bind(IJobRepository::class,JobRepository::class);
        $this->app->bind(IPositionRepository::class,PositionRepository::class);
        $this->app->bind(IRecruiterRepository::class,RecruiterRepository::class);
        $this->app->bind(ISeekerRepository::class,SeekerRepository::class);
        $this->app->bind(IAccountPackageRepository::class,AccountPackageRepository::class);
        $this->app->bind(ICityRepository::class,CityRepository::class);
        $this->app->bind(ICompanyImageRepository::class,CompanyImageRepository::class);
        $this->app->bind(ISeekerJobRepository::class,SeekerJobRepository::class);
        $this->app->bind(ITransactionRepository::class,TransactionRepository::class);

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        Schema::defaultStringLength(191);
    }
}
