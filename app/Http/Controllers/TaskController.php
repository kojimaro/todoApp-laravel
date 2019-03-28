<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Task;
use App\Repositories\TaskRepository;
use App\Repositories\GroupRepository;
use DebugBar\DebugBar;

class TaskController extends Controller
{
    /**
     * タスクリポジトリーのインスタンス
     * @var TaskRepository
     */
    protected $tasks;

    /**
     * @var GroupRepository
     */
    protected $groups;

    /**
     * @return void
     */
    public function __construct(
        TaskRepository $tasks, 
        GroupRepository $groups
    )
    {
        $this->middleware('auth');

        $this->tasks = $tasks;

        $this->groups = $groups;
    }

    public function index(Request $request)
    {
        $tasks = $this->tasks->foruser($request->user());
        $groups = $this->groups->forOwner($request->user());

        \Debugbar::info($groups);

        return view('tasks.index', [
            'tasks' => $tasks,
            'groups' => $groups
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
        $this->authorize('onlyOwner', $task);

        $task->delete();

        return redirect('/tasks');
    }

    /**
     * 指定したタスクの編集
     * @param Request $request
     * @param string $taskId
     * @return Response
     */
    public function edit(Request $request, Task $task)
    {
        $this->authorize('onlyOwner', $task);

        $this->validate($request, [
            'name' => 'required|max:255'
        ]);

        $task->name = $request->name;

        $task->save();

        return redirect('/tasks');
    }
}