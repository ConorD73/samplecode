<?php
//First function to remove log segment from message
function taskOne()
{
    // message
    $message =
        "UNA:+.? " .
        "UNB+UNOC:3+2021000969+4441963198+180525:1225+3VAL2MJV6EH9IX+KMSV7HMD+CUSDECU-IE++1++1" .
        "UNH+EDIFACT+CUSDEC:D:96B:UN:145050" .
        "BGM+ZEM:::EX+09SEE7JPUV5HC06IC6+Z" .
        "LOC+17+IT044100" .
        "LOC+18+SOL" .
        "LOC+35+SE" .
        "LOC+36+TZ" .
        "LOC+116+SE003033" .
        "DTM+9:20090527:102" .
        "DTM+268:20090626:102" .
        "DTM+182:20090527:102";

    // Here we use a built in php function called str replace to scan through the message var and remove all instances of "LOC" 
    $delimitedMessage = str_replace("LOC", '', $message);

    // We then define a new var and use the php function to explode the string so we can break it into smaller peices and set the delimiter to +
    $delimitedMessage = explode('+', $message);
    // We then define a var called output to populate all the results into an array
    $output = [];

    // This function accepts 2 values string and offset we then use a php function called string rev to reverse the string and offset to pick the specific segments to print
    function getNth($string, $offset)
    {
        $string = strrev($string);
        // We then return the value
        return $string[$offset];
    }
    // This foreach loop will then loop through the split up message
    foreach ($delimitedMessage as $element) {
        //We then push the values into the output array and call the getNth function to pick specific chara of each string to add to the array
        array_push($output, getNth($element, 2), getNth($element, 3));
    };

    // We then print the values on screen
    print_r($output);
}

// Task 2 looping through an xml document and printing out the secific hrefs based on a value
function task2()
{
    $xml = simplexml_load_file('./file1.xml');

    $show = simplexml_load_file($xml);
// Document coming back as invalid need to fix!

    print_r($show);
};

// Task 3 function to read xml as input and perform specific functions based on values
function taskThree()
{
    $xml = simplexml_load_file('./file2.xml');
    // We loop through the xml object to see if the DeclarationList Declaration ["Command"] is set to default
    foreach ($xml->DeclarationList as $declaration) {
        if ($declaration->Declaration["Command"] == "DEFAULT") {
            echo '<br/> - 1';
        };
        // Here we check if the siteID is = 'DUB' and if it is we return -2
        if ($declaration->Declaration->DeclarationHeader->SiteID == "DUB") {
            echo '<br/>-2';
        };
    }
    // Here we check to see if the XML document is valid if so return 0
    if ($xml instanceof SimpleXMLElement) {
        echo '<br/>XML documnet is valid';
        return 0;
    }
};
// Here we call each function
taskOne();
taskThree();
