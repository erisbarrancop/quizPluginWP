<?php 

/*
    Plugin Name: Are you Paying Attention Quiz
    Description: Multiple choice Q&A.
    Version: 1.0
    Author: eris
    Author URI: #
*/

if( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class AreYouPayingAttention {
  function __construct() {
    add_action('init', array($this, 'adminAssets'));
  }

  function adminAssets() {
    wp_register_style('quizeditcss', plugin_dir_url(__FILE__) . 'build/index.css');
    wp_register_script('ournewblocktype', plugin_dir_url(__FILE__) . 'build/index.js', array('wp-blocks', 'wp-element', 'wp-editor'));
    register_block_type('ourplugin/are-you-paying-attention',array(
      'editor_script'=> 'ournewblocktype',
      'editor_style' => 'quizeditcss',
      'render_callback'=> array($this,'theHTML')
    ));
  }

  function theHTML($attributes){
    if(!is_admin()){
      wp_enqueue_script('attentionFrontend', plugin_dir_url(__FILE__) . 'build/frontend.js', array('wp-element','wp-blocks'), '1.0', true);
      wp_enqueue_style('attentionFrontendStyles', plugin_dir_url(__FILE__) . 'build/frontend.css');
    }

    ob_start(); ?>
    <div class="paying-attention-update-me"><pre style="display: none;"><?php echo wp_json_encode($attributes) ?></pre></div>
    <?php return ob_get_clean();
  }
}

$areYouPayingAttention = new AreYouPayingAttention();