<?php


namespace App\Repository\Transaction;


interface ITransactionRepository
{

    public function getListTransactionByRecruierId($id);

    public function getTransactionById($id);

    public function changeStatus($id);

    public function getTransactionNew($id);

    public function getRevenueTransactionMoth();

    public function getRevenueAccountNumber();

    public function getAllTransactions();

    public function deleteTransactionById($id);

    public function addTransaction($inputTransaction,$recruiterId,$accountId);

    public function getTransactionByPage($recordNumber);

    public function getTransactionRecruiterByPage($recruiterId,$recordNumber);

}