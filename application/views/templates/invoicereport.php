
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
						  <h4>Proforma Invoice</h2>
						  </div>
						  
						  <div id="loading2">
						

	<?php if(isset($printInvoiceOrders))
	{
	if($printInvoiceOrders!=NULL)
	{
		foreach($printInvoiceOrders as $key)
		{
		$ExporterCode = $key->ExporterCode;
		$IndentNo = $key->IndentNo;
	?>
	<a class="btn btn-primary btn-sm" href="<?PHP ECHO base_url()?>Reports/invoicePreview/<?php echo $IndentNo?>" target="blank">Print Preview</a>
	  <table width="100%" >
		<tr style="border-bottom:1px solid #000;">
		<th style="padding:7px">To</th>
		<th colspan=""><?php echo $key->ExporterName?></th>
		<th colspan="">Carborn Copy</th>
		<th colspan=""><?php echo $key->CarbonCopy?></th>
		</tr>
		<tr style="border-bottom:1px solid #000">
		<th style="padding:7px">Fax No</th>
		<th colspan=""><?php echo $key->FaxNo?></th>
		<th colspan="">Date</th>
		<th colspan=""><?php echo substr($key->IndentDate,0,10)?></th>
		</tr>
		<tr style="border-bottom:1px solid #000">
		<th style="padding:7px">Attention To</th>
		<th colspan=""><?php echo $key->AttentionTO?></th>
		<th colspan="">No of Sheets</th>
		<th colspan=""><?php echo 1?></th>
		</tr>
		</table>	
		<h5 style="text-decoration:underline"><b>SUB: <?php echo $key->Subject?></b></h5>
		<p>
		<?php echo $key->LeadMessage?>
		</p>
		 <table width="100%"  border="1px">
		<tr >
		<th style="padding:0px">Quantity</th>
		<th colspan="">Size</th>
		<th colspan="">Description</th>
		</tr>
		<?php if(isset($printInvoice))
	{
	if($printInvoice!=NULL)
	{
		$TotalPacks=0;
		foreach($printInvoice as $key1)
		{
		$TotalPackages = $key1->PackagesOrdered;
		$StringPackage = number_format($TotalPackages)." ".$key->PackageType;
	?>
	<tr style="border-bottom:1px solid #000">
	<td colspan=""><?php echo $StringPackage?></td>
	<td colspan=""><?php echo number_format($key1->UnitsPerPack)."/".number_format($key1->UnitSize)." ".$key1->QttyUnits?></td>
		
		<td colspan=""><?php echo $key1->ProductName?></td>
		</tr>
	
	<?php
	$TotalPacks = $TotalPacks+$TotalPackages; 
		}
	}
	}
	?>
	<tr>
	<td colspan="3"><?php echo number_format($TotalPacks)." ".$key->PackageTypeName?></td>
		</tr>
		</table>
		<p>
		<?php echo $key->ClosingMessage?>
		</p>
		<p>
		<?php echo $key->OtherInformation?>
		</p>
		
		<p>
		<?php //echo $key->OtherInformation?>
		</p>
		<p>
		<?php echo $key->AllNames?>
		</p>
		<p style="text-decoration:underline"><b>
		<?php echo $key->JobName?>
		</b>
		</p>
		
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
 	function loadData(val)
 {  

	 if(val == "")
	 {
		 return;
	 } else {
		 
		 window.location="<?php echo base_url()?>Reports/invoice/"+val;
	 }

 }
 
  

	
</script>

</body>

</html>
