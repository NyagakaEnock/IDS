
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
                        Select a Product to Edit
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                          
                                   									<div class="row">
							
									 <div class="col-lg-12">
									 																		<p></p>
								
					 <div id="MainData">
                    <div class="panel panel-default">
					<div class="row">
					<div class="col-lg-4">

			
						</DIV>

						</div>	
                        <div class="panel-heading">
                          Select Products to Assign the Select Supplier
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
								<div class="table-responsive table-bordered" style="" >
                             <div class="dataTable_wrapper"  style="width:1500px;height:350px">
                         <table  class="table table-striped table-bordered table-hover" id="">
            
	
                                    <thead>
                                        <tr >
                                            <th>#</th>
                                            <th>Exporter Code</th>
                                            <th>Exporter Name</th>
											<th>Country</th>
                                            <th>Default Currency</th>
											<th>Address</th>
											<th>Telephone</th>
											<th>Fax</th>
											<th>Email</th>
											
											
											
											
											
                                        </tr>
                                    </thead>
<tbody>
	<?php 
	$counter=1;
	if(isset($get_Exporters)){
		$items = "";
		
	foreach($get_Exporters as $key1):
		
	?>
	 <tr>
				<td><input type="checkbox" name="invoice" value="<?php echo $key1->ExporterCode?>" onchange="loadData('<?php echo $key1->ExporterCode?>')"></td>
				<td><?php echo $key1->ExporterCode?></td>
				<td><?php echo $key1->ExporterName?></td>
				<td><?php echo $key1->Country?></td>
				<td><?php echo $key1->Currency?></td>
				<td><?php echo $key1->PostalAddress?></td>
				<td><?php echo $key1->PhoneNo?></td>
				<td><?php echo $key1->FaxNo?></td>
				<td><?php echo $key1->EmailAddress?></td>
				
				
	</tr>
<?php 
$counter= $counter+1;
endforeach;
$counter = $counter-1;	
	}
	
	?>
<input class="form-control input-sm" type="hidden" value="<?php echo $counter?>" name="counter"  id="counter" placeholder="" style="width:95%">
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
 	function loadData(val)
 {  

	 if(val == "")
	 {
		 return;
	 } else {
		 
		 window.location="<?php echo base_url()?>Settings/index/"+val;
	 }

 }
 
  

	
</script>

</body>

</html>
