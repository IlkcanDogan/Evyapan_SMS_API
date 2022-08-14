<?php
	
	function SendSMS($content, $phoneNumber) {
        $curl = curl_init();

        curl_setopt($curl, CURLOPT_URL, 'http://panel2.evyapanltd.com.tr:9587/sms/create');
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_ENCODING, '');
        curl_setopt($curl, CURLOPT_MAXREDIRS, 10);
        curl_setopt($curl, CURLOPT_TIMEOUT, 0);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($curl, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode([
            "type" => 1, 
            "sendingType" => 0,
            "title" => "FIRMA_ADI",
            "content" => $content,
            "number" => $phoneNumber,
            "encoding" => 0,
            "sender" => "FIRMA_ADI",
            "periodicSettings" => null,
            "sendingDate" => null,
            "pushSettings" => null
         ]));
        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
            'Authorization: Basic [base64_api_key]',
            'Content-Type: application/json'
        ));

        $response = curl_exec($curl);

        curl_close($curl);

        $arr = json_decode($response, true);
        return $arr['err'] === null;
    }


	$phone = '90539xxxxxxx';
	$content = 'Değerli müsterimiz sevkiyatınız dağıtıma çıkarılmıştır. FIRMA_ADI';

	if(SendSMS($content, $orderGSM)){
		echo "SMS başarı ile gönderildi!";
	}
	else {
		echo "Bir hata oluştu!";
	}


?>
