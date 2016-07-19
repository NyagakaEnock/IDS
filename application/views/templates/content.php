<!-------Header-->
<body>
	<small>
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
                            Software Configuration
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs">
                                <li class="active"><a href="#home" data-toggle="tab">Company Details</a>
                                </li>
                                <li><a href="#profile" data-toggle="tab">Set up Requests</a>
                                </li>
                                <li><a href="#messages" data-toggle="tab">Company Employees</a>
                                </li>
                                <li><a href="#levels" data-toggle="tab">Approval Levels</a>
                                </li>
								<li><a href="#settings" data-toggle="tab">Request Approvers</a>
                                </li>
								<li><a href="#admins" data-toggle="tab">System Admins</a>
                                </li>
                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div class="tab-pane fade in active" id="home">
                                    <h4>Company Details</h4>
									<div class="row">
									<div class="col-lg-4">
									  <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-bell fa-fw"></i> Update Company Details                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
						<?php echo validation_errors(); 
						foreach($setup as $key);
						
						?>
							  <form role="form" id="company" action="setup/companyCreate">
                                        <div class="form-group">
                                            <label>Company Name</label>
										
										
                                            <input class="form-control" name="companyName" value="<?php echo $key->name;?>" placeholder="Company Name">
										</div>
										<div class="form-group">
											<label>Company Address</label>
                                            <input class="form-control" name="address" value="<?php echo $key->address;?>" placeholder="Company Address">
										</div>
										<div class="form-group">
											<label>Company Website</label>
                                            <input class="form-control" name="website" value="<?php echo $key->website;?>" placeholder="Company Website">
										</div>
										<div class="form-group">
											<label>Company Email</label>
                                            <input class="form-control" name="email" value="<?php echo $key->email;?>" placeholder="Company Email">
										</div>
										<div class="form-group">
											<label>Company Contact</label>
                                            <input class="form-control" name="contact"value="<?php echo $key->contact;?>" placeholder="Company Contact">
                                           
                                        </div>
										<div class="form-group">
										 <button type="submit" id="send-company" class="btn btn-default">Save Details</button>
                                        </div>
							</form>
							
						<p id="responce"></p>
						</div>
									</div>
									</div>
									</div>
                                     </div>
                                <div class="tab-pane fade" id="profile">
                                    <h4>Set up Requests</h4>
                                   									<div class="row">
									<div class="col-lg-4">
									  <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-bell fa-fw"></i> Add New Request                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
							  <form role="form" id="Request" action="setup/createRequest">
                                        <div class="form-group">
                                            <label>Request Name</label>
										
										
                                            <input class="form-control" name="request" placeholder="Company Name">
										</div>
										
										<div class="form-group">
										 <button type="submit" id="save-Request" class="btn btn-default">Save Details</button>
                                        </div>
							</form>
						<p id="responce2"></p>
						</div>
									</div>
									</div>
									 <div class="col-lg-8">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Bordered Table
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive table-bordered">
						
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Request Description</th>
                                            <th>Edit</th>
                                            <th>Delete</th>
                                        </tr>
                                    </thead>
                                    <tbody>
									<?php foreach($request as $row):
									$c=1;
									
									?>
                                        <tr>
                                            <td><?php echo $c;?></td>
                                            <td><?php echo $row->request;?></td>
                                            <td>Edit</td>
                                            <td>Delete</td>
                                        </tr>
										<?php
										$c++;
										endforeach;
										?>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
									</div>      </div>
                                <div class="tab-pane fade" id="messages">
                                    <h4>Company Employees</h4>
                                  				<div class="row">
									<div class="col-lg-4">
									  <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-bell fa-fw"></i> Add New Employee                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
							  <form role="form" id="Employee" action="setup/companyEmployee">
							  <div class="form-group">
											<label>Employee Code</label>
                                            <input class="form-control" name="code" placeholder="Employee Code">
										</div>
                                        <div class="form-group">
                                            <label>Employee Name</label>
										
										
                                            <input class="form-control" name="employeename" placeholder="Employee Name">
										</div>
										<div class="form-group">
											<label>Contact</label>
                                            <input class="form-control" name="contact" placeholder="Contact">
										</div>
										<div class="form-group">
											<label>Email Address</label>
                                            <input class="form-control" name="email" placeholder="Email Address">
										</div>
										
										
										<div class="form-group">
										 <button type="submit" id="save-Employee" class="btn btn-default">Save Details</button>
                                        </div>
							</form>
						<p id="responce4"></p>
						</div>
									</div>
									</div>
									 <div class="col-lg-8">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Bordered Table
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive table-bordered">
                                <table class="table">
                                    <thead>
                                        <tr>
                                           <th>Employee Id</th>
                                            <th>Name</th>
                                            <th>Contact</th>
                                            <th>Email</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                       <?php foreach($employee as $row):
									
									
									?>
                                        <tr>
                                            <td><?php echo $row->code;?></td>
                                            <td><?php echo $row->employeename;?></td>
											<td><?php echo $row->contact;?></td>
											<td><?php echo $row->email;?></td>
                                           
                                        </tr>
										<?php
										
										endforeach;
										?>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
									</div>
									</div>
                                <div class="tab-pane fade" id="levels">
                                    <h4>Request Levels</h4>
                                   <div class="row">
									<div class="col-lg-4">
									  <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-bell fa-fw"></i> Add New Request   Level                     </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
							  <form role="form" id="level" action="setup/createLevel">
                                        <div class="form-group">
                                            <label>Level Description</label>
										
										
                                            <input class="form-control" name="level" placeholder="Company Name">
										</div>
										
										<div class="form-group">
										 <button type="submit" id="save-Level" class="btn btn-default">Save Details</button>
                                        </div>
							</form>
						<p id="responce5"></p>
						</div>
									</div>
									</div>
									 <div class="col-lg-8">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Bordered Table
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive table-bordered">
                                <table class="table">
                                    <thead>
                                        <tr>
                                         
                                            <th>Level Description</th>
                                            <th>Edit</th>
                                            <th>Delete</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                       <?php foreach($level as $row):
									
									
									?>
                                        <tr>
                                            <td><?php echo $row->level;?></td>
                                           <td>Edit</td>
                                           <td>Delete</td>
                                        </tr>
										<?php
										
										endforeach;
										?>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
									</div>   
									</div>
								 <div class="tab-pane fade" id="settings">
                                    <h4>Request Approvers</h4>
                                    <div class="row">
									<div class="col-lg-4">
									  <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-bell fa-fw"></i> Request Approvers
							</div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
							  <form role="form" id="Approver" action="setup/createApprover">
                                        <div class="form-group">
                                            <label>Select Employee</label>
										 <select class="form-control select2" style="width:95%"  onchange="fillCombo('employeeid',this.value)">
                                                <option></option>
                                                <?php foreach($employee as $row):
									
									
									?>
                                            <option value="<?php echo $row->id;?>"><?php echo $row->employeename;?></option>

										<?php
										
										endforeach;
										?>
                                            </select>
											<input type="hidden" id="employeeid" name="employeeid">
										</div>
										 <div class="form-group">
                                            <label>Select Approval Level</label>
										 <select class="form-control select2" style="width:95%" onchange="fillCombo('levelid',this.value)">
                                                <option></option>
                                                <?php foreach($level as $row):
									
									
									?>
                                            <option value="<?php echo $row->id;?>"><?php echo $row->level;?></option>

										<?php
										
										endforeach;
										?>
                                            </select>
											<input type="hidden" id="levelid" name="levelid">
										</div>
										
										<div class="form-group">
										 <button type="submit" id="save-Approver" class="btn btn-default">Save Details</button>
                                        </div>
							</form>
						<p id="responce6"></p>
						</div>
									</div>
									</div>
									 <div class="col-lg-8">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Bordered Table
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive table-bordered">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            
                                            <th>First Name</th>
                                            <th>Level</th>
                                            <th>Edit</th>
											<th>Delete</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                        <?php foreach($approver as $row):
									
									
									?>
                                        <tr>
                                            <td><?php echo $row->employeename;?></td>
                                          <td><?php echo $row->level;?></td>
                                           <td>Edit</td>
										    <td>Delete</td>
                                        </tr>
										<?php
										
										endforeach;
										?>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
									</div>   
									</div>
									<div class="tab-pane fade" id="admins">
                                    <h4>System Administrators</h4>
									<div class="row">
									<div class="col-lg-8">
			<div class="panel panel-default">
                        <div class="panel-heading">
                            Bordered Table
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive table-bordered">
                                <table class="table">
                                    <thead>
                                        <tr>
                                           <th>Employee Id</th>
                                            <th>Name</th>
                                            <th>Contact</th>
                                            <th>Email</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                       <?php foreach($employee as $row):
									
									
									?>
                                        <tr>
                                            <td><?php echo $row->code;?></td>
                                            <td><?php echo $row->employeename;?></td>
											<td><?php echo $row->contact;?></td>
											<td><?php echo $row->email;?></td>
                                           
                                        </tr>
										<?php
										
										endforeach;
										?>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
									</div>
									</div>
                                     </div>
                            </div>
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

	</small>
</body>

</html>
