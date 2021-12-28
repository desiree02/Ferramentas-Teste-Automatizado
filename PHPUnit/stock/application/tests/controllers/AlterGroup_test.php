<?php

class AlterGroup_test extends UnitTestCase
{
    public function setUp(): void
    {
        $this->resetInstance();        
        $this->CI->load->model('model_groups');
        $this->obj = $this->CI->model_groups;
    }

    //Casos de Teste: <(Nome do grupo, nome, permissões), resultado>
    //CT01: <(“desiree”,”N/A*”, ”deletar lojas, atualizar pedidos”), válido>
	public function test_CT01()
	{

        $output = $this->request(
			'POST', 'Auth/login',
                [
                    'email'     => 'admin@admin.com',
                    'password'  => 'password'
                ]		
        );

        $before_update = $this->obj->getGroupData(6); 
        $before_update_group =  $before_update['group_name'];
        
        $output01 = $this->request(
            'POST', ['groups', 'edit', '6'],
            [
                'group_name' => $before_update_group,
                'permission' => array("deleteStore", "updateOrder")
            ]

        );

        $after_update = $this->obj->getGroupData(6);

        print_r($before_update);
        print_r($after_update);
       
        $this->assertEquals($before_update, $after_update);
    
	} 

    //VERIFICANDO SE OS DADOS ALTERADOS ESTÃO IGUAIS QUE ALTEREI
    //Casos de Teste: <(Nome do grupo, nome, permissões), resultado>
    //CT01: <(“desiree”,”N/A*”, ”deletar lojas, atualizar pedidos”), válido>
    public function test_CT01_validation()
	{    
        $after_update = $this->obj->getGroupData(6);
        
        $data =
            [   
                'id' => '6',
                'group_name' => 'desiree',
                'permission' => serialize(array('deleteStore', 'updateOrder'))
            ];

        //print_r($after_update);
       // print_r($data);
       
        $this->assertEquals($after_update, $data);
	}

      //Casos de Teste: <(Nome do grupo, nome, permissões), resultado>
    //CT03: <(“rural”,””, “N/A*”), inválido - informações obrigatórias não foram inseridas>
	public function test_CT03()
	{

        $output = $this->request(
			'POST', 'Auth/login',
                [
                    'email'     => 'admin@admin.com',
                    'password'  => 'password'
                ]		
        );

        $before_update = $this->obj->getGroupData(38); 
        $before_update_group =  $before_update['group_name'];
        $before_update_permission =  $before_update['permission'];

        $output01 = $this->request(
            'POST', ['groups', 'edit', '38'],
            [
                'group_name' => '',
                'permission' => $before_update_permission
            ]

        );

        $after_update = $this->obj->getGroupData(38);

        print_r($before_update);
        print_r($after_update);
       
        $this->assertEquals($before_update, $after_update);
    
	} 

    //Casos de Teste: <(Nome do grupo, nome, permissões), resultado>
    //CT04: <(“ufrrj”, “N/A*”, ”deletar produto”), válido>
	public function test_CT04()
	{

        $output = $this->request(
			'POST', 'Auth/login',
                [
                    'email'     => 'admin@admin.com',
                    'password'  => 'password'
                ]		
        );

        $before_update = $this->obj->getGroupData(55); 
        $before_update_group =  $before_update['group_name'];
        
        $output01 = $this->request(
            'POST', ['groups', 'edit', '55'],
            [
                'group_name' => $before_update_group,
                'permission' => array("deleteProduct")
            ]

        );

        $after_update = $this->obj->getGroupData(55);

        print_r($before_update);
        print_r($after_update);
       
        $this->assertEquals($before_update, $after_update);
    
	} 

    //VERIFICANDO SE OS DADOS ALTERADOS ESTÃO IGUAIS QUE ALTEREI
    //Casos de Teste: <(Nome do grupo, nome, permissões), resultado>
    //CT04: <(“ufrrj”, “N/A*”, ”deletar produto”), válido>
    public function test_CT04_validation()
	{    
        $after_update = $this->obj->getGroupData(55);
        
        $data =
            [   
                'id' => '55',
                'group_name' => 'ufrrj',
                'permission' => serialize(array('deleteProduct'))
            ];

        //print_r($after_update);
       // print_r($data);
       
        $this->assertEquals($after_update, $data);
	}

    //Casos de Teste: <(Nome do grupo, nome, permissões), resultado>
    //CT05: <(“rural”, ”rural_novo”, “deletar categorias”), válido>
	public function test_CT05()
	{

        $output = $this->request(
			'POST', 'Auth/login',
                [
                    'email'     => 'admin@admin.com',
                    'password'  => 'password'
                ]		
        );

        $before_update = $this->obj->getGroupData(44); 
        
        $output01 = $this->request(
            'POST', ['groups', 'edit', '44'],
            [
                'group_name' => 'rural_novo',
                'permission' => array("deleteCategory")
            ]

        );

        $after_update = $this->obj->getGroupData(44);

        print_r($before_update);
        print_r($after_update);
       
        $this->assertEquals($before_update, $after_update);
    
	}

    //VERIFICANDO SE OS DADOS ALTERADOS ESTÃO IGUAIS QUE ALTEREI
    //Casos de Teste: <(Nome do grupo, nome, permissões), resultado>
    //CT05: <(“rural”, ”rural_novo”, “deletar categorias”), válido>
    public function test_CT05_validation()
	{    
        $after_update = $this->obj->getGroupData(44);
        
        $data =
            [   
                'id' => '44',
                'group_name' => 'rural_novo',
                'permission' => serialize(array('deleteCategory'))
            ];

        //print_r($after_update);
       // print_r($data);
       
        $this->assertEquals($after_update, $data);
	}

    //Casos de Teste: <(Nome do grupo, nome, permissões), resultado>
    //CT07: <(“”, ”amazon”, “atualizar lojas”), válido>
	public function test_CT07()
	{

        $output = $this->request(
			'POST', 'Auth/login',
                [
                    'email'     => 'admin@admin.com',
                    'password'  => 'password'
                ]		
        );

        $before_update = $this->obj->getGroupData(7); 
        
        $output01 = $this->request(
            'POST', ['groups', 'edit', '7'],
            [
                'group_name' => 'amazon',
                'permission' => array("updateStore")
            ]

        );

        $after_update = $this->obj->getGroupData(7);

        print_r($before_update);
        print_r($after_update);
       
        $this->assertEquals($before_update, $after_update);
    
	}

    //VERIFICANDO SE OS DADOS ALTERADOS ESTÃO IGUAIS QUE ALTEREI
    //Casos de Teste: <(Nome do grupo, nome, permissões), resultado>
    //CT07: <(“”, ”amazon”, “atualizar lojas”), válido>
    public function test_CT07_validation()
	{    
        $after_update = $this->obj->getGroupData(7);
        
        $data =
            [   
                'id' => '7',
                'group_name' => 'amazon',
                'permission' => serialize(array('updateStore'))
            ];

        //print_r($after_update);
       // print_r($data);
       
        $this->assertEquals($after_update, $data);
	}

}
