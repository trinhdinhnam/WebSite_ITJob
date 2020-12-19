<?php


namespace App\Repository\Transaction;


interface ITransactionRepository
{

    public function getListTransactionByRecruierId($id);

    public function getTransactionById($id);

    public function changeStatus($id);

}