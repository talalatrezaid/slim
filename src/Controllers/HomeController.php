<?php

namespace App\Controllers;

use App\Models\Customer;
use App\Models\User;
use App\Models\Order;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Views\Twig;
use fzaninotto\faker;
use Faker\Generator;

final class HomeController extends BaseController
{
    public function __invoke(Request $request, Response $response): Response
    {
  
        $view = $this->container->get("view");

        return $view->render($response, 'home.twig');

        // $response->getBody()->write('Hello talal, World!');
       // return $response;
    }

    public function get_orders(Request $request, Response $response): Response
    {
        $page = 1;
        $filter = "";
        $date = "";
        $queryParams = $request->getQueryParams();
        if(isset($queryParams['date']))
         $date = addslashes($queryParams['date']);
 
        $pdo = $this->container->get("conn");
        $orderss = new Order();
        $orders = $orderss->get_orders($pdo,$date);
        $orders_total = $orderss->get_total_orders($pdo,$date)[0]['orders_count'];
        
        $response->getBody()->write(json_encode(['success' => '1',"orders"=>$orders,"total_orders"=>$orders_total]));
        return $response->withHeader('Content-Type', 'application/json');
    }

    public function insert_customer(Request $request, Response $response): Response
    {
        $user = new Customer();
        $pdo = $this->container->get("conn");
        $full_name = trim(addslashes($request->full_name));
        $contact = trim($request->contact);
        $data = ["full_name"=>$full_name,
        "contact"=>$contact,
        ];
        $users = $user->insert_customer($pdo,$data);
        $response->getBody()->write(json_encode(['success' => '1',"user"=>$users]));
        return $response->withHeader('Content-Type', 'application/json');
    }


    public function insert_orders(Request $request, Response $response): Response
    {
        $user = new Order();
        $pdo = $this->container->get("conn");
        $customer_id = trim(addslashes($request->full_name));
        $price = trim($request->price);
        $data = ["customer_id"=>$customer_id,
        "price"=>$price,
        ];
        $order = $user->insert_order($pdo,$data);
        $response->getBody()->write(json_encode(['success' => '1',"order"=>$order]));
        return $response->withHeader('Content-Type', 'application/json');
    }


    public function insert_fake_customers(Request $request, Response $response): Response
    {
       
    $customers =    [
             
            [
              "full_name"=> 'ren',
            "contact"=> '159-156-1158',
            ],
             
            [
              "full_name"=> 'Redd',
            "contact"=> '234-403-1135',
            ],
 
            [
              "full_name"=> 'De witt',
            "contact"=> '417-694-6707',
            ],
 
            [
              "full_name"=> 'Moira',
            "contact"=> '279-845-2896',
            ],
 
            [
              "full_name"=> 'Tamra',
            "contact"=> '748-261-8376',
            ],
 
            [
              "full_name"=> 'Goldy',
            "contact"=> '597-433-8023',
            ],
 
            [
              "full_name"=> 'Leah',
            "contact"=> '627-879-9590',
            ],
 
            [
              "full_name"=> 'Inna',
            "contact"=> '783-930-9055',
            ],
 
            [
              "full_name"=> 'Coriss',
            "contact"=> '687-187-3937',
            ],
 
            [
              "full_name"=> 'Tomkin',
            "contact"=> '892-998-4527',
            ],
             
            [
              "full_name"=> 'Zarah',
            "contact"=> '319-528-6545',
            ],
             
            [
              "full_name"=> 'Rosita',
            "contact"=> '121-157-7705',
            ],
 
            [
              "full_name"=> 'Lurleen',
            "contact"=> '291-887-6928',
            ],
 
            [
              "full_name"=> 'Karyl',
            "contact"=> '769-419-1912',
            ],
 
            [
              "full_name"=> 'Mildred',
            "contact"=> '256-821-6360',
            ],
 
            [
              "full_name"=> 'Andriette',
            "contact"=> '335-855-5066',
            ],
 
            [
              "full_name"=> 'Brianna',
            "contact"=> '172-649-3376',
            ],
 
            [
              "full_name"=> 'Sydney',
            "contact"=> '740-442-7937',
            ],
 
            [
              "full_name"=> 'Gale',
            "contact"=> '705-679-5351',
            ],
 
            [
              "full_name"=> 'Brandon',
            "contact"=> '912-719-3316',
            ],
             
            [
              "full_name"=> 'Lowe',
            "contact"=> '333-659-5471',
            ],
             
            [
              "full_name"=> 'Robin',
            "contact"=> '926-862-3222',
            ],
 
            [
              "full_name"=> 'Gregg',
            "contact"=> '166-833-9595',
            ],
 
            [
              "full_name"=> 'Caleb',
            "contact"=> '302-981-4591',
            ],
 
            [
              "full_name"=> 'Raymond',
            "contact"=> '305-688-4880',
            ],
 
            [
              "full_name"=> 'Truman',
            "contact"=> '118-100-1248',
            ],
 
            [
              "full_name"=> 'Veda',
            "contact"=> '720-555-2065',
            ],
 
            [
              "full_name"=> 'Orel',
            "contact"=> '261-346-5622',
            ],
 
            [
              "full_name"=> 'Ema',
            "contact"=> '967-203-1274',
            ],
 
            [
              "full_name"=> 'Korrie',
            "contact"=> '461-376-0639',
            ],
             
            [
              "full_name"=> 'Holden',
            "contact"=> '327-354-0198',
            ],
             
            [
              "full_name"=> 'Marlo',
            "contact"=> '578-658-9138',
            ],
 
            [
              "full_name"=> 'Dulcie',
            "contact"=> '736-688-1425',
            ],
 
            [
              "full_name"=> 'Thadeus',
            "contact"=> '420-711-4556',
            ],
 
            [
              "full_name"=> 'Parry',
            "contact"=> '486-775-8118',
            ],
 
            [
              "full_name"=> 'Jephthah',
            "contact"=> '265-994-5906',
            ],
 
            [
              "full_name"=> 'Gus',
            "contact"=> '887-193-6529',
            ],
 
            [
              "full_name"=> 'Olivie',
            "contact"=> '256-231-2620',
            ],
 
            [
              "full_name"=> 'Bryna',
            "contact"=> '592-251-6207',
            ],
 
            [
              "full_name"=> 'Trey',
            "contact"=> '212-743-5277',
            ],
             
            [
              "full_name"=> 'Marcellina',
            "contact"=> '879-253-5301',
            ],
             
            [
              "full_name"=> 'Sam',
            "contact"=> '654-898-5916',
            ],
 
            [
              "full_name"=> 'Sherm',
            "contact"=> '656-765-2915',
            ],
 
            [
              "full_name"=> 'Cahra',
            "contact"=> '727-896-6220',
            ],
 
            [
              "full_name"=> 'Jolynn',
            "contact"=> '124-246-1768',
            ],
 
            [
              "full_name"=> 'Shir',
            "contact"=> '558-987-7020',
            ],
 
            [
              "full_name"=> 'Sibyl',
            "contact"=> '117-615-9207',
            ],
 
            [
              "full_name"=> 'Nickolaus',
            "contact"=> '544-681-3526',
            ],
 
            [
              "full_name"=> 'Manon',
            "contact"=> '357-390-8976',
            ],
 
            [
              "full_name"=> 'Paco',
            "contact"=> '192-380-1198',
            ],
             
            [
              "full_name"=> 'Tony',
            "contact"=> '247-208-6751',
            ],
             
            [
              "full_name"=> 'Griffie',
            "contact"=> '988-870-8204',
            ],
 
            [
              "full_name"=> 'Lynn',
            "contact"=> '618-160-6555',
            ],
 
            [
              "full_name"=> 'Orbadiah',
            "contact"=> '142-899-4778',
            ],
 
            [
              "full_name"=> 'Tandy',
            "contact"=> '391-559-2898',
            ],
 
            [
              "full_name"=> 'Garik',
            "contact"=> '811-410-6335',
            ],
 
            [
              "full_name"=> 'Alli',
            "contact"=> '198-508-9858',
            ],
 
            [
              "full_name"=> 'Ward',
            "contact"=> '279-148-7998',
            ],
 
            [
              "full_name"=> 'Hadria',
            "contact"=> '589-591-0731',
            ],
 
            [
              "full_name"=> 'Tana',
            "contact"=> '456-961-4252',
            ],
             
            [
              "full_name"=> 'Ina',
            "contact"=> '883-258-8711',
            ],
             
            [
              "full_name"=> 'Evania',
            "contact"=> '425-758-1850',
            ],
 
            [
              "full_name"=> 'Chrissy',
            "contact"=> '274-392-8447',
            ],
 
            [
              "full_name"=> 'Hymie',
            "contact"=> '984-597-7452',
            ],
 
            [
              "full_name"=> 'Perrine',
            "contact"=> '162-857-8035',
            ],
 
            [
              "full_name"=> 'Rhys',
            "contact"=> '264-642-1367',
            ],
 
            [
              "full_name"=> 'Lauritz',
            "contact"=> '675-627-1465',
            ],
 
            [
              "full_name"=> 'Lester',
            "contact"=> '386-249-6456',
            ],
 
            [
              "full_name"=> 'Roberto',
            "contact"=> '737-991-8953',
            ],
 
            [
              "full_name"=> 'Cullan',
            "contact"=> '632-762-8098',
            ],
             
            [
              "full_name"=> 'Jacques',
            "contact"=> '539-874-6273',
            ],
             
            [
              "full_name"=> 'Debee',
            "contact"=> '146-820-7791',
            ],
 
            [
              "full_name"=> 'Lilah',
            "contact"=> '789-575-5865',
            ],
 
            [
              "full_name"=> 'Melisent',
            "contact"=> '568-273-9891',
            ],
 
            [
              "full_name"=> 'Avril',
            "contact"=> '375-423-1795',
            ],
 
            [
              "full_name"=> 'Anna-diane',
            "contact"=> '192-544-4162',
            ],
 
            [
              "full_name"=> 'Tiebold',
            "contact"=> '122-385-8788',
            ],
 
            [
              "full_name"=> 'Sheree',
            "contact"=> '343-506-0309',
            ],
 
            [
              "full_name"=> 'Kaycee',
            "contact"=> '521-769-0950',
            ],
 
            [
              "full_name"=> 'Phaedra',
            "contact"=> '726-806-9125',
            ],
             
            [
              "full_name"=> 'Shellie',
            "contact"=> '937-403-2368',
            ],
             
            [
              "full_name"=> 'Lacey',
            "contact"=> '977-910-8711',
            ],
 
            [
              "full_name"=> 'Eadmund',
            "contact"=> '674-297-7658',
            ],
 
            [
              "full_name"=> 'Binny',
            "contact"=> '300-979-5890',
            ],
 
            [
              "full_name"=> 'Kania',
            "contact"=> '340-296-8167',
            ],
 
            [
              "full_name"=> 'Calley',
            "contact"=> '773-325-6951',
            ],
 
            [
              "full_name"=> 'Carrissa',
            "contact"=> '401-579-3004',
            ],
 
            [
              "full_name"=> 'Gerti',
            "contact"=> '748-488-0204',
            ],
 
            [
              "full_name"=> 'Valeria',
            "contact"=> '527-997-7403',
            ],
 
            [
              "full_name"=> 'Ellyn',
            "contact"=> '569-142-1103',
            ],
             
            [
              "full_name"=> 'Fawne',
            "contact"=> '649-176-2837',
            ],
             
            [
              "full_name"=> 'Tudor',
            "contact"=> '638-579-0878',
            ],
 
            [
              "full_name"=> 'Madelon',
            "contact"=> '521-849-1096',
            ],
 
            [
              "full_name"=> 'Robinett',
            "contact"=> '926-177-3793',
            ],
 
            [
              "full_name"=> 'Derrick',
            "contact"=> '778-930-5234',
            ],
 
            [
              "full_name"=> 'Blondy',
            "contact"=> '790-850-4780',
            ],
 
            [
              "full_name"=> 'Violette',
            "contact"=> '631-667-5794',
            ],
 
            [
              "full_name"=> 'Benoite',
            "contact"=> '675-810-8328',
            ],
 
            [
              "full_name"=> 'Kasey',
            "contact"=> '808-610-7003',
            ],
 
            [
              "full_name"=> 'Jaquelyn',
            "contact"=> '408-256-6010',
            ],
             
            [
              "full_name"=> 'Daria',
            "contact"=> '892-170-3180',
            ],
    ];
        
        $user = new Customer();
        $pdo = $this->container->get("conn");
  
        foreach($customers as $customer)
        {
       
         $data = $customer;
         $users = $user->insert_customer($pdo,$data);
        }
        $response->getBody()->write(json_encode(['success' => '1',"message"=>'users inserted successfully']));
        return $response->withHeader('Content-Type', 'application/json');
    }

        
    function insert_fake_orders(Request $request, Response $response): Response
    {
            $order = new Order();
            $pdo = $this->container->get("conn");

            for($i=0;$i<=143460;$i++)
            {
                $int= mt_rand(1262055681,1665979368);
                $string = date("Y-m-d H:i:s",$int);
                $order_data = ["customer_id"=>rand(1,100),
                    "price"=>rand(100,30000),
                    "date"=>$string,
                    "status"=>1
                ];
                $order->insert_order($pdo,$order_data);
            }
            $response->getBody()->write(json_encode(['success' => '1',"message"=>'users inserted successfully']));
            return $response->withHeader('Content-Type', 'application/json');
    
    }
}


