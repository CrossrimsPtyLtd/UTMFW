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

use View\RuleSet;

require_once('../lib/vars.php');

$LogConf = array(
	'pf' => array(
		'Fields' => array(
			'Date',
			'Time',
			'Rule',
			'Act',
			'Dir',
			'If',
			'SrcIP',
			'SPort',
			'DstIP',
			'DPort',
			'Type',
			'Log',
			),
		'HighlightLogs' => array(
			'Col' => 'Act',
			'REs' => array(
				'red' => array('\bblock\b'),
				'yellow' => array('\bmatch\b'),
				'green' => array('\bpass\b'),
				),
			),
		),
	);

class Pf extends View
{
	public $Model= 'pf';

	public $RuleSet;

	function __construct()
	{
		$this->Module= basename(dirname($_SERVER['PHP_SELF']));
		$this->Caption= _TITLE('Packet Filter');

		if (!isset($_SESSION['pf']['ruleset'])) {
			$_SESSION['pf']['ruleset']= new RuleSet();
		}
		$this->RuleSet= &$_SESSION['pf']['ruleset'];

		$this->LogsHelpMsg= _HELPWINDOW('What is recorded in packet filter logs is determined by pf rules you can configure under Rules tab.');
	}

	/**
	 * Builds PF (tcpdump) specific string from $date.
	 *
	 * @param array $date Datetime struct
	 */
	function FormatDate($date)
	{
		global $MonthNames;

		return $MonthNames[$date['Month']].' '.$date['Day'];
	}
	
	function FormatLogCols(&$cols)
	{
	}

	/**
	 * Gets and lists pf states.
	 */
	function PrintStatesTable()
	{
		global $HeadStart, $StartLine, $StateCount, $LinesPerPage, $SearchRegExp;

		PrintLogHeaderForm($StartLine, $StateCount, $LinesPerPage, $SearchRegExp, '');
		$this->Controller($output, 'GetStateList', $HeadStart, $LinesPerPage, $SearchRegExp);
		$states= json_decode($output[0], TRUE);

		$total= count($states);
		if ($total > 0) {
			?>
			<table id="logline">
			<?php
			$this->PrintStatesTableHeader();
			$linenum= 0;
			foreach ($states as $cols) {
				$class= ($linenum++ % 2 == 0) ? 'evenline' : 'oddline';
				?>
				<tr class="<?php echo $class ?>">
					<td class="center">
						<?php echo $linenum + $StartLine ?>
					</td>
					<?php
					$count= 1;
					foreach ($cols as $c) {
						if (in_array($count, array(1, 2, 5, 6, 7))) {
							$class= 'class="center"';
						}
						else if (in_array($count, array(8, 9))) {
							$class= 'class="right"';
						}
						else {
							$class= '';
						}
						?>
						<td <?php echo $class ?>>
							<?php echo $c ?>
						</td>
						<?php
						$count++;
					}
					?>
				</tr>
				<?php
			}
			?>
			</table>
			<?php
		}
	}

	/**
	 * Prints headers for states table.
	 *
	 * PR    D SRC   DEST  STATE   AGE   EXP  PKTS BYTES
	 */
	function PrintStatesTableHeader()
	{
		?>
		<tr id="logline">
			<th><?php echo _('Line') ?></th>
			<th><?php echo _('Proto') ?></th>
			<th><?php echo _('Dir') ?></th>
			<th><?php echo _('Source') ?></th>
			<th><?php echo _('Dest') ?></th>
			<th><?php echo _('State') ?></th>
			<th><?php echo _('Age') ?></th>
			<th><?php echo _('Expr') ?></th>
			<th><?php echo _('Packets') ?></th>
			<th><?php echo _('Bytes') ?></th>
		</tr>
		<?php
	}
}

$View= new Pf();

// Load the main pf configuration if the ruleset is empty
if ($View->RuleSet->filename == '') {
	$filepath= '/etc/pf.conf';
	$ruleSet= new RuleSet();
	if ($ruleSet->load($filepath, 0, TRUE)) {
		$View->RuleSet= $ruleSet;
		PrintHelpWindow(_NOTICE('Rules loaded') . ': ' . $View->RuleSet->filename);
	} else {
		PrintHelpWindow('<br>' . _NOTICE('Failed loading') . ": $filepath", NULL, 'ERROR');
	}
}
?>