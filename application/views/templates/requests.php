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
                            Requests
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs">
                                <li class="active"><a href="#home" data-toggle="tab">Make New Request</a>
                                </li>
                                <li><a href="#profile" data-toggle="tab">View Approved Requests</a>
                                </li>
                                <li><a href="#messages" data-toggle="tab">View Pending Requests</a>
                                </li>
                                <li><a href="#levels" data-toggle="tab">View Rejected Requests</a>
                                </li>
								
                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div class="tab-pane fade in active" id="home">
                                    <h4>Make New Request</h4>
									<div class="row">
									 <form role="form" action="request/createRequest" id="sendrequest">
									<div class="col-lg-4">
									  <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-bell fa-fw"></i> Enter Request Details     
							</div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
						
							 
                                        <div class="form-group">
                                            <label>Select Request</label>
										
										
                                           <select class="form-control select2" style="width:95%" onchange="fillCombo('levelid',this.value)">
                                                <option></option>
                                                <?php foreach($request as $row):
									
									
									?>
                                            <option value="<?php echo $row->id;?>"><?php echo $row->request;?></option>

										<?php
										
										endforeach;
										?>
                                            </select>
											<input id="levelid" type="hidden" name="request">
										</div>
								
										<div class="form-group">
										
                                        </div>
							
						  </div>

						 
									</div>
									</div>
									
									<div class="col-lg-6">
									  <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-bell fa-fw"></i> Enter Request Details     
							</div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
						
							 
                                       <div class="form-group">
                                            <label>Text area</label>
                                            <textarea class="form-control" rows="4" name="requestDescription"></textarea>
                                        </div>
								
										<div class="form-group">
										 <button type="submit" id="send_request" class="btn btn-default">Save Details</button>
                                        </div>
							<p id="responce6"></p>
						  </div>

						 
									</div>
									</div>
									</div>
									</form>
                                     </div>
                                <div class="tab-pane fade" id="profile">
                                    <h4> View Approved  Requests</h4>
                                   									<div class="row">
									
									 <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            View Approved  Requests
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive table-bordered">
                              <table class="table">
                                    <thead>
                                        <tr>
                                            
                                            <th>Request</th>
											<th>Request Description</th>
                                            <th>Approved by</th>
										
											<th>Date Approved</th>
											
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                        <?php foreach($approvedrequest as $row):
											$query = $this->db->query("SELECT * FROM approvals,approvers,levels WHERE approvals.approverid=approvers.employeeid AND approvers.levelid=levels.id AND approvals.requestid='{$row->requestid}'");
											$count2 = $query->num_rows();
											if($count2==0){
									?>
                                        <tr>
                                            <td><?php echo $row->request;?></td>
											<td width="40%"><?php echo $row->requestDescription;?></td>
											<td><?php echo $row->employeename;?></td>
										
											<td><?php echo $row->dateapproved;?></td>
                                          
                                        </tr>
										
										<?php
										}
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
                                    <h4>View Pending Requests</h4>
                                  				<div class="row">
									
									 <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            View Pending Requests
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive table-bordered">
                              <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Request</th>
											<th>Request Description</th>
											
											<th>Date Requested</th>
											<th>Pending Status</th>
											
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                        <?php foreach($pendingrequest as $row):
											$query = $this->db->query("SELECT * FROM approvals WHERE approvals.requestid='{$row->RID}' ");
										
											foreach ($query->result() as $KEY);
											if($query->num_rows()==0){
											$query = $this->db->query("SELECT * FROM levels,approvers WHERE approvers.levelid=levels.id");
										
											foreach ($query->result() as $KEY);
											$count = $query->num_rows();
											$query = $this->db->query("SELECT * FROM approvals,approvers,levels WHERE approvals.approverid=approvers.employeeid AND approvers.levelid=levels.id AND approvals.requestid='{$row->RID}'");
											$count2 = $query->num_rows();
											$pending = $count-$count2;
									?>
                                        <tr>
                                            <td><?php echo $row->request;?></td>
											<td width="40%"><?php echo $row->requestDescription;?></td>
											<td><?php echo $row->daterequested;?></td>
                                          <td><?php echo "<font color='red'>".$pending." Approvals Pending</font>";?></td>
                                        </tr>
										
										<?php
										}else echo 454;
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
                                    <h4> View Rejected Requests</h4>
                                   <div class="row">
									
									 <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                             View Rejected Requests
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
         
                            <div class="table-responsive table-bordered">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            
                                            <th>Request</th>
											<th>Request Description</th>
                                            <th>Rejected by</th>
											 <th>Reason</th>
											<th>Date Rejected</th>
											
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                        <?php foreach($rejectedrequest as $row):
										
											
									?>
                                        <tr>
                                            <td><?php echo $row->request;?></td>
											<td width="40%"><?php echo $row->requestDescription;?></td>
											<td><?php echo $row->employeename;?></td>
											<td width="20%"><?php echo $row->reason;?></td>
											<td><?php echo $row->dateapproved;?></td>
                                          
                                        </tr>
										
										<?php
										
										endforeach;
										?>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
						
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
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
