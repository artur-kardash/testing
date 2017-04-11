   <div>
      <a class="hiddenanchor" id="signup"></a>
      <a class="hiddenanchor" id="signin"></a>

      <div class="login_wrapper">
        <div class="animate form login_form">
          <section class="login_content">
            <form action="" method="post">
              <h1>Login Form</h1>
              <div>
                <input type="text" class="form-control" name="login" placeholder="Username" required="" />
              </div>
              <div>
                <input type="password" class="form-control" name="password" placeholder="Password" required="" />
              </div>
              <div>
                <!-- <a type="submit" class="btn btn-default submit">Log in</a> -->
               <input type="submit" value="Login" name="btn" class="btn btn-default submit">
                <a class="reset_pass">Lost your password?</a>
              </div>

              <div class="clearfix"></div>

              <div class="separator">
                <p class="change_link">New to site?
                  <a href="/index/registration/" class="to_register"> Create Account </a>
                </p>

                <div class="clearfix"></div>
                <br />

                <div>
                    <h1><i class="fa fa-paw"></i> Join To IT</h1>
                    <p>©2016 All Rights Reserved.</p>
                </div>
              </div>
            </form>
             <?php if($login_status=="access_granted") { ?>
              <p style="color:green">Success</p>
            <?php } elseif($login_status=="access_denied") { ?>
              <p style="color:red" class="text-center">Wrong login or password</p>
            <?php } ?>
                     <?php extract($data);?>
          </section>
        </div>


      </div>
    </div>

