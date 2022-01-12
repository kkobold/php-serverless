<?php
require __DIR__ . '/../../vendor/autoload.php';

return function ($event, $context) {
    echo "Event: ". json_encode($event, true);
    echo "Context: ". json_encode($context, true);
};