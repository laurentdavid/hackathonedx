<?php get_header(); ?>

<div id="content" class="medium-8 large-8 columns" role="main">
    <style type="text/css">
      @font-face {
	    font-family: 'BDCartoonShoutRegular';
        src: url('<?php bloginfo('url'); ?>/wp-content/themes/hackathon-theme/pacman/BD_Cartoon_Shout-webfont.ttf') format('truetype');
	    font-weight: normal;
	    font-style: normal;
      }
      #pacman {
        height:450px;
        width:342px;
        margin:20px auto;
      }
      #shim { 
        font-family: BDCartoonShoutRegular; 
        position:absolute;
        visibility:hidden
      }
    </style>

	<h1 style="font-family: BDCartoonShoutRegular; text-align:center;"><?php _e("404 Error! Let's take a short break...","hackathon-theme")?></h1>
	<div id="pacman"></div>
	<script src="<?php bloginfo('url'); ?>/wp-content/themes/hackathon-theme/pacman/pacman.js"></script>
	<script src="<?php bloginfo('url'); ?>/wp-content/themes/hackathon-theme/pacman/modernizr-1.5.min.js"></script>

	<script>
    	var el = document.getElementById("pacman");
    	if (Modernizr.canvas && Modernizr.localstorage && 
	        Modernizr.audio && (Modernizr.audio.ogg || Modernizr.audio.mp3)) {
      			window.setTimeout(function () { PACMAN.init(el, "<?php bloginfo('url'); ?>/wp-content/themes/hackathon-theme/pacman/"); }, 0);
    	} else { 
      		el.innerHTML = "Sorry, needs a decent browser<br /><small>" + 
        	"(firefox 3.6+, Chrome 4+, Opera 10+ and Safari 4+)</small>";
    	}
  	</script>
	
	<a href="https://github.com/daleharvey/pacman">From Dale Harvey on Github</a>
	<hr/>
	<div class="navigation">
		<a href="<?php bloginfo('url'); ?>"><?php _e("Homepage","hackathon-theme") ?></a> /   
		<a href="javascript:history.back();"><?php _e("Previous Page","hackathon-theme") ?></a> /
		<a href="<?php echo get_bloginfo('url').'/contact'; ?>"><?php _e("Report a problem ?","hackathon-theme") ?></a>
	</div>
</div>

<?php get_footer(); ?>