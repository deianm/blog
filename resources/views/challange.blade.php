<?php

//Name of the file from the directory
$filename = 'macbeth.txt';
//Turns the whole file into a string
$data = file_get_contents($filename);
//Removes ALL punctuation for count accuracy
$data = preg_replace('/[^a-z0-9]+/i', ' ', $data);
//Removes ALL single characters
$data = preg_replace('/\b\w\b\s?/', '', $data);
//Turns ALL words into lowercase for count accuracy
$data =  strtolower( $data);
//Joins array elements with a string AND returns words only with 5 or more characters
$data = implode(" ", array_filter(explode(" ", $data), function($item) {

    return strlen($item) >= 5;

}));

//Save the .txt file with the updated format
file_put_contents($filename, $data);
//Reopens the file as a string again
$string = file_get_contents('macbeth.txt');
//Splits the string with a regex
$array = preg_split( '/\s+/', $string);
//Counts all the values from an array
$count = array_count_values($array);
//Sorts it from HIGHEST to LOWEST helps find 2nd common word used
arsort($count);
//Limits how many keys will be shown you can change the 10 to more or less
$count = array_slice($count, 0, 10);
//RESULTS!!! Under here!
echo '<pre>';


print_r($count);

echo array_keys($count)[1] . ' ' . '->' . ' ' . next($count);


