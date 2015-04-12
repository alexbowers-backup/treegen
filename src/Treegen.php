<?php namespace Treegen;

class Treegen
{
    private $nested_string;
    private $nested_array;
    private $indent_width       = 4;
    private $single_parent_node = '';
    private $end_node           = '└──';
    private $top_node           = '┌──';
    private $middle_child_node  = '├──';
    private $middle_node        = '|';
    private $empty_node         = '';
    private $indentation        = '    ';
    private $depth;
    
    /**
     * @return string
     */
    public function getEmptyNode()
    {
        return $this->empty_node;
    }

    /**
     * @param string $empty_node
     */
    public function setEmptyNode($empty_node)
    {
        $this->empty_node = $empty_node;
    }

    /**
     * @return int
     */
    public function getIndentation()
    {
        return $this->indentation;
    }

    /**
     * @param int $indentation
     */
    public function setIndentation($indentation)
    {
        $this->indentation = $indentation;
    }

    /**
     * @return int
     */
    public function getIndentWidth()
    {
        return $this->indent_width;
    }

    /**
     * @param int $indent_width
     */
    public function setIndentWidth($indent_width)
    {
        $this->indent_width = $indent_width;
    }

    /**
     * @return string
     */
    public function getSingleParentNode()
    {
        return $this->single_parent_node;
    }

    /**
     * @param string $single_parent_node
     */
    public function setSingleParentNode($single_parent_node)
    {
        $this->single_parent_node = $single_parent_node;
    }

    /**
     * @return string
     */
    public function getEndNode()
    {
        return $this->end_node;
    }

    /**
     * @param string $end_node
     */
    public function setEndNode($end_node)
    {
        $this->end_node = $end_node;
    }

    /**
     * @return string
     */
    public function getTopNode()
    {
        return $this->top_node;
    }

    /**
     * @param string $top_node
     */
    public function setTopNode($top_node)
    {
        $this->top_node = $top_node;
    }

    /**
     * @return string
     */
    public function getMiddleChildNode()
    {
        return $this->middle_child_node;
    }

    /**
     * @param string $middle_child_node
     */
    public function setMiddleChildNode($middle_child_node)
    {
        $this->middle_child_node = $middle_child_node;
    }

    /**
     * @return string
     */
    public function getMiddleNode()
    {
        return $this->middle_node;
    }

    /**
     * @param string $middle_node
     */
    public function setMiddleNode($middle_node)
    {
        $this->middle_node = $middle_node;
    }

    /**
     * @return mixed
     */
    public function getNestedString()
    {
        return $this->nested_string;
    }

    /**
     * @param mixed $nested_string
     */
    public function setNestedString($nested_string)
    {
        $this->nested_string = $nested_string;
    }

    private function stringToArray()
    {
        $result = [];
        $path = [];
        $list = $this->getNestedString();

        foreach (explode("\n", $list) as $line) {
            // get depth and label
            $depth = 0;
            while (substr($line, 0, strlen($this->indentation)) === $this->indentation) {
                $depth += 1;
                $line = substr($line, strlen($this->indentation));
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

        $this->nested_array = $result;
    }

    /**
     * Get the depth of an array
     *
     * @internal Thanks to Jeremy Ruten: http://stackoverflow.com/a/262944/1111274
     *
     * @param array $array
     */
    private function array_depth(array $array)
    {
        $max_depth = 1;

        foreach ($array as $value) {
            if (is_array($value)) {
                $depth = $this->array_depth($value) + 1;

                if ($depth > $max_depth) {
                    $max_depth = $depth;
                }
            }
        }

        $this->depth = [$max_depth];
    }

    private function format(array $array, $level = 0, $very_first_item = true)
    {
        $output = "\n";
        $count = 0;
        foreach ($array as $key => $subArray) {
            if ($count == count($array) - 1 && $very_first_item) {
                $prefix = '';
                $level = -1;
            } elseif ($count == count($array) - 1) {
                $prefix = $this->mb_str_pad($this->end_node, $this->indent_width);
                $this->depth[$level + 1] = $this->mb_str_pad($this->empty_node, $this->indent_width);;
            } elseif ($very_first_item === true) {
                $prefix = $this->mb_str_pad($this->top_node, $this->indent_width);
                $this->depth[$level + 1] = $this->mb_str_pad($this->middle_node, $this->indent_width);;
            } else {
                $prefix = $this->mb_str_pad($this->middle_child_node, $this->indent_width);
                $this->depth[$level + 1] = $this->mb_str_pad($this->middle_node, $this->indent_width);;
            }
            $very_first_item = false;
            for ($iCnt = 1; $iCnt <= $level; $iCnt++) {
                $output .= $this->depth[$iCnt];
            }
            $output .= $prefix . $key . $this->format($subArray, $level + 1, $very_first_item);
            $count++;
        }

        return $output;
    }

    public function __toString()
    {
        return $this->getString();
    }

    public function getString()
    {
        if (empty($this->nested_string)) {
            $this->setNestedString('');
        }

        $this->stringToArray();

        $this->array_depth($this->nested_array);

        return $this->format($this->nested_array);
    }

    /**
     * @param        $input
     * @param        $pad_length
     * @param        $pad_string
     * @param        $pad_style
     * @param string $encoding
     *
     * @internal Credt goes to Mitgath: http://php.net/manual/en/ref.mbstring.php#90611
     *
     * @internal Has been modified to match the str_pad defaults
     *
     * @return string
     */
    private function mb_str_pad($input, $pad_length, $pad_string = ' ', $pad_style = STR_PAD_RIGHT, $encoding = "UTF-8")
    {
        return str_pad($input, strlen($input) - mb_strlen($input, $encoding) + $pad_length, $pad_string, $pad_style);
    }
}