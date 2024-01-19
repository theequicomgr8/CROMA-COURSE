<?php

namespace App\Imports;

use App\Models\Curriculum;
//use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use DB;
use Session;
use Illuminate\Support\Facades\Http;
//class CurriculumImport implements ToModel
class CurriculumImport implements ToCollection
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    
    /*public function model(array $row)
    {
        return new Curriculum([
            
        ]);
    }*/
    public function collection(Collection $collection)
    {
        
        foreach($collection as $row){
            DB::table('curriculums')->insert([
                "category_id"=>Session::get('category_id'),
                "course_id"=>Session::get('course_id'),
                "template_id"=>Session::get('template_id'),
                "module_heading"=>$row[0],
                "heading"=>$row[1],
                "sub_heading"=>$row[2],
                "child_heading"=>$row[3],
            ]);
            
            //callAPI('GET', "course.cromacampus.com/api/savedata?module_heading=$row[0]", false);
            
            // $response = Http::post('course.cromacampus.com/api/savedata', [
            //         'title' => 'This is test from ItSolutionStuff.com',
            //         'category_id' => Session::get('category_id')
            //     ]);
            
        }
    }
}
