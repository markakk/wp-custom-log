<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

class CuLog_Actions
{
    public function __construct()
    {
        add_action('admin_menu', array($this, 'add_menu_page'));
        add_action('admin_enqueue_scripts', array($this, 'load_admin_scripts'));

        add_filter('culog_param_value', array($this, 'get_param_value'), 10, 2);
        add_filter('culog_files_dir', array($this, 'get_files_dir'));
        add_filter('culog_file_name', array($this, 'get_file_name'));
    }

    public function get_param_value( $param_key, $custom_value )
    {
        $params = (defined('CULOG_PARAMS')) ? CULOG_PARAMS : array();

        $value = ($custom_value) ? $custom_value : null;
        if ( $value === null && isset($params[$param_key]) && $params[$param_key] !== null ) {
            $value = $params[$param_key];
        }

        return $value;
    }

    public function get_files_dir( $custom_path )
    { 
        $path = apply_filters('culog_param_value', 'file_dir', $custom_path);
        if ( empty($path) ) {
            $path = $this->get_wp_upload_dir();
        }

        return trailingslashit($path);
    }

    private function get_wp_upload_dir()
    {
        $upload_dir = wp_upload_dir();
        $plugin_upload_path = trailingslashit($upload_dir['basedir']) . 'culog/';
        if ( ! file_exists($plugin_upload_path) ) {
            wp_mkdir_p($plugin_upload_path);
        }
        return $plugin_upload_path;
    }

    public function get_file_name( $custom_name )
    {
        $name = apply_filters('culog_param_value', 'file_name', $custom_name);
        if ( empty($name) ) {
            $name = 'custom.log';
        }

        return $name;
    }

    public function add_menu_page()
    {
        add_submenu_page(
            'tools.php',
            'Custom logs',
            'Custom logs',
            'manage_options',
            'culog',
            array($this, 'render_page')
        );
    }

    public function load_admin_scripts( $hook )
    {
        if ( isset($_GET['page']) && $_GET['page'] == 'culog' ) {
            wp_enqueue_style('culog', CULOG_URL . 'assets/style.css', array(), CULOG_VERSION);
        }
    }

    public function render_page()
    {
        $culog_dir = $this->get_wp_upload_dir();

        echo '<div class="wrap culog-page">';
        echo '<h1>Custom Logs</h1>';

        // Tikrinam, ar buvo POST delete request
        if ( isset($_POST['culog_delete_file']) && !empty($_POST['culog_delete_file']) ) {
            $file_to_delete = sanitize_file_name($_POST['culog_delete_file']);
            $full_path = $culog_dir . $file_to_delete . '.log';
            if ( file_exists($full_path) ) {
                unlink($full_path);
                echo '<div style="color:green; margin-bottom:15px;">File "' . esc_html($file_to_delete) . '" deleted successfully.</div>';
            }
        }

        $log_files = glob($culog_dir . '*.log');

        if (!empty($log_files)) {
            foreach ($log_files as $index => $file) {
                $filename = pathinfo($file, PATHINFO_FILENAME);
                $file_date = date('Y-m-d H:i:s', filemtime($file));
                $content = file_get_contents($file);

                $pre_id = 'culog_pre_' . $index;

                echo '<div class="culog-line">';

                echo '<div class="culog-line-header">';
                echo '<div class="culog-line-title" onclick="document.getElementById(\'' . $pre_id . '\').classList.toggle(\'culog-hidden\');">';
                echo '<b>' . esc_html($filename) . '</b> <small>' . esc_html($file_date) . '</small>';
                echo '</div>';

                // Delete form
                echo '<form method="post" class="culog-delete-form">';
                echo '<input type="hidden" name="culog_delete_file" value="' . esc_attr($filename) . '">';
                echo '<button type="submit" onclick="return confirm(\'Are you sure you want to delete &quot;' . esc_js($filename) . '&quot;?\');">X</button>';
                echo '</form>';

                echo '</div>';

                echo '<pre id="' . $pre_id . '" class="culog-file-view culog-hidden">';
                echo esc_html($content);
                echo '</pre>';

                echo '</div>';
            }
        } else {
            echo '<p>No log files found.</p>';
        }

        echo '</div>';
    }

}
