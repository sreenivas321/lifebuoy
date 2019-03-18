<div id="content">
	<h2>Category &raquo; Add</h2>
	<form method="post" id="add_sub_category_form" enctype="multipart/form-data" action="<?php echo site_url('lifebuoy_adm/category/do_add').'/';?>">
    
    <dl>
        <dd>Name</dd>
        <dt><input class="txtField" type="text" name="name"/></dt>
    </dl>
    <dl>
        <dd>Hashtag</dd>
        <dt><input class="txtField" type="text" name="hashtag" placeholder="#SambutRamadhan"/></dt>
    </dl>
    <dl>
        <dd>Description</dd>
        <dt><textarea class="txtField" name="description"></textarea></dt>
    </dl>
    <dl>
        <dd>Banner</dd>
        <dt><span class="descriptionTxt">Size: 1024 x 647</span></dt>
        <dt><input class="txtField" type="file" id="banner" name="banner"/></dt>
    </dl> 
    <dl>
        <dd>Mobile Banner</dd>
        <dt><span class="descriptionTxt">Size: 768 x 848</span></dt>
        <dt><input class="txtField" type="file" id="banner4" name="banner4"/></dt>
    </dl> 
    <dl>
        <dd>Side Banner</dd>
        <dt><span class="descriptionTxt">Size: 256 x 647</span></dt>
        <dt><input class="txtField" type="file" id="banner2" name="banner2"/></dt>
    </dl> 
    <dl>
        <dd>Upload Page Banner </dd>
        <dt><span class="descriptionTxt">Size: 1107 x 942</span></dt>
        <dt><input class="txtField" type="file" id="banner3" name="banner3"/></dt>
    </dl> 
    <dl>
        <dd>Start Date</dd>
        <dt><input class="txtField date_picker" style="width:100px;margin-right:5px;" type="text" name="start_date" id="start_date" readonly="readonly" /><br />
        <a href="#" onclick="$('#start_date').val('');return false;">Clear Date</a></dt>
    </dl>
    <dl>
        <dd>End Date</dd>
        <dt><input class="txtField date_picker" style="width:100px;margin-right:5px;" type="text" name="end_date" id="end_date" readonly="readonly" /><br />
        <a href="#" onclick="$('#end_date').val('');return false;">Clear Date</a></dt>
    </dl><?php /*?>
    <dl>
        <dd>Category Type</dd>
        <dt>    
          <p><label><input type="radio" class="radioBtn validate[required]" id="category_type" name="category_type" value="0"  checked="checked" />Photo</label></p>
          <p><label><input type="radio" class="radioBtn validate[required]" id="category_type" name="category_type" value="1" />User</label></p>
        </dt>
    </dl><?php */?>
    <dl>
        <dd>Status</dd>
        <dt>    
          <p><label><input type="radio" class="radioBtn validate[required]" id="status" name="status" value="0" />Inactive</label></p>
          <p><label><input type="radio" class="radioBtn validate[required]" id="status" name="status" value="1" checked="checked"   />Active</label></p>
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