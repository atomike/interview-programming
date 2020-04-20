<?php
function curry_n(int $count, callable $fn, $args=[]) {
  //This is a function that returns functions with optional parameters to absorb zero or more paramenters
  //until the number of parameters absorbed is equal to count
  //i.e add($a, $b, $c, $d) takes 4 parameters
  //$curryAdd = curry_n(4, 'add')
  //$curryAdd(...)(...)(...)...
  //i.e curryAdd()(1,2)(3)(4)

  $absorber = function(array $args) use ($count, $fn, &$absorber) {
    if( count($args) >= $count ){
      return call_user_func_array($fn, $args);
    }

    return function() use($args, $count, $fn, $absorber) {
      //Take the parameters from the previous call and merge them with the parameters in this call
      $args = array_merge($args, func_get_args() );

      if( count($args) == $count ){
        //If we absorbed all the parameters required by $fn then execute it
        return call_user_func_array($fn, $args);
      }

      //Continue absorbing
      return $absorber($args);
    };
  };

  return $absorber($args);
}

function curryPartial($fn, ...$args) {
  $fn_ref = new ReflectionFunction($fn);
  $fn_arg_count = $fn_ref->getNumberOfParameters();
  return curry_n( $fn_arg_count, $fn, $args);
}
