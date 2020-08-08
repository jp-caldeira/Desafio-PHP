 <?php

$numerico = "    0,90     ";
echo "numerico é: ".$numerico."<br>";
echo (is_numeric($numerico) && $numerico > 0) ? ("o valor".$numerico." é numérico<br>") : ("o valor".$numerico." não é numérico<br>");
$numerico = str_replace(",", ".", $numerico);
echo (is_numeric($numerico) && $numerico > 0) ? ("o valor".$numerico." é numérico<br>") : ("o valor".$numerico." não é numérico<br>");

$numerico = 39.90;
echo (is_numeric($numerico)) ? ("o valor".$numerico." é numérico<br>") : ("o valor".$numerico." não é numérico<br>");
$numerico = "39.90";
echo (is_numeric($numerico)) ? ("o valor".$numerico." é numérico<br>") : ("o valor".$numerico." não é numérico<br>");
$numerico = 39.90;
echo (is_numeric($numerico)) ? ("o valor".$numerico." é numérico<br>") : ("o valor".$numerico." não é numérico<br>");

$numerico = "39,90";
echo $numerico."<br><br>";
$numerico = str_replace(",", ".", $numerico);
echo $numerico."<br><br>";


$preco = "-3";
$preco = str_replace(",",".", $preco);

if($preco < 0.1){
  echo "<br>preço menor que zero<br>";
} else {
  echo "<br>preço maior que zero";
}

if(!is_numeric($preco)){
    echo "<br>preço não é número";
} else {
  echo "<br>preço é número";
}

if(!is_numeric($preco)){
      echo "<br><strong>PREÇO</strong> deve ser um valor númerico";
      $precoOK = false;
      return $precoOK;
    } elseif ($preco < 0.1){
      echo "<br>preço tem de ser maior que zero.<br>";
    } else {
      echo "tudo certo com o número";
    }


?>
