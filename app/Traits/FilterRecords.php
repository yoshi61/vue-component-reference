<?php


namespace App\Traits;


trait FilterRecords
{
    // Search users
    public function scopeSearchUser($query, $options){
        if( $this->validateQueryRequest('search_term', $options) ){
            // search user name
            $query->oRwhere('users.username', 'LIKE', '%'.$options->get('search_term').'%')
                ->oRwhere('users.first_name', 'LIKE', '%'.$options->get('search_term').'%')
                ->oRwhere('users.last_name', 'LIKE', '%'.$options->get('search_term').'%')
                ->oRwhere('users.email', 'LIKE', '%'.$options->get('search_term').'%');
        }
    }

    // Sort and order result
    public function scopeOrderResult( $query, $options ){
        $count = 0;
        $sort_by = $options->get('sort_by');
        $order_by = $options->get('descending');
        foreach ( $sort_by as $field_name ){
            $order = 'ASC';
            if( $order_by[$count] ) {
                $order = 'DESC';
            }
            $query->orderBy($field_name, $order);
            $count++;
        }
    }

    /*
 * Calculate pagination
 * using page number for pagination - calculate result to skip
 */
    public function rowsToSkip( $page_number, $result_to_display ){
        if( $page_number > 1 ) {
            return ( $page_number - 1 ) * $result_to_display;
        }
        return 0;
    }

    // self checking
    protected function validateQueryRequest($column_name, $options){

        // check if column name exists
        if( !$options->has($column_name) ){
            return false;
        }

        // check if column name attribute has a value
        if( empty($options->get($column_name)) ){
            return false;
        }

        return true;
    }
}
