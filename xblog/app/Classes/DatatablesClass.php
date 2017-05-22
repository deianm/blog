<?php

namespace App\Classes;

use DB;

class DatatablesClass {
    /**
     * Create the data output array for the DataTables rows
     *
     *  @param  array $columns Column information array
     *  @param  array $data    Data from the SQL get
     *  @return array          Formatted data in a row based format
     */
    static function data_output ( $columns, $data )
    {
        $out = array();
        for ( $i=0, $ien=count($data) ; $i<$ien ; $i++ ) {
            $row = array();
            for ( $j=0, $jen=count($columns) ; $j<$jen ; $j++ ) {
                $column = $columns[$j];
                // Is there a formatter?
                if ( isset( $column['formatter'] ) ) {
                    $row[ $column['dt'] ] = $column['formatter']( $data[$i]->{$column['db']}, $data[$i] );
                }
                else {
                    $label = explode('.',$columns[$j]['db']);
                    if(count($label) == 2)
                        $label = $label[1];
                    else
                        $label = $label[0];
                    $row[ $column['dt'] ] = $data[$i]->{$label};
                }
            }
            $out[] = $row;
        }
        return $out;
    }

    /**
     * Paging
     *
     * Construct the LIMIT clause for server-side processing SQL query
     *
     *  @param  array $request Data sent to server by DataTables
     *  @return string SQL limit clause
     */
    static function limit ( $request )
    {
        $limit = '';
        if ( isset($request['start']) && $request['length'] != -1 ) {
            $limit = "LIMIT ".intval($request['start']).", ".intval($request['length']);
        }
        return $limit;
    }

    /**
     * Paging
     *
     * Construct the LIMIT clause for server-side processing SQL query
     *
     *  @param  array $request Data sent to server by DataTables
     *  @return string SQL limit clause
     */
    static function join ( $joins )
    {
        $all_joins = '';
        if ( count($joins) ) {
            foreach ($joins as $join){
                $all_joins .= $join['type'] . " JOIN " . $join['table'] . " ON " . $join['left_table'] . " = " . $join['right_table'] . "\n";
            }
        }
        return $all_joins;
    }
    /**
     * Ordering
     *
     * Construct the ORDER BY clause for server-side processing SQL query
     *
     *  @param  array $request Data sent to server by DataTables
     *  @param  array $columns Column information array
     *  @return string SQL order by clause
     */
    static function order ( $request, $columns )
    {
        $order = '';
        if ( isset($request['order']) && count($request['order']) ) {
            $orderBy = array();
            $dtColumns = self::pluck( $columns, 'dt' );
            for ( $i=0, $ien=count($request['order']) ; $i<$ien ; $i++ ) {
                // Convert the column index into the column data property
                $columnIdx = intval($request['order'][$i]['column']);
                $requestColumn = $request['columns'][$columnIdx];
                $columnIdx = array_search( $requestColumn['data'], $dtColumns );
                $column = $columns[ $columnIdx ];
                if ( $requestColumn['orderable'] == 'true' ) {
                    $dir = $request['order'][$i]['dir'] === 'asc' ?
                        'ASC' :
                        'DESC';
                    $orderBy[] = $column['db'].' '.$dir;
                }
            }
            $order = 'ORDER BY '.implode(', ', $orderBy);
        }
        return $order;
    }

    /**
     * Searching / Filtering
     *
     * Construct the WHERE clause for server-side processing SQL query.
     *
     * NOTE this does not match the built-in DataTables filtering which does it
     * word by word on any field. It's possible to do here performance on large
     * databases would be very poor
     *
     *  @param  array $request Data sent to server by DataTables
     *  @param  array $columns Column information array
     *  @param  array $bindings Array of values for PDO bindings, used in the
     *  @param  array $init
     *  @param  boolean $forceInit force the init filter.
     *    sql_exec() function
     *  @return string SQL where clause
     */
    static function filter ( $request, $columns, &$bindings, $init = [], $forceInit )
    {
        $globalSearch = array();
        $columnSearch = array();
        $initSearch = array();

        $dtColumns = self::pluck( $columns, 'dt' );
        if ( isset($request['search']) && $request['search']['value'] != '' ) {
            $str = $request['search']['value'];
            for ( $i=0, $ien=count($request['columns']) ; $i<$ien ; $i++ ) {
                $requestColumn = $request['columns'][$i];
                $columnIdx = array_search( $requestColumn['data'], $dtColumns );
                $column = $columns[ $columnIdx ];
                if ( $requestColumn['searchable'] == 'true' ) {
                    $globalSearch[] = $column['db']." LIKE '%".$str."%'";
                }
            }
        }
        // Individual column filtering
        if ( isset( $request['columns'] ) ) {
            for ( $i=0, $ien=count($request['columns']) ; $i<$ien ; $i++ ) {
                $requestColumn = $request['columns'][$i];
                $columnIdx = array_search( $requestColumn['data'], $dtColumns );
                $column = $columns[ $columnIdx ];
                $str = $requestColumn['search']['value'];
                $multiSearch = explode('|',$str);  //interprete the slash as or symbol.

                if ( $requestColumn['searchable'] == 'true' &&
                    $str != '' ) {
                    if(count($multiSearch) == 1)
                        $columnSearch[] = $column['db']." LIKE '%".$str."%'";
                    else {
                        $sql = "(".$column['db']." LIKE '%".$multiSearch[0]."%'";
                        for($j=1, $jen=count($multiSearch); $j<$jen; $j++) {
                            $sql .= " OR ".$column['db']." LIKE '%".$multiSearch[$j]."%'";
                        }
                        $sql .= ")";
                        $columnSearch[] = $sql;
                    }
                }
            }
        }

        //Initial row filtering
        if( isset($init) ) {
            foreach ($init as $key => $value) {
                if(is_null($value))
                    $initSearch[] = $key." IS NULL";
                else
                    $initSearch[] = $key." = '".$value."'";
            }
        }

        // Combine the filters into a single string
        $where = '';
        if ( count( $globalSearch ) ) {
            $where = '('.implode(' OR ', $globalSearch).')';
        }
        if ( count( $columnSearch ) ) {
            $where = $where === '' ?
                implode(' AND ', $columnSearch) :
                $where .' AND '. implode(' AND ', $columnSearch);
        }
        if ( count( $initSearch ) ) {
            if($forceInit) {
                if($where === '')
                    $where =  implode(' AND ', $initSearch);
                else
                    $where = implode(' AND ', $initSearch) . ' AND ' . $where;
            } else {
                $where = $where === '' ?
                    implode(' AND ', $initSearch) : $where;
            }
        }
        if ( $where !== '' ) {
            $where = 'WHERE '.$where;
        }
        return $where;
    }

    /**
     * Searching / Filtering
     *
     * Construct additional conditions for the WHERE clause on server-side processing
     *
     * NOTE: This function is only used if the user uses the filter box and check
     * any of the condition.
     *
     * @param array $request http request received from the ajax call
     * @param array $initials columns definition set by the user
     *
     * @return string
     */
    static function moreFilter( $request, $initials ) {
        $filter_string = "";
        $filter_count  = 1;
        $tmp           = "";
        $filters       = $request['custom_filter'];
        foreach ( $filters as $key => $value ) {
            if ( $filter_count > 1 ) {
                $filter_string .= " OR ";
            }
            $part          = "( ";
            $part_count    = 1;
            $changeDefault = false;
            if ( isset( $value['operation'] ) && strtolower( $value['operation'] ) == 'not' ) {
                $changeDefault = true;
            }
            $columns = $value['columns'];
            foreach ( $columns as $title => $content ) {
                if ( $part_count > 1 ) {
                    $part .= " AND ";
                }
                $count = 1;
                $tmp .= "( ";
                foreach ( $content as $index => $field ) {
                    if ( $count > 1 ) {
                        if ( $changeDefault ) {
                            $tmp .= " AND ";
                        } else {
                            $tmp .= " OR ";
                        }
                    }
                    if ( $changeDefault ) {
                        $tmp .= $initials[ $title ]['db'] . " <> " . $field;
                    } else {
                        $tmp .= $initials[ $title ]['db'] . " = " . $field;
                    }
                    $count ++;
                }
                $tmp .= " )";
                $part .= $tmp;
                $tmp = "";
                $part_count ++;
            }
            $part .= " )";
            $filter_string .= $part;
            $part = "";
            $filter_count ++;
        }

        return $filter_string;
    }

    /**
     * Perform the SQL queries needed for an server-side processing requested,
     * utilising the helper functions of this class, limit(), order() and
     * filter() among others. The returned array is ready to be encoded as JSON
     * in response to an SSP request, or can be modified if needed before
     * sending back to the client.
     *
     *  @param  array $request Data sent to server by DataTables
     *  @param  string $table SQL table to query
     *  @param  string $primaryKey Primary key of the table
     *  @param  array $columns Column information array
     *  @return array          Server-side processing response array
     */
    static function simple ( $request, $table, $primaryKey, $columns )
    {
        $bindings = array();
        // Build the SQL query string from the request
        $limit = self::limit( $request );
        $order = self::order( $request, $columns );
        $where = self::filter( $request, $columns, $bindings );
        // Main query to actually get the data
        $data = self::sql_exec($bindings,
            "SELECT `".implode("`, `", self::pluck($columns, 'db'))."`
             FROM `$table`
             $where
             $order
             $limit"
        );
        // Data set length after filtering
        $resFilterLength = self::sql_exec($bindings,
            "SELECT COUNT(`{$primaryKey}`)
             FROM   `$table`
             $where"
        );
        $recordsFiltered = $resFilterLength[0]->{"COUNT(`{$primaryKey}`)"};
        // Total data set length
        $resTotalLength = self::sql_exec($bindings,
            "SELECT COUNT(`{$primaryKey}`)
             FROM   `$table`"
        );
        $recordsTotal = $resTotalLength[0]->{"COUNT(`{$primaryKey}`)"};
        /*
         * Output
         */
        return array(
            "draw"            => isset ( $request['draw'] ) ?
                intval( $request['draw'] ) :
                0,
            "recordsTotal"    => intval( $recordsTotal ),
            "recordsFiltered" => intval( $recordsFiltered ),
            "data"            => self::data_output( $columns, $data )
        );
    }

    /**
     * Perform the SQL queries needed for an server-side processing requested,
     * utilising the helper functions of this class, limit(), order() and
     * filter() among others. The returned array is ready to be encoded as JSON
     * in response to an SSP request, or can be modified if needed before
     * sending back to the client.
     *
     * @param  array $request Data sent to server by DataTables
     * @param  string $table SQL table to query
     * @param  string $primaryKey Primary key of the table
     * @param  array $columns Column information array
     * @param  array $joins
     * @param  array $initFilter
     * @param  string $database database name
     * @param  boolean $forceInit force the init filter
     * @return array Server-side processing response array
     */
    static function simpleJoin ( $request, $table, $primaryKey, $columns, $joins = [], $initFilter = [], $forceInit = false, $database = null )
    {
        $bindings = array();
        // Build the SQL query string from the request
        $limit = self::limit( $request );
        $join = self::join( $joins );
        $order = self::order( $request, $columns );
        $group = self::group($columns);
        $where = self::filter( $request, $columns, $bindings, $initFilter, $forceInit );
        // Main query to actually get the data

        $data = self::sql_exec($bindings,
            "SELECT ".implode(", ", self::pluck($columns, 'db', 'dp'))."
             FROM `$table`
             $join
             $where
             $group
             $order
             $limit", $database
        );
        // Data set length after filtering
        if(strlen($group) == 0) {
            $resFilterLength = self::sql_exec($bindings,
                "SELECT COUNT({$primaryKey})
             FROM   `{$table}`
             {$join}
             {$where}", $database
            );
        } else {
            $resFilterLength = self::sql_exec($bindings,
                "SELECT count(*) as count
                  FROM (
                      SELECT {$primaryKey}, COUNT({$primaryKey})
                      FROM   `{$table}`
                      {$join}
                      {$where}
                      {$group}
                  ) temp", $database
            );
        }
        if(strlen($group) == 0) {
            $recordsFiltered = $resFilterLength[0]->{"COUNT({$primaryKey})"};
        } else {
            $recordsFiltered = $resFilterLength[0]->{"count"};
        }

        // Total data set length
        if(strlen($group) == 0) {
            $resTotalLength = self::sql_exec($bindings,
                "SELECT COUNT({$primaryKey})
                 FROM   `{$table}`
                 {$join}
             ", $database
            );
        } else {
            $resTotalLength = self::sql_exec($bindings,
                "SELECT count(*) as count
                  FROM (
                      SELECT {$primaryKey}, COUNT({$primaryKey})
                      FROM   `{$table}`
                      {$join}
                      {$group}
                  ) temp", $database
            );
        }

        if(strlen($group) == 0) {
            $recordsTotal = $resTotalLength[0]->{"COUNT({$primaryKey})"};
        } else {
            $recordsTotal = $resTotalLength[0]->{"count"};
        }

        /*
         * Output
         */
        return array(
            "draw"            => isset ( $request['draw'] ) ?
                intval( $request['draw'] ) :
                0,
            "recordsTotal"    => intval( $recordsTotal ),
            "recordsFiltered" => intval( $recordsFiltered ),
            "data"            => self::data_output( $columns, $data )
        );
    }

    /**
     * Perform multiple layered filters on data needed for the server-side processing requested
     * utilising the helper functions of this class, limit(), order() and moreFilter() among others.
     *
     *
     * @param array $request
     * @param string $table
     * @param string $primaryKey
     * @param array $columns columns definition
     * @param array $joins
     * @param array $initFilter
     * @param bool $forceInit force the init filter
     * @param string $database database name
     *
     * @return string
     */
    static function simpleJoinFilter( $request, $table, $primaryKey, $columns, $joins = [], $initFilter = [], $forceInit = false, $database = null ) {
        $bindings = array();
        // Build the SQL query string from the request
        $limit     = self::limit( $request );
        $order     = self::order( $request, $columns );
        $join      = self::join( $joins );
        $where     = self::filter( $request, $columns, $bindings, $initFilter, $forceInit );
        $moreWhere = self::moreFilter( $request, $columns );
        if ( strlen( $moreWhere ) != 0 ) {
            if ( strlen( $where ) == 0 ) {
                $moreWhere = "WHERE " . $moreWhere;
            } else {
                $moreWhere = "AND ( " . $moreWhere . " )";
            }
        }

        // Main query to actually get the data
        $data = self::sql_exec( $bindings,
            "SELECT " . implode( ", ", self::pluck( $columns, 'db', 'dp' ) ) . "
             FROM `$table`
             $join
             $where
             $moreWhere
             $order
             $limit", $database
        );
        // Data set length after filtering
        $resFilterLength = self::sql_exec( $bindings,
            "SELECT COUNT({$primaryKey})
             FROM   `{$table}`
             {$join}
             {$where} {$moreWhere}", $database
        );
        $recordsFiltered = $resFilterLength[0]->{"COUNT({$primaryKey})"};
        // Total data set length
        $resTotalLength = self::sql_exec( $bindings,
            "SELECT COUNT({$primaryKey})
             FROM   `{$table}` {$join}", $database
        );
        $recordsTotal   = $resTotalLength[0]->{"COUNT({$primaryKey})"};

        /*
         * Output
         */

        return array(
            "draw"            => isset ( $request['draw'] ) ?
                intval( $request['draw'] ) :
                0,
            "recordsTotal"    => intval( $recordsTotal ),
            "recordsFiltered" => intval( $recordsFiltered ),
            "data"            => self::data_output( $columns, $data )
        );
    }

    /**
     * The difference between this method and the `simple` one, is that you can
     * apply additional `where` conditions to the SQL queries. These can be in
     * one of two forms:
     *
     * * 'Result condition' - This is applied to the result set, but not the
     *   overall paging information query - i.e. it will not effect the number
     *   of records that a user sees they can have access to. This should be
     *   used when you want apply a filtering condition that the user has sent.
     * * 'All condition' - This is applied to all queries that are made and
     *   reduces the number of records that the user can access. This should be
     *   used in conditions where you don't want the user to ever have access to
     *   particular records (for example, restricting by a login id).
     *
     *  @param  array $request Data sent to server by DataTables
     *  @param  string $table SQL table to query
     *  @param  string $primaryKey Primary key of the table
     *  @param  array $columns Column information array
     *  @param  string $whereResult WHERE condition to apply to the result set
     *  @param  string $whereAll WHERE condition to apply to all queries
     *  @return array          Server-side processing response array
     */
    static function complex ( $request, $table, $primaryKey, $columns, $whereResult=null, $whereAll=null )
    {
        $bindings = array();
        $localWhereResult = array();
        $localWhereAll = array();
        $whereAllSql = '';
        // Build the SQL query string from the request
        $limit = self::limit( $request );
        $order = self::order( $request, $columns );
        $where = self::filter( $request, $columns, $bindings );
        $whereResult = self::_flatten( $whereResult );
        $whereAll = self::_flatten( $whereAll );
        if ( $whereResult ) {
            $where = $where ?
                $where .' AND '.$whereResult :
                'WHERE '.$whereResult;
        }
        if ( $whereAll ) {
            $where = $where ?
                $where .' AND '.$whereAll :
                'WHERE '.$whereAll;
            $whereAllSql = 'WHERE '.$whereAll;
        }
        // Main query to actually get the data
        $data = self::sql_exec($bindings,
            "SELECT `".implode("`, `", self::pluck($columns, 'db'))."`
             FROM `$table`
             $where
             $order
             $limit"
        );
        // Data set length after filtering
        $resFilterLength = self::sql_exec($bindings,
            "SELECT COUNT(`{$primaryKey}`)
             FROM   `$table`
             $where"
        );
        $recordsFiltered = $resFilterLength[0][0];
        // Total data set length
        $resTotalLength = self::sql_exec($bindings,
            "SELECT COUNT(`{$primaryKey}`)
             FROM   `$table` ".
            $whereAllSql
        );
        $recordsTotal = $resTotalLength[0][0];
        /*
         * Output
         */
        return array(
            "draw"            => isset ( $request['draw'] ) ?
                intval( $request['draw'] ) :
                0,
            "recordsTotal"    => intval( $recordsTotal ),
            "recordsFiltered" => intval( $recordsFiltered ),
            "data"            => self::data_output( $columns, $data )
        );
    }

    /**
     * Execute an SQL query on the database
     *
     * @param  array    $bindings Array of PDO binding values from bind() to be
     *   used for safely escaping strings. Note that this can be given as the
     *   SQL query string if no bindings are required.
     * @param  string   $sql SQL query to execute.
     * @return array         Result from the query (all rows)
     */
    static function sql_exec ($bindings, $sql=null, $database = null )
    {
        // Argument shifting
        if ( $sql === null ) {
            $sql = $bindings;
        }
        if($database === null) {
            $stmt = DB::select( $sql, $bindings );
        } else {
            $stmt = DB::connection($database)->select($sql, $bindings);
        }

        // Return all
        return $stmt;
    }
    /* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
     * Internal methods
     */
    /**
     * Throw a fatal error.
     *
     * This writes out an error message in a JSON string which DataTables will
     * see and show to the user in the browser.
     *
     * @param  string $msg Message to send to the client
     */
    static function fatal ( $msg )
    {
        echo json_encode( array(
            "error" => $msg
        ) );
        exit(0);
    }

    /**
     * Pull a particular property from each assoc. array in a numeric array,
     * returning and array of the property values from each item.
     *
     *  @param  array  $a    Array to get data from
     *  @param  string $prop Property to read
     * @param   string  $ext additional properties
     *  @return array        Array of property values
     */
    static function pluck ( $a, $prop, $ext = null )
    {
        $out = array();
        for ( $i=0, $len=count($a) ; $i<$len ; $i++ ) {
            if(is_null($ext)) {
                $out[] = $a[$i][$prop];
            }
            else {
                if(isset($a[$i][$ext]) && $a[$i][$ext] == 'max') {

                    $var = explode('.', $a[$i][$prop]);
                    if(count($var) == 1)
                        $as = $var[0];
                    else
                        $as = $var[1];
                    $out[] = 'max(' . $a[$i][$prop] . ') as ' . $as;

                } elseif(isset($a[$i][$ext]) && $a[$i][$ext] == 'sum') {

                    $var = explode('.', $a[$i][$prop]);
                    if(count($var) == 1)
                        $as = $var[0];
                    else
                        $as = $var[1];
                    $out[] = 'sum(' . $a[$i][$prop] . ') as ' . $as;

                }
                else
                    $out[] = $a[$i][$prop];
            }
        }
        return $out;
    }

    /**
     * @param $columns
     *
     * @return string
     */
    static function group($columns) {
        $group = '';
        $count = 0;
        foreach ($columns as $column) {

            if(isset($column['dg']) && $column['dg'] == true) {
                $count++;
                if($count == 1) {
                    $group .= 'GROUP BY ';
                }
                if($count > 1) {
                    $group .= ',';
                }
                $group .= $column['db'];
            }
        }

        return $group;
    }

    /**
     * Return a string from an array or a string
     *
     * @param  array|string $a Array to join
     * @param  string $join Glue for the concatenation
     * @return string Joined string
     */
    static function _flatten ( $a, $join = ' AND ' )
    {
        if ( ! $a ) {
            return '';
        }
        else if ( $a && is_array($a) ) {
            return implode( $join, $a );
        }
        return $a;
    }
}