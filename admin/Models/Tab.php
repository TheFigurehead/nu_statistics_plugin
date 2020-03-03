<?php

namespace NU_Stat\AdminSpace\Models;

//use NU_Stat\App\Helpers\HTML_Loader;
use Union\HTML\Loader;

abstract class Tab
{
    /**
     * 
     */
    private $slug;

    private $title;

    private $data = [];

    private const DIR_PATH = 'admin/partials/tabs/';

    public function __construct( string $slug, string $title )
    {
        $this->slug = $slug;
        $this->title = $title;

        $this->renderData();
    }

    public function get_slug()
    {
        return $this->slug;    
    }

    public function get_title()
    {
        return $this->title;    
    }

    public function add_data( string $key, $value)
    {
        $this->data[$key] = $value;
    }

    public function get_data()
    {
        return $this->data;    
    }

    public function renderData()
    {
        //
    }
    
    public function render()
    {
        $slug = $this->get_slug();
        $title = $this->get_title();
        $data = $this->get_data();
        add_filter('nu_stat_tabs_button', function($tabs) use ($slug, $title){
            $tabs[$slug] = $title;
            return $tabs;
        });
        add_filter('nu_stat_tabs_content', function($contents) use ($slug, $data){
            $html_loader = new Loader();
            $html_loader->load(sprintf('%s%s.php', self::DIR_PATH, $slug), $data);
            $contents[$slug] = $html_loader->html;
            return $contents;
        });
    }
}