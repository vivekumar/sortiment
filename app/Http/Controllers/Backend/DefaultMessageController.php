<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\DefaultMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class DefaultMessageController extends Controller
{
    private $error = [];

    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $messages = DefaultMessage::all();

        return view('admin.question.default_message',compact('messages'));
    }

    public function add(Request $request)
    {


        if ($request->isMethod('post') && strlen($request->post('message')) >= 10) {
            $msgObj = new DefaultMessage();

            $msgObj->message = $request->post('message');
            $msgObj->link = $request->post('link');
            $msgObj->status = $request->post('status')?$request->post('status'):0;
            $msgObj->save();
            return redirect('/admin/default-message');
        } else if ($request->isMethod('post')) {
            $this->error['message'] = __('Message should have at least 10 characters!');
        }

        return $this->getForm($request);
    }

    public function edit(Request $request, $id)
    {
        if ($request->isMethod('post') && strlen($request->post('message')) >= 10) {
            DefaultMessage::where('id', $id)
                ->update([
                    'message' => $request->post('message'),
                    'link' => $request->post('link'),
                    'status' => $request->post('status')
                ]);
            return redirect('/admin/default-message');
        } else if ($request->isMethod('post')) {
            $this->error['message'] = __('Message should have at least 10 characters!');
        }

        return $this->getForm($request, $id);
    }

    public function delete($id)
    {
        DefaultMessage::where('id', $id)->delete();
        $mmss=__('You have deleted a default message successfully');
        Session::flash('message', $mmss);
        Session::flash('alert-class', 'alert-success');

        return redirect('/admin/default-message');
    }

    protected function getForm(Request $request, $id = 0)
    {
        $form = [];
        $msg = DefaultMessage::find($id);

        if ($id) {
            $form['action'] = route('admin.default.message.edit', $id);
        } else {
            $form['action'] = route('admin.default.message.add');
        }

        if ($request->post('message')) {
            $form['message'] = $request->post('message');
        } else if (!empty($msg->message)) {
            $form['message'] = $msg->message;
        } else {
            $form['message'] = '';
        }

        if ($request->post('link')) {
            $form['link'] = $request->post('link');
        } else if (!empty($msg->message)) {
            $form['link'] = $msg->link;
        } else {
            $form['link'] = '';
        }

        if ($request->post('status')) {
            $form['status'] = $request->post('status');
        } else if (!empty($msg->status)) {
            $form['status'] = $msg->status;
        } else {
            $form['status'] = '';
        }

        $form['errors'] = $this->error;

        return view('admin.question.default_message_form',compact('form'));
    }
}
