<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="author" />
    <meta name="description" content="description" />
    <meta name="keywords" content="key,words,separate,by,commas">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Calculator</title>
</head>
<body>

<?php

    include_once("processing.php");
?>

    <p>Calculator</p>

    <section class="calculator">
            <form action="" method="post">
                <input type="text" class="maininput" name="input" value="<?php echo @$num ?> <?php echo @$operation ?>" readonly/>
                <input type="submit" class="numberbtn" name="number" value="1">
                <input type="submit" class="numberbtn" name="number" value="2">
                <input type="submit" class="numberbtn" name="number" value="3">
                <input type="submit" class="numberbtn" name="number" value="4">
                <input type="submit" class="numberbtn" name="number" value="5">
                <input type="submit" class="numberbtn" name="number" value="6">
                <input type="submit" class="numberbtn" name="number" value="7">
                <input type="submit" class="numberbtn" name="number" value="8">
                <input type="submit" class="numberbtn" name="number" value="9">
                <input type="submit" class="numberbtn" name="number" value="10">
                <input type="submit" class="numberbtn" name="number" value="0">
                <input type="submit" class="equals" name="equals" value="=">
                <input type="submit" class="calbtn" name="op" value="+">
                <input type="submit" class="calbtn" name="op" value="-">
                <input type="submit" class="calbtn" name="op" value="*">
                <input type="submit" class="calbtn" name="op" value="/">
                <input type="submit" class="calbtn" name="op" value="c">
        </form>

    </section>

    
</body>
</html>