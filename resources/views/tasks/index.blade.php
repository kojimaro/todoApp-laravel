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
                    <label for="task" class="col-sm-3 control-label">Task</label>

                    <div class="col-sm-6">
                        <input type="text" name="name" id="task-name" class="form-control">
                    </div>
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

            <!-- グループ作成 -->
            <form action="/group" method="POST" class="form-horizontal">
                {{ csrf_field() }}

                <!-- グループ名 -->
                <div class="form-group">
                    <label for="group-name" class="col-sm-3 control-label">Group</label>

                    <div class="col-sm-6">
                        <input type="text" name="name" id="group-name" class="form-control">
                    </div>
                </div>

                <!-- グループ追加ボタン -->
                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-6">
                        <button type="submit" class="btn btn-default">
                            <i class="fa fa-plus"></i> グループを作成
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
                        <th>&nbsp;</th>
                    </thead>

                    <!-- テーブルボディー -->
                    <tbody>
                        @foreach ($tasks as $task)
                            <tr>
                                <!-- タスク名 -->
                                <td class="table-text">
                                    <div>{{ $task->name }}</div>
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