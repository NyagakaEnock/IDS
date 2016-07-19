
<body>
	<small>
    <div id="wrapper">

        <!-- Navigation -->


        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h4 class="page-header"></h4>
                </div>
				<div class="col-lg-12">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            Proforma Invoice Reminders
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
							 <div class="row">
							 <div class="col-lg-6">
                    <div class="panel panel-default">
					<small>
                        <div class="panel-heading">
				<ul class="nav  navbar-right" style="margin-top:-10px;">		  
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                         <i class="fa fa-caret-down"></i>
						More Options 
                    </a>
                    <ul class="dropdown-menu dropdown-user">
					
                        <li><a href="#"> Overdue Requests</a>
                        </li>
                        <li><a href="#"> All Requests</a>
                        </li>
                        <li class="divider"></li>
                        
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
				</ul>   
							 
							 
						  Select a Pending Proforma Invoice Requests

                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
									<form role="form" id="PendingInvoiceSearch" action="invoiceprocessing/searchInvoices">
									<div class="form-group " >
									<input type="text" class="form-control input-sm" id="input-filter"  style="width:95%" name="ProformaSearch" Placeholder="Search Record">
									
									</div>
									</form>
								
                            <div class="table-responsive table-bordered" style="" >
							
	<p></p>					<div class="dataTable_wrapper" style="width:2000px;height:350px" id="pendingInvoices">	

                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Indent No</th>
                                            <th>Indent Type</th>
                                            <th>Supplier/Exporter</th>
											<th>Date of Indent</th>
											<th>Attention To</th>
											<th>Carbon Copy</th>
											<th>Fax No</th>
											<th>Date Expected</th>
											<th>Exporter Code</th>
											<th>Importer Code</th>
											<th>Subject</th>
											<th>Our Contact</th>
	</tr>
</thead>
<tbody>
	<?php foreach($ShowAllOverDueRequests as $key):?>
	 <tr>
		<td><input type="radio" name="invoice" onchange="loadReminderDetails('<?php echo $key->IndentNo?>')"></td>
		<td><?php echo $key->IndentNo?></td>
	   <td><?php echo $key->IndentType?></td>
	   <td><?php echo $key->ExporterName?></td>
		<td><?php echo substr($key->IndentDate,0,10)?></td>
		 <td><?php echo $key->AttentionTO?></td>
		  <td><?php echo $key->CarbonCopy?></td>
			<td><?php echo $key->FaxNo?></td>
		   <td><?php echo $key->DateExpected?></td>
		   <td><?php echo $key->ExporterCode?></td>
		    <td><?php echo $key->ImporterCode?></td>
		   <td><?php echo $key->Subject?></td>
		   <td><?php echo $key->StaffIDNo?></td>
	</tr>
<?php endforeach;?>
                                    </tbody>
                                </table>
                            </div>
							</div>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.panel-body -->
                    </div>

							  </div>
							  <div class="col-lg-6">
							  								   <div class="panel panel-default" id="">
												    
												   
							                           <div class="panel-heading">
                        Particulars of Selected Reminder
                        </div>		
<form id="ProformaReminder" role="form" action="invoiceprocessing/createReminderDetails" method="POST">	
  <div id="pendingReminders">					
			<div class="row">

			<div class="col-lg-6">
			<label>Indent No</label>
			<input type="text" disabled id="IndentNo" class="form-control input-sm"name="IndentNo" style="width:95%">	
			</div>
			<div class="col-lg-6">
			<label>Importer</label>
			<input type="text" id="GrossWeight" disabled class="form-control input-sm"name="GrossWeight" style="width:95%">	
			</div>
			</div>
			<div class="row">
				
			
				<div class="col-lg-6">
				
			<label>Supplier/Exporter</label>
			<input type="text" id="PackagesReceived" disabled class="form-control input-sm"name="PackagesReceived" style="width:95%">	
			
			</div>
		<div class="col-lg-6">
			
		<label>Select Contact Person</label>
		<select class="form-control select2" style="width:95%">
		<option></option>
		</select>	
		
		</div>
		
		</div>
		<div class="row">
		
			<div class="col-lg-12">
			<div class="form-group">
		<label>Subject</label>
		<input type="text" id="Subject" class="form-control input-sm"name="Subject" style="width:95%">	
		</div>
		<div class="form-group">
		<label>Reminder Message</label>
		<textarea  id="Message" class="form-control" rows="2" name="Message" style="width:95%">	</textarea>
		</div>
		<div class="form-group">
		<label>Clossing Message</label>
		<textarea  id="Clossing" class="form-control" rows="2" name="Clossing" style="width:95%">	</textarea>
		</div>
			</div>
			</div>
			</div>
		
		
			
					<div class="row">

			<div class="col-lg-12">
			<div class="form-group">
		<p id="loadingxx" class="pull-left"></p>
		 <input   type="submit" id="saveProformaReminder" value="Save  Details" class="btn btn-success btn-sm pull-right"/>
		</div>
			</div>

			</div>
		</form>
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

<script>

	function loadReminderDetails(x)
{
			 var xmlhttp;
if (window.XMLHttpRequest)
  {
  xmlhttp=new XMLHttpRequest();
  }
else
  {
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
 	  document.getElementById("loadingxx").innerHTML='';
	 document.getElementById("pendingReminders").innerHTML= xmlhttp.responseText;
    }
  }

  document.getElementById("loadingxx").innerHTML="<img src='<?php echo base_url().'SmallLoading.gif'?>'> Loading...";
xmlhttp.open("POST","<?php echo base_url()?>invoiceprocessing/loadReminderDetails?Indent="+x,true);
xmlhttp.send();
}
</script>
</body>

</html>
