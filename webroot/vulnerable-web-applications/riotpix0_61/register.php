<?php
include("conf.php");
include("header.php");

echo "<form method=\"post\"  enctype=\"multipart/form-data\" action=\"register_script.php\">
<center><span class=\"bodymain\">User Signup</span></center>
<table width=\"450\" align=\"center\">
	<tr>
		<td class=\"bodyfont\">First Name:</td>
		<td><input type=\"text\" name=\"fname\" size=\"20\" class=\"border\" /></td>
	</tr>
	<tr>
		<td class=\"bodyfont\">Last Name:</td>
		<td><input type=\"text\" name=\"lname\" size=\"20\" class=\"border\" /></td>
	</tr>
	<tr>
		<td class=\"bodyfont\">Birthday:</td>
		<td>
		<select name=\"month\" class=\"border\">
		<option value=\"01\" selected=\"selected\">01</option>
		<option value=\"02\">02</option>
		<option value=\"03\">03</option>
		<option value=\"04\">04</option>
		<option value=\"05\">05</option>
		<option value=\"06\">06</option>
		<option value=\"07\">07</option>
		<option value=\"08\">08</option>
		<option value=\"09\">09</option>
		<option value=\"10\">10</option>
		<option value=\"11\">11</option>
		<option value=\"12\">12</option>
		</select>&nbsp;
		<select name=\"day\" class=\"border\">
		<option value=\"01\" selected=\"selected\">01</option>
		<option value=\"02\">02</option>
		<option value=\"03\">03</option>
		<option value=\"04\">04</option>
		<option value=\"05\">05</option>
		<option value=\"06\">06</option>
		<option value=\"07\">07</option>
		<option value=\"08\">08</option>
		<option value=\"09\">09</option>
		<option value=\"10\">10</option>
		<option value=\"11\">11</option>
		<option value=\"12\">12</option>
		<option value=\"13\">13</option>
		<option value=\"14\">14</option>
		<option value=\"15\">15</option>
		<option value=\"16\">16</option>
		<option value=\"17\">17</option>
		<option value=\"18\">18</option>
		<option value=\"19\">19</option>
		<option value=\"20\">20</option>
		<option value=\"21\">21</option>
		<option value=\"22\">22</option>
		<option value=\"23\">23</option>
		<option value=\"24\">24</option>
		<option value=\"25\">25</option>
		<option value=\"26\">26</option>
		<option value=\"27\">27</option>
		<option value=\"28\">28</option>
		<option value=\"29\">29</option>
		<option value=\"30\">30</option>
		<option value=\"31\">31</option>
		</select>
		&nbsp;<input name=\"year\" type=\"text\" maxlength=\"4\" size=\"4\" class=\"border\" />
		<br /><span class=\"bodyfont\">(mm/dd/yyyy format)</span>
		</td>
	</tr>
	<tr>
		<td class=\"bodyfont\">Sex:</td>
			<td class=\"bodyfont\">
				<input name=\"sex\" type=\"radio\" value=\"male\" />Male &nbsp;
				<input name=\"sex\" type=\"radio\" value=\"female\" />Female
			</td>
	</tr>
	<tr>
	<td class=\"bodyfont\">Country:</td>
	<td><select name=\"country\" class=\"border\">
		<option value=\"\" selected=\"selected\"></option><option value=\"USA\">United States of America</option><option value=\"Canada\">Canada</option><option value=\"Albania\">Albania</option><option value=\"Algeria\">Algeria</option><option value=\"Andorra\">Andorra</option><option value=\"Angola\">Angola</option><option value=\"Anguilla\">Anguilla</option><option value=\"Antigua &amp; Barbuda\">Antigua &amp; Barbuda</option><option value=\"Argentina\">Argentina</option><option value=\"Armenia\">Armenia</option><option value=\"Aruba\">Aruba</option><option value=\"Ascension\">Ascension</option><option value=\"Australia\">Australia</option><option value=\"Austria\">Austria</option><option value=\"Azerbaijan\">Azerbaijan</option><option value=\"Bahamas\">Bahamas</option><option value=\"Bahrain\">Bahrain</option><option value=\"Bangladesh\">Bangladesh</option><option value=\"Barbados\">Barbados</option><option value=\"Belarus\">Belarus</option><option value=\"Belgium\">Belgium</option><option value=\"Belize\">Belize</option><option value=\"Benin\">Benin</option><option value=\"Bermuda\">Bermuda</option><option value=\"Bhutan\">Bhutan</option><option value=\"Bolivia\">Bolivia</option><option value=\"Bosnia-Herzegovina\">Bosnia-Herzegovina</option><option value=\"Botswana\">Botswana</option><option value=\"Brazil\">Brazil</option><option value=\"British Virgin Islands\">British Virgin Islands</option><option value=\"Brunei Darussalam\">Brunei Darussalam</option><option value=\"Bulgaria\">Bulgaria</option><option value=\"Burkina Faso\">Burkina Faso</option><option value=\"Burma (Myanmar)\">Burma (Myanmar)</option><option value=\"Burundi\">Burundi</option><option value=\"Cambodia\">Cambodia</option><option value=\"Cameroon\">Cameroon</option><option value=\"Cape Verde\">Cape Verde</option><option value=\"Cayman Islands\">Cayman Islands</option><option value=\"Central African Republic\">Central African Republic</option><option value=\"Chad\">Chad</option><option value=\"Chile\">Chile</option><option value=\"China, People's Republic of\">China, People's Republic of</option><option value=\"Colombia\">Colombia</option><option value=\"Comoros\">Comoros</option><option value=\"Congo, Democratic Republic of the\">Congo, Democratic Republic of the</option><option value=\"Congo, Republic of the\">Congo, Republic of the</option><option value=\"Costa Rica\">Costa Rica</option><option value=\"Cote d'Ivoire (Ivory Coast)\">Cote d'Ivoire (Ivory Coast)</option><option value=\"Croatia\">Croatia</option><option value=\"Cyprus\">Cyprus</option><option value=\"Czech Republic\">Czech Republic</option><option value=\"Denmark\">Denmark</option><option value=\"Djibouti\">Djibouti</option><option value=\"Dominica\">Dominica</option><option value=\"Dominican Republic\">Dominican Republic</option><option value=\"Ecuador\">Ecuador</option><option value=\"Egypt\">Egypt</option><option value=\"El Salvador\">El Salvador</option><option value=\"Equatorial Guinea\">Equatorial Guinea</option><option value=\"Eritrea\">Eritrea</option><option value=\"Estonia\">Estonia</option><option value=\"Ethiopia\">Ethiopia</option><option value=\"Falkland Islands\">Falkland Islands</option><option value=\"Faroe Islands\">Faroe Islands</option><option value=\"Fiji\">Fiji</option><option value=\"Finland\">Finland</option><option value=\"France\">France</option><option value=\"French Guiana\">French Guiana</option><option value=\"French Polynesia\">French Polynesia</option><option value=\"Gabon\">Gabon</option><option value=\"Gambia\">Gambia</option><option value=\"Georgia, Republic of\">Georgia, Republic of</option><option value=\"Germany\">Germany</option><option value=\"Ghana\">Ghana</option><option value=\"Gibraltar\">Gibraltar</option><option value=\"Greece\">Greece</option><option value=\"Greenland\">Greenland</option><option value=\"Grenada\">Grenada</option><option value=\"Guadeloupe\">Guadeloupe</option><option value=\"Guam\">Guam</option><option value=\"Guatemala\">Guatemala</option><option value=\"Guinea\">Guinea</option><option value=\"Guinea-Bissau\">Guinea-Bissau</option><option value=\"Guyana\">Guyana</option><option value=\"Haiti\">Haiti</option><option value=\"Honduras\">Honduras</option><option value=\"Hungary\">Hungary</option><option value=\"Iceland\">Iceland</option><option value=\"India\">India</option><option value=\"Indonesia\">Indonesia</option><option value=\"Iran\">Iran</option><option value=\"Iraq\">Iraq</option><option value=\"Ireland (Eire)\">Ireland (Eire)</option><option value=\"Israel\">Israel</option><option value=\"Italy\">Italy</option><option value=\"Jamaica\">Jamaica</option><option value=\"Japan\">Japan</option><option value=\"Jordan\">Jordan</option><option value=\"Kazakhstan\">Kazakhstan</option><option value=\"Kenya\">Kenya</option><option value=\"Kiribati\">Kiribati</option><option value=\"Korea, Republic of (South)\">Korea, Republic of (South)</option><option value=\"Kuwait\">Kuwait</option><option value=\"Kyrgyzstan\">Kyrgyzstan</option><option value=\"Laos\">Laos</option><option value=\"Latvia\">Latvia</option><option value=\"Lebanon\">Lebanon</option><option value=\"Lesotho\">Lesotho</option><option value=\"Liberia\">Liberia</option><option value=\"Liechtenstein\">Liechtenstein</option><option value=\"Lithuania\">Lithuania</option><option value=\"Luxembourg\">Luxembourg</option><option value=\"Macedonia, Republic of\">Macedonia, Republic of</option><option value=\"Madagascar\">Madagascar</option><option value=\"Malawi\">Malawi</option><option value=\"Malaysia\">Malaysia</option><option value=\"Maldives\">Maldives</option><option value=\"Mali\">Mali</option><option value=\"Malta\">Malta</option><option value=\"Martinique\">Martinique</option><option value=\"Mauritania\">Mauritania</option><option value=\"Mauritius\">Mauritius</option><option value=\"Mexico\">Mexico</option><option value=\"Moldova\">Moldova</option><option value=\"Mongolia\">Mongolia</option><option value=\"Montserrat\">Montserrat</option><option value=\"Morocco\">Morocco</option><option value=\"Mozambique\">Mozambique</option><option value=\"Namibia\">Namibia</option><option value=\"Nauru\">Nauru</option><option value=\"Nepal\">Nepal</option><option value=\"Netherlands\">Netherlands</option><option value=\"Netherlands Antilles\">Netherlands Antilles</option><option value=\"New Caledonia\">New Caledonia</option><option value=\"New Zealand\">New Zealand</option><option value=\"Nicaragua\">Nicaragua</option><option value=\"Niger\">Niger</option><option value=\"Nigeria\">Nigeria</option><option value=\"Northern Ireland\">Northern Ireland</option><option value=\"Norway\">Norway</option><option value=\"Oman\">Oman</option><option value=\"Pakistan\">Pakistan</option><option value=\"Palau\">Palau</option><option value=\"Palestinian\">Palestinian</option><option value=\"Panama\">Panama</option><option value=\"Papua New Guinea\">Papua New Guinea</option><option value=\"Paraguay\">Paraguay</option><option value=\"Peru\">Peru</option><option value=\"Philippines\">Philippines</option><option value=\"Poland\">Poland</option><option value=\"Portugal\">Portugal</option><option value=\"Qatar\">Qatar</option><option value=\"Reunion\">Reunion</option><option value=\"Romania\">Romania</option><option value=\"Russia\">Russia</option><option value=\"Rwanda\">Rwanda</option><option value=\"Sahara\">Sahara</option><option value=\"Saint Chistopher (Saint Kitts) &amp; Nevis\">Saint Chistopher (Saint Kitts) &amp; Nevis</option><option value=\"Saint Helena\">Saint Helena</option><option value=\"Saint Lucia\">Saint Lucia</option><option value=\"Saint Pierre &amp; Miquelon\">Saint Pierre &amp; Miquelon</option><option value=\"Saint Vincent &amp; Grenadines\">Saint Vincent &amp; Grenadines</option><option value=\"San Marino\">San Marino</option><option value=\"Sao Tome &amp; Principe\">Sao Tome &amp; Principe</option><option value=\"Saudi Arabia\">Saudi Arabia</option><option value=\"Senegal\">Senegal</option><option value=\"Serbia-Montenegro (Yugoslavia)\">Serbia-Montenegro (Yugoslavia)</option><option value=\"Seychelles\">Seychelles</option><option value=\"Sierra Leone\">Sierra Leone</option><option value=\"Singapore\">Singapore</option><option value=\"Slovak Republic (Slovakia)\">Slovak Republic (Slovakia)</option><option value=\"Slovenia\">Slovenia</option><option value=\"Solomon Islands\">Solomon Islands</option><option value=\"Somalia\">Somalia</option><option value=\"South Africa\">South Africa</option><option value=\"Spain\">Spain</option><option value=\"Sri Lanka\">Sri Lanka</option><option value=\"Suriname\">Suriname</option><option value=\"Swaziland\">Swaziland</option><option value=\"Sweden\">Sweden</option><option value=\"Switzerland\">Switzerland</option><option value=\"Taiwan\">Taiwan</option><option value=\"Tajikistan\">Tajikistan</option><option value=\"Tanzania\">Tanzania</option><option value=\"Thailand\">Thailand</option><option value=\"Togo\">Togo</option><option value=\"Tonga\">Tonga</option><option value=\"Trinidad &amp; Tobago\">Trinidad &amp; Tobago</option><option value=\"Tunisia\">Tunisia</option><option value=\"Turkey\">Turkey</option><option value=\"Turkmenistan\">Turkmenistan</option><option value=\"Turks &amp; Caicos Islands\">Turks &amp; Caicos Islands</option><option value=\"Tuvalu\">Tuvalu</option><option value=\"Uganda\">Uganda</option><option value=\"Ukraine\">Ukraine</option><option value=\"United Arab Emirates\">United Arab Emirates</option><option value=\"United Kingdom\">United Kingdom</option><option value=\"Uruguay\">Uruguay</option><option value=\"Uzbekistan\">Uzbekistan</option><option value=\"Vanuatu\">Vanuatu</option><option value=\"Vatican City\">Vatican City</option><option value=\"Venezuela\">Venezuela</option><option value=\"Vietnam\">Vietnam</option><option value=\"Wallis &amp; Futuna Islands\">Wallis &amp; Futuna Islands</option><option value=\"Western Samoa\">Western Samoa</option><option value=\"Yemen\">Yemen</option><option value=\"Zambia\">Zambia</option><option value=\"Zimbabwe\">Zimbabwe</option>
</select>
		</td>
	</tr>
	<tr>
		<td class=\"bodyfont\">E-mail:</td>
		<td><input type=\"text\" name=\"email\" size=\"20\" class=\"border\" /></td>
	</tr>

	<tr>
		<td class=\"bodyfont\" valign=\"top\">Username:<br /><br /></td>
		<td><input type=\"text\" name=\"username\" size=\"20\" class=\"border\" maxlength=\"20\" />
	<br /><span class=\"bodyfont\">(Max. 20 characters)<br />No Special Characters eg. ()!@./+#$%* or Spaces!</span>
		</td>
	</tr>
	<tr>
		<td class=\"bodyfont\">Password:</td>
		<td><input type=\"password\" name=\"password\" size=\"20\" class=\"border\" maxlength=\"20\" />
		</td>
	</tr>
	<tr>
		<td class=\"bodyfont\">Confirm Password:</td>
		<td><input type=\"password\" name=\"password2\" size=\"20\" class=\"border\" maxlength=\"20\" />
		</td>
	</tr>
	<tr>
		<td class=\"bodyfont\" valign=\"top\">Avatar<br /><br /></td>
		<td>
			<input name=\"userfile\" type=\"file\" class=\"border\" /><br />
			<span class=\"bodyfont\">(REQUIRED - ".substr_replace($avatar_size, '', -3)."kb max - 100x100 max)<br />
			<a href=\"http://www.daydreamgraphics.com/icons/\" target=\"_blank\">100x100 avatars available here</a></span>
		</td>
	</tr>
</table>

<table width=\"750\" cellpadding=\"5\" cellspacing=\"0\" class=\"border\" align=\"center\">
	<tr>
		<td>
		<b>Registration Agreement Terms</b><br />
		While the administrators and moderators of this forum will attempt to remove or edit any generally objectionable material as quickly as possible, it is impossible to review every message. Therefore you acknowledge that all posts made to these forums express the views and opinions of the author and not the administrators, moderators or webmaster (except for posts by these people) and hence will not be held liable.
		<br /><br />

You agree not to post any abusive, obscene, vulgar, slanderous, hateful, threatening, sexually-oriented or any other material that may violate any applicable laws. Doing so may lead to you being immediately and permanently banned (and your service provider being informed). The IP address of all posts is recorded to aid in enforcing these conditions. You agree that the webmaster, administrator and moderators of this forum have the right to remove, edit, move or close any topic at any time should they see fit. As a user you agree to any information you have entered above being stored in a database. While this information will not be disclosed to any third party without your consent the webmaster, administrator and moderators cannot be held responsible for any hacking attempt that may lead to the data being compromised.
<br /><br />
This forum system uses cookies to store information on your local computer. These cookies do not contain any of the information you have entered above; they serve only to improve your viewing pleasure. The e-mail address is used only for confirming your registration details and password (and for sending new passwords should you forget your current one).
<br /><br />
By clicking Register below you agree to be bound by these conditions.

		</td>
	</tr>
</table>

<center><p><input type=\"submit\" value=\"Register\" class=\"border\" /></p></center>
<p>&nbsp;</p>
</form>";
?>
</body>
</html>