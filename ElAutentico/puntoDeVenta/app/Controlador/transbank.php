<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
function get_ws($data,$method,$type,$endpoint){
    $curl = curl_init();
    if($type=='live'){
		$TbkApiKeyId='597055555532';
		$TbkApiKeySecret='579B532A7440BB0C9079DED94D31EA1615BACEB56610332264630D42D0A36B1C';
        $url="https://webpay3g.transbank.cl".$endpoint;//Live
    }else{
		$TbkApiKeyId='597055555532';
		$TbkApiKeySecret='579B532A7440BB0C9079DED94D31EA1615BACEB56610332264630D42D0A36B1C';
        $url="https://webpay3gint.transbank.cl".$endpoint;//Testing
    }
    curl_setopt_array($curl, array(
      CURLOPT_URL => $url,
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => $method,
      CURLOPT_POST => true,
      CURLOPT_POSTFIELDS => $data,
      CURLOPT_HTTPHEADER => array(
        'Tbk-Api-Key-Id: '.$TbkApiKeyId.'',
        'Tbk-Api-Key-Secret: '.$TbkApiKeySecret.'',
        'Content-Type: application/json'
      ),
    ));
    
    $response = curl_exec($curl);
    
    curl_close($curl);
    //echo $response;
    return json_decode($response);
}

$baseurl = "https://" . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'];
$url="https://webpay3g.transbank.cl/";//Live
$url="https://webpay3gint.transbank.cl/";//Testing

$action = isset($_GET["action"]) ? $_GET["action"] : 'init';
$message=null;
$post_array = false;

switch ($action) {
    
    case "init":
        $message.= 'init';
        $buy_order=rand();
        $session_id=rand();
        $amount=15000;
        $return_url = $baseurl."?action=getResult";
		$type="sandbox";
            $data='{
                    "buy_order": "'.$buy_order.'",
                    "session_id": "'.$session_id.'",
                    "amount": '.$amount.',
                    "return_url": "'.$return_url.'"
                    }';
            $method='POST';
            $endpoint='/rswebpaytransaction/api/webpay/v1.0/transactions';
            
            $response = get_ws($data,$method,$type,$endpoint);
            $message.= "<pre>";
            $message.= print_r($response,TRUE);
            $message.= "</pre>";
            $url_tbk = $response->url;
            $token = $response->token;
            $submit='Continuar!';

    break;

    case "getResult":
        
        $message.= "<pre>".print_r($_POST,TRUE)."</pre>";
        if (!isset($_POST["token_ws"]))
            break;

        /** Token de la transacción */
        $token = filter_input(INPUT_POST, 'token_ws');
        
        $request = array(
            "token" => filter_input(INPUT_POST, 'token_ws')
        );
        
        $data='';
		$method='PUT';
		$type='sandbox';
		$endpoint='/rswebpaytransaction/api/webpay/v1.0/transactions/'.$token;
		
        $response = get_ws($data,$method,$type,$endpoint);
       
        $message.= "<pre>";
        $message.= print_r($response,TRUE);
        $message.= "</pre>";
        
        $url_tbk = $baseurl."?action=getStatus";
        $submit='Ver Status!';
        
        break;
        
    case "getStatus":
        
        if (!isset($_POST["token_ws"]))
            break;

        /** Token de la transacción */
        $token = filter_input(INPUT_POST, 'token_ws');
        
        $request = array(
            "token" => filter_input(INPUT_POST, 'token_ws')
        );
        
        $data='';
		$method='GET';
		$type='sandbox';
		$endpoint='/rswebpaytransaction/api/webpay/v1.0/transactions/'.$token;
		
        $response = get_ws($data,$method,$type,$endpoint);
       
        $message.= "<pre>";
        $message.= print_r($response,TRUE);
        $message.= "</pre>";
        
        $url_tbk = $baseurl."?action=refund";
        $submit='Refund!';
        break;
        
    case "refund":
        
        if (!isset($_POST["token_ws"]))
            break;

        /** Token de la transacción */
        $token = filter_input(INPUT_POST, 'token_ws');
        
        $request = array(
            "token" => filter_input(INPUT_POST, 'token_ws')
        );
        $amount=15000;
        $data='{
                  "amount": '.$amount.'
                }';
		$method='POST';
		$type='sandbox';
		$endpoint='/rswebpaytransaction/api/webpay/v1.0/transactions/'.$token.'/refunds';
		
        $response = get_ws($data,$method,$type,$endpoint);
       
        $message.= "<pre>";
        $message.= print_r($response,TRUE);
        $message.= "</pre>";
        $submit='Crear nueva!';
        $url_tbk = $baseurl;
        break;        
}        
?>

<?php
// transbank.php

function realizarPagoTransbank($medioPago) {
    // Tu lógica para procesar el pago con Transbank aquí
    // Puedes hacer llamadas a la API de Transbank u otras operaciones necesarias
    // Retorna una respuesta adecuada según el resultado del pago
    return "Pago realizado con éxito mediante $medioPago";
}
?>
