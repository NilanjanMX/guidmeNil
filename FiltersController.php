<?php

/**
 * Class name :  FiltersController
 * Functionality : index, create, store, show, edit, update, destroy
 * Author : Subham Dutta
 * Created Date : 17-12-2018
 * Purpose : Search Filters Category Management
 */

 namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Filter;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Input;

class FiltersController extends Controller
{
    function __construct()
    {
        /** Permission middlewares */
        $this->middleware('permission:filters-list');
        $this->middleware('permission:filters-create', ['only' => ['create','store']]);
        $this->middleware('permission:filters-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:filters-delete', ['only' => ['destroy']]);
    }

    /**
     * Function name : index
     * Purpose : Display a listing of the resource
     * Author : Subham Dutta
     * Created Date : 08-02-2019
     * Modified date :
     * Params :
     * Return : \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        /*if(isset($request->id)) {
            $filters = Filter::where('filter_id','=',$request->id)->get();
        } else {
            $filters = Filter::where('filter_id','=',NULL)->get();
        }*/
        $filters = Filter::where('filter_id','=',NULL)->with('filterData')->get();
        //dd($filters);
        return view('admin.filters.index', compact('filters'));
    }

    /**
     * Function name : create
     * Purpose : Show the form for creating a new resource
     * Author : Subham Dutta
     * Created Date : 17-12-2018
     * Modified date :
     * Params :
     * Return : \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.filters.create');
    }

    /**
     * Function name : store
     * Purpose : Store a newly created resource in storage
     * Author : Subham Dutta
     * Created Date : 17-12-2018
     * Modified date :
     * Params : \Illuminate\Http\Request  $request
     * Return : \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /**************modified by PK date:30 may 2022 *****************************/
        $this->validate($request, [
            // 'name' => 'required
            'name' => 'required|unique:filters,name' // add name validation
        ]);
        // $this->validate($request, [
        //     'name' => 'required',
        //     'short_name' => 'required',
        //     'application_date' => 'required',
        //     'exam_date' => 'required',
        //     'short_description' => 'required',
        // ]);
        /***************modified by PK date:30 may 2022*****************************/
        $input = $request->all();
        $input['slug'] = str_slug($request->name);
        if (Input::hasFile('image')) {

            $image = Input::file('image');

            $imageName = $image->getClientOriginalName();
            $imageExtesion = $image->getClientOriginalExtension();
            //$imageNwName = time() . "_" . $imageName;
            $imageNwName = time().'.'.$imageExtesion;

            $img = Image::make($image->getRealPath());
            $img->resize(200, 150, function ($constraint) {
                $constraint->aspectRatio();
            })->save(public_path('uploads/filters/thumbnail/') . $imageNwName);

            $upload_image = $image->move('uploads/filters', $imageNwName);
            $input['image'] = $imageNwName;
        }

        Filter::create($input);
        $filterId = $request->filter_id;
        if($filterId) { $queryString = '?id='.$filterId; } else { $queryString = ''; }
        return redirect('admin/filters'.$queryString)->with('success', 'Filter created successfully');
    }

    /**
     * Function name : show
     * Purpose : Display the specified resource
     * Author : Subham Dutta
     * Created Date : 17-12-2018
     * Modified date :
     * Param :  int  $id
     * Return : \Illuminate\Http\Response
     */
    public function show($id)
    {
        $filter = Filter::find($id);
        return view('admin.filters.show', compact('filter'));
    }

    /**
     * Function name : edit
     * Purpose : Show the form for editing the specified resource
     * Author : Subham Dutta
     * Created Date : 17-12-2018
     * Modified date :
     * Param :  int  $id
     * Return : \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $filter = Filter::find($id);
        return view('admin.filters.edit', compact('filter'));
    }

    /**
     * Function name : update
     * Purpose : Update the specified resource in storage
     * Author : Subham Dutta
     * Created Date :17-12-2018
     * Modified date :
     * Param :  \Illuminate\Http\Request  $request, int  $id
     * Return : \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        /****************modified*****************/
        // $this->validate($request, [
        //     'name' => 'required',
        //     'short_name' => 'required',
        //     'application_date' => 'required',
        //     'exam_date' => 'required',
        //     'short_description' => 'required',
        // ]);
        /****************************************/
        /*************Modified by PK date 30 may 2022**************/
          $this->validate($request, [
            'name' => 'required',
          ]);
        /*************Modified by PK date 30 may 2022**************/

        $input = $request->all();

        $filter = Filter::findOrFail($id);
        $filterId = $filter->filter_id;

        $filter->name = $request->name;
        $filter->slug = str_slug($request->name);

        if (Input::hasFile('image')) {

            $image = Input::file('image');

            $imageName = $image->getClientOriginalName();
            $imageExtesion = $image->getClientOriginalExtension();
            //$imageNwName = time() . "_" . $imageName;
            $imageNwName = time().'.'.$imageExtesion;

            $img = Image::make($image->getRealPath());
            $img->resize(200, 150, function ($constraint) {
                $constraint->aspectRatio();
            })->save(public_path('uploads/filters/thumbnail/') . $imageNwName);

            $upload_image = $image->move('uploads/filters', $imageNwName);

            if ($filter->image) {
                if(file_exists(public_path('uploads/filters/' . $filter->image))) {
                    unlink(public_path('uploads/filters/' . $filter->image));
                }
                if(file_exists(public_path('uploads/filters/thumbnail/' . $filter->image))) {
                    unlink(public_path('uploads/filters/thumbnail/' . $filter->image));
                }
            }
            $filter->image = $imageNwName;
        }

        $filter->description = $request->description;

        /****************modified*********************/
        $filter->short_name = $request->short_name;
        $filter->application_date = $request->application_date;
        $filter->exam_date = $request->exam_date;
        $filter->short_description = $request->short_description;
        /********************************************/

        $filter->save();
        if($filterId) { $queryString = '?id='.$filterId; } else { $queryString = ''; }
        return redirect('admin/filters'.$queryString)->with('success', 'Filter updated successfully');
    }

    /**
     * Function name : destroy
     * Purpose : Remove the specified resource from storage
     * Author : Subham Dutta
     * Created Date : 17-12-2018
     * Modified date :
     * Param : int  $id
     * Return : \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $filter = Filter::find($id);
        //dd($filter);
        $filterId = $filter->filter_id;
        if($filterId) {
            //Filter::where('filter_id','=',$filter->id)->delete();
            $filter->delete();
        }
        if($filterId) { $queryString = '?id='.$filterId; } else { $queryString = ''; }
        return redirect('admin/filters'.$queryString)->with('success', 'Filter deleted successfully');
    }
}
