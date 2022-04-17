<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Medicine;
use App\Models\Part;
use Carbon\Carbon;

class MedicineController extends Controller
{
    //

    public function getmedicines(){
        $medicines=Medicine::orderBy('name')->get();
        foreach ($medicines as $med)  {
            $med->quantity=Part::where('medicine',$med->id)->where('exp', '>',Carbon::now())->sum('Quantity');
        
        }
        return response()->json(['status'=>'success','data'=>$medicines]);

    }
    public function getparts($id){
        $medicines=Medicine::find($id);
        $medicines->quantity=Part::where('medicine',$id)->where('exp', '>',Carbon::now())->sum('Quantity');
        $medicines->parts=Part::where('medicine',$id)->orderBy('exp', 'desc')->get();

        return response()->json(['status'=>'success','data'=>$medicines]);

    }
    public function getpartsexpired(){
        $medicines=Part::where('exp', '<=',Carbon::now())->get();;
        foreach ($medicines as $med)  {
            $med->name=Medicine::find($med->Medicine)->name;
        
        }
        return response()->json(['status'=>'success','data'=>$medicines]);

    }
    public function getpartsbyexp(Request $request){
        $medicines=Part::where('exp', '=',$request->date)->get();;
        foreach ($medicines as $med)  {
            $med->name=Medicine::find($med->Medicine)->name;
        
        }
        return response()->json(['status'=>'success','data'=>$medicines]);

    }
    
    public function getmedicinebyname(Request $request){
        $medicines=Medicine::where('name',$request->name)->get();
        foreach ($medicines as $med)  {
            $med->quantity=Part::where('medicine',$med->id)->where('exp', '>',Carbon::now())->sum('Quantity');
        
        }
        return response()->json(['status'=>'success','data'=>$medicines]);

    }
    public function getmedicinesbyactives(Request $request){
        $medicines=Medicine::where('active_ingredient', 'like', '%' . $request->actives . '%')->get();
        foreach ($medicines as $med)  {
            $med->quantity=Part::where('medicine',$med->id)->where('exp', '>',Carbon::now())->sum('Quantity');
        
        }
        return response()->json(['status'=>'success','data'=>$medicines]);

    }
    public function addparts(Request $request){
        if(is_null(Medicine::where('name',$request->name)->first())){
            $medicine=new Medicine();
            $medicine->name=$request->name;
            $medicine->active_ingredient=$request->actives;
            $medicine->quantity=$request->quantity;
            if(is_null($medicine->active_ingredient))$medicine->active_ingredient='';
            $medicine->timestamps = false;
            $medicine->save();
        }else{
            $medicine=Medicine::where('name',$request->name)->first();
            if(is_null($medicine->active_ingredient))$medicine->active_ingredient='';
            if(strpos($medicine->active_ingredient,$request->actives) == false)
                $medicine->active_ingredient=$medicine->active_ingredient.','.$request->actives;
            $medicine->timestamps = false;
            $medicine->update();
        }
        $id=Medicine::where('name',$request->name)->first()->id;
        if(is_null(Part::where('Medicine',$id)->where('position',$request->position)->where('exp',$request->exp)->first())){
            $part=new Part();
            $part->Medicine=Medicine::where('name',$request->name)->first()->id;
            $part->Quantity=$request->quantity;
            $part->EXP=$request->exp;
            $part->position=$request->position;
            $part->timestamps = false;
            $part->save();
        }else{
            $part=Part::where('Medicine',$id)->where('position',$request->position)->where('exp',$request->exp)->first();
            $part->Quantity=$part->Quantity+$request->quantity;
            $part->timestamps = false;
            $part->update();
        }
        return response()->json(['status'=>'success','data'=>$part]);

    }
    public function giveparts(Request $request){
        $id=Medicine::where('name',$request->name)->first()->id;
        $part=Part::where('Medicine',$id)->where('position',$request->position)->where('exp',$request->exp)->first();
        $part->Quantity=$part->Quantity-$request->quantity;
        $part->timestamps = false;
        $part->update();
        return response()->json(['status'=>'success','data'=>$part]);

    }


}
