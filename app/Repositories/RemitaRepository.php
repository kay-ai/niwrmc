<?php
namespace App\Repositories;

use App\Interfaces\RemitaRepositoryInterface;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class RemitaRepository implements RemitaRepositoryInterface
{
    private $baseUrl;
    private $merchantId;
    private $apiKey;
    private $serviceTypeProcessing;
    private $serviceTypeLicensing;

    public function __construct(){
        $this->baseUrl = env('REMITA_BASE_URL');
        $this->merchantId = env('REMITA_MERCHANT_ID');
        $this->apiKey = env('REMITA_API_KEY');
        $this->serviceTypeProcessing = env('REMITA_SERVICE_TYPE_PROCESSING');
        $this->serviceTypeLicensing = env('REMITA_SERVICE_TYPE_LICENSING');
    }

    public function generateRRR($data, $licenseType){
        try{
            $serviceType = $licenseType == "processing_fee" ? $this->serviceTypeProcessing : $this->serviceTypeLicensing;

            $payload = [
                "serviceTypeId" => $serviceType,
                "amount" => $data['amount'],
                "orderId" => $data['orderId'],
                "payerName" => $data['payerName'],
                "payerEmail" => $data['payerEmail'],
                "payerPhone" => $data['payerPhone'],
                "description" => $data['description']
            ];

            // Calculate apiHash
            $apiHash = hash('sha512', $this->merchantId . $serviceType . $data['orderId'] . $data['amount'] . $this->apiKey);

            // Log the payload and apiHash
            log::info('Payload:', $payload);
            Log::info('apiHash:', ['apiHash' => $apiHash]);

            $response = Http::withHeaders([
                'Authorization' => 'remitaConsumerKey='. $this->merchantId.',remitaConsumerToken='. $apiHash
            ])->post($this->baseUrl.'merchant/api/paymentinit', $payload);

            $rawResponse = $response->getBody()->getContents();

            // Remove the JSONP wrapper
            $startPos = strpos($rawResponse, '(') + 1;
            $endPos = strrpos($rawResponse, ')');
            $jsonStr = substr($rawResponse, $startPos, $endPos - $startPos);

            $RRR = json_decode($jsonStr, true);

            // Log::info('Decoded Response RRR:', $RRR);

            if ($RRR === null || !isset($RRR['statuscode'])) {
                return response()->json(["status" => "failure", "msg" => "Null response from Remita"], 400);
            } else {
                if($RRR['statuscode'] == '025'){
                    return response()->json(["status" => "success", "data" => $RRR], 200);
                }else{
                    return response()->json(["status" => "failure", "msg" => $RRR], 400);
                }
            }
        }catch(\Throwable $th){
            return response()->json(["status" => "failure", "msg" => $th->getMessage()], 400);
        }
    }


    public function verifyTransactionStatus($orderId, $amount, $rrr){
        try{
            $apiHash = hash('sha512', $rrr. $this->apiKey . $this->merchantId);

            $response = Http::withHeaders([
                'Authorization' => 'remitaConsumerKey='. $this->merchantId.',remitaConsumerToken='. $apiHash
            ])->get($this->baseUrl.$this->merchantId.'/'.$rrr.'/'.$apiHash.'/status.reg');

            $rawResponse = $response->getBody()->getContents();

            $res = json_decode($rawResponse, true);
            // dd($res);

            if ($res === null || !isset($res['status'])) {
                return response()->json(["status" => "failure", "msg" => "Null response from Remita"], 400);
            } else {
                if(
                    $res['orderId'] == $orderId
                    && $res['amount'] >= $amount
                    && $res['RRR'] == $rrr
                ){
                    return response()->json(["status" => $res['message'], "data" => $res], 200);
                }else{
                    return response()->json(["status" => "failure", "data" => $res], 400);
                }
            }
        }catch(\Throwable $th){
            return response()->json(["status" => "failure", "msg" => $th->getMessage()], 400);
        }
    }
}
