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

namespace View;

class Scrub extends Filter
{
	function display($ruleNumber, $count)
	{
		$this->dispHead($ruleNumber);
		$this->dispAction();
		$this->dispValue('direction', _TITLE('Direction'));
		$this->dispInterface();
		$this->dispLog();
		$this->dispValue('proto', _TITLE('Proto'));
		$this->dispSrcDest();
		$this->dispValue('min-ttl', _TITLE('Min-ttl'));
		$this->dispValue('max-mss', _TITLE('Max-mss'));
		$this->dispScrubOpts();
		$this->dispTail($ruleNumber, $count);
	}

	function dispScrubOpts()
	{
		?>
		<td title="<?php echo _TITLE('Options') ?>">
			<?php echo ($this->rule['no-df'] ? 'no-df<br>' : '') . ($this->rule['random-id'] ? 'random-id<br>' : '') . ($this->rule['reassemble'] ? 'reassemble ' . $this->rule['reassemble'] . '<br>' : ''); ?>
		</td>
		<?php
	}

	function input()
	{
		$this->inputAction();

		$this->inputFilterHead();

		$this->inputLog();
		$this->inputBool('quick');

		$this->inputBool('no-df');
		$this->inputBool('random-id');
		/// @todo This is bool actually, fix parser first
		$this->inputKey('reassemble');
		$this->inputKey('min-ttl');
		$this->inputKey('max-mss');

		$this->inputFilterOpts();

		$this->inputKey('comment');
		$this->inputDelEmpty();
	}

	function edit($ruleNumber, $modified, $testResult, $generateResult, $action)
	{
		$this->editIndex= 0;
		$this->ruleNumber= $ruleNumber;

		$this->editHead($modified);

		$this->editAction();

		$this->editFilterHead();

		$this->editLog();
		$this->editCheckbox('quick', _TITLE('Quick'));

		$this->editScrubOptions();
		$this->editText('min-ttl', _TITLE('Min TTL'), NULL, 10, _CONTROL('number'));
		$this->editText('max-mss', _TITLE('Max MSS'), NULL, 10, _CONTROL('number'));

		$this->editFilterOpts();

		$this->editComment();
		$this->editTail($modified, $testResult, $generateResult, $action);
	}

	function editScrubOptions()
	{
		?>
		<tr class="<?php echo ($this->editIndex++ % 2 ? 'evenline' : 'oddline'); ?>">
			<td class="title">
				<?php echo _TITLE('Scrub Options').':' ?>
			</td>
			<td>
				<input type="checkbox" id="no-df" name="no-df" value="no-df" <?php echo ($this->rule['no-df'] ? 'checked' : '')?> />
				<label for="no-df">no-df</label>
				<?php $this->editHelp('no-df') ?>
				<br>
				<input type="checkbox" id="random-id" name="random-id" value="random-id" <?php echo ($this->rule['random-id'] ? 'checked' : '')?> />
				<label for="random-id">random-id</label>
				<?php $this->editHelp('random-id') ?>
				<br>
				<input type="checkbox" id="reassemble" name="reassemble" value="tcp" <?php echo ($this->rule['reassemble'] == 'tcp' ? 'checked' : '')?> />
				<label for="reassemble">reassemble tcp</label>
				<?php $this->editHelp('reassemble-tcp') ?>
			</td>
		</tr>
		<?php
	}
}
?>