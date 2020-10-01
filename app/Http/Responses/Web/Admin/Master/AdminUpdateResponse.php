<?php

namespace App\Http\Responses\Web\Admin\Master;

use App\Models\Admin\AdminMaster;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Contracts\Support\Responsable;
use App\Http\Controllers\Controller;

class AdminUpdateResponse extends Controller implements Responsable
{
    public function toResponse($request)
    {
        try {
            $this->update($request);

            return response()->json([
                'code' => 200,
                'message' => 'Success',
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

    protected function update($request)
    {
        $image = Session::get('admin_photo');
        if (!empty($request->admin_photo)) {
            $image = $this->decodeImage($request->admin_photo);
        }

        AdminMaster::where('admin_id', $request->admin_id)
            ->update([
                'admin_name'        => $request->admin_name,
                'admin_title'       => $request->admin_title,
                'admin_description' => $request->admin_description,
                'admin_email'       => $request->admin_email,
                'role_id'           => $request->role_id,
                'admin_photo'       => $image,
                'status'            => '1'
            ]);

        if (Session::get('admin_id') == $request->admin_id) {
            Session::forget(['admin_name', 'admin_title', 'admin_photo']);
            Session::put([
                'admin_name'    => $request->admin_name,
                'admin_title'   => $request->admin_title,
                'admin_photo'   => $image
            ]);
        }

        $this->activity([
            'activity_name' => 'Update Data Admin'. $request->admin_email,
            'activity_by' => Session::get('admin_name'),
            'activity_detail' => 'Update data admin at '.date('D m, Y H:i')
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
