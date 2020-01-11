<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Models\Task;
use App\Http\Controllers\Controller;

class ToDoListController extends Controller
{
    public function __construct()
    {
        $this->middleware('custom.jwt.auth')->except(['getTasks', 'getTaskById']);
    }

	public function getTasks()
	{
		return response()->json(Task::get(), 200);
	}

	public function getTaskById($id)
	{
		$objTask = Task::find($id);
		if(is_null($objTask))
		{
			return response()->json(['message' => 'Data not found'], 404);
		}

		return response()->json($objTask, 200);
	}

	public function createTask()
	{
		$rules = [
			'title'      => 'required|max:50',
			'attachment' => 'max:50',
			'done_at'    => 'date_format:Y-m-d H:i:s'
		] ;

		$request = json_decode(request()->getContent(), true);

		$validator = Validator::make($request, $rules);
		if ($validator->fails())
		{
			return response()->json($validator->errors(), 400);
		}
		if(isset($request['attachment']) && !file_exists(public_path($request['attachment'])))
		{
			return response()->json(['message' => 'Attachment not found'], 400);
		}

		$objTask = Task::create($request);

		return response()->json($objTask, 201);
	}

	public function updateTaskById($id)
	{
		$objTask = Task::find($id);
		if(is_null($objTask))
		{
			return response()->json(['message' => 'Data not found'], 404);
		}

		$rules = [
			'title'      => 'filled|max:50',
			'attachment' => 'max:50',
			'done_at'    => 'date_format:Y-m-d H:i:s'
		] ;

		$request = json_decode(request()->getContent(), true);

		$validator = Validator::make($request, $rules);
		if ($validator->fails())
		{
			return response()->json($validator->errors(), 400);
		}
		if(isset($request['attachment']) && !file_exists(public_path($request['attachment'])))
		{
			return response()->json(['message' => 'Attachment not found'], 400);
		}

		$objTask->update($request);

		return response()->json($objTask, 200);
	}

	public function deleteTaskById($id)
	{
		$objTask = Task::find($id);
		if(is_null($objTask))
		{
			return response()->json(['message' => 'Data not found'], 404);
		}

		$objTask->delete();

		return response()->json(null, 204);
	}

	public function deleteTasks()
	{
		Task::whereNotNull('id')->delete();

		return response()->json(null, 204);
	}

	public function uploadAttachment()
	{
		$attachment = request()->file('attachment') ;

		$fileExt  = $attachment->getClientOriginalExtension();
		$fileName = uniqid().'.'.$fileExt;
		$filePath = 'attachment/'.$fileName;

		$attachment->move(dirname(public_path($filePath)), $fileName);

		return response()->json(['attachment' => $filePath], 200);
	}
}