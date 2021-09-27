<?php

namespace App\Http\Controllers;

use App\Models\Notebook;
use Illuminate\Http\Request;

class NotebookController extends Controller
{
    //Method API Get
    public function index()
    {
        $notebooks = Notebook::get(['id', 'title', 'body', 'created_at']);
        return $this->successMessage(200, 'success', $notebooks);
    }
    //Method API Post
    public function store(Request $request)
    {
        $notebook = Notebook::create($request->all());
        return $this->successMessage(201, 'created', $notebook);
    }
    //Method API Get By Id
    public function show($id)
    {
        $notebook = Notebook::where('id', $id)->first();
        if (!$notebook) {
            return $this->errorMessage(404, 'Not Found');
        }
        return $this->successMessage(200, 'success', $notebook);
    }
    //Method API PUT
    public function update(Request $request, $id)
    {
        $notebook = Notebook::where('id', $id)->first();
        if (!$notebook) {
            return $this->errorMessage(404, 'Not Found');
        }
        $notebook->update($request->all());
        return $this->successMessage(200, 'success', $notebook);
    }
    //Method API Destroy
    public function destroy($id)
    {
        $notebook = Notebook::where('id', $id)->first();
        if (!$notebook) {
            return $this->errorMessage(404, 'Not Found');
        }
        $notebook->delete();
        return $this->successMessage(200, 'success', "Success Delete Notebook!");
    }

    // Return All Message Condition
    function errorMessage($status, $message)
    {
        return response([
            'status' => $status,
            'message' => $message
        ]);
    }
    function successMessage($status, $message, $data = [])
    {
        return response([
            'status' => $status,
            'message' => $message,
            'data' => $data
        ]);
    }
}
