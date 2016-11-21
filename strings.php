<?php

// Replacement eloqua footer
$footer = <<<EOT
<TABLE>
<TBODY>
<TR>
<TD vAlign=top align=left></TD></TR>
<TR>
<TD vAlign=top align=left></TD></TR></TBODY></TABLE></TD></TR></TBODY></TABLE></TD></TR>
<TR>
<TD vAlign=top align=left></TD></TR></TBODY></TABLE></TD>
<TR>
<TD vAlign=top align=left><FONT style="FONT-SIZE: 11px; COLOR: #a4a3a3"><FONT face=Verdana></BR>To manage your email preferences, please go <a href="http://mcafee.imiinc.com/nai7642/addUnsubscribe.do">here.</a></BR></BR>
McAfee, Inc.| 2821 Mission College Blvd | Santa Clara, CA | 95054 | 888.847.8766 | <a href="www.mcafee.com/us">www.mcafee.com</a></BR></BR>
McAfee and/or additional marks herein are registered trademarks or trademarks of McAfee, Inc. and/or its affiliates in the US and/or other countries. McAfee Red in connection with security is distinctive of McAfee brand products. All other registered and unregistered trademarks herein are the sole property of their respective owners. © 2011 McAfee, Inc. All rights reserved
</FONT></TD></TR>
</TBODY></TABLE>
<p></p>
</TD></TR></TBODY></TABLE>
EOT;

// Reg-ex for extracting the lids
$findlid = '/.*?\&lid\=(\d+?)\&.*/';

$folder = 'include/';
// Header replacement regular expression
$header_rep = '/.*?view.*?\s*as\s*a\s*web\s*page.*$/i';

// footer search string
$footer = '/\'*?\"*?.*?e\/footerimages\/fi9.*?/i';
$footer2 = '/\'*?\"*?.*?app\.en25\.com\/.*?FooterImages\/FooterImag.*/i';

$footer_rep1 = '/.*?To\s*manage\s*your\s*email\s*preferences.*?/i';
$footer_rep2 = '/.*?Manage\s*your\s*subscription\..*?Privacy\s*Policy.*/i';
$footer_rep3 = '/.*?You\s*are.*?Partner\s*Portal.*/i';
$footer_rep4 = '/.*?McAfee\s*Asia\s*Pacific\s*\|.*?All\s*Rights\s*Reserved.*/i';
?>