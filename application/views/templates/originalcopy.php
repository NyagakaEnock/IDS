
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
                    <div class="panel panel-primary" >
                        <div class="panel-heading" >
                        					<div class="row">
						<form role="form" id="neworders" action="Reports/SaveNewOrders/">
						<div class="col-lg-6">
                         Proforma Invoice
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
                        <div class="panel-body" style="font-family:Times New Roman">
                          <div id="header" align="center">
						  <h3>KENYA WINE AGENCIES LTD</h3>
						  <h4>Confirmed Supplier Copy</h2>
						  <div class="col-lg-4">
						  	<?php if(isset($printconfirmedOriginal))
	{
	if($printconfirmedOriginal!=NULL)
	{
		foreach($printconfirmedOriginal as $key)
		{
		$ExporterCode = $key->ExporterCode;
		$IndentNo = $key->IndentNo;
	?>
                            Print Options <select class="form-control select2" style="width:58%;" name="IndentNo" onchange="preview(this.value,'<?php echo $IndentNo?>')">
														<option ></option>
														<option value="Original">Original Copy</option>
														<option value="BlueCopy">Blue Copy</option>
														<option value="GreenCopy">Green Copy</option>
														</select>
			<?php 
		}
	}
	}
			?>
														
                        </div>
						  </div>
						  
						  <div>
	<?php if(isset($printconfirmedOriginal))
	{
	if($printconfirmedOriginal!=NULL)
	{
		foreach($printconfirmedOriginal as $key)
		{
		$ExporterCode = $key->ExporterCode;
		$IndentNo = $key->IndentNo;
	?>
	
	  <table width="100%"  style="border-top:2px solid #000">
	  	<tr >
		<td colspan="2" align="center">Indent No <?php echo $IndentNo?></td>
		<td colspan="">
		<?php echo substr($key->OrderDate,0,10)?></br>
		
		</td>
		
		</tr>
		<tr >
		<th style="">Please Supply to</th>
		<td colspan="">
		<?php echo $key->ImporterName?></br>
		<?php echo $key->PostalAddress." ".$key->TownCity.", ".$key->CountryName;?>
		</td>
		<td colspan="" align="center"><b>SHIPMENT</BR>MARKS</b></td>
	
		</tr>
		<tr >
		<th style="padding-top:7px" >Ship to the Port of</th>
		<td colspan=""><?php echo $key->ShipTo?> at first opportunity</td>
		<td rowspan="2" height="150px" width="150px" style="background-image: url('<?php echo base_url()?>dist/Indent.png');" align="center">
		 
		<b>KWAL</br>
		
		<P style="padding:7px"><?php echo $IndentNo?></p>
		
		<?php echo $key->ShipTo?></b>
	 
		</td>
		</tr>
		<tr >
		<th valign="top">Payment</th>
		<td colspan="" valign="top"><?php echo $key->TransTermName?> Bill from the Date of Shippment</br>
		<?php echo $key->BankName?>
		</br>
		<?php echo $key->ADDRESS." ".$key->Town." ".$key->CountryName?>
		</td>
		
		</tr>
		<tr  >
		<th colspan="3" style="padding:5px"></th>
		<tr  style="border:1px solid #000;">
		<td colspan="3" style="padding:5px" align="center">Detailed Documentation and Insurance Instructions are attached to this Indent</td>
		</tr>
		</table>	
		
	  <table width="100%" border="1px" style="margin-top:20px" >
		<tr >
		<th ><?php echo $key->PackageTypeName?></th>
		<th >Size</th>
		<td >
		Description
		</td>
		<td >
		<?php if(($key->PackageType!='PC') && ($key->PackageType!='UN'))
		{
			echo "PRICE PER UNIT (".$confirmedOriginalDetails[0]->Currency.")";
		}else{
			echo "INVOICE VALUE (".$confirmedOriginalDetails[0]->Currency.")";
		}?>
		</td>
		</tr>
	<?php if(isset($confirmedOriginalDetails))
	{
	if($confirmedOriginalDetails!=NULL)
	{
		$TotalPackages = 0;
		foreach($confirmedOriginalDetails as $key1)
		{
	?>
	<tr>
	<td><?php 
	
	echo number_format($key1->TotalPackages)?></td>
	<td>
		<?php if(($key->PackageType!='PC') && ($key->PackageType!='UN'))
		{
		 if($key->PackageType=='DR')
		 {
			echo number_format($key1->UnitSize)." ".$key1->QttyUnits; 
		 }else{
			 echo number_format($key1->UnitsPerPack)."/".number_format($key1->UnitSize).$key1->QttyUnits; 
		 }
		}?>	
	</td>
	<td style="width:60%">
	<?php if(($key->PackageType=='PC') || ($key->PackageType=='UN'))
		{
			echo number_format($key1->TotalPackages)." ".$key->PackageTypeName." OF ".$key1->ProductName;
		}else{
			echo $key1->ProductName;
		}
		?>
	</td>
	<td>
	<?php if(($key->PackageType!='PC') && ($key->PackageType!='UN'))
		{
			echo number_format($key1->FOBValue/$key1->TotalPackages);
			
		}else{
			
			echo number_format($key1->FOBValue);
		}
		?>
	</td>
	</tr>
	
	<?php
	$TotalPackages = $TotalPackages+$key1->TotalPackages;
		}
	}
	}
	?>
		<tr>
	<th valign="top"><?PHP ECHO $TotalPackages?></th>
	<td></td>
	<td><p ><?php echo $key->ConfirmMessage?></p></td>
	<td></td>
	</tr>
<tr  style="border:1px solid #000;border-bottom:double">
		<td colspan="4" style="padding:5px" align="center">Unit price subject to Commissions and Allowances which must be shown on Invoices</td>
		</tr>	
		</table>
<table width="100%" style="margin-top:20px">
<tr  style="border:1px solid #000;border:double">
	<td width="40%" valign="top" style="padding:10px;border-right:1px solid #000">
	<div width="100%" style="border-bottom:1px solid #000;border-bottom:dotted">To</div>
	<div width="100%" style="border-bottom:1px solid #000;border-bottom:dotted;margin-top:10px">
	<?php echo $key->ExporterName?></div>
	<div width="100%" style="border-bottom:1px solid #000;border-bottom:dotted;margin-top:10px">
	<?php echo $key->PhysicalAddress?>
	</div>
	<div width="100%" style="border-bottom:1px solid #000;border-bottom:dotted;margin-top:10px">
		<?php echo $key->PostalAddress?>
	</div>
	<div width="100%" style="border-bottom:1px solid #000;border-bottom:dotted;margin-top:10px">
		<?php echo $key->TownCity." ".$this->Reports_model->getExporterCountry($key->ExporterCode)[0]->CountryName?>
	</div>
	</td>
	<td>
	<div align="center" style="border-bottom:1px solid #000;padding:7px">
	Our Order Number must be quoted on all correspondence.
	</div>
	<div align="center" style="padding:7px">
	<b style="text-decoration:underline">FOR KENYA WINE AGENCIES LTD.</b>
	
	</div>
	<div align="" style="padding:10px">
	<p>PROCUREMENT MANAGER..................................................................... Date ................................</p>
	</div>
	<div align="" style="padding:5px">
	<p>Ag. FINANCE MANAGER............................................................................ Date ................................</p>
	</div>
	<div align="" style="padding:5px">
	<p>MANAGING DIRECTOR.............................................................................. Date ................................</p>
	</div>
	</td>
	</tr>
</table>		
<?php 
		}
	}
	}
?>		
						  
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
 	function preview(val,IndentNo)
 {  

	 if(val == "")
	 {
		 return;
	 } else {
		 
		
		 window.open("<?php echo base_url()?>Reports/"+val+"/"+IndentNo, '_blank');
	 }

 }
 
  	function loadData(val)
 {  

	 if(val == "")
	 {
		 return;
	 } else {
		 
		
		 window.location="<?php echo base_url()?>Reports/SupplierCopy/"+val;
	 }

 } 

	
</script>

</body>

</html>
