<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Aws\Ec2\Ec2Client;
use Aws\Ec2\Exception\Ec2Exception;

class HomeController extends Controller
{
    private $ec2Client;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    //    $this->middleware('auth');

        $this->setupEc2Client();
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $instanceIds = [env('INSTANCE_ID')];
        $result = $this->ec2Client->describeInstances([
            'InstanceIds' => $instanceIds,
        ]);
        $data = [
            'state' => $result->toArray()['Reservations'][0]['Instances'][0]['State']['Name'],
        ];

        return view('home', $data);
    }

    public function start_ec2()
    {
        $instanceIds = [env('INSTANCE_ID')];
        $result = $this->ec2Client->startInstances([
            'InstanceIds' => $instanceIds,
        ]);

        $data = [
            'action' => 'start',
            'statusCode' => $result->toArray()['@metadata']['statusCode'],
        ];
        return view('home', $data);
    }

    public function stop_ec2()
    {
        $instanceIds = [env('INSTANCE_ID')];
        $result = $this->ec2Client->stopInstances([
            'InstanceIds' => $instanceIds,
        ]);

        $data = [
            'action' => 'stop',
            'statusCode' => $result->toArray()['@metadata']['statusCode'],
        ];
        return view('home', $data);

    }

    private function setupEc2Client()
    {
        $awsConfig = [
            'region' => 'us-east-1',
            'version' => '2016-11-15',
        ];

        if (env('AWS_ACCESS_KEY_ID') && env('AWS_SECRET_ACCESS_KEY')) {
            $awsConfig['credentials'] = [
                'key' => env('AWS_ACCESS_KEY_ID'),
                'secret' => env('AWS_SECRET_ACCESS_KEY')
            ];
        }

        $this->ec2Client = new Ec2Client($awsConfig);
    }
}
