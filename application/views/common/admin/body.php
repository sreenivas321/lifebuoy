<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Lifebuoy | Content Management System</title>
<link href="<?php echo base_url();?>favicon.ico" rel="shortcut icon" type="image/x-icon" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>templates/css/globalcms.css" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>templates/css/validationEngine.jquery.css" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>templates/css/smoothness/jquery-ui-1.9.2.custom.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>templates/css/redactor.css">

<script languange="javascript">var base_url='<?php echo base_url();?>';</script>

<script type="text/javascript" src="<?php echo base_url();?>templates/js/jquery.min.1.8.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>templates/js/jquery-ui-1.9.2.custom.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>templates/js/jquery.infieldlabel.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>templates/js/jquery.highlight.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>templates/js/jquery.validationEngine.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>templates/js/jquery.validationEngine-en.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>templates/js/mainAdmin.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>templates/js/redactor.js"></script>
</head>
<body class="wide">
  
    <div id="container">
        <?php $this->load->view('common/admin/header');?>
        <div id="contentContainer">
            <?php 
            if($this->session->userdata('admin_logged_in')==FALSE)
                $this->load->view('common/admin/nav_login');
            else
                $this->load->view('common/admin/nav');
            ?>
            <?php $this->load->view($content);?>
        </div>
        <?php $this->load->view('common/admin/footer');?>
    </div>
</body>
</html>
