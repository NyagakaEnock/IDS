
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
                            New Indent Proforma Requests
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <!-- Nav tabs -->
							<?PHP
							$Indent = $this->uri->segment(3,"");
							?>
                            <ul class="nav nav-tabs">
                                <li class="<?php if($Indent!="") echo "";else echo "active";?>"><a href="#home" data-toggle="tab">Main Request Information</a>
                                </li>
                                <li class="<?php if($Indent!="") echo "active";else echo "";?>"><a href="#profile" data-toggle="tab">Commodities / Trade Products Data</a>
                                </li>
                              
                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div class=" <?php if($Indent!="") echo "tab-pane fade";else echo "tab-pane fade in active";?>" id="home">
                                    <h4></h4>
									<div class="row">
									<div class="col-lg-4">
									  <div class="panel panel-default">
                       
                        <!-- /.panel-heading -->
                        <div class="panel-body">
						
						 <form role="form" id="ProformaRequest" action="invoiceprocessing/createProformaRequest">
												<div class="form-group">
												<label>Select Type of Indent</label>
												<select class="form-control select2" style="width:95%"  onchange="fillIdentNo('IndentType',this.value)" >
												<option></option>
												<?php foreach($typeofIndents as $row):


												?>
												<option value="<?php echo $row->IndentType;?>"><?php echo $row->TypeofIndent;?></option>

												<?php

												endforeach;
												?>
												</select>
												<input type="hidden" id="IndentType" name="IndentType">
											
												</div>
												<div class="form-group">
												<label>Select Exporter/Supplier</label>
												<select class="form-control select2" style="width:95%"  onchange="fillcountryFax('ExporterCode',this.value)">
												<option></option>
												<?php foreach($get_Exporters as $row):


												?>
												<option value="<?php echo $row->ExporterCode;?>"><small><?php echo $row->ExporterName;?></small></option>

												<?php

												endforeach;
												?>
												</select>
												<input type="hidden" id="ExporterCode" name="ExporterCode">
												</div>
												<div id="countryFax">
												<div class="form-group">
												<label>Country of Supply</label>
												<select class="form-control select2" style="width:95%"  onchange="fillCombo('SupplyCountry',this.value)">
												<option></option>
												<?php foreach($ParamCountries as $row):


												?>
												<option value="<?php echo $row->Country;?>"><?php echo $row->CountryName;?></option>

												<?php

												endforeach;
												?>
												</select>
												<input type="hidden" id="SupplyCountry" name="SupplyCountry">
												</div>
												<div class="form-group">
												<label>Fax</label>
												
												<input type="text" id="Fax" class="form-control input-sm"name="Fax" style="width:95%">
												</div>
																								<div class="form-group">
												<label>Attention to</label>
												<select class="form-control select2" style="width:95%"  onchange="fillCombo('AttentionTo',this.value)">
												<option></option>
												<?php foreach($load_ParamEmpMaster as $row):


												?>
												<option value="<?php echo $row->AllNames;?>"><?php echo $row->AllNames;?></option>

												<?php

												endforeach;
												?>
												</select>
												<input type="hidden" id="AttentionTo" class="form-control input-sm"name="AttentionTo" style="width:95%">
												</div>
												</div>
												<div class="form-group">
												<label>Our Contact Name</label>
												<select class="form-control select2" style="width:95%"  onchange="fillCombo('ContactName',this.value)">
												<option></option>
												<?php foreach($load_ParamEmpMaster as $row):


												?>
												<option value="<?php echo $row->StaffIDNo;?>"><?php echo $row->AllNames;?></option>

												<?php

												endforeach;
												?>
												</select>
												<input type="hidden" id="ContactName" name="ContactName">
												</div>

												

						
						</div>
							
							
									</div>
									<p id="loading"></p>
									</div>
									
						
									<div class="col-lg-4">
									  <div class="panel panel-default">
                       
                        <!-- /.panel-heading -->
                        <div class="panel-body">
						
						 
										
												<div class="form-group">
												<label>Indent Number</label>
												<div id="intentNoDiv">
												<input type="text"  id="IndentNumber" name="IndentNumber" class="form-control input-sm" style="width:95%">

												<input type="hidden" class="form-control input-sm"  name="dateofrequest" value="<?php echo date("m/d/Y");?>" style="width:95%"/>
												</div>
												</div>
												<div class="form-group">
												<label>Expected Date</label>
												<div class="input-group">
												
												<div class="input-group-addon">
												<i class="fa fa-calendar"></i>
												</div>
												<input type="text" class="form-control input-sm" value="<?php 
													$date = date_create(date("m/d/Y"));
													
													date_add($date,date_interval_create_from_date_string("7 days"));
													echo date_format($date,"m/d/Y");
													?>" id="reservation2" name="reservation2" value="" style="width:95%"/>
												
												
												</div>
												</div>
												<div class="form-group">
												<label>Destination Store</label>
												<select class="form-control select2" style="width:95%"  onchange="fillCombo_Messages('BranchCode',this.value)">
												<option></option>
												<?php foreach($ParamCompanyBranch as $row):


												?>
												<option value="<?php echo $row->BranchCode;?>"><?php echo $row->BranchName;?></option>

												<?php

												endforeach;
												?>
												</select>
												<input type="hidden" id="BranchCode" name="BranchCode">
												</div>
										
												
												<div class="form-group">
												<label>Shipment Owner</label>
												<select class="form-control select2" style="width:95%"  onchange="fillCombo('OwnerNo',this.value)">
												<option></option>
												<?php foreach($ParamShipmentOwners as $row):


												?>
												<option value="<?php echo $row->OwnerNo;?>"><?php echo $row->OwnerName;?></option>

												<?php

												endforeach;
												?>
												</select>
												<input type="hidden" id="OwnerNo" name="OwnerNo">
												</div>
												<div class="form-group">
												<label>Order Number</label>
												
												<input type="text" id="OrderNumber" class="form-control input-sm"name="OrderNumber" style="width:95%">
												</div>
												
												<div class="form-group">
												<label>Carbon Copy to</label>
												
												<input type="text" id="CarbonCopy" class="form-control input-sm" name="CarbonCopy" style="width:95%">
												</div>

												

						
						</div>

							
						<p id="responce"></p>
						
									</div>
									</div>
									<div class="col-lg-4">
									  <div class="panel panel-default">
                       
                        <!-- /.panel-heading -->
                        <div class="panel-body">
						
						
										<div id="fillCombo_Messages">
												<div class="form-group">
												 <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" value="" id="DutyFree" disabled >Checked if Goods are of Duty-Free Shops
                                                </label>
												</div>
												<input type="hidden" id="employeeid" class="" name="country" style="width:50%">
												</div>
												<div class="form-group">
												<label>Subject</label>
												
												<input type="text" id="Subject" class="form-control input-sm" name="Subject" style="width:100%">
												</div>
												<div class="form-group">
												<label>Leading Message</label>

												<textarea rows="4" id="LeadingMessage" name="LeadingMessage"  class="form-control input-sm"></textarea>
												</div>
												<div class="form-group">
												<label>Clossing Message</label>

												<textarea rows="4" id="ClossingMessage" name="ClossingMessage"  class="form-control input-sm"></textarea>
												</div>
												
												<div class="form-group">
												<label>Other Information </label>
												
												<input type="text" id="OtherInformation" class="form-control input-sm"name="OtherInformation" style="width:100%">
												</div>
												<div class="form-group">
											
												
														</div>
										</div>		
													<input   type="submit" id="saveProformaRequest" value="Save  Details" class="btn btn-success btn-sm pull-right"/>
						 							 </form >


						
						</div>

							
						<p id="responce"></p>
						
									</div>
									</div>
									</div>
		
                                     </div>
                                <div class="<?php if($Indent!="") echo "tab-pane fade in active";else echo "tab-pane fade";?>" id="profile">
                                    <h4></h4>
                                   									<div class="row">
									<div class="col-lg-3">
									  <div class="panel panel-default">
                        <!-- /.panel-heading -->
                        <div class="panel-body">
							   <form role="form" id="ProformaRequestcommodity" action="invoiceprocessing/createProformaCommodity">
                                        <div class="form-group">
                                            <label>Select Indent Number</label>
                                  	<select class="form-control select2" style="width:95%"  onchange="fillComboLoadIndentNos('indentNo2',this.value)">
												<option id="indxxentNo2"><?php if(isset($IndentNumber))
												{
													echo $IndentNumber;
												}?></option>
												<?php foreach($LoadIndentNos as $row):


												?>
												<option value="<?php echo $row->SelectField;?>"><?php echo $row->SelectField;?></option>

												<?php

												endforeach;
												?>
												</select>
	<input class="form-control input-sm" type="hidden" name="indentNo2" id="indentNo2" placeholder="" value="<?php if(isset($IndentNumber))
												{
													echo $IndentNumber;
												}?>"style="width:95%">
										</div>
										
										<div id="productDetails">
										<div class="form-group">
                         <label>Name of Selected Product</label>
                        <input class="form-control input-sm" name="ProductName" id="ProductName"  disabled style="width:100%" placeholder="" >
						</div>
	                                        <div class="form-group">
                                            <label>Total Packages</label>
                                            <input class="form-control input-sm" name="request" placeholder="">
										</div>
										 <div class="form-group">
                                            <label>Unit Size</label>
                                            <input class="form-control input-sm" name="request" placeholder="" >
										</div>									
										<div class="form-group">
										 
                                        </div>
										
										</div>
										<button type="submit" id="RequestProduct" class="btn btn-success btn-sm">Save Details</button>
							</form>
						
						<p id="loading2"></p>
						</div>
									</div>
									</div>
									 <div class="col-lg-9">
									 																		<p></p>
								
					 <div id="MainData">
                    <div class="panel panel-default">
					<div class="row">
					<div class="col-lg-4">

			
						</DIV>

						</div>	
                        <div class="panel-heading">
                           Product Details
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
 <div  style="width:730px;height:330px;overflow-x:scroll;overflow-y:scroll">
 <div class="dataTable_wrapper" style="width:1500px;">
					 <input class="form-control input-sm" name="ExporterCode2"  id="ExporterCode2"  value="<?php 
					 $ExporterCode="";
					 if(isset($exporterCode))
							{
							echo $exporterCode;
							$ExporterCode = $exporterCode;
							}?>"  type="hidden" style="width:100%" placeholder="" >
											
						<font color="red">Select one Product From the List Below</font>
                                 <table class="table table-striped table-bordered table-hover" id="">
                                    <thead>
                                        <tr>
				<th ># </th>
				<th >Product Code </th>
				<th >Product Name </th>
				<th>Units/Pack </th>
				<th>UnitSize </th>
				<th>QttyUnits </th>
				<th style="width:200px">CommodityCode </th>
				<th style="width:100px">SITC. </th>
				<th>Department </th>
                                        </tr>
                                    </thead>
									
                                    <tbody>
			<?PHP 
			
			if(isset($LoadExporterProducts))
			{			
			foreach($LoadExporterProducts as $key)
			{
				if($this->invoiceprocessing_model->ItemsAlreadyExists($IndentNumber,$key->ProductCode)==NULL)
					
			{
			?>
			<tr class="odd gradeX" >
			<td><input type="radio" name="product" onchange="loadProdctDetails('<?php echo $key->ProductCode?>')"></td>
			<td style="width:15%"><?php echo $key->ProductCode?></td>
			<td style="width:25%"><?php echo $key->ProductName?></td>
			<td style="width:10%"><?php echo $key->UnitsPerPack?></td>
			<td class="center" style="width:5%"><?php echo $key->PackageSize?></td>
			<td class="center" style="width:10%"><?php echo $key->QttyUnits?></td>
			
			<td><?php echo $key->CommodityCode?> </td>
			<td style="width:100px"><?php echo $key->SITC?></td>
			<td><?php echo $key->Depart?></td>
			</tr>
			<?php
			}
			}
			}
			?>

                                    </tbody>
									
                                </table>
								
                            </div>
							</div>
</div>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                           
									</div>      </div>
                       
				
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
 	function fillIdentNo(Id,val)
 {  

	 if(val == "")
	 {
		 return;
	 } else {
		 
		 document.getElementById(Id).value = val
	
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
	

		
 	  document.getElementById("loading").innerHTML='';
	 document.getElementById("intentNoDiv").innerHTML= xmlhttp.responseText;
	 
		 	document.getElementById("indentNo2").value = document.getElementById("IndentNumber").value;
    }
  }

  document.getElementById("loading").innerHTML="<img src='<?php echo base_url().'SmallLoading.gif'?>'> Loading...";
xmlhttp.open("POST","<?php echo base_url()?>invoiceprocessing/getIndentNo?getIndentNo="+val,true);
xmlhttp.send();

	 } 
 }
 
  	function fillcountryFax(Id,val)
 {  

	 if(val == "")
	 {
		 return;
	 } else {
		 
		 document.getElementById(Id).value = val
	
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

 	  document.getElementById("loading").innerHTML='';
	 //  $(".select2").select2();  
	 document.getElementById("countryFax").innerHTML= xmlhttp.responseText;
	  $(".select2").select2();  
    }
  }

  document.getElementById("loading").innerHTML="<img src='<?php echo base_url().'SmallLoading.gif'?>'> Loading...";
xmlhttp.open("POST","<?php echo base_url()?>invoiceprocessing/getcountryFax?countryFax="+val,true);
xmlhttp.send();

	 } 
 }
 
   	function fillCombo_Messages(Id,val)
 {  

	 if(val == "")
	 {
		 return;
	 } else {
		 
		 document.getElementById(Id).value = val
	
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

 	  document.getElementById("loading").innerHTML='';
	  $('#fillCombo_Messages').load('<?php echo base_url()?>invoiceprocessing/getMessages?Messages='+val);
	 //document.getElementById("fillCombo_Messages").innerHTML= xmlhttp.responseText; 
	
    }
  }

  document.getElementById("loading").innerHTML="<img src='<?php echo base_url().'SmallLoading.gif'?>'> Loading...";
xmlhttp.open("POST","<?php echo base_url()?>invoiceprocessing/getMessages?Messages="+val,true);
xmlhttp.send();

	 } 
 }
    	function fillComboLoadIndentNos(Id,val)
 {  

	 if(val == "")
	 {
		 return;
	 } else {
		 
		 document.getElementById(Id).value = val
	
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

 	
	 document.getElementById("MainData").innerHTML= xmlhttp.responseText; 
	 	var exporterCode = document.getElementById('ExporterCode2').value ;
	   $('#MainData').load("<?php echo base_url()?>invoiceprocessing/loadMainData?LoadIndentNosID="+val+"&exporterCode="+exporterCode);
	   $('table').filterTable({ // apply filterTable to all tables on this page
            inputSelector: '#input-filter' // use the existing input instead of creating a new one
        });
  document.getElementById("loading2").innerHTML='';

    }
  }
 document.getElementById("loading2").innerHTML="<img src='<?php echo base_url().'SmallLoading.gif'?>'> Loading...";
xmlhttp.open("POST","<?php echo base_url()?>invoiceprocessing/loadMainData?LoadIndentNosID="+val,true);
xmlhttp.send();
	 } 
 }

						
			function loadCountry(x){
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
 	  document.getElementById("loading2").innerHTML='';
	 document.getElementById("productDetails").innerHTML= xmlhttp.responseText;
    }
  }

  document.getElementById("loading2").innerHTML="<img src='<?php echo base_url().'SmallLoading.gif'?>'> Loading...";
xmlhttp.open("POST","<?php echo base_url()?>invoiceprocessing/ParamCompanyBranch?BranchCode="+x,true);
xmlhttp.send();
						}
			function loadProdctDetails(x){
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
 	  document.getElementById("loading2").innerHTML='';
	 document.getElementById("productDetails").innerHTML= xmlhttp.responseText;
    }
  }

  document.getElementById("loading2").innerHTML="<img src='<?php echo base_url().'SmallLoading.gif'?>'> Loading...";
xmlhttp.open("POST","<?php echo base_url()?>invoiceprocessing/loadproductdetails?ProductCode="+x,true);
xmlhttp.send();
						}
						


	
</script>

</body>

</html>
