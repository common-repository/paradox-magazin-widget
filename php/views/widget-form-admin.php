<?php if ( !defined( 'ABSPATH' ) ) exit( __('Don\'t try to load this file directly!') ); ?>

<p class="categorize-widget">
	<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php echo $widTitle ?>:</label>
    <input class="widefat" type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $title ?>" />
</p>
