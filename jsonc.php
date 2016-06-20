#!/usr/bin/php
<?php
$version = '1.0.0';

$arguments = array_slice($argv, 1);
$options = array_filter(
    $arguments,
    function($item) {
        return preg_match('/^[\-\-|\-]([\w\d_-]{1,})$/', $item);
    }
);

$printHelp = in_array('--help', $options) || in_array('-h', $options);

if ($printHelp) {
    echo 'Jsonc ', $version, ' by aleron75 and contributors', PHP_EOL, PHP_EOL;
    echo 'Usage:', "\t", 'jsonc [options] [filename_without_extension]', PHP_EOL;
    echo 'e.g.:', "\t", 'jsonc -f # convert composer.jsonc into composer.json', PHP_EOL;
    echo 'e.g.:', "\t", 'jsonc -f myjsonfile # convert myjsonfile.jsonc into myjsonfile.json', PHP_EOL, PHP_EOL;
    echo 'Options:', PHP_EOL, PHP_EOL;
    echo "\t", '-f|--force', "\t", 'Force the overwriting of existing <filename_without_extension>.json', PHP_EOL, PHP_EOL;
    echo 'Miscellaneous:', PHP_EOL, PHP_EOL;
    echo "\t", '-h|--help', "\t", 'Display this help screen', PHP_EOL;
    exit(1);
}

$overwrite = in_array('--force', $options) || in_array('-f', $options);

$parameters = array_diff($arguments, $options);

$filename = 'composer';
if (count($parameters)) {
    $filename = array_shift($parameters);
}

$inputFilename = $filename . '.jsonc';
if (!file_exists($inputFilename)) {
    echo 'File \'', $inputFilename, '\' not found', PHP_EOL;
    exit(1);
}

$outputFilename = $filename . '.json';
if (file_exists($outputFilename) && !$overwrite) {
    echo 'File \'', $outputFilename, '\' already exists; use -f or --force to overwrite', PHP_EOL, PHP_EOL;
    exit(1);
}

$content = file_get_contents($inputFilename);

// remove lines starting with #
$pattern = '/(\s*\t*#.*)/';
$content = preg_replace($pattern, '', $content);

// remove trailing ',' on last property of an object
$pattern = '/,([\n\r\s\t]+[}]{1})/';
$content = preg_replace($pattern, '$1', $content);

// remove trailing ',' on last element of a list
$pattern = '/,([\n\r\s\t]+[\]]{1})/';
$content = preg_replace($pattern, '$1', $content);

file_put_contents($outputFilename, $content);

echo 'Generated \'', $outputFilename, '\' file', PHP_EOL;
