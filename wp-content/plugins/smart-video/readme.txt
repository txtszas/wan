=== Plugin Name ===
Contributors: allenhsu
Tags: video, flash, swf, youtube, media, tudou, youku, qq, ku6, sina, sohu, vimeo
Requires at least: 2.5.0
Tested up to: 2.9.1
Stable tag: 1.5.1

A plugin for WordPress to display flash videos. Such as TuDou, QQ Video, Ku6, Sina Video, YouKu, Sohu Video, YouTube, Vimeo, Mofile and so on.

== Description ==

A plugin for WordPress to display flash videos. Such as TuDou, QQ Video, Ku6, Sina Video, YouKu, Sohu Video, YouTube, Vimeo, Mofile and so on. You can user short tags such as `[youtube id="fY4Epc2XSGc"]` to insert videos. It also adds a TinyMCE plugin for you to insert videos more conveniently.

= Feedback =
http://www.imallen.com/blog/works/smart-video-plugin-for-wordpress/

== Installation ==

1. Search for `Smart Video` in the `Plugins` menu to install.
1. Or upload folder `smart-video` to the `/wp-content/plugins/` directory.
1. Activate Smart Video through the 'Plugins' menu in WordPress.
1. Place the code such as `[youtube id="fY4Epc2XSGc"]` in your post, or just use the `Magic Insert` in TinyMCE, and then publish it.

= Usage =
1. In TinyMCE:
Click the icon of Smart Video, in the popup window, there're 3 tabs.

1.1 Magic Insert:
You can input the page url such as `http://www.youtube.com/watch?v=fY4Epc2XSGc`. After you click "Insert", it will be translated into short tags as `[youtube id="fY4Epc2XSGc"]`.

1.2 Manual Insert:
In this tab, you should find the video ID by yourself. The ID is the part marked with "{}" as follow:

	http://v.ku6.com/show/`{nNjHZUTAi79x3atP}`.html
	http://v.youku.com/v_show/id_`{XMTE2ODE2MjUy}`.html
	http://www.tudou.com/programs/view/`{J-2bug0o0u4}`/
	http://video.qq.com/v1/videopl?v=`{6mkvdlafJbU}`
	http://www.youtube.com/watch?v=`{-v4osKSQrrk}`
	http://you.video.sina.com.cn/b/`{24114739}`-1371694022.html
	http://www.vimeo.com/`{5606758}`
	http://v.blog.sohu.com/u/vw/`{3151517}`

1.3 Insert Flash:
You can insert flash by specifying the url and the size (size if optional).

2. In Code View:
Of cause you can input all the code by hand.
Short tags are as follows:

	[ku6 id="{id}" h="{height}" w="{width}"]
	[youku id="{id}" h="{height}" w="{width}"]
	[tudou id="{id}" h="{height}" w="{width}"]
	[qq id="{id}" h="{height}" w="{width}"]
	[youtube id="{id}" h="{height}" w="{width}"]
	[sina id="{id}" h="{height}" w="{width}"]
	[sohu id="{id}" h="{height}" w="{width}"]
	[vimeo id="{id}" h="{height}" w="{width}"]
	[flash url="{url}" h="{height}" w="{width}"]

== Changelog ==

= 1.5.1 =
* Disabled links to the official sites.
* Fixed Youku's fullscreen problem.

= 1.5 =
* Mofile supported.
* JW FLV Player updated.

= 1.4 =
* Vimeo and Sohu supported.

= 1.3 =
* JW FLV Player added.

= 1.2 =
* Fixed directory error.

= 1.1 =
* Fixed regex error with tudou.

= 1.0 =
* The first release of Smart Video.