<table border="1">
        <thead>
            <tr>
                <th width="3%"><b>No</b></th>
                <th width="16%"><b>Category</b></th>
                <th width="10%"><b>Name(username)</b></th> 
                <th width="9%"><b>From</b></th> 
                <th width="9%"><b>Upload Count</b></th>
               
            </tr>
        </thead>
        <tbody>
        <?php 
        $no=1;$total=0;
        if($uploader)foreach($uploader as $list){
            ?>        
            <tr>
                <td><?php echo $no;?></td>
                 <td><?php echo find('name',$list['category_id'],'category_tb');?></td>
                  <td><?php echo $list['fullname'].'('.$list['username'].')';?></td>
                   <td><?php echo ($list['upload_from']==0)?"Twitter":"Instagram";?></td>
                    <td>        <?php if($list['upload_from']==0){?>
                <?php echo 'Twitter'; ?>
                <?php }elseif($list['upload_from']==1){?>
                <?php echo 'Instagram';?>
				<?php }else{?>
                <?php echo 'Facebook';?>
                <?php } ?></td>
              
            </tr>
        <?php 
        $no++;        }
		?>
            
        </tbody>
    </table>