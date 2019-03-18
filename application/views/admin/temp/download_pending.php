<table class="defAdminTable" width="100%">
        <thead>
        	<tr>
            	<th width="2%">No</th>
              
                <th width="16%">Category</th>
                <th width="16%">Name(username)</th>
                <th width="20%">Description</th>
                <th width="10%">Type</th>
                <th width="22%">Post Date</th>
            </tr>
        </thead>
        <tbody>
        <?php
		
		$no=1;
			if($temp_upload)foreach($temp_upload as $list){?>
            <tr>
                <td valign="top" width="2%"><?php echo $no;?></td>
              
                <td valign="top" width="16%">
 			<?php echo find('name',$list['category_id'],'category_tb');?>
                </td>
                <td valign="top" width="16%"><?php echo $list['fullname'];?></td>
                <td valign="top" width="20%"><?php echo wordwrap($list['description'],20);?></td>
                <td valign="top" width="10%"><?php if($list['type']==2)echo 'Manual Upload';else echo 'Facebook Album';?>                </td>
                <td valign="top" width="22%"><?php echo display_date2($list['created_date']);?></td>
            </tr>
    		<?php $no++; } else if(!$temp_upload){ ?> 
            <tr>
                <td colspan="7" align="center"><?php echo "No Pending List"; ?></td>
        	</tr>
            <?php } ?>
        </tbody>
    </table>