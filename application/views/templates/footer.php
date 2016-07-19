    <script src="<?php echo base_url()?>bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo base_url()?>bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="<?php echo base_url()?>bower_components/metisMenu/dist/metisMenu.min.js"></script>

    <!-- Morris Charts JavaScript -->
    <script src="<?php echo base_url()?>bower_components/raphael/raphael-min.js"></script>
    <script src="<?php echo base_url()?>bower_components/morrisjs/morris.min.js"></script>
    <script src="<?php echo base_url()?>js/morris-data.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="<?php echo base_url()?>dist/js/sb-admin-2.js"></script>
	 <script src="<?php echo base_url()?>dist/js/app.js"></script>
	 <script src="<?php echo base_url()?>dist/js/select2/select2.full.min.js" type="text/javascript"></script>
	  <script src="<?php echo base_url()?>dist/js/datepicker/bootstrap-datepicker.js" type="text/javascript"></script>
	<script src="<?php echo base_url()?>bower_components/datatables/media/js/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url()?>bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js"></script>
	  <script src="<?php echo base_url()?>dist/js/jquery.filtertable.min.js"></script>
	    <script src="<?php echo base_url()?>dist/js/slimScroll/jquery.slimscroll.min.js" type="text/javascript"></script>
		 <script src="<?php echo base_url()?>dist/js/jquery.blockUI.js" type="text/javascript"></script>
		
  <script type="text/javascript">
    $(document).ready(function() {
        $('table').filterTable({ // apply filterTable to all tables on this page
            inputSelector: '#input-filter' // use the existing input instead of creating a new one
        });
    });
	 </script>
	 	     <script type="text/javascript">
 $(".select2").select2();  
    </script>
		 <script>
    $(document).ready(function() {
		 $('#reservation2').datepicker();
		 $('#reservation3').datepicker();
		 
        $('#dataTables-example').DataTable({
		 "scroll": "100px",
          responsive: false
        });
    });

    </script>
	<script>
$("#saveProformaRequest").click(function () {
 var dataString = $('#ProformaRequest').serialize(); 
var Subject = $("#Subject").val();
var LeadingMessage = $("#LeadingMessage").val();
var ClossingMessage = $("#ClossingMessage").val();
var DutyFree = $("#DutyFree").val();
var country = $("#country").val();
var IndentNumber = $("#IndentNumber").val();
var OtherInformation = $("#OtherInformation").val();
var exporterCode = document.getElementById('ExporterCode').value ;
			
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
			//document.getElementById("loading").innerHTML= xmlhttp.responseText;
			var response = xmlhttp.responseText;
			
				if(response=="Record Saved Successfully")
				{
				
					    $.blockUI({message: '<h3>Record Saved Successfully</h3>'}); 
						setTimeout(function() { 
						$.unblockUI({ 
						onUnblock: function(){ 
						window.location="<?php echo base_url()?>invoiceprocessing/proformarequests/"+exporterCode+"/"+IndentNumber;
						} 
						}); 
						}, 2000); 
				}else{
					document.getElementById("loading").innerHTML=response;
				}
			}
			}

			document.getElementById("loading").innerHTML="<img src='<?php echo base_url().'SmallLoading.gif'?>'> Loading...";
			
			xmlhttp.open("POST","<?php echo base_url()?>"+$('#ProformaRequest').attr('action')+"?Subject="+
				Subject+"&LeadingMessage="+LeadingMessage+"&ClossingMessage="+
				ClossingMessage+"&OtherInformation="+OtherInformation+"&DutyFree="+
				DutyFree+"&country="+country+"&IndentNumber="+IndentNumber+"&"+dataString,true);
			xmlhttp.send(dataString);
		
 return false;
    });
	$("#RequestProduct").click(function () {
		var dataString = $('#ProformaRequestcommodity').serialize(); 
		var val = $("#indentNo2").val();
		var ExporterCode2 = $("#ExporterCode2").val();
		var ProductCode = 	$("#ProductCode").val();
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
			var response = xmlhttp.responseText;
			var exporterCode = document.getElementById('ExporterCode2').value ;
 $('#MainData').load("<?php echo base_url()?>invoiceprocessing/loadMainData?LoadIndentNosID="+val+"&exporterCode="+exporterCode+"&ProductCode="+ProductCode);

					document.getElementById("loading2").innerHTML=response;
				
			}
			}

			document.getElementById("loading2").innerHTML="<img src='<?php echo base_url().'SmallLoading.gif'?>'> Loading...";
			
			xmlhttp.open("POST","<?php echo base_url()?>"+$('#ProformaRequestcommodity').attr('action')+"?ExporterCode2="+ExporterCode2+"&"+dataString,true);
			xmlhttp.send(dataString);
	 return false;
	});
			$("#comoditySearch").click(function () {
			
		 var dataString = $('#ProformaRequestcommoditySearch').serialize(); 
		 var indentNo2 =  $('#indentNo2').val();
		 var ExporterCode = $('#ExporterCode2').val();
		var comoditySearch2 = $('#comoditySearch2').val();
		
		 document.getElementById("loading2").innerHTML="<img src='<?php echo base_url().'SmallLoading.gif'?>'> Loading...";
            $.ajax({
                type: "POST",
                url: '<?php echo base_url()?>'+$('#ProformaRequestcommoditySearch').attr('action')+"?indentNo2="+indentNo2+"&ExporterCode2="+ExporterCode+"&comoditySearch="+comoditySearch2,
                data: dataString,
                timeout: 6000,
                error: function (request, error) {
				
                },
                success: function (response) {
				 
$('#MainData').load('<?php echo base_url()?>'+$('#ProformaRequestcommoditySearch').attr('action')+"?indentNo2="+indentNo2+"&ExporterCode2="+ExporterCode+"&comoditySearch="+comoditySearch2);
			   document.getElementById('loading2').innerHTML="";
					
                    
                }
			
            });
	  

		 return false;
		});
 $("#ProformaSearch").click(function () {
  var dataString = $('#PendingInvoiceSearch').serialize();
 
   document.getElementById("loading").innerHTML="<img src='<?php echo base_url().'SmallLoading.gif'?>'> Loading...";
            $.ajax({
                type: "POST",
                url: '<?php echo base_url()?>'+$('#PendingInvoiceSearch').attr('action')+"?"+dataString,
                data: dataString,
                timeout: 6000,
                error: function (request, error) {
				
                },
                success: function (response) 
				{
				$('#pendingInvoices').load('<?php echo base_url()?>'+$('#PendingInvoiceSearch').attr('action')+"?"+dataString);
				
				document.getElementById("loading").innerHTML="";
                }
			
            });
			
			
	  return false;
});
 $("#saveProformaInvoice").click(function () {
	var dataString = $('#ProformaInvoice').serialize();
	var ProductName = $('#ProductName').html();
	var IndentNumber= $('#IndentNo').val();
	
	var DateReceived= $('#DateReceived').val();
	var Invoice= $('#Invoice').val();
	var InvoiceDate= $('#InvoiceDate').val();
	var Currency= $('#Currency').val();
	var Units= $('#Units').val();
	var ExchRate= $('#ExchRate').val();
	
	var UnitsPerPack= $('#UnitsPerPack').val();
   document.getElementById("invoiceloading").innerHTML="<img src='<?php echo base_url().'SmallLoading.gif'?>'> Loading...";
            $.ajax({
                type: "POST",
                url: '<?php echo base_url()?>'+$('#ProformaInvoice').attr('action')+"?"+dataString+"&IndentNumber="+IndentNumber+"&DateReceived="+DateReceived+"&Invoice="+Invoice+"&InvoiceDate="+InvoiceDate+"&ExchRate="+ExchRate+"&Units="+Units+"&Currency="+Currency+"&ProductName="+ProductName+"&UnitsPerPack="+UnitsPerPack,
                data: dataString,
                timeout: 6000,
                error: function (request, error) {
				
                },
                success: function (response) 
				{
					ShowCommodityUnderIndent(IndentNumber);
					 $(".select2").select2(); 
					document.getElementById("invoiceloading").innerHTML=response;
				 }
			
            });
			
			
	  return false;
});
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
	 document.getElementById("pendingIndents").innerHTML= xmlhttp.responseText;
    }
  }

  document.getElementById("loadingxx").innerHTML="<img src='<?php echo base_url().'SmallLoading.gif'?>'> Loading...";
xmlhttp.open("POST","<?php echo base_url()?>invoiceprocessing/ShowCommodityUnderIndent?Indent="+x,true);
xmlhttp.send();
}
 $("#saveProformaReminder").click(function () {
  var dataString = $('#ProformaReminder').serialize();

 var IndentNo = $('#IndentNo').val();
 var ImporterCode = $('#ImporterCode').val();
 var ExporterCode = $('#ExporterCode').val(); 
 var StaffIDNo = $('#StaffIDNo').val();
   document.getElementById("loadingxx").innerHTML="<img src='<?php echo base_url().'SmallLoading.gif'?>'> Loading...";
            $.ajax({
                type: "POST",
                url: '<?php echo base_url()?>'+$('#ProformaReminder').attr('action')+"?"+dataString+"&IndentNo="+IndentNo+"&ImporterCode="+ImporterCode+"&ExporterCode="+ExporterCode+"&StaffIDNo="+StaffIDNo,
                data: dataString,
                timeout: 6000,
                error: function (request, error) {
				
                },
                success: function (response) 
				{				
				document.getElementById("loadingxx").innerHTML=response;
                }
			
            });
			
			
	  return false;
});
 $("#createidfmain").click(function () {
  var dataString = $('#idfmain').serialize();

   document.getElementById("loadingxx").innerHTML="<img src='<?php echo base_url().'SmallLoading.gif'?>'> Loading...";
            $.ajax({
                type: "POST",
                url: '<?php echo base_url()?>'+$('#idfmain').attr('action'),
                data: dataString,
                timeout: 6000,
                error: function (request, error) {
				
                },
                success: function (response) 
				{				
							if(response=="Record Saved Successfully.")
				{
				
					    $.blockUI({message: '<h3>Record Saved Successfully.</h3>'}); 
						setTimeout(function() { 
						$.unblockUI({ 
						onUnblock: function(){ 
						window.location="<?php echo base_url()?>idf/idfShippingInfo";
						} 
						}); 
						}, 2000); 
				}else{
					document.getElementById("loadingxx").innerHTML=response;
				}
                }
			
            });
			
			
	  return false;
});

 $("#createidfshipping").click(function () {
  var dataString = $('#idfmainidfshipping').serialize();
   
   document.getElementById("loadingxx").innerHTML="<img src='<?php echo base_url().'SmallLoading.gif'?>'> Loading...";
            $.ajax({
                type: "POST",
                url: '<?php echo base_url()?>'+$('#idfmainidfshipping').attr('action'),
                data: dataString,
                timeout: 6000,
                error: function (request, error) {
				
                },
                success: function (response) 
				{				
			if(response=="Record Saved Successfully.")
				{
				
					    $.blockUI({message: '<h3>Record Saved Successfully.</h3>'}); 
						setTimeout(function() { 
						$.unblockUI({ 
						onUnblock: function(){ 
						window.location="<?php echo base_url()?>idf/idfitemsInfo";
						} 
						}); 
						}, 2000); 
				}else{
					document.getElementById("loadingxx").innerHTML=response;
				}
                }
			
            });
			
			
	  return false;
});

 $("#saveIDFShippingData").click(function () {
  var dataString = $('#idfmainidfshipping').serialize();
   
   document.getElementById("loadingxx").innerHTML="<img src='<?php echo base_url().'SmallLoading.gif'?>'> Loading...";
            $.ajax({
                type: "POST",
                url: '<?php echo base_url()?>'+$('#idfmainidfshipping').attr('action'),
                data: dataString,
                timeout: 6000,
                error: function (request, error) {
				
                },
                success: function (response) 
				{				
			if(response=="Record Saved Successfully.")
				{
				
					    $.blockUI({message: '<h3>Record Saved Successfully.</h3>'}); 
						setTimeout(function() { 
						$.unblockUI({ 
						onUnblock: function(){ 
						window.location="<?php echo base_url()?>confirmation/VerifyShipping";
						} 
						}); 
						}, 2000); 
				}else{
					document.getElementById("loading2").innerHTML=response;
				}
                }
			
            });
			
			
	  return false;
});
			$("#checkAll").click(function () {
				$('input:checkbox').not(this).prop('checked', this.checked);
			});

 $("#saveIDFItems").click(function () {
  var dataString = $('#IDFItems').serialize();
   
   var checkedValues = $('input[name="invoice"]:checked').map(function() {
    return this.value;
}).get();
var indentNo = $('#indentNo').val();
   document.getElementById("loading2").innerHTML="<img src='<?php echo base_url().'SmallLoading.gif'?>'> Loading...";
            $.ajax({
                type: "POST",
                url: '<?php echo base_url()?>'+$('#IDFItems').attr('action')+"?"+dataString+"&productIDS="+checkedValues+"&IndentNo="+indentNo,
                data: dataString,
                timeout: 6000,
                error: function (request, error) {
				
                },
                success: function (response) 
				{				
			if(response=="Record Saved Successfully.")
				{
				
					    $.blockUI({message: '<h3>Record Saved Successfully.</h3>'}); 
						setTimeout(function() { 
						$.unblockUI({ 
						onUnblock: function(){ 
						window.location="<?php echo base_url()?>idf/idfitemsInfo";
						} 
						}); 
						}, 2000); 
				}else{
					document.getElementById("loading2").innerHTML=response;
				}
                }
			
            });
			
			
	  return false;
});

 $("#updateIDFNo").click(function () {
  var dataString = $('#IDFNumber').serialize();
   document.getElementById("loading2").innerHTML="<img src='<?php echo base_url().'SmallLoading.gif'?>'> Loading...";
            $.ajax({
                type: "POST",
                url: '<?php echo base_url()?>'+$('#IDFNumber').attr('action')+"?"+dataString,
                data: dataString,
                timeout: 6000,
                error: function (request, error) {
				document.getElementById("loading2").innerHTML=request.status;
                },
                success: function (response) 
				{				
			if(response=="Record Saved Successfully.")
				{
				
					    $.blockUI({message: '<h3>Record Saved Successfully.</h3>'}); 
						setTimeout(function() { 
						$.unblockUI({ 
						onUnblock: function(){ 
						window.location="<?php echo base_url()?>idf/IDFNumber";
						} 
						}); 
						}, 2000); 
				}else{
					document.getElementById("loading2").innerHTML=response;
				}
                }
			
            });
			
			
	  return false;
});
 $("#safeAmendments").click(function () {
  var dataString = $('#Amendments').serialize();
  var IndentNo =  $('#IndentNo').val();
   document.getElementById("loading2").innerHTML="<img src='<?php echo base_url().'SmallLoading.gif'?>'> Loading...";
            $.ajax({
                type: "POST",
                url: '<?php echo base_url()?>'+$('#Amendments').attr('action')+"?"+dataString+"&IndentNo="+IndentNo,
                data: dataString,
                timeout: 6000,
                error: function (request, error) {
				document.getElementById("loading2").innerHTML=request.status;
                },
                success: function (response) 
				{				
			if(response=="Record Saved Successfully.")
				{
				
					    $.blockUI({message: '<h3>Record Saved Successfully.</h3>'}); 
						setTimeout(function() { 
						$.unblockUI({ 
						onUnblock: function(){ 
						window.location="<?php echo base_url()?>idf/amendements";
						} 
						}); 
						}, 2000); 
				}else{
					document.getElementById("loading2").innerHTML=response;
				}
                }
			
            });
			
			
	  return false;
});
 $("#safeProductAmendments").click(function () {
  var dataString = $('#Amendments').serialize();
  var IndentNo =  $('#IndentNo').val();
   var ProductCode =  $('#ProductCode').val();
   document.getElementById("loading2").innerHTML="<img src='<?php echo base_url().'SmallLoading.gif'?>'> Loading...";
            $.ajax({
                type: "POST",
                url: '<?php echo base_url()?>'+$('#Amendments').attr('action')+"?"+dataString,
                data: dataString,
                timeout: 6000,
                error: function (request, error) {
				document.getElementById("loading2").innerHTML=request.status;
                },
                success: function (response) 
				{				
				document.getElementById("loading2").innerHTML=response;
                }
			
            });
			
			
	  return false;
});

 $("#safeProcesedAmendments").click(function () {
  var dataString = $('#Amendments').serialize();
   document.getElementById("loading2").innerHTML="<img src='<?php echo base_url().'SmallLoading.gif'?>'> Loading...";
            $.ajax({
                type: "POST",
                url: '<?php echo base_url()?>'+$('#Amendments').attr('action')+"?"+dataString,
                data: dataString,
                timeout: 6000,
                error: function (request, error) {
				document.getElementById("loading2").innerHTML=request.status;
                },
                success: function (response) 
				{				
				document.getElementById("loading2").innerHTML=response;
                }
			
            });
			
			
	  return false;
});
 $("#safeConfirmation").click(function () {
  var dataString = $('#Amendments').serialize();
  var counter =  $('#counter').val();
    var IndentNo =  $('#IndentNumber').val();
    var checkedValues = $('input[name="invoice"]:checked').map(function() {
    return this.value;
}).get();
					
   document.getElementById("loading2").innerHTML="<img src='<?php echo base_url().'SmallLoading.gif'?>'> Loading...";
            $.ajax({
                type: "POST",
                url: '<?php echo base_url()?>'+$('#Amendments').attr('action')+"?"+dataString+"&productIDS="+checkedValues+"&counter="+counter,
                data: dataString,
                timeout: 6000,
                error: function (request, error) {
				document.getElementById("loading2").innerHTML=request.status;
                },
                success: function (response) 
				{	
					
				if(response=="Record Saved Successfully.")
				{
				
					    $.blockUI({message: '<h3>Record Saved Successfully.</h3>'}); 
						setTimeout(function() { 
						$.unblockUI({ 
						onUnblock: function(){ 
						window.location="<?php echo base_url()?>confirmation/index/"+IndentNo;
						} 
						}); 
						}, 2000); 
				}else{
					document.getElementById("loading2").innerHTML=response;
				}
				
                }
			
            });
			
			
	  return false;
});
 $("#safeAcknowledement").click(function () {
  var dataString = $('#Amendments').serialize();
  var counter =  $('#counter').val();
    var checkedValues = $('input[name="invoice"]:checked').map(function() {
    return this.value;
}).get();
		
   document.getElementById("loading2").innerHTML="<img src='<?php echo base_url().'SmallLoading.gif'?>'> Loading...";
            $.ajax({
                type: "POST",
                url: '<?php echo base_url()?>'+$('#Amendments').attr('action')+"?"+dataString+"&productIDS="+checkedValues+"&counter="+counter,
                data: dataString,
                timeout: 6000,
                error: function (request, error) {
				document.getElementById("loading2").innerHTML=request.status;
                },
                success: function (response) 
				{	
					
				if(response=="Record Saved Successfully.")
				{
				
					    $.blockUI({message: '<h3>Record Saved Successfully.</h3>'}); 
						setTimeout(function() { 
						$.unblockUI({ 
						onUnblock: function(){ 
						window.location="<?php echo base_url()?>confirmation/acknowledgeOrders";
						} 
						}); 
						}, 2000); 
				}else{
					document.getElementById("loading2").innerHTML=response;
				}
				
                }
			
            });
			
			
	  return false;
});


 $("#safeShippingDocs").click(function () {
  var dataString = $('#Amendments').serialize();
  var counter =  $('#counter').val();
    var checkedValues = $('input[name="invoice"]:checked').map(function() {
    return this.value;
}).get();
		
   document.getElementById("loading2").innerHTML="<img src='<?php echo base_url().'SmallLoading.gif'?>'> Loading...";
            $.ajax({
                type: "POST",
                url: '<?php echo base_url()?>'+$('#Amendments').attr('action')+"?"+dataString+"&productIDS="+checkedValues+"&counter="+counter,
                data: dataString,
                timeout: 6000,
                error: function (request, error) {
				document.getElementById("loading2").innerHTML=request.status;
                },
                success: function (response) 
				{	
					
				if(response=="Record Saved Successfully.")
				{
				
					    $.blockUI({message: '<h3>Record Saved Successfully.</h3>'}); 
						setTimeout(function() { 
						$.unblockUI({ 
						onUnblock: function(){ 
						window.location="<?php echo base_url()?>doctracking/index";
						} 
						}); 
						}, 2000); 
				}else{
					document.getElementById("loading2").innerHTML=response;
				}
				
                }
			
            });
			
			
	  return false;
});
 $("#receiveDocument").click(function () {
  var dataString = $('#Amendments').serialize();
  var counter =  $('#counter').val();
    var checkedValues = $('input[name="invoice2"]:checked').map(function() {
    return this.value;
}).get();
	
   document.getElementById("loading2").innerHTML="<img src='<?php echo base_url().'SmallLoading.gif'?>'> Loading...";
            $.ajax({
                type: "POST",
                url: '<?php echo base_url()?>'+$('#Amendments').attr('action')+"?"+dataString+"&productIDS="+checkedValues+"&counter="+counter,
                data: dataString,
                timeout: 6000,
                error: function (request, error) {
				document.getElementById("loading2").innerHTML=request.status;
                },
                success: function (response) 
				{	
					
				if(response=="Record Saved Successfully.")
				{
				
					    $.blockUI({message: '<h3>Record Saved Successfully.</h3>'}); 
						setTimeout(function() { 
						$.unblockUI({ 
						onUnblock: function(){ 
						window.location="<?php echo base_url()?>doctracking/receivingdocuments";
						} 
						}); 
						}, 2000); 
				}else{
					document.getElementById("loading2").innerHTML=response;
				}
				
                }
			
            });
			
			
	  return false;
});

 $("#CommercialInvoice").click(function () {
  var dataString = $('#Amendments').serialize();
  var counter =  $('#counter').val();
    var checkedValues = $('input[name="invoice"]:checked').map(function() {
    return this.value;
}).get();
	
   document.getElementById("loading2").innerHTML="<img src='<?php echo base_url().'SmallLoading.gif'?>'> Please Wait. Computing Values...";
            $.ajax({
                type: "POST",
                url: '<?php echo base_url()?>'+$('#Amendments').attr('action')+"?"+dataString+"&productIDS="+checkedValues+"&counter="+counter,
                data: dataString,
                timeout: 6000,
                error: function (request, error) {
				document.getElementById("loading2").innerHTML=request.status;
                },
                success: function (response) 
				{	
					
				if(response=="Record Saved Successfully.")
				{
				
					    $.blockUI({message: '<h3>Record Saved Successfully.</h3>'}); 
						setTimeout(function() { 
						$.unblockUI({ 
						onUnblock: function(){ 
						window.location="<?php echo base_url()?>shiptracking";
						} 
						}); 
						}, 2000); 
				}else{
					document.getElementById("loading2").innerHTML=response;
				}
				
                }
			
            });
			
			
	  return false;
});


 $("#saveShippingType").click(function () {
  var dataString = $('#idfmain').serialize();
   document.getElementById("loading2").innerHTML="<img src='<?php echo base_url().'SmallLoading.gif'?>'> Loading...";
            $.ajax({
                type: "POST",
                url: '<?php echo base_url()?>'+$('#idfmain').attr('action')+"?"+dataString,
                data: dataString,
                timeout: 6000,
                error: function (request, error) {
				document.getElementById("loading2").innerHTML=request.status;
                },
                success: function (response) 
				{				
				if(response=="Record Saved Successfully.")
				{
				
					    $.blockUI({message: '<h3>Record Saved Successfully.</h3>'}); 
						setTimeout(function() { 
						$.unblockUI({ 
						onUnblock: function(){ 
						window.location="<?php echo base_url()?>shiptracking/ShippingDetails";
						} 
						}); 
						}, 2000); 
				}else{
					document.getElementById("loading2").innerHTML=response;
				}
                }
			
            });
			
			
	  return false;
});
 $("#saveShippingDetails").click(function () {
  var dataString = $('#Amendments').serialize();
   document.getElementById("loading2").innerHTML="<img src='<?php echo base_url().'SmallLoading.gif'?>'> Loading...";
            $.ajax({
                type: "POST",
                url: '<?php echo base_url()?>'+$('#Amendments').attr('action')+"?"+dataString,
                data: dataString,
                timeout: 6000,
                error: function (request, error) {
				document.getElementById("loading2").innerHTML=request.status;
                },
                success: function (response) 
				{				
				if(response=="Record Saved Successfully.")
				{
				
					    $.blockUI({message: '<h3>Record Saved Successfully.</h3>'}); 
						setTimeout(function() { 
						$.unblockUI({ 
						onUnblock: function(){ 
						window.location="<?php echo base_url()?>shiptracking/commoditiesInfo";
						} 
						}); 
						}, 2000); 
				}else{
					document.getElementById("loading2").innerHTML=response;
				}
                }
			
            });
			
			
	  return false;
});

 $("#saveInsuranceCover").click(function () {
  var dataString = $('#Amendments').serialize();
   document.getElementById("loading2").innerHTML="<img src='<?php echo base_url().'SmallLoading.gif'?>'> Loading...";
            $.ajax({
                type: "POST",
                url: '<?php echo base_url()?>'+$('#Amendments').attr('action')+"?"+dataString,
                data: dataString,
                timeout: 6000,
                error: function (request, error) {
				document.getElementById("loading2").innerHTML=request.status;
                },
                success: function (response) 
				{				
				if(response=="Record Saved Successfully.")
				{
				
					    $.blockUI({message: '<h3>Record Saved Successfully.</h3>'}); 
						setTimeout(function() { 
						$.unblockUI({ 
						onUnblock: function(){ 
						window.location="<?php echo base_url()?>shiptracking/InsuranceCover";
						} 
						}); 
						}, 2000); 
				}else{
					document.getElementById("loading2").innerHTML=response;
				}
                }
			
            });
			
			
	  return false;
});

 $("#SaveInstructions").click(function () {
  var dataString = $('#Amendments').serialize();
  var counter =  $('#counter').val();
    var checkedValues = $('input[name="invoice"]:checked').map(function() {
    return this.value;
}).get();
	
   document.getElementById("loading2").innerHTML="<img src='<?php echo base_url().'SmallLoading.gif'?>'> Please Wait. Computing Values...";
            $.ajax({
                type: "POST",
                url: '<?php echo base_url()?>'+$('#Amendments').attr('action')+"?"+dataString+"&productIDS="+checkedValues+"&counter="+counter,
                data: dataString,
                timeout: 6000,
                error: function (request, error) {
				document.getElementById("loading2").innerHTML=request.status;
                },
                success: function (response) 
				{	
					
				if(response=="Record Saved Successfully.")
				{
				
					    $.blockUI({message: '<h3>Record Saved Successfully.</h3>'}); 
						setTimeout(function() { 
						$.unblockUI({ 
						onUnblock: function(){ 
						window.location="<?php echo base_url()?>shiptracking/Instructions";
						} 
						}); 
						}, 2000); 
				}else{
					document.getElementById("loading2").innerHTML=response;
				}
				
                }
			
            });
			
			
	  return false;
});

 $("#SaveallocateWarehouse").click(function () {
  var dataString = $('#Amendments').serialize();
  var counter =  $('#counter').val();
    var checkedValues = $('input[name="invoice"]:checked').map(function() {
    return this.value;
}).get();
	
   document.getElementById("loading2").innerHTML="<img src='<?php echo base_url().'SmallLoading.gif'?>'> Please Wait. Computing Values...";
            $.ajax({
                type: "POST",
                url: '<?php echo base_url()?>'+$('#Amendments').attr('action')+"?"+dataString+"&productIDS="+checkedValues+"&counter="+counter,
                data: dataString,
                timeout: 6000,
                error: function (request, error) {
				document.getElementById("loading2").innerHTML=request.status;
                },
                success: function (response) 
				{	
					
				if(response=="Record Saved Successfully.")
				{
				
					    $.blockUI({message: '<h3>Record Saved Successfully.</h3>'}); 
						setTimeout(function() { 
						$.unblockUI({ 
						onUnblock: function(){ 
						window.location="<?php echo base_url()?>shiptracking/allocateWarehouse";
						} 
						}); 
						}, 2000); 
				}else{
					document.getElementById("loading2").innerHTML=response;
				}
				
                }
			
            });
			
			
	  return false;
});


 $("#saveCCRF").click(function () {
  var dataString = $('#Amendments').serialize();
    var checkedValues = $('input[name="invoice"]:checked').map(function() {
    return this.value;
}).get();
	
   document.getElementById("loading2").innerHTML="<img src='<?php echo base_url().'SmallLoading.gif'?>'> Please Wait. Computing Values...";
            $.ajax({
                type: "POST",
                url: '<?php echo base_url()?>'+$('#Amendments').attr('action')+"?"+dataString+"&productIDS="+checkedValues,
                data: dataString,
                timeout: 6000,
                error: function (request, error) {
				document.getElementById("loading2").innerHTML=request.status;
                },
                success: function (response) 
				{	
					
				if(response=="Record Saved Successfully.")
				{
				
					    $.blockUI({message: '<h3>Record Saved Successfully.</h3>'}); 
						setTimeout(function() { 
						$.unblockUI({ 
						onUnblock: function(){ 
						window.location="<?php echo base_url()?>shiptracking/CCRF";
						} 
						}); 
						}, 2000); 
				}else{
					document.getElementById("loading2").innerHTML=response;
				}
				
                }
			
            });
			
			
	  return false;
});
 $("#saveComoditiesInvoice").click(function () {
  var dataString = $('#Amendments').serialize();
  var counter =  $('#counter').val();
    var checkedValues = $('input[name="invoice"]:checked').map(function() {
    return this.value;
}).get();
	
   document.getElementById("loading2").innerHTML="<img src='<?php echo base_url().'SmallLoading.gif'?>'> Please Wait. Computing Values...";
            $.ajax({
                type: "POST",
                url: '<?php echo base_url()?>'+$('#Amendments').attr('action')+"?"+dataString+"&productIDS="+checkedValues+"&counter="+counter,
                data: dataString,
                timeout: 6000,
                error: function (request, error) {
				document.getElementById("loading2").innerHTML=request.status;
                },
                success: function (response) 
				{	
					
				if(response=="Record Saved Successfully.")
				{
				
					    $.blockUI({message: '<h3>Record Saved Successfully.</h3>'}); 
						setTimeout(function() { 
						$.unblockUI({ 
						onUnblock: function(){ 
						window.location="<?php echo base_url()?>shiptracking/commoditiesInfo";
						} 
						}); 
						}, 2000); 
				}else{
					document.getElementById("loading2").innerHTML=response;
				}
				
                }
			
            });
			
			
			
	  return false;
});
 $("#SaveExporter").click(function () {
  var dataString = $('#Amendments').serialize();
var ExporterCode = $('#ExporterCode').val();
   document.getElementById("loading2").innerHTML="<img src='<?php echo base_url().'SmallLoading.gif'?>'> Please Wait...";
            $.ajax({
                type: "POST",
                url: '<?php echo base_url()?>'+$('#Amendments').attr('action'),
                data: dataString,
                timeout: 6000,
                error: function (request, error) {
				document.getElementById("loading2").innerHTML=request.status;
                },
                success: function (response) 
				{	
					
				if(response=="Record Saved Successfully.")
				{
				
					    $.blockUI({message: '<h3>Record Saved Successfully.</h3>'}); 
						setTimeout(function() { 
						$.unblockUI({ 
						onUnblock: function(){ 
						window.location="<?php echo base_url()?>Settings/index/"+ExporterCode;
						} 
						}); 
						}, 2000); 
				}else{
					document.getElementById("loading2").innerHTML=response;
				}
				
                }
			
            });
			
			
	  return false;
});

 $("#assignProduct").click(function () {

  var dataString = $('#assign').serialize();
    var checkedValues = $('input[name="invoice"]:checked').map(function() {
    return this.value;
}).get();
	
var ExporterCode = $('#ExporterCode2').val();	
   document.getElementById("myloading").innerHTML="<img src='<?php echo base_url().'SmallLoading.gif'?>'> Please Wait....";
    
            $.ajax({
                type: "POST",
                url: '<?php echo base_url()?>'+$('#assign').attr('action')+"?"+dataString+"&productIDS="+checkedValues,
                data: dataString,
                timeout: 6000,
                error: function (request, error) {
				document.getElementById("myloading").innerHTML=request.status;
				
                },
                success: function (response) 
				{	
				
				
				if(response=="Record Saved Successfully.")
				{
					
					$.blockUI({message: '<h3>Record Saved Successfully.</h3>'}); 
						setTimeout(function() { 
						$.unblockUI({ 
						onUnblock: function(){ 
						window.location="<?php echo base_url()?>Settings/index/"+ExporterCode;
						} 
						}); 
						}, 2000); 
				}else{
					
					document.getElementById("myloading").innerHTML=response;
				}
				
                }
			
            });
			
			
	  return false;
});

 $("#saveProduct").click(function () {

  var dataString = $('#assign').serialize();

   document.getElementById("loading2").innerHTML="<img src='<?php echo base_url().'SmallLoading.gif'?>'> Please Wait....";
    
            $.ajax({
                type: "POST",
                url: '<?php echo base_url()?>'+$('#assign').attr('action'),
                data: dataString,
                timeout: 6000,
                error: function (request, error) {
				document.getElementById("loading2").innerHTML=request.status;
				
                },
                success: function (response) 
				{	
				
				
				if(response=="Record Saved Successfully.")
				{
					
					$.blockUI({message: '<h3>Record Saved Successfully.</h3>'}); 
						setTimeout(function() { 
						$.unblockUI({ 
						onUnblock: function(){ 
						window.location="<?php echo base_url()?>Settings/products/";
						} 
						}); 
						}, 2000); 
				}else{
					
					document.getElementById("loading2").innerHTML=response;
				}
				
                }
			
            });
			
			
	  return false;
});

 $("#SaveNewOrders").click(function () {
  var dataString = $('#neworders').serialize();
   document.getElementById("loading2").innerHTML="<img src='<?php echo base_url().'SmallLoading.gif'?>'> Please Wait....";
            $.ajax({
                type: "POST",
                url: '<?php echo base_url()?>'+$('#neworders').attr('action'),
                data: dataString,
                timeout: 6000,
                error: function (request, error) {
				document.getElementById("loading2").innerHTML=request.status;
                },
                success: function (response) 
				{	
				
				document.getElementById("loading2").innerHTML=response;
				}
            });
	  return false;
});



 $("#ReceiveNewOrders").click(function () {
  var dataString = $('#neworders').serialize();
   document.getElementById("loading2").innerHTML="<img src='<?php echo base_url().'SmallLoading.gif'?>'> Please Wait....";
            $.ajax({
                type: "POST",
                url: '<?php echo base_url()?>'+$('#neworders').attr('action'),
                data: dataString,
                timeout: 6000,
                error: function (request, error) {
				document.getElementById("loading2").innerHTML=request.status;
                },
                success: function (response) 
				{	
				
				document.getElementById("loading2").innerHTML=response;
				}
            });
	  return false;
});

 $("#saveSellingRate").click(function () {
  var dataString = $('#neworders').serialize();
   document.getElementById("loading2").innerHTML="<img src='<?php echo base_url().'SmallLoading.gif'?>'> Please Wait....";
            $.ajax({
                type: "POST",
                url: '<?php echo base_url()?>'+$('#neworders').attr('action'),
                data: dataString,
                timeout: 6000,
                error: function (request, error) {
				document.getElementById("loading2").innerHTML=request.status;
                },
                success: function (response) 
				{	
				
			
				if(response=="Record Saved Successfully.")
				{
					
					$.blockUI({message: '<h3>Record Saved Successfully.</h3>'}); 
						setTimeout(function() { 
						$.unblockUI({ 
						onUnblock: function(){ 
						window.location="<?php echo base_url()?>Settings/Currency/";
						} 
						}); 
						}, 2000); 
				}else{
					
					document.getElementById("loading2").innerHTML=response;
				}
				}
            });
	  return false;
});


 $("#ConfirmedNewOrders").click(function () {
  var dataString = $('#neworders').serialize();
   document.getElementById("loading2").innerHTML="<img src='<?php echo base_url().'SmallLoading.gif'?>'> Please Wait....";
            $.ajax({
                type: "POST",
                url: '<?php echo base_url()?>'+$('#neworders').attr('action'),
                data: dataString,
                timeout: 6000,
                error: function (request, error) {
				document.getElementById("loading2").innerHTML=request.status;
                },
                success: function (response) 
				{	
				
				document.getElementById("loading2").innerHTML=response;
				}
            });
	  return false;
});


 $("#viewStatusReport").click(function () {
  var dataString = $('#neworders').serialize();
   document.getElementById("loading2").innerHTML="<img src='<?php echo base_url().'SmallLoading.gif'?>'> Please Wait....";
            $.ajax({
                type: "POST",
                url: '<?php echo base_url()?>'+$('#neworders').attr('action'),
                data: dataString,
                timeout: 6000,
                error: function (request, error) {
				document.getElementById("loading2").innerHTML=request.status;
                },
                success: function (response) 
				{	
				
				document.getElementById("loading2").innerHTML=response;
				}
            });
	  return false;
});
</script>