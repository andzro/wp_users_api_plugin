<?php
/**
 * @package JcityMembership
 * 
 */

   /*
   Plugin Name: Custom Plugin for API Access
   Plugin URI: 
   description: A Custom plugin for a wordpress site to directly access data from an API
   Version: 1.0
   Author: Sieg Magtaas
   Author URI: andzro.github.io
   License: GPL2
   */

if (!defined('ABSPATH')){ 
    die;
}

class JcityMembership{

    public $plugin;

    function __construct()
    {
        $this->plugin = plugin_basename(__FILE__);
    }

    public function activate()
    {
        flush_rewrite_rules();
    }

    public function deactivate()
    {
        flush_rewrite_rules();
    }

    public function uninstall()
    {
        flush_rewrite_rules();
    }

    public function register()
    {
        add_action('admin_menu', array($this, 'add_admin_pages'));

        add_filter('plugin_action_links_'.$this->plugin,array($this, 'settings_link'));
    }

    public function settings_link( $links )
    {
        $settings_link = '<a href="admin.php?page=jcity_membership">Dashboard</a>';
        array_push($links, $settings_link);
        return $links;
    }

    public function add_admin_pages()
    {
        add_menu_page('Jcity Membership','Jcity Membership','manage_options','jcity_membership',array($this, 'admin_index'),'
        dashicons-admin-users',110);
    }

    public function admin_index()
    {
        require_once plugin_dir_path(__FILE__).'templates/admin.php';
    }
}

if(class_exists('JcityMembership')){
    $jcityMembership = new JcityMembership();
    $jcityMembership->register();
}

// activation
register_activation_hook(__FILE__, array($jcityMembership, 'activate'));

//deactivation
register_deactivation_hook(__FILE__, array($jcityMembership, 'deactivate'));

//uninstall
register_uninstall_hook(__FILE__, array($jcityMembership, 'uninstall'));

?>