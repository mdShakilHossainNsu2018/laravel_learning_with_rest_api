<?php

namespace App\Http\Controllers\Country;

use App\Http\Controllers\Controller;
use App\Models\CountryModel;
use Validator;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    //

    public function country(){
//        return response()->json(CountryModel::get(), 200);

        return CountryModel::all();
    }

    public function countryById($id){

        $country = CountryModel::find($id);

        if (is_null($country)){
            return response()->json(['message'=>'Item dose not found!'], 404);
        }

        return $country;
    }

    public function createCountry(Request $request){
//        $country = CountryModel::create($request->all());

        $rules = [
            'name' => 'required|min:3',
            'iso' => 'required|min:2|max:3'
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()){
            return response()->json($validator->errors(), 400);
        }

        return CountryModel::create($request->all());

//        return response()->json($country, 201);
    }

    public function updateCountry(Request $request, $id){

        $country = CountryModel::find($id);

        if (is_null($country)){
            return response()->json(['message'=>'Item dose not found!'], 404);
        }
        $country->update($request->all());
        return response()->json($country, 200);
    }

    public function deleteCountry(Request $request, $id){

        $country = CountryModel::find($id);

        if (is_null($country)){
            return response()->json(['message'=>'Item dose not found!'], 404);
        }
         $country->delete();

         return response()->json(null, 204);

    }

//    public function delete($id) {
//        $article = Article::findOrFail($id);
//        if($article)
//            $article->delete();
//        else
//            return response()->json(error);
//        return response()->json(null);
//    }


}
