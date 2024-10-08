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
        try {
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

            $apiHash = hash('sha512', $this->merchantId . $serviceType . $data['orderId'] . $data['amount'] . $this->apiKey);
            Log::info('Payload:', ['payload' => $payload]);
            Log::info('apiHash:', ['apiHash' => $apiHash]);

            $response = Http::withHeaders([
                'Authorization' => 'remitaConsumerKey='. $this->merchantId.',remitaConsumerToken='. $apiHash
            ])->post($this->baseUrl . 'merchant/api/paymentinit', $payload);

            $rawResponse = $response->getBody()->getContents();
            Log::info('Raw response from Remita:', ['response' => $rawResponse]);

            // Attempt to handle as standard JSON first
            $RRR = json_decode($rawResponse, true);

            if ($RRR === null && strpos($rawResponse, '(') !== false) {
                // Fallback to JSONP parsing
                $startPos = strpos($rawResponse, '(') + 1;
                $endPos = strrpos($rawResponse, ')');
                $jsonStr = substr($rawResponse, $startPos, $endPos - $startPos);
                $RRR = json_decode($jsonStr, true);
            }

            if ($RRR === null || !isset($RRR['statuscode'])) {
                return ["status" => "failure", "msg" => "Null response from Remita"];
            }

            if($RRR['statuscode'] == '025'){
                return response()->json(["status" => "success", "data" => $RRR], 200);
            }else{
                return response()->json(["status" => "failure", "msg" => $RRR], 400);
            }
        } catch (\Exception $e) {
            Log::error('Error in generating RRR: ', ['error' => $e->getMessage()]);
            return ["status" => "failure", "msg" => $e->getMessage()];
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
