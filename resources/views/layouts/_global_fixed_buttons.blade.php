<!-- Global fixed buttons -->
<div id="global-fixed-btns">
    <a href="javascript:" class=""><i class="fa fa-at"> 关注我们</i></a>
    <a href="javascript:" class=""><i class="fa fa-comments"> 提供建议</i></a>
</div>

<style rel="stylesheet">
    #global-fixed-btns {
        position: fixed;
        right: 20px;
        bottom: 20px;
    }

    #global-fixed-btns a {
        display: block;
        background: rgb(48, 151, 209);
        background: rgba(48, 151, 209, 0.9);
        color: white;
        padding: 4px 10px;
        margin: 4px 0;
        border-radius: 4px;
    }
</style>


<!-- Return to Top -->
<a href="javascript:" id="return-to-top"><i class="fa fa-arrow-up"></i></a>

<script type="text/javascript">
  $(window).scroll(function() {
    if ($(this).scrollTop() >= 50) {        // If page is scrolled more than 50px
      $('#return-to-top').fadeIn(200);    // Fade in the arrow
    } else {
      $('#return-to-top').fadeOut(200);   // Else fade out the arrow
    }
  });

  $('#return-to-top').click(function() {      // When arrow is clicked
    $('body,html').animate({
      scrollTop : 0                       // Scroll to top of body
    }, 500);
  });
</script>

<style rel="stylesheet" type="text/css">
    #return-to-top {
        z-index: 9998;
        position: fixed;
        bottom: 95px;
        right: 20px;
        background: rgb(48, 151, 209);
        background: rgba(48, 151, 209, 0.7);
        width: 50px;
        height: 50px;
        display: block;
        text-decoration: none;
        -webkit-border-radius: 35px;
        -moz-border-radius: 35px;
        border-radius: 35px;
        display: none;
        -webkit-transition: all 0.3s linear;
        -moz-transition: all 0.3s ease;
        -ms-transition: all 0.3s ease;
        -o-transition: all 0.3s ease;
        transition: all 0.3s ease;
        border: 2px solid #fff;
    }
    #return-to-top i {
        color: #fff;
        margin: 0;
        position: relative;
        left: 15px;
        top: 13px;
        font-size: 19px;
        -webkit-transition: all 0.3s ease;
        -moz-transition: all 0.3s ease;
        -ms-transition: all 0.3s ease;
        -o-transition: all 0.3s ease;
        transition: all 0.3s ease;
    }
    #return-to-top:hover {
        background: rgba(48, 151, 209, 0.9);
    }
    #return-to-top:hover i {
        color: #fff;
        top: 10px;
    }
</style>