<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Absen;
use Illuminate\Support\Carbon;

class AbsenController extends Controller
{
    private function haversineDistance($lat1, $lon1, $lat2, $lon2)
    {
        $earthRadius = 6371;

        $dLat = deg2rad($lat2 - $lat1);
        $dLon = deg2rad($lon2 - $lon1);

        $a = sin($dLat / 2) * sin($dLat / 2) +
            cos(deg2rad($lat1)) * cos(deg2rad($lat2)) *
            sin($dLon / 2) * sin($dLon / 2);

        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

        return $earthRadius * $c;
    }

    public function user_absen()
    {
        return view('absen.user');
    }


    public function super_absen()
    {

        return view('absen.superadmin-absen');
    }

    public function store(Request $request)
    {
        $request->validate([
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
        ]);

        $userLat = $request->input('latitude');
        $userLon = $request->input('longitude');

        $officeLat = (float) env('OFFICE_LATITUDE');
        $officeLon = (float) env('OFFICE_LONGITUDE');
        $allowedRadius = (float) env('ALLOWED_RADIUS_KM');
        $timezone = 'Asia/Jakarta';
        $deadlineTime = Carbon::createFromFormat('H:i:s', env('ABSEN_DEADLINE_TIME'), $timezone);
        $absenTime = Carbon::now($timezone);

        $status = 'hadir';
        
        if ($absenTime->gt($deadlineTime)) {
            $status = 'telat';
        }

        $distance = $this->haversineDistance($officeLat, $officeLon, $userLat, $userLon);

        if ($distance <= $allowedRadius) {
            Absen::create([
                'user_id' => auth()->id(),
                'latitude' => $userLat,
                'longitude' => $userLon,
                'tanggal' => $absenTime->toDateString(),
                'waktu' => $absenTime->toTimeString(),
                'status'    => $status,
                'distance' => $distance,
            ]);
            return redirect()->route('super-absen')->with('sukses', 'Absensi berhasil!');
        } else {
            return redirect()->route('super-absen')->with('error', 'Anda berada di luar area yang diperbolehkan. Jarak Anda: ' . number_format($distance, 2) . ' km');
        }
    }
}
