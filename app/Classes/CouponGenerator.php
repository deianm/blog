<?php

namespace App\Classes;

class CouponGenerator {

    CONST MIN_LENGTH = 8;

    /**
     * MASK FORMAT [XXX-XXX]
     * 'X' this is random symbols
     * '-' this is separator
     *
     * @param array $options
     *
     * @return string
     * @throws Exception
     */
    static public function generate( $r_length, $r_prefix, $r_suffix, $r_numbers, $r_letters, $r_symbols, $r_random_register, $r_mask ) {

        $length       = ( isset( $r_length ) ? filter_var( $r_length, FILTER_VALIDATE_INT, [
            'options' => [
                'default'   => self::MIN_LENGTH,
                'min_range' => 1
            ]
        ] ) : self::MIN_LENGTH );
        $prefix       = ( isset( $r_prefix ) ? self::cleanString( filter_var( $r_prefix, FILTER_SANITIZE_STRING ) ) : '' );
        $suffix       = ( isset( $r_suffix ) ? self::cleanString( filter_var( $r_suffix, FILTER_SANITIZE_STRING ) ) : '' );
        $useLetters   = ( isset( $r_letters ) ? filter_var( $r_letters, FILTER_VALIDATE_BOOLEAN ) : true );
        $useNumbers   = ( isset( $r_numbers ) ? filter_var( $r_numbers, FILTER_VALIDATE_BOOLEAN ) : false );
        $useSymbols   = ( isset( $r_symbols ) ? filter_var( $r_symbols, FILTER_VALIDATE_BOOLEAN ) : false );
        $useMixedCase = ( isset( $r_random_register ) ? filter_var( $r_random_register, FILTER_VALIDATE_BOOLEAN ) : false );
        $mask         = ( isset( $r_mask ) ? filter_var( $r_mask, FILTER_SANITIZE_STRING ) : false );


        $uppercase = [
            'Q',
            'W',
            'E',
            'R',
            'T',
            'Y',
            'U',
            'I',
            'O',
            'P',
            'A',
            'S',
            'D',
            'F',
            'G',
            'H',
            'J',
            'K',
            'L',
            'Z',
            'X',
            'C',
            'V',
            'B',
            'N',
            'M'
        ];
        $lowercase = [
            'q',
            'w',
            'e',
            'r',
            't',
            'y',
            'u',
            'i',
            'o',
            'p',
            'a',
            's',
            'd',
            'f',
            'g',
            'h',
            'j',
            'k',
            'l',
            'z',
            'x',
            'c',
            'v',
            'b',
            'n',
            'm'
        ];
        $numbers   = [ 0, 1, 2, 3, 4, 5, 6, 7, 8, 9 ];
        $symbols   = [
            '`',
            '~',
            '!',
            '@',
            '#',
            '$',
            '%',
            '^',
            '&',
            '*',
            '(',
            ')',
            '-',
            '_',
            '=',
            '+',
            '\\',
            '|',
            '/',
            '[',
            ']',
            '{',
            '}',
            '"',
            "'",
            ';',
            ':',
            '<',
            '>',
            ',',
            '.',
            '?'
        ];

        $characters = [ ];
        $coupon     = '';

        if ( $useLetters ) {
            if ( $useMixedCase ) {
                $characters = array_merge( $characters, $lowercase, $uppercase );
            } else {
                $characters = array_merge( $characters, $uppercase );
            }
        }

        if ( $useNumbers ) {
            $characters = array_merge( $characters, $numbers );
        }

        if ( $useSymbols ) {
            $characters = array_merge( $characters, $symbols );
        }

        if ( $mask ) {
            for ( $i = 0; $i < strlen( $mask ); $i ++ ) {
                if ( $mask[ $i ] === 'X' ) {
                    $coupon .= $characters[ mt_rand( 0, count( $characters ) - 1 ) ];
                } else {
                    $coupon .= $mask[ $i ];
                }
            }
        } else {
            for ( $i = 0; $i < $length; $i ++ ) {
                $coupon .= $characters[ mt_rand( 0, count( $characters ) - 1 ) ];
            }
        }

        return $prefix . $coupon . $suffix;
    }

    /**
     * @param int $maxNumberOfCoupons
     * @param array $options
     *
     * @return array
     */
    static public function generate_coupons( $no_of_coupons, $length, $prefix, $suffix, $numbers, $letters, $symbols, $random_register, $mask ) {
        $coupons = [ ];
        for ( $i = 0; $i < $no_of_coupons; $i ++ ) {
            $temp      = self::generate( $length, $prefix, $suffix, $numbers, $letters, $symbols, $random_register, $mask );
            $coupons[] = $temp;
        }

        return $coupons;
    }


    /**
     * Strip all characters but letters and numbers
     *
     * @param $string
     * @param array $options
     *
     * @return string
     * @throws Exception
     */
    static private function cleanString( $string, $options = [ ] ) {
        $toUpper = ( isset( $options['uppercase'] ) ? filter_var( $options['uppercase'], FILTER_VALIDATE_BOOLEAN ) : false );
        $toLower = ( isset( $options['lowercase'] ) ? filter_var( $options['lowercase'], FILTER_VALIDATE_BOOLEAN ) : false );

        $striped = preg_replace( '/[^a-zA-Z0-9]/', '', $string );

        // make uppercase
        if ( $toLower && $toUpper ) {
            throw new Exception( 'You cannot set both options (uppercase|lowercase) to "true"!' );
        } else if ( $toLower ) {
            return strtolower( $striped );
        } else if ( $toUpper ) {
            return strtoupper( $striped );
        } else {
            return $striped;
        }
    }
}