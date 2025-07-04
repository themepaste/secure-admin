<?php 

namespace ThemePaste\SecureAdmin\Classes;

defined( 'ABSPATH' ) || exit;

use ThemePaste\SecureAdmin\Traits\Hook;
use ThemePaste\SecureAdmin\Traits\Asset;

class Admin {

    use Hook;
    use Asset;

    /**
     * Admin constructor.
     *
     * Initializes the Secure Admin plugin by triggering the
     * initialization of the settings page and enqueueing the
     * admin styles.
     *
     * @since 1.0.0
     *
     * @return void
     */
    public function __construct() {
        $this->action( 'plugins_loaded', function() {
            ( new Settings() )->init();
        } );
        $this->action( 'admin_enqueue_scripts', [ $this, 'admin_enqueue_styles'] );
        $this->action( 'admin_enqueue_scripts', [ $this, 'admin_enqueue_scripts'] );
    }

    /**
     * Enqueues admin styles for the Secure Admin settings page.
     *
     * @param string $screen The current screen ID.
     *
     * @return void
     */
    public function admin_enqueue_styles( $screen ) {
		if ( 'toplevel_page_' . Settings::$SETTING_PAGE_ID === $screen ) {
            $this->enqueue_style(
                'tpsa-settings',
                TPSA_ASSETS_URL . '/admin/css/settings.css'
            );
        }
		if ( 'toplevel_page_' . Settings::$SETTING_PAGE_ID === $screen ) {
            $this->enqueue_style(
                'tpsa-fields',
                TPSA_ASSETS_URL . '/admin/css/fields.css'
            );
        }
	}

    public function admin_enqueue_scripts() {
        $this->enqueue_script(
            'tpsa-admin',
            TPSA_ASSETS_URL . '/admin/js/admin.js',
            [ 'jquery' ]
        );
        $this->enqueue_script(
            'tpsa-login-log-activity',
            TPSA_ASSETS_URL . '/admin/build/loginLogActivity.bundle.js',
        );
        $this->enqueue_script(
            'tpsa-analytics',
            TPSA_ASSETS_URL . '/admin/build/analytics.bundle.js',
        );
        
    }

}