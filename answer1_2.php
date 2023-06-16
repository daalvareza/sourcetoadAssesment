<?php
$data = 
[
    [
        'guest_id' => 177,
        'guest_type' => 'crew',
        'first_name' => 'Marco',
        'middle_name' => null,
        'last_name' => 'Burns',
        'gender' => 'M',
        'guest_booking' => [
            [
                'booking_number' => 20008683,
                'ship_code' => 'OST',
                'room_no' => 'A0073',
                'start_time' => 1438214400,
                'end_time' => 1483142400,
                'is_checked_in' => true,
            ],
        ],
        'guest_account' => [
            [
                'account_id' => 20009503,
                'status_id' => 2,
                'account_limit' => 0,
                'allow_charges' => true,
            ],
        ],
    ],
    [
        'guest_id' => 10000113,
        'guest_type' => 'crew',
        'first_name' => 'Bob Jr ',
        'middle_name' => 'Charles',
        'last_name' => 'Hemingway',
        'gender' => 'M',
        'guest_booking' => [
            [
                'booking_number' => 10000013,
                'room_no' => 'B0092',
                'is_checked_in' => true,
            ],
        ],
        'guest_account' => [
            [
                'account_id' => 10000522,
                'account_limit' => 300,
                'allow_charges' => true,
            ],
        ],
    ],
    [
        'guest_id' => 10000114,
        'guest_type' => 'crew',
        'first_name' => 'Al ',
        'middle_name' => 'Bert',
        'last_name' => 'Santiago',
        'gender' => 'M',
        'guest_booking' => [
            [
                'booking_number' => 10000014,
                'room_no' => 'A0018',
                'is_checked_in' => true,
            ],
        ],
        'guest_account' => [
            [
                'account_id' => 10000013,
                'account_limit' => 300,
                'allow_charges' => false,
            ],
        ],
    ],
    [
        'guest_id' => 10000115,
        'guest_type' => 'crew',
        'first_name' => 'Red ',
        'middle_name' => 'Ruby',
        'last_name' => 'Flowers ',
        'gender' => 'F',
        'guest_booking' => [
            [
                'booking_number' => 10000015,
                'room_no' => 'A0051',
                'is_checked_in' => true,
            ],
        ],
        'guest_account' => [
            [
                'account_id' => 10000519,
                'account_limit' => 300,
                'allow_charges' => true,
            ],
        ],
    ],
    [
        'guest_id' => 10000116,
        'guest_type' => 'crew',
        'first_name' => 'Ismael ',
        'middle_name' => 'Jean-Vital',
        'last_name' => 'Jammes',
        'gender' => 'M',
        'guest_booking' => [
            [
                'booking_number' => 10000016,
                'room_no' => 'A0023',
                'is_checked_in' => true,
            ],
        ],
        'guest_account' => [
            [
                'account_id' => 10000015,
                'account_limit' => 300,
                'allow_charges' => true,
            ],
        ],
    ],
];

/**
 * Function to print each element in an array, adding indentation for nested elements
 * It is designed to be called by the console, not by the browser.
 * @param array $array array to be printed
 * @param string $indent string to mark the indentation (usually blank spaces)
 * @param bool $isNested flag to differentiate the top-level array
 */
function printArray(array $array, string $indent = '    ', bool $isNested = false) {
    // The top-level array starts with a "[", but nested arrays don't
    echo ($isNested ? "" : "[" . "\n");
    foreach ($array as $key => $value) {
        if (is_array($value)) {
            // For arrays, print the key (if it's not numeric) and a "[" to mark the beginning of a nested array
            if (!is_numeric($key)) {
                echo $indent . $key . " => [" . "\n";
            } else {
                echo $indent . "[" . "\n";
            }
            // Print the contents of the array, increasing the indentation
            printArray($value, $indent . '    ', true);
            // Mark the end of a nested array
            echo $indent . "]," . "\n";
        } else {
            // For non-array values, just print the key and the value and validates the null values
            echo $indent . $key . ' => ' . ($value === null ? 'NULL' : $value) . "\n";
        }
    }
    // The top-level array ends with a "]", but nested arrays don't
    echo ($isNested ? "" : "]");
}

/**
 * Function to sort an array by one or more keys regardless of what level it is at
 * It works directly with the array, not a copy, so, the original value will be modify it
 * @param array $array array to be sorted, passed by reference
 * @param array|string $sortKeys array with the string keys with which the ordering will be done (or just a string with one key)
 */
function recursiveSort(array &$array, array|string $sortKeys) {
    // If we're only given one key, turn it into an array so we can use the same logic for all cases
    if (!is_array($sortKeys)) {
        $sortKeys = [$sortKeys];
    }

    // Sort the array, comparing the specified keys in order
    uasort($array, function ($a, $b) use ($sortKeys) {
        foreach ($sortKeys as $sortKey) {
            // Get the values for this key from the two elements being compared
            $aVal = getValue($a, $sortKey);
            $bVal = getValue($b, $sortKey);

            // If the values are the same, move on to the next key
            if ($aVal == $bVal) {
                continue;
            }

            // Otherwise, return the result of the comparison
            return ($aVal < $bVal) ? -1 : 1;
        }

        // If we've compared all keys and found no differences, the array keeps the same
        return 0;
    });

    // Recursively sort nested arrays
    foreach ($array as &$value) {
        if (is_array($value)) {
            recursiveSort($value, $sortKeys);
        }
    }
}

/**
 * Function that retrieves a value from an array by key, searching in the nested arrays too
 * @param mixed $array array with the value to extract, if is not an array the function will return null
 * @param string $key string key associated with the value to extract
 * @return mixed value extracted from the array
 */
function getValue(mixed $array, string $key) {
    // If the key exists in this array, return the value
    if (isset($array[$key])) {
        return $array[$key];
    }

    // If not, check any nested arrays
    if (is_array($array)){
        foreach ($array as $value) {
            if (is_array($value)) {
                $nestedVal = getValue($value, $key);
                // If we found the key in a nested array, return the value
                if ($nestedVal !== null) {
                    return $nestedVal;
                }
            }
        }
    }

    // If the key wasn't found, return null
    return null;
}

$sortKeys = ['last_name', 'account_id'];
recursiveSort($data, $sortKeys);
printArray($data);
?>