<?php

/*
 ----------------------------------------------------------------------
 GLPI - Gestionnaire Libre de Parc Informatique
 Copyright (C) 2003-2008 by the INDEPNET Development Team.

 http://indepnet.net/   http://glpi-project.org/
 ----------------------------------------------------------------------

 LICENSE

	This file is part of GLPI.

    GLPI is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    GLPI is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with GLPI; if not, write to the Free Software
    Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
 ------------------------------------------------------------------------
*/

// Original Author of file: Walid Nouh
// Purpose of file:
// ----------------------------------------------------------------------

include_once ("plugin_datainjection.includes.php");

function plugin_init_datainjection() {
	global $PLUGIN_HOOKS, $CFG_GLPI, $LANG;

	$plugin = new Plugin;

	if ($plugin->isInstalled("datainjection") && $plugin->isActivated("datainjection")) {

		$PLUGIN_HOOKS['change_profile']['datainjection'] = 'plugin_datainjection_changeprofile';

		$PLUGIN_HOOKS['headings']['datainjection'] = 'plugin_get_headings_datainjection';
		$PLUGIN_HOOKS['headings_action']['datainjection'] = 'plugin_headings_actions_datainjection';

		if (plugin_datainjection_haveRight("model", "r"))
			$PLUGIN_HOOKS['menu_entry']['datainjection'] = true;

		$PLUGIN_HOOKS['pre_item_delete']['datainjection'] = 'plugin_pre_item_delete_datainjection';

		// Css file
		$PLUGIN_HOOKS['add_css']['datainjection'] = 'css/datainjection.css';
	
		// Javascript file
		$PLUGIN_HOOKS['add_javascript']['datainjection'] = 'javascript/datainjection.js';
	
		//Need to load mappings when all the other files are loaded...
		//TODO : check with it cannot be included at the same at as the other files...
		include_once("inc/plugin_datainjection.mapping.constant.php");
		registerPluginType('datainjection', 'PLUGIN_DATA_INJECTION_MODEL', 1450, array(
				'classname'  => 'DataInjectionModel',
				'tablename'  => 'glpi_plugin_datainjection_models',
				'typename'   => $LANG['common'][22],
				'formpage'   => '',
				'searchpage' => '',
				'specif_entities_tables' => true,
				'recursive_type' => true
				));
	
		loadDeviceSpecificTypes();
		addDeviceSpecificMappings();
		addDeviceSpecificInfos();
	
		//Initialize, if active, genericobject types
		if ($plugin->isActivated("genericobject"))
			usePlugin("genericobject");
	}
}

function plugin_version_datainjection() {
	global $LANG;

	return array (
		'name' => $LANG["datainjection"]["name"][1],
		'minGlpiVersion' => '0.72',
		'author'=>'Dévi Balpe & Walid Nouh & Remi Collet',
		'homepage'=>'http://glpi-project.org/wiki/doku.php?id='.substr($_SESSION["glpilanguage"],0,2).':plugins:pluginslist',
		'version' => '1.7.0'
	);
}


function plugin_datainjection_check_prerequisites() {
	if (GLPI_VERSION >= 0.72) {
		return true;
	} else {
		echo "This plugin requires GLPI 0.72 or later";
	}
}

function plugin_datainjection_check_config() {
	return true;
}

?>
