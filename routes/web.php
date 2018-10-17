<?php
use App\Events\MessageSent;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::get('/', 'ChatsController@index');
Route::get('messages', 'ChatsController@fetchMessages');
Route::post('messages', 'ChatsController@sendMessage'); 

Route::post('/fileUpload/{userId}',function($userId) {
	$file = request('file');
	$user = Auth::user();

	if (!empty($file)) {
        $fileName = $file->getClientOriginalName();
        // file with path
        $filePath = url('uploads/chats/'.$fileName);
        //Move Uploaded File
        $destinationPath = 'uploads/chats';
        if($file->move($destinationPath,$fileName)) {
            $request['file_path'] = $filePath;
            $request['file_name'] = $fileName;
            $request['message'] = 'file';
            $request['type'] = request('type');
        }

        $message = $user->messages()->create($request);

		$message->receivers()->create([
				'user_id'=>$userId
			]);

		$output = []; 
		broadcast(new MessageSent($user, $message))->toOthers(); 

		$output['message'] = $request;
		$output['user'] = $user;
		return ['output'=> $output];

    }

})->middleware('auth');
