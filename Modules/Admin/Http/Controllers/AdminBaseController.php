<?php

namespace Modules\Admin\Http\Controllers;

use App\Repository\Job\IJobRepository;
use App\Repository\SeekerJob\ISeekerJobRepository;
use App\Repository\Transaction\ITransactionRepository;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\View;

class AdminBaseController extends Controller
{
    public $seekerJobRepository;
    public $transactionRepository;
    public $jobRepository;
    public function __construct(ITransactionRepository $transactionRepository, IJobRepository $jobRepository)
    {
        $this->transactionRepository = $transactionRepository;
        $this->jobRepository = $jobRepository;
    }
    public function getDataShared(){
        $messageTransaction = $this->transactionRepository->getMessageTransaction();
        View::share('messageTransaction',$messageTransaction);
        $messagePostJob = $this->jobRepository->getMessagePostJob();
        View::share('messagePostJob',$messagePostJob);
        $messageNumber =  count($messageTransaction->where('MessageStatus','=',0))+count($messagePostJob->where('MessageStatus','=',0));
        View::share('messageNumber',$messageNumber);

    }
}
