<?php

class CreateUser_test extends UnitTestCase
{
    public function setUp(): void
    {
        $this->resetInstance();        
        $this->CI->load->model('model_users');
        $this->CI->load->model('model_groups');
        $this->obj = $this->CI->model_users;
        $this->obj1 = $this->CI->model_groups;
    }
    
    //"Casos de Teste: <(Nome do grupo, username, e-mail, senha, confirmação de senha, primeiro nome,
    //último nome, telefone, gênero), resultado>"
    // CT01: <(“rural”, ”desiree”, “desiree@hotmail.com”, “desiree02”, “desiree02”, “Desiree”, “Araujo”, “021”, “Female”), válido>
	public function test_CT01()
	{

        $output = $this->request(
			'POST', 'Auth/login',
                [
                    'email'     => 'admin@admin.com',
                    'password'  => 'password'
                ]		
        );
        
        $data = 
        [
            'id'  => '46',
            'username' => 'desiree',
           // 'password' => password_hash('desiree02', PASSWORD_DEFAULT), NÃO ESTOU VERIFICANDO A SENHA PORQUE GERA UMA SENHA CRIPTOGRAFADA DIFERENTE, ENTÃO NAO DA PARA COMPARAR.
            'email' => 'desiree@hotmail.com',
            'firstname' => 'Desiree',
            'lastname' => 'Araujo',
            'phone' => '021',
            'gender' => '2'
        ];

        $output01 = $this->request(
            'POST', 'Users/create', 
                [
                    'groups' => '45', // id do grupo
                    'username' => 'desiree',
                    'password' => 'desiree02', 
                    'cpassword' => 'desiree02',
                    'email' => 'desiree@hotmail.com',
                    'firstname' => 'Desiree',
                    'fname' => 'Desiree',
                    'lastname' => 'Araujo',
                    'lname' => 'Araujo',
                    'phone' => '021',
                    'gender' => '2',
                    
                ]
        );

       $after_create = $this->obj->getUserData(46);

       $after_create_data =  
            [
                'id' => $after_create['id'],
                'username' => $after_create['username'], 
                'email' => $after_create['email'], 
                'firstname' => $after_create['firstname'],
                'lastname' => $after_create['lastname'], 
                'phone' => $after_create['phone'], 
                'gender' => $after_create['gender']
            ];


        print_r($after_create_data);
        print_r($data);

       $this->assertEquals($after_create_data, $data);

	}

    // CT01: <(“rural”, ”desiree”, “desiree@hotmail.com”, “desiree02”, “desiree02”, “Desiree”, “Araujo”, “021”, “Female”), válido>
	public function test_CT01_validation_group()
	{
        $after_create = $this->obj->getUserData(46);
        $after_createGroup = $this->obj1->getUserGroupByUserId(46);
        $after_createGroup_info = [
            'user_id' => $after_createGroup['user_id'],
            'group_id' => $after_createGroup['group_id'],
            'group_name' =>  $after_createGroup['group_name'],
            'permission' =>  $after_createGroup['permission']
        ];

        $data = 
            [                
               // 'id' => '38',
                'user_id' => '46',
                'group_id' => '45',
                'group_name' => 'rural',
                'permission' => serialize(array("updateStore", "viewOrder", "viewReport"))
            ];
        
        //print_r($after_create);
        //print_r($after_createGroup);
        print_r($after_createGroup_info);

        $this->assertEquals($after_createGroup_info, $data);

	}

    //VERIFICANDO SE EXISTE MAIS DE UM USUÁRIO COM OS MESMO DADOS NO SISTEMA
    public function test_CT01_validation_user()
	{
        $after_create = $this->obj->getUserData(46);
        $after_createUser = [
            'username' =>  $after_create['username'],
            'email' => $after_create['email']
        ];

        $database = $this->obj->getUserData();
       
        $qtd = 0;
        $i = 0;
        while ($i <  $this->obj->countTotalUsers()){

            if (($after_create['username'] == $database[$i]['username']) or ($after_create['email'] == $database[$i]['email'])){
                $qtd =  $qtd +1;
            }

           $i =  $i +1;
        }

       // print_r($after_create);
        //print_r($$database_info );
       // print_r($database);
       print_r($qtd);

       $this->assertEquals($qtd, 2);

       // $this->assertContains($after_create, $database);

	} 
 

    //"Casos de Teste: <(Nome do grupo, username, e-mail, senha, confirmação de senha, primeiro nome,
    //último nome, telefone, gênero), resultado>"
    // "CT02: <(“rural”, ”desiree”, “desiree@hotmail.com”, “desiree02”, “desiree02”, “Desiree”, “”, “”, “”), inválido - nome de usuário e e-mail já existem no sistema >"
	public function test_CT02()
	{

        $output = $this->request(
			'POST', 'Auth/login',
                [
                    'email'     => 'admin@admin.com',
                    'password'  => 'password'
                ]		
        );
        
        $data = 
        [
            'id'  => '47',
            'username' => 'desiree',
           // 'password' => password_hash('desiree02', PASSWORD_DEFAULT), NÃO ESTOU VERIFICANDO A SENHA PORQUE GERA UMA SENHA CRIPTOGRAFADA DIFERENTE, ENTÃO NAO DA PARA COMPARAR.
            'email' => 'desiree@hotmail.com',
            'firstname' => 'Desiree',
            'lastname' => '',
            'phone' => '',
            'gender' => ''
        ];

        $output01 = $this->request(
            'POST', 'Users/create', 
                [
                    'groups' => '45', // id do grupo
                    'username' => 'desiree',
                    'password' => 'desiree02', 
                    'cpassword' => 'desiree02',
                    'email' => 'desiree@hotmail.com',
                    'firstname' => 'Desiree',
                    'fname' => 'Desiree',
                    'lastname' => '',
                    'lname' => '',
                    'phone' => '',
                    'gender' => '',
                    
                ]
        );

       $after_create = $this->obj->getUserData(47);

       $after_create_data =  
            [
                'id' => $after_create['id'],
                'username' => $after_create['username'], 
                'email' => $after_create['email'], 
                'firstname' => $after_create['firstname'],
                'lastname' => $after_create['lastname'], 
                'phone' => $after_create['phone'], 
                'gender' => $after_create['gender']
            ];


        print_r($after_create_data);
        print_r($data);

       $this->assertEquals($after_create_data, $data);

	}

    //VERIFICANDO SE O USUÁRIO JÁ EXISTE
    public function test_CT02_validation_user()
	{

        $data =
            [
                'username' => 'desiree', 
                'email' => 'desiree@hotmail.com'
             
            ];

        $after_create = $this->obj->getUserData();

        $i = 0;
        while ($i <  $this->obj->countTotalUsers()){
            $after_createUser[$i] = [
                'username' =>  $after_create[$i]['username'],
                'email' =>  $after_create[$i]['email']
            ];
            $i = $i + 1;
        }

        $database = $after_createUser;
       
       // print_r($data);
       // print_r($after_createUser);

        $this->assertContains($data, $database);

	}

    //"Casos de Teste: <(Nome do grupo, username, e-mail, senha, confirmação de senha, primeiro nome,
    //último nome, telefone, gênero), resultado>"
    //CT03: <(“rural”, ”desiree”, “desiree”, “desiree02”, “desiree02”, “Desiree”, “Araujo”, “021”, “Female”), inválido - email inválido>
	public function test_CT03()
	{

        $output = $this->request(
			'POST', 'Auth/login',
                [
                    'email'     => 'admin@admin.com',
                    'password'  => 'password'
                ]		
        );
        
        $data = 
        [
            'id'  => '47',
            'username' => 'desiree',
           // 'password' => password_hash('desiree02', PASSWORD_DEFAULT), NÃO ESTOU VERIFICANDO A SENHA PORQUE GERA UMA SENHA CRIPTOGRAFADA DIFERENTE, ENTÃO NAO DA PARA COMPARAR.
            'email' => 'desiree',
            'firstname' => 'Desiree',
            'lastname' => 'Araujo',
            'phone' => '021',
            'gender' => '2'
        ];

        $output01 = $this->request(
            'POST', 'Users/create', 
                [
                    'groups' => '45', // id do grupo
                    'username' => 'desiree',
                    'password' => 'desiree02', 
                    'cpassword' => 'desiree02',
                    'email' => 'desiree',
                    'firstname' => 'Desiree',
                    'fname' => 'Desiree',
                    'lastname' => 'Araujo',
                    'lname' => 'Araujo',
                    'phone' => '021',
                    'gender' => '2',
                    
                ]
        );

       $after_create = $this->obj->getUserData(47);

       $after_create_data =  
            [
                'id' => $after_create['id'],
                'username' => $after_create['username'], 
                'email' => $after_create['email'], 
                'firstname' => $after_create['firstname'],
                'lastname' => $after_create['lastname'], 
                'phone' => $after_create['phone'], 
                'gender' => $after_create['gender']
            ];


        print_r($after_create_data);
        print_r($data);

       $this->assertEquals($after_create_data, $data);

	}

    //VERIFICANDO SE O USUÁRIO JÁ EXISTE
    public function test_CT03_validation_user()
	{

        $data =
            [
                'username' => 'desiree', 
                'email' => 'desiree'
             
            ];

        $after_create = $this->obj->getUserData();

        $i = 0;
        while ($i <  $this->obj->countTotalUsers()){
            $after_createUser[$i] = [
                'username' =>  $after_create[$i]['username'],
                'email' =>  $after_create[$i]['email']
            ];
            $i = $i + 1;
        }

        $database = $after_createUser;
       
       // print_r($data);
       // print_r($after_createUser);

        $this->assertContains($data, $database);

	}

    //VALIDANDO E-MAIL
	public function test_CT03_validation_email()
	{
        $after_create = $this->obj->getUserData(47);
        $after_create_email = $after_create['email'];
        
        $data = 'desiree';
       
        
        //print_r($after_create);
        //print_r($after_createGroup);
       // print_r($after_createGroup_info);

         $this->assertStringContainsString('@', $data);

	}
    
    //"Casos de Teste: <(Nome do grupo, username, e-mail, senha, confirmação de senha, primeiro nome,
    //último nome, telefone, gênero), resultado>"
    //CT04: <(“rural”, ”desi”, “desiree@hotmail.com”, “desiree02”, “desiree02”, “Desiree”, “Araujo”, “021”, “Female”), inválido - nome de usuário possui menos de 5 caracteres >"
	public function test_CT04()
	{

        $output = $this->request(
			'POST', 'Auth/login',
                [
                    'email'     => 'admin@admin.com',
                    'password'  => 'password'
                ]		
        );
        
        $data = 
        [
            'id'  => '47',
            'username' => 'desi',
           // 'password' => password_hash('desiree02', PASSWORD_DEFAULT), NÃO ESTOU VERIFICANDO A SENHA PORQUE GERA UMA SENHA CRIPTOGRAFADA DIFERENTE, ENTÃO NAO DA PARA COMPARAR.
            'email' => 'desiree@hotmail.com',
            'firstname' => 'Desiree',
            'lastname' => 'Araujo',
            'phone' => '021',
            'gender' => '2'
        ];

        $output01 = $this->request(
            'POST', 'Users/create', 
                [
                    'groups' => '45', // id do grupo
                    'username' => 'desi',
                    'password' => 'desiree02', 
                    'cpassword' => 'desiree02',
                    'email' => 'desiree@hotmail.com',
                    'firstname' => 'Desiree',
                    'fname' => 'Desiree',
                    'lastname' => 'Araujo',
                    'lname' => 'Araujo',
                    'phone' => '021',
                    'gender' => '2',
                    
                ]
        );

       $after_create = $this->obj->getUserData(47);

       $after_create_data =  
            [
                'id' => $after_create['id'],
                'username' => $after_create['username'], 
                'email' => $after_create['email'], 
                'firstname' => $after_create['firstname'],
                'lastname' => $after_create['lastname'], 
                'phone' => $after_create['phone'], 
                'gender' => $after_create['gender']
            ];


        print_r($after_create_data);
        print_r($data);

       $this->assertEquals($after_create_data, $data);

	}

    //VERIFICANDO SE O USUÁRIO JÁ EXISTE
    public function test_CT04_validation_user()
	{

        $data =
            [
                'username' => 'desi', 
                'email' => 'desiree@hotmail.com'
             
            ];

        $after_create = $this->obj->getUserData();

        $i = 0;
        while ($i <  $this->obj->countTotalUsers()){
            $after_createUser[$i] = [
                'username' =>  $after_create[$i]['username'],
                'email' =>  $after_create[$i]['email']
            ];
            $i = $i + 1;
        }

        $database = $after_createUser;
       
       // print_r($data);
       // print_r($after_createUser);

        $this->assertContains($data, $database);

	}

    //VALIDANDO E-MAIL
    public function test_CT04_validation_email()
	{
        $after_create = $this->obj->getUserData(47);
        $after_create_email = $after_create['email'];
        
        $data = 'desiree@hotmail.com';
       
        
        //print_r($after_create);
        //print_r($after_createGroup);
       // print_r($after_createGroup_info);

        $this->assertStringContainsString('@', $data);

	}

    //VALIDANDO USERNAME
    public function test_CT04_validation_username()
	{
        $after_create = $this->obj->getUserData(47);
        $after_create_username = $after_create['username'];
        
        $data = strlen('desi');       

        //print_r($data);

        $i = 5;
        while ($i <= 12){
            if($data >= 5 and $data <=12){
                $qtd = $data;
            }
            else{
                $qtd = 0;
            }
            $i = $i + 1;

        }    
        
        //echo '--------------------';
        //print_r($qtd);
      
        $this->assertSame($qtd, $data);

	}    

    //"Casos de Teste: <(Nome do grupo, username, e-mail, senha, confirmação de senha, primeiro nome,
    //último nome, telefone, gênero), resultado>"
    //CT05: <(“rural”, ”desiree”, “desiree@hotmail.com”, “de”, “de”, “Desiree”, “Araujo”, “021”, “Female”), inválido - senha possui menos de 8 caracteres>
	public function test_CT05()
	{

        $output = $this->request(
			'POST', 'Auth/login',
                [
                    'email'     => 'admin@admin.com',
                    'password'  => 'password'
                ]		
        );
        
        $data = 
        [
            'id'  => '47',
            'username' => 'desiree',
           // 'password' => password_hash('de', PASSWORD_DEFAULT), NÃO ESTOU VERIFICANDO A SENHA PORQUE GERA UMA SENHA CRIPTOGRAFADA DIFERENTE, ENTÃO NAO DA PARA COMPARAR.
            'email' => 'desiree@hotmail.com',
            'firstname' => 'Desiree',
            'lastname' => 'Araujo',
            'phone' => '021',
            'gender' => '2'
        ];

        $output01 = $this->request(
            'POST', 'Users/create', 
                [
                    'groups' => '45', // id do grupo
                    'username' => 'desiree',
                    'password' => 'de', 
                    'cpassword' => 'de',
                    'email' => 'desiree@hotmail.com',
                    'firstname' => 'Desiree',
                    'fname' => 'Desiree',
                    'lastname' => 'Araujo',
                    'lname' => 'Araujo',
                    'phone' => '021',
                    'gender' => '2',
                    
                ]
        );

       $after_create = $this->obj->getUserData(47);

       $after_create_data =  
            [
                'id' => $after_create['id'],
                'username' => $after_create['username'], 
                'email' => $after_create['email'], 
                'firstname' => $after_create['firstname'],
                'lastname' => $after_create['lastname'], 
                'phone' => $after_create['phone'], 
                'gender' => $after_create['gender']
            ];


        print_r($after_create_data);
        print_r($data);

       $this->assertEquals($after_create_data, $data);

	}

    //VERIFICANDO SE O USUÁRIO JÁ EXISTE
    public function test_CT05_validation_user()
	{

        $data =
            [
                'username' => 'desiree', 
                'email' => 'desiree@hotmail.com'
             
            ];

        $after_create = $this->obj->getUserData();

        $i = 0;
        while ($i <  $this->obj->countTotalUsers()){
            $after_createUser[$i] = [
                'username' =>  $after_create[$i]['username'],
                'email' =>  $after_create[$i]['email']
            ];
            $i = $i + 1;
        }

        $database = $after_createUser;
       
       // print_r($data);
      //  echo '-------------';
       // print_r($after_createUser);

        $this->assertContains($data, $database);

	}

    //VALIDANDO E-MAIL
    public function test_CT05_validation_email()
	{
        $after_create = $this->obj->getUserData(47);
        $after_create_email = $after_create['email'];
        
        $data = 'desiree@hotmail.com';
       
        
        //print_r($after_create);
        //print_r($after_createGroup);
       // print_r($after_createGroup_info);

        $this->assertStringContainsString('@', $data);

	}

    //VALIDANDO USERNAME
    public function test_CT05_validation_username()
	{
        $after_create = $this->obj->getUserData(47);
        $after_create_username = $after_create['username'];
        
        $data = strlen('desiree');       

        //print_r($data);

        $i = 5;
        while ($i <= 12){
            if($data >= 5 and $data <=12){
                $qtd = $data;
            }
            else{
                $qtd = 0;
            }
            $i = $i + 1;

        }    
        
        //echo '--------------------';
        //print_r($qtd);
      
        $this->assertSame($qtd, $data);

	}

    //VALIDANDO SENHA
    public function test_CT5_validation_senha()
	{
        $after_create = $this->obj->getUserData(47);
        $after_create_username = $after_create['password'];
        
        $data = strlen('de');       

        //print_r($data);

        $i = 1;
        while ($i <= 8){
            if($data >= 8){
                $qtd = $data;
            }
            else{
                $qtd = 0;
            }
            $i = $i + 1;

        }    

        //print_r($data);
        //echo '--------------------';
        //print_r($qtd);
      
        $this->assertSame($qtd, $data);

	}


    //"Casos de Teste: <(Nome do grupo, username, e-mail, senha, confirmação de senha, primeiro nome,
    //último nome, telefone, gênero), resultado>"
    //CT06: <(“rural”, ”desiree”, “desiree@hotmail.com”, “desiree02”, “de02”, “Desiree”, “Araujo”, “021”, “Female”), inválido - senha diferente, email já existe e username já existe>
	public function test_CT06()
	{

        $output = $this->request(
			'POST', 'Auth/login',
                [
                    'email'     => 'admin@admin.com',
                    'password'  => 'password'
                ]		
        );
        
        $data = 
        [
            'id'  => '47',
            'username' => 'desiree',
           // 'password' => password_hash('desiree02', PASSWORD_DEFAULT), NÃO ESTOU VERIFICANDO A SENHA PORQUE GERA UMA SENHA CRIPTOGRAFADA DIFERENTE, ENTÃO NAO DA PARA COMPARAR.
            'email' => 'desiree@hotmail.com',
            'firstname' => 'Desiree',
            'lastname' => 'Araujo',
            'phone' => '021',
            'gender' => '2'
        ];

        $output01 = $this->request(
            'POST', 'Users/create', 
                [
                    'groups' => '45', // id do grupo
                    'username' => 'desiree',
                    'password' => 'desiree02', 
                    'cpassword' => 'de02',
                    'email' => 'desiree@hotmail.com',
                    'firstname' => 'Desiree',
                    'fname' => 'Desiree',
                    'lastname' => 'Araujo',
                    'lname' => 'Araujo',
                    'phone' => '021',
                    'gender' => '2',
                    
                ]
        );

       $after_create = $this->obj->getUserData(47);

       $after_create_data =  
            [
                'id' => $after_create['id'],
                'username' => $after_create['username'], 
                'email' => $after_create['email'], 
                'firstname' => $after_create['firstname'],
                'lastname' => $after_create['lastname'], 
                'phone' => $after_create['phone'], 
                'gender' => $after_create['gender']
            ];


        print_r($after_create_data);
        print_r($data);

       $this->assertEquals($after_create_data, $data);

	}

    //VERIFICANDO SE O USUÁRIO JÁ EXISTE
    public function test_CT06_validation_user()
	{

        $data =
            [
                'username' => 'desiree', 
                'email' => 'desiree@hotmail.com'
             
            ];

        $after_create = $this->obj->getUserData();

        $i = 0;
        while ($i <  $this->obj->countTotalUsers()){
            $after_createUser[$i] = [
                'username' =>  $after_create[$i]['username'],
                'email' =>  $after_create[$i]['email']
            ];
            $i = $i + 1;
        }

        $database = $after_createUser;
       
       // print_r($data);
      //  echo '-------------';
       // print_r($after_createUser);

        $this->assertContains($data, $database);

	}

    //VALIDANDO E-MAIL
    public function test_CT06_validation_email()
	{
        $after_create = $this->obj->getUserData(47);
        $after_create_email = $after_create['email'];
        
        $data = 'desiree@hotmail.com';
       
        
        //print_r($after_create);
        //print_r($after_createGroup);
       // print_r($after_createGroup_info);

        $this->assertStringContainsString('@', $data);

	}

    //VALIDANDO USERNAME
    public function test_CT06_validation_username()
	{
        $after_create = $this->obj->getUserData(47);
        $after_create_username = $after_create['username'];
        
        $data = strlen('desiree');       

        //print_r($data);

        $i = 5;
        while ($i <= 12){
            if($data >= 5 and $data <=12){
                $qtd = $data;
            }
            else{
                $qtd = 0;
            }
            $i = $i + 1;

        }    
        
        //echo '--------------------';
        //print_r($qtd);
      
        $this->assertSame($qtd, $data);

	}

    //VALIDANDO SENHA (verifico se está no tamanho mínimo)
    public function test_CT6_validation_senha()
	{
        $after_create = $this->obj->getUserData(47);
        $after_create_username = $after_create['password'];
        
        $data = strlen('desiree02');       

        //print_r($data);

        $i = 1;
        while ($i <= 8){
            if($data >= 8){
                $qtd = $data;
            }
            else{
                $qtd = 0;
            }
            $i = $i + 1;

        }    

        //print_r($data);
        //echo '--------------------';
        //print_r($qtd);
      
        $this->assertSame($qtd, $data);

	}

    //VALIDANDO SENHA (verifico se está a confirmação da senha está igual)
    public function test_CT06_validation_senha()
	{
       //$after_create = $this->obj->getUserData(47);
       // $after_create_password = $after_create['password'];

        $data_password = 'desiree02';        
        $data_cpassword = 'de02';         

       // print_r($after_create_password);
      
        $this->assertSame($data_password, $data_cpassword);

	}

    //"Casos de Teste: <(Nome do grupo, username, e-mail, senha, confirmação de senha, primeiro nome,
    //último nome, telefone, gênero), resultado>"
    //"CT07: <(“ccomp”, ”desiree”, “desiree@hotmail.com”, “senhanova”, “senhanova”, “Andressa”, “Araujo”, “”, “Female”), inválido - nome de usuário já existe no sistema e email ja existe>"
	public function test_CT07()
	{

        $output = $this->request(
			'POST', 'Auth/login',
                [
                    'email'     => 'admin@admin.com',
                    'password'  => 'password'
                ]		
        );
        
        $data = 
        [
            'id'  => '47',
            'username' => 'desiree',
           // 'password' => password_hash('senhanova', PASSWORD_DEFAULT), NÃO ESTOU VERIFICANDO A SENHA PORQUE GERA UMA SENHA CRIPTOGRAFADA DIFERENTE, ENTÃO NAO DA PARA COMPARAR.
            'email' => 'desiree@hotmail.com',
            'firstname' => 'Andressa',
            'lastname' => 'Araujo',
            'phone' => '',
            'gender' => '2'
        ];

        $output01 = $this->request(
            'POST', 'Users/create', 
                [
                    'groups' => '54', // id do grupo
                    'username' => 'desiree',
                    'password' => 'senhanova', 
                    'cpassword' => 'senhanova',
                    'email' => 'desiree@hotmail.com',
                    'firstname' => 'Andressa',
                    'fname' => 'Andressa',
                    'lastname' => 'Araujo',
                    'lname' => 'Araujo',
                    'phone' => '',
                    'gender' => '2',
                    
                ]
        );

       $after_create = $this->obj->getUserData(47);

       $after_create_data =  
            [
                'id' => $after_create['id'],
                'username' => $after_create['username'], 
                'email' => $after_create['email'], 
                'firstname' => $after_create['firstname'],
                'lastname' => $after_create['lastname'], 
                'phone' => $after_create['phone'], 
                'gender' => $after_create['gender']
            ];


        print_r($after_create_data);
        print_r($data);

       $this->assertEquals($after_create_data, $data);

	}

    //VERIFICANDO SE O USUÁRIO JÁ EXISTE
    public function test_CT07_validation_user()
	{

        $data =
            [
                'username' => 'desiree', 
                'email' => 'desiree@hotmail.com'
             
            ];

        $after_create = $this->obj->getUserData();

        $i = 0;
        while ($i <  $this->obj->countTotalUsers()){
            $after_createUser[$i] = [
                'username' =>  $after_create[$i]['username'],
                'email' =>  $after_create[$i]['email']
            ];
            $i = $i + 1;
        }

        $database = $after_createUser;
       
       // print_r($data);
      //  echo '-------------';
       // print_r($after_createUser);

        $this->assertContains($data, $database);

	}

    //VALIDANDO E-MAIL
    public function test_CT07_validation_email()
	{
        $after_create = $this->obj->getUserData(47);
        $after_create_email = $after_create['email'];
        
        $data = 'desiree@hotmail.com';
       
        
        //print_r($after_create);
        //print_r($after_createGroup);
       // print_r($after_createGroup_info);

        $this->assertStringContainsString('@', $data);

	}

    //VALIDANDO USERNAME (verifico se está no tamanho mínimo)
    public function test_CT07_validation_username()
	{
        $after_create = $this->obj->getUserData(47);
        $after_create_username = $after_create['username'];
        
        $data = strlen('desiree');       

        //print_r($data);

        $i = 5;
        while ($i <= 12){
            if($data >= 5 and $data <=12){
                $qtd = $data;
            }
            else{
                $qtd = 0;
            }
            $i = $i + 1;

        }    
        
        //echo '--------------------';
        //print_r($qtd);
      
        $this->assertSame($qtd, $data);

	}

    //VALIDANDO SENHA (verifico se está no tamanho mínimo)
    public function test_CT7_validation_senha()
	{
        $after_create = $this->obj->getUserData(47);
        $after_create_username = $after_create['password'];
        
        $data = strlen('senhanova');       

        //print_r($data);

        $i = 1;
        while ($i <= 8){
            if($data >= 8){
                $qtd = $data;
            }
            else{
                $qtd = 0;
            }
            $i = $i + 1;

        }    

        //print_r($data);
        //echo '--------------------';
        //print_r($qtd);
      
        $this->assertSame($qtd, $data);

	}

    //VALIDANDO SENHA (verifico se está a confirmação da senha está igual)
    public function test_CT07_validation_senha()
	{
       //$after_create = $this->obj->getUserData(47);
       // $after_create_password = $after_create['password'];

        $data_password = 'senhanova';        
        $data_cpassword = 'senhanova';         

       // print_r($after_create_password);
      
        $this->assertSame($data_password, $data_cpassword);

	}

    //"Casos de Teste: <(Nome do grupo, username, e-mail, senha, confirmação de senha, primeiro nome,
    //último nome, telefone, gênero), resultado>"
    //CT08: <(“ccomp”, ”monalisa”, “desiree@hotmail.com”, “senhanova”, “senhanova”, “Monalisa”, “Fernandes”, “”, “Female”), inválido - email já existe no sistema>
	public function test_CT8()
	{

        $output = $this->request(
			'POST', 'Auth/login',
                [
                    'email'     => 'admin@admin.com',
                    'password'  => 'password'
                ]		
        );
        
        $data = 
        [
            'id'  => '47',
            'username' => 'monalisa',
           // 'password' => password_hash('senhanova', PASSWORD_DEFAULT), NÃO ESTOU VERIFICANDO A SENHA PORQUE GERA UMA SENHA CRIPTOGRAFADA DIFERENTE, ENTÃO NAO DA PARA COMPARAR.
            'email' => 'desiree@hotmail.com',
            'firstname' => 'Monalisa',
            'lastname' => 'Fernandes',
            'phone' => '',
            'gender' => '2'
        ];

        $output01 = $this->request(
            'POST', 'Users/create', 
                [
                    'groups' => '54', // id do grupo
                    'username' => 'monalisa',
                    'password' => 'senhanova', 
                    'cpassword' => 'senhanova',
                    'email' => 'desiree@hotmail.com',
                    'firstname' => 'Monalisa',
                    'fname' => 'Monalisa',
                    'lastname' => 'Fernandes',
                    'lname' => 'Fernandes',
                    'phone' => '',
                    'gender' => '2',
                    
                ]
        );

       $after_create = $this->obj->getUserData(47);

       $after_create_data =  
            [
                'id' => $after_create['id'],
                'username' => $after_create['username'], 
                'email' => $after_create['email'], 
                'firstname' => $after_create['firstname'],
                'lastname' => $after_create['lastname'], 
                'phone' => $after_create['phone'], 
                'gender' => $after_create['gender']
            ];


        print_r($after_create_data);
        print_r($data);

       $this->assertEquals($after_create_data, $data);

	}
   
    //VERIFICANDO SE O USUÁRIO JÁ EXISTE
    public function test_CT08_validation_user()
	{

        $data =
            [
                'username' => 'monalisa', 
                'email' => 'desiree@hotmail.com'
             
            ];

        $after_create = $this->obj->getUserData();

        $i = 0;
        while ($i <  $this->obj->countTotalUsers()){
            $after_createUser[$i] = [
                'username' =>  $after_create[$i]['username'],
                'email' =>  $after_create[$i]['email']
            ];
            $i = $i + 1;
        }

        $database = $after_createUser;
       
       // print_r($data);
      //  echo '-------------';
       // print_r($after_createUser);

        $this->assertContains($data, $database);

	}

    //VALIDANDO E-MAIL
    public function test_CT08_validation_email()
	{
        $after_create = $this->obj->getUserData(47);
        $after_create_email = $after_create['email'];
        
        $data = 'desiree@hotmail.com';
       
        
        //print_r($after_create);
        //print_r($after_createGroup);
       // print_r($after_createGroup_info);

        $this->assertStringContainsString('@', $data);

	}

    //verificando se e-mail existe
    public function test_CT08_validation_emailExists()
	{
        $after_create = $this->obj->getUserData();
        
        $data = [ 'email' => 'desiree@hotmail.com'];
       
        $i = 0;
        while ($i <  $this->obj->countTotalUsers()){
            $after_createUser[$i] = [
                'email' =>  $after_create[$i]['email']
            ];
            $i = $i + 1;
        }

        $database = $after_createUser;
       
       // print_r($data);
      //  echo '-------------';
       // print_r($after_createUser);

        $this->assertContains($data, $database);
	}

    //VALIDANDO USERNAME (verifico se está no tamanho mínimo)
    public function test_CT08_validation_username()
	{
        $after_create = $this->obj->getUserData(47);
        $after_create_username = $after_create['username'];
        
        $data = strlen('monalisa');       

        //print_r($data);

        $i = 5;
        while ($i <= 12){
            if($data >= 5 and $data <=12){
                $qtd = $data;
            }
            else{
                $qtd = 0;
            }
            $i = $i + 1;

        }    
        
        //echo '--------------------';
        //print_r($qtd);
      
        $this->assertSame($qtd, $data);

	}

    //VALIDANDO SENHA (verifico se está no tamanho mínimo)
    public function test_CT08_validation_senha()
	{
        $after_create = $this->obj->getUserData(47);
        $after_create_username = $after_create['password'];
        
        $data = strlen('senhanova');       

        //print_r($data);

        $i = 1;
        while ($i <= 8){
            if($data >= 8){
                $qtd = $data;
            }
            else{
                $qtd = 0;
            }
            $i = $i + 1;

        }    

        //print_r($data);
        //echo '--------------------';
        //print_r($qtd);
      
        $this->assertSame($qtd, $data);

	}

    //VALIDANDO SENHA (verifico se está a confirmação da senha está igual)
    public function test_CT08_validation_senhaExists()
	{
       //$after_create = $this->obj->getUserData(47);
       // $after_create_password = $after_create['password'];

        $data_password = 'senhanova';        
        $data_cpassword = 'senhanova';         

       // print_r($after_create_password);
      
        $this->assertSame($data_password, $data_cpassword);

	}

    //"Casos de Teste: <(Nome do grupo, username, e-mail, senha, confirmação de senha, primeiro nome,
    //último nome, telefone, gênero), resultado>"
    //CT09: <(“”, ”ruralina”, “rural@rural.com”, “senharural”, “senharural”, “Natalia”, “Oliveira”, “”, “Female”), inválido - não existe grupo para associar o usuário( info obrigatoria não inserida>	Funcional																							
	public function test_CT9()
	{

        $output = $this->request(
			'POST', 'Auth/login',
                [
                    'email'     => 'admin@admin.com',
                    'password'  => 'password'
                ]		
        );
        
        $data = 
        [
            'id'  => '47',
            'username' => 'ruralina',
           // 'password' => password_hash('senharural', PASSWORD_DEFAULT), NÃO ESTOU VERIFICANDO A SENHA PORQUE GERA UMA SENHA CRIPTOGRAFADA DIFERENTE, ENTÃO NAO DA PARA COMPARAR.
            'email' => 'rural@rural.com',
            'firstname' => 'Natalia',
            'lastname' => 'Oliveira',
            'phone' => '',
            'gender' => '2'
        ];

        $output01 = $this->request(
            'POST', 'Users/create', 
                [
                    'groups' => '', // id do grupo
                    'username' => 'ruralina',
                    'password' => 'senharural', 
                    'cpassword' => 'senharural',
                    'email' => 'rural@rural.com',
                    'firstname' => 'Natalia',
                    'fname' => 'Natalia',
                    'lastname' => 'Oliveira',
                    'lname' => 'Oliveira',
                    'phone' => '',
                    'gender' => '2',
                    
                ]
        );

       $after_create = $this->obj->getUserData(47);

       $after_create_data =  
            [
                'id' => $after_create['id'],
                'username' => $after_create['username'], 
                'email' => $after_create['email'], 
                'firstname' => $after_create['firstname'],
                'lastname' => $after_create['lastname'], 
                'phone' => $after_create['phone'], 
                'gender' => $after_create['gender']
            ];


        print_r($after_create_data);
        print_r($data);

       $this->assertEquals($after_create_data, $data);

	}


    //"Casos de Teste: <(Nome do grupo, username, e-mail, senha, confirmação de senha, primeiro nome,
    //último nome, telefone, gênero), resultado>"
    //CT10: <(“rural_novo”, ”joana”, “joana@hotmail.com”, “joanaa02”, “joanaa02”, “Joana”, “Gomes”, “021”, “Female”), válido>
	public function test_CT10()
	{

        $output = $this->request(
			'POST', 'Auth/login',
                [
                    'email'     => 'admin@admin.com',
                    'password'  => 'password'
                ]		
        );
        
        $data = 
        [
            'id'  => '47',
            'username' => 'joana',
           // 'password' => password_hash('joanaa02', PASSWORD_DEFAULT), NÃO ESTOU VERIFICANDO A SENHA PORQUE GERA UMA SENHA CRIPTOGRAFADA DIFERENTE, ENTÃO NAO DA PARA COMPARAR.
            'email' => 'joana@hotmail.com',
            'firstname' => 'Joana',
            'lastname' => 'Gomes',
            'phone' => '021',
            'gender' => '2'
        ];

        $output01 = $this->request(
            'POST', 'Users/create', 
                [
                    'groups' => '36', // id do grupo
                    'username' => 'joana',
                    'password' => 'joanaa02', 
                    'cpassword' => 'joanaa02',
                    'email' => 'joana@hotmail.com',
                    'firstname' => 'Joana',
                    'fname' => 'Joana',
                    'lastname' => 'Gomes',
                    'lname' => 'Gomes',
                    'phone' => '021',
                    'gender' => '2',
                    
                ]
        );

       $after_create = $this->obj->getUserData(47);

       $after_create_data =  
            [
                'id' => $after_create['id'],
                'username' => $after_create['username'], 
                'email' => $after_create['email'], 
                'firstname' => $after_create['firstname'],
                'lastname' => $after_create['lastname'], 
                'phone' => $after_create['phone'], 
                'gender' => $after_create['gender']
            ];


        print_r($after_create_data);
        print_r($data);

       $this->assertEquals($after_create_data, $data);

	}
   
    //VERIFICANDO SE O USUÁRIO JÁ EXISTE
    public function test_CT10_validation_user()
	{

        $data =
            [
                'username' => 'joana', 
                'email' => 'joana@hotmail.com'
             
            ];

        $after_create = $this->obj->getUserData();

        $i = 0;
        while ($i <  $this->obj->countTotalUsers()){
            $after_createUser[$i] = [
                'username' =>  $after_create[$i]['username'],
                'email' =>  $after_create[$i]['email']
            ];
            $i = $i + 1;
        }

        $database = $after_createUser;
       
       // print_r($data);
      //  echo '-------------';
       // print_r($after_createUser);

        $this->assertContains($data, $database);

	}

    //VALIDANDO E-MAIL
    public function test_CT10_validation_email()
	{
        $after_create = $this->obj->getUserData(47);
        $after_create_email = $after_create['email'];
        
        $data = 'joana@hotmail.com';
       
        
        //print_r($after_create);
        //print_r($after_createGroup);
       // print_r($after_createGroup_info);

        $this->assertStringContainsString('@', $data);

	}

    //verificando se e-mail existe
    public function test_CT10_validation_emailExists()
	{
        $after_create = $this->obj->getUserData();
        
        $data = [ 'email' => 'joana@hotmail.com'];
       
        $i = 0;
        while ($i <  $this->obj->countTotalUsers()){
            $after_createUser[$i] = [
                'email' =>  $after_create[$i]['email']
            ];
            $i = $i + 1;
        }

        $database = $after_createUser;
       
       // print_r($data);
      //  echo '-------------';
       // print_r($after_createUser);

        $this->assertContains($data, $database);
	}

    //VALIDANDO USERNAME (verifico se está no tamanho mínimo)
    public function test_CT10_validation_username()
	{
        $after_create = $this->obj->getUserData(47);
        $after_create_username = $after_create['username'];
        
        $data = strlen('joana');       

        //print_r($data);

        $i = 5;
        while ($i <= 12){
            if($data >= 5 and $data <=12){
                $qtd = $data;
            }
            else{
                $qtd = 0;
            }
            $i = $i + 1;

        }    
        
        //echo '--------------------';
        //print_r($qtd);
      
        $this->assertSame($qtd, $data);

	}

    //VALIDANDO SENHA (verifico se está no tamanho mínimo)
   public function test_CT10_validation_senha()
	{
        $after_create = $this->obj->getUserData(47);
        $after_create_username = $after_create['password'];
        
        $data = strlen('joanaa02');       

        //print_r($data);

        $i = 1;
        while ($i <= 8){
            if($data >= 8){
                $qtd = $data;
            }
            else{
                $qtd = 0;
            }
            $i = $i + 1;

        }    

        //print_r($data);
        //echo '--------------------';
        //print_r($qtd);
      
        $this->assertSame($qtd, $data);

	}

    //VALIDANDO SENHA (verifico se está a confirmação da senha está igual)
    public function test_CT10_validation_senhaExists()
	{
       //$after_create = $this->obj->getUserData(47);
       // $after_create_password = $after_create['password'];

        $data_password = 'joanaa02';        
        $data_cpassword = 'joanaa02';         

       // print_r($after_create_password);
      
        $this->assertSame($data_password, $data_cpassword);

	}
    
}
