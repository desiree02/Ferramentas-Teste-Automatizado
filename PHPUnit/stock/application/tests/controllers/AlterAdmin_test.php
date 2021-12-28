<?php

class AlterAdmin_test extends TestCase
{
    public function setUp(): void
    {
        $this->resetInstance();        
        $this->CI->load->model('model_users');
        $this->CI->load->model('model_groups');

        $this->obj = $this->CI->model_users;
        $this->obj1 = $this->CI->model_groups;
    }
    //Casos de Teste: <(Nome de usuário, e-mail, primeiro nome, último nome, telefone, gênero, senha, confirmar senha), resultado>
    //CT01: <(“desireearaujo”, “dee@gmail.com”, “Desiree”’, “N/A*”, “N/A*”, “N/A*”, “”), válido>
	public function test_CT01()
	{

        $output = $this->request(
			'POST', 'Auth/login',
                [
                    'email'     => 'admin@admin.com',
                    'password'  => 'password'
                ]		
        );

        $before_update_user = $this->obj->getUserData(1);
        $before_update_user_lastname = $before_update_user['lastname'];
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

        $group = $this->obj1->getUserGroupByUserId(1);
        $group_group = $group['group_id'];

        $output01 = $this->request(
            'POST', 'users/setting',
            [
                'groups' =>  $group_group,
                'username' => 'desireearaujo',
                'password' =>'',
                'cpassword' => '',
                'email' => 'dee@gmail.com',
                'firstname' => 'Desiree',
                'fname' => 'Desiree',
                'lastname' => $before_update_user_lastname,
                'lname' => $before_update_user_lastname,
                'phone' => $before_update_user_phone,
                'gender' => $before_update_user_gender
                
            ]
        );

        $after_update =  $this->obj->getUserData(1);
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

        print_r($before_update_user_data);
        echo '----------------';
        print_r($after_update_data);
        
       $this->assertEquals($before_update_user_data, $after_update_data);

	}

    public function test_CT01_validation_username()
	{    
        $data = strlen('desireearaujo');       

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

    //Casos de Teste: <(Nome de usuário, e-mail, primeiro nome, último nome, telefone, gênero, senha, confirmar senha), resultado>
    //CT02: <(“andrevegas”, “N/A*”, “N/A*”’, “N/A*”, “N/A*”, “N/A*”, “1234567890”), válido>
	public function test_CT02()
	{

        $output = $this->request(
			'POST', 'Auth/login',
                [
                    'email'     => 'admin@admin.com',
                    'password'  => 'password'
                ]		
        );

        $before_update_user = $this->obj->getUserData(1);
        $before_update_user_firstname = $before_update_user['firstname'];
        $before_update_user_lastname = $before_update_user['lastname'];
        $before_update_user_phone = $before_update_user['phone'];
        $before_update_user_gender = $before_update_user['gender'];
        $before_update_user_password = $before_update_user['password'];
        $before_update_user_email = $before_update_user['email'];

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

        $group = $this->obj1->getUserGroupByUserId(1);
        $group_group = $group['group_id'];

        $output01 = $this->request(
            'POST', 'users/setting',
            [
                'groups' =>  $group_group,
                'username' => 'andrevegas',
                'password' =>'1234567890',
                'cpassword' => '1234567890',
                'email' => $before_update_user_email,
                'firstname' => $before_update_user_firstname,
                'fname' => $before_update_user_firstname,
                'lastname' => $before_update_user_lastname,
                'lname' => $before_update_user_lastname,
                'phone' => $before_update_user_phone,
                'gender' => $before_update_user_gender
                
            ]
        );

        $after_update =  $this->obj->getUserData(1);
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

        print_r($before_update_user_data);
        echo '----------------';
        print_r($after_update_data);
        
       $this->assertEquals($before_update_user_data, $after_update_data);

	}

    public function test_CT02_validation_username()
	{    
        $after_update = $this->obj->getUserData(1); 
        $after_update_data = 
        [ 
            'id' => $after_update['id'],
            'username' => $after_update['username']
        ];

        
        $data =
            [   
                'id' => '1',
                'username' => 'andrevegas'
            ];

        print_r($after_update_data);
        print_r($data);
       
        $this->assertEquals($after_update_data, $data);
	}


    //Casos de Teste: <(Nome de usuário, e-mail, primeiro nome, último nome, telefone, gênero, senha, confirmar senha), resultado>
    //CT03: <(“adm”, “N/A*”, “N/A*”’, “N/A*”, “N/A*”, “N/A*”, “N/A*”), inválido - nome de usuário possui menos do que 5 caracteres>
	public function test_CT03()
	{

        $output = $this->request(
			'POST', 'Auth/login',
                [
                    'email'     => 'admin@admin.com',
                    'password'  => '1234567890'
                ]		
        );

        $before_update_user = $this->obj->getUserData(1);
        $before_update_user_firstname = $before_update_user['firstname'];
        $before_update_user_lastname = $before_update_user['lastname'];
        $before_update_user_phone = $before_update_user['phone'];
        $before_update_user_gender = $before_update_user['gender'];
        $before_update_user_password = $before_update_user['password'];
        $before_update_user_email = $before_update_user['email'];

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

        $group = $this->obj1->getUserGroupByUserId(1);
        $group_group = $group['group_id'];

        $output01 = $this->request(
            'POST', 'users/setting',
            [
                'groups' =>  $group_group,
                'username' => 'adm',
                'password' =>'',
                'cpassword' => '',
                'email' => $before_update_user_email,
                'firstname' => $before_update_user_firstname,
                'fname' => $before_update_user_firstname,
                'lastname' => $before_update_user_lastname,
                'lname' => $before_update_user_lastname,
                'phone' => $before_update_user_phone,
                'gender' => $before_update_user_gender
                
            ]
        );

        $after_update =  $this->obj->getUserData(1);
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

        print_r($before_update_user_data);
        echo '----------------';
        print_r($after_update_data);
        
       $this->assertEquals($before_update_user_data, $after_update_data);

	}

    public function test_CT03_validation_username()
	{    
        $data = strlen('adm');       

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

    //Casos de Teste: <(Nome de usuário, e-mail, primeiro nome, último nome, telefone, gênero, senha, confirmar senha), resultado>
    //CT04: <(“andrevegas”, “andre@andre*”, “N/A*”’, “N/A*”, “N/A*”, “N/A*”, “”), válido>
	public function test_CT04()
	{

        $output = $this->request(
			'POST', 'Auth/login',
                [
                    'email'     => 'admin@admin.com',
                    'password'  => '1234567890'
                ]		
        );

        $before_update_user = $this->obj->getUserData(1);
        $before_update_user_firstname = $before_update_user['firstname'];
        $before_update_user_lastname = $before_update_user['lastname'];
        $before_update_user_phone = $before_update_user['phone'];
        $before_update_user_gender = $before_update_user['gender'];
        $before_update_user_password = $before_update_user['password'];
        $before_update_user_email = $before_update_user['email'];

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

        $group = $this->obj1->getUserGroupByUserId(1);
        $group_group = $group['group_id'];

        $output01 = $this->request(
            'POST', 'users/setting',
            [
                'groups' =>  $group_group,
                'username' => 'andrevegas',
                'password' =>'',
                'cpassword' => '',
                'email' => 'andre@andre',
                'firstname' => $before_update_user_firstname,
                'fname' => $before_update_user_firstname,
                'lastname' => $before_update_user_lastname,
                'lname' => $before_update_user_lastname,
                'phone' => $before_update_user_phone,
                'gender' => $before_update_user_gender
                
            ]
        );

        $after_update =  $this->obj->getUserData(1);
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

        print_r($before_update_user_data);
        echo '----------------';
        print_r($after_update_data);
        
       $this->assertEquals($before_update_user_data, $after_update_data);

	}

    public function test_CT04_validation_username()
	{    
        $after_update = $this->obj->getUserData(1); 
        $after_update_data = 
        [ 
            'id' => $after_update['id'],
            'username' => $after_update['username']
        ];

        
        $data =
            [   
                'id' => '1',
                'username' => 'andrevegas'
            ];

        print_r($after_update_data);
        print_r($data);
       
        $this->assertEquals($after_update_data, $data);
	}

    public function test_CT04_validation_email()
	{    
        $after_update = $this->obj->getUserData(1); 
        $after_update_data = 
        [ 
            'id' => $after_update['id'],
            'email' => $after_update['email']
        ];

        
        $data =
            [   
                'id' => '1',
                'email' => 'andre@andre'
            ];

        print_r($after_update_data);
        print_r($data);
       
        $this->assertEquals($after_update_data, $data);
	}
    
    //Casos de Teste: <(Nome de usuário, e-mail, primeiro nome, último nome, telefone, gênero, senha, confirmar senha), resultado>
    //CT05: <(“andrevegas”, andre@@andre.com”, “N/A*”’, “N/A*”, “N/A*”, “N/A*”, “N/A*”), inválido - email inválido>
	public function test_CT05()
	{

        $output = $this->request(
			'POST', 'Auth/login',
                [
                    'email'     => 'admin@admin.com',
                    'password'  => '1234567890'
                ]		
        );

        $before_update_user = $this->obj->getUserData(1);
        $before_update_user_firstname = $before_update_user['firstname'];
        $before_update_user_lastname = $before_update_user['lastname'];
        $before_update_user_phone = $before_update_user['phone'];
        $before_update_user_gender = $before_update_user['gender'];
        $before_update_user_password = $before_update_user['password'];
        $before_update_user_email = $before_update_user['email'];

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

        $group = $this->obj1->getUserGroupByUserId(1);
        $group_group = $group['group_id'];

        $output01 = $this->request(
            'POST', 'users/setting',
            [
                'groups' =>  $group_group,
                'username' => 'andrevegas',
                'password' =>'',
                'cpassword' => '',
                'email' => 'andre@@andre.com',
                'firstname' => $before_update_user_firstname,
                'fname' => $before_update_user_firstname,
                'lastname' => $before_update_user_lastname,
                'lname' => $before_update_user_lastname,
                'phone' => $before_update_user_phone,
                'gender' => $before_update_user_gender
                
            ]
        );

        $after_update =  $this->obj->getUserData(1);
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

        print_r($before_update_user_data);
        echo '----------------';
        print_r($after_update_data);
        
       $this->assertEquals($before_update_user_data, $after_update_data);

	}

    public function test_CT05_validation_username()
	{    
        $after_update = $this->obj->getUserData(1); 
        $after_update_data = 
        [ 
            'id' => $after_update['id'],
            'username' => $after_update['username']
        ];

        
        $data =
            [   
                'id' => '1',
                'username' => 'andrevegas'
            ];

        print_r($after_update_data);
        print_r($data);
       
        $this->assertEquals($after_update_data, $data);
	}

    public function test_CT05_validation_email()
	{    
    
           $data = 'andre@@andre.com';
       
         $this->assertStringContainsString('@@', $data);
	}

    //Casos de Teste: <(Nome de usuário, e-mail, primeiro nome, último nome, telefone, gênero, senha, confirmar senha), resultado>
    //CT06: <(“”, “”, “N/A*”’, “N/A*”, “N/A*”, “N/A*”, “N/A*”), inválido - as informações obrigatórias não foram inseridas>
	public function test_CT06()
	{

        $output = $this->request(
			'POST', 'Auth/login',
                [
                    'email'     => 'andre@andre',
                    'password'  => '1234567890'
                ]		
        );

        $before_update_user = $this->obj->getUserData(1);
        $before_update_user_firstname = $before_update_user['firstname'];
        $before_update_user_lastname = $before_update_user['lastname'];
        $before_update_user_phone = $before_update_user['phone'];
        $before_update_user_gender = $before_update_user['gender'];
        $before_update_user_password = $before_update_user['password'];
        $before_update_user_email = $before_update_user['email'];

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

        $group = $this->obj1->getUserGroupByUserId(1);
        $group_group = $group['group_id'];

        $output01 = $this->request(
            'POST', 'users/setting',
            [
                'groups' =>  $group_group,
                'username' => '',
                'password' =>$before_update_user_password ,
                'cpassword' => $before_update_user_password ,
                'email' => '',
                'firstname' => $before_update_user_firstname,
                'fname' => $before_update_user_firstname,
                'lastname' => $before_update_user_lastname,
                'lname' => $before_update_user_lastname,
                'phone' => $before_update_user_phone,
                'gender' => $before_update_user_gender
                
            ]
        );

        $after_update =  $this->obj->getUserData(1);
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

        print_r($before_update_user_data);
        echo '----------------';
        print_r($after_update_data);
        
       $this->assertEquals($before_update_user_data, $after_update_data);

	}

    public function test_CT05_validation_username_()
	{    
        $after_update = $this->obj->getUserData(1); 
        $after_update_data = 
        [ 
            'id' => $after_update['id'],
            'username' => $after_update['username']
        ];

        
        $data =
            [   
                'id' => '1',
                'username' => ''
            ];

        print_r($after_update_data);
        print_r($data);
       
        $this->assertEquals($after_update_data, $data);
	}

    //validando tamanho
    public function test_CT06_validation_username()
	{    
    
        $data = strlen('');       

        //print_r($data);

        $i = 5;
        while ($i <= 12){
            if($data >= 5 and $data <=12){
                $qtd = $data;
            }
            else{
                $qtd = -1;
            }
            $i = $i + 1;

        }    
        
        //echo '--------------------';
        //print_r($qtd);
      
        $this->assertSame($qtd, $data);
	}

    //VER O @, VALIDAR ATRAVES DO %@%
    public function test_CT05_validation_email_()
	{    
    
           $data = '';
       
         $this->assertStringContainsString('@', $data);
	}
    

    //Casos de Teste: <(Nome de usuário, e-mail, primeiro nome, último nome, telefone, gênero, senha, confirmar senha), resultado>
    //CT07: <(“administrador”, “N/A*”, “N/A*”’, “N/A*”, “N/A*”, “N/A*”, “123”), inválido - senha possui menos do que 8 caracteres>	public function test_CT07()
	public function test_CT07()
    {

        $output = $this->request(
			'POST', 'Auth/login',
                [
                    'email'     => 'andre@andre',
                    'password'  => '1234567890'
                ]		
        );

        $before_update_user = $this->obj->getUserData(1);
        $before_update_user_firstname = $before_update_user['firstname'];
        $before_update_user_lastname = $before_update_user['lastname'];
        $before_update_user_phone = $before_update_user['phone'];
        $before_update_user_gender = $before_update_user['gender'];
        $before_update_user_password = $before_update_user['password'];
        $before_update_user_email = $before_update_user['email'];

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

        $group = $this->obj1->getUserGroupByUserId(1);
        $group_group = $group['group_id'];

        $output01 = $this->request(
            'POST', 'users/setting',
            [
                'groups' =>  $group_group,
                'username' => 'administrador',
                'password' =>$before_update_user_password ,
                'cpassword' => '123',
                'email' => $before_update_user_email,
                'firstname' => $before_update_user_firstname,
                'fname' => $before_update_user_firstname,
                'lastname' => $before_update_user_lastname,
                'lname' => $before_update_user_lastname,
                'phone' => $before_update_user_phone,
                'gender' => $before_update_user_gender
                
            ]
        );

        $after_update =  $this->obj->getUserData(1);
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

        print_r($before_update_user_data);
        echo '----------------';
        print_r($after_update_data);
        
       $this->assertEquals($before_update_user_data, $after_update_data);

	}

    public function test_CT07_validation_username()
	{    
        $after_update = $this->obj->getUserData(1); 
        $after_update_data = 
        [ 
            'id' => $after_update['id'],
            'username' => $after_update['username']
        ];

        
        $data =
            [   
                'id' => '1',
                'username' => 'administrador'
            ];

        print_r($after_update_data);
        print_r($data);
       
        $this->assertEquals($after_update_data, $data);
	}

    //validando tamanho
    public function test_CT07_validation_username_()
	{    
    
        $data = strlen('administrador');       

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
   public function test_CT07_validation_senha()
   {
       $after_create = $this->obj->getUserData(47);
       $after_create_username = $after_create['password'];
       
       $data = strlen('123');       

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

}
