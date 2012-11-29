=== 插件名称 ===
作者: Allen Hsu
标签: video, flash, swf, youtube, media, tudou, youku, qq, ku6, sina, sohu, vimeo
最低版本: 2.5.0
已测版本: 2.9.1
稳定版本: 1.5.1

为 WordPress 添加对在线视频的支持. 目前支持土豆, QQ 视频, 酷6, 新浪视频, 优酷, 搜狐视频, YouTube, Vimeo, Mofile 等网站.

== 插件说明 ==

你可以使用形如 [youtube id="fY4Epc2XSGc"] 的代码来插入视频. 也可以通过文章编辑界面的智能插入方式来添加视频.

= 反馈信息 =
http://www.imallen.com/blog/works/smart-video-plugin-for-wordpress/

== 插件安装 ==

1. 你可以在后台插件管理页面中直接搜索 `Smart Video` 并安装.
1. 或者上传文件夹 `smart-video` 至 `/wp-content/plugins/` 目录.
1. 在插件管理页面中激活 Smart Video.
1. 插入诸如 `[youtube id="fY4Epc2XSGc"]` 的代码, 或使用智能插入插件, 然后发布.

= 使用方法 =
1. 文章编辑界面:
点击 Smart Video 的图标, 在弹出对话框中有三个标签.

1.1 智能插入:
你可以直接输入例如 `http://www.youtube.com/watch?v=fY4Epc2XSGc` 的网址. 在点击了 "插入" 以后, 会自动转换成如 `[youtube id="fY4Epc2XSGc"]` 的代码.

1.2 手动插入:
在这里, 你需要选择网站, 并手动输入视频 ID. 视频 ID 即下面网址中用花括号标注的部分:

	http://v.ku6.com/show/`{nNjHZUTAi79x3atP}`.html
	http://v.youku.com/v_show/id_`{XMTE2ODE2MjUy}`.html
	http://www.tudou.com/programs/view/`{J-2bug0o0u4}`/
	http://video.qq.com/v1/videopl?v=`{6mkvdlafJbU}`
	http://www.youtube.com/watch?v=`{-v4osKSQrrk}`
	http://you.video.sina.com.cn/b/`{24114739}`-1371694022.html
	http://www.vimeo.com/`{5606758}`
	http://v.blog.sohu.com/u/vw/`{3151517}`
	http://www.mofile.com/`{IAXGI4FF}`/

1.3 插入 Flash:
你也可以直接插入一段 Flash.

2. 代码模式:
当然你也可以手动输入代码.
以下标签是合法的:

	[ku6 id="{id}" h="{height}" w="{width}"]
	[youku id="{id}" h="{height}" w="{width}"]
	[tudou id="{id}" h="{height}" w="{width}"]
	[qq id="{id}" h="{height}" w="{width}"]
	[youtube id="{id}" h="{height}" w="{width}"]
	[sina id="{id}" h="{height}" w="{width}"]
	[sohu id="{id}" h="{height}" w="{width}"]
	[vimeo id="{id}" h="{height}" w="{width}"]
	[mofile id="{id}" h="{height}" w="{width}"]
	[flash url="{url}" h="{height}" w="{width}"]

== 更新记录 ==

= 1.5.1 =
* 屏蔽了视频中的官网连接.
* 修正了优酷视频无法全屏的问题.

= 1.5 =
* 加入对 Mofile 魔方网视频的支持.
* JW FLV Player 升级.

= 1.4 =
* 加入对 Vimeo 和搜狐视频的支持.

= 1.3 =
* 加入 JW FLV Player, 以提供对任意 Flash 的进度, 音量控制.

= 1.2 =
* 修正目录错误.

= 1.1 =
* 修正土豆网址解析中的错误.

= 1.0 =
* Smart Video 的第一个版本.