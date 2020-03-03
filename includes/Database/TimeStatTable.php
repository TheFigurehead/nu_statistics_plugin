<?php
/**
 * Created by PhpStorm.
 * User: skylight
 * Date: 06.01.19
 * Time: 17:25
 */

namespace NU_Stat\Database;

use Faker;

use GeoIp2\Database\Reader;

class TimeStatTable
{

    const DB_VERSION = '1.0';
    const TABLE_SESSIONS = 'nu_stat_sessions';
    const TABLE_LOGS = 'nu_stat_logs';

    public static function install() {
        global $wpdb;
        require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );

        $table_name = $wpdb->prefix . self::TABLE_LOGS;

        $charset_collate = $wpdb->get_charset_collate();

        $sql = "CREATE TABLE $table_name  (
             id int(11) NOT NULL AUTO_INCREMENT,
             session_id int(11) NOT NULL,
             start timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
             end timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
             post_type varchar(255) NOT NULL,
             post_id int(11) NOT NULL,
             PRIMARY KEY (id)
            ) $charset_collate ;";

        dbDelta( $sql );

        $table_name = $wpdb->prefix . self::TABLE_SESSIONS;

        $sql = "CREATE TABLE $table_name   (
             id int(11) NOT NULL AUTO_INCREMENT,
             tz varchar(255) NOT NULL,
             iso varchar(255) NOT NULL,
             postal varchar(255) NOT NULL,
             user_id int(11) NOT NULL,
             ip4 varchar(255) NOT NULL,
             country varchar(255) NOT NULL,
             PRIMARY KEY (id)
            )  $charset_collate ;";

        dbDelta( $sql );

        add_option( 'db_version', self::DB_VERSION );
    }

    public static function install_data() {

        global $wpdb;

        $reader = new Reader( NU_STAT_PATH . 'GeoLite2-City.mmdb');
        for( $i=0; $i<=20; $i++ ){
            
            $faker = Faker\Factory::create();
                        
            $ipv4 = $faker->ipv4;
            
            try {
                $record = $reader->city($ipv4);
            } catch ( \GeoIp2\Exception\AddressNotFoundException $e ) {
                continue;
            }

            $wpdb->insert(
            $wpdb->prefix . self::TABLE_SESSIONS,
                array(
                    'tz' => $record->location->timeZone,
                    'iso' => $record->country->isoCode,
                    'postal' => $faker->postcode,
                    'ip4' => $ipv4,
                    'country' => $record->country->name
                )
            );			

            $wpdb->insert(
            $wpdb->prefix . self::TABLE_LOGS,
                array(
                    'session_id' => rand(1, 50),
                    'start' => strtotime( $faker->dateTimeBetween($startDate = '-3 days', $endDate = '-2 days') ),
                    'end' => strtotime( $faker->dateTimeBetween($startDate = '-2 days', $endDate = 'now') ),
                    'post_type' => 'post',
                    'post_id' => rand(1, 10),
                )
            );
            
        }
    }

}