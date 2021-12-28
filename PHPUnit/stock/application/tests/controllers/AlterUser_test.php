<?php

class AlterUser_test extends UnitTestCase
{
    public function setUp(): void
    {
        $this->resetInstance();        
        $this->CI->load->model('model_users');
        $this->CI->load->model('model_groups');
        $this->obj = $this->CI->model_users;
        $this->obj1 = $this->CI->model_groups;
    }
    
    //"Casos de Teste: <(Nome do usuário, e-mail, nome, telefone, grupo, 
    //grupo, nome de usuário,e-mail, primeiro nome, último nome, telefone, gênero, senha, confirmação de senha), resultado>"
    //CT01: <(“desiree”,””, “”, “”, “”, 
    //“N/A*”, ”desiree01”, “N/A*”, “N/A*”, “N/A*”, “N/A*”, “N/A*”, “”, “”), válido>
    public function test_CT01()
	{

        $output = $this->request(
			'POST', 'Auth/login',
                [
                    'email'     => 'admin@admin.com',
                    'password'  => 'password'
                ]		
        );
        
        $before_update = $this->obj1->getUserGroupByUserId(46);
        $before_update_group = $before_update['group_id'];

        $before_update_user = $this->obj->getUserData(46);
        //$before_update_user_username = $before_update['username'];
        $before_update_user_fname = $before_update_user['firstname'];
        $before_update_user_lname = $before_update_user['lastname'];
        $before_update_user_email = $before_update_user['email'];
        $before_update_user_phone = $before_update_user['phone'];
        $before_update_user_gender = $before_update_user['gender'];
        $before_update_user_password = $before_update_user['password'];

        $output01 = $this->request(
            'POST', ['Users', 'edit', '46'],
                [
                    'groups' => $before_update_group, // id do grupo
                    'username' => 'desiree01',
                    'password' =>  '', 
                    'cpassword' =>  '',
                    'email' => $before_update_user_email,
                    'firstname' => $before_update_user_fname,
                    'fname' => $before_update_user_fname ,
                    'lastname' => $before_update_user_lname,
                    'lname' => $before_update_user_lname,
                    'phone' => $before_update_user_phone,
                    'gender' => $before_update_user_gender,
                    
                ]
        );

        $after_update = $this->obj->getUserData(46);

        //print_r($before_update);
        print_r($before_update_user);
        print_r($after_update);

        $this->assertEquals($before_update_user, $after_update);

	}

    public function test_CT01_validation()
	{    
        $after_update = $this->obj->getUserData(46); 
        $after_update_data = 
        [ 
            'id' => $after_update['id'],
            'username' => $after_update['username']
        ];

        
        $data =
            [   
                'id' => '46',
                'username' => 'desiree01'
            ];

        print_r($after_update_data);
        print_r($data);
       
        $this->assertEquals($after_update_data, $data);
	}

    //"Casos de Teste: <(Nome do usuário, e-mail, nome, telefone, grupo, 
    //grupo, nome de usuário,e-mail, primeiro nome, último nome, telefone, gênero, senha, confirmação de senha), resultado>"
    //CT03: <(“”,”desiree@hotmail.com”, “”, “”, “”, 
    //“N/A*”, ”N/A*”, “N/A*”, “Desiree Araujo”, “N/A*”, “N/A*”, “Male”, “021345778”, “021345778”), válido>
    public function test_CT03()
	{

        $output = $this->request(
			'POST', 'Auth/login',
                [
                    'email'     => 'admin@admin.com',
                    'password'  => 'password'
                ]		
        );
        
        $before_update = $this->obj1->getUserGroupByUserId(46);
        $before_update_group = $before_update['group_id'];

        $before_update_user = $this->obj->getUserData(46);
        $before_update_user_username = $before_update_user['username'];
        $before_update_user_fname = $before_update_user['firstname'];
        $before_update_user_lname = $before_update_user['lastname'];
        $before_update_user_email = $before_update_user['email'];
        $before_update_user_phone = $before_update_user['phone'];
        $before_update_user_gender = $before_update_user['gender'];
        $before_update_user_password = $before_update_user['password'];

        $before_update_user_data =
        [
            'id' => $before_update_user['id'],
            'username' => $before_update_user['username'],
            'email' => $before_update_user['email'],
            'firstname' => $before_update_user['firstname'],
            'lastname' => $before_update_user['lastname'],
            'phone' => $before_update_user['phone'],
            'gender' => $before_update_user['gender'],
        ];

        $output01 = $this->request(
            'POST', ['Users', 'edit', '46'],
                [
                    'groups' => $before_update_group, // id do grupo
                    'username' => $before_update_user_username,
                    'password' =>  '021345778', 
                    'cpassword' =>  '021345778',
                    'email' => $before_update_user_email,
                    'firstname' => 'Desiree Araujo',
                    'fname' => 'Desiree Araujo' ,
                    'lastname' => $before_update_user_lname,
                    'lname' => $before_update_user_lname,
                    'phone' => $before_update_user_phone,
                    'gender' => '1',
                    
                ]
        );

        $after_update = $this->obj->getUserData(46);
        $after_update_data =
        [
            'id' => $after_update['id'],
            'username' => $after_update['username'],
            'email' => $after_update['email'],
            'firstname' => $after_update['firstname'],
            'lastname' => $after_update['lastname'],
            'phone' => $after_update['phone'],
            'gender' => $after_update['gender'],
        ];

        //print_r($before_update);
        print_r($before_update_user_data);
        print_r($after_update_data);

        $this->assertEquals($before_update_user_data, $after_update_data);

	}
    
    public function test_CT03_validation_firstname()
	{    
        $after_update = $this->obj->getUserData(46); 
        $after_update_data = 
        [ 
            'id' => $after_update['id'],
            'firstname' => $after_update['firstname']
        ];

        
        $data =
            [   
                'id' => '46',
                'firstname' => 'Desiree Araujo'
            ];

        print_r($after_update_data);
        print_r($data);
       
        $this->assertEquals($after_update_data, $data);
	}

    public function test_CT03_validation_gender()
	{    
        $after_update = $this->obj->getUserData(46); 
        $after_update_data = 
        [ 
            'id' => $after_update['id'],
            'gender' => $after_update['gender']
        ];

        
        $data =
            [   
                'id' => '46',
                'gender' => '1'
            ];

        print_r($after_update_data);
        print_r($data);
       
        $this->assertEquals($after_update_data, $data);
	}

    public function test_CT03_validation_password()
	{    
        $after_update = $this->obj->getUserData(46); 
        $after_update_data = 
        [ 
            'id' => $after_update['id'],
            'password' => $after_update['password']
        ];

        
        $data =
            [   
                'id' => '46',
                'password' => '021345778'
            ];

        print_r($after_update_data);
        print_r($data);
       
        $this->assertEquals($after_update_data, $data);
	}

    //"Casos de Teste: <(Nome do usuário, e-mail, nome, telefone, grupo, 
    //grupo, nome de usuário,e-mail, primeiro nome, último nome, telefone, gênero, senha, confirmação de senha), resultado>"
    //CT05: <(““”,””, “”, “”, “rural”, 
    //“N/A*”, ”N/A*”, “rural”, “N/A*”, “N/A*”, “N/A*”, “Male”, “”, “”), inválido - e-mail inválido>
    public function test_CT05()
	{

        $output = $this->request(
			'POST', 'Auth/login',
                [
                    'email'     => 'admin@admin.com',
                    'password'  => 'password'
                ]		
        );
        
        $before_update = $this->obj1->getUserGroupByUserId(46);
        $before_update_group = $before_update['group_id'];

        $before_update_user = $this->obj->getUserData(46);
        $before_update_user_username = $before_update_user['username'];
        $before_update_user_fname = $before_update_user['firstname'];
        $before_update_user_lname = $before_update_user['lastname'];
        $before_update_user_email = $before_update_user['email'];
        $before_update_user_phone = $before_update_user['phone'];
        $before_update_user_gender = $before_update_user['gender'];
        $before_update_user_password = $before_update_user['password'];

        $before_update_user_data =
        [
            'id' => $before_update_user['id'],
            'username' => $before_update_user['username'],
            'email' => $before_update_user['email'],
            'firstname' => $before_update_user['firstname'],
            'lastname' => $before_update_user['lastname'],
            'phone' => $before_update_user['phone'],
            'gender' => $before_update_user['gender'],
        ];

        $output01 = $this->request(
            'POST', ['Users', 'edit', '46'],
                [
                    'groups' => $before_update_group, // id do grupo
                    'username' => $before_update_user_username,
                    'password' =>  '', 
                    'cpassword' =>  '',
                    'email' => 'rural',
                    'firstname' => $before_update_user_fname,
                    'fname' => $before_update_user_fname ,
                    'lastname' => $before_update_user_lname,
                    'lname' => $before_update_user_lname,
                    'phone' => $before_update_user_phone,
                    'gender' => '1',
                    
                ]
        );

        $after_update = $this->obj->getUserData(46);
        $after_update_data =
        [
            'id' => $after_update['id'],
            'username' => $after_update['username'],
            'email' => $after_update['email'],
            'firstname' => $after_update['firstname'],
            'lastname' => $after_update['lastname'],
            'phone' => $after_update['phone'],
            'gender' => $after_update['gender'],
        ];

        //print_r($before_update);
        print_r($before_update_user_data);
        print_r($after_update_data);

        $this->assertEquals($before_update_user_data, $after_update_data);

	}
    
    public function test_CT05_validation_email()
	{    
        $after_update = $this->obj->getUserData(46); 
        $after_update_data = 
        [ 
            'id' => $after_update['id'],
            'email' => $after_update['email']
        ];

        
        $data =
            [   
                'id' => '46',
                'email' => 'rural'
            ];

        print_r($after_update_data);
        print_r($data);
       
        $this->assertEquals($after_update_data, $data);
	}

    public function test_CT03_validation_gendeer()
	{    
        $after_update = $this->obj->getUserData(46); 
        $after_update_data = 
        [ 
            'id' => $after_update['id'],
            'gender' => $after_update['gender']
        ];

        
        $data =
            [   
                'id' => '46',
                'gender' => '1'
            ];

        print_r($after_update_data);
        print_r($data);
       
        $this->assertEquals($after_update_data, $data);
	}


    //"Casos de Teste: <(Nome do usuário, e-mail, nome, telefone, grupo, 
    //grupo, nome de usuário,e-mail, primeiro nome, último nome, telefone, gênero, senha, confirmação de senha), resultado>"
    //CT06: <(““”,””, “”, “021”, “”, 
    //“ccomp”, ”N/A*”, “N/A*”, “N/A*”, “N/A*”, “N/A*”, “N/A*”, “senha02”, “senha02”), inválido - senha menor do que 8 caracteres>
    public function test_CT06()
	{

        $output = $this->request(
			'POST', 'Auth/login',
                [
                    'email'     => 'admin@admin.com',
                    'password'  => 'password'
                ]		
        );
        
        $before_update = $this->obj1->getUserGroupByUserId(47);
        $before_update_group = $before_update['group_id'];

        $before_update_user = $this->obj->getUserData(47);
        $before_update_user_username = $before_update_user['username'];
        $before_update_user_fname = $before_update_user['firstname'];
        $before_update_user_lname = $before_update_user['lastname'];
        $before_update_user_email = $before_update_user['email'];
        $before_update_user_phone = $before_update_user['phone'];
        $before_update_user_gender = $before_update_user['gender'];
        $before_update_user_password = $before_update_user['password'];

        $before_update_user_data =
        [
            'id' => $before_update_user['id'],
            'username' => $before_update_user['username'],
            'email' => $before_update_user['email'],
            'firstname' => $before_update_user['firstname'],
            'lastname' => $before_update_user['lastname'],
            'phone' => $before_update_user['phone'],
            'gender' => $before_update_user['gender'],
        ];

        $output01 = $this->request(
            'POST', ['Users', 'edit', '47'],
                [
                    'groups' => $before_update_group, // id do grupo
                    'username' => $before_update_user_username,
                    'password' =>  'senha02', 
                    'cpassword' =>  'senha02',
                    'email' => $before_update_user_email,
                    'firstname' => $before_update_user_fname,
                    'fname' => $before_update_user_fname ,
                    'lastname' => $before_update_user_lname,
                    'lname' => $before_update_user_lname,
                    'phone' => $before_update_user_phone,
                    'gender' => $before_update_user_gender,
                    
                ]
        );

        $after_update = $this->obj->getUserData(47);
        $after_update_data =
        [
            'id' => $after_update['id'],
            'username' => $after_update['username'],
            'email' => $after_update['email'],
            'firstname' => $after_update['firstname'],
            'lastname' => $after_update['lastname'],
            'phone' => $after_update['phone'],
            'gender' => $after_update['gender'],
        ];

        //print_r($before_update);
        print_r($before_update_user_data);
        print_r($after_update_data);

        $this->assertEquals($before_update_user_data, $after_update_data);

	}
    
    public function test_CT06_validation_group()
	{    
        $after_update = $this->obj1->getGroupData(54); 
        $after_update_data = 
        [ 
            'id' => $after_update['id']
        ];

        
        $data =
            [   
                'id' => '54'
            ];

        print_r($after_update_data);
        print_r($data);
       
        $this->assertEquals($after_update_data, $data);
	}

    //verificando tamanho
    public function test_CT03_validation_passowrd()
	{    
      
        $data = strlen('senha02');       

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

    //"Casos de Teste: <(Nome do usuário, e-mail, nome, telefone, grupo, 
    //grupo, nome de usuário,e-mail, primeiro nome, último nome, telefone, gênero, senha, confirmação de senha), resultado>"
    //CT08: <(“joana”, ””, “”, “”, “”, 
    //“ccomp”, “desiree01, “N/A*”, “N/A*”, “N/A*”, “N/A*”, “N/A*”, “N/A*”, “”), inválido - nome de usuário já existe no sistema>
    public function test_CT08()
	{

        $output = $this->request(
			'POST', 'Auth/login',
                [
                    'email'     => 'admin@admin.com',
                    'password'  => 'password'
                ]		
        );
        
        $before_update = $this->obj1->getUserGroupByUserId(47);
        $before_update_group = $before_update['group_id'];

        $before_update_user = $this->obj->getUserData(47);
        $before_update_user_username = $before_update_user['username'];
        $before_update_user_fname = $before_update_user['firstname'];
        $before_update_user_lname = $before_update_user['lastname'];
        $before_update_user_email = $before_update_user['email'];
        $before_update_user_phone = $before_update_user['phone'];
        $before_update_user_gender = $before_update_user['gender'];
        $before_update_user_password = $before_update_user['password'];

        $before_update_user_data =
        [
            'id' => $before_update_user['id'],
            'username' => $before_update_user['username'],
            'email' => $before_update_user['email'],
            'firstname' => $before_update_user['firstname'],
            'lastname' => $before_update_user['lastname'],
            'phone' => $before_update_user['phone'],
            'gender' => $before_update_user['gender'],
        ];

        $output01 = $this->request(
            'POST', ['Users', 'edit', '47'],
                [
                    'groups' => $before_update_group, // id do grupo
                    'username' => 'desiree01',
                    'password' =>  '', 
                    'cpassword' =>  '',
                    'email' => $before_update_user_email,
                    'firstname' => $before_update_user_fname,
                    'fname' => $before_update_user_fname ,
                    'lastname' => $before_update_user_lname,
                    'lname' => $before_update_user_lname,
                    'phone' => $before_update_user_phone,
                    'gender' => $before_update_user_gender,
                    
                ]
        );

        $after_update = $this->obj->getUserData(47);
        $after_update_data =
        [
            'id' => $after_update['id'],
            'username' => $after_update['username'],
            'email' => $after_update['email'],
            'firstname' => $after_update['firstname'],
            'lastname' => $after_update['lastname'],
            'phone' => $after_update['phone'],
            'gender' => $after_update['gender'],
        ];

        //print_r($before_update);
        print_r($before_update_user_data);
        print_r($after_update_data);

        $this->assertEquals($before_update_user_data, $after_update_data);

	}
    
    //verificando tamanho
    public function test_CT08_validation_username()
	{    
        $data = strlen('desiree01');       

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

    //verificando se ja existe
    public function test_CT08_validation_usernamee()
	{    
      
        $data =
            [
                'username' => 'desiree01', 
             
            ];

        $after_create = $this->obj->getUserData();

        $i = 0;
        while ($i <  $this->obj->countTotalUsers()){
            $after_createUser[$i] = [
                'username' =>  $after_create[$i]['username']
            ];
            $i = $i + 1;
        }

        $database = $after_createUser;
       
       // print_r($data);
      //  echo '-------------';
       // print_r($after_createUser);

        $this->assertContains($data, $database);
	}

    //"Casos de Teste: <(Nome do usuário, e-mail, nome, telefone, grupo, 
    //grupo, nome de usuário,e-mail, primeiro nome, último nome, telefone, gênero, senha, confirmação de senha), resultado>"
    //CT09: <(“joana”, ””, “”, “”, “”, 
    //“rural_novo”, “de@de, “N/A*”, “N/A*”, “N/A*”, “N/A*”, “N/A*”, “N/A*”, “”), inválido - email já existe no sistema>
    public function test_CT09()
	{

        $output = $this->request(
			'POST', 'Auth/login',
                [
                    'email'     => 'admin@admin.com',
                    'password'  => 'password'
                ]		
        );
        
        $before_update = $this->obj1->getUserGroupByUserId(47);
        $before_update_group = $before_update['group_id'];

        $before_update_user = $this->obj->getUserData(47);
        $before_update_user_username = $before_update_user['username'];
        $before_update_user_fname = $before_update_user['firstname'];
        $before_update_user_lname = $before_update_user['lastname'];
        $before_update_user_email = $before_update_user['email'];
        $before_update_user_phone = $before_update_user['phone'];
        $before_update_user_gender = $before_update_user['gender'];
        $before_update_user_password = $before_update_user['password'];

        $before_update_user_data =
        [
            'id' => $before_update_user['id'],
            'username' => $before_update_user['username'],
            'email' => $before_update_user['email'],
            'firstname' => $before_update_user['firstname'],
            'lastname' => $before_update_user['lastname'],
            'phone' => $before_update_user['phone'],
            'gender' => $before_update_user['gender'],
        ];

        $output01 = $this->request(
            'POST', ['Users', 'edit', '47'],
                [
                    'groups' => $before_update_group, // id do grupo
                    'username' => 'de@de',
                    'password' =>  '', 
                    'cpassword' =>  '',
                    'email' => $before_update_user_email,
                    'firstname' => $before_update_user_fname,
                    'fname' => $before_update_user_fname ,
                    'lastname' => $before_update_user_lname,
                    'lname' => $before_update_user_lname,
                    'phone' => $before_update_user_phone,
                    'gender' => $before_update_user_gender,
                    
                ]
        );

        $after_update = $this->obj->getUserData(47);
        $after_update_data =
        [
            'id' => $after_update['id'],
            'username' => $after_update['username'],
            'email' => $after_update['email'],
            'firstname' => $after_update['firstname'],
            'lastname' => $after_update['lastname'],
            'phone' => $after_update['phone'],
            'gender' => $after_update['gender'],
        ];

        //print_r($before_update);
        print_r($before_update_user_data);
        print_r($after_update_data);

        $this->assertEquals($before_update_user_data, $after_update_data);

	}
    
    public function test_CT09_validation_username()
	{    
        $after_update = $this->obj->getUserData(47); 
        $after_update_data = 
        [ 
            'id' => $after_update['id'],
            'username' => $after_update['username']
        ];

        
        $data =
            [   
                'id' => '47',
                'username' => 'de@de'
            ];

        print_r($after_update_data);
        print_r($data);
       
        $this->assertEquals($after_update_data, $data);
	}

}