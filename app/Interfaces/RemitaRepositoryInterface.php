<?php
namespace App\Interfaces;

interface RemitaRepositoryInterface
{
    public function generateRRR($data);
    public function verifyTransactionStatus($orderId, $amount, $rrr);
}
