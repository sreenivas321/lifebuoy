<!DOCTYPE html>
<html prefix="og: http://ogp.me/ns#">
<head>
<meta charset="UTF-8" />
<title>Nyaman Berhijab | Lifebuoy</title>
<link href="<?php echo base_url();?>favicon.ico" rel="shortcut icon" type="image/x-icon" />
<meta name="viewport" content="target-densitydpi=device-dpi; width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;"/>
<meta name="HandheldFriendly" content="true" />
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,800' rel='stylesheet' type='text/css'>
<link href="<?php echo base_url()?>templates/css/fontAttach/style.css?<?php echo time()?>" rel="stylesheet" type="text/css">
<link href="<?php echo base_url()?>templates/css/lifebuoy.css?<?php echo time()?>" rel="stylesheet" type="text/css">
<link href="<?php echo base_url()?>templates/css/selectordie.css" rel="stylesheet" type="text/css">
<?php /*?><script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
<?php */?>
<script src="<?php echo base_url()?>templates/js/jquery-1.11.1.min.js"></script>
<script src="<?php echo base_url()?>templates/js/jquery.knob.min.js"></script>
<script src="<?php echo base_url()?>templates/js/selectordie.min.js"></script>
<script src="<?php echo base_url()?>templates/js/main.js"></script>
<meta name="twitter:card" content="summary" />
<meta name="twitter:site" content="@lifebuoyid" />
<meta property="og:url" content="<?php echo base_url()?>" />
<meta property="og:title" content="Nyaman Berhijab" />
<meta property="og:description" content="Ayo, upload foto Moms bersama Si Kecil & menangkan voucher belanja di nyamanberhijab.lifebuoy.co.id #NyamanBerhijab" />
<meta property="og:image" content="<?php echo base_url().'/templates/images/image-share.jpg';?>" />
</head>

<body>
<!-- Google Tag Manager -->
<noscript><iframe src="//www.googletagmanager.com/ns.html?id=GTM-5KKTN7"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'//www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-5KKTN7');</script>
<!-- End Google Tag Manager -->
	<div class="wrapper">
    	<header>
        	<div class="headerBox">
            	<h1><a href="<?php echo base_url()?>" id="logo">Lifebuoy</a></h1>
                <div class="headerRight">
                	<div class="overlay"></div>
                    <div class="headerRightBox">
                        <div class="closeMenuBtn"></div>
                        <nav>
                            <ul>
                                <li <?php if($curr_page=='home'){?>class="selected"<?php }?>><a href="<?php echo base_url()?>">Home</a></li>
                                <li <?php if($curr_page=='how_to_join'){?>class="selected"<?php }?>><a href="#howtojoin" id="how_to_play_btn">Cara Ikutan</a></li>
                                <li <?php if($curr_page=='gallery'){?>class="selected"<?php }?>><a href="#gallery" id="gallery_btn">Galeri Foto</a></li>
                                <?php if(strtotime(date("Y-m-d"))>strtotime("2015-07-31")){
								}else{?>
                                <?php if($this->session->userdata('user_logged_in')){?>
                                <li <?php if($curr_page=='upload'){?>class="selected"<?php }?>><a href="<?php echo site_url('upload')?>" class="GTM-Upload-Foto">Upload Foto</a></li>
                                <?php }else{?>
                                <li <?php if($curr_page=='upload'){?>class="selected"<?php }?>><a href="#" onclick="show_login();return false;" class="GTM-Join">Upload Foto</a></li>
                                <?php }?>
                                <?php }?>
                            </ul>
                        </nav>
                        <div class="findUsBox">
                            <span>Share To</span>
                            <a href="#" class="fbBtn sharefb2 GTM-Share-FB">Facebook</a>
                            <a href="#" class="twBtn sharetw2 GTM-Share-TW">Twitter</a>
                        </div>
                    </div>
                </div>
                <div class="menuBtn"></div>
            </div>
        </header>
        <?php $this->load->view($content)?>
        <footer>
        	<div class="footerBox">
            	&copy; 2015 Lifebuoy. All rights reserved. | <a href="#" id="tnc_btn">Syarat dan Ketentuan</a> | <a href="http://www.unileverprivacypolicy.com/en_gb/policy.aspx" target="_blank">Privacy Policy</a> | <a href="http://www.unilevercookiepolicy.com/en_GB/accept-policy.aspx%E2%80%8B" target="_blank">Cookie Policy</a>
            </div>
        </footer>
    </div>
    <div class="popupWrapper" style="display:none;">
    	<div class="overlay" onClick="hide_popup()"></div>
        <div id="popup-tnc" class="popupBox" style="display:none;">
        	<div class="boxTop">
            	<h3>Syarat dan Ketentuan</h3>
            </div>
            <div class="boxBottom">
                <div class="tncBox">
					<h4>Nyaman Berhijab Terlindungi</h4><br>

                    <strong>Nyaman Berhijab Terlindungi</strong> adalah sebuah kompetisi foto online berhadiah persembahan 
                    
                    Lifebuoy® Indonesia, yang berlangsung dari tanggal 6 Juni – 31 Juli 2015, melalui situs 
                    
                    <a href="http://nyamanberhijab.lifebuoy.co.id" target="_blank">http://nyamanberhijab.lifebuoy.co.id</a> Syarat dan Ketentuan ini berisi tentang segala hal 
                    
                    terperinci yang terkait dengan program Nyaman Berhijab Terlindungi. Dilarang mengikuti 
                    
                    kompetisi ini apabila Anda tidak menyetujui Syarat dan Ketentuan berikut. Bila Anda mengakses 
                    
                    atau mendaftarkan diri Anda sesuai mekanisme yang tercantum di bawah ini, berarti Anda 
                    
                    setuju untuk terikat oleh Syarat dan Ketentuan sebagai berikut: <br><br>
                    
                    <ol>
                        <li>
                            Syarat Peserta
                            <ol>
                                <li>Keluarga Warga Negara Indonesia.</li>
                                <li>Terbuka untuk umum, kecuali bagi karyawan PT. Unilever Indonesia Tbk., agen, production house, dan seluruh pihak yang terkait dalam penyelenggaraan kompetisi ini</li>
                                <li>Memiliki hubungan keluarga orang tua dan anak yang dapat dibuktikan dengan kartu keluarga.</li>
                                <li>Peserta (Ibu dan anak) wajib menggunakan hijab.</li>
                                <li>Peserta wajib mengikuti seluruh rangkaian kompetisi foto di situs <a href="http://nyamanberhijab.lifebuoy.co.id" target="_blank">http://nyamanberhijab.lifebuoy.co.id</a></li>
                                <li>Peserta wajib mem-follow halaman fans Facebook <a href="https://www.facebook.com/LifebuoyIndonesia" target="_blank">Lifebuoy&reg;</a> dan Twitter <a href="https://twitter.com/lifebuoyid" target="_blank">@lifebuoyid.</a></li>
                                <li>Peserta yang melakukan segala bentuk kecurangan dan pemalsuan data akan didiskualifikasi atau dianulir dari kompetisi foto <strong>Nyaman Berhijab Terlindungi.</strong></li>
                                <li>Peserta hanya mendapatkan 1 (satu) kali kesempatan untuk meng-upload foto di kompetisi <strong>Nyaman Berhijab Terlindungi.</strong></li>
                            </ol>
                        </li>
                        <li>
                            Mekanisme Kompetisi
                            <ol>
                                <li>Ikuti tantangan foto <strong>Nyaman Berhijab Terlindungi</strong> mulai dari tanggal 6 Juni-31 Juli 2015, sesuai dengan tema di setiap periodenya. </li>
                                <li>Upload  foto terbaik Moms dan Si Kecil (perempuan) membawa produk Lifebuoy bodywash / Lifebuoy variant apa saja dengan menggunakan busana hijab, sesuai tema di setiap periodenya ke akun Twitter dan Instagram pribadi.</li>
                                <li>Menyertakan 3 hashtag saat meng-upload foto: #NyamanBerhijab #LifebuoyID #[tema-foto].</li>
                                
                            </ol>
                        </li>
                        <li>
                            Tantangan Kompetisi 
                            <ol>
                                <li>
                                    Kompetisi foto <strong>Nyaman Berhijab Terlindungi</strong> terbagi dalam 4 periode:
                                    <ul>
                                        <li>Tema 1: Foto bersama si kecil saat persiapan Ramadhan (#SambutRamadhan)</li>
                                        <li>Tema 2: Foto ngabuburit bersama si kecil (#SerunyaNgabuburit)</li>
                                        <li>Tema 3: Foto kompak berhijab dengan si kecil (#KompakBerhijab)</li>
                                        <li>Tema 4: Foto kompak dengan si kecil saat Lebaran (#RayakanLebaran)</li>
                                    </ul>
                                </li>
                                <li>
                                    Kompetisi foto <strong>Nyaman Berhijab Terlindungi</strong> terbagi dalam 4 periode:  
                                    <ul>
                                        <li>Tema 1: 6-19 Juni 2015</li>
                                        <li>Tema 2: 20 Juni-3 Juli 2015</li>
                                        <li>Tema 3: 4 -17 Juli 2015</li>
                                        <li>Tema 4: 18-31 Juli 2015</li>
                                    </ul>
                                </li>
                            </ol>
                        </li>
                        <li>
                            Pemenang
                            <ol>
                                <li>Pengumuman pemenang akan dilakukan di Facebook Lifebuoy Indonesia dan twitter @LifebuoyID.</li>
                                <li>Pemenang hiburan periode<br>
Ada 6 pemenang kompetisi yang dipilih berdasarkan kesesuaian foto dengan tema dan penilaian juri untuk setiap periodenya.
</li>
                                <li>Pemenang utama kompetisi<br>
Ada 2 pemenang utama kompetisi yang dipilih <b>dari seluruh 6 pemenang mingguan</b> berdasarkan kesesuaian foto dengan tema dan penilaian juri sebagai pemenang utama
</li>
								<li>Pemenang harus menunjukkan KTP dan KK saat proses verifikasi pemenang.</li>
                                <li>Pengumuman pemenang akan dilakukan satu minggu setelah tiap periode ditutup, dengan detail tanggal sebagai berikut
                                <ul>
                                	<li>Periode 1 akan diumumkan tanggal 27 Juni 2015. </li>
                                	<li>Periode 2 akan diumumkan tanggal 11 Juli 2015. </li>
                                	<li>Periode 3 akan diumumkan tanggal 25 Juli 2015. </li>
                                	<li>Periode 4 akan diumumkan tanggal 8 Agustus 2015. </li>
                                </ul>
                            </ol>
                        </li>
                        <li>
                            Hadiah
                            <ol>
                                <li>Hadiah hiburan dalam setiap periode adalah <i>Voucher Zoya</i> masing-masing senilai Rp. 300.000.</li>
                                <li>Hadiah utama kompetisi: <i>Voucher </i>Zoya masing-masing senilai Rp. 1.000.000</li>
                                <li>Hadiah tidak dapat dipindahtangankan maupun ditukarkan dengan hadiah dalam bentuk lain.</li>
                                <li>Hadiah akan diterima pemenang maksimal 60 hari kerja sejak pengumuman pemenang atau kelengkapan data diterima.</li>
                                <li>Jika karena alasan apa pun pemberian hadiah tidak dapat berjalan sesuai rencana, pihak penyelenggara memiliki hak untuk memodifikasi ketentuan pemberian hadiah yang senilai dengan hadiah yang telah dijanjikan.
</li>
                            </ol>
                        </li>
                        <li>
                            Lain-lain
                            <ol>
                                <li>Foto yang diikutsertakan dalam kompetisi harus merupakan milik peserta sendiri, dan tidak melanggar hak kekayaan intelektual milik pihak mana pun juga (termasuk hak cipta).</li>
                                <li>Pihak penyelanggara berhak menghapus materi yang diikutsertakan jika dianggap tidak memenuhi salah satu atau lebih Syarat dan Ketentuan ini.</li>
                                <li>Semua karya foto peserta yang diunggah dalam kompetisi <b>Nyaman Berhijab Terlindungi</b> menjadi hak milik PT. Unilever Indonesia Tbk, yang sepenuhnya dapat digunakan, disesuaikan, dan diubah untuk disebarluaskan, diperbanyak serta dipublikasikan dalam bentuk apa pun, dalam jumlah dan jangka waktu tak terbatas untuk kepentingan Lifebuoy&reg;.</li>
                                <li>Dengan mengikuti kompetisi ini, peserta memberikan izin kepada pihak penyelenggara untuk menggunakan data peserta demi kepentingan Lifebuoy&reg; dan/atau grup perusahaan PT. Unilever Indonesia Tbk,.</li>
                                <li>Ketentuan yang dibuat oleh dewan juri bersifat mutlak dan tidak dapat diganggu gugat.</li>
                                <li>Syarat dan Ketentuan dapat berubah sewaktu-waktu tanpa pemberitahuan terlebih dahulu.</li>
                                <li>Kompetisi ini berada di bawah dan mengikuti hukum yang berlaku di Republik Indonesia.</li>
                                <li>Hati-hati terhadap penipuan. Kompetisi <b>Nyaman Berhijab Terlindungi</b> tidak dipungut biaya apa pun. Pajak hadiah dan ongkos kirim ditanggung oleh PT. Unilever Indonesia Tbk,.</li>
                                <li>Info lebih lanjut hubungi Suara Konsumen Unilever 0800-1-558000 (bebas pulsa) atau (021) 52995299 (pulsa bayar) atau <a href="mailto:Suara.Konsumen@unilever.com">Suara.Konsumen@unilever.com.</a></li>
                            </ol>
                        </li>
                    </ol>
                    </div>
            </div>
        </div>
        <div id="popup-login" class="popupBox">
        	<div class="boxTop">
            	<h3>Login terlebih dahulu untuk ikutan</h3>
            </div>
            <div class="boxBottom">
            	<p>Login menggunakan akun
Facebook atau Twitter untuk
mengikuti tantangannya, dan
menangkan hadiahnya!</p><br>
                <div class="buttonWrapper">
                	<a href="#" class="loginFb GTM-Login-FB" id="facebook_login"><span>Login with Facebook</span></a>
                    <a href="#" class="loginTwitter GTM-Login-TW" id="twitter_login"><span>Login with Twitter</span></a>
                </div>
            </div>
        </div>
        <div id="popup-gallery" class="popupBox" style="display:none;">
        	<div class="galleryPopup">
            	<img src="<?php echo base_url()?>userdata/a.jpg">
                <div class="photoInfo">
                    <div class="nameUploader title" id="post_username">@ Nuraini</div>
                    <p id="post_description">Aku dan anakku sewaktu persiapan ibadah solat ied #lifebuoyhijabnyaman via @lifebuoy</p>
                    <span id="post_timeago">10 minutes ago</span>
                </div>
           	</div>
            <a href="#" class="closeBtn" onClick="hide_popup();return false;">Close</a>
        </div>
        <div id="popup-thankyou" class="popupBox" style="display:none;">
        	<div class="boxTop">
            	<h3>Terima kasih!</h3>
                <p>
                Foto berhasil di-upload. Ikuti terus
tantangannya Moms, karena
kesempatan untuk mendapatkan
hadiah masih ada di periode
selanjutnya! Tunggu
pengumumannya di akhir periode.
                <?php /*?><span>Foto anda telah berhasil masuk<br> ke sistem kami.</span> Tunggu pengumuman<br> pemenang di akhir periode.  Jika anda<br>belum beruntung terpilih sebagai pemenang<br>pada minggu ini, jangan khawatir karena masih<br>ada periode berikutnya.<?php */?></p>
            </div>
            <div class="boxBottom">
            	<?php /*?><p>Share foto yang telah diupload ke social media<br>anda dan dapatkan bingkisan cantik untuk<br> 
pemenang yang dipilih</p><br><?php */?>
                <div class="buttonWrapper">
                	<span class="share">Share With</span>
                	<a href="#" class="loginFb GTM-Share-FB" id="fb_share"><span>Share to Facebook</span></a>
                    or
                    <a href="#" class="loginTwitter GTM-Share-TW" id="tw_share"><span>Share to Twitter</span></a>
                    <a href="<?php echo site_url('home')?>" class="defBtn GTM-Selesai"><span class="arrow">Selesai</span></a>
                </div>
            </div>
        </div>
    </div>
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
						//if(data.flow==0)
						window.location='<?php echo site_url('upload')?>';
						//else
						//window.location='<?php echo site_url('home')?>';
					}
				});//ajax
			
			});//fb.api
			 
				
		}
		//if
	},{scope: 'public_profile,email'});
}


$(document).ready(function() {
    $('#facebook_login').click(function(e){
   	 	e.preventDefault();
		checkLoginState();
	});
	
	$("#twitter_login").click(function(e){
   	 	e.preventDefault();
		twitter_login();
	});
	$("#how_to_play_btn").click(function(e){
		<?php if($curr_page=='home'){?>
		$("html, body").animate({ scrollTop: $('#howtojoin').offset().top }, 1000);
		return false;
		<?php }else{?>
		window.location='<?php echo base_url()?>#howtojoin';
		<?php }?>
	});
	$("#gallery_btn").click(function(){
		
		<?php if($curr_page=='home'){?>
		$("html, body").animate({ scrollTop: $('#gallery').offset().top }, 1000);
		return false;
		<?php }else{?>
		window.location='<?php echo site_url('gallery')?>';
		<?php }?>
	});
	$("#tnc_btn").click(function(){
		$(".popupWrapper, #popup-tnc").fadeIn();
		return false;	
	});
	
	
	<?php
	$fblink="https://www.facebook.com/dialog/feed?app_id=".APP_ID."&link=".urlencode('http://nyamanberhijab.lifebuoy.co.id/')."&picture=".urlencode(base_url().'/templates/images/image-share.jpg')."&name=".urlencode("Lifebuoy Nyaman Berhijab Terlindungi")."&description=".urlencode("Ayo, upload foto Moms bersama Si Kecil & menangkan voucher belanja Zoya senilai Rp. 1.000.000 #NyamanBerhijab")."&redirect_uri=".urlencode(site_url('closefb'));
	$twlink=urlencode("Ayo, upload foto Moms bersama Si Kecil & menangkan voucher belanja di nyamanberhijab.lifebuoy.co.id #NyamanBerhijab");?>
	
	$(".sharefb2").click(function(){		
		var url_to_open="<?php echo $fblink;?>";
		var width = 1000; 	
		var height = 550;
		var left = parseInt((screen.availWidth/2) - (width/2));
		var top = parseInt((screen.availHeight/2) - (height/2));
		window.open(url_to_open, "Facebook", 'height=350,width=700,left=' + left + ',top=' + top + ',screenX=' + left + ',screenY=' + top);
		return false;
	});
	
	$(".sharetw2").click(function(){	
		//var txt=$("#tw_linksss").val();		
		var txt="<?php echo $twlink;?>";
		var url_to_open='http://twitter.com/intent/tweet?text='+txt;
		
		var width = 1000; 	
		var height = 550;
		var left = parseInt((screen.availWidth/2) - (width/2));
		var top = parseInt((screen.availHeight/2) - (height/2));
		window.open(url_to_open, "Tweet", 'height=350,width=700,left=' + left + ',top=' + top + ',screenX=' + left + ',screenY=' + top);
		return false;
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

function goto_url(linksss){
	if(linksss!=''){
		window.location=linksss;
	}
}
</script>
</body>
</html>

