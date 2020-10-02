<?php

namespace App\Http\Controllers\Main\Guide;

use App\Models\Guide\Guide;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use App\Http\Responses\Web\Guide\Master\GuideResponse;
use App\Http\Responses\Web\Guide\Master\GuideSaveResponse;
use App\Http\Responses\Web\Guide\Master\GuideUpdateResponse;
use App\Http\Responses\Web\Guide\Master\GuideDeleteResponse;
use App\Http\Responses\Web\Guide\Master\GuideDeleteBulkResponse;

class GuideController extends Controller
{
    public function getData(Request $request)
    {
        return new GuideResponse;
    }

    public function index(Request $request)
    {
        $auth = $this->authorize('view');
        if (!$auth) {
            return $this->redirect();
        }
        $data['title']  = 'Kelola Pemandu';
        return view('page.guide.master.view')->with($data);
    }

    public function add()
    {
        $auth = $this->authorize('add');
        if (!$auth) {
            return $this->redirect();
        }
        $data['title'] = 'Tambah Data Pemandu';
        return view('page.guide.master.add')->with($data);
    }

    public function save(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'guide_name' => 'required',
            'guide_experience' => 'required|numeric',
            'guide_gender' => 'required|in:Laki-laki,Perempuan',
            'guide_birthday' => 'required|date',
            'guide_photo' => 'required',
        ]);

        if($validator->fails()) {
            return response()->json([
                'code' => 422,
                'message' => $validator->errors()->first(),
            ], 200);
        }

        return new GuideSaveResponse;
    }

    public function detail($id, Request $request)
    {
        $auth = $this->authorize('other');
        if (!$auth) {
            return $this->redirect();
        }

        $data['title'] = 'Detail Data Pemandu';
        $data['data']  = Guide::where('guide_id', $id)->first();

        return view('page.guide.master.detail')->with($data);
    }

    public function edit($id, Request $request)
    {
        $auth = $this->authorize('edit');
        if (!$auth) {
            return $this->redirect();
        }

        $data['data']  = Guide::where('guide_id', $id)->first();
        $data['title'] = 'Edit Data Pemandu';
        return view('page.guide.master.edit')->with($data);
    }

    public function update($id, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'guide_id' => 'required|exists:guide',
            'guide_name' => 'required',
            'guide_experience' => 'required|numeric',
            'guide_gender' => 'required|in:Laki-laki,Perempuan',
            'guide_birthday' => 'required|date',
        ]);

        if($validator->fails()) {
            return response()->json([
                'code' => 422,
                'message' => $validator->errors()->first(),
            ], 200);
        }

        return new GuideUpdateResponse;
    }

    public function delete(Request $request)
    {
        $auth = $this->authorize('delete');
        if (!$auth) {
            $this->session();
            return response()->json(['code' => 200]);
        }

        $validator = Validator::make($request->all(), [
            'guide_id' => 'required',
        ]);

        if($validator->fails()) {
            return response()->json([
                'code' => 422,
                'message' => $validator->errors()->first(),
            ], 200);
        }

        return new GuideDeleteResponse;
    }

    public function bulkDelete(Request $request)
    {
        $auth = $this->authorize('delete');
        if (!$auth) {
            $this->session();
            return response()->json(['code' => 200]);
        }

        $validator = Validator::make($request->all(), [
            'guide_id.*' => 'required',
        ]);

        if($validator->fails()) {
            return response()->json([
                'code' => 422,
                'message' => $validator->errors()->first(),
            ], 200);
        }

        return new GuideDeleteBulkResponse;
    }
}
