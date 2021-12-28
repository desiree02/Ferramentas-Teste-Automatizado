<?php

class DeleteGroup_test extends UnitTestCase
{
    public function setUp(): void
    {
        $this->resetInstance();        
        $this->CI->load->model('model_groups');
        $this->obj = $this->CI->model_groups;
    }

    //Casos de Teste: <(Nome do grupo, nome, permissões), resultado>
    //CT01: <(“desiree”, ”CONFIRM”), válido>
	public function test_CT01()
	{

        $output = $this->request(
			'POST', 'Auth/login',
                [
                    'email'     => 'admin@admin.com',
                    'password'  => 'password'
                ]		
        );

        $before_remove = $this->obj->getGroupData(8); 
        
        $output01 = $this->request(
            'POST', ['groups', 'delete', '8'],
            [
                'confirm' => 'confirm'
                //'name' => 'confirm',    
               // 'value' => 'confirm'     
            ]
        );

        $after_remove = $this->obj->getGroupData();

        //print_r($before_remove);
        //print_r($after_remove);
       
        $this->assertContains($before_remove, $after_remove);
    
	} 

    //Casos de Teste: <(Nome do grupo, nome, permissões), resultado>
    //CT04: <(“”, ”CONFIRM”), válido>
	public function test_CT04()
	{

        $output = $this->request(
			'POST', 'Auth/login',
                [
                    'email'     => 'admin@admin.com',
                    'password'  => 'password'
                ]		
        );

        $before_remove = $this->obj->getGroupData(53); 
        
        $output01 = $this->request(
            'POST', ['groups', 'delete', '53'],
            [
                'confirm' => 'confirm'
                //'name' => 'confirm',    
               // 'value' => 'confirm'     
            ]
        );

        $after_remove = $this->obj->getGroupData();

        //print_r($before_remove);
        //print_r($after_remove);
       
        $this->assertContains($before_remove, $after_remove);
    
	} 

}