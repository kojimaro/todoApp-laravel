@extends('layouts.app')

@section('content')

    <!-- Bootstrapの定形コード… -->
    <div class="card">
        <div class="card-body">
            <!-- バリデーションエラーの表示 -->
            @include('common.errors')

            <!-- 新タスクフォーム -->
            <form action="/task" method="POST" class="form-horizontal">
                {{ csrf_field() }}

                <!-- タスク名 -->
                <div class="form-group">
                    <label for="task-name" class="control-label">Task</label>
                    <input type="text" name="name" id="task-name" class="form-control">
                </div>

                <!-- グループ -->
                <div class="form-group">
                    <label for="task-group" class="control-label">
                        Group
                    </label>
                    <select class="form-control" id="task-group" name="group">
                        <option value=""></option>
                        @if (count($groups) > 0)
                            @foreach($groups as $group)
                                <option value="{{$group->id}}">
                                    {{$group->name}}
                                </option>
                            @endforeach
                        @endif
                    </select>
                </div>

                <!-- タスク追加ボタン -->
                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-6">
                        <button type="submit" class="btn btn-default">
                            <i class="fa fa-plus"></i> タスク追加
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- TODO: 現在のタスク -->
    @if (count($tasks) > 0)
        <div class="panel panel-default">
            <div class="panel-heading">
                現在のタスク
            </div>

            <div class="panel-body">
                <table class="table table-striped task-table">

                    <!-- テーブルヘッダー -->
                    <thead>
                        <th>Task</th>
                        <th>Group</th>
                        <th>Delete</th>
                        <th>Edit</th>
                    </thead>

                    <!-- テーブルボディー -->
                    <tbody>
                        @foreach ($tasks as $task)
                            <tr>
                                <!-- タスク名 -->
                                <td class="table-text">
                                    <div>{{ $task->name }}</div>
                                </td>

                                <td class="table-text">
                                    @if (empty(!$task->group))
                                        <div>{{ $task->group->name }}</div>
                                    @endif
                                </td>

                                <td>
                                    <!-- TODO: 削除ボタン -->
                                    <form action="/task/{{ $task->id }}" method="POST">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}

                                        <button>タスク削除</button>
                                    </form>
                                </td>

                                <td>
                                    <!-- TODO: 編集フォーム -->
                                    <!-- 新タスクフォーム -->
                                    <form action="/task/{{ $task->id }}" method="POST" class="form-horizontal">
                                        {{ csrf_field() }}
                                        {{ method_field('PATCH') }}

                                        <!-- タスク名 -->
                                        <div class="form-group">
                                            <label for="task" class="col-sm-3 control-label">タスクを編集</label>

                                            <div class="col-sm-6">
                                                <input type="text" name="name" id="task-name" class="form-control">
                                            </div>
                                        </div>

                                        <!-- タスク追加ボタン -->
                                        <div class="form-group">
                                            <div class="col-sm-offset-3 col-sm-6">
                                                <button type="submit" class="btn btn-default">
                                                    <i class="fa fa-plus"></i> 変更を保存
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif
@endsection