<?php
/*
# Criado por : Rudolf Kroker Junior
# Website: PHPTech.com.br
# Data 17/04/2013

#Iniciamos a SESSION para poder gravar as informações como o "código" que será criado
*/
session_start();

#Criamos uma variável aonde iremos inserir esse código do captcha
$string = '';

/*
Aqui temos que criar um código randomico para o captcha
*/
for ($i = 0; $i < 5; $i++) {
	// os números aqui são referência à tabela ASCII (tudo em lower case)
	$string .= chr(rand(97, 122));
}

// Criamos a session com este código
$_SESSION['rand_code'] = $string;

// Dizemos aonde as fontes estão localizadas para criar a imagem do captcha
$dir = 'fontes/';

// definimos o tamanho da imagem, cores, e afins
$image = imagecreatetruecolor(170, 60);
$black = imagecolorallocate($image, 0, 0, 0);
$color = imagecolorallocate($image, 200, 100, 90); // vermelho
$white = imagecolorallocate($image, 255, 255, 255);

/*
# E agoar vamos criar a imagem com as configurações feitas acima. Além de definir a fonte, ou seja
# quando você vê aquelas fontes absurdas em captchas, é por que alguém esta usando uma fonte absurda
# para criar o bendido captcha então fica a seu critério definir a fonte que lhe convem
# basta alterar o "arial.ttf" para a fonte escolhida, de preferência uma que seja TTF.
*/
imagefilledrectangle($image,0,0,399,99,$white);
imagettftext ($image, 30, 0, 10, 40, $color, $dir."arial.ttf", $_SESSION['rand_code']);

// Lançamos um header dizendo que esta "página é uma imagem"
header("Content-type: image/png");
// Lançamos a imagem
imagepng($image);

?>