

    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
			
			<div class="" align="center" style="margin-top:50px">
			<img src="<?php echo base_url()?>logo.png" style="width:50%">
                </div>
				
                <div class="login-panel panel panel-default" style="margin-top:10px">

                    
					 <h3 class="" align="center">KWAL: Procurement </h3>
                    <div class="panel-body">
                        <form role="form" id="login" action="<?php echo base_url()?>setup/Login">
                            <fieldset>
                                <div class="form-group has-feedback">
                                    <input class="form-control input-sm" placeholder="User Name" name="user" type="text" autofocus>
									<span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                                </div>
                                <div class="form-group has-feedback">
                                    <input class="form-control input-sm" placeholder="Password" name="pass" type="password" value="">
									<span class="glyphicon glyphicon-lock form-control-feedback" ></span>
                                </div>
                                <div class="checkbox">
								        <div class="row">
										<div class="col-md-5">
                                    <label>
                                        <input name="remember" type="checkbox" value="Remember Me">Remember Me
                                    </label>
									
									</div>
									<div class="col-md-6">
                                   
                                      <a href="">Forgot my Password</a>
									
									</div>
									</div>
                                </div>
                                <!-- Change this to a button or input when using this as a form -->
                                <input type="submit" id="loginbtn" class="btn btn-lg btn-success btn-sm " value="Sign in" style="width:100%"/>
                            </fieldset>
                        </form>
						<p id="responce6"></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

   