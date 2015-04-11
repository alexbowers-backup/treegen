<?php
$list =
    'Level 0 Child 1
Level 0 Child 2
    Level 1 Child 1
        Level 1 Child 1 Grandchild 1
    Level 1 Child 2
        Level 1 Child 2 Grandchild 1
            Level 1 Child 2 Grandchild 1 Great-grandchild 1
            Level 1 Child 2 Grandchild 1 Great-grandchild 2
            Level 1 Child 2 Grandchild 1 Great-grandchild 3
        Level 1 Child 2 Grandchild 2
            Level 1 Child 2 Grandchild 2 Great-grandchild 1
';

    function helper($list, $indentation = '    ')
    {
        $result = [];
        $path = [];

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
            $trimmed_line = trim($line);
            if (!empty($trimmed_line)) {
                $path[$depth] = $trimmed_line;

                // traverse path and add label to result
                $parent =& $result;
                foreach ($path as $depth => $key) {
                    if (!isset($parent[$key]) && !empty($key)) {
                        $parent[$key] = [];
                        break;
                    }

                    $parent =& $parent[$key];
                }
            }
        }

        // return
        return $result;
    }

    echo '<pre>';
    $tree = helper($list);
    $arrLines = [array_depth($tree)];
    echo '<pre>' . makeList($tree) . '</pre>';

    function array_depth(array $array)
    {
        $max_depth = 1;

        foreach ($array as $value) {
            if (is_array($value)) {
                $depth = array_depth($value) + 1;

                if ($depth > $max_depth) {
                    $max_depth = $depth;
                }
            }
        }

        return $max_depth;
    }

    function makeList(array $array, $level = 0, $very_first_item = true)
    {
        global $arrLines;
        $output = "\n";
        $count = 0;
        foreach ($array as $key => $subArray) {
            if ($count == count($array) - 1) {
                $prefix = '└── ';
                $arrLines[$level + 1] = '    ';
            } elseif ($very_first_item === true) {
                $prefix = '┌── ';
                $arrLines[$level + 1] = '|   ';
            } else {
                $prefix = '├── ';
                $arrLines[$level + 1] = '|   ';
            }
            $very_first_item = false;
            for ($iCnt = 1; $iCnt <= $level; $iCnt++) {
                $output .= $arrLines[$iCnt];
            }
            $output .= $prefix . $key . makeList($subArray, $level + 1, $very_first_item);
            $count++;
        }

        return $output;
    }