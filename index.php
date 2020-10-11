<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Codewars Pattern Generator Solution</title>
</head>
<body>
    <h1>Pattern Generator</h1>
    <h3>Author : Rully Lukman</h3>
    <h4>Github : <a href="https://github.com/blackbone23" target="_blank">https://github.com/blackbone23</a></h4>
    <h4>Gitlab : <a href="https://gitlab.com/rully_lukman" target="_blank">https://gitlab.com/rully_lukman</a></h4>
    <h4>This is pattern generator for codewars : <a href="https://www.codewars.com/kata/598ab728062fc49a22000410/javascript" target="_blank">https://www.codewars.com/kata/598ab728062fc49a22000410/javascript</a>, I'll do it in PHP</h4>
    <div>
    <br><br>
        <h3>So, Here It is ...</h3>
        <form method="post" actions="">
            <label for="input"><strong>To Do : </strong> Type any number from 1 to anything! (be carefull with your php memory!) : </label><br><br>
            <input type="text" name="integer" placeholder="type the number"/>
            <input type="submit" value="Click Me!"/>
        </form>
    </div>
    <div>
        <?php

        if(isset($_POST['integer'])) {
            // get your number
            $your_number = $_POST['integer']; 

            // triangle function split to 3 parts, top, bottom and middle with different handler
            function triangle($n) {
                $offset = ($n * 2) -1;
                for($i=0; $i < $offset; $i++) {
                    if($i < $n - 1 && $n < $offset) {
                        $position = "top";
                        $number = $n + $i;
                        echo string_pattern($number, $position, $offset, $n);
                    }
                    if($i == $n - 1) {
                        $position = "middle";
                        $number = $n + $i;
                        echo string_pattern($number, $position, $offset, $n);
                    }
                    if($i > $n - 1) {
                        $position = 'bottom';
                        $number = $offset - ($i - $n + 1);
                        // echo $number;
                        echo string_pattern($number, $position, $offset, $n);
                    }
                    echo "<br/>";
                }
                
            }

            // arrange the string pattern
            function string_pattern($number, $position, $offset, $n) {
                if($position == "top") {
                    $blank_string = $n - 1;
                    $string = $number - $blank_string;
                    $left_string = blank_string($blank_string);
                    return $left_string.strrev(string_execution($string));

                } elseif($position == "bottom") {
                    $blank_string = $n - 1;
                    $string = $number - $blank_string;
                    $left_string = blank_string($offset - $number);
                    $right_string = blank_string($blank_string);
                    return $left_string.string_execution($string);

                } else {
                    $pre_string = $n - 1;
                    $after_string = $number - $pre_string;
                    $left_string = string_execution($pre_string);
                    $right_string = strrev(string_execution($after_string));
                    return $left_string.$right_string;
                }
            }

            // cover some blank string, because most browser can't print whitespace
            function blank_string($n) {
                for($i=0; $i<$n; $i++) {
                    $a[$i] = "_";
                }
                return implode("", $a);
            }

            // string execution for each row
            function string_execution($number) {
                $a = [];
                $s = 1;
                for($i=0; $i<$number; $i++) {
                    if($i == 0) {
                        $a[$i] = "x";
                    } else {
                        $prep = odd_even($i);
                        if($prep == 'true') {
                        
                            $a[$i] = define_pattern($s);
                        
                            $s = $s + 1;
                        } else {
                            $a[$i] = $prep;
                        }
                    }
                }
                return implode("", $a);
            }

            // define odd or even char position
            function odd_even($n) {
                $odd_even = fmod($n, 2);
                if($odd_even == 1) {
                    return '_';
                } else {
                    return 'true';
                }
            }

            // define pattern for each "even" char positions
            function define_pattern($s) {
                if(fmod($s,2) == 1) {
                return 'o';
                } else {
                    return 'x';
                }
            }

            // display pattern with some validation
            if($your_number <= 0) {
                echo "Don't mess up with me, input above 0 to anything!!!";
            } else {
                echo "<h3>Here's the pattern : </h3>";
                echo "<br/><br/>";
                echo triangle($your_number);
            }
        }


        ?>
    </div>
</body>
</html>

