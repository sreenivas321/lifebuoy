<div id="content">
    <h2>Web Uploads &raquo; Rejected List</h2>
    <h2>Total <?php echo digits($total_item);?></h2>
		<?php if($pagination)echo $pagination;?>
    <table class="defAdminTable" width="100%">
        <thead>
        	<tr>
            	<th width="2%">No</th>
                <th width="24%">Post Via</th>
                <th width="24%">Name</th>
                <th width="29%">Image</th>
                <th width="17%">Description</th>
                <th width="17%">Post Date</th>
            </tr>
        </thead>
        <tbody>
        <?php 
		$no=1;
		$no=$no+($this->per_page*($offset/($this->per_page)));
			if($temp_upload)foreach($temp_upload as $list){?>
            <tr>
                <td valign="top"><?php echo $no;?></td>
                <td valign="top" width="16%"><?php if($list['type']==2)echo "Web Upload";else if($list['type']==3)echo "Facebook";?></td>
                <td valign="top"><?php echo $list['fullname'];?></td>
				<td valign="top"><img src="<?php echo $list['image'];?>" width="200" /></td>
				<td valign="top"><?php echo $list['description'];?></td>
                <td valign="top"><?php echo display_date2($list['created_date']);?></td>
            </tr>
    		<?php $no++; } else if(!$temp_upload){ ?> 
            <tr>
                <td colspan="6" align="center"><?php echo "No Rejected List"; ?></td>
        	</tr>
            <?php } ?>
        </tbody>
    </table>
    	
		<?php if($pagination)echo $pagination;?>
</div>