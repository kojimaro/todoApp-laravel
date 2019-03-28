@extends('layouts.app')

@section('content')
    <!-- Bootstrapの定形コード… -->
    <div class="card">
        <div class="card-body">
            <!-- バリデーションエラーの表示 -->
            @include('common.errors')

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

    <!-- TODO: グループ一覧 -->
    @if (count($groups) > 0)
        <div class="panel panel-default">
            <div class="panel-heading">
                グループ一覧
            </div>

            <div class="panel-body">
                <table class="table table-striped task-table">

                    <!-- テーブルヘッダー -->
                    <thead>
                        <th>Group</th>
                        <th>&nbsp;</th>
                    </thead>

                    <!-- テーブルボディー -->
                    <tbody>
                        @foreach ($groups as $group)
                            <tr>
                                <!-- タスク名 -->
                                <td class="table-text">
                                    <div>{{ $group->name }}</div>
                                </td>

                                <td>
                                    <!-- TODO: 削除ボタン -->
                                    <form action="/group/{{ $group->id }}" method="POST">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}

                                        <button>グループ削除</button>
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