<?php

namespace App\Http\Responses\Web\Admin\Master;

use App\Models\Admin\AdminMaster;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Contracts\Support\Responsable;

class AdminSaveResponse extends Controller implements Responsable
{
    public function toResponse($request)
    {
        try {
            $this->create($request);

            return response()->json([
                'code' => 200,
                'messsage' => 'Success',
                'data' => new \stdClass
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'code' => 500,
                'message' => $e->getMessage(),
                'data' => new \stdClass
            ], 200);
        }
    }

    protected function create($request)
    {
        AdminMaster::create([
            'admin_name'        => $request->admin_name,
            'admin_title'       => $request->admin_title,
            'admin_description' => $request->admin_description,
            'admin_email'       => $request->admin_email,
            'admin_password'    => Hash::make($request->admin_password),
            'role_id'           => $request->role_id,
            'admin_photo'       => $this->decodeImage($request->admin_photo),
            'admin_token'       => '',
            'status'            => '1'
        ]);

        $this->activity([
            'activity_name' => 'Create New Admin',
            'activity_by' => Session::get('admin_name'),
            'activity_detail' => 'Create new admin at '.date('D m, Y H:i')
        ]);
    }

    protected function decodeImage($file)
    {
        $imageName = "";
        if (!empty($file) && $file !== "false") {
            preg_match("/data\:image\/(.*)\;base64/",$file, $extension);
            $image = str_replace('data:image/'.$extension[1].';base64,', '', $file);
            $image = str_replace(' ', '+', $image);
            $imageName = str_random(10).'.'.$extension[1];
            \File::put(storage_path(). '/app/public/admin/' . $imageName, base64_decode($image));
        }

        return $imageName;
    }
}
