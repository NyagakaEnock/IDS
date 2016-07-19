
<body style="background-color:#FFF;font-family:Times New Roman">
	<small>
	<div class="container">
	
		<div style="margin-top:240px">
		<h2>FAX</h2>
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
	
	</small>
</body>