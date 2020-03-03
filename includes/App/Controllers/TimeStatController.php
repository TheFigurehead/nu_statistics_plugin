<?php
/**
 * Created by PhpStorm.
 * User: skylight
 * Date: 06.01.19
 * Time: 21:06
 */
namespace NU_Stat\App\Controllers;

use NU_Stat\App\TimeStat;
use Union\Controller;

class TimeStatController extends Controller
{
        
    public function __construct(){
        parent::__construct();
    }

    public function setActions(){
        $this->actions = array(
            array('wp_ajax_nu_statistics_request', array( $this, 'ajaxRequestHandler' )),
            array('wp_ajax_nopriv_nu_statistics_request', array( $this, 'ajaxRequestHandler' ))
        );

    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create( $post_id )
    {

        $current_time  = current_time( 'mysql', 0 );
        $domain = get_permalink($post_id);

        $time_stat = new TimeStat(
            [
                'user_id' => get_current_user_id(), 
                'post_id' => $post_id, 
                'url' => $domain, 
                'time_start' => $current_time, 
                'time_end' => $current_time
            ]
        );
        $time_stat->save();

        return $time_stat->ID;

    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return
     */
    public function update($id)
    {
        return TimeStat::where('id',$id)->update(
            ['time_end' => date("Y-m-d H:i:s", strtotime(TimeStat::findOrFail($id)->time_end) +10) ]
        );

        //        $row->time_end = ;
//        $row->save();
        // global $wpdb;
        // return $wpdb->update($wpdb->prefix . 'nu_user_stat', array('time_end'=>date("Y-m-d H:i:s", strtotime($row->time_end) + 10)), array('id'=>$id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }

    public function ajaxRequestHandler(){

        $type  = $_POST["type"];       
        
        switch($type){
            case 'create':
                $post_id = $_POST["post_id"];
                $response = $this->create($post_id);
                break;
            case 'update':
                $row_id = $_POST["row_id"];
                $response = $this->update($row_id);
                break;
            default:
                break;
        }

        if($response)
            echo json_encode($response);    
        
        wp_die();


    }

}