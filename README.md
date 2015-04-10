# treegen
A text based tree generator for use in documents.

## Example Input

Level 0 Child 1
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

## Example Output

┌── Level 0 Child 1
├── Level 0 Child 2
|   ├── Level 1 Child 1
|   |   └── Level 1 Child 1 Grandchild 1
|   └── Level 1 Child 2
|   |   ├── Level 1 Child 2 Grandchild 1
|   |   |   ├── Level 1 Child 2 Grandchild 1 Great-grandchild 1
|   |   |   ├── Level 1 Child 2 Grandchild 1 Great-grandchild 2
|   |   |   └── Level 1 Child 2 Grandchild 1 Great-grandchild 3
|   |   └── Level 1 Child 2 Grandchild 2
|   |   |   └── Level 1 Child 2 Grandchild 2 Great-grandchild 1
└──

## Still under active development. Will work on cleaning up code, and output.