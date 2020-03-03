<?php

namespace NU_Stat\Rest;

class RestAPI extends \WP_REST_Controller{

    public $namespace;
    public $rest_base;

    public function __construct(){

		$this->namespace = 'nu_stat/v1';
        $this->rest_base = 'test';
        
        add_action( 'rest_api_init', function () {
            register_rest_route( $this->namespace, '/' . $this->rest_base, array(
                'methods' => 'GET',
                'callback' => [$this, 'test_rest_function']
            ) );
        } );

    }

    public function register_api(){

        // echo $this->namespace . '/' . $this->rest_base;
        
        // register_rest_route( $this->namespace, '/' . $this->rest_base, array(
        //     'methods' => 'GET',
        //     'callback' => [$this, 'test_rest_function'],
        // ) );

    }

    public function test_rest_function(){
        return [
            'name' => 'Serg Opel',
            'status' => 'King of WP',
            'make_petuh' => true,
            'sex' => 'male'
        ];
    }
}