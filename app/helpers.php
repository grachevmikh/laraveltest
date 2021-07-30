<?php
class Helpers{
    public static function returnId($name){
        // $data=App\Models\Category::all();
        // foreach($data as $d){
        //     if($d->name == $name)
        //     $id=$d->id;
        // }
        //easy way
        $data=App\Models\Category::where(['name'=>$name])->first();

        return $data->id;
    }
}