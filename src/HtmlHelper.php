<?php

class HtmlHelper
{
	public static function viewEffortEstimate($bug)
	{
		$rowClass = helper_alternate_class();
		echo <<<END
	<tr $rowClass>
		<td class="category">
			Effort:
		</td>
		<td>
			Effort value;
		</td>
		<td colspan="4">
			&nbsp;
		</td>
	</tr>
END;
		//echo collapse_closed('effort');
		//echo collapse_end('effort');
	}
}
