<?php

function dump($value, $name='') {
    echo '<div class="jumbotron">';
    echo '<strong>' . $name . '</strong>';    
    echo '<pre>';
    var_dump($value);
    echo '</pre>';
    echo '</div>';
}


function dnd($value, $name='') {
    echo '<div class="jumbotron">';
    echo '<strong>' . $name . '</strong>';    
    echo '<pre>';
    var_dump($value);
    echo '</pre>';
    echo '</div>';
    die();
}