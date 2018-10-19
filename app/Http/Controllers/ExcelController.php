<?php

namespace App\Http\Controllers;

use App\City;
use App\Doctor;
use App\Medcenter;
use App\Skill;
use Maatwebsite\Excel\Facades\Excel;

class ExcelController extends Controller
{

    public function loadDoctors()
    {
        ini_set('memory_limit', '-1');
        ini_set('max_execution_time', 0);
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
                if (!in_array($row[5], $exceptions)) {
                    if ($row[4] == 'Петропавловск' || $row[4] == 'Караганда' || $row[4] == 'Кокшетау' || $row[4] == 'Тараз') {
                        $skillsNames = [
                            trim($row[5]),
                            trim($row[6]),
                            trim($row[7]),
                            trim($row[8]),
                            trim($row[9])
                        ];
                        $skills = Skill::whereIn('name', $skillsNames)->get();
                        $doctorExist = Doctor::where('firstname', 'like', '%' . $row[2] . '%')->where('lastname', 'like', '%' . $row[1] . '%')->count();
                        if (!$doctorExist) {
                            $city = City::where('name', $row[4])->first();

                            if(!$city){
                                $city = new City();
                                $city->parent_id = 1;
                                $city->position = 1;
                                $city->name = $row[4];
                                $city->alias = \Slug::make($city->name);
                                $city->type = 'top_menu';
                                $city->status = 0;
                                $city->save();
                            }
                            $doctor = new Doctor();
                            $doctor->avatar = 'images/parse/' . $row[0];
                            $doctor->firstname = $row[2];
                            $doctor->lastname = $row[1];
                            $doctor->patronymic = $row[3];
                            $doctor->qualification = $row[11] ? $row[11] : 'Врач';

                            $date = strtotime(date('Y-m-d') . '-' . $row[10] . ' year');

                            $doctor->works_since = date('Y-m-d', $date);
                            $doctor->child = $row[14] && $row[14] == 'Да' ? 1 : 0;
                            $doctor->child_min_age = $row[15] ? $row[15] : null;
                            $doctor->address = $row[16];
                            $doctor->about_text = $row[18];
                            $doctor->status = 0;
                            $doctor->city_id = $city ? $city->id: 6;
                            $doctor->partner = Doctor::NOT_PARTNER;
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
            }

        });
    }

    public function loadSkills()
    {
        Excel::load('files/skills3.xls', function ($reader) {
            $results = $reader->toArray();

            foreach ($results as $rows) {
                foreach ($rows as $row) {
                    $alias = trim(preg_replace('|/|', '', $row[0]));
                    $existSkill = Skill::where('alias', $alias)->first();
                    if (!$existSkill) {
                        $skill = new Skill();
                        $skill->alias = $alias;
                        $skill->name = isset($row[1]) ? trim($row[1]) : '';
                        $skill->save();
                    }
                }
            }

            return 'ok';
        });
    }

    public function loadSkillsIllnessesGroup()
    {
        Excel::load('files/skills.xlsx', function ($reader) {
            $results = $reader->toArray();

            foreach ($results as $rows) {
                foreach ($rows as $row) {
                    $existSkill = Skill::find($row[0]);
                    if ($existSkill) {
                        $existSkill->illnesses_group_id = $row[2];
                        $existSkill->update();
                    }
                }
            }

            return 'ok';
        });
    }

    public function addPhones()
    {
        Excel::load('files/med_phones.xlsx', function ($reader) {
            $reader->skipRows(1);
            $results = $reader->toArray();

            foreach ($results as $rows) {
                foreach ($rows as $row){
                    $phone = trim(preg_replace('/[()]|\-|\–|\s+/', '', $row[2]));
                    $medcenter = Medcenter::find($row[0]);
                    if($medcenter){
                        foreach ($medcenter->doctors as $doctor){
                            $doctor->showing_phone = $phone;
                            $doctor->update();
                        }
                    }
                }

            }
            return 'ok';
        });
    }

}
