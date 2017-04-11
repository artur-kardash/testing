<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 17.01.2017
 * Time: 10:44
 */

?>

<div class="container">
    <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4">
        <div id="registtation" class="animate form">
            <section class="login_content">
                <form action="/index/registration" method="post">
                    <h1>Create Account</h1>
                    <div>
                        <input type="text" class="form-control" placeholder="Username" required="" name="username"/>
                    </div>
                    <div>
                        <input type="email" class="form-control" placeholder="Email" required="" name="email"/>
                    </div>
                    <div>
                        <input type="password" class="form-control" placeholder="Password" required="" name="password"/>
                    </div>
                    <div>
        <!--                <a class="btn btn-default submit" href="l">Submit</a>-->
                        <input type="submit" class="btn btn-default submit" name="registration" value="Registration">
                    </div>

                    <div class="clearfix"></div>

                    <div class="separator">
                        <p class="change_link">Already a member ?
                            <a href="/index/login" class="to_register"> Log in </a>
                        </p>

                        <div class="clearfix"></div>
                        <br />

                        <div>
                            <h1><i class="fa fa-paw"></i> Join To IT</h1>
                            <p>©2016 All Rights Reserved.</p>
                        </div>
                    </div>
                </form>
            </section>
        </div>
        </div>
        <div class="col-md-4"></div>
    </div>
</div>
