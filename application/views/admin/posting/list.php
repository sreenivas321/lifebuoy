<script>
function do_filter(){
window.location='<?php echo site_url('lifebuoy_adm/posting/index');?>/'+$("#category_id").val()+'/'+$("#sorting").val();
}
</script>
<div id="content">
    <h2>Approved &raquo; Active List</h2>
    <h2>Total <?php echo digits($total_item);?></h2>
     <form action="<?php echo site_url('lifebuoy_adm/posting/index');?>" method="get">

	<h3>Filter</h3>
    <dl>
            <dd>Keyword</dd>
            <dt><input type="text" name="keyword" placeholder="Search Keyword" class="txtField" value="<?php echo ($this->input->get('keyword')!='all')?urldecode($this->input->get('keyword')):"";?>" /></dt>
        </dl>
    <dl>
            <dd>Category</dd>
            <dt>
    <select name="category_id">
    <option value="a">All Category</option>
    <?php if($category)foreach($category as $list2){
		if( $list2['id']!=9999 and $list2['hashtag']!=''){
		?>
    <option value="<?php echo $list2['id'];?>" <?php if($category_id==$list2['id'])echo "selected=\"selected\"";?>><?php echo $list2['name'];?></option>
    <?php }}?>
    </select></dt>
        </dl>
        <input type="hidden" name="sorting" value="0" />
    <!--dl>
            <dd>Sorting</dd>
            <dt>
    <select name="sorting">
    <option value="0">Default</option>
    <option value="1" <?php if($sorting==1)echo "selected=\"selected\"";?>>Most Like</option>
    <option value="2" <?php if($sorting==2)echo "selected=\"selected\"";?>>Most Dislike</option>
    </select></dt>
        </dl-->
        <dl>
            <dd></dd>
            <dt><input type="submit" class="defBtn search_btn" value="Filter" /> &nbsp; <a href="<?php echo site_url('lifebuoy_adm/posting/download_approved/'.$category_id) ?>"><button type="button">Export</button></a></dt>
        </dl>
    </form>	
    	<?php if($pagination)echo $pagination;?>
    
	<form id="twit_pending_form" action="<?php echo site_url('lifebuoy_adm/posting/update_data');?>" method="post">
    
	<?php /*if($posting){?><input type="submit" class="defBtn" value="Update" id="submit_btn"/> <?php }*/?>
    <table class="defAdminTable" width="100%">
        <thead>
        	<tr>
            	<th width="2%">No</th>
            	<th width="20%">Action</th>
            	<th width="20%">Post Via</th>
                <th width="29%">Category</th>
                <th width="20%">Name(username)</th>
                <th width="25%">Image</th>
                <th width="29%">Description</th>
                <th width="17%">Post Date</th>
                 <th width="17%">Status</th>
            </tr>
        </thead>
        <tbody>
        <?php $no=1; 
		$no=$no+($this->per_page*($this->input->get('page')/($this->per_page)));
			if($posting)foreach($posting as $list){?>
            <tr>
                <td valign="top"><?php echo $no;?></td>
                <td valign="top">
                <?php if($list['winner']==0){?>
                <a href="<?php echo site_url('lifebuoy_adm/posting/set_as_winner').'/'.$list['id']?>" onclick="return confirm('Set as winner?');">Set as Winner</a>
                <?php }else{ echo "Winner"?><br>
                <a href="<?php echo site_url('lifebuoy_adm/posting/set_as_winner').'/'.$list['id']?>" onclick="return confirm('Cancel winner?');">Cancel Winner</a>
                <?php }?>
            </td>
                <td valign="top"><?php  if($list['post_via']==0)echo 'Twitter';else if($list['post_via']==1)echo "Instagram"; else if($list['post_via']==2)echo "Web Upload";//else echo "Facebook";?>
                </td>
                <td valign="top">
				<?php //echo $list['category_name'];?>
                
                
                <?php if($category)foreach($category as $list2){
					if($list2['id']==$list['category_id'])echo $list2['name'];
				}?>
                </td>
                <td valign="top">
				
				
				
				
				
				<?php echo $list['fullname'].'('.$list['username'].')';?>
                <br />
                <?php echo get_profile_link($list['username'],$list['post_via'],$list['uploader_id']);?>
                
                </td>
                
                
                
                
                
				<td valign="top"><img src="<?php echo $list['image'];?>" width="200" /></td>
                <td valign="top"><?php echo wordwrap($list['description'],20);?></td>
                <td valign="top"><?php echo display_date_full($list['post_date']);?></td>
                <td valign="top">		<?php if($list['active']==1){ ?>
									 <a href="javascript:void(0);" onclick="change_status(<?php echo $list['id'] ?>)">   <img id="image_active_<?php echo $list['id'];?>" title="Approved" src="<?php echo base_url()?>templates/images/active.png" width="18" height="18"/>	
										 </a> 
										<?php }else{ ?>
                                        
                                        <a href="javascript:void(0)" title="Inactive" onclick="change_status(<?php echo $list['id'] ?>)"><img id="image_active_<?php echo $list['id'];?>" src="<?php echo base_url()?>templates/images/inactive.png" /></a>
										 <?php } ?>
           </td>
            </tr>
    		<?php $no++; } else if(!$posting){ ?> 
            <tr>
                <td colspan="9" align="center"><?php echo "No Approved List"; ?></td>
        	</tr>
            <?php } ?>
        </tbody>
    </table>
    </form>
    <?php if($pagination)echo $pagination;?>
</div>

<script>
function change_status(id){
	
	
		$.ajax({
					url:'<?php echo site_url('lifebuoy_adm/posting/active')?>/'+id,
					success: function(data){
						
						if(data==1){
						$('#image_active_'+id).attr('src','<?php echo base_url()?>templates/images/active.png');
						$('#image_active_'+id).attr('width','18');
						$('#image_active_'+id).attr('height','18');
							}else{
						$('#image_active_'+id).attr('src','<?php echo base_url()?>templates/images/inactive.png');
						$('#image_active_'+id).attr('width','18');
						$('#image_active_'+id).attr('height','18');	
	
							
					}
				
					}
		});
}
</script>