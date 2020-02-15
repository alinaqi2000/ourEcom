<div class="cls-content">
    <div class="cls-content-sm panel">
        <div class="panel-body" style="background: rgba(255,255,255,.8);">
            <div class="float-left w-100">
                <img id="brandLogo" src="<?= base_url('uploads/logo/' . $site_info_data['sec_logo']) ?>" alt="Nifty Logo" class="brand-icon">
            </div>
            <div class="mar-ver pad-btm float-left">

                <p>Sign In to admin panel</p>
            </div>
            <?php
            echo form_open(base_url(ADMIN . '/index/login'), 'method="POST"  autocomplete="off"');
            ?>
            <div class="form-group">
                <?php $inp = array(
                    'name'          => 'username',
                    'class'         => 'form-control',
                    'placeholder'   => 'Username',
                    'id'            => 'username',
                    'autocomplete'            => 'off',
                    'autofocus'     => ''
                );

                echo form_input($inp);
                ?>
            </div>
            <div class="form-group">
                <?php $inp = array(
                    'name'          => 'password',
                    'class'         => 'form-control',
                    'placeholder'   => 'Password'
                );

                echo form_password($inp);
                ?>
            </div>
            <?php $inp = array(
                'class'         => 'btn btn-primary btn-lg btn-block',
                'type'         => 'submit',
                'content'            => '<i class="ion-log-in icon-lg icon-fw"></i>Sign In'
            );

            echo form_button($inp);
            ?>
            </form>
        </div>

    </div>
</div>