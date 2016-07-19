<!-------Header-->
<body>

    <div id="wrapper">

        <!-- Navigation -->


        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Dashboard</h1>
                </div>
				<div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            My Account
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                           
				<div class="row">
									<div class="col-lg-4">
									  <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-bell fa-fw"></i> Update Personal Details    
							</div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
						
							  <form role="form">
                                        <div class="form-group">
                                            <label>Select Request</label>
										
										
                                            <select class="form-control select2">
                                                <option></option>
                                               <?php foreach($request as $row):
									
									
									?>
                                        <tr>
                                           <option value="<?php echo $row->id;?>"><?php echo $row->level;?></option>
										<?php
										
										endforeach;
										?>
                                            </select>
										</div>
								
										<div class="form-group">
										
                                        </div>
							</form>
						  </div>

						 
									</div>
									</div>
									
									<div class="col-lg-4">
									  <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-bell fa-fw"></i> Change Password  
							</div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
						
							  <form role="form">
                                       <div class="form-group">
                                            <label>Text area</label>
                                            <textarea class="form-control" rows="3"></textarea>
                                        </div>
								
										<div class="form-group">
										 <button type="submit" class="btn btn-default">Save Details</button>
                                        </div>
							</form>
						  </div>

						 
									</div>
									</div>
									<div class="col-lg-4">
									  <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-bell fa-fw"></i> Notifications  
							</div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
						
							  <form role="form">
                                      <div class="form-group">
                                            <label>Allow/Reject SMS or Email Notifications</label>
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" value="">Allow SMS Notification
                                                </label>
                                            </div>
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" value="">Allow Email Notification
                                                </label>
                                            </div>
                                           
                                        </div>
							</form>
						  </div>

						 
									</div>
									</div>
									</div>
                            <!-- Tab panes -->

                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->

            <!-- /.row -->
            <div class="row">
                <div class="col-lg-8">
                    <div class="panel panel-default" hidden>
                        
                        <!-- /.panel-heading -->
                        <div class="panel-body" >
                            <div id="morris-area-chart"></div>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                    <div class="panel panel-default" hidden>
          
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-4">
                                    <!-- /.table-responsive -->
                                </div>
                                <!-- /.col-lg-4 (nested) -->
                                <div class="col-lg-8" >
                                    <div id="morris-bar-chart"></div>
                                </div>
                                <!-- /.col-lg-8 (nested) -->
                            </div>
                            <!-- /.row -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                   
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-8 -->
                <div class="col-lg-4">
                    
                    <!-- /.panel -->
                   
                        <div class="panel-body" hidden>
                            <div id="morris-donut-chart"></div>
                           
                        </div>
                        <!-- /.panel-body -->
                   
                    <!-- /.panel -->
                    
                    <!-- /.panel .chat-panel -->
                </div>
                <!-- /.col-lg-4 -==================================================================================->
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- Footer -->


</body>

</html>
