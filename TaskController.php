<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Task;
use App\Repositories\TaskRepository;

class TaskController extends Controller
{
    /**
     * タスクリポジトリーインスタンス
     * 
     * @var TaskRepository
     */
    protected $tasks;





    /**
    * 新しいコントローラインスタンスの生成
    * @param TaskRepository $tasks
    * @return void
    */
    public function __construct(TaskRepository $tasks)
    {
        $this->middleware('auth');

        $this->tasks = $tasks;
    }

    /**
     * ユーザーの全タスクをリスト表示
     * 
     * @param Request $request
     * @return Response
     * 
     */
    public function index(Request $request)
    {
       return view('tasks.index', [
           'tasks' => $this->tasks->forUser($request->user()),
       ]); 
        
        
    }

    /**
     * 新タスク作成
     * 
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
        ]);

        // タスクの作成処理
        $request->user()->tasks()->create([
            'name' => $request->name,
        ]);

        return redirect('/tasks');
        
    }

    /**
     * 指定タスクの削除
     * 
     * @param Request $request
     * @param Task $task
     * @return Response
     */
    public function destory(Request $request, Task $task)
    {
        $this->authorize('destory', $task);

        $task->delete();

        return redirect('/tasks');
    }
}
