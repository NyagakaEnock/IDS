<!-------Header-->
<body>

    <div id="wrapper">

        <!-- Navigation -->


        <div id="page-wrapper">
		 <div class="col-lg-12">
                    <h1 class="page-header">Dashboard</h1>
                </div>
            <div class="row">
			 <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Approve Employee Requests
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
						<small>
                            <div class="table-responsive table-bordered">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            
                                            <th>Request</th>
                                            <th>Requested by</th>
											 <th>Requested Description</th>
											<th>Date Requested</th>
											<th>Approve</th>
											<th>Reject</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                        <?php foreach($approvals as $row):
								$query = $this->db->query("SELECT * FROM approvals WHERE approvals.requestid='{$row->RID}'  AND status<>'' AND approverid='{$_SESSION['fortuneUserID']}'");
								foreach ($query->result() as $KEY);
								
								if($query->num_rows()==0){
								$query = $this->db->query("SELECT * FROM approvers,levels WHERE  approvers.levelid=levels.id AND approvers.levelid<'{$_SESSION['fortuneUserLevelID']}' ORDER BY   approvers.levelid DESC LIMIT 1");
								foreach ($query->result() as $KEY2);
								$employeeid="";
								$query1="";
								if($query->num_rows()!=0){
								$employeeid = $KEY2->employeeid;
								$query1 = $this->db->query("SELECT * FROM approvals WHERE approvals.requestid='{$row->RID}'  AND status='Y' AND approverid='{$employeeid}'");
							foreach ($query1->result() as $KEY);	
							if($query1->num_rows()!=0){							
							?>
								<tr>
                                            <td><?php echo  $row->request;?></td>
											<td><?php echo $row->employeename;?></td>
											<td width="40%"><?php echo $row->requestDescription;?></td>
											<td><?php echo $row->daterequested;?></td>
                                           <td width="8%"><a href="javascript:void(0)" onclick="alerter('<?php echo $row->RID;?>','Y')">Approve</a></td>
										    <td width="8%"><a href="javascript:void(0)" onclick="showDiv('<?php echo $row->RID;?>')">Reject</a></td>
                                        </tr>
										<tr>
                                            <td></td>
											<td></td>
											<td width="40%"></td>
											<td></td>
                                           
										    <td colspan="2">
											 <div hidden class="form-group" id="div<?php echo $row->RID;?>">
											  <form role="form" id="level<?php echo $row->RID;?>" >
                                            <label>Kindly Provide a reason</label>
                                            <textarea class="form-control" rows="4" id="reason<?php echo $row->RID;?>" name="requestDescription"></textarea>
											<input type="hidden" id="txt<?php echo $row->RID;?>" value="<?php echo $row->RID;?>"/>
											  
											 </form>
											<button type="submit"  id="btn" onclick="alerter('<?php echo $row->RID;?>','N')"class="btn btn-danger">Reject</button>
											
                                        </div>
										 <p id="p<?php echo $row->RID;?>"></p>
											 
											</td>
                                        </tr>
								<?php
								}else{
								}
								
								
								
									?>
                                        
										<?php
										}else{
										$query1 = $this->db->query("SELECT * FROM approvals WHERE approvals.requestid='{$row->RID}'  AND status='' AND approverid='{$_SESSION['fortuneUserID']}'");
										foreach ($query1->result() as $KEY);	
							if($query1->num_rows()==0){		
							?>
										<tr>
                                            <td><?php echo  $row->request;?></td>
											<td><?php echo $row->employeename;?></td>
											<td width="40%"><?php echo $row->requestDescription;?></td>
											<td><?php echo $row->daterequested;?></td>
                                           <td width="8%"><a href="javascript:void(0)" onclick="alerter('<?php echo $row->RID;?>','Y')">Approve</a></td>
										    <td width="8%"><a href="javascript:void(0)" onclick="showDiv('<?php echo $row->RID;?>')">Reject</a></td>
                                        </tr>
										<tr>
                                            <td></td>
											<td></td>
											<td width="40%"></td>
											<td></td>
                                           
										    <td colspan="2">
											 <div hidden class="form-group" id="div<?php echo $row->RID;?>">
											  <form role="form" id="level<?php echo $row->RID;?>" >
                                            <label>Kindly Provide a reason</label>
                                            <textarea class="form-control" rows="4" id="reason<?php echo $row->RID;?>" name="requestDescription"></textarea>
											<input type="hidden" id="txt<?php echo $row->RID;?>" value="<?php echo $row->RID;?>"/>
											  
											 </form>
											<button type="submit"  id="btn" onclick="alerter('<?php echo $row->RID;?>','N')"class="btn btn-danger">Reject</button>
											
                                        </div>
										 <p id="p<?php echo $row->RID;?>"></p>
											 
											</td>
                                        </tr>
							<?php
							}
										}
										}
										endforeach;
										?>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
							</small>
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
