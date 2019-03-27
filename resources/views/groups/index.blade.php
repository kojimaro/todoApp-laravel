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
@endsection