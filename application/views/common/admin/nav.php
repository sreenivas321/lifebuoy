<div id="nav">
    <h2>Admin Menu</h2>
    <ul>       
        <li><a href="<?php echo site_url('lifebuoy_adm/category');?>">Category</a></li>
        <li><a href="<?php echo site_url('lifebuoy_adm/fun_fact');?>">Fun Facts</a></li>
        <li><a href="<?php echo site_url('lifebuoy_adm/posting');?>">Approved</a>
        	<ul>
        		<li><a href="<?php echo site_url('lifebuoy_adm/posting');?>">Active List</a></li>
        		<li><a href="<?php echo site_url('lifebuoy_adm/posting/inactive');?>">Inactive List</a></li>
            </ul>
        </li>
        <?php /*?><li><a href="#" onclick="return false;">Uploader</a>
        	<ul>
        		<li><a href="<?php echo site_url('lifebuoy_adm/uploader');?>">Approved</a></li>
        		<li><a href="<?php echo site_url('lifebuoy_adm/uploader/rejected');?>">Rejected</a></li>
        		<li><a href="<?php echo site_url('lifebuoy_adm/uploader/rejected2');?>">Trash/spam</a></li>
            </ul>
        </li><?php */?>
        <li><a href="#">Instagram</a>
            <ul>
            <?php if($category)foreach($category as $row){
				
		if($row['hashtag']!=""){
		$hashtag=str_replace("#","",$row['hashtag']);
				?>
                <li><a href="<?php echo site_url('lifebuoy_adm/instagram/index/'.$hashtag);?>"><?php echo $hashtag?></a></li>
            <?php }}?>
                <li><a href="<?php echo site_url('lifebuoy_adm/instagram/rejected/');?>">Rejected</a></li>
            </ul>
        </li>
        <li><a href="#" onclick="return false;">Twitter</a>
        	<ul>
            <?php if($category)foreach($category as $row){
				
		if($row['hashtag']!=""){
		$hashtag=str_replace("#","",$row['hashtag']);
				?>
                <li><a href="<?php echo site_url('lifebuoy_adm/twitter/index/'.$hashtag);?>"><?php echo $hashtag?></a></li>
            <?php }}?>
            
                <li><a href="<?php echo site_url('lifebuoy_adm/twitter/rejected/');?>">Rejected</a></li>
            </ul>
        </li>
        <li><a href="#" onclick="return false;">Web Uploads</a>
        	<ul>
                <?php if($category)foreach($category as $row){
				
		if($row['hashtag']!="" && $row['id']!=9999){
		$hashtag=str_replace("#","",$row['hashtag']);
				?>
                <li><a href="<?php echo site_url('lifebuoy_adm/temp_upload/index/'.$hashtag);?>"><?php echo $hashtag?></a></li>
            <?php }}?>
				<li><a href="<?php echo site_url('lifebuoy_adm/temp_upload/rejected');?>">Rejected</a></li>
                <li><a href="<?php echo site_url('lifebuoy_adm/temp_upload/registrant');?>">Registrant</a></li>
            </ul>
        </li>
        <?php /*?><li><a href="#" onclick="return false;">Report</a>
        	<ul>
                <li><a href="<?php echo site_url('lifebuoy_adm/posting/csv');?>">Approved List</a></li>
                <li><a href="<?php echo site_url('lifebuoy_adm/twitter/pending_csv');?>">Pending Twitter List</a></li>
				<li><a href="<?php echo site_url('lifebuoy_adm/twitter/rejected_csv');?>">Rejected Twitter List</a></li>
				<li><a href="<?php echo site_url('lifebuoy_adm/uploader/csv');?>">Uploader List</a></li>
                <li><a href="<?php echo site_url('lifebuoy_adm/temp_upload/pending_csv');?>">Pending (Facebook)List</a></li>
                <li><a href="<?php echo site_url('lifebuoy_adm/temp_upload/rejected_csv');?>">Rejected(Facebook)List</a></li>
            </ul>
        </li><?php */?>
        <li><a href="<?php echo site_url('lifebuoy_adm/logout');?>">Logout</a></li>
    </ul>
</div>