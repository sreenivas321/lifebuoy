<div id="content">
	<h2>Category &raquo; Edit</h2>
	<form method="post" id="add_sub_category_form" enctype="multipart/form-data" action="<?php echo site_url('lifebuoy_adm/category/do_edit').'/'.$detail['id'];?>">
    <dl>
        <dd>Name</dd>
        <dt><input class="txtField" type="text" name="name" value="<?php echo $detail['name']?>"/></dt>
    </dl>
    <dl>
        <dd>Hashtag</dd>
        <dt><input class="txtField" type="text" name="hashtag" value="<?php echo $detail['hashtag']?>" placeholder="#SambutRamadhan"/></dt>
    </dl>
    <dl>
        <dd>Description</dd>
        <dt><textarea class="txtField" name="description"><?php echo $detail['description'];?></textarea></dt>
    </dl>
    <dl>
        <dd>Current Banner</dd>
        <dd>
            <?php 
                  if($detail['banner']){ ?>
                    <img src="<?php echo site_url('userdata/category/'.$detail['banner']); ?>" width="200"/>
                    
            <?php }else{?>
                    <span style="color:#F00;">No Image Available</span>
            <?php }?>
        </dd>
        <dd>Banner</dd>
        <dt><span class="descriptionTxt">Size: 1024 x 647</span></dt>
        <dt><input class="txtField" type="file" id="banner" name="banner"/></dt>
    </dl>
    <dl>
        <dd>Current Mobile Banner</dd>
        <dd>
            <?php 
                  if($detail['banner4']){ ?>
                    <img src="<?php echo site_url('userdata/category/'.$detail['banner4']); ?>" width="200"/>
                    
            <?php }else{?>
                    <span style="color:#F00;">No Image Available</span>
            <?php }?>
        </dd>
        <dd>Banner</dd>
        <dt><span class="descriptionTxt">Size: 768 x 848</span></dt>
        <dt><input class="txtField" type="file" id="banner4" name="banner4"/></dt>
    </dl>
    <dl>
        <dd>Current Side Banner</dd>
        <dd>
            <?php 
                  if($detail['banner2']){ ?>
                    <img src="<?php echo site_url('userdata/category/'.$detail['banner2']); ?>" width="200"/>
                    
            <?php }else{?>
                    <span style="color:#F00;">No Image Available</span>
            <?php }?>
        </dd>
        <dd>Side Banner</dd>
        <dt><span class="descriptionTxt">Size: 256 x 647</span></dt>
        <dt><input class="txtField" type="file" id="banner2" name="banner2"/></dt>
    </dl> 
    <dl>
        <dd> Current Upload Page Banner</dd>
        <dd>
            <?php 
                  if($detail['banner3']){ ?>
                    <img src="<?php echo site_url('userdata/category/'.$detail['banner3']); ?>" width="200"/>
                    
            <?php }else{?>
                    <span style="color:#F00;">No Image Available</span>
            <?php }?>
        </dd>
        <dd>Upload Page Banner </dd>
        <dt><span class="descriptionTxt">Size: 1107 x 942</span></dt>
        <dt><input class="txtField" type="file" id="banner3" name="banner3"/></dt>
    </dl> 
    <dl>
        <dd>Start Date</dd>
        <dt><input class="txtField date_picker" style="width:100px;margin-right:5px;" type="text" name="start_date" id="start_date" readonly="readonly" value="<?php echo $detail['start_date']?>"/><br />
        <a href="#" onclick="$('#start_date').val('');return false;">Clear Date</a></dt>
    </dl>
    <dl>
        <dd>End Date</dd>
        <dt><input class="txtField date_picker" style="width:100px;margin-right:5px;" type="text" name="end_date" id="end_date" readonly="readonly" value="<?php echo $detail['end_date']?>"/><br />
        <a href="#" onclick="$('#end_date').val('');return false;">Clear Date</a></dt>
	</dl><?php /*?>
    <dl>
        <dd>Category Type</dd>
        <dt>    
          <p><label><input type="radio" class="radioBtn validate[required]" id="category_type" name="category_type" <?php if($detail['category_type']==0)echo "checked=\"checked\"";?> value="0" />Photo</label></p>
          <p><label><input type="radio" class="radioBtn validate[required]" id="category_type" name="category_type" <?php if($detail['category_type']==1)echo "checked=\"checked\"";?> value="1" />User</label></p>
        </dt>
    </dl><?php */?>
    <dl>
        <dd>Status</dd>
        <dt>    
            <p><label><input type="radio" class="radioBtn validate[required]" id="status" name="status" value="0" <?php if($detail['active']==0)echo "checked=\"checked\"";?> />Inactive</label></p>
            <p><label><input type="radio" class="radioBtn validate[required]" id="status" name="status" value="1" <?php if($detail['active']==1)echo "checked=\"checked\"";?> />Active</label></p>
        </dt>
    </dl>
    <dl>
        <dd></dd>
       <dt><input type="submit" class="defBtn" value="Submit"/> <input type="button" class="defBtn" value="Back" onclick="window.location='<?php echo site_url('lifebuoy_adm/category/').'/';?>';" /></dt>
    </dl>
    </form>
</div>

<script>
$('.date_picker').datepicker({
		showOn: "button",
		buttonImage: base_url+"templates/images/calendar.gif",
		buttonImageOnly: true,
		buttonText: "Select Date",
		numberOfMonths: 1,
		showButtonPanel: true,
		yearRange: "-80:+80",
		changeYear: true,
		dateFormat: "yy-mm-dd",
		minDate: "-80y"
	});

</script>