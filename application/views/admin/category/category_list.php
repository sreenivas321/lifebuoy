<div id="content">
    <h2>Category &raquo; List</h2>
    <div id="submenu">
        <ul>
            <li><a class="defBtn" href="<?php echo site_url('lifebuoy_adm/category/add').'/';?>"><span>Add</span></a></li>
        </ul>
    </div>
    <table class="defAdminTable" width="100%">
        <thead>
        	<tr>
            	<th width="2%">No</th>
                <th width="10%">Action</th>
                <th width="35%">Name</th>
                <th width="20%">Start Date</th>
                <th width="20%">End Date</th>
                <?php /*?><th width="25%">Precedence</th>
            <?php */?>
            </tr>
        </thead>
        <tbody>
        <?php $no=1; 
			  if($category)foreach($category as $list){?>
            <tr>
                <td valign="top"><?php echo $no;?></td>
                <td valign="top"> 
                <a href="<?php echo site_url('lifebuoy_adm/category/edit').'/'.$list['id'];?>">Edit</a>
        
                </td>
                <td valign="top"><?php echo $list['name'];?><br />
<?php echo $list['hashtag']?></td>
                    <td valign="top"><?php echo display_date2($list['start_date']);?></td>
                    <td valign="top"><?php echo display_date2($list['end_date']);?></td>
              <?php /*?><td valign="top"> 	<?php if ($list['precedence'] != last_precedence('category_tb')){?>
    				<a href="<?php echo site_url('lifebuoy_adm/category/down/'.$list['id']);?>">Up</a>
    			<?php }?>
                
                <?php if ($list['precedence'] != last_precedence('category_tb') && $list['precedence'] != first_precedence('category_tb')){?>
    				|
    			<?php }?>
                	<?php if ($list['precedence'] != first_precedence('category_tb')){?>
    				<a href="<?php echo site_url('lifebuoy_adm/category/up/'.$list['id']);?>">Down</a> 
				<?php }?>
                </td><?php */?>
               
    		
    		</tr>
    		<?php $no++; } else if(!$category){ ?> 
            <tr>
                <td colspan="6"><?php echo "No Category List"; ?></td>
        	</tr>
            <?php } ?>
        </tbody>
    </table>
</div>