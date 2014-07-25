<?php
/* #######################################################
 This file contains all the consistent HTML components. 
 Eventually this should be replaced with a templating page.
	
 This page was created to eliminate LOTS of redundant text.
	
 ***************************************************************
 Make sure this page has no Spaces or any characters after the start of the 
  HEREDOC  section Name  and the end of the line ending the HEREDOC
   You can only have a ; semi-colon there, that is absolutely it.
 ####################################################### */

require_once "objects/sitesettings.php";
require_once "objects/objects.php";
require_once "objects/aliases.php";


function Redirect($address,$errorMessage = null,$warningMessage = null,$successMessage = null){
	if($errorMessage != null) addError($errorMessage);
	if($warningMessage != null) addWarning($warningMessage);
	if($successMessage != null) addSuccess($successMessage);
	header("Location:$address");
}

function HTML_Render_Head($PageTitle = ""){
	$HeaderAddon = "";
	global $WebClient;
	if(isset($PageTitle) && $PageTitle != "") $HeaderAddon = ": ".$PageTitle;	
	echo <<<PageHead
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>$WebClient $HeaderAddon</title>
		<meta http-equiv="X-UA-Compatible" content="IE=9"/>
		<link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />
		<link rel="bookmark" href="favicon.ico" />
		
PageHead;
}
function HTML_Render_Body_Start(){
	global $_SITE_Minimum_PHP_Version;
	$HTML_1 = <<<PageBody1
	</head>
	<body>
		<table width="960" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
			<tr>
				<td colspan="2">		
PageBody1;
	$HTML_1A = 	<<<PartA
	</td>
			</tr>
			<tr>
				<td colspan="2" align="right" valign="middle" bgcolor="#3c3c3c">
PartA;
			
	$HTML_2 = <<<PageBody2
				</td>
			</tr>
			<tr>
				<td width="240" valign="top">
				
PageBody2;
	$HTML_3 = <<<PageBody3
				</td>
				<td width="720" valign="top">
				
PageBody3;

	echo $HTML_1;
	include 'topbanner.php';
	echo $HTML_1A;
	require_once 'header.php'; 
	echo $HTML_2;
	require_once "nav_parts.php"; 
	if (isAdmin())
		checkPHPVersion($_SITE_Minimum_PHP_Version);
	echo $HTML_3;
	if (isset($_SESSION["Errors"]) || isset($_SESSION["Warnings"]) || isset($_SESSION["Successes"]))
	{
		echo "<ul class=\"messages\">";
		showMessages("Errors","error");
		showMessages("Warnings","warning");
		showMessages("Successes","success");
		echo "</ul>";
	}
	
}
function checkPHPVersion($minimumVersion){
	$phpVersion = phpversion();
	if(!isVersionGreater($phpVersion,$minimumVersion)){
		addError(sprintf("Your version of PHP (%s) is not high enough. Components of this site require PHP %s.".
				" Please visit the <a href='versions.php'>Versions page</a> for more details.",
			$phpVersion,$minimumVersion));
	}
}
function isVersionGreater($currentVersion,$minimumVersion){
	$minimumParts = explode(".",$minimumVersion);
	$currentParts = explode(".",$currentVersion);

	$isGreater = false;
	if ((int)$currentParts[0] >= (int)$minimumParts[0])
		if ((int)$currentParts[1] >= (int)$minimumParts[1])
			if((int)$currentParts[2] >= (int)$minimumParts[2])
				$isGreater = true;			
			else
				$isGreater = false;
		else
			$isGreater = false;
	else
		$isGreater = false;
	
	return $isGreater;
}
function showMessages($key,$class){
	if (isset($_SESSION[$key])){
		$errors = $_SESSION[$key];
		foreach ($errors as $mess)
			echo "<li class=\"$class\">$mess</li>";
	}
	unset($_SESSION[$key]);
}
function HTML_Render_Body_End(){
	$HTML_1 =   "</td>
			</tr>
			<tr>";
	
	$HTML_1A = '</tr>
		</table>
		<div id="popUp">
			<h1 id="popTitle"><span id="popTitleText">Details</span>
				<span id="popClose" onclick="$(this).parent().parent().hide(1000);">X</span>
			</h1>
			<div id="popMessage">
				Empty Message
			</div>
		</div>';

	echo $HTML_1;
	require_once("footer.php");
	echo $HTML_1A;

	if (!isLoggedIn())
	{
		require_once "login.php";
	}

	echo "</body></html>";
}


$CSS_Main =  <<<CSSMain
		<link href="styles/default/main_css.css" rel="stylesheet" type="text/css" media="screen" />
		
CSSMain;

$CSS_JQuery_UI =  <<<CSSJQueryUI
			<link rel="stylesheet" href="styles/jqstyles/jquery.ui.all.css" />
			<link rel="stylesheet" href="styles/jqstyles/jquery.ui.timepicker.css" />
			
CSSJQueryUI;


$CSS_JQStyles =  <<<CSSJQStyles
			<link rel="stylesheet" href="styles/jqstyles/demos.css" />
			
CSSJQStyles;

$CSS_JQX =  <<<JQXStyles
			<link rel="stylesheet" href="js/jqwidgets/styles/jqx.base.css" type="text/css" />
			<link rel="stylesheet" href="js/jqwidgets/styles/jqx.darkblue.css" type="text/css" />
			<link rel="stylesheet" href="js/jqwidgets/styles/jqx.classic.css" type="text/css" />
			
JQXStyles;

$JS_JQuery =  <<<JQueryScripts
			<script type="text/javascript" src="js/jquery.js"></script>
			<script type="text/javascript" src="js/common.js"></script> 
			
JQueryScripts;

$JS_Forms =  <<<FormScripts
			<script src="js/forms.js"></script>
			
FormScripts;

$JS_JQueryUI =  <<<JQueryUIScripts
			<script src="js/ui/jquery.ui.core.js"></script>
			<script src="js/ui/jquery.ui.widget.js"></script>
			<script src="js/ui/jquery.ui.datepicker.js"></script>
			<script src="js/ui/jquery.ui.timepicker.js"></script>
			
JQueryUIScripts;

$JS_FormValidation =  <<<FormValidation
			<script src="js/datevalidation.js"></script>
			<script src="js/timevalidation.js"></script>
			<script src="js/numbervalidation.js"></script>
			
FormValidation;

$JS_JQX =  <<<JQXScripts
			<script type="text/javascript" src="js/jqwidgets/jqxcore.js"></script>
			<script type="text/javascript" src="js/jqwidgets/jqxdata.js"></script>
			<script type="text/javascript" src="js/jqwidgets/jqxbuttons.js"></script>
			<script type="text/javascript" src="js/jqwidgets/jqxscrollbar.js"></script>
			<script type="text/javascript" src="js/jqwidgets/jqxlistbox.js"></script>
			<script type="text/javascript" src="js/jqwidgets/jqxcombobox.js"></script> <!-- add variable -->
			<script type="text/javascript" src="js/jqwidgets/jqxdropdownbutton.js"></script> <!-- details -->
			<script type="text/javascript" src="js/jqwidgets/jqxdropdownlist.js"></script>  <!-- add variable | details | add_multiple_values -->
			<script type="text/javascript" src="js/jqwidgets/jqxwindow.js"></script> <!-- change metadata | change method | change source | details -->
			<script type="text/javascript" src="js/jqwidgets/jqxpanel.js"></script> <!-- change metadata | change method | change source | details -->
			<script type="text/javascript" src="js/jqwidgets/jqxtabs.js"></script> <!-- change metadata | change method | change source -->
			<script type="text/javascript" src="js/jqwidgets/jqxcheckbox.js"></script> <!-- change metadata | change method | change source | details -->
			<script type="text/javascript" src="js/jqwidgets/jqxdatetimeinput.js"></script> <!-- details -->
			<script type="text/javascript" src="js/jqwidgets/jqxcalendar.js"></script> <!-- details -->
			<script type="text/javascript" src="js/jqwidgets/jqxtooltip.js"></script> <!-- details -->
			<script type="text/javascript" src="js/jqwidgets/jqxmenu.js"></script> <!-- details -->
			<script type="text/javascript" src="js/jqwidgets/jqxgrid.js"></script> <!-- details -->
			<script type="text/javascript" src="js/jqwidgets/jqxgrid.selection.js"></script> <!-- details -->
			<script type="text/javascript" src="js/jqwidgets/jqxgrid.columnsresize.js"></script>  <!-- details -->
			<script type="text/javascript" src="js/jqwidgets/jqxgrid.pager.js"></script> <!-- details -->
			<script type="text/javascript" src="js/jqwidgets/jqxgrid.sort.js"></script> <!-- details -->
			<script type="text/javascript" src="js/jqwidgets/jqxgrid.edit.js"></script> <!-- details -->
			
JQXScripts;

$JS_GetTheme =  <<<GetTheme
			<script type="text/javascript" src="js/gettheme.js"></script>
			
GetTheme;

$JS_SiteCreate =  <<<SiteCreate
			<!-- Creating the Site Code automatically -->
	        <script type="text/javascript" src="js/create_site_code.js"></script>
			
SiteCreate;

$JS_Globalization =  <<<Globalization
			<script type="text/javascript" src="js/jqwidgets/globalization/jquery.global.js"></script>
			<script src="js/highstock.js" type="text/javascript"></script> <!-- this is the only reference to MooTools. -->
			<script src="js/modules/exporting.js" type="text/javascript"></script>
			
Globalization;

$JS_Maps =  <<<GoogleMaps
			<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?key=AIzaSyC3d042tZnUAA8256hCC2Y6QeTSREaxrY0&sensor=true"></script> 
			<script src="js/map.js" type="text/javascript"></script>
			
GoogleMaps;

$JS_CreateUserName =  <<<CreateUserName
			<script type="text/javascript" src="js/create_username.js"></script>
			
CreateUserName;

$JS_Uploaders =  <<<Uploaders
			<script type="text/javascript" src="uploader/plupload.js"></script>
			<script type="text/javascript" src="uploader/plupload.gears.js"></script>
			<script type="text/javascript" src="uploader/plupload.silverlight.js"></script>
			<script type="text/javascript" src="uploader/plupload.flash.js"></script>
			<script type="text/javascript" src="uploader/plupload.browserplus.js"></script>
			<script type="text/javascript" src="uploader/plupload.html4.js"></script>
			<script type="text/javascript" src="uploader/plupload.html5.js"></script>
			
Uploaders;

$JS_ImportData =  <<<ImportData
			<script type="text/javascript" src="js/import_data.js"></script>
			
ImportData;

$JS_DropDown = <<<DropDownLists
			<script type='text/javascript' src='js/drop_down.js'></script>
DropDownLists;

$__DateTimeFormats = array(
	"ATOM, RFC3339, W3C" => DateTime::ATOM,
	"COOKIE, RFC850" => DateTime::COOKIE,
	"ISO8601" => DateTime::ISO8601,
	"RFC822, RFC1036" => DateTime::RFC1036,
	"RFC1123, RFC2822, RSS" => DateTime::RFC2822,
	"Simple" => "Y-m-d H:i:s", // (2011/03/14 20:04:23)
	"Condensed" => "Ymd His" // (20110314 200423)
	);
//"ATOM" => "Y-m-d\TH:i:sP", // //(2013-08-01T18:36:42-07:00)
//"COOKIE" => "l, d-M-y H:i:s T",  //(Thursday, 01-Aug-13 18:36:42 GMT+7)
//"ISO8601" => "Y-m-d\TH:i:sO",  //(2013-08-01T18:36:42-0700)
//"RFC822" => "D, d M y H:i:s O",  //(Thu, 01 Aug 13 18:36:42 -0700)
//"RFC850" => "l, d-M-y H:i:s T",  //(Thursday, 01-Aug-13 18:36:42 GMT+7)
//"RFC1036" => "D, d M y H:i:s O",  //(Thu, 01 Aug 13 18:36:42 -0700)
//"RFC1123" => "D, d M Y H:i:s O",  //(Thu, 01 Aug 2013 18:36:42 -0700)
//"RFC2822" => "D, d M Y H:i:s O",  //(Thu, 01 Aug 2013 18:36:42 -0700)
//"RFC3339" => "Y-m-d\TH:i:sP",  //(2013-08-01T18:36:42-07:00)
//"RSS" => "D, d M Y H:i:s O",  //(Thu, 01 Aug 2013 18:36:42 -0700)
//"W3C" => "Y-m-d\TH:i:sP",  //(2013-08-01T18:36:42-07:00)
//"Simple" => "Y-m-d H:i:s",  //(2013-08-01 18:36:42)
//"Condensed" => "Ymd His"  //(20130801 183642)

$__DateFormats = array(
	"ATOM, ISO8601, RFC3339, W3C" => "Y-m-d",  //(2013-08-01)
	"COOKIE, RFC850" => "l, d-M-y",  //(Thursday, 01-Aug-13)
	"RFC822, RFC1036" => "D, d M y",  //(Thu, 01 Aug 13)
	"RFC1123, RFC2822, RSS" => "D, d M Y",  //(Thu, 01 Aug 2013)
	"Simple (Year First)" =>"y/m/d", // 13/08/01
	"Simple (Full Year)" =>"Y/m/d", // 2013/08/01
	"Simple (Month First)" =>"m/d/Y", // 08/01/2013
	"Simple (Day First)" =>"d/m/Y", // 08/01/2013
	"Condensed" => "Ymd"  //(20130801)
	);


$__TimeFormats = array(
	"ATOM, RFC3339, W3C" => "\TH:i:sP",  //(T18:36:42-07:00)
	"COOKIE, RFC850" => "H:i:s T",  //(18:36:42 GMT+7)
	"ISO8601" => "\TH:i:sO",  //(T18:36:42-0700)
	"RFC822, RFC1036, RFC1123, RFC2822, RSS" => "H:i:s O",  //(18:36:42 -0700)
	"Simple" => "H:i:s",  //(18:36:42)
	"Condensed" => "His"  //(183642)
	);

// formatted using answer at: http://stackoverflow.com/questions/4755704/php-timezone-list
$__TimeZones = array(
	'(GMT-12:00) International Date Line West' => 'Pacific/Wake',
	'(GMT-11:00) Midway Island' => 'Pacific/Apia',
	'(GMT-11:00) Samoa' => 'Pacific/Apia',
	'(GMT-10:00) Hawaii' => 'Pacific/Honolulu',
	'(GMT-09:00) Alaska' => 'America/Anchorage',
	'(GMT-08:00) Pacific Time (US &amp; Canada); Tijuana' => 'America/Los_Angeles',
	'(GMT-07:00) Arizona' => 'America/Phoenix',
	'(GMT-07:00) Chihuahua' => 'America/Chihuahua',
	'(GMT-07:00) La Paz' => 'America/Chihuahua',
	'(GMT-07:00) Mazatlan' => 'America/Chihuahua',
	'(GMT-07:00) Mountain Time (US &amp; Canada)' => 'America/Denver',
	'(GMT-06:00) Central America' => 'America/Managua',
	'(GMT-06:00) Central Time (US &amp; Canada)' => 'America/Chicago',
	'(GMT-06:00) Guadalajara' => 'America/Mexico_City',
	'(GMT-06:00) Mexico City' => 'America/Mexico_City',
	'(GMT-06:00) Monterrey' => 'America/Mexico_City',
	'(GMT-06:00) Saskatchewan' => 'America/Regina',
	'(GMT-05:00) Bogota' => 'America/Bogota',
	'(GMT-05:00) Eastern Time (US &amp; Canada)' => 'America/New_York',
	'(GMT-05:00) Indiana (East)' => 'America/Indiana/Indianapolis',
	'(GMT-05:00) Lima' => 'America/Bogota',
	'(GMT-05:00) Quito' => 'America/Bogota',
	'(GMT-04:00) Atlantic Time (Canada)' => 'America/Halifax',
	'(GMT-04:00) Caracas' => 'America/Caracas',
	'(GMT-04:00) La Paz' => 'America/Caracas',
	'(GMT-04:00) Santiago' => 'America/Santiago',
	'(GMT-03:30) Newfoundland' => 'America/St_Johns',
	'(GMT-03:00) Brasilia' => 'America/Sao_Paulo',
	'(GMT-03:00) Buenos Aires' => 'America/Argentina/Buenos_Aires',
	'(GMT-03:00) Georgetown' => 'America/Argentina/Buenos_Aires',
	'(GMT-03:00) Greenland' => 'America/Godthab',
	'(GMT-02:00) Mid-Atlantic' => 'America/Noronha',
	'(GMT-01:00) Azores' => 'Atlantic/Azores',
	'(GMT-01:00) Cape Verde Is.' => 'Atlantic/Cape_Verde',
	'(GMT) Casablanca' => 'Africa/Casablanca',
	'(GMT) Edinburgh' => 'Europe/London',
	'(GMT) Greenwich Mean Time : Dublin' => 'Europe/London',
	'(GMT) Lisbon' => 'Europe/London',
	'(GMT) London' => 'Europe/London',
	'(GMT) Monrovia' => 'Africa/Casablanca',
	'(GMT+01:00) Amsterdam' => 'Europe/Berlin',
	'(GMT+01:00) Belgrade' => 'Europe/Belgrade',
	'(GMT+01:00) Berlin' => 'Europe/Berlin',
	'(GMT+01:00) Bern' => 'Europe/Berlin',
	'(GMT+01:00) Bratislava' => 'Europe/Belgrade',
	'(GMT+01:00) Brussels' => 'Europe/Paris',
	'(GMT+01:00) Budapest' => 'Europe/Belgrade',
	'(GMT+01:00) Copenhagen' => 'Europe/Paris',
	'(GMT+01:00) Ljubljana' => 'Europe/Belgrade',
	'(GMT+01:00) Madrid' => 'Europe/Paris',
	'(GMT+01:00) Paris' => 'Europe/Paris',
	'(GMT+01:00) Prague' => 'Europe/Belgrade',
	'(GMT+01:00) Rome' => 'Europe/Berlin',
	'(GMT+01:00) Sarajevo' => 'Europe/Sarajevo',
	'(GMT+01:00) Skopje' => 'Europe/Sarajevo',
	'(GMT+01:00) Stockholm' => 'Europe/Berlin',
	'(GMT+01:00) Vienna' => 'Europe/Berlin',
	'(GMT+01:00) Warsaw' => 'Europe/Sarajevo',
	'(GMT+01:00) West Central Africa' => 'Africa/Lagos',
	'(GMT+01:00) Zagreb' => 'Europe/Sarajevo',
	'(GMT+02:00) Athens' => 'Europe/Istanbul',
	'(GMT+02:00) Bucharest' => 'Europe/Bucharest',
	'(GMT+02:00) Cairo' => 'Africa/Cairo',
	'(GMT+02:00) Harare' => 'Africa/Johannesburg',
	'(GMT+02:00) Helsinki' => 'Europe/Helsinki',
	'(GMT+02:00) Istanbul' => 'Europe/Istanbul',
	'(GMT+02:00) Jerusalem' => 'Asia/Jerusalem',
	'(GMT+02:00) Kyiv' => 'Europe/Helsinki',
	'(GMT+02:00) Minsk' => 'Europe/Istanbul',
	'(GMT+02:00) Pretoria' => 'Africa/Johannesburg',
	'(GMT+02:00) Riga' => 'Europe/Helsinki',
	'(GMT+02:00) Sofia' => 'Europe/Helsinki',
	'(GMT+02:00) Tallinn' => 'Europe/Helsinki',
	'(GMT+02:00) Vilnius' => 'Europe/Helsinki',
	'(GMT+03:00) Baghdad' => 'Asia/Baghdad',
	'(GMT+03:00) Kuwait' => 'Asia/Riyadh',
	'(GMT+03:00) Moscow' => 'Europe/Moscow',
	'(GMT+03:00) Nairobi' => 'Africa/Nairobi',
	'(GMT+03:00) Riyadh' => 'Asia/Riyadh',
	'(GMT+03:00) St. Petersburg' => 'Europe/Moscow',
	'(GMT+03:00) Volgograd' => 'Europe/Moscow',
	'(GMT+03:30) Tehran' => 'Asia/Tehran',
	'(GMT+04:00) Abu Dhabi' => 'Asia/Muscat',
	'(GMT+04:00) Baku' => 'Asia/Tbilisi',
	'(GMT+04:00) Muscat' => 'Asia/Muscat',
	'(GMT+04:00) Tbilisi' => 'Asia/Tbilisi',
	'(GMT+04:00) Yerevan' => 'Asia/Tbilisi',
	'(GMT+04:30) Kabul' => 'Asia/Kabul',
	'(GMT+05:00) Ekaterinburg' => 'Asia/Yekaterinburg',
	'(GMT+05:00) Islamabad' => 'Asia/Karachi',
	'(GMT+05:00) Karachi' => 'Asia/Karachi',
	'(GMT+05:00) Tashkent' => 'Asia/Karachi',
	'(GMT+05:30) Chennai' => 'Asia/Calcutta',
	'(GMT+05:30) Kolkata' => 'Asia/Calcutta',
	'(GMT+05:30) Mumbai' => 'Asia/Calcutta',
	'(GMT+05:30) New Delhi' => 'Asia/Calcutta',
	'(GMT+05:45) Kathmandu' => 'Asia/Katmandu',
	'(GMT+06:00) Almaty' => 'Asia/Novosibirsk',
	'(GMT+06:00) Astana' => 'Asia/Dhaka',
	'(GMT+06:00) Dhaka' => 'Asia/Dhaka',
	'(GMT+06:00) Novosibirsk' => 'Asia/Novosibirsk',
	'(GMT+06:00) Sri Jayawardenepura' => 'Asia/Colombo',
	'(GMT+06:30) Rangoon' => 'Asia/Rangoon',
	'(GMT+07:00) Bangkok' => 'Asia/Bangkok',
	'(GMT+07:00) Hanoi' => 'Asia/Bangkok',
	'(GMT+07:00) Jakarta' => 'Asia/Bangkok',
	'(GMT+07:00) Krasnoyarsk' => 'Asia/Krasnoyarsk',
	'(GMT+08:00) Beijing' => 'Asia/Hong_Kong',
	'(GMT+08:00) Chongqing' => 'Asia/Hong_Kong',
	'(GMT+08:00) Hong Kong' => 'Asia/Hong_Kong',
	'(GMT+08:00) Irkutsk' => 'Asia/Irkutsk',
	'(GMT+08:00) Kuala Lumpur' => 'Asia/Singapore',
	'(GMT+08:00) Perth' => 'Australia/Perth',
	'(GMT+08:00) Singapore' => 'Asia/Singapore',
	'(GMT+08:00) Taipei' => 'Asia/Taipei',
	'(GMT+08:00) Ulaan Bataar' => 'Asia/Irkutsk',
	'(GMT+08:00) Urumqi' => 'Asia/Hong_Kong',
	'(GMT+09:00) Osaka' => 'Asia/Tokyo',
	'(GMT+09:00) Sapporo' => 'Asia/Tokyo',
	'(GMT+09:00) Seoul' => 'Asia/Seoul',
	'(GMT+09:00) Tokyo' => 'Asia/Tokyo',
	'(GMT+09:00) Yakutsk' => 'Asia/Yakutsk',
	'(GMT+09:30) Adelaide' => 'Australia/Adelaide',
	'(GMT+09:30) Darwin' => 'Australia/Darwin',
	'(GMT+10:00) Brisbane' => 'Australia/Brisbane',
	'(GMT+10:00) Canberra' => 'Australia/Sydney',
	'(GMT+10:00) Guam' => 'Pacific/Guam',
	'(GMT+10:00) Hobart' => 'Australia/Hobart',
	'(GMT+10:00) Melbourne' => 'Australia/Sydney',
	'(GMT+10:00) Port Moresby' => 'Pacific/Guam',
	'(GMT+10:00) Sydney' => 'Australia/Sydney',
	'(GMT+10:00) Vladivostok' => 'Asia/Vladivostok',
	'(GMT+11:00) Magadan' => 'Asia/Magadan',
	'(GMT+11:00) New Caledonia' => 'Asia/Magadan',
	'(GMT+11:00) Solomon Is.' => 'Asia/Magadan',
	'(GMT+12:00) Auckland' => 'Pacific/Auckland',
	'(GMT+12:00) Fiji' => 'Pacific/Fiji',
	'(GMT+12:00) Kamchatka' => 'Pacific/Fiji',
	'(GMT+12:00) Marshall Is.' => 'Pacific/Fiji',
	'(GMT+12:00) Wellington' => 'Pacific/Auckland',
	'(GMT+13:00) Nuku\'alofa' => 'Pacific/Tongatapu'
	);


$_Countries = array(
	"AF" => "Afghanistan",
	"AL" => "Albania",
	"DZ" => "Algeria",
	"AS" => "American Samoa",
	"AD" => "Andorra",
	"AO" => "Angola",
	"AI" => "Anguilla",
	"AQ" => "Antarctica",
	"AG" => "Antigua and Barbuda",
	"AR" => "Argentina",
	"AM" => "Armenia",
	"AW" => "Aruba",
	"AU" => "Australia",
	"AT" => "Austria",
	"AZ" => "Azerbaijan",
	"BS" => "Bahamas",
	"BH" => "Bahrain",
	"BD" => "Bangladesh",
	"BB" => "Barbados",
	"BY" => "Belarus",
	"BE" => "Belgium",
	"BZ" => "Belize",
	"BJ" => "Benin",
	"BM" => "Bermuda",
	"BT" => "Bhutan",
	"BO" => "Bolivia",
	"BA" => "Bosnia and Herzegowina",
	"BW" => "Botswana",
	"BV" => "Bouvet Island",
	"BR" => "Brazil",
	"IO" => "British Indian Ocean Territory",
	"BN" => "Brunei Darussalam",
	"BG" => "Bulgaria",
	"BF" => "Burkina Faso",
	"BI" => "Burundi",
	"KH" => "Cambodia",
	"CM" => "Cameroon",
	"CA" => "Canada",
	"CV" => "Cape Verde",
	"KY" => "Cayman Islands",
	"CF" => "Central African Republic",
	"TD" => "Chad",
	"CL" => "Chile",
	"CN" => "China",
	"CX" => "Christmas Island",
	"CC" => "Cocos (Keeling) Islands",
	"CO" => "Colombia",
	"KM" => "Comoros",
	"CG" => "Congo",
	"CD" => "Congo, the Democratic Republic of the",
	"CK" => "Cook Islands",
	"CR" => "Costa Rica",
	"CI" => "Cote d'Ivoire",
	"HR" => "Croatia (Hrvatska)",
	"CU" => "Cuba",
	"CY" => "Cyprus",
	"CZ" => "Czech Republic",
	"DK" => "Denmark",
	"DJ" => "Djibouti",
	"DM" => "Dominica",
	"DO" => "Dominican Republic",
	"TP" => "East Timor",
	"EC" => "Ecuador",
	"EG" => "Egypt",
	"SV" => "El Salvador",
	"GQ" => "Equatorial Guinea",
	"ER" => "Eritrea",
	"EE" => "Estonia",
	"ET" => "Ethiopia",
	"FK" => "Falkland Islands (Malvinas)",
	"FO" => "Faroe Islands",
	"FJ" => "Fiji",
	"FI" => "Finland",
	"FR" => "France",
	"FX" => "France, Metropolitan",
	"GF" => "French Guiana",
	"PF" => "French Polynesia",
	"TF" => "French Southern Territories",
	"GA" => "Gabon",
	"GM" => "Gambia",
	"GE" => "Georgia",
	"DE" => "Germany",
	"GH" => "Ghana",
	"GI" => "Gibraltar",
	"GR" => "Greece",
	"GL" => "Greenland",
	"GD" => "Grenada",
	"GP" => "Guadeloupe",
	"GU" => "Guam",
	"GT" => "Guatemala",
	"GN" => "Guinea",
	"GW" => "Guinea-Bissau",
	"GY" => "Guyana",
	"HT" => "Haiti",
	"HM" => "Heard and Mc Donald Islands",
	"VA" => "Holy See (Vatican City State)",
	"HN" => "Honduras",
	"HK" => "Hong Kong",
	"HU" => "Hungary",
	"IS" => "Iceland",
	"IN" => "India",
	"ID" => "Indonesia",
	"IR" => "Iran (Islamic Republic of)",
	"IQ" => "Iraq",
	"IE" => "Ireland",
	"IL" => "Israel",
	"IT" => "Italy",
	"JM" => "Jamaica",
	"JP" => "Japan",
	"JO" => "Jordan",
	"KZ" => "Kazakhstan",
	"KE" => "Kenya",
	"KI" => "Kiribati",
	"KP" => "Korea, Democratic People's Republic of",
	"KR" => "Korea, Republic of",
	"KW" => "Kuwait",
	"KG" => "Kyrgyzstan",
	"LA" => "Lao People's Democratic Republic",
	"LV" => "Latvia",
	"LB" => "Lebanon",
	"LS" => "Lesotho",
	"LR" => "Liberia",
	"LY" => "Libyan Arab Jamahiriya",
	"LI" => "Liechtenstein",
	"LT" => "Lithuania",
	"LU" => "Luxembourg",
	"MO" => "Macau",
	"MK" => "Macedonia, The Former Yugoslav Republic of",
	"MG" => "Madagascar",
	"MW" => "Malawi",
	"MY" => "Malaysia",
	"MV" => "Maldives",
	"ML" => "Mali",
	"MT" => "Malta",
	"MH" => "Marshall Islands",
	"MQ" => "Martinique",
	"MR" => "Mauritania",
	"MU" => "Mauritius",
	"YT" => "Mayotte",
	"MX" => "Mexico",
	"FM" => "Micronesia, Federated States of",
	"MD" => "Moldova, Republic of",
	"MC" => "Monaco",
	"MN" => "Mongolia",
	"MS" => "Montserrat",
	"MA" => "Morocco",
	"MZ" => "Mozambique",
	"MM" => "Myanmar",
	"NA" => "Namibia",
	"NR" => "Nauru",
	"NP" => "Nepal",
	"NL" => "Netherlands",
	"AN" => "Netherlands Antilles",
	"NC" => "New Caledonia",
	"NZ" => "New Zealand",
	"NI" => "Nicaragua",
	"NE" => "Niger",
	"NG" => "Nigeria",
	"NU" => "Niue",
	"NF" => "Norfolk Island",
	"MP" => "Northern Mariana Islands",
	"NO" => "Norway",
	"OM" => "Oman",
	"PK" => "Pakistan",
	"PW" => "Palau",
	"PA" => "Panama",
	"PG" => "Papua New Guinea",
	"PY" => "Paraguay",
	"PE" => "Peru",
	"PH" => "Philippines",
	"PN" => "Pitcairn",
	"PL" => "Poland",
	"PT" => "Portugal",
	"PR" => "Puerto Rico",
	"QA" => "Qatar",
	"RE" => "Reunion",
	"RO" => "Romania",
	"RU" => "Russian Federation",
	"RW" => "Rwanda",
	"KN" => "Saint Kitts and Nevis", 
	"LC" => "Saint LUCIA",
	"VC" => "Saint Vincent and the Grenadines",
	"WS" => "Samoa",
	"SM" => "San Marino",
	"ST" => "Sao Tome and Principe", 
	"SA" => "Saudi Arabia",
	"SN" => "Senegal",
	"SC" => "Seychelles",
	"SL" => "Sierra Leone",
	"SG" => "Singapore",
	"SK" => "Slovakia (Slovak Republic)",
	"SI" => "Slovenia",
	"SB" => "Solomon Islands",
	"SO" => "Somalia",
	"ZA" => "South Africa",
	"GS" => "South Georgia and the South Sandwich Islands",
	"ES" => "Spain",
	"LK" => "Sri Lanka",
	"SH" => "St. Helena",
	"PM" => "St. Pierre and Miquelon",
	"SD" => "Sudan",
	"SR" => "Suriname",
	"SJ" => "Svalbard and Jan Mayen Islands",
	"SZ" => "Swaziland",
	"SE" => "Sweden",
	"CH" => "Switzerland",
	"SY" => "Syrian Arab Republic",
	"TW" => "Taiwan, Province of China",
	"TJ" => "Tajikistan",
	"TZ" => "Tanzania, United Republic of",
	"TH" => "Thailand",
	"TG" => "Togo",
	"TK" => "Tokelau",
	"TO" => "Tonga",
	"TT" => "Trinidad and Tobago",
	"TN" => "Tunisia",
	"TR" => "Turkey",
	"TM" => "Turkmenistan",
	"TC" => "Turks and Caicos Islands",
	"TV" => "Tuvalu",
	"UG" => "Uganda",
	"UA" => "Ukraine",
	"AE" => "United Arab Emirates",
	"GB" => "United Kingdom",
	"US" => "United States",
	"UM" => "United States Minor Outlying Islands",
	"UY" => "Uruguay",
	"UZ" => "Uzbekistan",
	"VU" => "Vanuatu",
	"VE" => "Venezuela",
	"VN" => "Viet Nam",
	"VG" => "Virgin Islands (British)",
	"VI" => "Virgin Islands (U.S.)",
	"WF" => "Wallis and Futuna Islands",
	"EH" => "Western Sahara",
	"YE" => "Yemen",
	"YU" => "Yugoslavia",
	"ZM" => "Zambia",
	"ZW" => "Zimbabwe"
	);
$_States = array(
	"AL" => "Alabama",
	"AK" => "Alaska",
	"AZ" => "Arizona",
	"AR" => "Arkansas",
	"CA" => "California",
	"CO" => "Colorado",
	"CT" => "Connecticut",
	"DE" => "Delaware",
	"DC" => "District of Columbia",
	"FL" => "Florida",
	"GA" => "Georgia",
	"HI" => "Hawaii",
	"ID" => "Idaho",
	"IL" => "Illinois",
	"IN" => "Indiana",
	"IA" => "Iowa",
	"KS" => "Kansas",
	"KY" => "Kentucky",
	"LA" => "Louisiana",
	"ME" => "Maine",
	"MD" => "Maryland",
	"MA" => "Massachusetts",
	"MI" => "Michigan",
	"MN" => "Minnesota",
	"MS" => "Mississippi",
	"MO" => "Missouri",
	"MT" => "Montana",
	"NE" => "Nebraska",
	"NV" => "Nevada",
	"NH" => "New Hampshire",
	"NJ" => "New Jersey",
	"NM" => "New Mexico",
	"NY" => "New York",
	"NC" => "North Carolina",
	"ND" => "North Dakota",
	"OH" => "Ohio",
	"OK" => "Oklahoma",
	"OR" => "Oregon",
	"PA" => "Pennsylvania",
	"RI" => "Rhode Island",
	"SC" => "South Carolina",
	"SD" => "South Dakota",
	"TN" => "Tennessee",
	"TX" => "Texas",
	"UT" => "Utah",
	"VT" => "Vermont",
	"VA" => "Virginia",
	"WA" => "Washington",
	"WV" => "West Virginia",
	"WI" => "Wisconsin",
	"WY" => "Wyoming",
	"NULL" => "International"
	);
?>
