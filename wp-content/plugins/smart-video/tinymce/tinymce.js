function init() {
	tinyMCEPopup.resizeToInnerSize();
}

function insertSmartVideo() {
	
	var tagtext = "";
	
	var automatic = document.getElementById('automatic_panel');
	var manual = document.getElementById('manual_panel');
	var flash = document.getElementById('flash_panel');
	
	// who is active ?
	if (automatic.className.indexOf('current') != -1) {
		var auto_url = document.getElementById('auto_url').value;
		var auto_width = parseInt(document.getElementById('auto_width').value);
		var auto_height = parseInt(document.getElementById('auto_height').value);
		
		var swf_id = "";
		
		if(auto_url.substr(0, 7).toLowerCase() != "http://") {
			auto_url = "http://" + auto_url;
		}
		
		var pat = /^(http:\/\/)[a-z0-9][-a-z0-9]{0,62}(\.[a-z0-9][-a-z0-9]{0,62})+\.?/ig;
				
		var domain = "";
		var shorttag = "";
				
		domain = auto_url.match(pat);
		domain = domain[0].toLowerCase();
		
		//debug(domain);
		try {
			// Youku
			if(domain.indexOf("youku") != -1) {
				pat = /^(http:\/\/v.youku.com\/v_show\/id_)([_\-a-z0-9]+)(\.html)?/i;
				swf_id = auto_url.match(pat)[2];
				shorttag = "youku";
				//debug(swf_id[1]);
			}
			
			// Ku6
			else if(domain.indexOf("ku6") != -1) {
				pat = /^(http:\/\/v.ku6.com\/show\/)([_\-a-z0-9]+)(\.html)?/i;
				swf_id = auto_url.match(pat)[2];
				shorttag = "ku6";
			}
			
			//Tudou
			else if(domain.indexOf("tudou") != -1) {
				pat = /^(http:\/\/www.tudou.com\/programs\/view\/)([_\-a-z0-9]+)(\/)?/i;
				swf_id = auto_url.match(pat)[2];
				shorttag = "tudou";
			}
			
			//QQ Video
			else if(domain.indexOf("qq") != -1) {
				pat = /^(http:\/\/video.qq.com\/v1\/videopl\?v=)([_\-a-z0-9]+)/i;
				swf_id = auto_url.match(pat)[2];
				shorttag = "qq";
			}
			
			//Youtube
			else if(domain.indexOf("youtube") != -1) {
				pat = /^(http:\/\/www.youtube.com\/watch\?v=)([_\-a-z0-9]+)/i;
				swf_id = auto_url.match(pat)[2];
				shorttag = "youtube";
			}
			
			//Sina Video
			else if(domain.indexOf("sina") != -1) {
				pat = /^(http:\/\/you.video.sina.com.cn\/b\/)([_0-9]+)-([_0-9]+).html/i;
				swf_id = auto_url.match(pat)[2];
				shorttag = "sina";
			}
			
			//Sohu Video
			else if(domain.indexOf("sohu") != -1) {
				pat = /^(http:\/\/v.blog.sohu.com\/u\/vw\/)([0-9]+)/i;
				swf_id = auto_url.match(pat)[2];
				shorttag = "sohu";
			}
			
			//Vimeo
			else if(domain.indexOf("vimeo") != -1) {
				pat = /^(http:\/\/)(www.)?(vimeo.com\/)([0-9]+)/i;
				swf_id = auto_url.match(pat)[4];
				shorttag = "vimeo";
			}
			
			//Mofile
			else if(domain.indexOf("mofile") != -1) {
				pat = /^(http:\/\/)(www.)?(mofile.com\/)([a-z0-9]+)(\/)?/i;
				swf_id = auto_url.match(pat)[4];
				shorttag = "mofile";
			}
			
		} catch(e) {
		}
		
		if(swf_id == "" || shorttag == "") {
			alert("URL not supported");
		} else {
			tagtext = "[" + shorttag + " id=\"" + swf_id + "\"";
			if (auto_width > 0) {
				tagtext += (" w=\"" + auto_width + "\"");
			}
			if (auto_height > 0) {
				tagtext += (" h=\"" + auto_height + "\"");
			}
			tagtext += "]";
		}
	}

	if (manual.className.indexOf('current') != -1) {
		var shorttag = document.getElementById('tag_list').value;
		var swf_id = document.getElementById('manual_id').value;
		var man_width = parseInt(document.getElementById('manual_width').value);
		var man_height = parseInt(document.getElementById('manual_height').value);

		if(swf_id == "" || shorttag == "") {
			alert("ID or Site not specified");
		} else {
			tagtext = "[" + shorttag + " id=\"" + swf_id + "\"";
			if (man_width > 0) {
				tagtext += (" w=\"" + man_width + "\"");
			}
			if (man_height > 0) {
				tagtext += (" h=\"" + man_height + "\"");
			}
			tagtext += "]";
		}
	}
	
	if (flash.className.indexOf('current') != -1) {
		var shorttag = "flash";
		var swf_url = document.getElementById('flash_url').value;
		var flash_width = parseInt(document.getElementById('flash_width').value);
		var flash_height = parseInt(document.getElementById('flash_height').value);

		if(swf_url == "" || shorttag == "") {
			alert("URL not specified");
		} else {
			tagtext = "[" + shorttag + " url=\"" + swf_url + "\"";
			if (flash_width > 0) {
				tagtext += (" w=\"" + flash_width + "\"");
			}
			if (flash_height > 0) {
				tagtext += (" h=\"" + flash_height + "\"");
			}
			tagtext += "]";
		}
	}

	if(tagtext != "" && window.tinyMCE) {
		//TODO: For QTranslate we should use here 'qtrans_textarea_content' instead 'content'
		window.tinyMCE.execInstanceCommand('content', 'mceInsertContent', false, tagtext);
		//Repaints the editor. Sometimes the browser has graphic glitches. 
		//tinyMCEPopup.editor.execCommand('mceRepaint');
		tinyMCEPopup.close();
	}
	return;
}
