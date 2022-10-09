<?php

namespace App\Http\Controllers;

use App\Libraries\RouterosAPI;
use App\Models\Tunnel;
use App\Services\RouterosService;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use RouterOS\Client;
use RouterOS\Config;

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

    public function index()
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
        return view('tunnels/details', [
            'tunnel' => $tunnel
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
        $id = $tunnel->id;
        $this->routerosService->editTunnel($id, $password);
        session()->flash('status', 'Data tunnel berhasil di perbaharui ');
        return to_route('tunnels.show', $tunnel);
    }

    public function destroy(Tunnel $tunnel)
    {
        $tunnel->delete();
        session()->flash('status', 'Tunnel anda berhasil di hapus!');
        return to_route('tunnels.index');
    }
}
