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
?>
