<div id="content">
    <h2>Twitter Posting &raquo; Pending List</h2>
    <div id="submenu">
        <ul>  
            <li>  
            <?php if($prev!=1){?>
            <a class="defBtn" href="<?php echo site_url('lifebuoy_adm/twitter/index/prev/').'/'.$max_id.'/'.$since_id;?>"><span>PREV</span></a>
            <?php }?>
            <?php if($next!=1){?>
           <a class="defBtn" href="<?php echo site_url('lifebuoy_adm/twitter/index/next/').'/'.$max_id.'/'.$since_id;?>"><span>NEXT</span></a>
           <?php }?>
            </li>  	
        </ul>
    </div>
    <?php //echo 'next_link='.$next_link.'----prev='.$prev_link?>
    <?php 
		pre($twitter[0]);?>
    
    <form id="twit_pending_form" action="#" method="post" onsubmit="return false;"><br>
    <?php if($twitter){?>
    <input type="button" class="defBtn update_btn" value="Update"/> <input type="button" class="defBtn submit_btn" value="Update & Submit"/> 	<?php }?>
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
    </dl>
    <dl>
        <dd></dd>
        <dt><label><input type="checkbox" class="check_all"  />Select/Deselect All</label></dt>
    </dl>
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
        
        $no=1;//pre($twitter[0]);
        //$no=$no+($this->per_page*($offset/($this->per_page)));
            if($twitter)foreach($twitter as $list){
                
                $full_name=$list['user']['name'];
                $screen_name=$list['user']['screen_name'];
                $entities=$list['entities'];
                $image_url='';
                if(isset($entities['media'])){
                    $image_url=$entities['media'][0]['media_url'];
                }
                else{
                    if(isset($entities['urls'][0])){
                        $link=$entities['urls'][0]['expanded_url'];
            
                        $xxx=explode('/',$link);
                        if($xxx[2]=='twitpic.com')
                        $image_url='http://'.$xxx[2].'/show/full/'.$xxx[3];
                        else if($xxx[2]=='imgur.com')
                        $image_url='http://i.'.$xxx[2].'/'.$xxx[3].'.jpg';
                        else if($xxx[2]=='yfrog.com')
                        $image_url='http://'.$xxx[2].'/'.$xxx[3].':medium';
                        //else if($xxx[2]=='instagram.com')
                        //$image_url='http://'.$xxx[2].'/'.$xxx[3].'/'.$xxx[4].'/media/?size=l';
                        
                        
                        //http://instagram.com/p/j_8cqMCwsA/media/size=t
                    }
                }
                
                
                if(isset($list['text']))
                    $text=$list['text'];
                else 
                    $text="";
                ?>
            <tr>
                <td valign="top" width="2%"><?php echo $list['id'];?></td>
                <td valign="top" width="5%"> 
                <input type="checkbox" name="id[]" value="<?php echo $list['id'];?>" class="selection"><?php /*?><br><a href="<?php echo site_url('lifebuoy_adm/twitter/do_reject').'/'.$list['id'];?>" onClick="return confirm('Reject?');">Reject</a><?php */?>
                </td>
                <td valign="top" width="16%">
                <input type="hidden" name="ids[]" value="<?php echo $list['id'];?>">
                <select name="category_id<?php echo $list['id'];?>" >
                <option value="0">== Select Category ==</option>
                <?php if($category)foreach($category as $list2){?>
                <option value="<?php echo $list2['id'];?>" <?php if($list2['id']==$list['category_id'])echo "selected=\"selected\"";?>><?php echo $list2['name'];?></option>
                <?php }?>
                </select>
                </td>
                <td valign="top" width="16%"><?php echo $full_name.'('.$screen_name.')';?></td>
                <td valign="top" width="19%">
                <input type="text" name="image_link<?php echo $list['id'];?>" value="<?php echo $image_url;?>"  />
                <?php if($image_url!=''){?>
                <img src="<?php echo $image_url;?>" width="200" />
                <?php }?></td>
                <td valign="top" width="20%"><?php echo wordwrap($list['text'],20);?></td>
                <td valign="top" width="22%"><?php echo display_date_full($list['created_at']);?></td>
            </tr>
            <?php $no++; } else if(!$twitter){ ?> 
            <tr>
                <td colspan="7" align="center"><?php echo "No Pending List"; ?></td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
    <dl>
        <dd></dd>
        <dt><label><input type="checkbox" class="check_all" class="txtField" />Select/Deselect All</label></dt>
    </dl>
    <?php if($twitter){?><input type="button" class="defBtn update_btn" value="Update"/> <input type="button" class="defBtn submit_btn" value="Update & Submit"/> <?php }?>
    </form>
    <?php //if($pagination)echo $pagination;?>
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