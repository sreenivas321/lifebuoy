
<div class="row">
<h1><a href="<?php echo base_url();?>" id="logo"><img src="<?php echo base_url();?>templates/images/logo.png"></a></h1>
</div>
    	<div class="galleryDetailCon">
        	  	<div class="galleryDetailImgCon">
            	<div class="galleryDetailImg">
                	<div class="galleryDetailImgFile">
            			<img src="<?php echo $detail['image']?>">
                    </div>
                    <?php 
					if($this->session->userdata('user_id')!=0){
						if($already_vote){
							if($already_vote['type']==1){?>
							<div class="bigLike"></div>Liked
							<?php }else{?>
							<div class="bigUnlike"></div>Unliked
							<?php }
						}
					}?>                    
                </div>
            </div>
            <div class="galleryDetailDesc">
            	<div class="galleryDetailBox">
                	<div class="defBgWrapTop">
                        <div class="profileBg">
                            <div class="profileImg">
                            <?php //pre($detail);
                            if($detail['post_via']==0){
                            $data=json_decode($detail['data'],TRUE);
                            $profile_img=$data['user']['profile_image_url'];
                            //pre($data);
    //						$profile_img=$data['	
                            }else if($detail['post_via']==2){
								$fb_id=find('fb_id',$detail['uploader_id'],'user_tb');
								$profile_img='http://graph.facebook.com/'.$fb_id.'/picture?type=square';
							}
                            else{
                                $data=json_decode($detail['data'],TRUE);
                                $profile_img=$data['user']['profile_picture'];
                            }?>
                                <img src="<?php echo $profile_img;?>">
                            </div>
                            <div class="profileDesc">
                                <h3><?php echo ($detail['post_via']==0)?"@".$detail['username']:$detail['username'];?></h3>
                                <span><?php echo $detail['fullname'];?></span>
                            </div>
							<?php if($detail['post_via']==0){?>
                            <div class="bigTwitter"></div>twitter
                            <?php }else if($detail['post_via']==1){?>
                            <div class="bigInstagram"></div>instagram
                            <?php }else{ ?>
                            <div class="bigFacebook"></div>facebook
                            <?php }?>
                        </div>
                        <?php if($detail['category_id']==9){?>
                        <div class="defBg">
                        	<div class="badges">
                            	<img src="<?php echo base_url();?>templates/images/Badges-Gallery-Detail.png">
                            </div>
                        </div>
                        <?php }else if($detail['category_id']==10 && $detail['winner']==1){?>
                         <div class="defBg">
                        	<div class="badges" style="float:left;margin-right:10px;">
                            	<img src="<?php echo base_url()?>templates/images/Duck-Face.png">
                            </div>
                                      <p><?php echo $detail['description'];?></p>
                            <span class="uploadSource">Upload From <?php if($detail['post_via']==0)echo "Twitter"; else if($detail['post_via']==1)echo "Instagram"; else echo "Facebook";?></span>
                            <span class="uploadDate"><?php echo date("F d.Y",strtotime($detail['created_date']));?></span>
                         </div>
                        <?php }else if($detail['category_id']==5 && $detail['winner']==1){?>
                               <div class="defBg">
                        <div class="badges" style="float:left;margin-right:10px;">
                            	<img src="<?php echo base_url()?>templates/images/Xlove.png">
                               </div>
                                          <p><?php echo $detail['description'];?></p>
                            <span class="uploadSource">Upload From <?php if($detail['post_via']==0)echo "Twitter"; else if($detail['post_via']==1)echo "Instagram"; else echo "Facebook";?></span>
                            <span class="uploadDate"><?php echo date("F d.Y",strtotime($detail['created_date']));?></span>
                            
						</div>
                        <?php }else if($detail['category_id']==6 && $detail['winner']==1){?>
                               <div class="defBg">
                        <div class="badges" style="float:left;margin-right:10px;">
                            	<img src="<?php echo base_url()?>templates/images/Xtreme.png">
                                 </div>
                                          <p><?php echo $detail['description'];?></p>
                            <span class="uploadSource">Upload From <?php if($detail['post_via']==0)echo "Twitter"; else if($detail['post_via']==1)echo "Instagram"; else echo "Facebook";?></span>
                            <span class="uploadDate"><?php echo date("F d.Y",strtotime($detail['created_date']));?></span>
                            
                        </div>
                        <?php }else if($detail['category_id']==7 && $detail['winner']==1){?>
                               <div class="defBg">
                        <div class="badges" style="float:left;margin-right:10px;">
                            	<img src="<?php echo base_url()?>templates/images/pps.png">
                                 </div>
                                          <p><?php echo $detail['description'];?></p>
                            <span class="uploadSource">Upload From <?php if($detail['post_via']==0)echo "Twitter"; else if($detail['post_via']==1)echo "Instagram"; else echo "Facebook";?></span>
                            <span class="uploadDate"><?php echo date("F d.Y",strtotime($detail['created_date']));?></span>
                            
                        </div>
                        
                        
                        
                        <?php }else if($detail['category_id']==11 && $detail['winner']==1){?>
                               <div class="defBg">
                        <div class="badges" style="float:left;margin-right:10px;">
                            	<img src="<?php echo base_url()?>templates/images/group_selfie.png">
                                 </div>
                                          <p><?php echo $detail['description'];?></p>
                            <span class="uploadSource">Upload From <?php if($detail['post_via']==0)echo "Twitter"; else if($detail['post_via']==1)echo "Instagram"; else echo "Facebook";?></span>
                            <span class="uploadDate"><?php echo date("F d.Y",strtotime($detail['created_date']));?></span>
                            
                        </div>
                        <?php }else if($detail['category_id']==8 && $detail['winner']==1){?>
                               <div class="defBg">
                        <div class="badges" style="float:left;margin-right:10px;">
                            	<img src="<?php echo base_url()?>templates/images/Mirror-Selfie.png">
                                 </div>
                                          <p><?php echo $detail['description'];?></p>
                            <span class="uploadSource">Upload From <?php if($detail['post_via']==0)echo "Twitter"; else if($detail['post_via']==1)echo "Instagram"; else echo "Facebook";?></span>
                            <span class="uploadDate"><?php echo date("F d.Y",strtotime($detail['created_date']));?></span>
                            
                        </div>
                        <?php }else if($detail['category_id']==13 && $detail['winner']==1){?>
                               <div class="defBg">
                        <div class="badges" style="float:left;margin-right:10px;">
                            	<img src="<?php echo base_url()?>templates/images/Joko-Tarub-Style.png">
                                 </div>
                                          <p><?php echo $detail['description'];?></p>
                            <span class="uploadSource">Upload From <?php if($detail['post_via']==0)echo "Twitter"; else if($detail['post_via']==1)echo "Instagram"; else echo "Facebook";?></span>
                            <span class="uploadDate"><?php echo date("F d.Y",strtotime($detail['created_date']));?></span>
                            
                        </div>
                        <?php }else if($detail['category_id']==14 && $detail['winner']==1){?>
                               <div class="defBg">
                        <div class="badges" style="float:left;margin-right:10px;">
                            	<img src="<?php echo base_url()?>templates/images/XLent-Selfie.png">
                                 </div>
                                          <p><?php echo $detail['description'];?></p>
                            <span class="uploadSource">Upload From <?php if($detail['post_via']==0)echo "Twitter"; else if($detail['post_via']==1)echo "Instagram"; else echo "Facebook";?></span>
                            <span class="uploadDate"><?php echo date("F d.Y",strtotime($detail['created_date']));?></span>
                            
                        </div>
                        <?php } ?>

					<?php if($detail['category_id']!=6 && $detail['category_id']!=5 && $detail['category_id']!=10){?>
                        <div class="defBg">
                            <p><?php echo $detail['description'];?></p>
                            <span class="uploadSource">Upload From <?php if($detail['post_via']==0)echo "Twitter"; else if($detail['post_via']==1)echo "Instagram"; else echo "Facebook";?></span>
                            <span class="uploadDate"><?php echo date("F d.Y",strtotime($detail['created_date']));?></span>
                        </div>
                        <?php } ?>
                        
                        <div class="defBg" id="button_like">
<!--                        <?php //echo priny_r($already_vote);?>-->
						<?php /*if(date("Y-m-d")<"2014-04-01")if(!$already_vote){?>
                            <a href="javascript:void(0);" onclick="fb_likes(<?php echo $detail['id'] ?>,'1')" class="like_btn">
                                <?php echo $detail['like_count'];?>
                            </a>
                            <a href="javascript:void(0);" onclick="fb_likes(<?php echo $detail['id'] ?>,'0')" class="unlike_btn">
                                <?php echo $detail['dislike_count'];?>
                            </a>
                        <?php }else{?>
                            <a href="javascript:void(0);" onclick="alert('Kamu sudah pernah vote gambar ini');" class="like_btn">
                                <?php echo $detail['like_count'];?>
                            </a>
                            <a href="javascript:void(0);" onclick="alert('Kamu sudah pernah vote gambar ini');" class="unlike_btn">
                                <?php echo $detail['dislike_count'];?>
                            </a>
                        <?php }*/?>
                        <a href="javascript:void(0);" class="like_btn" onclick="alert('Kamu sudah tidak bisa vote lagi');">
                                like: <?php echo $detail['like_count'];?>
                            </a>
                            <a href="javascript:void(0);" class="unlike_btn" onclick="alert('Kamu sudah tidak bisa vote lagi');">
                                dislike: <?php echo $detail['dislike_count'];?>
                            </a>
                        
                        </div>
                        
                        <div class="defBg">
							<?php if($prev){?>
                                <a href="javascript:void(0);" onclick="window.location='<?php echo site_url('gallery/detail').'/'.$detail_category.'/'.$prev['id'];?>';" class="prev">Sebelumnya</a>
                            <?php }?>
                            <?php if($next){?>
                                <a href="javascript:void(0);" onclick="window.location='<?php echo site_url('gallery/detail').'/'.$detail_category.'/'.$next['id'];?>';" class="next">Sesudahnya</a>
                            <?php }?>
                        </div>
                        <div class="defBg">
                            <a href="javascript:void(0);" onclick="window.location='<?php echo $gallery_link;?>';" class="back"><span>Kembali ke Galeri</span></a>
                        </div>
                        <div class="defBg">
                        	Ayo share foto selfie kamu ke temen-temen. Ajak mereka ikutan dan like foto kamu karena ada hadiah menarik juga untuk voter yang beruntung.
                        </div>
                        
						<?php 
                        $fblink="https://www.facebook.com/dialog/feed?app_id=".APP_ID."&link=".urlencode('http://staging.isysedge.com/lifebuoy/?id='.$detail['id'])."&picture=".urlencode($detail['image'])."&name=".urlencode("demo lifebuoy")."&description=".urlencode("Lihat gokilnya foto #gundam ini ini, deh. Keren banget! Jangan lupa vote juga, ya. Karena kamu juga bisa dapet hadiah! Cek di sini buruan di toko terdekat")."&redirect_uri=".urlencode(site_url('closefb'));
            $twlink=urlencode("Lihat gokilnya foto #gundam ini dan jangan lupa vote, ya. Cek di staging.isysedge.com/lifebuoy?id=".$detail['id']);
                        ?>
                    </div>
                    <div class="defBgWrap">
                    
                        
                        <div class="defBg">
                            <div class="shareCon">
                                <span class="share" style="color:#000;">Share :</span>
                                <ul>
                                	<li><a href="#" class="facebook_share">Facebook</a></li>
                                	<li><a href="#" class="twitter_share">Twitter</a></li>
                                	
                            	</ul>
                            </div>
                        </div>	
                    </div>
                </div>
            </div>
        </div>
    <script>
	$(document).ready(function(){
		$(".facebook_share").click(function(){		
			var url_to_open='<?php echo $fblink;?>';
			var txt=$(this).attr('txt');	
			var width = 1000; 	
			var height = 550;
			var left = parseInt((screen.availWidth/2) - (width/2));
			var top = parseInt((screen.availHeight/2) - (height/2));
			window.open(url_to_open, "Facebook", 'height=350,width=700,left=' + left + ',top=' + top + ',screenX=' + left + ',screenY=' + top);
			return false;
		});
		
		$(".twitter_share").click(function(){	
			var url=$(this).attr('url');
			var txt='<?php echo $twlink;?>';		
			var url_to_open='http://twitter.com/share?url=&text='+txt;
			
			
			var width = 1000; 	
			var height = 550;
			var left = parseInt((screen.availWidth/2) - (width/2));
			var top = parseInt((screen.availHeight/2) - (height/2));
			window.open(url_to_open, "Tweet", 'height=350,width=700,left=' + left + ',top=' + top + ',screenX=' + left + ',screenY=' + top);
			return false;
		});
	});
	</script>