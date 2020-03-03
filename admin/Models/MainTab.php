<?php

namespace NU_Stat\AdminSpace\Models;

use NU_Stat\AdminSpace\Models\Tab;
use NU_Stat\App\TimeStat;

class MainTab extends Tab 
{
    public function renderData(){
        $this->add_data('time_stats', TimeStat::all()->toArray());
    }
}