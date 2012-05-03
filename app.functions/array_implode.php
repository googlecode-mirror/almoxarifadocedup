<?php

/**
 * Implode an array with the key and value pair giving
 * a glue, a separator between pairs and the array
 * to implode.
 * @param string $glue The glue between key and value
 * @param string $separator Separator between pairs
 * @param array $array The array to implode
 * @return string The imploded array
 */
function array_implode( $glue, $separator, $array ){
    if ( ! is_array( $array ) ) return $array;
    $string = array();
    foreach ( $array as $key => $val ) {
        if ( is_array( $val ) )
            $val = implode( ',', $val );
        if ( is_string( $val ) )
            $val = "'".$val."'";
        $string[] = "{$key}{$glue}{$val}";
        
    }
    return implode( $separator, $string );
}
?>
