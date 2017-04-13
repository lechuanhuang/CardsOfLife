<!doctype html>

<html>

<head>
    <title>Cards of Life: PHP Test</title>
    <style>
    
        body {
            font-family: "Open Sans", sans-serif;
            font-size: 16pt;
        }
        
        .color {
            color: red;
        }
        
        .size {
            font-size: 1.5em;
        }
    </style>
</head>

<body>

<?php
$file = fopen("data/cardsColumns.csv","r");
$array = fgetcsv($file);
echo('<div class="color">' . $array[0] . '</div><div class="size">' . $array[1] . "</div>");
  while(! feof($file))
  {
  print_r(fgetcsv($file)[0]);
   echo('<br>');
  }
fclose($file);
?>

</body>

</html>
