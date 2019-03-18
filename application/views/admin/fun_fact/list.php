<div id="content">
    <h2>Fun Facts &raquo; List</h2>
    <div id="submenu">
        <ul>
            <li><a class="defBtn" href="<?php echo site_url('lifebuoy_adm/fun_fact/add').'/';?>"><span>Add</span></a></li>
        </ul>
    </div>
    <table class="defAdminTable" width="100%">
        <thead>
        	<tr>
            	<th width="2%">No</th>
                <th width="10%">Action</th>
                <th width="35%">Name</th>
                <th width="20%">Description</th>
                <th width="25%">Status</th>
                <?php /*?><th width="25%">Precedence</th>
            <?php */?>
            </tr>
        </thead>
        <tbody>
        <?php $no=1; 
			  if($fun_fact)foreach($fun_fact as $list){?>
            <tr>
                <td valign="top"><?php echo $no;?></td>
                <td valign="top"> 
                <a href="<?php echo site_url('lifebuoy_adm/fun_fact/edit').'/'.$list['id'];?>">Edit</a>
         <?php if($no>1){?>| <a href="<?php echo site_url('lifebuoy_adm/fun_fact/delete').'/'.$list['id'];?>" onclick="return confirm('Confirm Delete?');">Delete</a><?php }?>
                </td>
                <td valign="top"><?php echo $list['name'];?></td>
                    <td valign="top"><?php echo nl2br($list['description']);?></td>
                    <td>
                      
                      <?php if($list['active']==1)echo 'Active'; else echo'Inactive';?>
                      <?php if($list['id']>4){?>
                      <a href="<?php echo site_url('lifebuoy_adm/fun_fact/active/'.$list['id'].'/'.$list['active'])?>">Change</a>
                      <?php }?>
              </td>
            <?php /*?><td valign="top"> 	<?php if ($list['precedence'] != last_precedence('fun_fact_tb')){?>
    				<a href="<?php echo site_url('lifebuoy_adm/fun_fact/down/'.$list['id']);?>">Up</a>
    			<?php }?>
                
                <?php if ($list['precedence'] != last_precedence('fun_fact_tb') && $list['precedence'] != first_precedence('fun_fact_tb')){?>
    				|
    			<?php }?>
                	<?php if ($list['precedence'] != first_precedence('fun_fact_tb')){?>
    				<a href="<?php echo site_url('lifebuoy_adm/fun_fact/up/'.$list['id']);?>">Down</a> 
				<?php }?>
                </td><?php */?>
               
    		
    		</tr>
    		<?php $no++; } else if(!$fun_fact){ ?> 
            <tr>
                <td colspan="5"><?php echo "No Fun Fact List"; ?></td>
        	</tr>
            <?php } ?>
        </tbody>
    </table>
</div>