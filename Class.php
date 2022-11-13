<?php 
	require_once"vendor/autoload.php";
	use GuzzleHttp\Client;

	class KirimWa
	{
		private $token;
		private $__client;
		function __construct()
		{
			$this->token = "TOKEN";
	        $this->__client = new Client([
	            'base_uri'=>"https://api.kirimwa.id/",
	            'headers'=>[
	            	'Content-Type'=>'application/json',
	            	'Authorization'=> 'Bearer '.$this->token
	            ],
	        ]);
		}
		public function postDevices($deviceName){
			try {
			  return $this->request('POST','/devices',json_encode(['device_id'=>strtolower($deviceName)]));
			} catch (Exception $e) {
			  print_r($e);
			}
		}
		public function getDevices(){
			try {
			  return $this->request('GET','/devices');
			} catch (Exception $e) {
			  print_r($e);
			}
		}
		public function getQr($devicesId){
			try {
			  return $this->request('GET','/qr?'.http_build_query(['device_id' => strtolower($devicesId)]));
			} catch (Exception $e) {
			  print_r($e);
			}
		}
		public function getGroups($devicesId){
			try {
			  return $this->request('GET','/groups?'.http_build_query(['device_id' => strtolower($devicesId)]));
			} catch (Exception $e) {
			  print_r($e);
			}
		}
		public function getQuota(){
			try {
			  return $this->request('GET','/quotas');
			} catch (Exception $e) {
			  print_r($e);
			}
		}
		public function postMessages($pesan,$hp,$type='text',$devicesId,$is_grup = false){
			try {
			  return $this->request('POST','/messages',
			  	json_encode([
			  		'message' => $pesan,
			  		'phone_number' => $hp,
			  		'message_type'=> $type,
			  		'device_id' => strtolower($devicesId),
			  		'is_group_message'=>$is_grup
			  	]));
			} catch (Exception $e) {
			  print_r($e);
			}
		}

	    private function request($method, $url,$payload = null){
	        $request = $this->__client->request($method,'v1'.$url,[
	            'body'=>$payload,
			    'timeout' => 15,
			    'ignore_errors' => true,
	        ]);
	        return $result = json_decode($request->getBody()->getContents(),true);
	    }
	}
 ?>