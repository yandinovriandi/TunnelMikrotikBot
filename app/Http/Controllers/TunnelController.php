<?php

namespace App\Http\Controllers;

use App\Models\Tunnel;
use App\Services\RouterosService;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use RouterOS\Client;
use RouterOS\Config;
use RouterOS\Query;

class TunnelController extends Controller
{
    public function __construct(RouterosService $routerosService)
    {
        $this->routerosService = $routerosService;
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
        $this->client = new Client($this->config);
    }

    public function index(Tunnel $tunnel)
    {


        $tunnels = auth()->user()->tunnels()->select('username', 'password', 'url', 'status', 'api')->get('username', 'password', 'url', 'status', 'api');

        return view('tunnels.index', [
            'tunnels' => $tunnels
        ]);
    }


    public function create()
    {
        return view('tunnels.create');
    }


    public function store(Request $request)
    {
        $portapi = generatePort();
        $portwinbox = generatePort();
        $portweb = generatePort();

        $iptunnel = '10.10.0.' . rand(40, 253);
        $localaddress = '10.10.0.1';

        $debit = auth()->user()->invoices()->where('amount', '>=', 0)->get('amount')->sum('amount');
        $credit = auth()->user()->invoices()->where('amount', '<', 0)->get('amount')->sum('amount');
        $saldo = $debit + $credit;

        if (empty($request->username)) {
            throw ValidationException::withMessages([
                // 'server_id' => 'Pilih server terlebih dahulu',
                'username' => 'Username tidak boleh kosong Silahkan isi username',
                'password' => 'Password tidak boleh kosong',
                // 'price' => 'Silahkan pilih durasi sekaligus harga tunnel',
            ]);
            session()->flash('status', 'Tunnel Gagal di buat');

            return to_route('tunnels.create');
        }

        if ($saldo <= 0) {
            session()->flash('status', 'Saldo tidak mencukupi');
            return to_route('tunnels.create');
        } elseif ($this->client->connect() == false) {
            session()->flash('status', 'Server mengalami ganggaun.');
        } else {
            $request->validate([
                'username' => ['required', Rule::unique('tunnels', 'username')],
                'password' => ['required', 'min:6'],
            ]);

            auth()->user()->tunnels()->create([
                'username' => $name = $request->username,
                'password' => $pass = $request->password,
                'ip_server' => '103.186.32.12',
                'server' => 'sg1.mikrotikbot.com',
                'local-addrss' =>  $localaddress,
                'ip_tunnel' => $remoteadress =  $iptunnel,
                'url' => 'sg1.mikrotikbot.com:' . $portapi,
                'api' => $portapi,
                'winbox' => $portwinbox,
                'web' => $portweb,
                'expired' => now()->addMonth()
            ]);

            auth()->user()->invoices()->create([
                'amount' => -5000,
                'reference' => 'T' . time(),
                'merchant_ref' => 'TINV-' . time(),
                'description' => 'Order Layanan Tunnel',
                'status' => 'PAID',
                'method' => 'SALDO AKUN',
                'paid_at' => now()
            ]);

            $mainprofile = 'default';

            $this->routerosService->addTunnel($name, $pass, $localaddress, $remoteadress, $mainprofile, $portapi, $portwinbox, $portweb);
            $this->routerosService->addFirewallNatApi($name, $remoteadress, $portapi);
            $this->routerosService->addFirewallNatWinbox($name, $remoteadress, $portwinbox);
            $this->routerosService->addFirewallNatWeb($name, $remoteadress, $portweb);

            session()->flash('status', 'Tunnel Berhasil buat');
            return to_route('tunnels.index');
        }
    }


    public function show(Tunnel $tunnel)
    {
        $username = $tunnel->username;
        $win = $tunnel->winbox;
        $winb = new Query('/ip/firewall/nat/print');
        $winb->where('dst-port', $win);
        $pwins =   $this->client->query($winb)->read();
        $p_win = $pwins[0];

        $papi = $tunnel->api;
        $apip = new Query('/ip/firewall/nat/print');
        $apip->where('dst-port', $papi);
        $apips =   $this->client->query($apip)->read();
        $p_api = $apips[0];

        $pweb = $tunnel->web;
        $webp = new Query('/ip/firewall/nat/print');
        $webp->where('dst-port', $pweb);
        $webps =   $this->client->query($webp)->read();
        $p_web = $webps[0];

        $secrt = new Query('/ppp/secret/print');
        $secrt->where('name', $username);
        $secrets = $this->client->query($secrt)->read();
        $secret = $secrets[0];
        // dd($secret);
        return view('tunnels/details', [
            'tunnel' => $tunnel,
            'secret' => $secret,
            'p_win' => $p_win,
            'p_api' => $p_api,
            'p_web' => $p_web
        ]);
    }


    public function update(Request $request, Tunnel $tunnel)
    {
        $request->validate([
            'password' => ['required'],
        ]);
        $password = $request->password;
        $tunnel = Tunnel::where('username', $tunnel->username)->first();
        $tunnel->update([
            'password' => $password
        ]);

        $username = $tunnel->username;

        // ==============api================
        $rapi = $request->api;
        $pap = $tunnel->api;

        $updatePortApi = new Query('/ip/firewall/nat/print');
        $updatePortApi->where('dst-port', $pap);
        $upas = $this->client->query($updatePortApi)->read();

        foreach ($upas as $upa) {
            $updatePortWinbox = (new Query('/ip/firewal/nat/set'))
                ->equal('.id', $upa['.id'])
                ->equal('to-ports',  $rapi);
            $this->client->query($updatePortWinbox)->read();
        }

        // ==============api================

        // ==============winbox================
        $pwin = $request->winbox;
        $win = $tunnel->winbox;

        $updatePortWinbox = new Query('/ip/firewall/nat/print');
        $updatePortWinbox->where('dst-port', $win);
        $wins = $this->client->query($updatePortWinbox)->read();

        foreach ($wins as $win) {
            $updatePortWinbox = (new Query('/ip/firewal/nat/set'))
                ->equal('.id', $win['.id'])
                ->equal('to-ports',  $pwin);
            $this->client->query($updatePortWinbox)->read();
        }
        // ==============winbox================

        // ==============web================
        $pweb = $request->web;
        $web = $tunnel->web;

        $updatePortWeb = new Query('/ip/firewall/nat/print');
        $updatePortWeb->where('dst-port', $web);
        $webs = $this->client->query($updatePortWeb)->read();

        foreach ($webs as $web) {
            $updatePortWeb = (new Query('/ip/firewal/nat/set'))
                ->equal('.id', $web['.id'])
                ->equal('to-ports',  $pweb);
            $this->client->query($updatePortWeb)->read();
        }
        // ==============web================


        $updateTunnel = new Query('/ppp/secret/print');
        $updateTunnel->where('name', $username);
        $tunnelUsers = $this->client->query($updateTunnel)->read();

        foreach ($tunnelUsers as $tu) {
            $tu = (new Query('/ppp/secret/set'))
                ->where('name', $username)
                ->equal('.id', $tu['.id'])
                ->equal('password', $password);
            $this->client->query($tu)->read();
        }


        session()->flash('status', 'Data tunnel berhasil di perbaharui ');
        return to_route('tunnels.show', $tunnel);
    }

    public function destroy(Tunnel $tunnel)
    {
        $username = $tunnel->username;

        // ==============api================

        $pap = $tunnel->api;

        $updatePortApi = new Query('/ip/firewall/nat/print');
        $updatePortApi->where('dst-port', $pap);
        $upas = $this->client->query($updatePortApi)->read();

        foreach ($upas as $upa) {
            $updatePortWinbox = (new Query('/ip/firewal/nat/remove'))
                ->equal('.id', $upa['.id']);
            $this->client->query($updatePortWinbox)->read();
        }

        // ==============api================

        // ==============winbox================

        $win = $tunnel->winbox;

        $updatePortWinbox = new Query('/ip/firewall/nat/print');
        $updatePortWinbox->where('dst-port', $win);
        $wins = $this->client->query($updatePortWinbox)->read();

        foreach ($wins as $win) {
            $updatePortWinbox = (new Query('/ip/firewal/nat/remove'))
                ->equal('.id', $win['.id']);
            $this->client->query($updatePortWinbox)->read();
        }
        // ==============winbox================

        // ==============web================
        $web = $tunnel->web;

        $updatePortWeb = new Query('/ip/firewall/nat/print');
        $updatePortWeb->where('dst-port', $web);
        $webs = $this->client->query($updatePortWeb)->read();

        foreach ($webs as $web) {
            $updatePortWeb = (new Query('/ip/firewal/nat/remove'))
                ->equal('.id', $web['.id']);
            $this->client->query($updatePortWeb)->read();
        }
        // ==============web================


        $updateTunnel = new Query('/ppp/secret/print');
        $updateTunnel->where('name', $username);
        $tunnelUsers = $this->client->query($updateTunnel)->read();

        foreach ($tunnelUsers as $tu) {
            $tu = (new Query('/ppp/secret/remove'))
                ->where('name', $username)
                ->equal('.id', $tu['.id']);
            $this->client->query($tu)->read();
        }

        $tunnel->delete();
        session()->flash('status', 'Tunnel anda berhasil di hapus!');
        return to_route('tunnels.index');
    }
}
