<?php

namespace App\Http\Controllers;

use App\Doctor;
use App\Skill;
use Maatwebsite\Excel\Facades\Excel;

class ExcelController extends Controller
{

    public function loadDoctors()
    {
        Excel::load('files/doctors.xlsx', function ($reader) {
            $reader->skipRows(1);
            $results = $reader->get();

            $exceptions = [
                'Лаборант',
                'Медицинская сестра',
                'Медсестра',
                'Медбрат',
                'Санитар',
                'Судебно медицинский эксперт',
                'фармацевт',
                'Фельдшер'
            ];

            foreach ($results as $row) {
                if ($row[4] == 'Алматы' && !in_array($row[5], $exceptions)) {
                    $skillsNames = [
                        trim($row[5]),
                        trim($row[6]),
                        trim($row[7]),
                        trim($row[8]),
                        trim($row[9])
                    ];
                    $skills = Skill::whereIn('name', $skillsNames)->get();
                    $doctorExist = Doctor::where('firstname','like', '%' .  $row[2] . '%')->where('lastname','like', '%' .  $row[2] . '%')->count();
                    if(!$doctorExist){
                        $doctor = new Doctor();
                        $doctor->avatar = 'images/parse/' . $row[0];
                        $doctor->firstname = $row[2].' '.$row[3];
                        $doctor->lastname = $row[1];
                        $doctor->city_id = $row[4];
                        $doctor->qualification = $row[11] ? $row[11]: 'Врач';

                        $date = strtotime(date('Y-m-d'). '-'.$row[10].' year');

                        $doctor->works_since = date('Y-m-d', $date);
                        $doctor->child = $row[14] && $row[14] == 'Да' ? 1:0;
                        $doctor->child_min_age = $row[15] ? $row[15]:null;
                        $doctor->address = $row[16];
                        $doctor->about_text = $row[18];
                        $doctor->status = 0;
                        $doctor->city_id = 6;
                        $doctor->save();

                        if ($skills) {
                            $skills = collect($skills)->mapWithKeys(function ($skill) {
                                return [$skill['id'] => ['weight' => 0]];
                            });
                            $doctor->skills()->sync($skills);
                        }
                    }
                }
            }

        });
    }

    public function loadSkills()
    {
        Excel::load('files/skills3.xls', function ($reader) {
            $results = $reader->toArray();

            foreach ($results as $rows) {
                foreach ($rows as $row){
                    $alias = trim(preg_replace('|/|', '', $row[0]));
                    $existSkill = Skill::where('alias', $alias)->first();
                    if(!$existSkill){
                        $skill = new Skill();
                        $skill->alias = $alias;
                        $skill->name = isset($row[1]) ? trim($row[1]):'';
                        $skill->save();
                    }
                }
            }

            return 'ok';
        });
    }

}
