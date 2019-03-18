<div id="content">
    <h2>Instagram &raquo; <?php echo $hashtag;?> &raquo; List</h2>
    <div id="submenu">
        <ul>  
            <li>  
			<?php if($prev_link!=1){?>
            <a class="defBtn" href="<?php echo site_url('xlselfie_admin/instagram/mirror').'/'.$prev_link.'/01';?>"><span>PREV</span></a>
            <?php }?>
			<?php if($pagination!=11){?><a class="defBtn" href="<?php echo site_url('xlselfie_admin/instagram/mirror/01').'/'.$pagination;?>"><span>NEXT</span></a><?php }?>       
            </li>  	
        </ul>
    </div>
    <table class="defAdminTable" width="100%">
        <thead>
        	<tr>
            	<th width="2%">No</th>
                <th width="10%">Action</th>
                <th width="16%">Category</th>
                <th width="20%">Name(Username)</th>
                <th width="10%">Images</th>
                <th width="42%">Description </th>
            </tr>
        </thead>
        <tbody>
        
           <?php $no=1; 
			  if($images_list)foreach($images_list as $list){?>
            <tr>
                <td valign="top"><?php echo $no;?></td>
                 <td valign="top">
                  
                   <form>
                   <input type="hidden" name="image_src" id="image_src_<?php echo $no;?>" value="<?php echo $list['src'];?>">
                   <input type="hidden" name="caption" id="caption_<?php echo $no;?>" value="<?php echo $list['caption'];?>">
                    <input type="hidden" name="username" id="username_<?php echo $no;?>" value="<?php echo $list['username'];?>">
                    <input type="hidden" name="fullname"  id="fullname_<?php echo $no;?>" value="<?php echo $list['fullname'];?>">
                    <input type="hidden" name="datall"  id="dataall_<?php echo $no;?>" value="<?php echo $list['dataall'];?>">
                     <input type="hidden" name="profile_picture"  id="profile_picture_<?php echo $no;?>" value="<?php echo $list['profile_picture'];?>">
                     <input type="hidden" name="instagram_id"  id="instagram_id_<?php echo $no;?>" value="<?php echo $list['user_id_instagram'];?>">
          	<?php if(!in_array($list['src'],$post_list)){?>
                        <a href="javascript:void(0)" title="Approve this" onClick="approve_data(<?php echo $no;?>);" id="action_<?php echo $no;?>"><img id="image_active_<?php echo $no;?>" src="<?php echo base_url()?>templates/images/inactive.png" /></a>
                    <?php }else{ ?>
                    <img id="image_active_<?php echo $no;?>" title="Approved" src="<?php echo base_url()?>templates/images/active.png" width="18" height="18"/>
                    <?php } ?>
                    
                    	<?php if(!in_array($list['src'],$instagram_rejected)){?>
                        <a href="javascript:void(0)" title="Reject this" onClick="reject_data(<?php echo $no;?>);" id="action_<?php echo $no;?>"><img id="reject_active_<?php echo $no;?>" src="<?php echo base_url()?>templates/images/denied_inactive.png" /></a>
                    <?php }else{ ?>
                    <img id="reject_active_<?php echo $no;?>" title="Rejected" src="<?php echo base_url()?>templates/images/denied_active.png" width="18" height="18"/>
                    <?php } ?>
                    </form>
                  </td>
                  <td>           
                <select name="category_id" id="category_<?php echo $no;?>">
                <option value="0">== Select Category ==</option>
                <?php if($category)foreach($category as $list2){?>
                <option value="<?php echo $list2['id'];?>"   <?php if(isset($category_list[$list['src']]))echo "selected=\"selected\"";?>><?php echo $list2['name'];?></option>
                <?php }?>
                </select>
                  </td>
                <td valign="top"><?php echo $list['fullname'].'('.$list['username'].')';?></td>
                <td valign="top"><a href="<?php echo $list['url'];?>"><img src="<?php echo $list['thumb']?>"> </img></a></td>
      			 <td valign="top"><?php echo wordwrap($list['caption'],20);?></td>
    		</tr>
			<?php $no++; ?>	
			 <?php }else if(!$images_list){ ?> 
            <tr>
                <td colspan="6" align="center"><?php echo "No Pending Instagram List"; ?></td>
        	</tr>
            <?php } ?>
        </tbody>
    </table>
<div id="submenu">
        <ul>  
            <li>  
			<?php if($prev_link!=1){?>
            <a class="defBtn" href="<?php echo site_url('xlselfie_admin/instagram/mirror').'/'.$prev_link.'/01';?>"><span>PREV</span></a>
            <?php }?>
			<?php if($pagination!=11){?><a class="defBtn" href="<?php echo site_url('xlselfie_admin/instagram/mirror/01').'/'.$pagination;?>"><span>NEXT</span></a><?php }?>       
            </li>  	
        </ul>
    </div>    
</div>
<script>
function approve_data(id){
	if(confirm('Approve?')){
			var image_src = $("#image_src_"+id).val();
			var caption = $("#caption_"+id).val();
			var username = $("#username_"+id).val();
			var fullname = $("#fullname_"+id).val();
			var category = $("#category_"+id).val();
			var dataall = $("#dataall_"+id).val();
			var instagram_id = $("#instagram_id_"+id).val();
			var profile_picture = $("#profile_picture_"+id).val();
			//alert (username);
			$.ajax({
			type: "POST",
			url: "<?php echo site_url('xlselfie_admin/instagram/do_approve');?>",
			data: {
						image_src : image_src,
						caption:caption,
						username:username,
						fullname:fullname,
						category:category,
						dataall:dataall,
						instagram_id:instagram_id,
						profile_picture:profile_picture,
					},
			
			success: function(data){
			$('#image_active_'+id).attr('src','<?php echo base_url()?>templates/images/active.png');
			$('#image_active_'+id).attr('width','18');
			$('#image_active_'+id).attr('height','18');
			$('#action_'+id).removeAttr('onClick');
			$('#action_'+id).removeAttr('href');
  	}
	
}
);
	}
}
function reject_data(id){
	if(confirm('Rejected?')){
			var image_src = $("#image_src_"+id).val();
			var caption = $("#caption_"+id).val();
			var username = $("#username_"+id).val();
			var fullname = $("#fullname_"+id).val();
			var category = $("#category_"+id).val();
			var dataall = $("#dataall_"+id).val();
			var instagram_id = $("#instagram_id_"+id).val();
			var profile_picture = $("#profile_picture_"+id).val();
			//alert (username);
			$.ajax({
			type: "POST",
			url: "<?php echo site_url('xlselfie_admin/instagram/do_reject');?>",
			data: {
						image_src : image_src,
						caption:caption,
						username:username,
						fullname:fullname,
						category:category,
						dataall:dataall,
						instagram_id:instagram_id,
						profile_picture:profile_picture,
					},
			
			success: function(data){
			$('#reject_active_'+id).attr('src','<?php echo base_url()?>templates/images/denied_active.png');
			$('#reject_active_'+id).attr('width','18');
			$('#reject_active_'+id).attr('height','18');
			$('#action_'+id).removeAttr('onClick');
			$('#action_'+id).removeAttr('href');
  	}
	
}
);
	}
}
</script>