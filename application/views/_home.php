<a href="<?php echo site_url('gallery')?>">Gallery</a>
<script>
window.fbAsyncInit = function() {
	FB.init({
	  appId      : <?php echo APP_ID?>,
	  xfbml      : true,
	  version    : 'v2.2'
	});
};

(function(d, s, id){
	var js, fjs = d.getElementsByTagName(s)[0];
	if (d.getElementById(id)) {return;}
	js = d.createElement(s); js.id = id;
	js.src = "//connect.facebook.net/en_US/sdk.js";
	fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));
   
function statusChangeCallback(response) {
	console.log('statusChangeCallback');
	console.log(response);
	// The response object is returned with a status field that lets the
	// app know the current login status of the person.
	// Full docs on the response object can be found in the documentation
	// for FB.getLoginStatus().
	if (response.status === 'connected') {
		// Logged into your app and Facebook.
		testAPI();
	} else if (response.status === 'not_authorized') {
		testAPI();
		// The person is logged into Facebook, but not your app.
		console.log(  'Please log ' +
		'into this app.');
	} else {
		testAPI();
		// The person is not logged into Facebook, so we're not sure if
		// they are logged into this app or not.
		console.log(  'Please log ' +
		'into Facebook.');
	}
}

function checkLoginState() {
	FB.getLoginStatus(function(response) {
	  statusChangeCallback(response);
	});
}

function testAPI() {
	console.log('Welcome!  Fetching your information.... ');
	
	
	FB.login(function(response) {
		if (response.authResponse) {
			var token=response.authResponse.accessToken;
			FB.api('/me', function(response) {
		
				$.ajax({
					type: "POST",
					url: '<?php echo base_url().'login/fb/';?>',
					data: {
						name : response.name,
						email:response.email,
						facebook_id:response.id,
						data_facebook:response,
						token:token
					},
					dataType:"JSON",
					success: function(data){
						if(data.flow==0)
						window.location='<?php echo site_url('home')?>';
						else
						window.location='<?php echo site_url('home/new_register')?>';
					}
				});//ajax
			
			});//fb.api
			 
				
		}
		//if
	},{scope: 'public_profile,email'});
}
</script>

<!--
  Below we include the Login Button social plugin. This button uses
  the JavaScript SDK to present a graphical Login button that triggers
  the FB.login() function when clicked.
-->

<?php 
if($this->session->userdata('user_logged_in')==0){
?>
<a href="#" class="fb-button fa fa-facebook-square"></a> 
<a href="#" class="tw-button fa fa-twitter-square"></a>
<?php 
}else {?> 
<a href="<?php echo site_url('logout')?>">Logout woi</a>
"Sudah login <?php echo $this->session->userdata('session_login')?> nih yee, <?php echo $this->session->userdata('name')?>";
<?php }?>

<div id="status">
</div>

<form action="<?php echo site_url('photo/do_upload')?>" method="post" enctype="multipart/form-data">
<input type="file" name="image" />
<input type="submit" />
</form>
<?php 
if($this->session->userdata('user_logged_in')==0){
?>
<script>

$(document).ready(function() {
    $('.fb-button').click(function(e){
   	 	e.preventDefault();
		checkLoginState();
	});
	
	$(".tw-button").click(function(e){
   	 	e.preventDefault();
		twitter_login();
	});
});
function twitter_login(){
	var url_to_open='<?php echo site_url('twit_login')?>';
	var width = 900; 	
	var height = 550;
	var left = parseInt((screen.availWidth/2) - (width/2));
	var top = parseInt((screen.availHeight/2) - (height/2));
	twit_window=window.open(url_to_open, "Twitter Login", 'height=350,width=700,left=' + left + ',top=' + top + ',screenX=' + left + ',screenY=' + top);		
}
function success_twitter(){
	twit_window.close();
}
</script>
<?php }?>