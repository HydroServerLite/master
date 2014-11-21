<?php
//This is required to get the international text strings dictionary
require_once 'internationalize.php';
//check authority to be here
require_once 'authorization_check.php';
//All queries go through a translator. 
require_once 'DBTranslator.php';
require_once "_html_parts.php";
$option_block="";
//Display the appropriate user authority to add depending on the user's authority
if (isAdmin()){
	//select the users
	$sql ="Select username FROM moss_users WHERE (authority='teacher' OR authority='student') ORDER BY username";
	$result = transQuery($sql,0,0);
	if (count($result) < 1){
		$msg = "<P><em2>$SorryNoUsers</em></p>";
	} else {
	foreach ($result as $row) {
		$users = $row["username"];
		$option_block .= "<option value=$users>$users</option>";
		}
	}
}
elseif (isTeacher()){
	$sql ="Select username FROM moss_users WHERE (authority= 'teacher' OR'student') ORDER BY username";
	$result = transQuery($sql,0,0);
	if (count($result) < 1){
		$msg = "<P><em2>" + $NoUsers + "</em></p>";
	} else {
	foreach ($result as $row) {
		$users = $row["username"];
		$option_block .= "<option value=$users>$users</option>";
		}
	}
}
elseif (isStudent()){
	header("Location: unauthorized.php");
	exit;	
	}

	HTML_Render_Head();
	
	echo $CSS_Main;
	
	echo $JS_JQuery;

	HTML_Render_Body_Start(); ?>
<br /><p class="em" align="right"><!--Required fields are marked with an asterick (*).--><?php echo $RequiredFieldsAsterisk;?></p><?php echo "$msg"; ?>
      <h1><?php echo $ChangeUserPassword;?></h1>
      <p>&nbsp;</p>
      <FORM METHOD="POST" ACTION="do_changepassword.php">
        <table width="350" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="107" valign="top"><strong><!--Username:--><?php echo $UserName;?></strong></td>
          <td width="193" valign="top"><select name="username" id="username"><option value=""><!--Select a username....--><?php echo $SelectUsernameEllipisis;?></option><?php echo "$option_block"; ?></select>*</td>
        </tr>
        <tr>
          <td width="107" valign="top">&nbsp;</td>
          <td valign="top">&nbsp;</td>
        </tr>
        <tr>
          <td valign="top"><strong><!--New Password:--><?php echo $NewPassword;?></strong></td>
          <td valign="top"><input type="text" name="password" size="25" maxlength="25" />*</td>
        </tr>
        <tr>
          <td valign="top">&nbsp;</td>
          <td valign="top">&nbsp;</td>
        </tr>
        <tr>
          <td valign="top">&nbsp;</td>
          <!--<td valign="top"><input type="SUBMIT" name="submit" value="Change Password" class="button" style="width: 145px" /></td>-->
          <td valign="top"><input type="SUBMIT" name="submit" value="<?php echo $ChangePassword;?>" class="button" style="width: auto" /></td>
        </tr>
      </table>
  </FORM>
      <p>&nbsp;</p>
	  <p>&nbsp;</p>
      <p>&nbsp;</p>
      <p>&nbsp;</p>
	<?php HTML_Render_Body_End(); ?>