<?php
if($fp = tmpfile()) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL,"https://localhost"); //endereço https para encontrar os dados do certificado
    curl_setopt($ch, CURLOPT_STDERR, $fp);
    curl_setopt($ch, CURLOPT_CERTINFO, 1);
    curl_setopt($ch, CURLOPT_VERBOSE, 1);
    curl_setopt($ch, CURLOPT_HEADER, 1);
    curl_setopt($ch, CURLOPT_NOBODY, 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); //precisa estar como "false" porque o certificado é auto-assinado
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST,  false); //precisa estar como "false" porque o certificado é auto-assinado
    $result = curl_exec($ch);
    curl_errno($ch)==0 or die("Error:".curl_errno($ch)." ".curl_error($ch));
    fseek($fp, 0);//rewind
    $str='';
    while(strlen($str.=fread($fp,8192))==8192);
    echo '<pre>';
    echo $str;
    echo '</pre>';
    fclose($fp);
}
?>


