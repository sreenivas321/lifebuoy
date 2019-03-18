<div id="content">
<h2>Filter By Type Upload</h2>
<select name="change_filter" onchange="change_filter(this.value);" id="change_filter" class="txtField" style="width:300px">
    <option value="a" label="-- Select Upload By --"<?php if('a'==$uploaded_by_filter)echo "selected=\"selected\"";?>>-- Select Upload By--</option>          
      <option value="0" label="Twitter" <?php if('0'==$uploaded_by_filter)echo "selected=\"selected\"";?>>Twitter</option>
      <option value="1" label="Instagram" <?php if(1==$uploaded_by_filter)echo "selected=\"selected\"";?> >Instagram</option>
      <option value="2" label="Facebook" <?php if(2==$uploaded_by_filter)echo "selected=\"selected\"";?>>Facebook</option>
</select>
    <h2>Uploader &raquo; List</h2>
    <h2>Total <?php echo digits($total_item);?></h2>
  
    <form id="twit_pending_form" action="<?php echo site_url('lifebuoy_adm/uploader/update_data');?>" method="post">
    
    <?php if($pagination)echo $pagination;?>
	<?php if($uploader){?><br /><input type="submit" class="defBtn" value="Update" id="submit_btn"/> <?php }?>
    <table class="defAdminTable" width="100%">
        <thead>
        	<tr>
            	<th width="2%">No</th>
                <th width="16%">Category</th>
                <th width="16%">Name(username)</th>
                <th width="20%">From</th>
                <th width="19%">Upload Count</th>
            </tr>
        </thead>
        <tbody>
        <?php $no=1; 
		$no=$no+($this->per_page*($offset/($this->per_page)));
			if($uploader)foreach($uploader as $list){?>
            <tr>
                <td valign="top" width="2%"><?php echo $no;?></td>
                <td valign="top" width="16%">
                <input type="hidden" name="id[]" value="<?php echo $list['id'];?>" />
                <select name="category_id<?php echo $list['id'];?>">
                <option value="0">== Select Category ==</option>
                <?php if($category)foreach($category as $list2){?>
                <option value="<?php echo $list2['id'];?>" <?php if($list2['id']==$list['category_id'])echo "selected=\"selected\"";?>><?php echo $list2['name'];?></option>
                <?php }?>
                </select>
                </td>
                <td valign="top" width="16%"><?php echo $list['fullname'].'('.$list['username'].')';?></td>
                <td valign="top">
                <?php if($list['upload_from']==0){?>
                <?php echo 'Twitter'; ?>
                <?php }elseif($list['upload_from']==1){?>
                <?php echo 'Instagram';?>
				<?php }else{?>
                <?php echo 'Facebook';?>
                <?php } ?>
                </td>
                <td valign="top" width="22%"><?php echo ($list['upload_count']);?></td>
            </tr>
    		<?php $no++; } else if(!$uploader){ ?> 
            <tr>
                <td colspan="5" align="center"><?php echo "No Uploader List"; ?></td>
        	</tr>
            <?php } ?>
        </tbody>
    </table>
    </form>
    <?php if($pagination)echo $pagination;?>
</div>

<script type="text/javascript">
function change_filter(view){
	offset=0;
	category_id='a';
		window.location='<?php echo site_url('lifebuoy_adm/uploader/page');?>/'+category_id+'/'+view+'/'+offset+'/';	
}
</script>