# Jsonc
Simple script to convert files from custom to well-formed JSON.

## Introduction
Ever wanted to use **comments** and **trailing** commas into JSON files?

The JSON format will undoubtedly evolve to let us use comments, trailing commas
and other desirable features, like the ones described in
[JSON5](http://json5.org/).

In the meanwhile I wrote a script which converts a JSON file with comments and
trailing comments into a well-formed JSON file.

## Installation
Download the latest stable Jsonc script from the server:

    https://raw.githubusercontent.com/aleron75/jsonc/master/jsonc.php

You can optionally generate the
[MD5 checksum](https://en.wikipedia.org/wiki/Md5sum) using:

    md5sum jsonc.php

and verify the download by comparing the obtained checksum using the following
table:

| version                | MD5                            |
|------------------------|--------------------------------|
| latest (branch: master)|e689ed92a529048e10ba79ee08a6850a|

Make the script executable:

    chmod +x ./jsonc.php

Make the script system wide executable:

    sudo cp ./jsonc.php /usr/local/bin/jsonc

Verify the installation by typing:

    jsonc --help

You should obtain something like:

    Jsonc 1.0.0 by aleron75 and contributors

    Usage:   jsonc [options] [filename_without_extension]
    e.g.:	jsonc -f # convert composer.jsonc into composer.json
    e.g.:	jsonc -f myjsonfile # convert myjsonfile.jsonc into myjsonfile.json

    Options:

    	-f|--force	Force the overwriting of existing <filename_without_extension>.json

    Miscellaneous:

    	-h|--help	Display this help screen    

## Usage
The script expects you have a `yourfilename.jsonc` to process.

A `jsonc` file is a file in JSON format in which you can have:

* lines starting with `#` - represent lines to ignore
* trailing ',' on last property of an object
* trailing ',' on last element of a list

Run the script with the `yourfilename` (without extension) parameter and it will
generate a yourfilename.json` well-formed file.

Example

    jsonc yourfilename

Will search for `yourfilename.jsonc` file and generate `yourfilename.json` file.

Since the main reason I created this script was to have the ability to
comment-out lines in `composer.json` files, if you don't specify the
`yourfilename` parameter, a default `composer` will be used.

Example

    jsonc

Will search for `composer.jsonc` file and generate `composer.json` file.

In case the output file already exists, the script won't overwrite it
unless you force overwrite through the `-f` or `--force` option.

## Releases
Please, refer to the [CHANGELOG](CHANGELOG.md) file for information about
current releases.

## Contributing
Contributions are welcome and can be done using the fork & pull model.

This contribution model requires contributors maintaining their own copy of the
forked codebase [keeping it synced](https://help.github.com/articles/syncing-a-fork/)
with the main copy.

The forked repository can then be used to [submit a pull request](https://help.github.com/articles/creating-a-pull-request/) to the base
repository.

Contributions can take the form of new features, changes to existing features,
tests, documentation, bug fixes, optimizations and suggestions.

Contributions will be reviewed in *first in, first out* order and contributors
may be asked some clarifications by repository maintainer.

In case of requests by maintainers without response from contributors for two
weeks the pull request may be closed without merging.

## Copyright and license
This script is copyright © Alessandro Ronchi and licensed for use under the Open
Source License 3.0 (OSL-3.0). Please refer to [LICENSE](LICENSE.txt) file for
more information.
