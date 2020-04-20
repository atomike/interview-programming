<?php
function withoutNamedParameters(){
    var_dump(func_get_args());
}

withoutNamedParameters(1,"2", "Hello");
?>
