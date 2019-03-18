<table class="defAdminTable" width="100%">
        <thead>
        	<tr>
            	<th width="2%">No</th>
            	<th width="20%">Post Via</th>
                <th width="29%">Category</th>
                <th width="20%">Name(username)</th>
                <th width="29%">Description</th>
                <th width="25%">Like</th>
                <th width="25%">Dislike</th>
                <th width="17%">Post Date</th>
                 <th width="17%">Status</th>
            </tr>
        </thead>
        <tbody>
        <?php $no=1; 
			if($posting)foreach($posting as $list){?>
            <tr>
                <td valign="top"><?php echo $no;?></td>
                <td valign="top"><?php echo ($list['post_via']==0)?"Twitter":"Instagram";?></td>
                <td valign="top"><?php echo find('name',$list['category_id'],'category_tb');?></td>
                <td valign="top"><?php echo $list['fullname'].'('.$list['username'].')';?></td>
                <td valign="top"><?php echo wordwrap($list['description'],20);?></td>
                <td valign="top"><?php echo $list['like_count'];?></td>
                <td valign="top"><?php echo $list['dislike_count'];?></td>
                <td valign="top"><?php echo display_date2($list['created_date']);?></td>
                <td valign="top">		<?php if($list['active']==1){ ?>
									 <?php echo 'Active'; ?> 
										<?php }else{ ?>
                                       <?php echo 'Inactive';?>
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