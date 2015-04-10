<?php
$list =
    'Home
Products
    Product 1
        Product 1 Images
    Product 2
        Product 2 Images
            string
            name
                here
            I
        Go
            ahkjsd
lkj
    f
        d
            f
    Where to Buy
About Us
    Meet the Team
    Careers
Contact Us';

function helper($list, $indentation = '    ') {
    $result = array();
    $path = array();

    foreach (explode("\n", $list) as $line) {
        // get depth and label
        $depth = 0;
        while (substr($line, 0, strlen($indentation)) === $indentation) {
            $depth += 1;
            $line = substr($line, strlen($indentation));
        }

        // truncate path if needed
        while ($depth < sizeof($path)) {
            array_pop($path);
        }

        // keep label (at depth)
        $path[$depth] = trim($line);

        // traverse path and add label to result
        $parent =& $result;
        foreach ($path as $depth => $key) {
            if (!isset($parent[$key])) {
                $parent[$key] = [];
                break;
            }

            $parent =& $parent[$key];
        }
    }

    // return
    return $result;
}

echo '<pre>';
$tree = helper($list);
//print_r($tree);
echo makeList($tree);
//print_r(output($string));

function makeList(array $array, $level = 0, $very_first_item = true)
{
    $output = "\n";

    //Recursive Step: make a list with child lists
    $count = 0;
    foreach ($array as $key => $subArray) {
//        print_r($subArray);
//        print_r($key);
//        echo '<br />';

        if($count == count($array) - 1) {
            $prefix = str_repeat('|   ', $level) . '└── ';
        } elseif($very_first_item === true) {
            $prefix =  str_repeat('|   ', $level) . '┌── ';
        } else {
            $prefix = str_repeat('|   ', $level) . '├── ';
        }
        $very_first_item = false;
        $output .= $prefix . $key . makeList($subArray, $level + 1, $very_first_item);
        $count++;
    }

    return $output;
}