<?php

echo "Float with 6 decimal places precision\n";
echo sprintf("%.6f", pi());

echo "\n\n";

echo "Now with left padding of dots\n";
echo sprintf("%'.96f", pi());

echo "\n\n";

echo "Integer 3 with 2 decimal padding\n";
echo sprintf("%.2f", 3);

echo "\n\n";

echo "Any number with three zeroes at the end\n";
echo sprintf("%d000", 48);
?>
