<?php

// look up for the path
require_once( dirname( dirname(__FILE__) ) . '/sv-config.php');

// check for rights
if ( !is_user_logged_in() || !current_user_can('edit_posts') ) 
	wp_die(__("You are not allowed to be here"));
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>Add Smart Video</title>
	<script language="javascript" type="text/javascript" src="<?php echo get_option('siteurl') ?>/wp-includes/js/tinymce/tiny_mce_popup.js"></script>
	<script language="javascript" type="text/javascript" src="<?php echo get_option('siteurl') ?>/wp-includes/js/tinymce/utils/mctabs.js"></script>
	<script language="javascript" type="text/javascript" src="<?php echo get_option('siteurl') ?>/wp-includes/js/tinymce/utils/form_utils.js"></script>
	<script language="javascript" type="text/javascript" src="<?php echo SMARTVIDEO_URLPATH ?>tinymce/tinymce.js?v=1.5"></script>
</head>
<body id="smartvideo" onLoad="tinyMCEPopup.executeOnLoad('init();');document.body.style.display='';document.getElementById('auto_url').focus();" style="display: none">
<form onsubmit="return false;" action="#">
	<div class="tabs">
		<ul>
			<li id="automatic_tab" class="current"><span><a href="javascript:mcTabs.displayTab('automatic_tab','automatic_panel');" onmousedown="return false;">{#SmartVideo.auto_title}</a></span></li>
			<li id="mannual_tab"><span><a href="javascript:mcTabs.displayTab('mannual_tab','manual_panel');" onmousedown="return false;">{#SmartVideo.manual_title}</a></span></li>
			<li id="flash_tab"><span><a href="javascript:mcTabs.displayTab('flash_tab','flash_panel');" onmousedown="return false;">{#SmartVideo.flash_title}</a></span></li>
		</ul>
	</div>

	<div class="panel_wrapper">
		<div id="automatic_panel" class="panel current" style="height:100px;">

		<table border="0" cellpadding="4" cellspacing="0">
          <tr>
            <td class="nowrap"><label for="href">{#SmartVideo.auto_url}</label></td>
            <td><input id="auto_url" name="href" type="text" class="mceFocus" value="http://" style="width: 200px" onfocus="try{this.select();}catch(e){}" /></td> 
          </tr>
		  <tr>
			<td><label for="link_list">{#SmartVideo.width}</label></td>
			<td><input id="auto_width" name="href" type="text" class="mceFocus" value="" style="width: 50px" onfocus="try{this.select();}catch(e){}" /> ({#SmartVideo.blank})</td>
		  </tr>
		  <tr>
			<td><label id="targetlistlabel" for="targetlist">{#SmartVideo.height}</label></td>
			<td><input id="auto_height" name="href" type="text" class="mceFocus" value="" style="width: 50px" onfocus="try{this.select();}catch(e){}" /> ({#SmartVideo.blank})</td>
		  </tr>
        </table>
		</div>
		<div id="manual_panel" class="panel" style="height:100px;">

		<table border="0" cellpadding="4" cellspacing="0">
          <tr>
            <td class="nowrap"><label for="href">{#SmartVideo.site_list}</label></td>
            <td>
			  <select id="tag_list" name="tag_list">
			    <option value="youku">Youku</option>
			    <option value="tudou">Tudou</option>
			    <option value="youtube">Youtube</option>
			    <option value="ku6">Ku6</option>
			    <option value="qq">QQ Video</option>
			    <option value="sina">Sina</option>
			    <option value="sohu">Sohu</option>
			    <option value="vimeo">Vimeo</option>
			    <option value="mofile">Mofile</option>
			  </select>
			</td> 
          </tr>
          <tr>
            <td class="nowrap"><label for="href">{#SmartVideo.manual_id}</label></td>
            <td><input id="manual_id" name="href" type="text" class="mceFocus" value="" style="width: 100px" onfocus="try{this.select();}catch(e){}" /></td> 
          </tr>
		  <tr>
			<td><label for="link_list">{#SmartVideo.width}</label></td>
			<td><input id="manual_width" name="href" type="text" class="mceFocus" value="" style="width: 50px" onfocus="try{this.select();}catch(e){}" /> ({#SmartVideo.blank})</td>
		  </tr>
		  <tr>
			<td><label id="targetlistlabel" for="targetlist">{#SmartVideo.height}</label></td>
			<td><input id="manual_height" name="href" type="text" class="mceFocus" value="" style="width: 50px" onfocus="try{this.select();}catch(e){}" /> ({#SmartVideo.blank})</td>
		  </tr>
        </table>
		</div>
		<div id="flash_panel" class="panel" style="height:100px;">

		<table border="0" cellpadding="4" cellspacing="0">
          <tr>
            <td class="nowrap"><label for="href">{#SmartVideo.flash_url}</label></td>
            <td><input id="flash_url" name="href" type="text" class="mceFocus" value="" style="width: 100px" onfocus="try{this.select();}catch(e){}" /></td> 
          </tr>
		  <tr>
			<td><label for="link_list">{#SmartVideo.width}</label></td>
			<td><input id="flash_width" name="href" type="text" class="mceFocus" value="" style="width: 50px" onfocus="try{this.select();}catch(e){}" /> ({#SmartVideo.blank})</td>
		  </tr>
		  <tr>
			<td><label id="targetlistlabel" for="targetlist">{#SmartVideo.height}</label></td>
			<td><input id="flash_height" name="href" type="text" class="mceFocus" value="" style="width: 50px" onfocus="try{this.select();}catch(e){}" /> ({#SmartVideo.blank})</td>
		  </tr>
        </table>
		</div>
	</div>

	<div class="mceActionPanel">
		<div style="float: left">
			<input type="button" id="cancel" name="cancel" value="{#cancel}" onclick="tinyMCEPopup.close();" />
		</div>

		<div style="float: right">
			<input type="submit" id="insert" name="insert" value="{#insert}" onclick="insertSmartVideo();" />
		</div>
	</div>
</form>
</body>
</html>
