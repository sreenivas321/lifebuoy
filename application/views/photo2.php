<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

</html><body>

<?php if($posting_list) foreach ($posting_list as $list){ ?><br />

<?php echo $list['fullname']?>
<br />
<img src="<?php echo $list['image'];?>" width="200"/>
<a href="javascript:void(0)" onclick="fb_likes(<?php echo $list['id'] ?>,'1')"> Like</a><br />
<a href="javascript:void(0)" onclick="fb_likes(<?php echo $list['id'] ?>,'0')"> Dislike</a><br />

<?php }?>

</body>
</html>