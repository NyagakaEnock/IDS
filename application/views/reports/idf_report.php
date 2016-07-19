<?php if(isset($printIDFRecord))
{
	$ProductsUnit = strrev($printIDFRecord[0]->UnitsPerPack);
	$UnitString = strrev(substr($ProductsUnit,-strlen($ProductsUnit)-3));
	$SizeString = $UnitString." ".$printIDFRecord[0]->QttyUnits;
	echo $SizeString;
?>
<body style="background-color:#FFFFFF;font-family: 'Times New Roman, Lucida Bright;">
<div class="container" width="100%">
<small>
			<div class="header" align="center"  style="border-bottom:0px solid #000000">
				<table  width="100%">
					<tr>
						<td valign="bottom" width="25%" >
						<B><?php echo $printIDFRecord[0]->IndentNo?></B></BR>
						<small><?php echo $printIDFRecord[0]->PSIAgency?></small>
						</td>
						<td  align="center" width="60%" valign="bottom" >
						<p  style="line-height: 140%"><b><font style="font-size:18px">REPUBLIC OF KENYA</font></b></BR>
						<font style="font-size:20px">KENYA REVENUE AUTHORITY</font></BR>
						<font style="font-size:20px">CUSTOMS & EXCISE DEPARTMENT</font></BR>
						<b><font style="font-size:25px">IMPORT DECLARATION FORM</font></b>
						</p>
						</td>
						<td valign="bottom">
						<small>FORM C61 r38A (4)</small></BR>
						<small>No</small>
						</td>
					</tr>
					
				
				</table>
			</div>
			<div class="header" align="center"  style="border-bottom:1px solid #000000">
				<table border="" width="100%">
					<tr>
						<td valign="top" width="50%"style="">
						<small>Importer Name and Address</BR>
						<?php echo $printIDFRecord[0]->ImporterName?></BR>
						<?php echo $printIDFRecord[0]->PostalAddress?></BR>
						<?php echo $printIDFRecord[0]->CountryNAMES?>
						
						</small>
						</td>
						<td valign="">
						<table width="100%">
						<tr>
						<td style="width:50%"  class=""><small>PIN</br>
						<?php echo $printIDFRecord[0]->PinNumber?></small></td>
						
						<td style=""  ><small>Contact Name
						<?php echo $printIDFRecord[0]->ContactNames?></small><small>
						</br>Contact Email
						<?php echo $printIDFRecord[0]->ContactEmail?></small></td>
						</tr>
						<tr>
						<td style="width:50%"><small>Telephone</small></br>
						
						<small>	<?php if($printIDFRecord[0]->CONTACTS)echo $printIDFRecord[0]->CONTACTS; else echo "N/A"?></small></td>
						<td class="" style=""><small>Fax / Telex</small>
						
						<small>	<?php echo $printIDFRecord[0]->FaxTelex?></small></td>
						</tr>
						</table>
						</td>
						
					</tr>
					
				
				</table>
				<table border="0px" width="100%">
					<tr>
						<td valign="top" width="50%" style="width:50%;border-left:1px solid #000000;">
						<small>Seller's Name and Address</BR>
						<?php echo $printIDFRecord[0]->ExporterNames?></BR>
						<?php echo $printIDFRecord[0]->PostAdress?>
						<br><?php echo $printIDFRecord[0]->CountryName?>
						
						</small>
						</td>
						<td valign="">
						<table width="100%">
						<tr>
						<td style="border-bottom:1px solid #000000;border-left:1px solid #000000;border-right:1px solid #000000;" colspan="2" ><small>Contact Name
						<?php echo $printIDFRecord[0]->ContactPerson?></small><small>
						<br>Contact Email
						<?php echo $printIDFRecord[0]->ContactEMail?></small></td></tr>
						<tr>
						<td style="border-left:1px solid #000000;width:50%;"><small>Telephone</small>
						
						<small>	<br><?php echo $printIDFRecord[0]->PhoneNo?></small></td>
						<td style="border-left:1px solid #000000;border-right:1px solid #000000;"><small>Fax / Telex</small>
						
						<small>	<br><?php echo $printIDFRecord[0]->FaxNo?></small></BR>
						</td>
						</tr>
						</table>
						</td>
						
					</tr>
					
				
				</table>
				<table border="0px" width="100%">
					<tr style="border-TOP:1px solid #000000;">
						<td valign="top" width="20%" style="width:20%;border-left:1px solid #000000;">
						<small>Country of Supply</BR>
						<?php echo $printIDFRecord[0]->CountryOrigin?></BR>
						
						</small>
						</td>
						<td valign="top" width="20%" style="width:20%;border-left:1px solid #000000;">
						<small>Post of Discharge (Ke)</BR>
						<?php echo $printIDFRecord[0]->PortDischarge?></BR>
						
						</small>
						</td>
						<td valign="top" width="20%" style="width:20%;border-left:1px solid #000000;">
						<small>Post of Customs Clearance</BR>
						<?php echo $printIDFRecord[0]->PortClearance?></BR>
						
						</small>
						</td>
						<td valign="top" width="20%" style="width:20%;border-left:1px solid #000000;">
						<small>Transport Mode</BR>
						<?php echo $printIDFRecord[0]->TransModeName?></BR>
						
						</small>
						</td>
						<td valign="top" width="20%" style="width:20%;border-left:1px solid #000000;border-right:1px solid #000000">
						<small>ETD</BR>
						<?php echo $printIDFRecord[0]->ETD?></BR>
						
						</small>
						</td>
						
					</tr>
					<tr style="border-TOP:1px solid #000000;">
						<td valign="top" width="20%" style="width:20%;border-left:1px solid #000000;">
						<small>COMESA</BR>
						<div border="1px" width="50px">
					<?php if($printIDFRecord2[0]->Comesa==1)echo "Yes"; else echo "No" ?>	
					</div>
						</small>
						</td>
						<td valign="top" width="20%" style="width:20%;border-left:1px solid #000000;">
						<small>Original Certificate Ref</BR>
						<?php echo $printIDFRecord[0]->OriginalCert?></BR>
						
						</small>
						</td>
						<td valign="top" width="20%" style="width:20%;border-left:1px solid #000000;">
						<small>Transaction Terms 
						<?php echo $printIDFRecord[0]->TransactionTerms?></BR>
						Local Inspection (Y/N) 
						<?php if($printIDFRecord2[0]->LocalInsp==1)echo "Yes"; else echo "No"?></BR>
						</small>
						</td>
						<td valign="top" width="20%" style="width:20%;border-left:1px solid #000000;">
						<small>Proforma Inv. No</small>
						<?php echo $printIDFRecord[0]->ProfInvoiceNo?></br>
						<small class=""> Proform Date</small>
						
						<small class="">
						<?php echo substr($printIDFRecord[0]->ProfInvoiceDate,0,10)?>
						</small>
						</td>
						<td valign="top" width="20%" style="width:20%;border-left:1px solid #000000;border-right:1px solid #000000">
						<small>Incoterm</BR>
						<?php echo $printIDFRecord[0]->IncoTerm?></BR>
						
						</small>
						</td>
						
					</tr>
					<tr style="border-TOP:1px solid #000000;">
						<td valign="top" width="20%" style="width:20%;border-left:1px solid #000000;">
						<small>Currency</small><small class="pull-right"> Exch Rate</small></br>
						<?php echo $printIDFRecord[0]->MYCURRENCY?>
						
						<small class="pull-right">
						<?php echo substr($printIDFRecord[0]->MYRATE,0,10)?>
						</small>
						</td>
						<td valign="top" width="20%" style="width:20%;border-left:1px solid #000000;">
						<small>FOB Value</BR>
						<?php echo $printIDFRecord[0]->TotalFOBValue?></BR>
						
						</small>
						</td>
						<td valign="top" width="20%" style="width:20%;border-left:1px solid #000000;">
						<small>Freight</BR>
						<?php echo $printIDFRecord[0]->FreightString?></BR>
						
						</small>
						</td>
						<td valign="top" width="20%" style="width:20%;border-left:1px solid #000000;">
						<small>Insurance</BR>
						<?php echo $printIDFRecord[0]->InsuranceString?></BR>
						
						</small>
						</td>
						<td valign="top" width="20%" style="width:20%;border-left:1px solid #000000;border-right:1px solid #000000">
						<small>Other Charges</BR>
						<?php if($printIDFRecord[0]->OtherChargesValue==0)echo "N/A"; else echo $printIDFRecord[0]->Currency." ".$printIDFRecord[0]->OtherChargesValue; ?>
						
						</small>
						</td>
						
					</tr>
				
				</table>
				<table>
					<tr style="border-TOP:1px solid #000000;">
						<td valign="top" width="" style="width:3%;border-left:1px solid #000000;">
						<small>New/Used </BR>Year</BR>
						
						</small>
						</td>
						<td valign="top" width="20%" style="width:50%;border-left:1px solid #000000;">
						<small>Full Description & Applicable Standards</BR>
						
						</small>
						</td>
						<td valign="top" width="20%" style="width:3%;border-left:1px solid #000000;">
						<small>C. of Origin</BR>
							
						</small>
						</td>
						<td valign="top" width="15%" style="width:6%;border-left:1px solid #000000;">
						<small>HS Code</BR>
						
						</small>
						</td>
						<td valign="top" width="10%" style="width:5%;border-left:1px solid #000000;">
						<small>Quantity</BR>
						
						</small>
						</td>
						<td valign="top" width="10%" style="width:5%;border-left:1px solid #000000;">
						<small>Units of Qty</BR>
						
						</small>
						</td>
						<td valign="top" width="15%" style="width:10%;border-left:1px solid #000000;border-right:1px solid #000000">
						<small>FOB Value</BR>
						
						</small>
						</td>
					</tr>
					<?php 
					foreach($printIDFRecord as $key)
					{
						$ProductString = $printIDFRecord[0]->UnitsPerPack;
						?>
						<tr style="border-TOP:1px solid #000000;">
						<td valign="top" width="" style="width:3%;border-left:1px solid #000000;">
						<small><?php echo $printIDFRecord[0]->NewUsedString?>
						
						</small>
						</td>
						<td valign="top" width="20%" style="width:50%;border-left:1px solid #000000;">
						<small><?php if($printIDFRecord[0]->OtherChargesValue=="PD")echo $printIDFRecord[0]->ProductName1; else echo $printIDFRecord[0]->ProductName1." ".$printIDFRecord[0]->OtherChargesValue; ?></BR>
						</small>
						</td>
						<td valign="top" width="20%" style="width:3%;border-left:1px solid #000000;">
						<small><?php echo $printIDFRecord[0]->Country?>
							
						</small>
						</td>
						<td valign="top" width="15%" style="width:6%;border-left:1px solid #000000;">
						<small><?php echo $printIDFRecord[0]->NewCommodityCode?>
						
						</small>
						</td>
						<td valign="top" width="10%" style="width:5%;border-left:1px solid #000000;">
						<small><?php echo $printIDFRecord[0]->TotalPackages?>
						
						</small>
						</td>
						<td valign="top" width="10%" style="width:5%;border-left:1px solid #000000;">
						<small><?php echo $printIDFRecord[0]->PackageType?>
						
						</small>
						</td>
						<td valign="top" width="15%" style="width:10%;border-left:1px solid #000000;border-right:1px solid #000000">
						<small><?php echo $printIDFRecord[0]->FOBValue?>
						</small>
						</td>
					</tr>
						<?php
						
					}
					
					?>
				<tr style="border:1px solid #000000;">
				<td colspan="7" align="center">
				<small>
				This IDF is issued by the Kenya Liaison office of the prescribed pre-Shipment Inspection Agent in Accordance with the Customs and Excise Regulations. The information contained herein is as declared by named importer, and as for the sole use of the Government of Kenya. This declaration does not in any way relieve the named importer of it's legal liability to comply with the Kenyan Laws.
				
				<p>I/We declare that the above particulars are true and correct.</p>
				Name: <?php echo $printIDFRecord[0]->AllNames?> Signature: .................................................................................. Date: <?php echo date('Y-m-d')?>
						
						
				</small>
				</td>
				</tr>
				</table>
				<table width="100%">
				<tr style="border-TOP:1px solid #000000;">
				<td  align="center" style="border-TOP:1px solid #000000;width:25%;border-left:1px solid #000000">
				<small>
							
				</small>
				</td>
				<td align="" style="border-left:1px solid #000000;width:50%">
				<small>
					PSI Confirmation to Sell: <?php if($printIDFRecord2[0]->PSIConfirm==1)echo "Yes"; else echo "No" ?>	</br>
					Intervention Code:</br>
					
					GOK Processing Fee: <?php echo $printIDFRecord[0]->GOKFee?></br>
					Prepaid Amount (KSh): <?php echo $printIDFRecord[0]->PrepaidAmount?></br>
					Receipt Number:</br>
					Serial Number:
					
				</small>
				</td>
				<td  align="center" style="border-left:1px solid #000000;width:25%;border-right:1px solid #000000">
				<small>
					Prior Approval Applicable? 
					<div border="1px" width="50px">
					<?php if($printIDFRecord2[0]->PriorApproval==1)echo "Yes"; else echo "No" ?>	
					</div>
				</small>
				</td>
				</tr>
				</table>
			</div>
		
		</small>
</div>	
</body>
<?php	
}
?>
