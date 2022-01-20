<?php

/**
 * -------------------------------------------------------------------------
 * Datainjection plugin for GLPI
 * Copyright (C) 2009-2022 by the Datainjection plugin Development Team.
 *
 * https://github.com/pluginsGLPI/datainjection
 * -------------------------------------------------------------------------
 *
 * LICENSE
 *
 * This file is part of Datainjection plugin.
 *
 * Datainjection plugin is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * Datainjection plugin is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with Datainjection plugin. If not, see <http://www.gnu.org/licenses/>.
 * --------------------------------------------------------------------------
 */

require '../../../inc/includes.php';

Session::checkLoginUser();

switch ($_GET["popup"]) {
   case "preview" :
       Html::popHeader(__('See the file', 'datainjection'), $_SERVER['PHP_SELF']);
       PluginDatainjectionModel::showPreviewMappings($_GET['models_id']);
       Html::popFooter();
    break;

   case "log" :
       Html::popHeader(__('Data injection report', 'datainjection'), $_SERVER['PHP_SELF']);
       PluginDatainjectionModel::showLogResults($_GET['models_id']);
       Html::popFooter();
    break;
}
