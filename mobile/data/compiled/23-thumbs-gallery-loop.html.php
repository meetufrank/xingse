<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>详情图片</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1.5, user-scalable=no">
    
    <link rel="stylesheet" href="<?php echo $this->_var['ectouch_themes']; ?>/Swiper-3.4.0/dist/css/swiper.min.css">

    
    <style>
    html, body {
        position: relative;
        height: 100%;
    }
    body {
        background: #000;
        font-family: Helvetica Neue, Helvetica, Arial, sans-serif;
        font-size: 14px;
        color:#000;
        margin: 0;
        padding: 0;
    }
    .swiper-container {
        width: 100%;
        height: 300px;
        margin-left: auto;
        margin-right: auto;
    }
    .swiper-slide {
        background-size: cover;
        background-position: center;
    }
    .gallery-top {
        height:70%;
        width: 100%;
    }
    .gallery-thumbs {
        height:20%;
        box-sizing: border-box;
        padding: 10px 0;
    }
    .gallery-thumbs .swiper-slide {
        height: 100%;
        opacity: 0.4;
    }
    .gallery-thumbs .swiper-slide-active {
        opacity: 1;
    }
    .swiper-hr{
        width: 100%;
        color: white;
    }
    .swiper-back{
        text-decoration: none;
        display: block;
        width:20px;
        height:20px;
        text-align:center;
        color: white;
        float: right;
        line-height:20px;
        margin-top:3px;
        margin-bottom:5px;
    }
    .clear{
        clear: both;
    }
    .swiper-pagination{
        color: white;
    }
    .swiper-slide img{
        width:100%;
        height:auto;
    }
    </style>
</head>
<body>
    <a href="javascript:void(history.back())" class="swiper-back">X</a>
    <div class="clear"></div>
    
    <div class="swiper-container gallery-top">
        <div class="swiper-wrapper">
            <?php $_from = $this->_var['imgarr']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'ia');if (count($_from)):
    foreach ($_from AS $this->_var['ia']):
?>
            <div class="swiper-slide"><img src="<?php echo $this->_var['ia']; ?>"></div>
            <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
           <!--  <div class="swiper-slide" style="background-image:url(http://lorempixel.com/1200/1200/nature/2)"></div>
            <div class="swiper-slide" style="background-image:url(http://lorempixel.com/1200/1200/nature/3)"></div>
            <div class="swiper-slide" style="background-image:url(http://lorempixel.com/1200/1200/nature/4)"></div>
            <div class="swiper-slide" style="background-image:url(http://lorempixel.com/1200/1200/nature/5)"></div>
            <div class="swiper-slide" style="background-image:url(http://lorempixel.com/1200/1200/nature/6)"></div>
            <div class="swiper-slide" style="background-image:url(http://lorempixel.com/1200/1200/nature/7)"></div>
            <div class="swiper-slide" style="background-image:url(http://lorempixel.com/1200/1200/nature/8)"></div>
            <div class="swiper-slide" style="background-image:url(http://lorempixel.com/1200/1200/nature/9)"></div>
            <div class="swiper-slide" style="background-image:url(http://lorempixel.com/1200/1200/nature/10)"></div> -->
        </div>
        
        <div class="swiper-pagination"></div>
    </div>
    <hr class="swiper-hr"></div>
    <div class="swiper-container gallery-thumbs">
        <div class="swiper-wrapper">
           <?php $_from = $this->_var['imgarr']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'ia');if (count($_from)):
    foreach ($_from AS $this->_var['ia']):
?>
            <div class="swiper-slide"><img src="<?php echo $this->_var['ia']; ?>"></div>
            <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
            <!-- <div class="swiper-slide" style="background-image:url(http://lorempixel.com/1200/1200/nature/1)"></div>
            <div class="swiper-slide" style="background-image:url(http://lorempixel.com/1200/1200/nature/2)"></div>
            <div class="swiper-slide" style="background-image:url(http://lorempixel.com/1200/1200/nature/3)"></div>
            <div class="swiper-slide" style="background-image:url(http://lorempixel.com/1200/1200/nature/4)"></div>
            <div class="swiper-slide" style="background-image:url(http://lorempixel.com/1200/1200/nature/5)"></div>
            <div class="swiper-slide" style="background-image:url(http://lorempixel.com/1200/1200/nature/6)"></div>
            <div class="swiper-slide" style="background-image:url(http://lorempixel.com/1200/1200/nature/7)"></div>
            <div class="swiper-slide" style="background-image:url(http://lorempixel.com/1200/1200/nature/8)"></div>
            <div class="swiper-slide" style="background-image:url(http://lorempixel.com/1200/1200/nature/9)"></div>
            <div class="swiper-slide" style="background-image:url(http://lorempixel.com/1200/1200/nature/10)"></div> -->
        </div>
    </div>

    
    <script src="<?php echo $this->_var['ectouch_themes']; ?>/Swiper-3.4.0/dist/js/swiper.js"></script>

    
    <script>
    var galleryTop = new Swiper('.gallery-top', {
        nextButton: '.swiper-button-next',
        prevButton: '.swiper-button-prev',
        spaceBetween: 10,
        loop:true,
        loopedSlides: <?php echo $this->_var['imgcount']; ?>, //looped slides should be the same
        pagination:'.swiper-pagination',
        paginationType:'fraction'
    });
    var galleryThumbs = new Swiper('.gallery-thumbs', {
        spaceBetween: 10,
        slidesPerView:4,
        touchRatio: 0.2,
        loop:true,
        loopedSlides: <?php echo $this->_var['imgcount']; ?>, //looped slides should be the same
        slideToClickedSlide: true
    });
    galleryTop.params.control = galleryThumbs;
    galleryThumbs.params.control = galleryTop;

    </script>
</body>
</html>
