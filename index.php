<?php

if(!empty($_GET)){

	/*pegando os valores do GET*/
	$hexa_corBG  = strtoupper($_GET['bgcolor']);
	$hexa_corTXT = strtoupper($_GET['txtcolor']);
	$w           = strtoupper($_GET['w']);
	$h           = strtoupper($_GET['h']);

	/*declarando as variáveis*/
	$rgb_corBG         = array();
	$rgb_corTXT        = array();
	/*transformando cor em RGB*/
	$rgb_corBG         = gerarCoresRGB($hexa_corBG);
	$rgb_corTXT        = gerarCoresRGB($hexa_corTXT);

	$my_img            = imagecreate( $w, $h );
	$background        = imagecolorallocate( $my_img, $rgb_corBG[0], $rgb_corBG[1], $rgb_corBG[2] );
	$text_colour       = imagecolorallocate( $my_img, $rgb_corTXT[0], $rgb_corTXT[1], $rgb_corTXT[2] );


	$white = imagecolorallocate($my_img, 255, 255, 255);
	$black = imagecolorallocate($my_img, 0, 0, 0);

	$metadealtura = $h/2;
	$metadelargura = $w/2;


	$metatemetadelargura = $metadelargura/2; 
	$metatemetadealtura = $metadealtura/2; 

	$tamanhofonte = $metatemetadelargura*0.5;

	if($w > $h){
		$tamanhofonte = $metadealtura*0.5;
	}

	/*echo "width: " . $w . "<br>";
	echo "height: " . $h . "<br>";
	echo "metadealtura: " . $metadealtura . "<br>";
	echo "metadelargura: " . $metadelargura . "<br>";
	echo "metatemetadelargura: " . $metatemetadelargura . "<br>";
	echo "metatemetadealtura: " . $metatemetadealtura . "<br>";
	echo "tamanhofonte: " . $tamanhofonte . "<br>";*/

/*if($w > $h){
$tamanhofonte = $metatemetadealtura*3;
}*/

$tamanho = $w . "x" . $h;

// Replace path by your own font path
$font = "./OpenSans-Regular.ttf";
imagettftext($my_img, $tamanhofonte, 0, 0, $metadealtura, $text_colour, $font,$tamanho);
//imagettftext($my_img, $tamanhofonte, 0, $metadelargura-$metatemetadelargura, $tamanhofonte+($h-$tamanhofonte), $text_colour, $font,$tamanho);
//imagettftext ( resource $image , float $size , float $angle , int $x , int $y , int $color , string $fontfile , string $text )

//imagestring( $my_img, 5, 30, 25, $tamanho, $text_colour );


header( "Content-type: image/png" );
imagepng( $my_img );
imagedestroy( $my_img );
}else{
	echo "Informe os parametros";
}

/*função para gerar a cor de hexadecimal para RGB*/
	function gerarCoresRGB($cor){
		$hexadecimal       = array(0=>0,1=>1,2=>2,3=>3,4=>4,5=>5,6=>6,7=>7,8=>8,9=>9,'A'=>10,'B'=>11,'C'=>12,'D'=>13,'E'=>14,'F'=>15);

		switch (strlen($cor)) {
			case 6:
			$dupla_hex_1       = substr($cor, 0, 2);
			$dupla_hex_2       = substr($cor, 2, 2);
			$dupla_hex_3       = substr($cor, 4, 2);
			break;
			case 3:
			$dupla_hex_1       = substr($cor, 0, 1);
			$dupla_hex_1       .= $dupla_hex_1;
			$dupla_hex_2       = substr($cor, 1, 1);
			$dupla_hex_2       .= $dupla_hex_2;
			$dupla_hex_3       = substr($cor, 2, 1);
			$dupla_hex_3       .= $dupla_hex_3;
			break;
			default:
			echo "não";
			break;
		}

		$decimal_11        = substr($dupla_hex_1, 0,1);

		$decimal_11        = $hexadecimal[$decimal_11];

		$decimal_12        = substr($dupla_hex_1, 1,1);
		$decimal_12        = $hexadecimal[$decimal_12];

		$decimal_21        = substr($dupla_hex_2, 0,1);
		$decimal_21        = $hexadecimal[$decimal_21];
		$decimal_22        = substr($dupla_hex_2, 1,1);
		$decimal_22        = $hexadecimal[$decimal_22];


		$decimal_31        = substr($dupla_hex_3, 0,1);
		$decimal_31        = $hexadecimal[$decimal_31];
		$decimal_32        = substr($dupla_hex_3, 1,1);
		$decimal_32        = $hexadecimal[$decimal_32];


		$decimal1          = ($decimal_11 * pow(16,1)) + ($decimal_12 * pow(16,0));
		$decimal2          = ($decimal_21 * pow(16,1)) + ($decimal_22 * pow(16,0));
		$decimal3          = ($decimal_31 * pow(16,1)) + ($decimal_32 * pow(16,0));

		$arrayRGB          = array();
		$arrayRGB[0]       = $decimal1;
		$arrayRGB[1]       = $decimal2;
		$arrayRGB[2]       = $decimal3;



		return $arrayRGB;
	}