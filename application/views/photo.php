<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>Indonesia's Next Top Selfie</title>
<link href="css/fontAttach/stylesheet.css" rel="stylesheet" type="text/css" />
<link href="css/xl_selfie.css" rel="stylesheet" type="text/css" />
<script src="js/jquery-1.9.1.js"></script>
<script src="js/select.js"></script>
<script src="js/main.js" type="text/javascript"></script>
</head>

<body>
<section>
    <h1><a href="#" id="logo">Indonesia Next Top Selfie</a></h1>
    	<div class="container">
            <div class="filterBy">
            	<div class="homeButton">
                	<a href="#">Home</a>
                </div>
                <div class="sortbyCon">
                	<span>Galeri</span> | Sort By
                    <select class="selectForm">
                        <option>#SelfieUnlimited #SelfieValentine</option>
                        <option>#SelfieUnlimited #SelfieValentine</option>
                    </select>
                </div>
                
            </div>
            <div class="galleryCon">
                <ul>
				<?php if($posting_list) foreach ($posting_list as $list){ ?>
                    <li>
                        <div class="galleryBox">
                            <div class="galleryImg">
                                <div class="galleryImgPhoto">
                                    <a href="#"><img src="../userdata/4.jpg"></a>
                                </div>
                            </div>
                            <a href="#" class="userName">@seohyunaja</a>
                            <div class="info">
                                <div class="favorite">
                                    <div class="like">936</div>
                                    <div class="unlike">2</div>
                                </div>
                                <div class="source instagram"></div>
                            </div>
                        </div>
                    </li>
                    <?php }?>
                </ul>
            </div>
            <div class="paging">
            <?php if($pagination)echo $pagination;?>
            <!--
            	<a href="#" class="page back_btn"></a>
                <span class="page active">1</span>
                <a href="#" class="page">2</a>
                <a href="#" class="page">3</a>
                <a href="#" class="page">4</a>
                <a href="#" class="page">5</a>
                <a href="#" class="page next_btn"></a>-->
            </div>
    	</div>
</section>
</body>
</html>
<?php /*?>
<?php if($posting_list) foreach ($posting_list as $list){ ?><br />

<?php echo $list['fullname']?>
<br />
<img src="<?php echo $list['image'];?>" width="200"/>
  <?php if($this->session->userdata('user_logged_in') == FALSE){?>
  
<a href="javascript:void(0)" onClick="facebookLogin()"> Like</a><br />
<a href="javascript:void(0)" onClick="facebookLogin()"> Dislike</a><br />

  <?php }else{?>
  
<a href="javascript:void(0)" onClick="fb_likes(<?php echo $list['id'] ?>,'1')"> Like</a><br />
<a href="javascript:void(0)" onClick="fb_likes(<?php echo $list['id'] ?>,'0')"> Dislike</a><br />

<?php }?>

<?php }?>
<?php */?>