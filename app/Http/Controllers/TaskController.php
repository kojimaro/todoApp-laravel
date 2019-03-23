<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Task;
use App\Repositories\TaskRepository;

class TaskController extends Controller
{
    /**
     * タスクリポジトリーのインスタンス
     * @var TaskRepository
     */
    protected $tasks;

    /**
     * @return void
     */
    public function __construct(TaskRepository $tasks)
    {
        $this->middleware('auth');

        $this->tasks = $tasks;
    }

    public function index(Request $request)
    {
        return view('tasks.index', [
            'tasks' => $this->tasks->foruser($request->user())
        ]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255'
        ]);

        $request->user()->tasks()->create([
            'name' => $request->name
        ]);

        return redirect('/tasks');
    }

    /**
     * 指定したタスクの削除
     * @param Request $request
     * @param string $taskId
     * @return Response
     */
    public function destroy(Request $request, Task $task)
    {
        $this->authorize('destroy', $task);

        $task->delete();

        return redirect('/tasks');
    }
}
