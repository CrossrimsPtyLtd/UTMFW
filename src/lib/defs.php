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

/** @file
 * Common variables, arrays, and constants.
 */

/// Project version.
define('VERSION', '5.9');

$ROOT= dirname(dirname(dirname(__FILE__)));
$SRC_ROOT= dirname(dirname(__FILE__));

$VIEW_PATH= $SRC_ROOT . '/View';
$MODEL_PATH= $SRC_ROOT . '/Model';

/// Syslog priority strings.
$LOG_PRIOS= array(
	'LOG_EMERG',	// system is unusable
	'LOG_ALERT',	// action must be taken immediately
	'LOG_CRIT',		// critical conditions
	'LOG_ERR',		// error conditions
	'LOG_WARNING',	// warning conditions
	'LOG_NOTICE',	// normal, but significant, condition
	'LOG_INFO',		// informational message
	'LOG_DEBUG',	// debug-level message
	);

/// Superuser
$ADMIN= array('admin');
/// Unprivileged user who can modify any configuration
$USER= array('user');
/// All valid users
$ALL_USERS= array_merge($ADMIN, $USER);

/**
 * Locale definitions used by both View and Controller.
 *
 * It is recommended that all translations use UTF-8 codeset.
 *
 * @param string Name Title string
 * @param string Codeset Locale codeset
 */
$LOCALES = array(
    'en_EN' => array(
        'Name' => _('English'),
        'Codeset' => 'UTF-8'
		),
    'tr_TR' => array(
        'Name' => _('Turkish'),
        'Codeset' => 'UTF-8'
		),
    'sp_SP' => array(
        'Name' => _('Spanish'),
        'Codeset' => 'UTF-8'
		),
    'ru_RU' => array(
        'Name' => _('Russian'),
        'Codeset' => 'UTF-8'
		),
    'zh_CN' => array(
        'Name' => _('Chinese simplified'),
        'Codeset' => 'UTF-8'
		),
    'nl_NL' => array(
        'Name' => _('Dutch'),
        'Codeset' => 'UTF-8'
		),
    'fr_FR' => array(
        'Name' => _('French'),
        'Codeset' => 'UTF-8'
		),
	);

/// Used in translating months from number to string.
$MonthNames= array(
	'01' => 'Jan',
	'02' => 'Feb',
	'03' => 'Mar',
	'04' => 'Apr',
	'05' => 'May',
	'06' => 'Jun',
	'07' => 'Jul',
	'08' => 'Aug',
	'09' => 'Sep',
	'10' => 'Oct',
	'11' => 'Nov',
	'12' => 'Dec',
	);

/// Used in translating months from string to number.
$MonthNumbers= array(
	'Jan' => '01',
	'Feb' => '02',
	'Mar' => '03',
	'Apr' => '04',
	'May' => '05',
	'Jun' => '06',
	'Jul' => '07',
	'Aug' => '08',
	'Sep' => '09',
	'Oct' => '10',
	'Nov' => '11',
	'Dec' => '12',
	);

/// General tcpdump command used everywhere.
/// @todo All system binaries called should be defined like this.
/// @attention Redirect stderr to /dev/null to hush tcpdump warning: "tcpdump: WARNING: snaplen raised from 116 to 160".
/// Otherwise that warning goes in front of the data.
$TCPDUMP= 'exec 2>/dev/null; /usr/sbin/tcpdump -nettt -r';

/// Type definitions for config settings as PREs
/// @todo Fix leading 0's problem(s)
define('UINT_0_2', '[0-2]');
define('STR_on_off', 'on|off');
define('STR_On_Off', 'On|Off');
define('STR_SING_QUOTED', '\'[^\']*\'');
define('STR_yes_no', 'yes|no');
define('UINT', '[0-9]+');
define('INT_M1_0_UP', '-1|[0-9]+');
define('UINT_0_1', '0|1');
define('INT_M1_0_3', '-1|[0-3]');
define('UINT_0_3', '[0-3]');
define('UINT_1_4', '[0-4]');
define('IP', '\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}');
define('IPorNET', '(\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3})|(\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}\/\d{1,2})');
define('PORT', '[0-9]+');
define('FLOAT', '[0-9]+|([0-9]+\.[0-9]+)');
define('CHAR', '.');

/// Common regexps.
/// @todo Find a proper regexp for IPv4 addresses, this is too general.
$Re_Ip= '\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}';
$Re_Net= "$Re_Ip\/\d{1,2}";
$Re_IpPort= '\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}:\d{1,5}';
/// @todo $num and $range need full testing. Define $port.
$preIPOctet= '(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])';
$preIPRange= '(\d|[1-2]\d|3[0-2])';
$preIP= "$preIPOctet\\.$preIPOctet\\.$preIPOctet\\.$preIPOctet";
$preNet= "$preIP\/$preIPRange";

$preMacByte= '[\da-f]{2}';
$preMac= "$preMacByte\:$preMacByte\:$preMacByte\:$preMacByte\:$preMacByte\:$preMacByte";

$preIfName= '\w+\d+';

/// For classifying gettext strings into files.
function _STATS($str)
{
	return _($str);
}

/**
 * Master statistics configuration.
 *
 * This array provides stats configuration parameters needed for each module.
 * Detailed behaviour of each module is defined by the settings in this array.
 *
 * @param Stats				Parent field in configuration details used on
 *							statistics pages.
 * @param Stats>Total		Mandatory sub-field for each Stats field. Configures the
 *							the general settings for the basic stats for the module.
 * @param Stats>Total>Title	Title to display on top of the graph.
 * @param Stats>Total>Cmd	Command line to get log lines. Usually to get all lines.
 * @param Stats>Total>Needle To get only those lines that contain the Needle text among
 *							the lines obtained by Stats>Total>Cmd.
 * @param Stats>Total>Color	The color of the bars on the graph.
 * @param Stats>Total>NVPs	Name-Value-Pairs to print at the bottom of the graph.
 *							Usually top 5 of some of the more important stats.
 *							Displayed in 2 columns.
 * @param Stats>Total>BriefStats Statistics (parsed field names) to collect as
 *							BriefStats. Top 100 of collected data are
 *							shown on the left of General statistics page.
 * @param Stats>Total>Counters Statistics to collect and show as a graph over total
 *							data. The difference between these counters and Stats>\<StatName\>
 *							is that these are collected using the command line for
 *							the Total stats. So there is no separate Cmd field.
 *							Counters has one extra field, Divisor, which is used to
 *							divide the total count. Usually need to convert bytes to
 *							kilobytes.
 * @param Stats><StatName>	Custom statistics to be collected. The data for these
 *							graphs are collected using the Cmd and Needle fields.
 *							Stats>Total>Counters could have been merged with this one perhaps.
 *							The sub-fields for these custom stats is the same as the
 *							Total field described above.
 */
$StatsConf = array(
	'pf' => array(
		'Total' => array(
			'Title' => _STATS('All requests'),
			'Cmd' => $TCPDUMP.' <LF>',
			'Needle' => '',
			'Color' => '#004a4a',
			'NVPs' => array(
				'SrcIP' => _STATS('Source addresses'),
				'DstIP' => _STATS('Destination addresses'),
				'DPort' => _STATS('Destination ports'),
				'Type' => _STATS('Packet types'),
				),
			'BriefStats' => array(
				'Date' => _STATS('Requests by date'),
				'SrcIP' => _STATS('Source addresses'),
				'DstIP' => _STATS('Destination addresses'),
				'DPort' => _STATS('Destination ports'),
				'Type' => _STATS('Packet types'),
				),
			'Counters' => array(),
			),
		'Pass' => array(
			'Title' => _STATS('Allowed requests'),
			'Cmd' => $TCPDUMP.' <LF>',
			'Needle' => ' pass ',
			'Color' => 'green',
			'NVPs' => array(
				'SrcIP' => _STATS('Source addresses'),
				'DstIP' => _STATS('Destination addresses'),
				'DPort' => _STATS('Destination ports'),
				'Type' => _STATS('Packet types'),
				),
			),
		'Block' => array(
			'Title' => _STATS('Blocked requests'),
			'Cmd' => $TCPDUMP.' <LF>',
			'Needle' => ' block ',
			'Color' => 'red',
			'NVPs' => array(
				'SrcIP' => _STATS('Source addresses'),
				'DstIP' => _STATS('Destination addresses'),
				'DPort' => _STATS('Destination ports'),
				'Type' => _STATS('Packet types'),
				),
			),
		'Match' => array(
			'Title' => _STATS('Matched requests'),
			'Cmd' => $TCPDUMP.' <LF>',
			'Needle' => ' match ',
			'Color' => '#FF8000',
			'NVPs' => array(
				'SrcIP' => _STATS('Source addresses'),
				'DstIP' => _STATS('Destination addresses'),
				'DPort' => _STATS('Destination ports'),
				'Type' => _STATS('Packet types'),
				),
			),
		),
    'e2guardianlogs' => array(
		'Total' => array(
			'Title' => _STATS('All requests'),
			'Cmd' => '/bin/cat <LF>',
			'Needle' => '',
			'Color' => '#004a4a',
			'NVPs' => array(
				'Link' => _STATS('Requests'),
				'IP' => _STATS('IPs'),
				),
			'BriefStats' => array(
				'Date' => _STATS('Requests by date'),
				'IP' => _STATS('Requests by IP'),
				'Link' => _STATS('Links visited'),
				'Cat' => _STATS('Denied categories'),
				),
			'Counters' => array(
				'Sizes' => array(
					'Field' => 'Size',
					'Title' => _STATS('Downloaded (KB)'),
					'Color' => '#FF8000',
					'Divisor' => 1000,
					'NVPs' => array(
						'Link' => _STATS('Size by site (KB)'),
						'IP' => _STATS('Size by IP (KB)'),
						),
					),
				),
			),
		'Scanned' => array(
			'Title' => _STATS('Scanned requests'),
			'Needle' => 'SCANNED',
			'Color' => 'blue',
			'NVPs' => array(
				'Link' => _STATS('Requests scanned'),
				'IP' => _STATS('Scanned IPs'),
				),
			),
		'Exception' => array(
			'Title' => _STATS('Exception requests'),
			'Needle' => 'EXCEPTION',
			'Color' => '#FF8000',
			'NVPs' => array(
				'Link' => _STATS('Exception requests'),
				'IP' => _STATS('Exception IPs'),
				),
			),
		'Denied' => array(
			'Title' => _STATS('Denied requests'),
			'Needle' => 'DENIED',
			'Color' => 'red',
			'NVPs' => array(
				'Link' => _STATS('Requests denied'),
				'IP' => _STATS('Denied IPs'),
				'Cat' => _STATS('Denied categories'),
				),
			),
		'Infected' => array(
			'Title' => _STATS('Infected requests'),
			'Needle' => 'INFECTED',
			'Color' => 'red',
			'NVPs' => array(
				'Link' => _STATS('Requests infected'),
				'IP' => _STATS('Infected IPs'),
				),
			),
		'Bypassed' => array(
			'Title' => _STATS('Bypassed denials'),
			'Needle' => 'GBYPASS| Bypass ',
			'Color' => '#FF8000',
			'NVPs' => array(
				'Link' => _STATS('Requests bypassed'),
				'IP' => _STATS('Bypassing IPs'),
				),
			),
		),
    'named' => array(
		'Total' => array(
			'Title' => _STATS('All queries'),
			'Cmd' => '/bin/cat <LF>',
			'Needle' => '( query: )',
			'NVPs' => array(),
			'BriefStats' => array(
				'Domain' => _STATS('Domains'),
				'IP' => _STATS('IPs querying'),
				'Type' => _STATS('Query types'),
				),
			'Counters' => array(),
			),
		'Queries' => array(
			'Title' => _STATS('All queries'),
			'Needle' => '( query: )',
			'Color' => '#004a4a',
			'NVPs' => array(
				'Domain' => _STATS('Domains'),
				'IP' => _STATS('IPs querying'),
				'Type' => _STATS('Query types'),
				),
			),
		),
    'openssh' => array(
		'Total' => array(
			'Title' => _STATS('All attempts'),
			'Cmd' => '/bin/cat <LF>',
			'Needle' => '(Accepted|Failed)',
			'Color' => '#004a4a',
			'NVPs' => array(
				'IP' => _STATS('Client IPs'),
				'User' => _STATS('Users'),
				'Type' => _STATS('SSH version'),
				),
			'BriefStats' => array(
				'Type' => _STATS('SSH version'),
				'Reason' => _STATS('Failure reason'),
				'IP' => _STATS('Client IPs'),
				'User' => _STATS('Users'),
				),
			'Counters' => array(),
			),
		'Failures' => array(
			'Title' => _STATS('Failed attempts'),
			'Needle' => '(Failed .* for )',
			'Color' => 'Red',
			'NVPs' => array(
				'IP' => _STATS('Client IPs'),
				'User' => _STATS('Failed users'),
				'Type' => _STATS('SSH version'),
				'Reason' => _STATS('Failure reason'),
				),
			),
		'Successes' => array(
			'Title' => _STATS('Successful logins'),
			'Needle' => '(Accepted .* for )',
			'Color' => 'Green',
			'NVPs' => array(
				'IP' => _STATS('Client IPs'),
				'User' => _STATS('Logged in user'),
				'Type' => _STATS('SSH version'),
				),
			),
		),
    'ftp-proxy' => array(
		'Total' => array(
			'Title' => _STATS('All sessions'),
			'Cmd' => '/bin/cat <LF>',
			'Needle' => '(FTP session )',
			'Color' => '#004a4a',
			'NVPs' => array(
				'Client' => _STATS('Client'),
				'Server' => _STATS('Server'),
				),
			'BriefStats' => array(
				'Client' => _STATS('Client'),
				'Server' => _STATS('Server'),
				),
			),
		),
    'p3scan' => array(
		'Total' => array(
			'Title' => _STATS('All requests'),
			'Cmd' => '/bin/cat <LF>',
			'Needle' => '( p3scan\[)',
			'NVPs' => array(),
			'BriefStats' => array(
				'Result' => _STATS('Results'),
				'Virus' => _STATS('Infected'),
				'User' => _STATS('Account name'),
				'SrcIP' => _STATS('Source IPs'),
				'DstIP' => _STATS('Destination IPs'),
				'Mails' => _STATS('E-mails per request'),
				),
			'Counters' => array(
				'Mails' => array(
					'Field' => 'Mails',
					'Title' => _STATS('Number of e-mails'),
					'Color' => 'Blue',
					'NVPs' => array(
						'Result' => _STATS('Results'),
						),
					),
				'Bytes' => array(
					'Field' => 'Bytes',
					'Title' => _STATS('Processed (KB)'),
					'Color' => '#FF8000',
					'Divisor' => 1000,
					'NVPs' => array(
						),
					),
				),
			),
		'Requests' => array(
			'Title' => _STATS('All requests'),
			'Needle' => '(Connection from )',
			'Color' => '#004a4a',
			'NVPs' => array(
				'Date' => _STATS('Requests by date'),
				'SrcIP' => _STATS('Source IPs'),
				),
			),
		'Results' => array(
			'Title' => _STATS('Relay results'),
			'Needle' => '(Session done )',
			'Color' => '#004a4a',
			'NVPs' => array(
				'Result' => _STATS('Results'),
				'Mails' => _STATS('E-mails per request'),
				),
			),
		'Infected' => array(
			'Title' => _STATS('Infected e-mails'),
			'Needle' => '( virus:)',
			'Color' => 'red',
			'NVPs' => array(
				'From' => _STATS('Senders'),
				'To' => _STATS('Recipients'),
				'Virus' => _STATS('Virus'),
				),
			),
		),
    'smtp-gated' => array(
		'Total' => array(
			'Title' => _STATS('All requests'),
			'Cmd' => '/bin/cat <LF>',
			'Needle' => '(CLOSE |SESSION TAKEOVER: |LOCK:LOCKED)',
			'Color' => '#004a4a',
			'NVPs' => array(
				'SrcIP' => _STATS('Source IPs'),
				'ClosedBy' => _STATS('Closed by'),
				),
			'BriefStats' => array(
				'Scanner' => _STATS('Scan Types'),
				'Result' => _STATS('Scan Results'),
				'Sender' => _STATS('Senders'),
				'Recipient' => _STATS('Recipients'),
				'SrcIP' => _STATS('Source IPs'),
				'LockedIP' => _STATS('Locked IPs'),
				),
			'Counters' => array(
				'Xmted' => array(
					'Field' => 'Xmted',
					'Title' => _STATS('Transmitted (KB)'),
					'Color' => 'Blue',
					'Divisor' => 1000,
					'NVPs' => array(
						'SrcIP' => _STATS('Source IPs'),
						),
					),
				'Rcved' => array(
					'Field' => 'Rcved',
					'Title' => _STATS('Received (KB)'),
					'Color' => '#FF8000',
					'Divisor' => 1000,
					'NVPs' => array(
						'SrcIP' => _STATS('Source IPs'),
						),
					),
				'Trns' => array(
					'Field' => 'Trns',
					'Title' => _STATS('Number of messages'),
					'Color' => 'Blue',
					'NVPs' => array(
						'SrcIP' => _STATS('Source IPs'),
						),
					),
				'Rcpts' => array(
					'Field' => 'Rcpts',
					'Title' => _STATS('Sent messages'),
					'Color' => '#FF8000',
					'NVPs' => array(
						'SrcIP' => _STATS('Source IPs'),
						),
					),
				),
			),
		'ST' => array(
			'Title' => _STATS('Session Takeover'),
			'Needle' => '(SESSION TAKEOVER: |Rejecting |rejected \[|LOCK:LOCKED)',
			'Color' => 'red',
			'NVPs' => array(
				'SrcIP' => _STATS('Source IPs'),
				'STReason' => _STATS('Reasons'),
				),
			),
		'Scan' => array(
			'Title' => _STATS('Virus Scan Requests'),
			'Needle' => 'SCAN:',
			'Color' => 'blue',
			'NVPs' => array(
				'ScanSrcIP' => _STATS('Source IPs'),
				'Result' => _STATS('Scan Results'),
				),
			),
		'Spam' => array(
			'Title' => _STATS('Spam Scan Requests'),
			'Needle' => 'SPAM:',
			'Color' => 'blue',
			'NVPs' => array(
				'ScanSrcIP' => _STATS('Source IPs'),
				'Result' => _STATS('Scan Results'),
				),
			),
		'Results' => array(
			'Title' => _STATS('Relay results'),
			'Needle' => '(RCPT TO:|rejected)',
			'Color' => '#004a4a',
			'NVPs' => array(
				'Sender' => _STATS('Senders'),
				'Recipient' => _STATS('Recipients'),
				'RResult' => _STATS('Results'),
				),
			),
		),
    'snortalerts' => array(
		'Total' => array(
			'Title' => _STATS('All alerts'),
			'Cmd' => '/bin/cat <LF>',
			'Needle' => '( -> )',
			'Color' => '#004a4a',
			'NVPs' => array(
				'SrcIP' => _STATS('Source IPs'),
				'DstIP' => _STATS('Target IPs'),
				'SPort' => _STATS('Source Ports'),
				'DPort' => _STATS('Target Ports'),
				),
			'BriefStats' => array(
				'SrcIP' => _STATS('Source IPs'),
				'DstIP' => _STATS('Target IPs'),
				'DPort' => _STATS('Target Ports'),
				'Prio' => _STATS('Priorities'),
				),
			'Counters' => array(),
			),
		'Priorities' => array(
			'Title' => _STATS('Priorities'),
			'Needle' => '( -> )',
			'Color' => 'Red',
			'NVPs' => array(
				'Prio' => _STATS('Priority'),
				),
			),
		'Names' => array(
			'Title' => _STATS('Attack Types'),
			'Needle' => '( -> )',
			'Color' => 'Blue',
			'NVPs' => array(
				'Log' => _STATS('Type'),
				),
			),
		),
    'snortips' => array(
		'Total' => array(
			'Title' => _STATS('All un/blocks and extensions'),
			'Cmd' => '/bin/cat <LF>',
			'Needle' => '(Blocking|Unblocking|extending| blocking)',
			'Color' => '#004a4a',
			'NVPs' => array(
				'Blocked' => _STATS('Blocked Hosts'),
				'Unblocking' => _STATS('Unblocked Hosts'),
				'Extended' => _STATS('Extended Hosts'),
				),
			'BriefStats' => array(
				'Softinit' => _STATS('Soft inits (unblock all)'),
				'Blocked' => _STATS('Blocked Hosts'),
				'Extended' => _STATS('Extended Hosts'),
				'Unblocking' => _STATS('Unblocked Hosts'),
				'BlockedTime' => _STATS('Blocked Times (sec)'),
				),
			'Counters' => array(
				'BlockedTime' => array(
					'Field' => 'BlockedTime',
					'Title' => _STATS('Blocked Times (min)'),
					'Color' => '#FF8000',
					'Divisor' => 60,
					'NVPs' => array(
						'Blocked' => _STATS('Blocked Hosts'),
						),
					),
				'ExtendedTime' => array(
					'Field' => 'ExtendedTime',
					'Title' => _STATS('Extended Times (min)'),
					'Color' => '#FF8000',
					'Divisor' => 60,
					'NVPs' => array(
						'Extended' => _STATS('Extended Hosts'),
						),
					),
				),
			),
		'Blocked' => array(
			'Title' => _STATS('Blocked Hosts'),
			'Needle' => '(Blocking| blocking)',
			'Color' => 'Red',
			'NVPs' => array(
				'Blocked' => _STATS('Blocked Hosts'),
				'BlockedTime' => _STATS('Blocked Time'),
				),
			),
		'Unblocking' => array(
			'Title' => _STATS('Unblocked Hosts'),
			'Needle' => '(Unblocking)',
			'Color' => 'Green',
			'NVPs' => array(
				'Unblocking' => _STATS('Unblocked Hosts'),
				),
			),
		'Softinit' => array(
			'Title' => _STATS('Soft inits'),
			'Needle' => '(Soft init)',
			'Color' => 'Blue',
			'NVPs' => array(
				'Softinit' => _STATS('Soft inits (unblock all)'),
				),
			),
		),
    'spamassassin' => array(
		'Total' => array(
			'Title' => _STATS('All requests'),
			'Cmd' => '/bin/cat <LF>',
			'Needle' => '( spamd\[)',
			'NVPs' => array(),
			'BriefStats' => array(),
			'Counters' => array(
				'Ham' => array(
					'Field' => 'Ham',
					'Title' => _STATS('Ham'),
					'Color' => 'Green',
					'NVPs' => array(
						'User' => _STATS('Account name'),
						),
					),
				'Spam' => array(
					'Field' => 'Spam',
					'Title' => _STATS('Spam'),
					'Color' => 'Red',
					'NVPs' => array(
						'User' => _STATS('Account name'),
						),
					),
				'Bytes' => array(
					'Field' => 'Bytes',
					'Title' => _STATS('Processed (KB)'),
					'Color' => '#FF8000',
					'Divisor' => 1000,
					'NVPs' => array(
						'User' => _STATS('Account name'),
						),
					),
				'Seconds' => array(
					'Field' => 'Seconds',
					'Title' => _STATS('Processing time (sec)'),
					'Color' => '#FF8000',
					'NVPs' => array(
						'User' => _STATS('Account name'),
						),
					),
				),
			),
		'Requests' => array(
			'Title' => _STATS('All requests'),
			'Cmd' => "/usr/bin/grep -a ' spamd\[' <LF>",
			'Needle' => ' bytes.',
			'Color' => '#004a4a',
			'NVPs' => array(
				'User' => _STATS('Account name'),
				),
			),
		),
    'squid' => array(
		'Total' => array(
			'Title' => _STATS('All requests'),
			'Cmd' => '/bin/cat <LF>',
			'Needle' => '',
			'Color' => '#004a4a',
			'NVPs' => array(
				'Link' => _STATS('Links'),
				'Mtd' => _STATS('Methods'),
				'Target' => _STATS('Target'),
				'Code' => _STATS('HTTP Codes'),
				),
			'BriefStats' => array(
				'Link' => _STATS('Links'),
				'Mtd' => _STATS('Methods'),
				'Code' => _STATS('HTTP Codes'),
				'Cache' => _STATS('Cache'),
				'Type' => _STATS('Type'),
				),
			'Counters' => array(
				'Sizes' => array(
					'Field' => 'Size',
					'Title' => _STATS('Downloaded (KB)'),
					'Color' => '#FF8000',
					'Divisor' => 1000,
					'NVPs' => array(
						'Link' => _STATS('Size by Link (KB)'),
						'Target' => _STATS('Size by Target (KB)'),
						),
					),
				),
			),
		),
    'apachelogs' => array(
		'Total' => array(
			'Title' => _STATS('All requests'),
			'Cmd' => '/bin/cat <LF>',
			'Needle' => '',
			'Color' => '#004a4a',
			'NVPs' => array(
				'IP' => _STATS('Clients'),
				'Link' => _STATS('Links'),
				'Mtd' => _STATS('Methods'),
				'Code' => _STATS('HTTP Codes'),
				),
			'BriefStats' => array(
				'IP' => _STATS('Clients'),
				'Mtd' => _STATS('Methods'),
				'Code' => _STATS('HTTP Codes'),
				'Link' => _STATS('Links'),
				),
			'Counters' => array(
				'Sizes' => array(
					'Field' => 'Size',
					'Title' => _STATS('Downloaded (KB)'),
					'Color' => '#FF8000',
					'Divisor' => 1000,
					'NVPs' => array(
						'Link' => _STATS('Size by Link (KB)'),
						'IP' => _STATS('Size by IP (KB)'),
						),
					),
				),
			),
		),
    'spamd' => array(
		'Total' => array(
			'Title' => _STATS('All connections'),
			'Cmd' => '/bin/cat <LF>',
			'Needle' => '( spamd\[)',
			'NVPs' => array(),
			'BriefStats' => array(
				'List' => _STATS('Blacklists'),
				'IP' => _STATS('Deferred IPs'),
				),
			'Counters' => array(
				'Seconds' => array(
					'Field' => 'Seconds',
					'Title' => _STATS('Total deferred time (sec)'),
					'Color' => 'Green',
					'NVPs' => array(
						'IP' => _STATS('IPs'),
						'Seconds' => _STATS('Longest deferred (sec)'),
						'Date' => _STATS('Connections by date'),
						'List' => _STATS('Blacklists'),
						),
					),
				),
			),
		'Requests' => array(
			'Title' => _STATS('All connections'),
			'Needle' => ' disconnected ',
			'Color' => '#004a4a',
			'NVPs' => array(
				'IP' => _STATS('IPs'),
				'List' => _STATS('Blacklists'),
				'Date' => _STATS('Connections by date'),
				),
			),
		),
	);

/// Models to get statuses
$ModelsToStat= array(
	'pf',
	'e2guardian',
	'squid',
	'snort',
	'snortips',
	'spamassassin',
	'clamav',
	'p3scan',
	'smtp-gated',
	'imspector',
	'dhcpd',
	'named',
	'openvpn',
	'openssh',
	'ftp-proxy',
	'dante',
	'spamd',
	'apache',
	'monitoring',
	);

$PF_CONFIG_PATH= '/etc/pfre';
$TMP_PATH= '/tmp';

$TEST_DIR_PATH= '';
/// @attention Necessary to set to '/utmfw' instead of '' to fix $ROOT . $TEST_DIR_SRC in model.php
$TEST_DIR_SRC= '/utmfw';
$INSTALL_USER= 'root';
?>