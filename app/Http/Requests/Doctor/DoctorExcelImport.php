<?php

namespace App\Http\Requests\Doctor;

use Maatwebsite\Excel\Files\ExcelFile;

class DoctorExcelImport extends ExcelFile
{
    /**
     * Get file
     * @return string
     */
    public function getFile()
    {
        if (request()->hasFile('doctor_excel')) {
            $file = request()->file('doctor_excel');
            $path = $file->store('import');
        } else {
            $path = false;
        }
        return $path;
    }
}
