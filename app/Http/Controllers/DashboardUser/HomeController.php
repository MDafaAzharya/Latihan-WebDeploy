<?php

namespace App\Http\Controllers\DashboardUser;

use App\Http\Controllers\Controller;
use App\Models\Donasi;
use App\Models\Kategori;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        $kategori = Kategori::all();

        $icon = [
          "ti-tie",
          "ti-users-group",
          "ti-building",
          "ti-star-filled",
        ];

        $label = [
          "primary",
          "info",
          "warning",
          "success",
        ];

        $color = [
          "#00A39D",
          "#00cfe8",
          "#ff9f43",
          "#28c76f",
        ];

        foreach ($kategori as $idx => $value) {
          $data = Donasi::where('kategori_id', $value->id)->count();
          $value->jumlah_data = $data;
          $value->icon = $icon[$idx];
          $value->label = $label[$idx];
          $value->color = $color[$idx];
        }

        $ageCategory = DB::select("
          SELECT t.age_group, COUNT(*) AS age_count FROM
          (
              SELECT
                  CASE WHEN TIMESTAMPDIFF(YEAR, birthdate, CURDATE()) BETWEEN 20 AND 25
                      THEN '20-25'
                      WHEN TIMESTAMPDIFF(YEAR, birthdate, CURDATE()) BETWEEN 26 AND 35
                      THEN '26-35'
                      WHEN TIMESTAMPDIFF(YEAR, birthdate, CURDATE()) BETWEEN 36 AND 45
                      THEN '36-45'
                      WHEN TIMESTAMPDIFF(YEAR, birthdate, CURDATE()) BETWEEN 46 AND 55
                      THEN '46-55'
                      WHEN TIMESTAMPDIFF(YEAR, birthdate, CURDATE()) > 55
                      THEN '46-55'
                      ELSE 'Lainnya'
                  END AS age_group
              FROM donasi
          ) t
          GROUP BY t.age_group ORDER BY t.age_group;
        ");

        $last30Days = DB::select("SELECT DATE_FORMAT(created_at, '%Y-%m-%d') AS x, COUNT(*) AS y FROM donasi WHERE created_at BETWEEN NOW() - INTERVAL 30 DAY AND NOW() GROUP BY x ORDER BY x ASC");



        return view('dashboard-user.home', ['kategori' => $kategori, 'ageCategory' => $ageCategory, "last30Days" => $last30Days]);
    }
}
