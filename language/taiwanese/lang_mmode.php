<?php
/*	Project:	EQdkp-Plus
 *	Package:	EQdkp-Plus Language File
 *	Link:		http://eqdkp-plus.eu
 *
 *	Copyright (C) 2006-2016 EQdkp-Plus Developer Team
 *
 *	This program is free software: you can redistribute it and/or modify
 *	it under the terms of the GNU Affero General Public License as published
 *	by the Free Software Foundation, either version 3 of the License, or
 *	(at your option) any later version.
 *
 *	This program is distributed in the hope that it will be useful,
 *	but WITHOUT ANY WARRANTY; without even the implied warranty of
 *	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *	GNU Affero General Public License for more details.
 *
 *	You should have received a copy of the GNU Affero General Public License
 *	along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */


if (!defined('EQDKP_INC')) {
	die('You cannot access this file directly.');
}

//Language: English
//Created by EQdkp Plus Translation Tool on  2014-12-17 23:17
//File: language/english/lang_mmode.php
//Source-Language: german

$lang = array(
	"click2show" => '(click to show)',
	"maintenance_mode" => 'Maintenance Mode',
	"task_manager" => 'Task-Manager',
	"admin_acp" => 'Admin Control Panel',
	"activate_info" => '<h1>Activate Maintenance Mode</h1><br />With this maintenance tool, you can easily update your EQdkp and import Data from an older Version.<br />An Update or Import is only possible, if the maintenance mode is enabled and denies the Login of users to prevent Errors and Problems.<br /><br />Reason, shown to the users (not required):<br />',
	"activate_mmode" => 'Activate Maintenance Mode',
	"deactivate_mmode" => 'Close maintenance mode',
	"leave_mmode" => 'Cancel',
	"home" => 'Home',
	"no_leave" => 'Impossible to deactivate maintenance mode as long as required tasks need to be executed.',
	"no_leave_accept" => 'Back to Task overview',
	"maintenance_message" => '<b>The EQdkp Plus-system is currently running in maintenance mode.</b> A login actually is only possible for administrators.',
	"reason" => '<br /><b>Reason:</b> ',
	"admin_login" => 'Administrator login',
	"login" => 'Login',
	"username" => 'User',
	"password" => '密碼',
	"remember_password" => 'Remember password?',
	"invalid_login_warning" => 'Invalid login! Please verify your Username and Password. Only admin users are allowed to login!',
	"is_necessary" => 'Necessary?',
	"is_applicable" => 'Applicable?',
	"name" => 'Name',
	"version" => 'Version',
	"author" => 'Author',
	"link" => 'Process task',
	"description" => 'Description',
	"type" => 'Task type',
	"yes" => 'Yes',
	"no" => 'No',
	"click_me" => 'Process task',
	"mmode_info" => 'Your System currently is in maintenance mode and denies access to normal users until you disable the maintenance mode.',
	"necessary_tasks" => 'Necessary tasks',
	"applicable_tasks" => 'Not necessary/already processed tasks',
	"not_applicable_tasks" => 'Not applicable tasks',
	"no_nec_tasks" => 'No necessary tasks.',
	"nec_tasks" => 'The following Tasks are necessary. Please process them to bring your system to the actual state.',
	"nec_tasks_available" => 'Please process the necessary tasks to bring your system to the actual state.',
	"applicable_warning" => 'This task is not applicable! Procesing may cause loss of data! Process this task only if you are absolutely sure!',
	"executed_tasks" => 'The following actions have been processed for the Task "%s"',
	"stepend_info" => 'The task has been finished. The EQdkp Plus is still in maintenance mode so that you can test everything. Only after the maintenance mode has been closed, users will be able to log in again.',
	"mmode_pfh_error" => 'Some errors occured. You need to correct these errors to close the maintenance mode.',
	"lib_cache_notwriteable" => 'Unable to write in folder "data". Please set folder permissions to CHMOD 777!',
	"fix" => 'Fix',
	"update" => 'Core update',
	"import" => 'Import',
	"plugin_update" => 'Plugin update',
	"game_update" => 'Game update',
	"worker" => "Worker",
	"unknown_task_warning" => 'Unknown task!',
	"application_warning" => 'Could not process task due to an application error!',
	"dependency_warning" => 'This task is dependent from others. Please process them first!',
	"start_here" => 'Start here!',
	"following_updates_necessary" => 'The following updates are necessary:',
	"start_update" => 'Process all necessary Updates!',
	"only_this_update" => 'Process only this update:',
	"start_single_update" => 'Process update',
	'backup'			=> 'Database-Backup',
	'backup_note'		=> 'A database-backup was created at %s.',
	'support_eqdkplus'	=> 'A project like EQdkp Plus can only exist, if we can get back some of the effort, time and love we invest in EQdkp Plus. You can give something back on the following ways:
						<ul>
							<li><i class="fa fa-puzzle-piece"></i> <a href="http://eqdkp-plus.eu/repository/">Publish a plugin or template, so every EQdkp Plus user can use it</a></li>
							<li><i class="fa fa-comments"></i> <a href="http://eqdkp-plus.eu/forum/">Support us at our board</a></li>
							<li><i class="fa fa-cogs"></i> <a href="http://eqdkp-plus.eu/en/development.html">Take part actively in the development of EQdkp Plus</a></li>
							<li><i class="fa fa-usd"></i> <a href="http://eqdkp-plus.eu/en/donate.html">Support us financially so we can continue offering you our services</a></li>
						</ul>
						So if you love EQdkp Plus as much as we do, think about supporting us!',
);
