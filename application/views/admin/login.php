<div id="content">
    <h2>Welcome to Lifebuoy</h2>
    <p><b>Content Management System is a tool where you can easily manage what's inside your website.</b></p>
    <p>Please login below with your administrator account that we have provided earlier...</p>
    <h3>Login:</h3>
    <p>Enter your administrator username and password below.</p>
    <form class="loginForm" method="post" action="<?php echo site_url('lifebuoy_adm/login/do_login');?>">
        <dl>
            <dt><label class="autoFade" for="username">Username</label><input id="username" class="txtField" type="text" name="username" autocomplete="off" /></dt>
        </dl>
        <dl>
            <dt><label class="autoFade" for="password">Password</label><input id="password" class="txtField" type="password" name="password" autocomplete="off" /></dt>
        </dl>
        <dl>
            <dd></dd>
            <dt><input type="submit" class="defBtn" value="Login" /></dt>
        </dl>
    <label class="error"><?php if(isset($error)){ echo $error;}?></label>
    </form>
</div>