
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
						<div class="col-lg-3">
                         New Requested Orders
                        </div>
						
						<div class="col-lg-4">
                            Select a record to Print <select class="form-control select2" style="width:58%;" name="IndentNo">
														<option ></option>
														<option >Print All</option>
														<?PHP foreach($printNewOrders as $key)
														{
														?>
														<option ><?php echo $key->IndentNo?></option>
														<?php
														}
														?>
														</select>
														
                        </div>
						<div class="col-lg-3">
						<input type="text" id="reservation2" name="IndentDate" placeholder="Select Indent Date" class="form-control input-sm" style="width:90%">
						 
                        </div>
						<div class="col-lg-2">
						<input type="submit" class="btn btn-default btn-sm" value="Print Preview" id="SaveNewOrders">
						 
                        </div>
						</form>
						</div>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body" style="font-family:Times New Roman">
                          <div id="header" align="center">
						  <h3>KENYA WINE AGENCIES LTD</h3>
						  <h4>New Requested Orders</h2>
						  </div>
						  
						  <div id="loading2"></div>
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
		 
		 window.location="<?php echo base_url()?>Reports/NewOrders/"+val;
	 }

 }
 
  

	
</script>

</body>

</html>
