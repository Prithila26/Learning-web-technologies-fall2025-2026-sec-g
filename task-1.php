<?php
$length = 10;
$width = 5;
 
$area = $length * $width;
$perimeter = 2 * ($length + $width);
 
echo "Area : $area <br>";
echo "Perimeter : $perimeter";
?>
<br><br>    
<?php
$amount = 15000;
$vat = $amount * 0.15;
 
echo "VAT = $vat";
?>
<br><br>
<?php
$num = 7;
 
if($num % 2 == 0){
    echo "$num is Even";
} else {
    echo "$num is Odd";
}
?>
<br><br>
<?php
$a = 115;
$b = 20;
$c = 185;
 
if($a >= $b && $a >= $c){
    echo "$a is the largest";
} elseif($b >= $a && $b >= $c){
    echo "$b is the largest";
} else {
    echo "$c is the largest";
}
?>
<br><br>
<?php
for($i = 10; $i <= 100; $i++){
    if($i % 2 != 0){
        echo "$i ";
    }
}
?>
<br><br>
<?php
$arr = [4, 7, 12, 20, 35];
$search = 12;
$found = false;
 
foreach($arr as $value){
    if($value == $search){
        $found = true;
        break;
    }
}
 
if($found){
    echo "$search found in the array";
} else {
    echo "$search not found";
}
?>
<br><br>
<?php
for($i=1; $i<=3; $i++){
    for($j=1; $j<=$i; $j++){
        echo "* ";
    }
    echo "<br>";
}
?>
<?php
for($i=3; $i>=1; $i--){
    for($j=1; $j<=$i; $j++){
        echo "$j ";
    }
    echo "<br>";
}
?>
<?php
$char = 'A';
 
for($i=1; $i<=3; $i++){
    for($j=1; $j<=$i; $j++){
        echo $char . " ";
        $char++;
    }
    echo "<br>";
}
?>
<br><br>
<?php
$arr = [
    [1, 2, 3, "A"],
    [1, 2, "B", "C"],
    [1, "D", "E", "F"]
];
?>
<?php
for($i=0; $i<3; $i++){
    for($j=0; $j<3-$i; $j++){
        echo $arr[$i][$j] . " ";
    }
    echo "<br>";
}
?>
<?php
for($i=0; $i<3; $i++){
    for($j=3-$i; $j<4; $j++){
        echo $arr[$i][$j] . " ";
    }
    echo "<br>";
}
?>
 