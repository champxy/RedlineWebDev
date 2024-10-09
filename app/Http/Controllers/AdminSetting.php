<?php

namespace App\Http\Controllers;

use App\Models\rooms;
use App\Models\region;
use App\Models\central;
use App\Models\district;
use App\Models\province;
use App\Models\facilities;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Http\Requests\settingCentralRequest;
use App\Http\Requests\settingFacilityRequest;
use App\Models\host_estate;
use App\Models\type_estate;

use Kreait\Firebase\Contract\Database;

class AdminSetting extends Controller
{

    protected $database;
    public function __construct(Database $database)
    {
        $this->database = $database;
    }

    public function index()
    {
        $fec = $this->database->getReference('Facility')->getValue();
        $station = $this->database->getReference('TranStation')->getValue();
        return (view('admins.setting.adminSetting',compact('fec','station')));
    }

    public function user_management()
    {
        $users = $this->database->getReference('User')->getValue();
        $comment = $this->database->getReference('Comment')->getValue();
        $train = $this->database->getReference('TranStation')->getValue();
        return (view('admins.Usermanagement',compact('users','comment','train')));
    }

    public function block_user($id){
        $status = ['status'=>'block'];
        $block_user = $this->database->getReference('User/'.$id)->update($status);
        alert('swal', 'success', 'บล็อคผู้ใช้สำเร็จ', 'สำเร็จ');
        return($this->user_management());
    }

    public function active_user($id){
        $status = ['status'=>'active'];
        $block_user = $this->database->getReference('User/'.$id)->update($status);
        alert('swal', 'success', 'active ผู้ใช้สำเร็จ', 'สำเร็จ');
        return($this->user_management());
    }

    public function train_management()
    {
        $users = $this->database->getReference('User')->getValue();
        $train = $this->database->getReference('TranStation')->getValue();
        $comment = $this->database->getReference('Comment')->getValue();
        return (view('admins.TrainManagement',compact('train','comment','users')));
    }

    public function admin_overview()
    {
        $facility = $this->database->getReference('Facility')->getValue();
        $transtation = $this->database->getReference('TranStation')->getValue();
        $users = $this->database->getReference('User')->getValue();
        $comment = $this->database->getReference('Comment')->getValue();
        return (view('admins.OverviewAdmin',compact('facility','transtation','users','comment')));
    }

    public function update_fac(Request $request)
    {
        $get_name = $this->database->getReference('Facility')->getValue();
        if ($request->facility) {
            foreach ($request->facility as $key => $fct_name) {
                if ($fct_name != null) {
                    if ($get_name[$key]['fac_name'] != $fct_name) {
                        $sv_fac = [
                            'fac_name' => $fct_name,
                            'fac_desc' => ""
                        ];
                        $upd_fac = $this->database->getReference('Facility'.'/'.$key)->update($sv_fac);
                    }
                }
            }
        }
        if ($request->facility_new) {
            $fetch_fct_new = array_unique($request->facility_new);
            foreach ($fetch_fct_new as $facilityName) {
                if ($facilityName != null) {
                    $lastIdSnapshot = $this->database->getReference('Facility')->orderByKey()->limitToLast(1)->getValue();
                    // มี id อยู่ในฐานข้อมูลแล้ว
                    if ($lastIdSnapshot) {
                        $lastId = key($lastIdSnapshot); // ดึง key ของตัวล่าสุด
                        $newId = intval($lastId) + 1; // เพิ่ม 1 เข้าไปเพื่อให้เป็น id ตัวล่าสุด + 1
                    } else {
                        // ยังไม่มีข้อมูลในฐานข้อมูลเลย
                        $newId = 0;
                    }
                    $fac_key = strval($newId);
                    $sv_fac = [
                        'fac_name' => $facilityName,
                        'fac_desc' => ""
                    ];
                    $fac_save = $this->database->getReference('Facility')->getChild($fac_key)->set($sv_fac);
                }
            }  
        }
        return (redirect()->back());
    }
    public function destroy_fac($id)
    {
        $upd_fac = $this->database->getReference('Facility'.'/'.$id)->remove();
        return (redirect()->back());
    }
    
    //Station{
        public function update_station(Request $request){
            $getStation = $this->database->getReference('TranStation')->getValue();
            if ($request->station) {
                $sendID = 0;
                foreach ($getStation as $key => $station_name) {
                    
                    if ($station_name != null) {
                        if ($request->station[$sendID] != $station_name['station_name']) {
                            $sv_stt = [
                                'station_name' => $request->station[$sendID],
                            ];
                            $upd_station = $this->database->getReference('TranStation'.'/'.$key)->update($sv_stt);
                        }
                    }
                    $sendID++;
                }
            }
            return (redirect()->back());
        }



}
