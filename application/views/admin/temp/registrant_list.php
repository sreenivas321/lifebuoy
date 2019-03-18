<div id="content">
    <h2>Registrant &raquo; List</h2>
    <br>
    <h3>User Login With Facebook</h3>
    <?php 
        if($category)foreach($category as $row){ ?>
            <?php if($row['id'] < 5){ ?>
                <?php echo $row['name']." : "; ?>
                <?php echo ${"list_user_fb_".$row['id']}; ?>
                <?php echo "<br>"; ?>
            <?php } ?>
    <?php } ?>
    <br>
    <h3>User Login With Twitter</h3>
    <?php 
        if($category)foreach($category as $row){ ?>
            <?php if($row['id'] < 5){ ?>
                <?php echo $row['name']." : "; ?>
                <?php echo ${"list_user_tw_".$row['id']}; ?>
                <?php echo "<br>"; ?>
            <?php } ?>
    <?php } ?>
    <br>
    <h3>Uploader Login With Facebook</h3>
    <?php 
        if($category)foreach($category as $row){ ?>
            <?php if($row['id'] < 5){ ?>
                <?php echo $row['name']." : "; ?>
                <?php echo ${"list_uploader_fb_".$row['id']}; ?>
                <?php echo "<br>"; ?>
            <?php } ?>
    <?php } ?>
    <br>
    <h3>Uploader Login With Twitter</h3>
    <?php 
        if($category)foreach($category as $row){ ?>
            <?php if($row['id'] < 5){ ?>
                <?php echo $row['name']." : "; ?>
                <?php echo ${"list_uploader_tw_".$row['id']}; ?>
                <?php echo "<br>"; ?>
            <?php } ?>
    <?php } ?>
</div>