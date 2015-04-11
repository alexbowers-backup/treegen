<?php namespace Treegen;

class Treegen
{
    private $nested_string;
    private $nested_array;
    private $indent_width = 4;
    private $single_parent_node = '';
    private $end_node = '└──';
    private $top_node = '┌──';
    private $middle_child_node = '├──';
    private $middle_node = '|';

    /**
     * @return mixed
     */
    protected function getNestedArray()
    {
        return $this->nested_array;
    }

    /**
     * @param mixed $nested_array
     */
    protected function setNestedArray($nested_array)
    {
        $this->nested_array = $nested_array;
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
}