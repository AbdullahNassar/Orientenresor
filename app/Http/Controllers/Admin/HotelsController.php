<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Hotel;
use App\Accomidation;
use App\Destination;
use DB;
use Alert;

class HotelsController extends Controller
{
    public function getIndex() {
    	$hotels = Hotel::all();
        return view('admin.pages.accomidation.hotel.index', compact('hotels'));
    }

    public function getAdd() {
        $destinations = Destination::all();
        $accomidations = Accomidation::all();
        return view('admin.pages.accomidation.hotel.add', compact('destinations','accomidations'));
    }

    public function insert(Request $request) {
        $image = $request->input('image');
    	$name = $request->input('name');
        $location = $request->input('location');

        for ($i=1; $i <= 5 ; $i++) { 
            $features['feature'.$i] = $request->input('feature'.$i);
        }
        $feature = json_encode($features);

        $destination_id = $request->input('destination_id');
        $accomidation_id = $request->input('accomidation_id');
        $rate = $request->input('rate');
        $active = $request->input('active');

    	$data = array('name' => $name, 'location' => $location , 'facilities' => $feature ,
                      'image' => $image, 'destination_id' => $destination_id ,
                      'accomidation_id' => $accomidation_id ,'rate' => $rate,
                      'active' => $active);

    	$h = Hotel::create($data);
        if ($h){
            Alert::success(' The Data Inserted successfully', 'Done!');
            $hotels = Hotel::all();
            return view('admin.pages.accomidation.hotel.index', compact('hotels'));
        }else{
            Alert::error('Something went wrong!', 'Error!');
        }
    	
    }

    public function getEdit($id) {
    	if (isset($id)) {
            $hotels = DB::table('hotels')
                ->join('destinations','hotels.destination_id','=','destinations.id')
                ->join('accomidations','hotels.accomidation_id','=','accomidations.id')
                ->select('hotels.*','accomidations.accname','destinations.destName')
                ->where('hotels.id','=', $id)
                ->get();
            $destinations = Destination::all();
            $accomidations = Accomidation::all();
            $images = DB::table('hotelimages')
                ->select('hotelimages.*')
                ->where('hotel_id','=', $id)
                ->get();
	        return view('admin.pages.accomidation.hotel.edit', compact('hotels','images','destinations','accomidations'));
        }        
    }

    public function postEdit(Request $request) {
    	$id = $request->input('s_id');
    	$image = $request->input('image');
        $name = $request->input('name');
        $location = $request->input('location');

        for ($i=1; $i <= 5 ; $i++) { 
            $features['feature'.$i] = $request->input('feature'.$i);
        }
        $feature = json_encode($features);

        $destination_id = $request->input('destination_id');
        $accomidation_id = $request->input('accomidation_id');
        $rate = $request->input('rate');
        $active = $request->input('active');

        $data = array('name' => $name, 'location' => $location , 'facilities' => $feature ,
                      'image' => $image, 'destination_id' => $destination_id ,
                      'accomidation_id' => $accomidation_id ,'rate' => $rate,
                      'active' => $active);

    	$h = DB::table('hotels')->where('id','=', $id)->update($data);
    	if ($h){
            Alert::success(' The Data Updated successfully', 'Done!');
            $hotels = Hotel::all();
            return view('admin.pages.accomidation.hotel.index', compact('hotels'));
        }else{
            Alert::error('Something went wrong!', 'Error!');
        }
    }

    public function delete($id) {
    	if (isset($id)) {
	    	$h = DB::table('hotels')->where('id','=', $id)->delete();
	    	if ($h){
                Alert::success(' The Data Deleted successfully', 'Done!');
                $hotels = Hotel::all();
                return view('admin.pages.accomidation.hotel.index', compact('hotels'));
            }else{
                Alert::error('Something went wrong!', 'Error!');
            }
	    }
    }

    public function getPostImages(Request $request) {
        $id = $request->input('hotel');
        $image = $request->file('file');
        if ($image) {
            $destination = storage_path('uploads/hotels/');
            $imageName = $image->getClientOriginalName();
            $image->move($destination, $imageName);
            $image_path = "storage/uploads/hotels".'/'.$imageName;
            $data = array('image'=>$image_path,'hotel_id'=>$id);
            DB::table('hotelimages')->insert($data);
        }
    }

    public function addImages(Request $request) {
        $id = $request->input('hotel_id');
        $image = $request->file('file');
        if ($image) {
            $destination = storage_path('uploads/hotels/');
            $imageName = $image->getClientOriginalName();
            $image->move($destination, $imageName);
            $image_path = "storage/uploads/hotels".'/'.$imageName;
            $data = array('image'=>$image_path,'hotel_id'=>$id);
            DB::table('hotelimages')->insert($data);
        }
    }

    public function deleteImage($id)
    {
        if (isset($id)) {
            DB::table('hotelimages')->where('id','=', $id)->delete();
            return back();
        }
    }

    public function getGallery() {
        $hotels = Hotel::all();

        return view('admin.pages.accomidation.hotel.gallery', compact('hotels'));
    }

}
