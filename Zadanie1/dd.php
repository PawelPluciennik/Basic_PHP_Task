<?php

function dd(...$args) {
    echo '<pre>';
    var_dump($args);
    echo '</pre>';
}