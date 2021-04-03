<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use App\Models\Students;
class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()  // main dashbaord part
    {
        $data['students'] = Students::orderBy('id', 'asc')->paginate(3);
        return view('students.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() // make part
    {
        return view('students.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)  //save part
    {
        $rules  = array(
            'firstname' => 'required',
            'lastname' => 'required',
            'gender' => 'required',
            'laptop_name' => 'required',
            'serial_number' => 'required',
            'department' => 'required',
            'profession' => 'required',
            'identification' => 'required',
            'img' => 'required|image|max:2048'
        );

        $errors = Validator::make($request->all(), $rules);
        if ($errors->fails()) {
            return response()->json(['errors' => $errors->errors()->all()]);
        }
        $img = $request->file('img');

        $new_image_name = rand() . '.' . $img->getClientOriginalExtension();
        $img->move(public_path('photos'), $new_image_name);

        $users = array(
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'gender' => $request->gender,
            'laptop_name' => $request->laptop_name,
            'serial_number' => $request->serial_number,
            'department' => $request->department,
            'profession' => $request->profession,
            'identification' => $request->identification,
            'img' => $new_image_name
        );

        students::create($users);

        // $request->validate([
        //     'firstname' => 'required',
        //     'lastname' => 'required',
        //     'gender' => 'required',
        //     'country' => 'required',
        //     'city' => 'required',
        //     'address' => 'required',
        //     // 'img' => 'required|image|max:2048'
        // ]);

        // // $img = $request->file('img');

        // // $new_image_name = rand() . '.' . $img->getClientOriginalExtension();
        // // $img->move(public_path('photos'), $new_image_name);

        // students::create($request->all());

        return redirect()->route('students.index')->with('success', 'Student Successfully Registered');
    }



    /**
     * Display the specified resource.
     *
     * @param \App\Students $students
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)  // view part
    {
        $students = Students::findOrfail($id);

        return view('students.show', compact('students'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Students $students
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id) // edit  part
    {
        $students = Students::find($id);

        return view('students.edit', compact('students'));
    }

    public function editProduct(Request $request, $id = null)
    {

        if ($request->isMethod('post')) {
            $data = $request->all();
            // echo "<pre>"; print_r($data); die;

            // Upload Image
            if ($request->hasFile('image')) {
                $img = File::file('img');
                if ($img->isValid()) {
                    // Upload Images after Resize
                    $img = $request->file('img');

                    $new_image_name = rand() . '.' . $img->getClientOriginalExtension();
                    $img->move(public_path('photos'), $new_image_name);
                }
            } else if (!empty($data['current_image'])) {
                $new_image_name = $data['current_image'];
            } else {
                $new_image_name = '';
            }

            Students::where(['id' => $id])->update([
                'feature_item' => $request->feature_item, 'status' => $request->status, 'category_id' => $data['category_id'], 'product_name' => $data['product_name'],
                'product_code' => $data['product_code'], 'product_color' => $data['product_color'], 'description' => $data['description'], 'care' => $data['care'], 'price' => $data['price'], 'weight' => $data['weight'], 'image' => $request->fileName, 'video' => $request->videoName, 'sleeve' => $request->sleeve, 'pattern' => $request->pattern
            ]);

            return redirect()->back()->with('flash_message_success', 'Product has been edited successfully');
        }
    }



    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Students            $students
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) // update part
    {
        $request->validate([
            'firstname' => 'required',
            'lastname' => 'required',
            'gender' => 'required',
            'laptop_name' => 'required',
            'serial_number' => 'required',
            'department' => 'required',
            'profession' => 'required',
            'identification' => 'required',
        ]);

        $student = array(
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'gender' => $request->gender,
            'laptop_name' => $request->laptop_name,
            'serial_number' => $request->serial_number,
            'department' => $request->department,
            'profession' => $request->profession,
            'identification' => $request->identification,
        );
        Students::whereId($id)->update($student);

        return redirect()->route('students.index')->with('success', 'Student Successfully updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Students $students
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)  // delete part
    {
        $students = Students::findOrfail($id);
        $students->delete();

        return redirect()->route('students.index')->with('success', 'Students deletd successful.');
    }
}
