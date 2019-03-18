<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Untitled Document</title>
<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
<script src="<?php echo base_url()?>templates/js/jquery-1.11.1.min.js"></script>
</head>

<body>
<?php $this->load->view($content)?>



<?php
$notif=$this->session->flashdata('notif');
if($notif){?>
<span style="font-style:inherit;color:red;"><?php echo $notif?></span>
<?php }?>
</body>
</html>