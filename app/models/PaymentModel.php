<?php

//payment model class
class PaymentModel extends Model
{
    protected $table = "payment";
    protected $primaryKey = 'paymentID';

    public $errors = [];

    //fields that can be updated
    protected $allowedColumns = [
        'paymentID',//should be unique string
        'paymentDescription',
        'paymentStatus',
        'taskID',
        'amount',
        'commission',
        'createdAt',
        'paidDate',
    ];

    public function calculateCommision($price)
    {
        $commision = 0;
        if ($price < 10000) {
            $commision = ($price * 10.0) / 100;

        } else if ($price < 50000) {
            $commision = ($price * 8.0) / 100;

        } else if ($price < 100000) {
            $commision = ($price * 6.0) / 100;

        } else {
            $commision = ($price * 5.0) / 100;
        }
        return $commision;
    }

    public function updatePaymentValue($taskID)
    {
        $taskInst = new Task();
        $row = $taskInst->first(['taskID' => $taskID]);
        if (!empty($row)) {
            $commision = $this->calculateCommision($row->value);
            $amount = $row->value + $commision;

            $this->query("UPDATE $this->table SET commission=:commission,amount=:amount WHERE taskID=:taskID;", ['commission' => $commision, 'amount' => $amount, 'taskID' => $taskID]);
        }
    }
}