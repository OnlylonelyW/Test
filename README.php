<?php
namespace Font\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
	require_once("test.php");
	    echo"12345";
		vendor('Code.phpqrcode');
		
		$value = 'http://www.qq.com/'; //二维码内容   
       $errorCorrectionLevel = 'L';//容错级别   
       $matrixPointSize = 6;//生成图片大小   
		//生成二维码图片
		$qRcode=new \QRcode;
		//QRcode::png($url,false,QR_ECLEVEL_L,$size,2,false,0xFFFFFF,0x000000);  
      $qRcode->png($value, 'qrcode.png', $errorCorrectionLevel, $matrixPointSize, 2);   
        $logo = 'logo.png';//准备好的logo图片   
         $QR = 'qrcode.png';//已经生成的原始二维码图   

	 if ($logo !== FALSE) {   
		$QR = imagecreatefromstring(file_get_contents($QR));   
		$logo = imagecreatefromstring(file_get_contents($logo));   
		$QR_width = imagesx($QR);//二维码图片宽度   
		$QR_height = imagesy($QR);//二维码图片高度   
		$logo_width = imagesx($logo);//logo图片宽度   
		$logo_height = imagesy($logo);//logo图片高度   
		$logo_qr_width = $QR_width / 5;   
		$scale = $logo_width/$logo_qr_width;   
		$logo_qr_height = $logo_height/$scale;   
		$from_width = ($QR_width - $logo_qr_width) / 2;   
		//重新组合图片并调整大小   
		imagecopyresampled($QR, $logo, $from_width, $from_width, 0, 0, $logo_qr_width,   
		$logo_qr_height, $logo_width, $logo_height);   
	}   
	//输出图片   
	   imagepng($QR, 'helloweixin.png');   
	   echo '<img src="/think/helloweixin.png">';  
	   //echo $logo !== FALSE;
		
		
		
    }
	//purchase购买页面
	 public function purchase(){
	 	$this->display();
	 }
	 //展示票价
	 public function show(){
	 	$this->display();
	 }
	 //个人信息
	 public function person(){
	 	$id=1;
		$Form=M('form');  
	 	$result=$Form->where(array('id'=>$id))->select();
		$this->data=$result; 
	 
	 	$this->display();
	 }
}
