<?php


/**
 * Rijkshuisstijl (Digitale Overheid) - nojs.php
 * ----------------------------------------------------------------------------------
 * voegt extra class toe aan body en een scriptje om deze class te
 * switchen op het moment dat JS blijkbaar aan staat
 * ----------------------------------------------------------------------------------
 * @package wp-rijkshuisstijl
 * @author    Gary Jones
 * @link      https://github.com/GaryJones/genesis-header-nav
 * @copyright 2011 Gary Jones, Gamajo Tech
 * @license   GPL-2.0+
 * @version 0.1.0
 * @desc.   Eerste opzet theme, code licht opgeschoond
 * @link    https://github.com/ICTU/digitale-overheid-wordpress-theme-rijkshuisstijl
 */

class Genesis_Js_No_Js {
	/**
	 * Add action and filter.
	 *
	 * @since 0.1.0
	 */
	public function run() {
		add_filter( 'body_class', array( $this, 'body_class' ) );
		add_action( 'genesis_after', array( $this, 'script' ), 1 );
	}

	/**
	 * Add 'nojs' class to the body class values.
	 *
	 * @param array $classes Existing classes
	 *
	 * @return array
	 * @since 0.1.0
	 *
	 */
	public function body_class( $classes ) {
		$classes[] = 'nojs';

		return $classes;
	}

	/**
	 * Echo out the script that changes 'nojs' class to 'js'.
	 *
	 * @since 0.1.0
	 */
	public function script() {
		?>
        <script type="text/javascript">
            //<![CDATA[
            (function () {
                var c = document.body.className;
                c = c.replace(/nojs/, 'dojs');
                document.body.className = c;
            })();
            //]]>
        </script>
        <noscript><?php _e( "JavaScript staat uit", 'wp-rijkshuisstijl' ) ?></noscript>
		<?php
	}
}

