<?php

namespace App\Http\Controllers\api\v1\user;

use App\Helpers\CommonHelper;
use App\Http\Controllers\Controller;
use App\Models\LabelModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class MasterController extends Controller
{
    function labelList(): Response
    {
        $labels = LabelModel::where('is_deleted', '0')->orderby('id', 'asc')->get();
        return CommonHelper::response('1', [
            'message' => 'Label List',
            'data'    => $labels
        ]);
    }

    function labelCreate(): Response
    {
        $request = request();
        $validation = Validator::make(
            $request->all(),
            [
                'name' => 'required|string|max:255',
                'label_id'  => 'optional',
            ]
        );

        if ($validation->fails()) {
            return CommonHelper::response(0, ['message' => $validation->errors()->first()]);
        }
        $existingLabel = LabelModel::where('name', $request->name)
            ->where('is_deleted', 0)
            ->when($request->has('label_id'), function ($query) use ($request) {
                return $query->where('id', '!=', $request->label_id);
            })
            ->first();

        if ($existingLabel) {
            return CommonHelper::response(0, ['message' => 'Label with this name already exists']);
        }
        if ($request->has('label_id')) {
            if ($request->label_id == '1') {
                return CommonHelper::response(0, ['message' => 'Default label can not be edited']);
            }
            $label = LabelModel::find($request->label_id);
            if ($label) {
                $label->name = $request->name;
                $label->updated_by = $request->user()->id;
                $label->save();
            }
        } else {
            $label = new LabelModel;
            $label->name = $request->name;
            $label->created_by = $request->user()->id;
            $label->updated_by = $request->user()->id;
            $label->save();
        }
        $labels = LabelModel::where('is_deleted', '0')->orderby('id', 'asc')->get();
        return CommonHelper::response('1', [
            'message' => 'Label Created',
            'data'    => $labels
        ]);
    }

    function labelUpdate(): Response
    {
        $request = request();
        $validation = Validator::make(
            $request->all(),
            [
                'name'      => 'required|string|max:255',
                'label_id'  => 'required',
            ]
        );

        if ($validation->fails()) {
            return CommonHelper::response(0, ['message' => $validation->errors()->first()]);
        }

        if ($request->label_id == '1') {
            return CommonHelper::response(0, ['message' => 'Default label can not be updated']);
        }
        $label = LabelModel::find($request->label_id);
        if ($label) {
            $label->name = $request->name;
            $label->updated_by = $request->user()->id;
            $label->save();
        }

        $labels = LabelModel::where('is_deleted', '0')->orderby('id', 'asc')->get();
        return CommonHelper::response('1', [
            'message' => 'Label Updated',
            'data'    => $labels
        ]);
    }

    function labelDelete(): Response
    {
        $request = request();
        $validation = Validator::make(
            $request->all(),
            [
                'label_id' => 'required',
            ]
        );

        if ($validation->fails()) {
            return CommonHelper::response(0, ['message' => $validation->errors()->first()]);
        }
        if ($request->label_id != '1') {
            $label = LabelModel::find($request->label_id);
            if ($label) {
                $label->is_deleted = 1;
                $label->updated_by = $request->user()->id;
                $label->save();
            }
        }

        $labels = LabelModel::where('is_deleted', '0')->orderby('id', 'asc')->get();
        return CommonHelper::response('1', [
            'message' => 'Label Deleted',
            'data'    => $labels
        ]);
    }
}
