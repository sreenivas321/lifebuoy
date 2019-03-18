<div id="content">
    <h2>Twitter &raquo; Pending List</h2>
    <h2>Total <?php echo digits($total_item);?></h2>
    <div id="submenu">
        <ul>  
            <li>  
           	<a class="defBtn" href="<?php echo site_url('lifebuoy_adm/twitter/save_db/').'/'.($hashtag);?>"><span>Get Latest</span></a>
            </li>  	
        </ul>
    </div>
     <form action="<?php echo site_url('lifebuoy_adm/twitter/search_pending');?>" method="post">

<input type="hidden" name="hashtag" value="<?php echo $hashtag?>" />
	<h3>Filter</h3>
    <dl>
            <dd>Keyword</dd>
            <dt><input type="text" name="search" placeholder="Search Keyword" class="txtField" value="<?php echo ($this->uri->segment(5)!='all')?urldecode($this->uri->segment(5)):"";?>" /></dt>
        </dl>
        <dl>
            <dd></dd>
            <dt><input type="submit" class="defBtn search_btn" value="Filter by keyword" /></dt>
        </dl>
    </form>	
    <br />
    <?php if($twitter){?>
		<?php if($pagination)echo $pagination;?>
	<?php }?>
    
	<form id="twit_pending_form" action="#" method="post" onsubmit="return false;"><br>
	
<input type="hidden" name="hashtag" value="<?php echo $hashtag?>" />
	<h3>Pending List</h3>
   	<dl>
    	<dd></dd>
        <dt>       
    	<div style="font-style:italic;">Select Checkbox to do batch approval</div>
        </dt>
    </dl>	
    
    <dl>
    	<dd>Action</dd>
        <dt>
        <select id="action_type" class="txtField">
        <option value="2">== Select Action ==</option>
        <option value="1">Approve</option>
        <option value="0">Reject</option>
        </select>
        </dt>
    </dl><?php if($twitter){?>
    <dl>
    	<dd></dd>
        <dt>       
        <input type="button" class="defBtn submit_btn" value="Submit"/> </dt>
    </dl>
    <?php }?>
    <dl>
    	<dd></dd>
        <dt><label><input type="checkbox" class="check_all"> Select/Deselect All</label></dt>
    </dl>
    <div style="overflow:scroll;">
    <table class="defAdminTable" width="100%">
        <thead>
        	<tr>
            	<th width="2%">No</th>
                <th width="5%">Action</th>
                <th width="16%">Category</th>
                <th width="16%">Name(username)</th>
                <th width="19%">Image</th>
                <th width="20%">Description</th>
                <th width="22%">Post Date</th>
            </tr>
        </thead>
        <tbody>
        <?php
		
		$no=1;
		$no=$no+($this->per_page*($offset/($this->per_page)));
			if($twitter)foreach($twitter as $list){?>
            <tr>
                <td valign="top" width="2%"><?php echo $no;?></td>
                <td valign="top" width="5%"> 
                <input type="checkbox" name="id[]" value="<?php echo $list['id'];?>" class="selection"><?php /*?><br><a href="<?php echo site_url('lifebuoy_adm/twitter/do_reject').'/'.$list['id'];?>" onClick="return confirm('Reject?');">Reject</a><?php */?>
                </td>
                <td valign="top" width="16%">
                <input type="hidden" name="ids[]" value="<?php echo $list['id'];?>">
                <input type="hidden" name="category_id<?php echo $list['id'];?>" value="<?php echo $list['category_id'];?>">
                <?php if($category)foreach($category as $list2){
					if($list2['id']==$list['category_id'])echo $list2['name'];
				}?>
                </td>
                <td valign="top" width="16%"><?php echo $list['fullname'].'('.$list['username'].')';?></td>
				<td valign="top" width="19%">
                <input type="text" name="image_link<?php echo $list['id'];?>" value="<?php echo $list['image'];?>"  />
                <img src="<?php echo $list['image'];?>" width="200" /></td>
                <td valign="top" width="20%"><?php echo wordwrap($list['description'],20);?></td>
                <td valign="top" width="22%"><?php echo display_date_full($list['created_date']);?></td>
            </tr>
    		<?php $no++; } else if(!$twitter){ ?> 
            <tr>
                <td colspan="8" align="center"><?php echo "No Pending List"; ?></td>
        	</tr>
            <?php } ?>
        </tbody>
    </table></div>
    <dl>
    	<dd></dd>
        <dt><label><input type="checkbox" class="check_all" class="txtField" /> Select/Deselect All</label></dt>
    </dl><?php if($twitter){?>
    <dl>
    	<dd></dd>
        <dt>       
        <input type="button" class="defBtn submit_btn" value="Submit"/> </dt>
    </dl>
    <?php }?>
    </form>
	<?php if($pagination)echo $pagination;?>
</div>

    <script>
	$(document).ready(function(){
		$(".submit_btn").click(function(){
			action_type=$("#action_type").val();
			if(action_type!=2){
				if(action_type==1){
					if(confirm("Approve?")){
						$("#twit_pending_form").attr('action','<?php echo site_url('lifebuoy_adm/twitter/batch_approve');?>');
						$("#twit_pending_form").removeAttr('onsubmit');
						$("#twit_pending_form").submit();
	
					}
				}
				else{
					if(confirm("Reject?")){
						$("#twit_pending_form").attr('action','<?php echo site_url('lifebuoy_adm/twitter/batch_reject');?>');
						$("#twit_pending_form").removeAttr('onsubmit');
						$("#twit_pending_form").submit();
					}
				}
			}else alert('Please select action, approve or reject');
		});	
		$(".update_btn").click(function(){
			if(confirm("Update Data?")){
				$("#twit_pending_form").attr('action','<?php echo site_url('lifebuoy_adm/twitter/batch_update');?>');
				$("#twit_pending_form").removeAttr('onsubmit');
				$("#twit_pending_form").submit();
			}
		});	
		$(".check_all").click(function(){
			if($(this).attr('checked')){
				$('.selection').attr('checked','checked');
			}
			else{
				$('.selection').removeAttr('checked');
			}
		});
	});
	</script>