
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
                           
										<div class="row">
						<form role="form" id="neworders" action="Reports/SaveNewOrders/">
						<div class="col-lg-8">
                         Receiving Proforma Invoices
                        </div>
						
						<div class="col-lg-4">
                            Select a record to Print <select class="form-control select2" style="width:58%;" name="IndentNo" onchange="loadData(this.value)">
														<option ></option>
														
														<?PHP foreach($printNewOrders as $key)
														{
														?>
														<option ><?php echo $key->IndentNo?></option>
														<?php
														}
														?>
														</select>
														
                        </div>
						
						<div class="col-lg-2">
						 
                        </div>
						</form>
						</div>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
							 <div class="row">
							 <div class="col-lg-6">
							 <small>
                    <div class="panel panel-default">
					
                        <div class="panel-heading">
				  
							 
							 
						  Select a Pending Proforma Invoice Requests
              		
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
									
								
                            <div class="table-responsive table-bordered" style="" >
							
	<p></p>					<div class="dataTable_wrapper" style="width:1000px;height:200px" id="pendingInvoices">	

                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Indent No</th>
                                            <th>Indent Type</th>
                                            <th>Supplier/Exporter</th>
											<th>Date of Indent</th>
											<th>Attention To</th>
											<th>Delivered By</th>
											<th>Fax No</th>
											<th>Country</th>
											<th>Currency</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach($PendingProformaInvoiceRequests as $key):
							if($this->proformainvoices_model->ShowCommodityUnderIndent($key->IndentNo,"")!=NULL)
							{
										?>
										 <tr>
                                            <td><input type="radio" name="invoice" onchange="ShowCommodityUnderIndent('<?php echo $key->IndentNo?>')"></td>
                                            <td><?php echo $key->IndentNo?></td>
                                           <td><?php echo $key->IndentType?></td>
                                           <td><?php echo $key->ExporterName?></td>
										    <td><?php echo substr($key->IndentDate,0,10)?></td>
											 <td><?php echo $key->AttentionTO?></td>
											  <td><?php echo $key->DeliveryType?></td>
											    <td><?php echo $key->FaxNo?></td>
											   <td><?php echo $key->Country?></td>
											   <td><?php echo $key->Currency?></td>
                                        </tr>
									<?php
							}
									endforeach;?>
                                    </tbody>
                                </table>
                            </div>
							</div>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
<form role="form" id="ProformaInvoice" action="invoiceprocessing/createProformaInvoice">
												   <div class="panel panel-default" id="indentProduct">
												    
												  
							                           <div class="panel-heading">
                         Enter Values of the Proforma Invoice 
                        </div>					
							<div class="panel-body">
							 <p id="loading3"></p>
												<div class="row">

												<div class="col-lg-6">
												<label>Unit Size</label>
												<input type="text" id="UnitSize" class="form-control input-sm"name="UnitSize" style="width:95%">	
												</div>
												<div class="col-lg-6">
												<label>Gross Weight</label>
												<input type="text" id="GrossWeight" class="form-control input-sm"name="GrossWeight" style="width:95%">	
												</div>
												</div>
												<div class="row">
													
												
													<div class="col-lg-6">
													
												<label>Total Packages</label>
												<input type="text" id="PackagesReceived" class="form-control input-sm"name="PackagesReceived" style="width:95%">	
												
												</div>
												<div class="col-lg-6">
													
												<label>Total Value</label>
												<input type="text" id="TotalValue" class="form-control input-sm"name="TotalValue" style="width:95%">	
												
												</div>
												</div>
												<div class="row">
												
													<div class="col-lg-6">
													<div class="form-group">
												<label>Net Weight</label>
												<input type="text" id="NetWeight" class="form-control input-sm"name="NetWeight" style="width:95%">	
												</div>
												</div>
													
												
												
												</div>
												</div>
													</div>
													</small>
													<p id="loading" class="pull-left"></p>
							
																					<div class="col-lg-6">
												
												<input type="hidden" id="Country" class="form-control input-sm"name="Country" style="width:95%">	
												</div>
							 
							  </div>
							  <div class="col-lg-6" id="pendingIndents">
							  <p id="loadingxx"></p>
                    <div class="panel panel-default">
                        <div class="panel-heading">
				
							 
							 
						   Particulars of Commodities of Selected Indent

                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
									
                            <div class="table-responsive table-bordered" style="" >
	<p></p>					<div class="dataTable_wrapper" style="width:1000px;height:185px" id="pendingInvoices">	

           
                            </div>
							</div>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
							                     <div class="panel panel-default">
                        <div class="panel-heading">
                            Details of Selected Indent 
                        </div>
                        <!-- /.panel-heading -->
<div class="panel-body">												
					<div class="row">
						<div class="col-lg-6">
					<label>Date Received</label>
					<input type="text" id="DateReceived" class="form-control input-sm"name="DateReceived" style="width:95%">	
					</div>
					<div class="col-lg-6">
						<div class="form-group">
					<label>Proforma Invoice No</label>
					<input type="text" id="" class="form-control input-sm"name="Invoice" style="width:95%">	
						</div>
					</div>
					</div>
					<div class="row">
						<div class="col-lg-6">
						
																	
						</div>
						
					</div>
						</div>
							 
								  </div>
							
							  </div>
<input type="hidden" id="UnitsPerPack" class=""name="UnitsPerPack" value="" style="width:97%">
<input type="hidden" id="QttyUnits" class=""name="QttyUnits" value="" style="width:25%">	
<input type="hidden" id="ValuePerPack" class=""name="ValuePerPack" value="" style="width:25%">
<input type="hidden" id="UnitValue" class=""name="UnitValue" value="" style="width:25%">
<input type="hidden" id="UnitValueKsh" class=""name="UnitValueKsh" value="" style="width:20%">
<input type="hidden" id="FullDescription" class=""name="FullDescription" value="" style="width:97%">
<input type="hidden" id="PackageType" class=""name="PackageType" value="" style="width:97%">		
<input type="hidden" id="IndentNo" class=""name="IndentNo" value="" style="width:97%">						  
 <input   type="submit" id="saveProformaInvoice" value="Save  Details" class="btn btn-success btn-sm pull-right"/>
							<p id="invoiceloading"></p>
</form>
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
	function ShowCommodityUnderIndent(x)
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
	   $(".select2").select2(); 
	 document.getElementById("pendingIndents").innerHTML= xmlhttp.responseText;
    }
  }

  document.getElementById("loadingxx").innerHTML="<img src='<?php echo base_url().'SmallLoading.gif'?>'> Loading...";
xmlhttp.open("POST","<?php echo base_url()?>invoiceprocessing/ShowCommodityUnderIndent?Indent="+x,true);
xmlhttp.send();
}

	function ShowCommodityUnderIndentProduct(x,y)
{
var ExchRate = $('#ExchRate').val();
if(ExchRate==""){
document.getElementById("indentProduct").innerHTML="<font color='red'>This Week's Customs Exchange(Selling) Rate for the Selected Currency is Missing. Please Consult System Administrator and Try again.</font>";
return;
}
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
 	  document.getElementById("loading3").innerHTML='';
	 document.getElementById("indentProduct").innerHTML= xmlhttp.responseText;
    }
  }

  document.getElementById("loading3").innerHTML="<img src='<?php echo base_url().'SmallLoading.gif'?>'> Loading...";
xmlhttp.open("POST","<?php echo base_url()?>invoiceprocessing/ShowCommodityUnderIndentProduct?ProductCode="+x+"&indentNo="+y,true);
xmlhttp.send();
}


</script>

</body>

</html>
