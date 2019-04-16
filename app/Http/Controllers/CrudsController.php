<?php

namespace App\Http\Controllers;

use App\Crud;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Faker\Generator;

class CrudsController extends Controller
{
    public function index()
    {
        return response(Crud::all()->jsonSerialize(), Response::HTTP_OK);
    }

    public function create(Generator $faker)
    {
        $crud = new Crud();
        $crud->name = $faker->name;
        $colorNum = $faker->numberBetween(1, 3);

        //generate battle stats
        $crud->atk = $faker->numberBetween(1, 15);
        $crud->def = $faker->numberBetween(1, 15);
        $crud->hp = $faker->numberBetween(60, 180);
        $crud->currentHp = $crud->hp;
        $crud->description = $faker->realText($maxNbChars = 100, $indexSize = 2);

        switch($colorNum){
            case 1:
                $crud->color = 'red';
            break;
            case 2:
                $crud->color = 'blue';
            break;
            case 3:
                $crud->color = 'green';
            break;
        }//end switch

        $crud->save();

        return response($crud->jsonSerialize(), Response::HTTP_CREATED);
    }

    public function update(Request $request, $id)
    {
        $crud = Crud::findOrFail($id);
        $crud->color = $request->color;
        $crud->currentHp = $request->hp;
        $crud->save();

        return response(null, Response::HTTP_OK);
    }

    public function destroy($id)
    {
        Crud::destroy($id);

        return response(null, Response::HTTP_OK);
    }
}
