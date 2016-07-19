<!-------Header-->
<body>

    <div id="wrapper">       
	   <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0;background-color:#990033">
	   <small>
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="<?php echo base_url()?>" style="color:#FFFFFF">KWAL Procurement Software</a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
			<li style="color:#FFFFFF"><?php if(isset($_SESSION['IDSUser']))
		{
		
		echo "Welcome ".$_SESSION['IDSUser']."</font> You are Logged in.";
		}?></li>
 
   
                <!-- /.dropdown -->
               
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
					
                       
                        <li class="divider"></li>
                        <li>
					<form role="form" id="logout" action="setup/Logout">
						<button type="submit" id="logoutbtn" class="btn btn-default"><i class="fa fa-sign-out fa-fw"></i> Logout</button>
						</form>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation">
               <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <div class="col-lg-12">
                    <h4 class="page-heaer"></h4>
                </div>
                        <li>
                            <a href="<?php echo base_url()?>"><i class="fa fa-dashboard fa-fw"></i> Procurement Software</a>
                        </li>
							<li>
                            <a href="#"><i class="fa fa-wrench fa-fw"></i> System Settings<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
							 <li>
                               <li>
                                    <a href="<?php echo base_url()?>Settings/Products">Products Definition </a>
                                </li>
								 <li>
                                    <a href="<?php echo base_url()?>Settings/ViewProducts">View Products </a>
                                </li>
								 <li>
                                    <a href="<?php echo base_url()?>Settings">Products Exporters Definition </a>
                                </li>
								 <li>
                                    <a href="<?php echo base_url()?>Settings/ViewExporters">Products Exporters Details </a>
                                </li>
								<li>
                                    <a href="<?php echo base_url()?>Settings/Currency">Weekly Currency Exch Rates </a>
                                </li>
								</li>
								 
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-wrench fa-fw"></i> Proforma Invoice Processing<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
							 <li>
                              
								 <li>
                                    <a href="<?php echo base_url()?>invoiceprocessing/proformarequests">New Indent Proforma Requests</a>
                                </li>
								 <li>
                                    <a href="<?php echo base_url()?>invoiceprocessing/proformainvoices">Receiving Proforma Invoices</a>
                                </li>
								 <li>
                                    <!--<a href="<?php echo base_url()?>invoiceprocessing/proformainvoicesreminders">Proforma Invoice Reminders</a>-->
                                </li>
								</li>
								 
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
						
						   
                      <!--  <li>
                            <a href="#"><i class="fa fa-wrench fa-fw"></i> Imports Declaration Form<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
							 <li>
                                    <a href="<?php echo base_url();?>idf/">General IDF Details</a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url();?>idf/idfShippingInfo">Shipping Information</a>
                                </li>
								 <li>
                                    <a href="<?php echo base_url();?>idf/idfitemsInfo">Commodities/Items</a>
                                </li>
								<li>
                                    <a href="<?php echo base_url();?>idf/IDFNumber">Update IDF Number</a>
                                </li>
								<li>
                                    <a href="<?php echo base_url()?>idf/amendements">I.D.F Amendments</a>
                                </li>
								
								
                            </ul>
							
                            <!-- /.nav-second-level -
                        </li> -->                    
                        <li>
                            <a href="#"><i class="fa fa-wrench fa-fw"></i> Purchase Order Processing<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
							 <li>
                                    <a href="<?php echo base_url()?>confirmation">Confirmation of Purchase Orders</a>
                                </li>
								<!-- <li>
                                    <a href="<?php echo base_url()?>confirmation/acknowledgeOrders">Particulars of Acknowledged Orders</a>
                                </li>
								<li>
                                    <a href="<?php echo base_url()?>confirmation/VerifyShipping ">Add/Verify Shipping Information</a>
                                </li>-->
								
								
                               
                            </ul>
						</li>
						<li>
                            <a href="#"><i class="fa fa-wrench fa-fw"></i> Reports<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
							<li>
                                    <a href="<?php echo base_url()?>Reports/NewOrders">New Orders</a>
                            </li>
								<li>
                                    <a href="<?php echo base_url()?>Reports/ReceivedOrders">Under Confirmation</a>
                            </li>	
								<li>
                                    <a href="<?php echo base_url()?>Reports/ConfirmedOrders">Confirmed Orders</a>
                            </li>	
							<li>
                                    <a href="<?php echo base_url()?>Reports/invoice">Requested Proform Invoice</a>
                            </li>	
                               <li>
                                    <a href="<?php echo base_url()?>Reports/SupplierCopy">Confirmed Reports</a>
                            </li>	
							 <li>
                                    <a href="<?php echo base_url()?>Reports/StatusReport">Status Report</a>
                            </li>
                            </ul>
						</li>
					<!--	<li>
							 <a href="#"><i class="fa fa-wrench fa-fw"></i> Tracking  of Documents<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
							 <li>
                                    <a href="<?php echo base_url()?>doctracking">Request for Shipping Documents</a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url()?>doctracking/receivingdocuments">Receiving for Shipping Documents</a>
                                </li>
								
								
								
                            </ul>
						</li>
						<li>
							 <a href="#"><i class="fa fa-wrench fa-fw"></i> Tracking  of Shipments<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
							 <li>
                                    <a href="<?php echo base_url()?>shiptracking">Commercial Invoice Verification</a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url()?>shiptracking/Shippingtypes">Determination of Shipping Types</a>
                                </li>
								 <li>
                                    <a href="<?php echo base_url()?>shiptracking/InsuranceCover">Pre Shipping Insurance Cover</a>
                                </li>
								 <li>
                                    <a href="<?php echo base_url()?>shiptracking/Instructions">Clearing Agent's Instructions</a>
                                </li>
								<li>
                                    <a href="<?php echo base_url()?>shiptracking/allocateWarehouse">Allocation of Bond / Warehouse</a>
                                </li>
								<li>
                                    <a href="<?php echo base_url()?>shiptracking/CCRF">CCRF Assignment and Verification</a>
                                </li>
								
                            </ul>
                            <!-- /.nav-second-level 
                        </li>-->
                       

                       
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>
		</small>