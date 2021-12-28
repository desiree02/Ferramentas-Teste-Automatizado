<?php

class DeleteUser_test extends UnitTestCase
{
    public function setUp(): void
    {
        $this->resetInstance();        
        $this->CI->load->model('model_users');
        $this->CI->load->model('model_groups');
        $this->obj = $this->CI->model_users;
        $this->obj1 = $this->CI->model_groups;
    }

    //Casos de Teste: <(Nome de usuário, E-mail, Nome, Telefone, grupo, Opção Exclusão), resultado>
   // CT01: <(“joana”, “”, “”, “”, “”, ”CONFIRM”), válido>
	public function test_CT01()
	{

        $output = $this->request(
			'POST', 'Auth/login',
                [
                    'email'     => 'admin@admin.com',
                    'password'  => 'password'
                ]		
        );
        
        $before_remove = $this->obj->getUserData(47); 
        
        $output01 = $this->request(
            'POST', ['Users', 'delete', '47'],   
                [
                    'confirm' => 'confirm'
                ]
        );

        $after_remove = $this->obj->getUserData();

       //print_r($before_remove);
       // print_r($after_remove);
       
        $this->assertContains($before_remove, $after_remove);
	}

    //Casos de Teste: <(Nome de usuário, E-mail, Nome, Telefone, grupo, Opção Exclusão), resultado>
   //CT04: <(“”, “desiree@hotmail.com”, “”, “”, “”, ”CANCEL”), válido>
	public function test_CT04()
	{

        $output = $this->request(
			'POST', 'Auth/login',
                [
                    'email'     => 'admin@admin.com',
                    'password'  => 'password'
                ]		
        );
        
        $before_remove = $this->obj->getUserData(46); 
        
        $output01 = $this->request(
            'POST', ['Users', 'delete', '46'],   
                [
                    'confirm' => 'cancel'
                ]
        );

        $after_remove = $this->obj->getUserData();

       //print_r($before_remove);
       // print_r($after_remove);
       
        $this->assertContains($before_remove, $after_remove);
	}

}