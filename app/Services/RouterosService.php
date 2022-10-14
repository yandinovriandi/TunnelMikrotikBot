<?php

namespace App\Services;

use App\Libraries\RouterosAPI;
use RouterOS\Client;
use RouterOS\Config;
use RouterOS\Query;
use Symfony\Component\Mime\Encoder\QpEncoder;

class RouterosService
{
    public function __construct()
    {
        $this->config = new Config([
            $this->host = 'host' => config('routeros-api.host'),
            $this->user = 'user' => config('routeros-api.user'),
            $this->pass = 'pass' => config('routeros-api.pass'),
            $this->port = 'port' => (int) config('routeros-api.port'),
            'timeout' => 3,
            'attempts' => 5,
            'delay' => 3,
            'socket_timeout' => 30,
            'socket_blocking' => false,
            'socket_options' => [
                'tcp_nodelay' => true
            ]
        ]);
        $this->ros = new Client($this->config);
    }

    public function addTunnel($name, $pass, $localaddress, $remoteadress, $mainprofile)
    {
        $this->ros = new Client($this->config);
        $query = new Query('/ppp/secret/add');
        $query->equal('name', $name);
        $query->equal('password', $pass);
        $query->equal('local-address', $localaddress);
        if (!empty($localaddress)) {
            $query->equal('local-address', $localaddress);
        }
        if (!empty($remoteadress)) {
            $query->equal('remote-address', $remoteadress);
        }
        $query->equal('comment', strtoupper($name));
        $query->equal('profile', $mainprofile);
        $query->equal('service', 'l2tp');
        return $this->ros->qr($query);
    }

    public function addFirewallNatApi($name, $remoteadress, $portapi)
    {
        $this->ros = new Client($this->config);
        $api = (new Query('/ip/firewall/nat/add'))
            ->equal('chain', 'dstnat')
            ->equal('chain', 'dstnat')
            ->equal('action', 'dst-nat')
            ->equal('to-addresses', $remoteadress)
            ->equal('to-ports', '8728')
            ->equal('protocol', 'tcp')
            ->equal('dst-port', $portapi)
            ->equal('comment', strtoupper($name . '-NAT-API'))
            ->equal('disabled', 'no');
        return $this->ros->qr($api);
    }

    public function addFirewallNatWinbox($name, $remoteadress, $portwinbox)
    {
        $this->ros = new Client($this->config);
        $winbox = (new Query('/ip/firewall/nat/add'))
            ->equal('chain', 'dstnat')
            ->equal('chain', 'dstnat')
            ->equal('action', 'dst-nat')
            ->equal('to-addresses', $remoteadress)
            ->equal('to-ports', '8291')
            ->equal('protocol', 'tcp')
            ->equal('dst-port', $portwinbox)
            ->equal('comment', strtoupper($name . '-NAT-WINBOX'))
            ->equal('disabled', 'no');
        return $this->ros->qr($winbox);
    }

    public function addFirewallNatWeb($name, $remoteadress, $portweb)
    {
        $this->ros = new Client($this->config);
        $web = (new Query('/ip/firewall/nat/add'))
            ->equal('chain', 'dstnat')
            ->equal('chain', 'dstnat')
            ->equal('action', 'dst-nat')
            ->equal('to-addresses', $remoteadress)
            ->equal('to-ports', '80')
            ->equal('protocol', 'tcp')
            ->equal('dst-port', $portweb)
            ->equal('comment', strtoupper($name . '-NAT-WEB'))
            ->equal('disabled', 'no');
        return $this->ros->qr($web);
    }


    public function editTunnel($id, $username, $password, $localaddress, $remoteaddress)
    {
        $this->ros = new Client($this->config);
        $query = new Query('/ppp/secret/set');
        $query->where('name', $username);
        $query->equal('.id', $id);
        $query->equal('name', $username);
        $query->equal('password', $password);
        $query->equal('comment', $username);
        if (!empty($localaddress)) {
            $query->equal('local-address', $localaddress);
        }
        if (!empty($remoteaddress)) {
            $query->equal('remote-address', $remoteaddress);
        }
        return $this->ros->qr($query);
    }

    public function getIpFirewallNat($win)
    {
        $query = new Query('/ip/firewall/nat/print');
        $query->where('dst-port', $win);
        $nats = $this->ros->query($query)->read();
    }
}
