<?php

namespace App\Http\Controllers;

use App\Models\Approve;
use App\Models\Booking;
use App\Models\Driver;
use App\Models\User;
use App\Models\Venichle;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (Auth::user()->hasRole('admin')) {
            $today = Carbon::today();
            $venichle_count = Venichle::count();
            $service = Venichle::orderBy('service', 'asc')->get();
            $driver = Driver::all();
            $venichle = Venichle::where('service', '>=', $today)->orderBy('service')->get();
            $atasan = User::whereNotIn('id', ['1'])->get();
            $booking = Booking::with('venichle', 'driver')->get();
            $history = Booking::with('venichle', 'driver')->where('status', 'Disetujui')->get();
            $approve_count = Booking::where('status', 'Disetujui')->count();
            $rejected_count = Booking::where('status', 'Ditolak')->count();
            return view('home', compact('venichle_count', 'service', 'driver', 'venichle', 'atasan', 'booking', 'history', 'approve_count', 'rejected_count'));
        } else {
            $today = Carbon::today();
            $venichle_count = Venichle::count();
            $service = Venichle::orderBy('service', 'asc')->get();
            $driver = Driver::all();
            $venichle = Venichle::where('service', '>=', $today)->orderBy('service')->get();
            $atasan = User::whereNotIn('id', ['1'])->get();
            $booking = Booking::with('venichle', 'driver')->where('atasan_1', Auth::user()->id)->orWhere('atasan_2', Auth::user()->id)->get();
            $history = Booking::with('venichle', 'driver')->where('status', 'Disetujui')->get();
            $approve_count = Booking::where('status', 'Disetujui')->count();
            $rejected_count = Booking::where('status', 'Ditolak')->count();
            return view('home', compact('venichle_count', 'service', 'driver', 'venichle', 'atasan', 'booking', 'history', 'approve_count', 'rejected_count'));
        }
    }


    public function booking(Request $request)
    {
        $formattedDate = Carbon::now();
        $validatedData = $request->validate([
            'nama' => 'required|max:255',
            'telp' => 'required|numeric',
            'type' => 'required|exists:venichle,id',
            'driver' => 'required|exists:driver,id',
            'tgl_mulai' => 'required|date',
            'tgl_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'atasan_1' => 'required|exists:users,id',
            'atasan_2' => 'required|exists:users,id|different:atasan_1',
            'konsumsi' => 'required|numeric'
        ]);

        $pemesanan = new Booking();
        $pemesanan->nama = $validatedData['nama'];
        $pemesanan->telp = $validatedData['telp'];
        $pemesanan->atasan_1 = $validatedData['atasan_1'];
        $pemesanan->atasan_2 = $validatedData['atasan_2'];
        $pemesanan->venichle_id = $validatedData['type'];
        $pemesanan->driver_id = $validatedData['driver'];
        $pemesanan->tgl_pesan = $formattedDate;
        $pemesanan->tgl_mulai = $validatedData['tgl_mulai'];
        $pemesanan->tgl_selesai = $validatedData['tgl_selesai'];
        $venichle = Venichle::findOrFail($validatedData['type']);
        $efisiensiBBM = $venichle->bbm;
        $jarakPerjalanan = $validatedData['konsumsi'];
        $konsumsiBBM = $jarakPerjalanan / $efisiensiBBM;
        $pemesanan->konsumsi = $konsumsiBBM;
        $pemesanan->save();
        $pemesanan->konsumsi = $validatedData['konsumsi'];
        $pemesanan->status = '0';
        $pemesanan->save();

        return redirect()->back()->with('success', 'Pemesanan berhasil disimpan.');
    }

    public function approve($id)
    {
        $booking = Booking::find($id);
        $formattedDate = Carbon::now();
        if ($booking) {
            
            $booking->status = $booking->status === '' ? '1' : '2';
            $booking->save();
            $approve = new Approve();
            $approve->user_id = Auth::user()->id;
            $approve->booking_id = $booking->id;
            $approve->tgl_persetujuan = $formattedDate;
            $approve->save();
    
            return redirect()->back()->with('success', 'Status booking berhasil diupdate.');
        } else {
            return redirect()->back()->with('error', 'Terjadi kesalahan.');
        }
    }
    
    public function reject($id)
    {
        $booking = Booking::find($id);
        $formattedDate = Carbon::now();
        if ($booking) {
            $booking->status = '3';
            $booking->save();
    
            $approve = new Approve();
            $approve->user_id = Auth::user()->id;
            $approve->booking_id = $booking->id;
            $approve->tgl_persetujuan = $formattedDate;
            $approve->save();
    
            return redirect()->back()->with('success', 'Status booking berhasil diupdate.');
        } else {
            return redirect()->back()->with('error', 'Terjadi kesalahan.'); // Menambahkan penanganan kesalahan
        }
    }
}
