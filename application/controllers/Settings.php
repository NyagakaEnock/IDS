<?php
class Settings extends CI_Controller 
{
		
        public function __construct()
        {
				
                parent::__construct();
                $this->load->model('Settings_model');	
				$this->load->model('Invoiceprocessing_model');	
				$this->load->model('Proformainvoices_model');
                $this->load->helper('url_helper');
        }

        public function index()
        {
		
         if(isset($_SESSION['IDSUser']))
        {
					$IndentNo = $this->uri->segment(3,"");
						
						
			$data['ParamCountries'] = $this->Invoiceprocessing_model->get_countries();
			$data['genearateExporterCodes'] = $this->Settings_model->genearateExporterCodes();	
			$data['get_Currency'] = $this->Proformainvoices_model->get_Currency();	
			$data['ShowActiveCommodityBrands'] = $this->Settings_model->ShowActiveCommodityBrands();
			$data['get_Exporters'] = $this->Invoiceprocessing_model->get_Exporters();
			
			$ExporterCode =  $this->uri->segment(3,"");
			if(	$ExporterCode !=NULL)
			{
				$data['get_ExportersName'] = $this->Settings_model->get_Exporters($ExporterCode);
			}
                        $this->load->view('templates/header');
                        $this->load->view('templates/navigation');
                        $this->load->view('templates/countries_view',$data);
                        $this->load->view('templates/footercontent');
                        $this->load->view('templates/footer');
        }else{
                        $this->load->view('templates/header');
                        $this->load->view('templates/login');
                        $this->load->view('templates/footercontent');
                        $this->load->view('templates/footer');
                        }
        }
		public function ViewExporters()
		{
		
         if(isset($_SESSION['IDSUser']))
        {
					$IndentNo = $this->uri->segment(3,"");		
			$data['ParamCountries'] = $this->Invoiceprocessing_model->get_countries();
			$data['genearateExporterCodes'] = $this->Settings_model->genearateExporterCodes();	
			$data['get_Currency'] = $this->Proformainvoices_model->get_Currency();	
			$data['ShowActiveCommodityBrands'] = $this->Settings_model->ShowActiveCommodityBrands();
			$data['get_Exporters'] = $this->Invoiceprocessing_model->get_Exporters();
			
			$ExporterCode =  $this->uri->segment(3,"");
			if(	$ExporterCode !=NULL)
			{
				$data['get_ExportersName'] = $this->Settings_model->get_Exporters($ExporterCode);
			}
                        $this->load->view('templates/header');
                        $this->load->view('templates/navigation');
                        $this->load->view('templates/viewExporters',$data);
                        $this->load->view('templates/footercontent');
                        $this->load->view('templates/footer');
        }else{
                        $this->load->view('templates/header');
                        $this->load->view('templates/login');
                        $this->load->view('templates/footercontent');
                        $this->load->view('templates/footer');
                        }
        }			
		
		public function Currency()
		{
		
         if(isset($_SESSION['IDSUser']))
        {
					$IndentNo = $this->uri->segment(3,"");		
			$dayOfWeek = date('w',strtotime(date('Y-m-d')))+1;
			$remDays = 6-$dayOfWeek;
		
			
			$data['get_Currency'] = $this->Settings_model->get_Currency();
			$data['getFirstDay'] = $this->Settings_model->getFirstDay("-".$dayOfWeek);
			$data['getLastDay'] = $this->Settings_model->getLastDay($remDays);
			if($IndentNo!="")
			{
				if($this->Settings_model->get_CurrencyData($IndentNo)!=NULL)
				{
				$data['get_CurrencyData'] = $this->Settings_model->get_CurrencyData($IndentNo);	
				$Currency = $this->Settings_model->get_CurrencyData($IndentNo)[0]->Currency;
				$data['WeeklyCurrency'] = $this->Settings_model->WeeklyCurrency($Currency);	
				
				}else{echo "Invalid Currency";}
			}
                        $this->load->view('templates/header');
                        $this->load->view('templates/navigation');
                        $this->load->view('templates/currency',$data);
                        $this->load->view('templates/footercontent');
                        $this->load->view('templates/footer');
        }else{
                        $this->load->view('templates/header');
                        $this->load->view('templates/login');
                        $this->load->view('templates/footercontent');
                        $this->load->view('templates/footer');
                        }
        }
        public function products()
        {
		
                if(isset($_SESSION['IDSUser']))
        {
					$IndentNo = $this->uri->segment(3,"");
						
						
			$data['ShowRelevantCustomsTarriffs'] = $this->Settings_model->ShowRelevantCustomsTarriffs();
			$data['PackageTypes'] = $this->Settings_model->PackageTypes();	
			$data['QttyUnitsName'] = $this->Settings_model->QttyUnitsName();	
			$data['UnitsofQtyName'] = $this->Settings_model->UnitsofQtyName();
			$data['SourceName'] = $this->Settings_model->SourceName();
			
			$data['DepartName'] = $this->Settings_model->DepartName();
			$data['get_Currency'] = $this->Proformainvoices_model->get_Currency();	
			$data['ShowActiveCommodityBrands'] = $this->Settings_model->ShowActiveCommodityBrands();
			$data['get_Exporters'] = $this->Invoiceprocessing_model->get_Exporters();
			
			$ExporterCode =  $this->uri->segment(3,"");
			$ProductCode =  $this->uri->segment(4,"");
			if(	$ExporterCode !=NULL)
			{
				$data['ShowRelevantCustomsData'] = $this->Settings_model->ShowRelevantCustomsData($ExporterCode);
						if($ProductCode!="")
			{
				if($this->Settings_model->ShowActiveCommodityBrandsData($ProductCode)!=NULL)
				{
					
					$data['ProductDetails']=$this->Settings_model->ShowActiveCommodityBrandsData($ProductCode);
				}
			}
			}
                        $this->load->view('templates/header');
                        $this->load->view('templates/navigation');
                        $this->load->view('templates/products',$data);
                        $this->load->view('templates/footercontent');
                        $this->load->view('templates/footer');
        }else{
                        $this->load->view('templates/header');
                        $this->load->view('templates/login');
                        $this->load->view('templates/footercontent');
                        $this->load->view('templates/footer');
                        }
        }		
		public function SaveExporter()
		{
			if($this->Settings_model->validateExpoter()==TRUE)
			{
				$this->Settings_model->saveExporter();
			}
		}
		
		public function assignProduct()
		{
			
			
				$this->Settings_model->assignProduct();
			
		}
		public function saveProduct()
		{
			
			if($this->Settings_model->validateProduct()==TRUE)
			{
				$this->Settings_model->saveProduct();
			}
			
		}	
		public function SellingRate()
		{
			
			if($this->Settings_model->validateSellingRate()==TRUE)
			{
				$this->Settings_model->saveSellingRate();
			}
			
		}	
		
		public function ViewProducts()
		{
                if(isset($_SESSION['IDSUser']))
        {
					$IndentNo = $this->uri->segment(3,"");
						
						
			$data['ShowActiveCommodityBrands'] = $this->Settings_model->ShowActiveCommodityBrands();
			$ProductCode =  $this->uri->segment(4,"");
	
		
                        $this->load->view('templates/header');
                        $this->load->view('templates/navigation');
                        $this->load->view('templates/viewproducts',$data);
                        $this->load->view('templates/footercontent');
                        $this->load->view('templates/footer');
        }else{
                        $this->load->view('templates/header');
                        $this->load->view('templates/login');
                        $this->load->view('templates/footercontent');
                        $this->load->view('templates/footer');
                        }			
		}
}