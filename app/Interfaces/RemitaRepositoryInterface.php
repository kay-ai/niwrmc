<?php
namespace App\Interfaces;

interface RemitaRepositoryInterface
{
    public function generateRRR($data, $licenseType);
    public function verifyTransactionStatus($orderId, $amount, $rrr);
}
