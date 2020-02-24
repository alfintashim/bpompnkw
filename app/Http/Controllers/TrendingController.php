<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Alert;
use App\Trending;
use App\Aduan;
use DB;
use Carbon;
use Illuminate\Database\Query\Builder;


class TrendingController extends Controller
{
	public function index()
	{
		// $aduan_last_seven_days = DB::table('aduans')
		// ->select('jenis_produk')
		// ->whereDate('created_at', '>', Carbon::now()->subDays(7));

		$date = new Carbon\Carbon; //  DateTime string will be 2014-04-03 13:57:34
		// $date->subWeek();
		$date->subDays(7);

		$aduan_last_seven_days = Aduan::where('created_at', '>', $date->toDateTimeString())->get();

		$trending = Aduan::select('jenis_produk', DB::raw('COUNT(jenis_produk) AS jumlah'))
		->groupBy('jenis_produk')
		->orderBy('jumlah', 'desc')
		->whereDate('created_at', '>', Carbon\Carbon::now()->subDays(7))
		->get();

		$trending_new = Aduan::select('jenis_produk', DB::raw('COUNT(jenis_produk) AS jumlah'))
		->groupBy('jenis_produk')
		->orderBy('jumlah', 'desc')
		->whereDate('created_at', '>', Carbon\Carbon::now()->subDays(7))
		->first();

		$compact = [
			'trending',
			'aduan_last_seven_days',
			'trending_new'
		];

		return view ('trending.index', compact($compact))
		->with('no',1);
	}

	public function store(Request $request)
	{
		$trending = new Trending;

		$trending->jenis_produk = $request->jenis_produk;
		$trending->nama_produk = $request->nama_produk;

		$trending->save();

		Alert::success('Success', 'Data Trending Berhasil Dibuat!');

		return redirect ('/trending');
	}
}