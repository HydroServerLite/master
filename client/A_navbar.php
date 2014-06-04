<?php
header('Content-Type: text/javascript');
error_reporting(-1); 
ini_set('display_errors', true); 
//This is required to get the international text strings dictionary
require_once ("internationalize.php");
//include '_text.php';

?>

document.write("<div class='nav'><br /><div class='menuhead2'><?php echo $AdministratorNavigation; ?></div><a href=home.php class='button'><img src='images/icons/Home.png'>&nbsp;&nbsp;<?php echo $Home; ?></a><br /><a href=help.php class='button'><img src='images/icons/Help.png'>&nbsp;&nbsp;<?php echo $Help; ?></a><br /><a href=index.php class='button'><img src='images/icons/Logout.png'>&nbsp;&nbsp;<?php echo $Logout; ?></a><br /><div id='dbm_heading'><div class='menuhead'><?php echo $DatabaseManagement; ?></div></div><div id='dbm_links'><a href=add_source.php class='button'><img src='images/icons/Add_Source.png'>&nbsp;&nbsp;<?php echo $AddSource; ?></a><br/><a href=change_source.php class='button'><img src='images/icons/Change_Source.png'>&nbsp;&nbsp;<?php echo $ChangeSource; ?></a><br/><a href=add_site.php class='button'><img src='images/icons/Add_Site.png'>&nbsp;&nbsp;<?php echo $AddSite; ?></a><br /><a href=edit_site.php class='button'><img src='images/icons/Change_Site.png'>&nbsp;&nbsp;<?php echo $ChangeSite; ?></a><br/><a href=add_variable.php class='button'><img src='images/icons/Add_Variable.png'>&nbsp;&nbsp;<?php echo $AddVariable; ?></a><br /><a href=edit_var.php class='button'><img src='images/icons/Change_Variable.png'>&nbsp;&nbsp;<?php echo $ChangeVariable; ?></a><br/><a href=add_method.php class='button'><img src='images/icons/Add_Method.png'>&nbsp;&nbsp;<?php echo $AddMethod; ?></a><br /><a href=change_method.php class='button'><img src='images/icons/Change_Method.png'>&nbsp;&nbsp;<?php echo $ChangeMethod; ?></a></div><div id='u_heading'><div href=# class='menuhead'><?php echo $Users; ?></div></div><div id='u_links'><a href=adduser.php class='button'><img src='images/icons/Add_User.png'>&nbsp;&nbsp;<?php echo $AddUser; ?></a><br /><a href=changepassword.php class='button'><img src='images/icons/Change_Password.png'>&nbsp;&nbsp;<?php echo $ChangeUserPassword; ?></a><br /><a href=changeauthority.php class='button'><img src='images/icons/Change_Authority.png'>&nbsp;&nbsp;<?php echo $ChangeUserAuthority; ?></a><br /><a href=removeuser.php class='button'><img src='images/icons/Remove_User.png'>&nbsp;&nbsp;<?php echo $RemoveUser; ?></a></div><div id='d_heading'><div href=# class='menuhead'><?php echo $AddData; ?></div></div><div id='d_links'><a href=add_data_value.php class='button'><img src='images/icons/Add_Data_Value.png'>&nbsp;&nbsp;<?php echo $AddSingleValue; ?></a><br /><a href=add_multiple_values.php class='button'><img src='images/icons/Add_Multiple_Values.png'>&nbsp;&nbsp;<?php echo $AddMultipleValues; ?></a><br /><a href=import_data_file.php class='button'><img src='images/icons/Import_Data_File.png'>&nbsp;&nbsp;<?php echo $Import; ?></a></div><div id='vm_heading'><div href=# class='menuhead'><?php echo $ViewModifyData; ?></div></div><div id='vm_links'><a href=view_main.php class='button'><img src='images/icons/SearchData.png'>&nbsp;&nbsp;<?php echo $SearchData; ?></a></div><p>&nbsp;</p></div><script>(function($){ $('#dbm_links').css('display','none');$('#u_links').css('display','none');$('#d_links').css('display','none');$('#vm_links').css('display','none');$('#dbm_heading').click(function(){$('#dbm_links').slideToggle('slow');});$('#u_heading').click(function(){$('#u_links').slideToggle('slow');});$('#d_heading').click(function(){$('#d_links').slideToggle('slow');});$('#vm_heading').click(function(){$('#vm_links').slideToggle('slow');});})(jQuery);</script>");
