<?php

/*
Plugin Name: Завки на квартиры
*/

register_activation_hook(__FILE__, 'flatsapp_install');
register_deactivation_hook(__FILE__, 'flatsapp_uninstall');
register_uninstall_hook(__FILE__, 'flatsapp_ondelete');

function flatsapp_install(){

}

function flatsapp_uninstall(){

}

function flatsapp_ondelete(){

}