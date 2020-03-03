<?php

namespace NU_Stat\AdminSpace\Models;

use NU_Stat\AdminSpace\Models\Tab;

class DashboardTab extends Tab 
{
    const SCREEN_ID = 'tools_page_nu-user-statistic';

    public function __construct( string $slug, string $title ){
        parent::__construct( $slug, $title );

        add_filter( sprintf('manage_%s_columns', self::SCREEN_ID), function( $columns ) {
            $columns['top'] = 1;
            $columns['normal'] = 2;
            $columns['side'] = 3;
            return $columns;
        });
    }

    public function renderData(){
        
        $this->add_data('dashboard', '');
    }
}