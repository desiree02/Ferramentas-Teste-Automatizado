<?php

class DeleteStore_test extends UnitTestCase
{
    public function setUp(): void
    {
        $this->resetInstance();        
        $this->CI->load->model('model_stores');
        $this->obj = $this->CI->model_stores;
    }

    //Casos de Teste: <(Nome da loja, status, Opção Exclusão), resultado>
    //CT01: <(“Burguer King”, “”, ”Save Changes”), válido>
/*	public function test_CT01()
	{

        $output = $this->request(
			'POST', 'Auth/login',
                [
                    'email'     => 'admin@admin.com',
                    'password'  => 'password'
                ]		
        );
        
        $before_remove = $this->obj->getStoresData(6); 
        
        $output01 = $this->request(
            'POST', 'Stores/remove', 
                [
                    'store_id' => $before_remove['id'] 
                ]
        );

        $after_remove = $this->obj->getStoresData();

       // print_r($before_remove);
       // print_r($after_remove);
       
        $this->assertContains($before_remove, $after_remove);
	}

    //CT04: <(“”, “Active”, Save Changes”), válido>
    public function test_CT04()
	{

        $output = $this->request(
			'POST', 'Auth/login',
                [
                    'email'     => 'admin@admin.com',
                    'password'  => 'password'
                ]		
        );
        
        $before_remove = $this->obj->getActiveStore(); 
        $before_remove_first =  $before_remove[0];
        $before_remove_id =  $before_remove[0]['id'];
        $before_remove_status =  $before_remove[0]['active'];
        
        
        $output01 = $this->request(
            'POST', 'Stores/remove', 
                [
                    'store_id' => $before_remove_id 
                ]
        );

        $after_remove = $this->obj->getStoresData();

       // print_r($before_remove);
       // print_r($after_remove);
       
        $this->assertContains($before_remove_first, $after_remove);
	}*/

    //CT05: <(“”, “”, Save Changes”), válido>
    public function test_CT05()
	{

        $output = $this->request(
			'POST', 'Auth/login',
                [
                    'email'     => 'admin@admin.com',
                    'password'  => 'password'
                ]		
        );
        
        $before_remove = $this->obj->getStoresData(); 
        $before_remove_first =  $before_remove[0];
        $before_remove_id =  $before_remove[0]['id'];
        $before_remove_status =  $before_remove[0]['active'];
        
        
        $output01 = $this->request(
            'POST', 'Stores/remove', 
                [
                    'store_id' => $before_remove_id 
                ]
        );

        $after_remove = $this->obj->getStoresData();

       // print_r($before_remove);
       // print_r($after_remove);
       
        $this->assertContains($before_remove_first, $after_remove);
	}


}
