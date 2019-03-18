<div id="content">

    <h2>Approved &raquo; List</h2>	
		<?php if($pagination)echo $pagination;?>
    <table class="defAdminTable" width="100%">
        <thead>
        	<tr>
            	<th width="2%">No</th>
            	<th width="20%">Post Via</th>
                <th width="20%">Name(username)</th>
                <th width="29%">Category</th>
                <th width="29%">Description</th>
                <th width="25%">Image</th>
                <th width="25%">Like</th>
                <th width="25%">Dislike</th>
                <th width="17%">Post Date</th>
            </tr>
        </thead>
        <tbody>
        <?php $no=1; 
		$no=$no+($this->per_page*($offset/($this->per_page)));
			if($listing)foreach($listing as $list){?>
            <tr>
                <td valign="top"><?php echo $no;?></td>
                <td valign="top"><?php echo ($list['post_via']==0)?"Twitter":"Instagram";?></td>
                <td valign="top"><?php echo $list['fullname'].'('.$list['username'].')';?></td>
                <td valign="top"><?php echo $list['category_name'];?></td>
                <td valign="top"><?php echo wordwrap($list['description'],20);?></td>
				<td valign="top"><img src="<?php echo $list['image'];?>" width="200" /></td>
                <td valign="top"><?php echo $list['like_count'];?>
                <a href="#">Like This</a>
                </td>
                <td valign="top"><?php echo $list['dislike_count'];?>
                <a href="#">Dislike This</a></td>
                <td valign="top"><?php echo display_date2($list['created_date']);?></td>
            </tr>
    		<?php $no++; } else if(!$posting){ ?> 
            <tr>
                <td colspan="9" align="center"><?php echo "No Approved List"; ?></td>
        	</tr>
            <?php } ?>
        </tbody>
    </table>	
		<?php if($pagination)echo $pagination;?>
</div>