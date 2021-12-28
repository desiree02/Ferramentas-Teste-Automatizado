<?php

class AlterStore_test extends UnitTestCase
{
    public function setUp(): void
    {
        $this->resetInstance();        
        $this->CI->load->model('model_stores');
        $this->obj = $this->CI->model_stores;
    }

    //Casos de Teste: <(Nome da loja, status, Nome da loja, status), resultado>
    //CT01: <(“Araujo store”,””, ”N/A*”, “Inactive”), válido>
 	public function test_CT01()
	{

        $output = $this->request(
			'POST', 'Auth/login',
                [
                    'email'     => 'admin@admin.com',
                    'password'  => 'password'
                ]		
        );
        
        $before_update = $this->obj->getStoresData(5); 
        
        $output01 = $this->request(
            'POST', ['Stores', 'update', '5'],
            [
                'edit_store_name' => $before_update['name'],
                'edit_active' => '0'
            ]

        );

        $after_update = $this->obj->getStoresData(5);

       // print_r($before_update);
       // print_r($after_update);
       
        $this->assertEquals($before_update, $after_update);
	}

    public function test_CT01_validation()
	{    
        $after_update = $this->obj->getStoresData(5); 
        
        $data =
            [   
                'id' => '5',
                'name' => 'Araujo Store',
                'active' => '0'
            ];

        //print_r($after_update);
       // print_r($data);
       
        $this->assertEquals($after_update, $data);
	}

    //CT02: <(“”,”Active”,”Centauro”, “N/A*”), válido>
    public function test_CT02()
	{

        $output = $this->request(
			'POST', 'Auth/login',
                [
                    'email'     => 'admin@admin.com',
                    'password'  => 'password'
                ]		
        );
        
        $before_update = $this->obj->getActiveStore(); 
        $before_update_first =  $before_update[0];
        $before_update_id =  $before_update[0]['id'];
        $before_update_status =  $before_update[0]['active'];
        
        $output01 = $this->request(
            'POST', ['Stores', 'update', '3'],
            [
                'edit_store_name' => 'Centauro',
                'edit_active' => $before_update_status
            ]

        );

        $after_update = $this->obj->getStoresData(3);

       // print_r($before_update);
       // print_r($after_update);
       
        $this->assertEquals($before_update_first, $after_update);
	}

  public function test_CT02_validation()
	{    
        $after_update = $this->obj->getStoresData(3); 
        
        $data =
            [   
                'id' => '3',
                'name' => 'Centauro',
                'active' => '1'
            ];

        //print_r($after_update);
       // print_r($data);
       
        $this->assertEquals($after_update, $data);
	}

   //CT03: <(“Buguer King”,””, “”, “N/A*”), inválido - informações obrigatórias não foram inseridas>
   public function test_CT03()
   {

       $output = $this->request(
           'POST', 'Auth/login',
               [
                   'email'     => 'admin@admin.com',
                   'password'  => 'password'
               ]		
       );
       
       $before_update = $this->obj->getStoresData(6); 
       
       $output01 = $this->request(
           'POST', ['Stores', 'update', '6'],
           [
               'edit_store_name' => '',
               'edit_active' => $before_update['active']
           ]

       );

       $after_update = $this->obj->getStoresData(6);

      // print_r($before_update);
      // print_r($after_update);
      
       $this->assertEquals($before_update, $after_update);
   }

   public function test_CT03_validation()
   {    
       $after_update = $this->obj->getStoresData(6); 
       
        $data =
           [   
               'id' => '6',
               'name' => '',
               'active' => '0'
           ];

       //print_r($after_update);
      // print_r($data);
      
        $this->assertEquals($after_update, $data);
   }

   //CT06: <(“”, ””, “Motorola”, “N/A*”), válido>
   public function test_CT06()
   {

       $output = $this->request(
           'POST', 'Auth/login',
               [
                   'email'     => 'admin@admin.com',
                   'password'  => 'password'
               ]		
       );
       
        $before_update = $this->obj->getStoresData(); 
        $before_update_first =  $before_update[0];
        $before_update_id =  $before_update[0]['id'];
        $before_update_status =  $before_update[0]['active'];
       
       $output01 = $this->request(
           'POST', ['Stores', 'update', '3'],
           [
               'edit_store_name' => 'Motorola',
               'edit_active' => $before_update_status
           ]

       );

       $after_update = $this->obj->getStoresData($before_update_id);

      // print_r($before_update);
      // print_r($after_update);
      
       $this->assertEquals($before_update_first, $after_update);
   }

   public function test_CT06_validation()
   {    
       $after_update = $this->obj->getStoresData(3); 
       
       $data =
           [   
               'id' => '3',
               'name' => 'Motorola',
               'active' => '1'
           ];

       //print_r($after_update);
      // print_r($data);
      
       $this->assertEquals($after_update, $data);
   }
}
