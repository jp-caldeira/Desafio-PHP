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


$preco = "-39,90";
$preco = str_replace(",",".", $preco);

if(!is_numeric($preco)){
  echo $preco;
  echo "<br>resultado se preço NÃO númerico<br>";
} else {
  echo $preco;
  echo "<br>resultado se preço NÃO númerico<br>";
}

if($preco < 0){
  echo $preco;
  echo "<br>resultado se preço menor que zero<br>";
} else {
  echo $preco;
  echo "<br>resultado se preço maior que zero<br>";
}

 if(!is_numeric($preco) && $preco < 0){
   echo $preco;
   echo "<br>resultado se preço NÃO númerico OU menor que zero<br>";
  } else {
   echo $preco;
   echo "<br>resultado se preço é númerico OU maior que zero<br>";
  }

  $preco = "assasdasdasdas";
  $preco = str_replace(",",".", $preco);

  if(!is_numeric($preco)){
    echo $preco;
    echo "<br>resultado se preço NÃO númerico<br>";
  } else {
    echo $preco;
    echo "<br>resultado se preço NÃO númerico<br>";
  }

  if($preco < 0){
    echo $preco;
    echo "<br>resultado se preço menor que zero<br>";
  } else {
    echo $preco;
    echo "<br>resultado se preço maior que zero<br>";
  }

   if(!is_numeric($preco) && $preco < 0){
     echo $preco;
     echo "<br>resultado se preço NÃO númerico OU menor que zero";
    } else {
     echo $preco;
     echo "<br>resultado se preço é númerico OU maior que zero<br>";
    }

    $arrayProdutos = file_get_contents('produtos.json');
    $arrayProdutos = json_decode($arrayProdutos, true);

$preco = $arrayProdutos[11]['preço'];

if(is_numeric($preco)){
  echo $preco;
  echo "<br>1. resultado se preço É númerico<br>";
} else {
  echo $preco;
  echo "<br>1. resultado se preço NÃO É númerico<br>";
}

if($preco < 0){
  echo $preco;
  echo "<br>2. resultado se preço menor que zero<br>";
} else {
  echo $preco;
  echo "<br>2. resultado se preço maior que zero<br>";
}

 if(!is_numeric($preco) && $preco < 0){
   echo $preco;
   echo "<br>3. resultado se preço NÃO númerico E menor que zero";
  } else {
   echo $preco;
   echo "<br>3. resultado se preço é númerico E maior que zero";
  }

?>
