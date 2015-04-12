<?php
    use Treegen\Treegen;

require "vendor/autoload.php";

    $tree = "Level 0 Child 1
Level 0 Child 2
    Level 1 Child 1
        Level 1 Child 1 Grandchild 1
    Level 1 Child 2
        Level 1 Child 2 Grandchild 1
            Level 1 Child 2 Grandchild 1 Great-grandchild 1
            Level 1 Child 2 Grandchild 1 Great-grandchild 2
            Level 1 Child 2 Grandchild 1 Great-grandchild 3
        Level 1 Child 2 Grandchild 2
            Level 1 Child 2 Grandchild 2 Great-grandchild 1";

    $treegen = new Treegen();
    $treegen->setNestedString($tree);

    echo '<pre>';
    echo '<meta charset="UTF-8" />';
    echo $treegen;
    echo '</pre>';
