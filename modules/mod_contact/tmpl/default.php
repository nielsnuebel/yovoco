<?php
defined('_JEXEC') or die;
$headerTag   = htmlspecialchars($params->get('header_tag', 'h3'));
$headertitle = JText::_($module->title);
?>
<div class="white last box2 col-sm-6">
	<div class="custom">
<form name="f" action="./" method="post" enctype="multipart/form-data">

				<input type="hidden" name="panel_send" value="1">
				<input type="hidden" name="crm_send" value="1">
				<input type="hidden" name="crm_s" value="1">
				<input type="hidden" name="ID" value="15">
				<input type="hidden" name="TID" value="0">
				<input type="hidden" name="return_path" value="">
																															<div class="col-sm-12">
							<div class="contact_div" style="float: left;">
								<label for="f101">E-Mail</label>															</div>
																					<div class="input_div"><input type="text" class="form-control" name="f101" id="f101" value="" size="60" maxlength="150"><input type="hidden" name="crm_show_fields[]" value="101"></div>
						</div>
																																				<div class="col-sm-12">
							<div class="contact_div" style="float: left;">
								<label for="f102">Vorname</label>															</div>
																					<div class="input_div"><input type="text" class="form-control" name="f102" id="f102" value="" size="60" maxlength="150"><input type="hidden" name="crm_show_fields[]" value="102"></div>
						</div>
																																				<div class="col-sm-12">
							<div class="contact_div" style="float: left;">
								<label for="f103">Nachname</label>															</div>
																					<div class="input_div"><input type="text" class="form-control" name="f103" id="f103" value="" size="60" maxlength="150"><input type="hidden" name="crm_show_fields[]" value="103"></div>
						</div>
																																				<div class="col-sm-12">
							<div class="contact_div" style="float: left;">
								<label for="f104">Geschlecht</label>															</div>
																					<div class="input_div"><label><input type="radio" name="f104" id="f104_0" value="1">&nbsp;männlich</label> &nbsp; &nbsp; <label><input type="radio" name="f104" id="f104_1" value="2">&nbsp;weiblich</label><input type="hidden" name="crm_show_fields[]" value="104"></div>
						</div>
																																				<div class="col-sm-12">
							<div class="contact_div" style="float: left;">
								<label for="f105">Geburtsdatum</label>															</div>
																					<div class="input_div"><div class="date-dropdowns"><input type="hidden" class="form-control" name="f105" id="f105" value="" size="10" maxlength="10"><select class="day" name="date_[day]"><option value="">Tag</option><option value="01">01</option><option value="02">02</option><option value="03">03</option><option value="04">04</option><option value="05">05</option><option value="06">06</option><option value="07">07</option><option value="08">08</option><option value="09">09</option><option value="10">10</option><option value="11">11</option><option value="12">12</option><option value="13">13</option><option value="14">14</option><option value="15">15</option><option value="16">16</option><option value="17">17</option><option value="18">18</option><option value="19">19</option><option value="20">20</option><option value="21">21</option><option value="22">22</option><option value="23">23</option><option value="24">24</option><option value="25">25</option><option value="26">26</option><option value="27">27</option><option value="28">28</option><option value="29">29</option><option value="30">30</option><option value="31">31</option></select><select class="month" name="date_[month]"><option value="">month</option><option value="01">January</option><option value="02">February</option><option value="03">March</option><option value="04">April</option><option value="05">May</option><option value="06">June</option><option value="07">July</option><option value="08">August</option><option value="09">September</option><option value="10">October</option><option value="11">November</option><option value="12">December</option></select><select class="year" name="date_[year]"><option value="">year</option><option value="2017">2017</option><option value="2016">2016</option><option value="2015">2015</option><option value="2014">2014</option><option value="2013">2013</option><option value="2012">2012</option><option value="2011">2011</option><option value="2010">2010</option><option value="2009">2009</option><option value="2008">2008</option><option value="2007">2007</option><option value="2006">2006</option><option value="2005">2005</option><option value="2004">2004</option><option value="2003">2003</option><option value="2002">2002</option><option value="2001">2001</option><option value="2000">2000</option><option value="1999">1999</option><option value="1998">1998</option><option value="1997">1997</option><option value="1996">1996</option><option value="1995">1995</option><option value="1994">1994</option><option value="1993">1993</option><option value="1992">1992</option><option value="1991">1991</option><option value="1990">1990</option><option value="1989">1989</option><option value="1988">1988</option><option value="1987">1987</option><option value="1986">1986</option><option value="1985">1985</option><option value="1984">1984</option><option value="1983">1983</option><option value="1982">1982</option><option value="1981">1981</option><option value="1980">1980</option><option value="1979">1979</option><option value="1978">1978</option><option value="1977">1977</option><option value="1976">1976</option><option value="1975">1975</option><option value="1974">1974</option><option value="1973">1973</option><option value="1972">1972</option><option value="1971">1971</option><option value="1970">1970</option><option value="1969">1969</option><option value="1968">1968</option><option value="1967">1967</option><option value="1966">1966</option><option value="1965">1965</option><option value="1964">1964</option><option value="1963">1963</option><option value="1962">1962</option><option value="1961">1961</option><option value="1960">1960</option><option value="1959">1959</option><option value="1958">1958</option><option value="1957">1957</option><option value="1956">1956</option><option value="1955">1955</option><option value="1954">1954</option><option value="1953">1953</option><option value="1952">1952</option><option value="1951">1951</option><option value="1950">1950</option><option value="1949">1949</option><option value="1948">1948</option><option value="1947">1947</option><option value="1946">1946</option><option value="1945">1945</option><option value="1944">1944</option><option value="1943">1943</option><option value="1942">1942</option><option value="1941">1941</option><option value="1940">1940</option><option value="1939">1939</option><option value="1938">1938</option><option value="1937">1937</option><option value="1936">1936</option><option value="1935">1935</option><option value="1934">1934</option><option value="1933">1933</option><option value="1932">1932</option><option value="1931">1931</option><option value="1930">1930</option><option value="1929">1929</option><option value="1928">1928</option><option value="1927">1927</option><option value="1926">1926</option><option value="1925">1925</option><option value="1924">1924</option><option value="1923">1923</option><option value="1922">1922</option><option value="1921">1921</option><option value="1920">1920</option><option value="1919">1919</option><option value="1918">1918</option><option value="1917">1917</option><option value="1916">1916</option><option value="1915">1915</option><option value="1914">1914</option><option value="1913">1913</option><option value="1912">1912</option><option value="1911">1911</option><option value="1910">1910</option><option value="1909">1909</option><option value="1908">1908</option><option value="1907">1907</option><option value="1906">1906</option><option value="1905">1905</option><option value="1904">1904</option><option value="1903">1903</option><option value="1902">1902</option><option value="1901">1901</option><option value="1900">1900</option><option value="1899">1899</option><option value="1898">1898</option><option value="1897">1897</option><option value="1896">1896</option></select></div>&nbsp;&nbsp;<a href="#" onclick="DateTimePicker.show('f105', 'date');return false;" title="date" class="DateTimePicker" style="display: none;"><img src="./images/b_calendar.gif" width="16" height="16" border="0" alt=""></a>
<script type="text/javascript"><!--
DateTimePicker.hideButtonNow = true; DateTimePicker.showCW = false;
// --></script><input type="hidden" name="crm_show_fields[]" value="105"></div>
						</div>
																																				<div class="col-sm-12">
							<div class="contact_div" style="float: left;">
								<label for="f106">Postleitzahl</label>															</div>
																					<div class="input_div"><input type="text" class="form-control" name="f106" id="f106" value="" size="20" maxlength="11"><input type="hidden" name="crm_show_fields[]" value="106"></div>
						</div>

					<div class="col-xs-12">
						<div class="contact_div" style="float: left;">
							<label for="login">																					E-Mail-Adresse
																		</label>
						</div>
						<div class="input_div">
							<input type="text" name="login" id="login" value="" class="form-control">
						</div>
					</div>
													<div class="col-xs-12">
						<div class="contact_div" style="float: left;">
							<label for="password">Passwort</label>
						</div>
						<div class="input_div">
							<input type="password" name="password" id="password" value="" autocomplete="off" class="form-control">
						</div>
					</div>
					<div class="col-xs-12">
						<div class="contact_div" style="float: left;">
							<label for="password_repeat">Passwort wiederholen</label>
						</div>
						<div class="input_div">
							<input type="password" name="password_repeat" id="password_repeat" value="" class="form-control">
						</div>
					</div>
					<script type="text/javascript">
					 //
					 if(typeof f.elements['password'] != "undefined") {
						window.setTimeout("f.elements['password'].value = '';", 200);
					 }
					</script>

				<p>&nbsp;</p>
				<div class="contact_div" style="float: left;"></div>
				<div class="input_div">
					<input type="submit" name="panel_send" value="Registrieren Sie sich jetzt" class="submit btn btn-default">
				</div>

				</form>
</div>
	</div>

				<!-- ================ -->
				<div class="main col-md-8 space-bottom">
					<?php echo '<' . $headerTag . ' class="margin-clear">' . $headertitle. '</' . $headerTag . '>';?>
					<div class="separator"></div>
					<?php if($params->get('text', false)) echo '<p class="lead">' . $params->get('text') . '</p>'; ?>
					<div class="alert alert-success hidden" id="MessageSent">
						<?php echo JText::_('MOD_CONTACT_FIELD_MESSAGE_SENT');?>
					</div>
					<div class="alert alert-danger hidden" id="MessageNotSent">
						<?php echo JText::_('MOD_CONTACT_FIELD_MESSAGE_NOT_SENT');?>
					</div>
					<div class="contact-form">
						<form id="modcontact-form" class="margin-clear" role="form">

							<?php
							foreach($formfields as $field)
							{
								echo '<div class="form-group has-feedback">';
								$placeholder = ($field->placeholder)?'placeholder="'.$field->placeholder.'"':'';
								$required = ($field->required)?' *':'';
								if($field->label) echo '<label for="'.$field->name.'">'.$field->label.$required.'</label>';
								echo '<input type="text" class="form-control" id="'.$field->name.'" name="'.$field->name.'" '.$placeholder.'>';
								if($field->icon) echo '<i class="'.$field->icon.' form-control-feedback"></i>';
								echo '</div>';
							}
							?>
							<div class="form-group has-feedback">
								<label for="message"><?php echo JText::_('MOD_CONTACT_FIELD_MESSAGE');?> *</label>
								<textarea class="form-control" rows="6" id="message" name="message" placeholder=""></textarea>
								<i class="fa fa-pencil form-control-feedback"></i>
							</div>
							<input type="submit" value="<?php echo JText::_('MOD_CONTACT_FIELD_SUBMIT');?>" class="submit-button btn btn-default">
						</form>
					</div>
				</div>
				<!-- main end -->

				<!-- sidebar start -->
