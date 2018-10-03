<?php

namespace App\Http\Controllers\Admin;

use App\Doctor;
use App\Http\Controllers\Controller;
use App\Http\Requests\Doctor\DoctorExcelImport;
use App\Skill;
use Maatwebsite\Excel\Classes\LaravelExcelWorksheet;

class DoctorImportController extends Controller
{
    public function importExcel($id = null, DoctorExcelImport $file)
    {
        try {
            $dataSet = [];

            $excel = $file->loadFile();
            $excel->calculate();
            $excel->sheet('Result', function (LaravelExcelWorksheet $sheet) use (&$dataSet) {
                $maxRow = $sheet->getHighestRow('A');
                for ($rowId = 2; $rowId <= $maxRow; $rowId++) {
                    $name = $sheet->getCell('A' . $rowId)->getValue();
                    $value = $sheet->getCell('B' . $rowId)->getOldCalculatedValue();
                    array_set($dataSet, $name, $value);
                }
            });
            $data = $this->processDataSet($dataSet);
            $doctor = Doctor::findOrNew($id);
            $doctor->fill($data);
            $doctor->save();

            /** @var Doctor $doctor */
            $this->processRelations($doctor, $data);
            return $doctor;
        } catch (\PHPExcel_Exception $exception) {
            abort(400, ['error' => 'Error reading excel']);
            return false;
        }
    }

    private function processDataSet($dataSet)
    {
        $skills = collect($dataSet['skills']);
        $skillIds = $skills->map(function ($skillName) {
            return Skill::where('name', $skillName)->first()->id ?? null;
        })->filter(function ($id) {
            return isset($id);
        });
        $dataSet['skills'] = $skillIds->toArray();
        $dataSet['timetable_obj'] = $dataSet['timetable'];
        unset($dataSet['timetable']);
        return $dataSet;
    }

    private function processRelations(Doctor $doctor, $data)
    {
        if (isset($data['skills'])) {
            $doctor->skills()->sync($data['skills']);
        }
        if (isset($data['items'])) {
            $ids = array_reduce($data['items'], function ($carry, $item) {
                if (isset($item['id']))
                    $carry[] = $item['id'];
                return $carry;
            }, []);
            $doctor->items()->whereNotIn('id', $ids)->delete();
            foreach ($data['items'] as $itemData) {

                if (empty($itemData['name']))
                    continue;
                $item = $doctor->items()->findOrNew($itemData['id'] ?? null);
                $item->fill($itemData);
                $doctor->items()->save($item);
            }
        }

    }

}
