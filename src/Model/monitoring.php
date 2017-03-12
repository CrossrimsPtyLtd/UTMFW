<?php
/*
 * Copyright (C) 2004-2017 Soner Tari
 *
 * This file is part of UTMFW.
 *
 * UTMFW is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * UTMFW is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with UTMFW.  If not, see <http://www.gnu.org/licenses/>.
 */

require_once($MODEL_PATH.'/model.php');

class Monitoring extends Model
{
	public $LogFile= '/var/log/monitoring.log';
	
	function IsRunning($proc= '')
	{
		global $MODEL_PATH;
		
		require_once($MODEL_PATH.'/symon.php');
		$symon= new Symon();
		$retval= $symon->IsRunning();
		
		require_once($MODEL_PATH.'/symux.php');
		$symux= new Symux();
		$retval&= $symux->IsRunning();
		
		require_once($MODEL_PATH.'/pmacct.php');
		$pmacct= new Pmacct();
		$retval&= $pmacct->IsRunning();
		
		return $retval;
	}
}
?>