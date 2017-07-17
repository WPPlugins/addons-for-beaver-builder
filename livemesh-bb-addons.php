<?php
/**
 * Plugin Name: Addons for Beaver Builder
 * Plugin URI: https://www.livemeshthemes.com/beaver-builder-addons
 * Description: A collection of premium quality addons or modules for use in Beaver Builder page builder. Beaver Builder must be installed and activated.
 * Author: Beaver Builder Addons
 * Author URI: https://www.livemeshthemes.com/beaver-builder-addons
 * License: GPL3
 * License URI: https://www.gnu.org/licenses/gpl-3.0.txt
 * Version: 1.2.2
 * Text Domain: livemesh-bb-addons
 * Domain Path: languages
 *
 * Addons for Beaver Builder is distributed under the terms of the GNU
 * General Public License as published by the Free Software Foundation,
 * either version 2 of the License, or any later version.
 *
 * Addons for Beaver Builder is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with Addons for Beaver Builder. If not, see <http://www.gnu.org/licenses/>.
 *
 */

// Exit if accessed directly
if (!defined('ABSPATH'))
    exit;

if (!class_exists('Livemesh_BB_Addons')) :

    /**
     * Main Livemesh_BB_Addons Class
     *
     */
    final class Livemesh_BB_Addons {

        /** Singleton *************************************************************/

        private static $instance;

        /**
         * Main Livemesh_BB_Addons Instance
         *
         * Insures that only one instance of Livemesh_BB_Addons exists in memory at any one
         * time. Also prevents needing to define globals all over the place.
         */
        public static function instance() {

            if (!isset(self::$instance) && !(self::$instance instanceof Livemesh_BB_Addons)) {

                self::$instance = new Livemesh_BB_Addons;

                self::$instance->setup_constants();

                self::$instance->includes();

                self::$instance->hooks();

            }
            return self::$instance;
        }

        /**
         * Throw error on object clone
         *
         * The whole idea of the singleton design pattern is that there is a single
         * object therefore, we don't want the object to be cloned.
         */
        public function __clone() {
            // Cloning instances of the class is forbidden
            _doing_it_wrong(__FUNCTION__, __('Cheatin&#8217; huh?', 'livemesh-bb-addons'), '1.6');
        }

        /**
         * Disable unserializing of the class
         *
         */
        public function __wakeup() {
            // Unserializing instances of the class is forbidden
            _doing_it_wrong(__FUNCTION__, __('Cheatin&#8217; huh?', 'livemesh-bb-addons'), '1.6');
        }

        /**
         * Setup plugin constants
         *
         */
        private function setup_constants() {

            // Plugin version
            if (!defined('LABB_VERSION')) {
                define('LABB_VERSION', '1.2.2');
            }

            // Plugin Folder Path
            if (!defined('LABB_PLUGIN_DIR')) {
                define('LABB_PLUGIN_DIR', plugin_dir_path(__FILE__));
            }

            // Plugin Folder URL
            if (!defined('LABB_PLUGIN_URL')) {
                define('LABB_PLUGIN_URL', plugin_dir_url(__FILE__));
            }

            // Plugin Folder Path
            if (!defined('LABB_ADDONS_DIR')) {
                define('LABB_ADDONS_DIR', plugin_dir_path(__FILE__) . 'includes/modules/');
            }

            // Plugin Folder Path
            if (!defined('LABB_ADDONS_URL')) {
                define('LABB_ADDONS_URL', plugin_dir_url(__FILE__) . 'includes/modules/');
            }

            // Admin Folder Path
            if (!defined('LABB_ADMIN_DIR')) {
                define('LABB_ADMIN_DIR', plugin_dir_path(__FILE__) . 'admin/');
            }

            // Admin Folder URL
            if (!defined('LABB_ADMIN_URL')) {
                define('LABB_ADMIN_URL', plugin_dir_url(__FILE__) . 'admin/');
            }

            // Plugin Root File
            if (!defined('LABB_PLUGIN_FILE')) {
                define('LABB_PLUGIN_FILE', __FILE__);
            }

            // Plugin Help Page URL
            if (!defined('LABB_PLUGIN_HELP_URL')) {
                define('LABB_PLUGIN_HELP_URL', admin_url() . 'admin.php?page=livemesh_bb_addons_documentation');
            }

            $this->setup_debug_constants();
        }

        private function setup_debug_constants() {

            $enable_debug = false;

            $settings = get_option('labb_settings');

            if ($settings && isset($settings['labb_enable_debug']) && $settings['labb_enable_debug'] == "true")
                $enable_debug = true;

            // Enable script debugging
            if (!defined('LABB_SCRIPT_DEBUG')) {
                define('LABB_SCRIPT_DEBUG', $enable_debug);
            }

            // Minified JS file name suffix
            if (!defined('LABB_JS_SUFFIX')) {
                if ($enable_debug)
                    define('LABB_JS_SUFFIX', '');
                else
                    define('LABB_JS_SUFFIX', '.min');
            }
        }

        /**
         * Include required files
         *
         */
        private function includes() {


            require_once LABB_PLUGIN_DIR . 'includes/helper-functions.php';

            if (is_admin()) {
                require_once LABB_PLUGIN_DIR . 'admin/admin-init.php';
            }

            /* Load Custom Field Types */
            require_once LABB_PLUGIN_DIR . 'includes/fields/labb-number/labb-number.php';
            require_once LABB_PLUGIN_DIR . 'includes/fields/labb-toggle-button/labb-toggle-button.php';

        }

        /**
         * Include required files
         *
         */
        public function include_modules() {

            if (!class_exists('FLBuilder')) {
                return;
            }

            /* Load Beaver Builder Addon Elements */

            require_once LABB_ADDONS_DIR . 'labb-carousel/labb-carousel.php';

            require_once LABB_ADDONS_DIR . 'labb-clients/labb-clients.php';

            require_once LABB_ADDONS_DIR . 'labb-heading/labb-heading.php';

            require_once LABB_ADDONS_DIR . 'labb-odometers/labb-odometers.php';

            require_once LABB_ADDONS_DIR . 'labb-piecharts/labb-piecharts.php';

            require_once LABB_ADDONS_DIR . 'labb-portfolio/labb-portfolio.php';

            require_once LABB_ADDONS_DIR . 'labb-posts-carousel/labb-posts-carousel.php';

            require_once LABB_ADDONS_DIR . 'labb-pricing-table/labb-pricing-table.php';

            require_once LABB_ADDONS_DIR . 'labb-services/labb-services.php';

            require_once LABB_ADDONS_DIR . 'labb-stats-bar/labb-stats-bar.php';


            require_once LABB_ADDONS_DIR . 'labb-team-members/labb-team-members.php';

            require_once LABB_ADDONS_DIR . 'labb-testimonials/labb-testimonials.php';

            require_once LABB_ADDONS_DIR . 'labb-testimonials-slider/labb-testimonials-slider.php';

        }

        /**
         * Load Plugin Text Domain
         *
         * Looks for the plugin translation files in certain directories and loads
         * them to allow the plugin to be localised
         */
        public function load_plugin_textdomain() {

            $lang_dir = apply_filters('labb_bb_addons_lang_dir', trailingslashit(LABB_PLUGIN_DIR . 'languages'));

            // Traditional WordPress plugin locale filter
            $locale = apply_filters('plugin_locale', get_locale(), 'livemesh-bb-addons');
            $mofile = sprintf('%1$s-%2$s.mo', 'livemesh-bb-addons', $locale);

            // Setup paths to current locale file
            $mofile_local = $lang_dir . $mofile;

            if (file_exists($mofile_local)) {
                // Look in the /wp-content/plugins/livemesh-bb-addons/languages/ folder
                load_textdomain('livemesh-bb-addons', $mofile_local);
            }
            else {
                // Load the default language files
                load_plugin_textdomain('livemesh-bb-addons', false, $lang_dir);
            }

            return false;
        }

        /**
         * Setup the default hooks and actions
         */
        private function hooks() {

            add_action('plugins_loaded', array(self::$instance, 'load_plugin_textdomain'));

            add_action('init', array(self::$instance, 'include_modules'));

            add_action('wp_enqueue_scripts', array($this, 'enqueue_common_scripts'), 10);

            add_action('wp_enqueue_scripts', array($this, 'register_frontend_scripts'), 10);

            add_action('wp_enqueue_scripts', array($this, 'register_frontend_styles'), 10);

            add_action('wp_enqueue_scripts', array($this, 'localize_scripts'), 999999);
        }

        /**
         * Load Frontend Scripts/Styles
         *
         */
        public function enqueue_common_scripts() {

            // Use minified libraries if LABB_SCRIPT_DEBUG is turned off
            $suffix = (defined('LABB_SCRIPT_DEBUG') && LABB_SCRIPT_DEBUG) ? '' : '.min';

            wp_register_style('labb-frontend-styles', LABB_PLUGIN_URL . 'assets/css/labb-frontend.css', array(), LABB_VERSION);
            wp_enqueue_style('labb-frontend-styles');

            wp_register_style('labb-icomoon-styles', LABB_PLUGIN_URL . 'assets/css/icomoon.css', array(), LABB_VERSION);
            wp_enqueue_style('labb-icomoon-styles');

            wp_register_script('labb-frontend-scripts', LABB_PLUGIN_URL . 'assets/js/labb-frontend' . $suffix . '.js', array('jquery'), LABB_VERSION, true);
            wp_enqueue_script('labb-frontend-scripts');

        }


        /**
         * Load Frontend Scripts
         *
         */
        public function register_frontend_scripts() {

            // Use minified libraries if LABB_SCRIPT_DEBUG is turned off
            $suffix = (defined('LABB_SCRIPT_DEBUG') && LABB_SCRIPT_DEBUG) ? '' : '.min';

            wp_register_script('labb-modernizr', LABB_PLUGIN_URL . 'assets/js/modernizr-custom' . $suffix . '.js', array(), LABB_VERSION, true);

            wp_register_script('jquery-waypoints', LABB_PLUGIN_URL . 'assets/js/jquery.waypoints' . $suffix . '.js', array('jquery'), LABB_VERSION, true);

            wp_register_script('isotope.pkgd', LABB_PLUGIN_URL . 'assets/js/isotope.pkgd' . $suffix . '.js', array('jquery'), LABB_VERSION, true);

            wp_register_script('imagesloaded.pkgd', LABB_PLUGIN_URL . 'assets/js/imagesloaded.pkgd' . $suffix . '.js', array('jquery'), LABB_VERSION, true);

            wp_register_script('jquery-stats', LABB_PLUGIN_URL . 'assets/js/jquery.stats' . $suffix . '.js', array('jquery'), LABB_VERSION, true);

            wp_register_script('slick', LABB_PLUGIN_URL . 'assets/js/slick' . $suffix . '.js', array('jquery'), LABB_VERSION, true);

            wp_register_script('jquery-flexslider', LABB_PLUGIN_URL . 'assets/js/jquery.flexslider' . $suffix . '.js', array('jquery'), LABB_VERSION, true);
        }

        public function localize_scripts() {

            $custom_css = labb_get_option('labb_custom_css', '');

            wp_localize_script('labb-frontend-scripts', 'labb_settings', array('custom_css' => $custom_css));

        }


        /**
         * Load Frontend Styles
         *
         */
        public function register_frontend_styles() {

            wp_register_style('slick', LABB_PLUGIN_URL . 'assets/css/slick.css', array(), LABB_VERSION);

            wp_register_style('flexslider', LABB_PLUGIN_URL . 'assets/css/flexslider.css', array(), LABB_VERSION);

        }

    }

endif; // End if class_exists check


/**
 * The main function responsible for returning the one true Livemesh_BB_Addons
 * Instance to functions everywhere.
 *
 * Use this function like you would a global variable, except without needing
 * to declare the global.
 *
 * Example: <?php $labb = LABB(); ?>
 */
function LABB() {
    return Livemesh_BB_Addons::instance();
}

// Get LABB Running
LABB();