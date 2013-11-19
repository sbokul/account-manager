<nav class="navbar" role="navigation">
    <div class="container bg-img">
        <div style="text-align: right;margin-top: 20px;">
            <span class="cl-white tx-bold">
                Welcome <?php $user_info = $this->session->userdata('user_info'); echo $user_info['user_full_name']; ?> <br />
                Last Login : <?php if($user_info['user_last_login'] == '0000-00-00') echo '1st time visit.'; else echo $user_info['user_last_login'];?><br />
                <?php if($data['user_info']['user_status'] == '1') echo 'Gold Associate'; else echo 'Silver Associate'; ?>
            </span>
		</div>
    </div>
</nav>