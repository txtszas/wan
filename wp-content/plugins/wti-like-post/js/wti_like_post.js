jQuery(document).ready(function(){
     jQuery(".like, .unlike").click(function(){
          console.log('post');
          that= jQuery(this).find('span');
          var task = jQuery(that).attr("rel");
          var post_id = jQuery(that).attr("id");
          
          if(task == "like")
          {
               post_id = post_id.replace("lc-", "");
          }
          else
          {
               post_id = post_id.replace("unlc-", "");
          }
          
          //jQuery("#status-" + post_id).html("&nbsp;&nbsp;").addClass("loading-img");
          
          jQuery.ajax({
               type: "POST",
               url: blog_url + "/wp-content/plugins/wti-like-post/wti_like.php",
               data: "post_id=" + post_id + "&task=" + task + "&num=" + Math.random(),
               success: function(data){
                    jQuery("#status-" + post_id).fadeIn();
                    jQuery("#lc-" + post_id).html(data.like);
                    jQuery("#unlc-" + post_id).html(data.unlike);
                    jQuery("#status-" + post_id).empty().html(data.msg);
                    setTimeout(function(){
                         jQuery("#status-" + post_id).fadeOut();
                    },2000); 
               },
               dataType: "json"
          });
     });
});
function link_post(){
          jQuery(".like, .unlike").unbind("click");
          jQuery(".like, .unlike").click(function(){
                 console.log('post type2')
          that= jQuery(this).find('span');
          var task = jQuery(that).attr("rel");
          var post_id = jQuery(that).attr("id");
          
          if(task == "like")
          {
               post_id = post_id.replace("lc-", "");
          }
          else
          {
               post_id = post_id.replace("unlc-", "");
          }
          //jQuery("#status-" + post_id).html("&nbsp;&nbsp;").addClass("loading-img");
          
          jQuery.ajax({
               type: "POST",
               url: blog_url + "/wp-content/plugins/wti-like-post/wti_like.php",
               data: "post_id=" + post_id + "&task=" + task + "&num=" + Math.random(),
               success: function(data){
                    jQuery("#status-" + post_id).fadeIn();
                    jQuery("#lc-" + post_id).html(data.like);
                    jQuery("#unlc-" + post_id).html(data.unlike);
                    jQuery("#status-" + post_id).empty().html(data.msg);
                    setTimeout(function(){
                         jQuery("#status-" + post_id).fadeOut();
                    },2000); 
               },
               dataType: "json"
          });
     });
}