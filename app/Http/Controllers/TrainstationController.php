<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Kreait\Firebase\Contract\Database;

class TrainstationController extends Controller
{
    protected $database;
    public function __construct(Database $database)
    {
        $this->database = $database;
    }

    public function index()
    {
    }

    public function create()
    {
        $fac_all = $this->database->getReference('Facility')->getValue();
        return (view('admins.setting.Trainstationcreate', compact('fac_all')));
    }
    public function edit($key)
    {
        $station_key = $key;
        $fac_all = $this->database->getReference('Facility')->getValue();
        $station = $this->database->getReference('TranStation' . '/' . $key)->getValue();
        $station_name = $station['station_name'];
        $count_door = count($station['ExitDoors']) - 1;
        $exit_door = $station['ExitDoors'];
        $facility = $station['Facilities'];
        $price = $station['price'];
        $local_station = $station['station'];
        return (view(
            'admins.setting.Trainstationedit',
            compact(
                'station_key',
                'station_name',
                'count_door',
                'exit_door',
                'facility',
                'price',
                'local_station',
                'fac_all'
            )
        ));
    }
    public function store_station(Request $request)
    {

        if ((!isset($request->in_latitude)) || (!isset($request->out_latitude)) || (!isset($request->tran_name))) {
            alert('swal', 'error', 'กรุณากรอกข้อมูลให้ถูกต้อง', 'เกิดข้อผิดพลาด');
            return (redirect()->back());
        }

        $data = [];
        $marking_in = [];
        $marking_out = [];
        foreach ($request->in_latitude as $key => $inlat) {
            $marking_in[$key] = [floatval($inlat), floatval($request->in_longitude[$key]), floatval($request->in_attitude[$key])];
        }
        foreach ($request->out_latitude as $key => $outlat) {
            $marking_out[$key] = [floatval($outlat), floatval($request->out_longitude[$key]), floatval($request->out_attitude[$key])];
        }

        foreach ($request->tran_name as $key => $trn_name) {
            $desc1_property_name = "tran_desc1_" . $key;
            $desc2_property_name = "tran_desc2_" . $key;

            $desc1_value = $request->$desc1_property_name;
            $desc2_value = $request->$desc2_property_name;

            $data[$key]['tran_name'] = $trn_name;
            $data[$key]['tran_time'] = $request->tran_time[$key];
            if (isset($desc1_value) || ($desc2_value)) {
                $temp_desc = [];
                for ($i = 0; $i < count($desc1_value); $i++) {
                    if (($desc1_value[$i]) && (!$desc2_value[$i])) {
                        $temp_desc[$i] = [$desc1_value[$i], ""];
                    }
                    if ((!$desc1_value[$i]) && ($desc2_value[$i])) {
                        $temp_desc[$i] = ["", $desc2_value[$i]];
                    }
                    if (($desc1_value[$i]) && ($desc2_value[$i])) {
                        $temp_desc[$i] = [$desc1_value[$i], $desc2_value[$i]];
                    }
                }
                $data[$key]['tran_desc'] = $temp_desc;
            }
        }
        $station_marker = [$request['longtitude'], $request['latitude']];
        $exitData = [
            'exdor_name' => $request->exit_name,
            'exdor_desc' => $request->exdors_detail,
            'Transports' => $data
        ];

        // dd($exitData);
        $lastStation = $this->database->getReference('TranStation')->orderByKey()->limitToLast(1)->getValue();
        $keystation = key($lastStation);
        $nextKey = (int) $keystation + 1;
        $facilities = array_map('intval', $request->facilities);
        $newKey = str_pad($nextKey, strlen($keystation), '0', STR_PAD_LEFT);
        // dd($newKey);
        // dd($facilities);
        $new_station = $this->database->getReference('TranStation')->getChild($newKey)->set([
            'ExitDoors' => [
                '1' => $exitData
            ],
            'Facilities' => [
                'id' => $facilities
            ],
            'created_date' => date('Y-m-d H:i:s'),
            'price' => '20',
            'station' => $station_marker,
            'station_name' => $request->station_name,
            'updated_date' => date('Y-m-d H:i:s')
        ]);        

        $in_save = $this->database->getReference('MapMarking/in/' . $newKey . '/1/')->set($marking_in);
        $out_save = $this->database->getReference('MapMarking/out/' . $newKey . '/1/')->set($marking_out);
        return ($this->edit($newKey));
    }
    public function destroy_station($station_id){
            $destroy_exit = $this->database->getReference('TranStation' . '/' . $station_id)->remove();
            $destroy_in = $this->database->getReference('MapMarking' . '/in/' . $station_id)->remove();
            $destroy_out = $this->database->getReference('MapMarking' . '/out/' . $station_id)->remove();
    }

    public function mainstation_update(Request $request, $id)
    {
        //dd($request->station_name, $request->price, $request->facilities);
        $markingstation = [floatval($request->longtitude), floatval($request->latitude)];
        $getStation = $this->database->getReference('TranStation')->getValue();
        $facilities = array_map('intval', $request->facilities);
        $sv_stt = [
            'station_name' => $request->station_name,
            'Facilities' . '/id' => $facilities,
            'price' => $request->price,
            'station' => $markingstation
        ];
        $upd_station = $this->database->getReference('TranStation' . '/' . $id)->update($sv_stt);

        return (redirect()->back());
    }

    public function create_door($station_id)
    {
        $station = $this->database->getReference('TranStation' . '/' . $station_id)->getValue();
        $lastIdExdor = $this->database->getReference('TranStation/' . $station_id . '/ExitDoors/')->orderByKey()->limitToLast(1)->getValue();
        $last_exdorId = (key($lastIdExdor));
        $newexdorId = $last_exdorId + 1;
        return (view('admins.setting.TrainstationDoorcreate', compact('station_id', 'newexdorId', 'station')));
    }

    public function store_door(Request $request, $newexdorId, $station_id)
    {
        if ((!isset($request->in_latitude)) || (!isset($request->out_latitude)) || (!isset($request->tran_name))) {
            alert('swal', 'error', 'กรุณากรอกข้อมูลให้ถูกต้อง', 'เกิดข้อผิดพลาด');
            return (redirect()->back());
        }
        $data = [];
        $marking_in = [];
        $marking_out = [];
        foreach ($request->in_latitude as $key => $inlat) {
            $marking_in[$key] = [floatval($inlat), floatval($request->in_longitude[$key]), floatval($request->in_attitude[$key])];
        }
        foreach ($request->out_latitude as $key => $outlat) {
            $marking_out[$key] = [floatval($outlat), floatval($request->out_longitude[$key]), floatval($request->out_attitude[$key])];
        }

        foreach ($request->tran_name as $key => $trn_name) {
            $desc1_property_name = "tran_desc1_" . $key;
            $desc2_property_name = "tran_desc2_" . $key;

            $desc1_value = $request->$desc1_property_name;
            $desc2_value = $request->$desc2_property_name;

            $data[$key]['tran_name'] = $trn_name;
            $data[$key]['tran_time'] = $request->tran_time[$key];
            if (isset($desc1_value) || ($desc2_value)) {
                $temp_desc = [];
                for ($i = 0; $i < count($desc1_value); $i++) {
                    if (($desc1_value[$i]) && (!$desc2_value[$i])) {
                        $temp_desc[$i] = [$desc1_value[$i], ""];
                    }
                    if ((!$desc1_value[$i]) && ($desc2_value[$i])) {
                        $temp_desc[$i] = ["", $desc2_value[$i]];
                    }
                    if (($desc1_value[$i]) && ($desc2_value[$i])) {
                        $temp_desc[$i] = [$desc1_value[$i], $desc2_value[$i]];
                    }
                }
                $data[$key]['tran_desc'] = $temp_desc;
            }
        }
        // new
        $lastDoor = $this->database->getReference('TranStation/'.$station_id.'/ExitDoors')->orderByKey()->limitToLast(1)->getValue();
        
        $keyDoor = key(array_filter($lastDoor));
        $nextKey = (int) $keyDoor + 1;
        $newKey = str_pad($nextKey, strlen($keyDoor), '0', STR_PAD_LEFT);
        $base_in = $this->database->getReference('MapMarking/in/' . $station_id);
        $base_out = $this->database->getReference('MapMarking/out/' . $station_id);

        $in_save = $base_in->getChild($newKey)->set($marking_in);
        $out_save = $base_out->getChild($newKey)->set($marking_out);

        $newFirebaseRef = $this->database->getReference('TranStation/' . $station_id . '/ExitDoors/')->getChild($newKey);
        $newFirebaseRef->set([
            'exdor_name' => $request->exit_name,
            'exdor_desc' => $request->exdors_detail,
            'Transports' => $data
        ]);
        return ($this->edit($station_id));
    }

    public function edit_door($exdor_id, $station_id)
    {
        $station = $this->database->getReference('TranStation' . '/' . $station_id)->getValue();
        $station_name = $station['station_name'];
        $in_marking = $this->database->getReference('MapMarking' . '/in/' . $station_id . '/' . $exdor_id)->getValue();
        $out_marking = $this->database->getReference('MapMarking' . '/out/' . $station_id . '/' . $exdor_id)->getValue();
        $dataExit = $this->database->getReference('TranStation' . '/' . $station_id . '/ExitDoors' . '/' . $exdor_id)->getValue();
        //dd($dataExit);
        return (view(
            'admins.setting.TrainstationDooredit',
            compact(
                'exdor_id',
                'station_id',
                'station_name',
                'dataExit',
                'in_marking',
                'out_marking'
            )
        ));
    }

    public function delete_door($exdor_id, $station_id)
    {
        $count_exits = count($this->database->getReference('TranStation' . '/' . $station_id . '/ExitDoors')->getValue());
        if ($count_exits > 2) {
            $destroy_exit = $this->database->getReference('TranStation' . '/' . $station_id . '/ExitDoors' . '/' . $exdor_id)->remove();
            $destroy_in = $this->database->getReference('MapMarking' . '/in/' . $station_id . '/' . $exdor_id)->remove();
            $destroy_out = $this->database->getReference('MapMarking' . '/out/' . $station_id . '/' . $exdor_id)->remove();
            alert('swal', 'success', 'ลบทางออกสำเร็จ', 'สำเร็จ');
        } else {
            alert('swal', 'error', 'สถานีต้องมีอย่างน้อย 1 ทางออก', 'ไม่สำเร็จ');
        }
        return ($this->edit($station_id));
    }


    public function update_door(Request $request, $exdor_id, $station_id)
    {
        // $checkNull_inlat = count($request->in_latitude);
        // $checkNull_outlat = count($request->out_latitude);
        // $checkNull_tran = count($request->tran_name);
        if ((!isset($request->in_latitude)) || (!isset($request->out_latitude)) || (!isset($request->tran_name))) {
            alert('swal', 'error', 'กรุณากรอกข้อมูลให้ถูกต้อง', 'เกิดข้อผิดพลาด');
            return (redirect()->back());
        }
        $data = [];
        $marking_in = [];
        $marking_out = [];
        foreach ($request->in_latitude as $key => $inlat) {
            $marking_in[$key] = [floatval($inlat), floatval($request->in_longitude[$key]), floatval($request->in_attitude[$key])];
        }

        foreach ($request->out_latitude as $key => $outlat) {
            $marking_out[$key] = [floatval($outlat), floatval($request->out_longitude[$key]), floatval($request->out_attitude[$key])];
        }

        foreach ($request->tran_name as $key => $trn_name) {
            $desc1_property_name = "tran_desc1_" . $key;
            $desc2_property_name = "tran_desc2_" . $key;

            $desc1_value = $request->$desc1_property_name;
            $desc2_value = $request->$desc2_property_name;

            $data[$key]['tran_name'] = $trn_name;
            $data[$key]['tran_time'] = $request->tran_time[$key];
            if (isset($desc1_value) || ($desc2_value)) {
                $temp_desc = [];
                for ($i = 0; $i < count($desc1_value); $i++) {
                    if (($desc1_value[$i]) && (!$desc2_value[$i])) {
                        $temp_desc[$i] = [$desc1_value[$i], ""];
                    }
                    if ((!$desc1_value[$i]) && ($desc2_value[$i])) {
                        $temp_desc[$i] = ["", $desc2_value[$i]];
                    }
                    if (($desc1_value[$i]) && ($desc2_value[$i])) {
                        $temp_desc[$i] = [$desc1_value[$i], $desc2_value[$i]];
                    }
                }
                $data[$key]['tran_desc'] = $temp_desc;
            }
        }

        $base_in = $this->database->getReference('MapMarking/in/' . $station_id);
        $base_out = $this->database->getReference('MapMarking/out/' . $station_id);
        $base_in->update([$exdor_id => $marking_in]);
        $base_out->update([$exdor_id => $marking_out]);

        $firebaseRef = $this->database->getReference('TranStation/' . $station_id . '/ExitDoors/' . $exdor_id);
        $existingData = $firebaseRef->getSnapshot()->getValue();

        if ($existingData !== null) {
            $firebaseRef->update([
                'exdor_name' => $request->exit_name,
                'exdor_desc' => $request->exdors_detail,
                'Transports' => $data
            ]);
        } else {
            $newFirebaseRef = $this->database->getReference('TranStation/' . $station_id . '/ExitDoors')->push();
            $newFirebaseRef->set([
                'exdor_name' => $request->exit_name,
                'exdor_desc' => $request->exdors_detail,
                'Transports' => $data
            ]);
        }
        alert('swal', 'success', 'แก้ไขข้อมูลสำเร็จ', 'สำเร็จ');
        return (redirect()->back());
    }
}
