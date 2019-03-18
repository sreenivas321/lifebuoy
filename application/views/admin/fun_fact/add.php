<div id="content">
	<h2>Fun Facts &raquo; Add</h2>
	<form method="post" id="add_sub_fun_fact_form" enctype="multipart/form-data" action="<?php echo site_url('lifebuoy_adm/fun_fact/do_add').'/';?>">
    
    <dl>
        <dd>Name</dd>
        <dt><input class="txtField" type="text" name="name"/></dt>
    </dl>
    <dl>
        <dd>Description</dd>
        <dt><textarea class="txtField" name="description"></textarea></dt>
    </dl>
    <dl>
        <dd>Status</dd>
        <dt>    
          <p><label><input type="radio" class="radioBtn validate[required]" id="status" name="status" value="0" />Inactive</label></p>
          <p><label><input type="radio" class="radioBtn validate[required]" id="status" name="status" value="1" checked="checked"   />Active</label></p>
        </dt>
    </dl>
    <dl>
        <dd></dd>
       <dt><input type="submit" class="defBtn" value="Submit"/> <input type="button" class="defBtn" value="Back" onclick="window.location='<?php echo site_url('lifebuoy_adm/fun_fact/').'/';?>';" /></dt>
    </dl>
    </form>
</div>