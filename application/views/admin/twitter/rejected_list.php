<div id="content">
    <h2>Twitter Posting &raquo; Rejected List</h2>
    <h2>Total <?php echo digits($total_item);?></h2>
		<?php if($pagination)echo $pagination;?>
    <table class="defAdminTable" width="100%">
        <thead>
        	<tr>
            	<th width="2%">No</th>
                <th width="24%">Name(username)</th>
                <th width="29%">Image</th>
                <th width="28%">Description</th>
                <th width="17%">Post Date</th>
            </tr>
        </thead>
        <tbody>
        <?php 
		$no=1;
		$no=$no+($this->per_page*($offset/($this->per_page)));
			if($twitter)foreach($twitter as $list){?>
            <tr>
                <td valign="top"><?php echo $no;?></td>
                <td valign="top"><?php echo $list['fullname'].'('.$list['username'].')';?></td>
				<td valign="top"><img src="<?php echo $list['image'];?>" width="200" /></td>
                <td valign="top"><?php echo wordwrap($list['description'],20);?></td>
                <td valign="top"><?php echo display_date2($list['created_date']);?></td>
            </tr>
    		<?php $no++; } else if(!$twitter){ ?> 
            <tr>
                <td colspan="5" align="center"><?php echo "No Rejected List"; ?></td>
        	</tr>
            <?php } ?>
        </tbody>
    </table>
    	
		<?php if($pagination)echo $pagination;?>
</div>