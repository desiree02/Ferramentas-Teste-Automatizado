<?php

class CreateGroup_test extends UnitTestCase
{
    public function setUp(): void
    {
        $this->resetInstance();        
        $this->CI->load->model('model_groups');
        $this->obj = $this->CI->model_groups;
    }

    // CT01: <(“desiree”,”criar usuários e grupos, atualizar marcas”), válido>
	public function test_CT01()
	{

        $output = $this->request(
			'POST', 'Auth/login',
                [
                    'email'     => 'admin@admin.com',
                    'password'  => 'password'
                ]		
        );
    
        $output01 = $this->request(
            'POST', 'groups/create',
                [
                    'group_name' => 'desiree',
                    'permission' => array("createUser", "createGroup")
                ]		
        );

        $after_create = $this->obj->getGroupData(43); 

        $data = 
        [
            'id' => '43',
            'group_name' => 'desiree',
            'permission' => serialize(array('createUser', 'createGroup'))
        ];

        //print_r($after_create);
        //print_r($data);

        $this->assertEquals($after_create, $data);

	} 

    // CT02: <(“rural”,”atualizar lojas, visualizar pedidos/relatórios ”), válido>
/*    public function test_CT02()
    {

        $output = $this->request(
            'POST', 'Auth/login',
                [
                    'email'     => 'admin@admin.com',
                    'password'  => 'password'
                ]		
        );

        $output01 = $this->request(
            'POST', 'groups/create',
                [
                    'group_name' => 'rural',
                    'permission' => array("updateStore", "viewOrder", "viewReport")
                ]		
        );

        $after_create = $this->obj->getGroupData(45); 

        $data = 
        [
            'id' => '45',
            'group_name' => 'rural',
            'permission' => serialize(array('updateStore', 'viewOrder', 'viewReport'))
        ];

        print_r($after_create);
        print_r($data);

        $this->assertEquals($after_create, $data);

    } 

    // CT03: <(“andressa”,””), válido>
    public function test_CT03()
    {

        $output = $this->request(
            'POST', 'Auth/login',
                [
                    'email'     => 'admin@admin.com',
                    'password'  => 'password'
                ]		
        );

        $output01 = $this->request(
            'POST', 'groups/create',
                [
                    'group_name' => 'andressa',
                    'permission' => array('')
                ]		
        );

        $after_create = $this->obj->getGroupData(52); 

        $data = 
        [
            'id' => '52',
            'group_name' => 'andressa',
            'permission' =>  serialize(array(''))
        ];

        print_r($after_create);
        print_r($data);

        $this->assertEquals($after_create, $data);

    } 

    // CT04: <(“joana”,”deletar grupo”), válido>
    public function test_CT04()
    {

        $output = $this->request(
            'POST', 'Auth/login',
                [
                    'email'     => 'admin@admin.com',
                    'password'  => 'password'
                ]		
        );

        $output01 = $this->request(
            'POST', 'groups/create',
                [
                    'group_name' => 'joana',
                    'permission' => array("deleteGroup")
                ]		
        );

        $after_create = $this->obj->getGroupData(53); 

        $data = 
        [
            'id' => '53',
            'group_name' => 'joana',
            'permission' =>  serialize(array('deleteGroup'))
        ];

        print_r($after_create);
        print_r($data);

        $this->assertEquals($after_create, $data);

    }


    // CT05: <(“”,”visualizar produtos, ”), inválido - informações obrigatórias não foram inseridas>
    public function test_CT05()
    {

        $output = $this->request(
            'POST', 'Auth/login',
                [
                    'email'     => 'admin@admin.com',
                    'password'  => 'password'
                ]		
        );

        $output01 = $this->request(
            'POST', 'groups/create',
                [
                    'group_name' => '',
                    'permission' => array("viewProduct")
                ]		
        );

        $after_create = $this->obj->getGroupData(54); 

        $data = 
        [
            'id' => '54',
            'group_name' => '',
            'permission' =>  serialize(array('viewProduct'))
        ];

        print_r($after_create);
        print_r($data);

        $this->assertEquals($after_create, $data);

    } 

    // CT05: <(“”,”visualizar produtos, ”), inválido - informações obrigatórias não foram inseridas>
    public function test_CT05_validation()
    {

        $groups = $this->obj->getGroupData(); 

        $data = 
        [
            'id' => '54',
            'group_name' => '',
            'permission' =>  serialize(array('viewProduct'))
        ];


        $this->assertContains($data, $groups);

    } 


    // CT06: <(“ccomp”,”Criar/Atualizar/Visualizar/Deletar produtos, categorias e pedidos”), válido>
    public function test_CT06()
    {

        $output = $this->request(
            'POST', 'Auth/login',
                [
                    'email'     => 'admin@admin.com',
                    'password'  => 'password'
                ]		
        );

        $output01 = $this->request(
            'POST', 'groups/create',
                [
                    'group_name' => 'ccomp',
                    'permission' => array("createProduct", "updateProduct", "viewProduct", "deleteProduct", "createCategory", "updateCategory", "viewCategory", "deleteCategory", "createOrder", "updateOrder", "viewOrder", "deleteOrder")
                ]		
        );

        $after_create = $this->obj->getGroupData(54); 

        $data = 
        [
            'id' => '54',
            'group_name' => 'ccomp',
            'permission' =>  serialize(array('createProduct', 'updateProduct', 'viewProduct', 'deleteProduct', 'createCategory', 'updateCategory', 'viewCategory', 'deleteCategory', 'createOrder', 'updateOrder', 'viewOrder', 'deleteOrder'))
        ];

        print_r($after_create);
        print_r($data);

        $this->assertEquals($after_create, $data);

    }

    // CT07: <(“ufrrj”,”Criar pedidol”), válido>
    public function test_CT07()
    {

        $output = $this->request(
            'POST', 'Auth/login',
                [
                    'email'     => 'admin@admin.com',
                    'password'  => 'password'
                ]		
        );

        $output01 = $this->request(
            'POST', 'groups/create',
                [
                    'group_name' => 'ufrrj',
                    'permission' => array("createOrder")
                ]		
        );

        $after_create = $this->obj->getGroupData(55); 

        $data = 
        [
            'id' => '55',
            'group_name' => 'ufrrj',
            'permission' =>  serialize(array( 'createOrder'))
        ];

        print_r($after_create);
        print_r($data);

        $this->assertEquals($after_create, $data);

    }


    // CT08: <(“dcc”,”Visualizar relatorios”), válido>
    public function test_CT08()
    {

        $output = $this->request(
            'POST', 'Auth/login',
                [
                    'email'     => 'admin@admin.com',
                    'password'  => 'password'
                ]		
        );

        $output01 = $this->request(
            'POST', 'groups/create',
                [
                    'group_name' => 'dcc',
                    'permission' => array("viewReport")
                ]		
        );

        $after_create = $this->obj->getGroupData(56); 

        $data = 
        [
            'id' => '56',
            'group_name' => 'dcc',
            'permission' =>  serialize(array('viewReport'))
        ];

        print_r($after_create);
        print_r($data);

        $this->assertEquals($after_create, $data);

    }*/
}
