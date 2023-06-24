<?php

    include_once("index.php");
    $cookie_name1="number";
    $cookie_value1="";
    $cookie_name2="op";
    $cookie_value2="";
    
    if(isset($_POST["number"])){
        $num=$_POST["number"];
    }else{
        $num="";
    }

    if(isset($_POST["op"])){
        $cookie_value1 = $_POST["input"];
        setcookie($cookie_name1, $cookie_value1, time()+(86400 * 30), "/");

        $cookie_value2 = $_POST["op"];
        $operation = $cookie_value2;

        if($operation == "c"){
            $operation = "";
        }else{
            $operation = $cookie_value2;
        }

        setcookie($cookie_name2, $cookie_value2, time()+(86400 * 30), "/");
        $num = "";
    }

    if(isset($_POST["equals"])){
        $num = $_POST["input"];
        switch($_COOKIE["op"]){
            case "+":
                $res = $_COOKIE["number"]+$num;
                break;
                case "-":
                    $res = $_COOKIE["number"]-$num;
                    break;
                    case "*":
                        $res = $_COOKIE["number"]*$num;
                        break;
                        case "/":
                            if($num  == 0){
                                $res = "Undefined. There's no division by 0.";
                                break;
                            }else{
                                $res = $_COOKIE["number"]/$num; 
                                break;
                            }
                        case "c":
                            $res = 0;
                            $operation = "";
                            break;
        }
        $num=$res;
        $operation =  $cookie_value2;
    }
?>