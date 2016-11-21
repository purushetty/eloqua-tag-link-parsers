<?php
class validate {

	public $filename = '';

	  // Replacement eloqua footer
	  /* public $india_footer = <<<EOT1
1231, 3rd Floor, Solitaire Park Building No. 12 Chakala, Opp. Hotel Mirador, Guru Hargovindji Marg | Andheri-Ghatkopar Link Road | Andheri (East), Mumbai 40093 India | +91 (22) 4029-1300 | <a href="http://www.mcafee.com/in">www.mcafee.com/in</a>
EOT1; */

	  // Replacement eloqua footer for India
public $india_footer = <<<EOT1
<div class="block"> <table width="100%" cellspacing="0" cellpadding="0" border="0" bgcolor="#ffffff"> <tbody> <tr> <td width="100%" class=""> <table width="600" align="center" style="border-collapse:collapse;" class="devicewidth"> <tbody> <tr valign="top"> <td valign="top" bgcolor="#e6e7e8" class="" colsapn="2" style="text-align:center; height:35px; width:600px; margin:0; border-collapse:collapse;"> <p class="" style="text-align:center; font:10px/14px Verdana, Arial, sans-serif; font-weight:300; color:#AA0828; margin-bottom:8px; margin-top:8px"><a href="http://www.mcafee.com/au/enterprise/reference-architecture/index.aspx?elq=5c009a672f8149aab4611d12df0554a3&elqCampaignId=6486&elqaid=9612&elqat=1&elqTrackId=c7752c5d8f914b7899244b5138565c57" style="text-decoration:none;color:#AA0828;">Security Connected</a> | <a href="http://blogs.mcafee.com/?elq=5c009a672f8149aab4611d12df0554a3&elqCampaignId=6486&elqaid=9612&elqat=1&elqTrackId=79d6097ac9e14bfd97a204479cdab52b" style="text-decoration:none;color:#AA0828;">Blogs</a> | <a href="https://apac2.secureforms.mcafee.com/ContactMe?elq=5c009a672f8149aab4611d12df0554a3&elqCampaignId=6486&elqaid=9612&elqat=1&elqTrackId=fc966ff48d0247009d6db8ceecc25896" style="text-decoration:none;color:#AA0828;">Contact Us</a> </p> </td> </tr><tr> <td width="100%" height="20" class=""></td> </tr><tr> <td width="100%" height="20" class=""><table align="center" border="0" cellpadding="0" cellspacing="0" width="100%"> <tbody> <tr> <td align="left" width="100%"> <table align="center" border="0" cellpadding="0" cellspacing="0" width="100%"> <tbody> <tr> <td> <table border="0" cellpadding="0" cellspacing="0" height="74" width="600"> <tbody> <tr> <td width="50%"><a href="http://intelsecuritygroup.com/?elq=5c009a672f8149aab4611d12df0554a3&elqCampaignId=6486&elqaid=9612&elqat=1&elqTrackId=ab8aeb6a30a34426a943cf67ab185bba"><img border="0" src="http://images.demand.mcafee.com/EloquaImages/clients/McAfeeE10BuildProduction/%7B7f75bb61-0dcc-46d1-b303-f8e0a7d7c048%7D_IMGSMLIntel-Logo-150x48-SterlingBailey.jpg" style="cursor: default; width: 150px; height: 48px;"></a> <p style="font-family: Verdana, Geneva, sans-serif; font-size: 12px; color: rgb(170, 8, 40); margin: 10px 0px 0px 3px; font-weight: bold;">McAfee. Part of Intel Security.</p> </td> <td align="right" valign="top" width="50%"><a data-targettype="webpage" href="https://twitter.com/IntelSec_APAC?elq=5c009a672f8149aab4611d12df0554a3&elqCampaignId=6486&elqaid=9612&elqat=1&elqTrackId=472ea9d3104542108e0b2fd8053dd357" target="_blank" title="Twitter"><img alt="Twitter" border="0" height="28" src="http://images.demand.mcafee.com/eloquaimages/clients/McAfee/%7Bb2d7ac38-bdde-406d-bc66-3496d96c564f%7D_Image-8-24x28.jpg" style="display: inline-block; width: 24px; height: 28px; margin: 0px 10px;" width="24"></a><a data-targettype="webpage" href="https://www.facebook.com/IntelSecAPAC?elq=5c009a672f8149aab4611d12df0554a3&elqCampaignId=6486&elqaid=9612&elqat=1&elqTrackId=c11d38a041a6407393070a7b72f380fd" target="_blank" title="Facebook"><img alt="Facebook" border="0" height="28" src="http://images.demand.mcafee.com/eloquaimages/clients/McAfee/%7Beb251b85-51a6-41c1-8d4d-f8061ab54d9c%7D_Image-9-23x28.jpg" style="display: inline-block; width: 23px; height: 28px; margin: 0px 10px;" width="23"></a><a href="https://www.linkedin.com/company/intelsecurity?elq=5c009a672f8149aab4611d12df0554a3&elqCampaignId=6486&elqaid=9612&elqat=1&elqTrackId=45a48a1b511048eab2082c2ea39c6df3" target="_blank" title="LinkedIn"><img alt="Linkedin" border="0" height="28" src="http://images.demand.mcafee.com/eloquaimages/clients/McAfee/%7B2dd66d88-e7e1-4aeb-946e-98e4392a5f84%7D_Image-10-24x28.jpg" style="display: inline-block; width: 25px; height: 28px; margin: 0px 10px;" width="25"></a><a href="http://blogs.mcafee.com/?elq=5c009a672f8149aab4611d12df0554a3&elqCampaignId=6486&elqaid=9612&elqat=1&elqTrackId=d0873e280f7943b79627c3f56c143707" target="_blank" title="Blogs"><img alt="RSS" border="0" height="28" src="http://images.demand.mcafee.com/eloquaimages/clients/McAfee/%7B0aee11ed-8fb9-4494-bcf6-1af94c11e889%7D_Image-11-23x28.jpg" style="display: inline-block; width: 23px; height: 28px; margin: 0px 10px;" width="23"></a><a href="https://apac2.secureforms.mcafee.com/ContactMe?elq=5c009a672f8149aab4611d12df0554a3&elqCampaignId=6486&elqaid=9612&elqat=1&elqTrackId=7be83336d7b743988d9b3decaf198e46" target="_blank" title="Contact McAfee"><img alt="Email" border="0" height="28" src="http://images.demand.mcafee.com/eloquaimages/clients/McAfee/%7Be9065764-75c8-4769-9d93-ffcad79c2158%7D_Image-12-25x28.jpg" style="display: inline-block; width: 25px; height: 28px; margin: 0px 10px;" width="25"></a></td> </tr> </tbody> </table> </td> </tr> <tr> <td>&nbsp;</td> </tr> <tr> <td style="border-top-color: rgb(84, 83, 83); border-top-width: 3px; border-top-style: solid;">&nbsp;</td> </tr> <tr> <td><span style="line-height: 13px; font-size: 10px;"><font style="font-family: Verdana;"><a href="http://demand.mcafee.com/CommunicationCenter/AU?elq=5c009a672f8149aab4611d12df0554a3&elqCampaignId=6486&elqaid=9612&elqat=1&elqTrackId=074553d0fcf24b4d85df8ad6b642ce89" style="color: rgb(136, 136, 136);">Manage your McAfee communications</a><span style="color: rgb(136, 136, 136);">&nbsp;&nbsp;</span><font color="#888888" style="color: rgb(136, 136, 136);">|</font><span style="color: rgb(136, 136, 136);">&nbsp;&nbsp;</span><a href="http://www.mcafee.com/common/privacy/english/index.htm?elq=5c009a672f8149aab4611d12df0554a3&elqaid=9612&elqat=1&elqTrackId=b0ac2cddf07643479b216d4138d53d5e" style="color: rgb(136, 136, 136);" target="_blank"><font color="#888888">Privacy statement</font></a></font></span></td> </tr> <tr> <td><span style="line-height: 15px; font-size: 10px;"><font style="font-family: Verdana;"><span style="color: rgb(136, 136, 136);">McAfee India | 1231, 3rd Floor, Solitaire Park Building No. 12 Chakala, Opp. Hotel Mirador, Guru Hargovindji Marg | Andheri-Ghatkopar Link Road | Andheri (East), Mumbai 40093 India | +91 (22) 4029-1300 |&nbsp;</span><font style="color: rgb(136, 136, 136);"><a href="http://www.mcafee.com/in">www.mcafee.com/in</a></font></font></span><br> <br> <span style="color: rgb(136, 136, 136); font-family: Verdana; font-size: 10px; line-height: 15px;">Please note: you cannot reply to this email address. If you have any questions, please use the links provided. All the information contained in this document is for marketing and promotional purposes only, and is subject to change at McAfee discretion, and its accuracy should not be relied upon by the reader. McAfee is part of Intel Security. McAfee and the M-shield are trademarks or registered trademarks of McAfee, Inc. The Intel logo is the trademark of Intel Corporation in the U.S. and/or other countries. All other registered and unregistered trademarks herein are the sole property of their respective owners. &copy; 2015 McAfee, Inc. All rights reserved.</span></td> </tr> </tbody> </table> </td> </tr> </tbody> </table> </td> </tr> <tr valign="top"> <td class=""> </td> </tr> </tbody> </table> </td> </tr> </tbody> </table> </div>
EOT1;
/* public $anz_footer = <<<EOT2
McAfee Asia Pacific | Level 20, 201 Miller Street | North Sydney, NSW, Australia | 2060 | +61 2 97614200 | <a href="http://www.mcafee.com/au">www.mcafee.com/au</a>
EOT2; */

	  // Replacement eloqua footer for ANZ
public $anz_footer = <<<EOT2
<div class="block">
  <table width="100%" cellspacing="0" cellpadding="0" border="0" bgcolor="#ffffff">
    <tbody>
      <tr>
        <td width="100%" class="">
          <table width="600" align="center" style="border-collapse:collapse;" class="devicewidth">
            <tbody>
              <tr>
                <td width="100%" height="20"></td>
              </tr>
              <tr valign="top">
                <td valign="top" bgcolor="#ffffff" class="" colsapn="2" style="text-align:center; height:35px; width:600px; margin:0; border-collapse:collapse;">
                 <table align="center" border="0" cellpadding="0" cellspacing="0" width="100%">
	<tbody>
		<tr>
			<td align="left" width="100%">
			<table align="center" border="0" cellpadding="0" cellspacing="0" width="100%">
				<tbody>
					<tr>
						<td>
						<table border="0" cellpadding="0" cellspacing="0" height="74" width="600">
							<tbody>
								<tr>
									<td width="50%"><a href="http://intelsecuritygroup.com/"><img border="0" src="http://images.demand.mcafee.com/EloquaImages/clients/McAfeeE10BuildProduction/%7B7f75bb61-0dcc-46d1-b303-f8e0a7d7c048%7D_IMGSMLIntel-Logo-150x48-SterlingBailey.jpg" style="cursor: default; width: 150px; height: 48px;"></a>
									<p style="font-family: Verdana, Geneva, sans-serif; font-size: 12px; color: rgb(170, 8, 40); margin: 10px 0px 0px 3px; font-weight: bold;">McAfee. Part of Intel Security.</p>
									</td>
									<td align="right" valign="top" width="50%"><a data-targettype="webpage" href="https://twitter.com/IntelSec_APAC" target="_blank" title="Twitter"><img alt="Twitter" border="0" height="28" src="http://images.demand.mcafee.com/eloquaimages/clients/McAfee/%7Bb2d7ac38-bdde-406d-bc66-3496d96c564f%7D_Image-8-24x28.jpg" style="display: inline-block; width: 24px; height: 28px; margin: 0px 10px;" width="24"></a><a data-targettype="webpage" href="https://www.facebook.com/IntelSecAPAC" target="_blank" title="Facebook"><img alt="Facebook" border="0" height="28" src="http://images.demand.mcafee.com/eloquaimages/clients/McAfee/%7Beb251b85-51a6-41c1-8d4d-f8061ab54d9c%7D_Image-9-23x28.jpg" style="display: inline-block; width: 23px; height: 28px; margin: 0px 10px;" width="23"></a><a href="https://www.linkedin.com/company/intelsecurity" target="_blank" title="LinkedIn"><img alt="Linkedin" border="0" height="28" src="http://images.demand.mcafee.com/eloquaimages/clients/McAfee/%7B2dd66d88-e7e1-4aeb-946e-98e4392a5f84%7D_Image-10-24x28.jpg" style="display: inline-block; width: 25px; height: 28px; margin: 0px 10px;" width="25"></a><a href="http://blogs.mcafee.com/" target="_blank" title="Blogs"><img alt="RSS" border="0" height="28" src="http://images.demand.mcafee.com/eloquaimages/clients/McAfee/%7B0aee11ed-8fb9-4494-bcf6-1af94c11e889%7D_Image-11-23x28.jpg" style="display: inline-block; width: 23px; height: 28px; margin: 0px 10px;" width="23"></a><a href="https://apac2.secureforms.mcafee.com/ContactMe" target="_blank" title="Contact McAfee"><img alt="Email" border="0" height="28" src="http://images.demand.mcafee.com/eloquaimages/clients/McAfee/%7Be9065764-75c8-4769-9d93-ffcad79c2158%7D_Image-12-25x28.jpg" style="display: inline-block; width: 25px; height: 28px; margin: 0px 10px;" width="25"></a></td>
								</tr>
							</tbody>
						</table>
						</td>
					</tr>
					<tr>
						<td>&nbsp;</td>
					</tr>
					<tr> 						<td style="border-top-color: rgb(84, 83, 83); border-top-width: 3px; border-top-style: solid;">&nbsp;</td> 					</tr> 					<tr> 						<td><span style="line-height: 13px; font-size: 10px;"><font style="font-family: Verdana;"><a href="http://demand.mcafee.com/CommunicationCenter/AU" style="color: rgb(136, 136, 136);">Manage your McAfee communications</a><span style="color: rgb(136, 136, 136);">&nbsp;&nbsp;</span><font color="#888888" style="color: rgb(136, 136, 136);">|</font><span style="color: rgb(136, 136, 136);">&nbsp;&nbsp;</span><a href="http://www.mcafee.com/common/privacy/english/index.htm" style="color: rgb(136, 136, 136);" target="_blank"><font color="#888888">Privacy statement</font></a></font></span></td> 					</tr> 					
                    <tr> 						<td><span style="line-height: 15px; font-size: 10px;"><font style="font-family: Verdana;"><span style="color: rgb(136, 136, 136);">McAfee Asia Pacific | Level 20, 201 Miller Street | North Sydney, NSW, Australia | 2060 | +61 2 97614200 |&nbsp;</span><a href="http://www.mcafee.com/au" style="color: rgb(136, 136, 136);">www.mcafee.com/au</a></font></span><br> 						<br> 						<span style="color: rgb(136, 136, 136); font-family: Verdana; font-size: 10px; line-height: 15px;">Please note: you cannot reply to this email address. If you have any questions, please use the links provided. All the information contained in this document is for marketing and promotional purposes only, and is subject to change at McAfee discretion, and its accuracy should not be relied upon by the reader. McAfee is part of Intel Security. McAfee and the M-shield are trademarks or registered trademarks of McAfee, Inc. The Intel logo is the trademark of Intel Corporation in the U.S. and/or other countries. All other registered and unregistered trademarks herein are the sole property of their respective owners. &copy; 2015 McAfee, Inc. All rights reserved.</span></td> 					</tr>
				</tbody>
			</table>
			</td>
		</tr>
	</tbody>
</table>
 
                <p>
              </p></td>
            </tr>
            <tr valign="top">
              <td></td>
            </tr>
          </tbody>
        </table>
      </td>
    </tr>
  </tbody>
</table>
</div>
EOT2;
/*	  public $sea_footer = <<<EOT3
McAfee Singapore Pte Ltd. | 10 Kallang Avenue | Aperia Tower 2 #06-10 | Singapore 339510 | +65 6222-7555 | <a href="http://www.mcafee.com/sg">www.mcafee.com/sg</a>
EOT3; */
	  // Replacement eloqua footer for SEA
public $sea_footer = <<<EOT3
<div class="block">

   <table cellspacing="0" cellpadding="0" border="0" bgcolor="#ffffff" width="100%" st-sortable="postfooter" id="backgroundTable">
      <tbody>
         <tr>
            <td width="100%" class="">
              	<table align="center" width="600" class="devicewidth" style="border-collapse:collapse;">
									<tbody><tr valign="top">
										<td bgcolor="#ffffff" valign="top" class="" colsapn="2" style="text-align:center; height:35px; width:600px; margin:0; border-collapse:collapse;">
											<p class="" style="text-align:center; font:10px/14px Arial, Verdana, sans-serif; font-weight:300; color:#AA0828; margin-bottom:8px; margin-top:8px"><a href="www.mcafee.com/au/enterprise/reference-architecture/index.aspx" style="text-decoration:none;color:#AA0828;">Security Connected</a> | <a href="blogs.mcafee.com/" style="text-decoration:none;color:#AA0828;">Blogs</a>
 | <a href="https://apac2.secureforms.mcafee.com/ContactMe" style="text-decoration:none;color:#AA0828;">Contact Us</a>
											</p>
										</td>	
									</tr>
								
									<tr valign="top">
										<td bgcolor="#ffffff" valign="top" style="text-align:center; height:auto; width:600px; margin:0; border-collapse:collapse;" colsapn="2" class=""><table align="center" border="0" cellpadding="0" cellspacing="0" width="100%">
	<tbody>
		<tr>
			<td align="left" width="100%">
			<table align="center" border="0" cellpadding="0" cellspacing="0" width="100%">
				<tbody>
					<tr>
						<td>
						<table border="0" cellpadding="0" cellspacing="0" height="74" width="600">
							<tbody>
								<tr>
									<td width="50%"><a href="http://intelsecuritygroup.com/"><img border="0" src="http://images.demand.mcafee.com/EloquaImages/clients/McAfeeE10BuildProduction/%7B7f75bb61-0dcc-46d1-b303-f8e0a7d7c048%7D_IMGSMLIntel-Logo-150x48-SterlingBailey.jpg" style="cursor: default; width: 150px; height: 48px;"></a>

									<p style="font-family: Verdana, Geneva, sans-serif; font-size: 12px; color: rgb(170, 8, 40); margin: 10px 0px 0px 3px; font-weight: bold;">McAfee. Part of Intel Security.</p>
									</td>
									<td align="right" valign="top" width="50%"><a href="https://twitter.com/mcafee" target="_blank" title="Twitter"><img alt="Twitter" border="0" height="28" src="http://images.demand.mcafee.com/eloquaimages/clients/McAfee/%7Bb2d7ac38-bdde-406d-bc66-3496d96c564f%7D_Image-8-24x28.jpg" style="cursor: default; display: inline-block; width: 24px; height: 28px; margin: 0px 10px;" width="24"></a><a href="https://www.facebook.com/McAfee" target="_blank" title="Facebook"><img alt="Facebook" border="0" height="28" src="http://images.demand.mcafee.com/eloquaimages/clients/McAfee/%7Beb251b85-51a6-41c1-8d4d-f8061ab54d9c%7D_Image-9-23x28.jpg" style="cursor: default; display: inline-block; width: 23px; height: 28px; margin: 0px 10px;" width="23"></a><a href="https://www.linkedin.com/company/intelsecurity" target="_blank" title="LinkedIn"><img alt="Linkedin" border="0" height="28" src="http://images.demand.mcafee.com/eloquaimages/clients/McAfee/%7B2dd66d88-e7e1-4aeb-946e-98e4392a5f84%7D_Image-10-24x28.jpg" style="cursor: default; display: inline-block; width: 25px; height: 28px; margin: 0px 10px;" width="25"></a><a href="http://blogs.mcafee.com/" target="_blank" title="Blogs"><img alt="RSS" border="0" height="28" src="http://images.demand.mcafee.com/eloquaimages/clients/McAfee/%7B0aee11ed-8fb9-4494-bcf6-1af94c11e889%7D_Image-11-23x28.jpg" style="cursor: default; display: inline-block; width: 23px; height: 28px; margin: 0px 10px;" width="23"></a><a href="http://www.mcafee.com/us/about/contact-us.aspx" target="_blank" title="Contact McAfee"><img alt="Email" border="0" height="28" src="http://images.demand.mcafee.com/eloquaimages/clients/McAfee/%7Be9065764-75c8-4769-9d93-ffcad79c2158%7D_Image-12-25x28.jpg" style="cursor: default; display: inline-block; width: 25px; height: 28px; margin: 0px 10px;" width="25"></a></td>
								</tr>
							</tbody>
						</table>
						</td>
					</tr>
					<tr>
						<td>&nbsp;</td>
					</tr>
					<tr>
						<td style="border-top-color: rgb(84, 83, 83); border-top-width: 3px; border-top-style: solid;">&nbsp;</td>
					</tr>
					<tr>
						<td><span style="line-height: 13px; font-size: 10px;"><font style="font-family: Verdana;"><a href="http://demand.mcafee.com/CommunicationCenter/AU" style="color: rgb(136, 136, 136);">Manage your McAfee communications</a><span style="color: rgb(136, 136, 136);">&nbsp;&nbsp;</span><font color="#888888" style="color: rgb(136, 136, 136);">|</font><span style="color: rgb(136, 136, 136);">&nbsp;&nbsp;</span><a href="http://www.mcafee.com/common/privacy/english/index.htm" style="color: rgb(136, 136, 136);" target="_blank"><font color="#888888">Privacy statement</font></a></font></span></td>
					</tr>
					<tr>
						<td><span style="line-height: 15px; font-size: 10px;"><font style="font-family: Verdana;"><span style="color: rgb(136, 136, 136);">McAfee Singapore Pte Ltd. | 10 Kallang Avenue | Aperia Tower 2 06-10 | Singapore 339510 | +65 6222-7555 |&nbsp;</span><font style="color: rgb(136, 136, 136);"><a href="http://www.mcafee.com/sg">www.mcafee.com/sg</a></font></font></span><br>
						<br>
						<span style="color: rgb(136, 136, 136); font-family: Verdana; font-size: 10px; line-height: 15px;">Please note: you cannot reply to this email address. If you have any questions, please use the links provided. All the information contained in this document is for marketing and promotional purposes only, and is subject to change at McAfee discretion, and its accuracy should not be relied upon by the reader. McAfee is part of Intel Security. McAfee and the M-shield are trademarks or registered trademarks of McAfee, Inc. The Intel logo is the trademark of Intel Corporation in the U.S. and/or other countries. All other registered and unregistered trademarks herein are the sole property of their respective owners. &copy; 2015 McAfee, Inc. All rights reserved.</span></td>
					</tr>
				</tbody>
			</table>
			</td>
		</tr>
	</tbody>
</table>
<br>
 
										</td>	
									</tr>
								</tbody></table>
            </td>
         </tr>
      </tbody>
   </table>
 

</div>	
EOT3;
// Reg-ex for extracting the lids
	  public $findlid = '/.*?\&lid\=(\d+?)\&.*/';
	  
	  public $folder = 'include/';
	  // Header replacement regular expression
	  public $header_rep = '/.*?view\s*as\s*a\s*web\s*page.*$/i';
	  public $header_rep2 = '/^.*?read\s*the\s*online\s*version.*$/i';
	  
	  // Salutation text pattern match
	  public $sal_text = '/(Dear.*?\,)/i';
	  
	  // footer search string
	  public $footer = '/\'*?\"*?.*?e\/footerimages\/fi9.*?/i';
	  public $footer2 = '/\'*?\"*?.*?app\.en25\.com\/.*?FooterImages\/FooterImag.*/i';
	  public $footer3 = '/http\:\/\/app\.demand\.mcafee\.com\/e\/FooterImages\/FooterImage1.*?\"/i';
  	  public $footer4 = '/http\:\/\/app\.demand\.mcafee\.com\/e\/FooterImages\/FooterImage1.*?\'/i';
	  public $footer5 = '/.*?\.gif.*/i';
	  public $footer6 = '/^.*FooterImages\/FooterImage1.*$/i';

	  public $footer_rep1 = '/.*?To\s*manage\s*your\s*email\s*preferences.*?/i';
	  public $footer_rep2 = '/.*?Manage\s*your\s*subscription\..*?Privacy\s*Policy.*/i';
	  public $footer_rep3 = '/.*?You\s*are.*?Partner\s*Portal.*/i';
	  public $footer_rep4 = '/.*?Please note: you.*?All\s*Rights\s*Reserved.*/i';
	  
	  //public $india_footer = htmlspecialchars('McAfee India | 1231, 3rd Floor, Solitaire Park Building No. 12 Chakala, Opp. Hotel Mirador, Guru Hargovindji Marg | Andheri-Ghatkopar Link Road | Andheri (East), Mumbai 40093 India | +91 (22) 4029-1300 | www.mcafee.com/in');
	  
	  public $surl = array();			// array for storing short google map urls		
	  public $rel_count = 0;			// Counter for relative urls
	  public $brlink_count = 0;		// Counter for broken links
	  public $p_url = array();
	  public $elm1 = '';
	  public $mess = '';
	  public $body = '';
	  public $html = '';
	  public $elq_string = '/(.*?)\?elqCampaignId\=\d+$/i';

	  // The following line of code parses all the urls in the uploaded html and 
	  // and extracts the lids, if any, found within it
	  public $url_count = 0;					// Counter for number of url links in html
	  public $lid_count = 0;					// Count for eloqua redirected urls
	  public $blank_urls = 0;					// Count for eloqua blank links
	  	
	public function __construct() {		
		;
	}
	
	public function get_html($input) {	
		
		if(isset($input['elq1']) && !empty($input['elq1']))
		{
			$this->html = $input['html'];
		}
		else if(isset($input['elq2']) && !empty($input['elq2']))
		{
			;
		}
		else if(isset($input['elq3']) && !empty($input['elq3']))
		{
			$this->html = file_get_html($input['url']);			
		}
		else
		{
			;
		}
		
		return $this->html;
	}
	
	public function get_lid_urls($count) {
						
			for($i=0; $i<$count; $i++)
			{
				if(!empty($_POST['lid'.$i]) || ($_POST['lid'.$i] !== ''))
				{
					$lid_store[$i] = 'full'; 							
				}
				else
				{
					$lid_store[$i] = 'empty';		
				}
			}					
			
			return $lid_store;
	}

	public function fetch_lid_urls($count, $store2) {

			$store1 = array();
			
			for($i=0; $i<$count; $i++)
			{
				//echo $store2[$i].'<br>';
				if(preg_match('/^http:/i', $_POST['lid'.$i]))
				{ 
					$store1[$store2[$i]] = $_POST['lid'.$i]; 
				}
				else
				{
					$store1[$store2[$i]] = 'http://'.$_POST['lid'.$i]; 
				}
			}					
			
			return $store1;
	}
	
	// This method gets the final redirected url from a supplied eloqua url
	public function get_web_page( $url ) {
	    $res = array();
    	$options = array( 
        	CURLOPT_RETURNTRANSFER => true,     // return web page 
	        CURLOPT_HEADER         => false,    // do not return headers 
    	    CURLOPT_FOLLOWLOCATION => true,     // follow redirects 
        	CURLOPT_USERAGENT      => "spider", // who am i 
	        CURLOPT_AUTOREFERER    => true,     // set referer on redirect 
    	    CURLOPT_CONNECTTIMEOUT => 120,      // timeout on connect 
	        CURLOPT_TIMEOUT        => 120,      // timeout on response 
    	    CURLOPT_MAXREDIRS      => 10,       // stop after 10 redirects 
	    ); 
    	$ch      = curl_init( $url ); 
	    curl_setopt_array( $ch, $options ); 
    	$content = curl_exec( $ch ); 
	    $err     = curl_errno( $ch ); 
    	$errmsg  = curl_error( $ch ); 
	    $header  = curl_getinfo( $ch ); 
    	curl_close( $ch ); 

	    //$res['content'] = $content;     
    	$res['url'] = $header['url'];
    	return trim($header['url']); 
	}  	
	

	public function check_url($url) {

	    $ch = curl_init();
    	curl_setopt($ch, CURLOPT_URL, $url);
	    curl_setopt($ch, CURLOPT_HEADER, 1);
    	curl_setopt($ch , CURLOPT_RETURNTRANSFER, 1);
	    $data = curl_exec($ch);
    	$headers = curl_getinfo($ch);
	    curl_close($ch);

    	return $headers['http_code'];
	}

	public function file_html($content) {
	
	    // Filename in write mode.
    	if (!$handle = fopen($this->filename, 'w')) {
        	echo "Cannot open file ($this->filename)";
         	return "fof";
	    }
		else
		{
			// Let's make sure the file exists and is writable first.
			if (is_writable($this->filename)) {

	    		// Write $somecontent to our opened file.
		    	if (fwrite($handle, $content) === FALSE) {
    		    	echo "Cannot write to file ($this->filename)";
	        		return "fwf";
		    	}

			} else {
    			return "nw";
			}

			return "fws";
    		fclose($handle);
		}
	}
		
	function getIP() {
			$ip;
			if (getenv("HTTP_CLIENT_IP"))
			$ip = getenv("HTTP_CLIENT_IP");
			else if(getenv("HTTP_X_FORWARDED_FOR"))
			$ip = getenv("HTTP_X_FORWARDED_FOR");
			else if(getenv("REMOTE_ADDR"))
			$ip = getenv("REMOTE_ADDR");
				else
			$ip = "UNKNOWN";
			return $ip;
		} 
		
	public function short_url($longUrl) {
		 
		$apiKey = 'AIzaSyDiFxqv7-YLm5sjCFLSeZmtmST2I377lFk';
		//Get API key from : http://code.google.com/apis/console/

		$postData = array('longUrl' => $longUrl, 'key' => $apiKey);
		$jsonData = json_encode($postData);

		$curlObj = curl_init();

		curl_setopt($curlObj, CURLOPT_URL, 'https://www.googleapis.com/urlshortener/v1/url');
		curl_setopt($curlObj, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($curlObj, CURLOPT_SSL_VERIFYPEER, 0);
		curl_setopt($curlObj, CURLOPT_HEADER, 0);
		curl_setopt($curlObj, CURLOPT_HTTPHEADER, array('Content-type:application/json'));
		curl_setopt($curlObj, CURLOPT_POST, 1);
		curl_setopt($curlObj, CURLOPT_POSTFIELDS, $jsonData);

		$response = curl_exec($curlObj);

		//change the response json string to object
		$json = json_decode($response);

		curl_close($curlObj);

		//echo 'Shortened URL is: '.$json->id;
		return trim($json->id);
	}
	
	public function check_file_ext($param) {
		
		$res = array();
		$res = explode('.', trim($param));
		
		if(empty($res))
		{		
			return $param.'.html';
		}
		else
		{
			if(!empty($res[1]))
			{
				if(strcasecmp($res[1], 'html') == 0)
				{
					return $param;
				}
			}
			
			return $res[0].'.html';
		}
		
	}
	
}
?>