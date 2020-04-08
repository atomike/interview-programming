<?php
class node {
    public $value;
    public $left=NULL, $right=NULL;

    function __construct($value){
        $this->value = $value;
    }

    function addNode($node_value){
        echo "Entered node $this->value\n";
        if($node_value > $this->value){
            if($this->left == NULL){
                echo "Adding node $node_value to the left of node $this->value\n\n";
                $this->left = new node($node_value);
            }
            else{
                echo "Left node is used\n";
                $this->left->addNode($node_value);
            }
        }
        else{
            if($this->right == NULL){
                echo "Adding node $node_value to the right of node $this->value\n\n";
                $this->right = new node($node_value);
            }
            else{
                echo "Right node is used\n";
                $this->right->addNode($node_value);
            }
        }
    }

    function branchSize(){
        $leftSize = ($this->left==NULL)?0:$this->left->branchSize();
        $rightSize = ($this->right==NULL)?0:$this->right->branchSize();
        return $this->value + $leftSize + $rightSize;
    }
}

class binaryTree {
    public $root=NULL;

    public function addNode($node_value){
        if($this->root == NULL){
            echo "Adding root node $node_value\n\n";
            $this->root = new node($node_value);
        }
        else{
            echo "Adding node $node_value to tree\n";
            $this->root->addNode($node_value);
        }
    }

    public function leftBranchSize(){
        if($this->root->left == NULL){return 0;}
        return $this->root->left->branchSize();
    }

    public function rightBranchSize(){
        if($this->root->right == NULL){return 0;}
        return $this->root->right->branchSize();
    }
}

function solution($arr) {
    $bt = new binaryTree();

    foreach($arr as $node_value){
        $bt->addNode($node_value);
    }

    $leftBranchSize = $bt->leftBranchSize();
    $rightBranchSize = $bt->rightBranchSize();

    echo "Left: $leftBranchSize, Right: $rightBranchSize\n";
}

solution( [3, 6, 2, 9, 10] );
?>
