<?php
// echo "Digite um numero: ";
// $numero = trim(fgets(STDIN)); // lê e remove espaços em branco / quebras de linha
// $resultado = [];
// while ($numero > 0) {
//     echo "Digite um numero: ";
//     if($numero != 0) {
//         $resultado[] = $numero;
//     }
//     $numero = trim(fgets(STDIN));

//     if ($numero == 0) {
//         break;
//     } 
// }

//     $max = max($resultado);
//     $min = min($resultado);


// // foreach ($resultado as $r) {
// //     $min = $resultado[0];
// //     $max = $resultado[0];
// //     if ($r > $max) {
// //         $max = $r;
// //     }
// //     if ($r <= $min ) {
// //         $min = $r;
// //     }
// // }
// echo "Menor número digitado $min" . " " . "Maior numero digitado $max";
// $word = "corinthians";

// $word = str_split($word);

// var_dump($word);

// $letras = [];
// foreach($word  as $key => $w) {
//     $letra_atual = $w;
//     while($w == $letra_atual) {
//         $letras[] = $w;
//     }

//     var_dump($letras);
// }

// $data = [
//     'nome' => 'Caue',
//     'idade' => 30,
//     'habilidades' => ['PHP', 'JavaScript', 'SQL']
// ];

// echo $serializado = json_encode($data);

// $names = ['Caue', 'Lucas'];

//  if (empty($names) || $names == null) {
//     echo "no one likes this";
//  }

//  foreach ($names as  $key => $value) {
//     $others = count($names);
//     if (count($names) == 1) {
//         echo "$names[0] likes this";
//         break;
//     } else if (count($names) == 2) {
//         echo "$names[0]  and $names[1]  likes this";
//         break;
//     } else if (count($names) == 3) {
//         echo "$nome1, $nome2 and $nome3 like this";
//         break;
//     } else {
//         echo "$nome1, $nome2 and $others others like this";
//     }
//  }
// $datas =  [[45, 12], [55, 21], [19, -2], [104, 20]];
//   $retorno = [];
//   foreach ($datas as $d) {
//       if($d[0] >= 55 && $d[1] >= 7) {
//         $retorno[] = "Senior";
//       } else {
//         $retorno[] = "open";
//       }

//   }
//   var_dump($retorno);
// $list = [1, 2, 3, 4];
// $reverseArray = []; 
// $tamanho = count($list);

// for ($i = $tamanho - 1; $i >= 0; $i--) {
//   $reverseArray[] = $list[$i];
// }
// var_dump($reverseArray);
// $start = "10.0.0.0";
// $end   = "10.0.0.50";
// $ip1_array   = explode(".", $start);
// $ip2_array   = explode(".", $end);
// $sum = [];
// $sum[] = $o1 = $ip1_array[0] * pow(256, 3);
// $sum[] = $o2 = $ip1_array[1] * pow(256, 2);
// $sum[] = $o3 = $ip1_array[2] * pow(256, 1);
// $sum[] = $o4 = $ip1_array[3] * 1;
// $ip1 = array_sum($sum);
// ## ip 2
// $oc1 = $ip2_array[0] * pow(256, 3);
// $oc2 = $ip2_array[1] * pow(256, 2);
// $oc3 = $ip2_array[2] * pow(256, 1);
// $oc4 = $ip2_array[3] * 1;
// $ip2 = $oc1 + $oc2 + $oc3 + $oc4;
// echo $ip2 - $ip1;

$formula = "H2O";

